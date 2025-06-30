<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SuperAdminReservationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $reservations = Reservation::join('facilities', 'reservations.facility_id', '=', 'facilities.id')
                ->join('users', 'reservations.user_id', '=', 'users.id')
                ->select([
                    'reservations.id',
                    'users.name as user_name',
                    'facilities.name as facility_name',
                    'reservations.time_start',
                    'reservations.time_end',
                    'reservations.status',
                ])
                ->where('reservations.status', '!=', 'pending')
                ->orderBy('reservations.created_at', 'desc')
                ->get()
                ->map(function ($reservations, $index) {
                    $reservations->no = $index + 1;
                    return $reservations;
                });
            return DataTables::of($reservations)
                ->addColumn('status_label', function ($r) {
                    switch ($r->status) {
                        case 'pending':
                            return '<span class="badge bg-warning">Pending</span>';
                        case 'verified':
                            return '<span class="badge bg-info">Verified</span>';
                        case 'approved':
                            return '<span class="badge bg-success">Approved</span>';
                        case 'rejected':
                            return '<span class="badge bg-danger">Rejected</span>';
                        default:
                            return '-';
                    }
                })
                ->addColumn('action', function ($r) {
                    return '
                        <a href="' . route('superadmin.reservasi.show', $r->id) . '" class="btn btn-sm btn-info">Detail</a>
                    ';
                })
                ->rawColumns(['status_label', 'action'])
                ->make(true);
        }
        return view('superadmin.reservations.index');
    }

    public function show($id)
    {
        $reservation = Reservation::with(['facilityTariff', 'user', 'facility'])->findOrFail($id);
        $user = $reservation->user;
        $facility = $reservation->facility;
        return view('superadmin.reservations.show', compact('reservation', 'user', 'facility'));
    }

    public function approve(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        if ($reservation->status !== 'verified') {
            return redirect()->route('superadmin.reservasi.index')->with('error', 'Reservasi harus dalam status verified untuk disetujui.');
        }
        $reservation->status = 'approved';
        $reservation->final_approved_by = $request->user()->id;
        $reservation->save();
        return redirect()->route('superadmin.reservasi.index')->with('success', 'Reservasi telah disetujui oleh superadmin.');
    }

    public function reject(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        if ($reservation->status === 'approved') {
            return redirect()->route('superadmin.reservasi.index')->with('error', 'Reservasi yang sudah disetujui tidak bisa ditolak.');
        }
        $reservation->status = 'rejected';
        $reservation->final_approved_by = $request->user()->id;
        $reservation->save();
        return redirect()->route('superadmin.reservasi.index')->with('error', 'Reservasi telah ditolak oleh superadmin.');
    }


    public function create()
    {
        $facilities = \App\Models\Facility::with('tariffs')->get();
        return view('superadmin.reservations.create', compact('facilities'));
    }

    public function storeReservation(Request $request)
{
    $validated = $request->validate([
        'facility_id' => 'required|exists:facilities,id',
        'time_start'  => 'required|date_format:Y-m-d H:i|after_or_equal:now',
        'time_end'    => 'required|date_format:Y-m-d H:i|after:time_start',
        'purpose'     => 'required|string|max:255',
    ]);

    $conflict = Reservation::where('facility_id', $validated['facility_id'])
        ->where('status', 'approved')
        ->where(function ($query) use ($validated) {
            $query->whereBetween('time_start', [$validated['time_start'], $validated['time_end']])
                ->orWhereBetween('time_end', [$validated['time_start'], $validated['time_end']])
                ->orWhere(function ($query) use ($validated) {
                    $query->where('time_start', '<=', $validated['time_start'])
                        ->where('time_end', '>=', $validated['time_end']);
                });
        })
        ->exists();

    if ($conflict) {
        return back()
            ->withErrors(['time_start' => 'Fasilitas ini sudah dipesan pada waktu tersebut. Silakan pilih waktu lain.'])
            ->withInput();
    }

    $validated['user_id'] = Auth::id();
    $validated['status'] = 'approved';

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = 'reservations/' . now()->format('Ymd_His') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('reservations', $image, basename($filename));
        $validated['image'] = $filename;
    } else {
        $validated['image'] = '';
    }

    if ($request->hasFile('extra_image')) {
        $extraImage = $request->file('extra_image');
        $extraFilename = 'reservations/' . now()->format('Ymd_His') . '_extra_' . uniqid() . '.' . $extraImage->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('reservations', $extraImage, basename($extraFilename));
        $validated['extra_image'] = $extraFilename;
    } else {
        $validated['extra_image'] = '';
    }

    Reservation::create($validated);

    return redirect()->route('superadmin.reservasi.index')
        ->with('success', 'Reservasi berhasil disimpan!');
}


}

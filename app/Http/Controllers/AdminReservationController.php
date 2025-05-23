<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $reservations = Reservation::join('facilities', 'reservations.facility_id', '=', 'facilities.id')
                ->join('users', 'reservations.user_id', '=', 'users.id')
                ->where('facilities.user_id', Auth::id())
                ->select([
                    'reservations.id',
                    'users.name as user_name',
                    'facilities.name as facility_name',
                    'reservations.time_start',
                    'reservations.time_end',
                    'reservations.status',
                ])
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
                    return '<a href="' . route('admin.reservasi.show', $r->id) . '" class="btn btn-sm btn-info">Detail</a>';
                })
                ->rawColumns(['status_label', 'action'])
                ->make(true);
        }

        return view('admin.reservations.index');
    }

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);

        $user = $reservation->user;
        $facility = $reservation->facility;


        if ($facility->user_id !== Auth::id()) {
            return redirect()->route('admin.reservasi.index')->with('error', 'Anda tidak memiliki akses ke fasilitas ini.');
        }
        return view('admin.reservations.show', compact('reservation', 'user', 'facility'));
    }


    public function verify($id)
    {

        $reservation = Reservation::with(['user', 'facility', 'approvedBy'])->findOrFail($id);


        if ($reservation->status !== 'pending') {
            return redirect()->route('admin.reservasi.index')->with('error', 'Reservasi sudah diproses.');
        }

        $pdf = Pdf::loadView('pdf.surat_reservasi', compact('reservation'));
        $fileName = 'surat_' . $reservation->id . '_' . time() . '.pdf';
        Storage::disk('public')->put('letters/' . $fileName, $pdf->output());

        $reservation->update([
            'status' => 'verified',
            'approved_by' => Auth::id(),
            'letter' => 'letters/' . $fileName,
        ]);

        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi diverifikasi dan surat telah dikirim ke superadmin.');
    }

    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'rejected';
        $reservation->approved_by = Auth::id();
        $reservation->save();

        return redirect()->route('admin.reservasi.index')->with('error', 'Reservation rejected!');
    }
}

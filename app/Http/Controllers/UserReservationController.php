<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserReservationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $reservations = Reservation::join('facilities', 'reservations.facility_id', '=', 'facilities.id')
                ->select([
                    'reservations.id',
                    'facilities.name as facility_name',
                    'reservations.time_start',
                    'reservations.time_end',
                    'reservations.status',
                ])
                ->where('reservations.user_id', Auth::id())
                ->orderBy('reservations.created_at', 'desc')
                ->get();

            return DataTables::of($reservations)
                ->addColumn('action', function ($r) {
                    return '<a href="' . route('user.reservasi.show', $r->id) . '" class="btn btn-info btn-sm">Detail </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('user.reservations.index');
    }

    public function create()
    {
        $facilities = Facility::with('tariffs')->get();
        return view('user.reservations.create', compact('facilities'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'facility_tariff_id' => 'required|exists:facility_tariffs,id',
            'time_start'  => 'required|date_format:Y-m-d H:i|after_or_equal:now',
            'time_end'    => 'required|date_format:Y-m-d H:i|after:time_start',
            'purpose'     => 'required|string|max:255',
            'image'       => 'required|mimes:jpg,jpeg,png',
            'extra_image' => 'nullable|mimes:jpg,jpeg,png',
            'selected_tariff_price' => 'required|numeric|min:0',
            'total_payment' => 'required|numeric|min:0',
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
        $validated['status'] = 'pending';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'reservations/' . now()->format('Ymd_His') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('reservations', $image, basename($filename));
            $validated['image'] = $filename;
        }

        if ($request->hasFile('extra_image')) {
            $extraImage = $request->file('extra_image');
            $extraFilename = 'reservations/' . now()->format('Ymd_His') . '_extra_' . uniqid() . '.' . $extraImage->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('reservations', $extraImage, basename($extraFilename));
            $validated['extra_image'] = $extraFilename;
        }


        Reservation::create($validated);

        return redirect()->route('user.reservasi.index')
            ->with('success', 'Reservasi berhasil diajukan!');
    }

    public function show($id)
    {
        $reservation = Reservation::with(['facilityTariff', 'user', 'facility'])->where('user_id', Auth::id())->findOrFail($id);

        $user = $reservation->user;
        $facility = $reservation->facility;

        return view('user.reservations.show', compact('reservation', 'user', 'facility'));
    }
}

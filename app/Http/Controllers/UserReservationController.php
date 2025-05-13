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
                ->where('reservations.user_id', Auth::id())
                ->select([
                    'reservations.id',
                    'facilities.name as facility_name',
                    'reservations.time_start',
                    'reservations.time_end',
                    'reservations.status',
                ])
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
        $facilities = Facility::all();
        return view('user.reservations.create', compact('facilities'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'time_start'  => 'required|date_format:Y-m-d\TH:i|after_or_equal:now',
            'time_end'    => 'required|date_format:Y-m-d\TH:i|after:time_start',
            'purpose'     => 'required|string|max:255',
            'image'       => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'reservations/' . now()->format('Ymd_His') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('reservations', $image, basename($filename));
            $validated['image'] = $filename;
        }
        Reservation::create($validated);

        return redirect()->route('user.reservasi.index')
            ->with('success', 'Reservasi berhasil diajukan!');
    }


    public function show($id)
    {
        $reservation = Reservation::where('user_id', Auth::id())->findOrFail($id);
        return view('user.reservasi.show', compact('reservation'));
    }
}

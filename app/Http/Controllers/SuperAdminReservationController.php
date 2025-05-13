<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                ->where('reservations.status', 'verified')
                ->orderBy('reservations.created_at', 'desc')
                ->get();

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
        $reservation = Reservation::findOrFail($id);
        $user = $reservation->user;
        $facility = $reservation->facility;



        return view('superadmin.reservations.show', compact('reservation', 'user', 'facility'));
    }

    // Method untuk menyetujui reservasi
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

    // Method untuk menolak reservasi
    public function reject(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        // Jika status sudah approved, tidak bisa ditolak lagi
        if ($reservation->status === 'approved') {
            return redirect()->route('superadmin.reservasi.index')->with('error', 'Reservasi yang sudah disetujui tidak bisa ditolak.');
        }

        $reservation->status = 'rejected';
        $reservation->final_approved_by = $request->user()->id;
        $reservation->save();

        return redirect()->route('superadmin.reservasi.index')->with('error', 'Reservasi telah ditolak oleh superadmin.');
    }
}
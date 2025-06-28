<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function speradminDashboard()
    {
        $reservations = Reservation::with('facility')->get();

        return view('superadmin.dashboard.index', [
            'totalVerified'  => $reservations->where('status', 'verified')->count(),
            'totalApproved'  => $reservations->where('status', 'approved')->count(),
            'totalRejected'  => $reservations->where('status', 'rejected')->count(),
            'totalFacilities' => Facility::count(),
        ]);
    }

    public function getSuperAdminRecentReservations(Request $request)
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
                ->whereNotIn('reservations.status', ['pending', 'rejected'])
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
                })->addColumn(
                    'waktu',
                    fn($row) =>
                    \Carbon\Carbon::parse($row->time_start)->format('d M Y H:i') . ' - ' .
                        \Carbon\Carbon::parse($row->time_end)->format('H:i')
                )
                ->rawColumns(['status_label', 'action', 'waktu'])
                ->make(true);
        }
    }

    public function getSuperAdminEvents()
    {
        $adminId = Auth::id();

        $reservations = Reservation::with('facility', 'user')
            ->whereIn('status', ['verified', 'approved'])
            ->get();

        $events = $reservations->map(function ($reservation) {
            return [
                'title' => $reservation->user->name ?? '-',
                'start' => \Carbon\Carbon::parse($reservation->date . ' ' . $reservation->time_start)->format('Y-m-d H:i'),
                'end'   => \Carbon\Carbon::parse($reservation->date . ' ' . $reservation->time_end)->format('Y-m-d H:i'),
                'extendedProps' => [
                    'facility' => $reservation->facility->name ?? '-',
                    'status'   => $reservation->status,
                ],
            ];
        });

        return response()->json($events);
    }
    public function adminDashboard()
    {
        $reservations = Reservation::with(['facility', 'user'])
            ->whereHas('facility', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('admin.dashboard.index', [
            'totalPending'   => $reservations->where('status', 'pending')->count(),
            'totalVerified'  => $reservations->where('status', 'verified')->count(),
            'totalApproved'  => $reservations->where('status', 'approved')->count(),
            'totalRejected'  => $reservations->where('status', 'rejected')->count(),
            'totalFacilities' => Auth::user()->facilities->count(),
        ]);
    }

    public function getRecentReservations(Request $request)
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
                ->where('facilities.user_id', Auth::id())
                ->orderBy('reservations.created_at', 'desc')
                ->get()
                ->map(function ($reservations, $index) {
                    $reservations->no = $index + 1;
                    return $reservations;
                });

            return DataTables::of($reservations)
                ->addColumn(
                    'waktu',
                    fn($row) =>
                    \Carbon\Carbon::parse($row->time_start)->format('d M Y H:i') . ' - ' .
                        \Carbon\Carbon::parse($row->time_end)->format('H:i')
                )
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
                ->rawColumns(['waktu', 'status_label', 'action'])
                ->make(true);
        }
    }

    public function getAdminEvents()
    {
        $adminId = Auth::id();

        $reservations = Reservation::with('facility', 'user')
            ->whereHas('facility', function ($query) use ($adminId) {
                $query->where('user_id', $adminId);
            })
            ->get();

        $events = $reservations->map(function ($reservation) {
            return [
                'title' => $reservation->user->name ?? '-',
                'start' => \Carbon\Carbon::parse($reservation->date . ' ' . $reservation->time_start)->format('Y-m-d H:i'),
                'end'   => \Carbon\Carbon::parse($reservation->date . ' ' . $reservation->time_end)->format('Y-m-d H:i'),
                'extendedProps' => [
                    'facility' => $reservation->facility->name ?? '-',
                    'status'   => $reservation->status,
                ],
            ];
        });

        return response()->json($events);
    }

    public function userDashboard()
    {
        $user = Auth::user();

        $approved = Reservation::where('user_id', $user->id)->where('status', 'approved')->count();
        $pending = Reservation::where('user_id', $user->id)->where('status', 'pending')->count();
        $verified = Reservation::where('user_id', $user->id)->where('status', 'verified')->count();
        $rejected = Reservation::where('user_id', $user->id)->where('status', 'rejected')->count();

        $todayReservation = Reservation::with('facility')
            ->where('user_id', $user->id)
            ->whereDate('time_start', today())
            ->orderBy('time_start')
            ->where('status', 'approved')
            ->first();

        $recentReservations = Reservation::with('facility')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('user.dashboard.index', compact(
            'user',
            'approved',
            'pending',
            'verified',
            'rejected',
            'todayReservation',
            'recentReservations'
        ));
    }

    public function getUserEvents()
    {
        $user = Auth::user();

        $reservations = Reservation::with('facility')
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'verified', 'approved', 'rejected'])
            ->get();

        $events = $reservations->map(function ($reservation) {
            return [
                'title' => $reservation->user->name ?? '-',
                'start' => \Carbon\Carbon::parse($reservation->date . ' ' . $reservation->time_start)->format('Y-m-d H:i'),
                'end'   => \Carbon\Carbon::parse($reservation->date . ' ' . $reservation->time_end)->format('Y-m-d H:i'),
                'extendedProps' => [
                    'facility' => $reservation->facility->name ?? '-',
                    'status'   => $reservation->status,
                ],
            ];
        });

        return response()->json($events);
    }
}

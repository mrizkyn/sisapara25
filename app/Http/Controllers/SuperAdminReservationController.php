<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

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

    public function report(Request $request)
    {
        $query = Reservation::with(['user', 'facility', 'facilityTariff'])
            ->where('status', 'approved');

        if ($request->start_date && $request->end_date) {
            if (Carbon::parse($request->end_date)->lt(Carbon::parse($request->start_date))) {
                return back()->with('error', 'Tanggal akhir tidak boleh sebelum tanggal mulai.');
            }
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();

            $query->where(function ($q) use ($start, $end) {
                $q->whereBetween('time_start', [$start, $end])
                    ->orWhereBetween('time_end', [$start, $end])
                    ->orWhere(function ($q2) use ($start, $end) {
                        $q2->where('time_start', '<', $start)
                            ->where('time_end', '>', $end);
                    });
            });
        } elseif ($request->start_date) {
            $query->where('time_start', '>=', Carbon::parse($request->start_date)->startOfDay());
        } elseif ($request->end_date) {
            $query->where('time_end', '<=', Carbon::parse($request->end_date)->endOfDay());
        }

        if ($request->facility_id) {
            $query->where('facility_id', $request->facility_id);
        }

        $reservations = $query->orderBy('time_start', 'asc')->get();
        $facilities = Facility::all();

        return view('superadmin.reservations.report', compact('reservations', 'facilities'));
    }

    public function export(Request $request)
    {
        $query = Reservation::with(['user', 'facility', 'facilityTariff'])
            ->where('status', 'approved');

        if ($request->start_date && $request->end_date) {
            if (Carbon::parse($request->end_date)->lt(Carbon::parse($request->start_date))) {
                return back()->with('error', 'Tanggal akhir tidak boleh sebelum tanggal mulai.');
            }
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();

            $query->where(function ($q) use ($start, $end) {
                $q->whereBetween('time_start', [$start, $end])
                    ->orWhereBetween('time_end', [$start, $end])
                    ->orWhere(function ($q2) use ($start, $end) {
                        $q2->where('time_start', '<', $start)
                            ->where('time_end', '>', $end);
                    });
            });
        } elseif ($request->start_date) {
            $query->where('time_start', '>=', Carbon::parse($request->start_date)->startOfDay());
        } elseif ($request->end_date) {
            $query->where('time_end', '<=', Carbon::parse($request->end_date)->endOfDay());
        }

        if ($request->facility_id) {
            $query->where('facility_id', $request->facility_id);
        }

        $reservations = $query->orderBy('time_start', 'asc')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul Laporan
        $title = 'Laporan Reservasi';
        if ($request->start_date && $request->end_date) {
            $title .= ' dari ' . Carbon::parse($request->start_date)->format('d M Y') .
                ' sampai ' . Carbon::parse($request->end_date)->format('d M Y');
        } else {
            $title .= ' ';
        }
        if ($request->facility_id) {
            $facility = Facility::find($request->facility_id);
            $title .= ' - Fasilitas ' . ($facility->name ?? 'Fasilitas Tidak Ditemukan');
        }

        $sheet->setCellValue('A1', $title);
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $startRow = 3;

        $headers = [
            'Nama Pengguna',
            'Fasilitas',
            'Mulai',
            'Selesai',
            'Total Jam',
            'Jenis Sewa',
            'Hari',
            'Sesi',
            'Harga / Jam',
            'Total Bayar'
        ];
        $sheet->fromArray($headers, null, 'A' . $startRow);

        $headerRange = 'A' . $startRow . ':J' . $startRow;
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('008080');

        $row = $startRow + 1;

        foreach ($reservations as $r) {
            $start = Carbon::parse($r->time_start);
            $end = Carbon::parse($r->time_end);
            $diffInMinutes = $start->diffInMinutes($end);
            $jam = floor($diffInMinutes / 60);
            $menit = $diffInMinutes % 60;
            $totalFormatted = "$jam jam $menit menit";

            $sheet->setCellValue("A{$row}", $r->user->name);
            $sheet->setCellValue("B{$row}", $r->facility->name);
            $sheet->setCellValue("C{$row}", $start->format('d-m-Y H:i'));
            $sheet->setCellValue("D{$row}", $end->format('d-m-Y H:i'));
            $sheet->setCellValue("E{$row}", $totalFormatted);
            $sheet->setCellValue("F{$row}", $r->facilityTariff->rental_type ?? '-');
            $sheet->setCellValue("G{$row}", $r->facilityTariff->day_type ?? '-');
            $sheet->setCellValue("H{$row}", $r->facilityTariff->time_type ?? '-');
            $sheet->setCellValue("I{$row}", $r->selected_tariff_price ?? 0);
            $sheet->setCellValue("J{$row}", $r->total_payment ?? 0);

            $row++;
        }

        // Format kolom harga
        $sheet->getStyle("I" . ($startRow + 1) . ":I" . ($row - 1))
            ->getNumberFormat()->setFormatCode('"Rp"#,##0');
        $sheet->getStyle("J" . ($startRow + 1) . ":J" . ($row - 1))
            ->getNumberFormat()->setFormatCode('"Rp"#,##0');

        // Total keseluruhan
        $sheet->setCellValue("A{$row}", 'Total Seluruh');
        $sheet->setCellValue("J{$row}", "=SUM(J" . ($startRow + 1) . ":J" . ($row - 1) . ")");
        $sheet->getStyle("J{$row}")->getNumberFormat()->setFormatCode('"Rp"#,##0');
        $sheet->getStyle("A{$row}:J{$row}")->getFont()->setBold(true);
        $sheet->getStyle("I{$row}:J{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $sheet->freezePane('A' . ($startRow + 1));

        $filename = 'Laporan_reservasi ' . now()->format('d-m-Y') . '.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer = new Xlsx($spreadsheet);
        $writer->save($temp_file);

        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }
}

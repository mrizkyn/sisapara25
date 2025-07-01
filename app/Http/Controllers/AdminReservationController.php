<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class AdminReservationController extends Controller
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
                ->where('facilities.user_id', Auth::id())
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
        $reservation = Reservation::with(['facilityTariff', 'user', 'facility'])->findOrFail($id);

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

    public function report(Request $request)
    {
        $user = Auth::user();
        $facilityIds = $user->facilities->pluck('id');

        $query = Reservation::with(['user', 'facility', 'facilityTariff'])
            ->where('status', 'approved')
            ->whereIn('facility_id', $facilityIds);

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

        $reservations = $query->orderBy('time_start', 'asc')->get();

        return view('admin.reservations.report', compact('reservations'));
    }

    public function export(Request $request)
    {
        $user = Auth::user();
        $facilityIds = $user->facilities->pluck('id');

        $query = Reservation::with(['user', 'facility', 'facilityTariff'])
            ->where('status', 'approved')
            ->whereIn('facility_id', $facilityIds);

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

        $reservations = $query->orderBy('time_start', 'asc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul laporan
        if ($request->start_date && $request->end_date) {
            $sheet->setCellValue('A1', 'Laporan Reservasi dari ' .
                Carbon::parse($request->start_date)->format('d M Y') . ' sampai ' .
                Carbon::parse($request->end_date)->format('d M Y'));
        } else {
            $sheet->setCellValue('A1', 'Laporan Reservasi Semua Waktu');
        }

        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $startRow = 3;

        // Header kolom
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
            'Total Bayar',
        ];
        $sheet->fromArray($headers, null, 'A' . $startRow);

        $headerRange = 'A' . $startRow . ':J' . $startRow;
        $sheet->getStyle($headerRange)->getFont()->setBold(true);
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($headerRange)->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('008080');

        $row = $startRow + 1;

        foreach ($reservations as $r) {
            $start = Carbon::parse($r->time_start);
            $end = Carbon::parse($r->time_end);

            $startFormatted = $start->format('d-m-Y H:i');
            $endFormatted = $end->format('d-m-Y H:i');

            $diffInMinutes = $start->diffInMinutes($end);
            $jam = floor($diffInMinutes / 60);
            $menit = $diffInMinutes % 60;
            $totalFormatted = "{$jam} jam {$menit} menit";

            $hargaPerJam = $r->selected_tariff_price ?? 0;
            $totalBayar = $r->total_payment ?? 0;

            $tariff = $r->facilityTariff;
            $rentalType = $tariff->rental_type ?? '-';
            $dayType = $tariff->day_type ?? '-';
            $timeType = $tariff->time_type ?? '-';

            $sheet->setCellValue("A{$row}", $r->user->name);
            $sheet->setCellValue("B{$row}", $r->facility->name);
            $sheet->setCellValue("C{$row}", $startFormatted);
            $sheet->setCellValue("D{$row}", $endFormatted);
            $sheet->setCellValue("E{$row}", $totalFormatted);
            $sheet->setCellValue("F{$row}", $rentalType);
            $sheet->setCellValue("G{$row}", $dayType);
            $sheet->setCellValue("H{$row}", $timeType);
            $sheet->setCellValue("I{$row}", $hargaPerJam);
            $sheet->setCellValue("J{$row}", $totalBayar);

            $row++;
        }

        $sheet->getStyle("I" . ($startRow + 1) . ":I" . ($row - 1))
            ->getNumberFormat()->setFormatCode('"Rp"#,##0');
        $sheet->getStyle("J" . ($startRow + 1) . ":J" . ($row - 1))
            ->getNumberFormat()->setFormatCode('"Rp"#,##0');

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

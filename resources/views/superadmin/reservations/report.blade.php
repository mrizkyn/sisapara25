@extends('layouts.panel.main')

@section('main')
    <style>
        /* Prevent text from wrapping */
        .table-nowrap td,
        .table-nowrap th {
            white-space: nowrap;
        }
    </style>

    <div class="container mt-5">
        <h3 class="mb-4 fw-bold text-center">Laporan Reservasi</h3>

        <form method="GET" action="{{ route('superadmin.reservasi.report') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3">
                <label for="facility_id" class="form-label">Fasilitas</label>
                <select name="facility_id" id="facility_id" class="form-select">
                    <option value="">-- Semua Fasilitas --</option>
                    @foreach ($facilities as $facility)
                        <option value="{{ $facility->id }}" {{ request('facility_id') == $facility->id ? 'selected' : '' }}>
                            {{ $facility->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search"></i> Filter
                </button>
                <a href="{{ route('superadmin.reservasi.export', request()->only('start_date', 'end_date', 'facility_id')) }}"
                    class="btn btn-success">
                    <i class="bi bi-download"></i> Export Excel
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-nowrap">
                <thead class="table-dark text-center align-middle">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengguna</th>
                        <th>Fasilitas</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Total Jam</th>
                        <th>Jenis Sewa</th>
                        <th>Hari</th>
                        <th>Sesi</th>
                        <th>Harga / Jam</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservations as $r)
                        @php
                            $start = \Carbon\Carbon::parse($r->time_start);
                            $end = \Carbon\Carbon::parse($r->time_end);
                            $diffInMinutes = $start->diffInMinutes($end);
                            $jam = floor($diffInMinutes / 60);
                            $menit = $diffInMinutes % 60;
                            $totalFormatted = $jam . ' jam ' . $menit . ' menit';

                            $tariff = $r->facilityTariff;
                            $rentalType = $tariff->rental_type ?? '-';
                            $dayType = $tariff->day_type ?? '-';
                            $timeType = $tariff->time_type ?? '-';

                            $hargaPerJam = $r->selected_tariff_price ?? 0;
                            $totalBayar = $r->total_payment ?? 0;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $r->user->name }}</td>
                            <td>{{ $r->facility->name }}</td>
                            <td>{{ $start->format('d-m-Y H:i') }}</td>
                            <td>{{ $end->format('d-m-Y H:i') }}</td>
                            <td>{{ $totalFormatted }}</td>
                            <td>{{ $rentalType }}</td>
                            <td>{{ $dayType }}</td>
                            <td>{{ $timeType }}</td>
                            <td>Rp{{ number_format($hargaPerJam, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($totalBayar, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">Tidak ada data untuk ditampilkan</td>
                        </tr>
                    @endforelse
                </tbody>
                @if ($reservations->count())
                    <tfoot>
                        <tr>
                            <td colspan="10" class="text-start fw-bold">Total Seluruh</td>
                            <td class="fw-bold">
                                Rp{{ number_format($reservations->sum('total_payment'), 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
@endsection

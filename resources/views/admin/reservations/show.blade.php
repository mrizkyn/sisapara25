@extends('layouts.panel.main') {{-- Sesuaikan dengan layout utama kamu --}}

@section('main')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white" style="background-color: teal;">
                        <h5 class="mb-0">Detail Reservasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Nama Pengaju/Pengguna</label>
                            <div class="col-sm-8">
                                {{-- PERBAIKAN: Akses melalui relasi reservation --}}
                                <div class="form-control-plaintext">
                                    {{ $reservation->user->name ?? 'Pengguna tidak ditemukan' }}</div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Fasilitas</label>
                            <div class="col-sm-8">
                                {{-- PERBAIKAN: Akses melalui relasi reservation --}}
                                <div class="form-control-plaintext">{{ $reservation->facility->name ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Kategori</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">
                                    {{ $reservation->facilityTariff->rental_type ?? '-' }} -
                                    {{ $reservation->facilityTariff->day_type ?? '-' }} -
                                    {{ $reservation->facilityTariff->time_type ?? '-' }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Waktu Mulai</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">
                                    {{ \Carbon\Carbon::parse($reservation->time_start)->translatedFormat('d M Y H:i') }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Waktu Selesai</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">
                                    {{ \Carbon\Carbon::parse($reservation->time_end)->translatedFormat('d M Y H:i') }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Tujuan</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">{{ $reservation->purpose }}</div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Total yang harus di bayar</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">
                                    {{-- PENYEMPURNAAN: Menambahkan format angka agar mudah dibaca --}}
                                    Rp{{ number_format($reservation->total_payment, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Bukti Transaksi</label>
                            <div class="col-sm-8">
                                @if ($reservation->image)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal">
                                        <img src="{{ asset('storage/' . $reservation->image) }}" class="img-fluid"
                                            alt="Bukti Transaksi" style="height: 300px; object-fit: contain;">
                                    </a>
                                @else
                                    <span class="text-muted fst-italic">Belum diunggah</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Bukti Tambahan</label>
                            <div class="col-sm-8">
                                @if ($reservation->extra_image)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#extraImageModal">
                                        <img src="{{ asset('storage/' . $reservation->extra_image) }}" class="img-fluid"
                                            alt="Bukti Tambahan" style="height: 300px; object-fit: contain;">
                                    </a>
                                @else
                                    <span class="text-muted fst-italic">-</span>
                                @endif
                            </div>
                        </div>

                        {{-- Modal untuk Bukti Transaksi --}}
                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalLabel">Bukti Transaksi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('storage/' . $reservation->image) }}" class="img-fluid"
                                            alt="Bukti Transaksi">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal untuk Bukti Tambahan (Tambahan) --}}
                        <div class="modal fade" id="extraImageModal" tabindex="-1" aria-labelledby="extraImageModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="extraImageModalLabel">Bukti Tambahan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('storage/' . $reservation->extra_image) }}" class="img-fluid"
                                            alt="Bukti Tambahan">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Status Saat Ini</label>
                            <div class="col-sm-8">
                                @php
                                    $badgeClass = match ($reservation->status) {
                                        'approved' => 'success',
                                        'verified' => 'info',
                                        'pending' => 'warning',
                                        'rejected' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($reservation->status) }}</span>
                            </div>
                        </div>
                        @if ($reservation->status === 'pending')
                            <div class="float-end">
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.reservasi.verify', $reservation->id) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-check-circle"></i> Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.reservasi.reject', $reservation->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menolak reservasi ini?');">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-x-circle"></i> Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                            <label class="col-sm-4 col-form-label fw-semibold">Nama Pengguna</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">{{ $user->name }}</div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-semibold">Fasilitas</label>
                            <div class="col-sm-8">
                                <div class="form-control-plaintext">{{ $facility->name ?? '-' }}</div>
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
                            <label class="col-sm-4 col-form-label fw-semibold">Surat dari Admin</label>
                            <div class="col-sm-8">
                                @if ($reservation->letter)
                                    <a href="{{ asset('storage/' . $reservation->letter) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-file-earmark-text"></i> Lihat Surat
                                    </a>
                                @else
                                    <span class="text-muted fst-italic">Belum diunggah</span>
                                @endif
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
                        @if ($reservation->status === 'verified')
                            <div class="float-end">

                                <div class="d-flex gap-2">
                                    <form action="{{ route('superadmin.reservasi.approve', $reservation->id) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-check-circle"></i> Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('superadmin.reservasi.reject', $reservation->id) }}"
                                        method="POST" onsubmit="return confirm('Yakin ingin menolak reservasi ini?');">
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

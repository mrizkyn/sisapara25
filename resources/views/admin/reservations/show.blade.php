@extends('layouts.panel.main')

@section('main')
    <div class="container mt-4">
        <h3 class="mb-4 fw-bold text-center">Detail Reservasi</h3>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Nama User: {{ $user->name }}</h5>
                        <h5>Fasilitas: {{ $facility->name }}</h5>
                        <h5>Waktu: {{ $reservation->time_start }} - {{ $reservation->time_end }}</h5>
                        <h5>Tujuan: {{ $reservation->purpose }}</h5>

                        <!-- Tampilkan gambar -->
                        <div class="mt-3">
                            <h6>Gambar Surat:</h6>
                            <img src="{{ asset('storage/' . $reservation->image) }}" class="img-fluid" alt="Gambar Surat">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Tombol Approve dan Reject -->
                        <div class="mt-4">
                            <form action="{{ route('admin.reservasi.verify', $reservation->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form action="{{ route('admin.reservasi.reject', $reservation->id) }}" method="POST"
                                class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

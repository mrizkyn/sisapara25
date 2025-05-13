@extends('layouts.user.main')

@section('main-content')
    <div class="container py-5" style="margin-top: 150px">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $facility->image) }}" class="img-fluid rounded shadow"
                    alt="{{ $facility->name }}">
            </div>

            <div class="col-md-8">
                <h2 class="mb-3">{{ $facility->name }}</h2>
                <p><strong>Kapasitas:</strong> {{ $facility->capacity }}</p>
                <p><strong>lokasi:</strong> {{ $facility->location }}</p>
                <p class="mt-3">{{ $facility->description }}</p>
                <a href="{{ route('reservasi') }}" class="btn btn-secondary mt-4">← Kembali ke Daftar</a>
            </div>
        </div>
    </div>
@endsection

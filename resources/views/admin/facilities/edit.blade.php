@extends('layouts.panel.main')

@section('main')
    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold text-center">Edit Fasilitas</h2>

        <!-- Formulir Edit Fasilitas -->
        <div class="card shadow-sm">
            <div class="card-header text-white py-3" style="background-color: teal;">
                <h5 class="mb-0"><i class="fas fa-building me-2"></i> Form Edit Fasilitas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Fasilitas</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $facility->name) }}" placeholder="Masukkan nama fasilitas"
                            required>
                        @error('name')
                            <div class="invalid-feedback">Nama fasilitas wajib diisi.</div>
                        @enderror
                    </div>

                    <!-- Input Deskripsi -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4" placeholder="Masukkan deskripsi fasilitas" required>{{ old('description', $facility->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">Deskripsi wajib diisi.</div>
                        @enderror
                    </div>

                    <!-- Input Lokasi -->
                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                            name="location" value="{{ old('location', $facility->location) }}"
                            placeholder="Masukkan lokasi fasilitas" required>
                        @error('location')
                            <div class="invalid-feedback">Lokasi wajib diisi.</div>
                        @enderror
                    </div>

                    <!-- Input Tipe -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe</label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" id="type"
                            name="type" value="{{ old('type', $facility->type) }}" placeholder="Masukkan tipe fasilitas"
                            required>
                        @error('type')
                            <div class="invalid-feedback">Tipe wajib diisi.</div>
                        @enderror
                    </div>

                    <!-- Input Kapasitas -->
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Kapasitas</label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                            name="capacity" value="{{ old('capacity', $facility->capacity) }}"
                            placeholder="Masukkan kapasitas fasilitas" required>
                        @error('capacity')
                            <div class="invalid-feedback">Kapasitas wajib diisi dan harus berupa angka.</div>
                        @enderror
                    </div>

                    <!-- Input Gambar -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">File gambar tidak valid.</div>
                        @enderror
                        @if ($facility->image)
                            <small class="d-block mt-2">Gambar saat ini:</small>
                            <img src="{{ asset('storage/' . $facility->image) }}" alt="Gambar Fasilitas"
                                class="img-thumbnail" style="max-height: 200px;">
                        @endif
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-flex">
                        <button type="submit" class="btn btn-success ms-auto">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

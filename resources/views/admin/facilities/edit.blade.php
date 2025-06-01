@extends('layouts.panel.main')

@section('main')
    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold text-center">Edit Fasilitas</h2>

        <div class="card shadow-sm">
            <div class="card-header text-white py-3" style="background-color: teal;">
                <h5 class="mb-0"><i class="fas fa-building me-2"></i> Form Edit Fasilitas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Fasilitas</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $facility->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">Nama fasilitas wajib diisi.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4" required>{{ old('description', $facility->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">Deskripsi wajib diisi.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                            name="location" value="{{ old('location', $facility->location) }}" required>
                        @error('location')
                            <div class="invalid-feedback">Lokasi wajib diisi.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe</label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" id="type"
                            name="type" value="{{ old('type', $facility->type) }}" required>
                        @error('type')
                            <div class="invalid-feedback">Tipe wajib diisi.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="capacity" class="form-label">Kapasitas</label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                            name="capacity" value="{{ old('capacity', $facility->capacity) }}" required>
                        @error('capacity')
                            <div class="invalid-feedback">Kapasitas wajib diisi dan harus berupa angka.</div>
                        @enderror
                    </div>
                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga Sewa (per jam)</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                            id="price" name="price" value="{{ old('price', $facility->price) }}" required>
                        @error('price')
                            <div class="invalid-feedback">Harga wajib diisi.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="account_name" class="form-label">Nama Pemilik Rekening</label>
                        <input type="text" class="form-control @error('account_name') is-invalid @enderror"
                            id="account_name" name="account_name" value="{{ old('account_name', $facility->account_name) }}"
                            required>
                        @error('account_name')
                            <div class="invalid-feedback">Nama pemilik rekening wajib diisi.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="account_number" class="form-label">Nomor Rekening</label>
                        <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                            id="account_number" name="account_number"
                            value="{{ old('account_number', $facility->account_number) }}" required>
                        @error('account_number')
                            <div class="invalid-feedback">Nomor rekening wajib diisi.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Bank</label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name"
                            name="bank_name" value="{{ old('bank_name', $facility->bank_name) }}" required>
                        @error('bank_name')
                            <div class="invalid-feedback">Nama bank wajib diisi.</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="banner" class="form-label">Banner Utama</label>
                        <input type="file" class="form-control @error('banner') is-invalid @enderror" id="banner"
                            name="banner" accept="image/*">
                        @error('banner')
                            <div class="invalid-feedback">File gambar tidak valid.</div>
                        @enderror

                        @if ($facility->banner)
                            <small class="d-block mt-2">Banner saat ini:</small>
                            <img src="{{ asset('storage/' . $facility->banner) }}" alt="Banner Fasilitas"
                                class="img-thumbnail" style="max-height: 150px;">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="images" class="form-label">Galeri Gambar (bisa lebih dari satu)</label>
                        <input type="file" class="form-control @error('images.*') is-invalid @enderror"
                            id="images" name="images[]" multiple accept="image/*">
                        @error('images.*')
                            <div class="invalid-feedback">File gambar tidak valid.</div>
                        @enderror

                        @php
                            $images = json_decode($facility->images) ?? [];
                        @endphp

                        @if (count($images) > 0)
                            <small class="d-block mt-2">Gambar Galeri saat ini:</small>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($images as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Galeri Fasilitas"
                                        class="img-thumbnail" style="max-height: 150px;">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="d-flex">
                        <button type="submit" class="btn btn-success ms-auto">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

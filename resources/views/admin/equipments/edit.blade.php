@extends('layouts.panel.main')

@section('main')
    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold text-center">Edit Peralatan</h2>

        <div class="card shadow-sm">
            <div class="card-header text-white py-3" style="background-color: teal;">
                <h5 class="mb-0"><i class="fas fa-toolbox me-2"></i> Form Edit Peralatan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.equipments.update', $equipment->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Peralatan</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $equipment->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">Nama peralatan wajib diisi.</div>
                        @enderror
                    </div>

                    <!-- Merek -->
                    <div class="mb-3">
                        <label for="brand" class="form-label">Merek</label>
                        <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand"
                            name="brand" value="{{ old('brand', $equipment->brand) }}" required>
                        @error('brand')
                            <div class="invalid-feedback">Merek wajib diisi.</div>
                        @enderror
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                            name="quantity" value="{{ old('quantity', $equipment->quantity) }}" required>
                        @error('quantity')
                            <div class="invalid-feedback">Jumlah wajib diisi dan harus berupa angka.</div>
                        @enderror
                    </div>

                    <!-- Fasilitas -->
                    <div class="mb-3">
                        <label for="facility_id" class="form-label">Fasilitas</label>
                        <select name="facility_id" id="facility_id"
                            class="form-select @error('facility_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Fasilitas --</option>
                            @foreach ($facilities as $facility)
                                <option value="{{ $facility->id }}"
                                    {{ old('facility_id', $equipment->facility_id) == $facility->id ? 'selected' : '' }}>
                                    {{ $facility->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('facility_id')
                            <div class="invalid-feedback">Fasilitas wajib dipilih.</div>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Foto Peralatan</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">File gambar tidak valid.</div>
                        @enderror

                        @if ($equipment->image)
                            <small class="d-block mt-2">Gambar saat ini:</small>
                            <img src="{{ asset('storage/' . $equipment->image) }}" alt="Foto Peralatan"
                                class="img-thumbnail" style="max-height: 150px;">
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

@extends('layouts.panel.main')

@section('main')
    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold text-center">Tambah Fasilitas Baru</h2>

        <!-- Formulir Create Fasilitas -->
        <div class="card shadow-sm">
            <div class="card-header text-white py-3" style="background-color: teal;">
                <h5 class="mb-0"><i class="fas fa-building me-2"></i> Form Tambah Fasilitas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Fasilitas</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                            name="location" value="{{ old('location') }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tipe -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe</label>
                        <input type="text" class="form-control @error('type') is-invalid @enderror" id="type"
                            name="type" value="{{ old('type') }}" required>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kapasitas -->
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Kapasitas</label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                            name="capacity" value="{{ old('capacity') }}" required>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Pemilik Rekening -->
                    <div class="mb-3">
                        <label for="account_name" class="form-label">Nama Pemilik Rekening</label>
                        <input type="text" class="form-control @error('account_name') is-invalid @enderror"
                            id="account_name" name="account_name" value="{{ old('account_name') }}" required>
                        @error('account_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nomor Rekening -->
                    <div class="mb-3">
                        <label for="account_number" class="form-label">Nomor Rekening</label>
                        <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                            id="account_number" name="account_number" value="{{ old('account_number') }}" required>
                        @error('account_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Bank -->
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Bank</label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name"
                            name="bank_name" value="{{ old('bank_name') }}" required>
                        @error('bank_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Banner Utama -->
                    <div class="mb-3">
                        <label for="banner" class="form-label">Banner Utama</label>
                        <input type="file" class="form-control @error('banner') is-invalid @enderror" id="banner"
                            name="banner" accept="image/*" required>
                        @error('banner')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Galeri Gambar -->
                    <div class="mb-3">
                        <label for="images" class="form-label">Galeri Gambar (bisa lebih dari satu)</label>
                        <input type="file" class="form-control @error('images.*') is-invalid @enderror" id="images"
                            name="images[]" multiple accept="image/*" required>
                        @error('images.*')
                            <div class="invalid-feedback">Setiap file harus berupa gambar.</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Tarif Per Kategori</label>
                        <div id="tariff-container">
                            <div class="row g-2 tariff-item mb-2">
                                <div class="col-md-2">
                                    <select name="tariffs[0][rental_type]" class="form-control" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Umum">Umum</option>
                                        <option value="Sosial">Sosial</option>
                                        <option value="Pembinaan">Pembinaan</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="tariffs[0][day_type]" class="form-control" required>
                                        <option value="">Hari</option>
                                        <option value="Weekday">Weekday</option>
                                        <option value="Weekend">Weekend</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="tariffs[0][time_type]" class="form-control" required>
                                        <option value="">Sesi</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam">Malam</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="tariffs[0][price]" class="form-control"
                                        placeholder="Harga (Rp)" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger remove-tariff w-100">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary" id="add-tariff">+ Tambah Tarif</button>
                    </div>

                    <div class="d-flex">
                        <button type="submit" class="btn btn-success ms-auto">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        let tariffIndex = 1;

        document.getElementById('add-tariff').addEventListener('click', function() {
            const container = document.getElementById('tariff-container');

            const html = `
        <div class="row g-2 tariff-item mb-3">
            <div class="col-md-2">
                <select name="tariffs[${tariffIndex}][rental_type]" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Umum">Umum</option>
                    <option value="Sosial">Sosial</option>
                    <option value="Pembinaan">Pembinaan</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="tariffs[${tariffIndex}][day_type]" class="form-control" required>
                    <option value="">Hari</option>
                    <option value="Weekday">Weekday</option>
                    <option value="Weekend">Weekend</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="tariffs[${tariffIndex}][time_type]" class="form-control" required>
                    <option value="">Sesi</option>
                    <option value="Siang">Siang</option>
                    <option value="Malam">Malam</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="tariffs[${tariffIndex}][price]" class="form-control" placeholder="Harga (Rp)" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-tariff w-100">Hapus</button>
            </div>
        </div>
        `;

            container.insertAdjacentHTML('beforeend', html);
            tariffIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-tariff')) {
                e.target.closest('.tariff-item').remove();
            }
        });
    </script>
@endsection

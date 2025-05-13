@extends('layouts.user.main')

@section('main-content')
    <div class="ajukan" style="height: 15vh"></div>
    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold text-center">Ajukan Reservasi Fasilitas</h2>

        <!-- Formulir Reservasi -->
        <div class="card shadow-sm m-5">
            <div class="card-header text-white py-3" style="background-color: teal;">
                <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i> Form Pengajuan Reservasi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user.reservasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Pilih Fasilitas -->
                    <div class="mb-3">
                        <label for="facility_id" class="form-label">Fasilitas</label>
                        <select name="facility_id" id="facility_id"
                            class="form-select @error('facility_id') is-invalid @enderror">
                            <option value="">Pilih Fasilitas</option>
                            @foreach ($facilities as $facility)
                                <option value="{{ $facility->id }}"
                                    data-image="{{ asset('storage/' . $facility->thumbnail_image) }}"
                                    {{ old('facility_id') == $facility->id ? 'selected' : '' }}>
                                    {{ $facility->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('facility_id')
                            <div class="invalid-feedback">Fasilitas wajib dipilih.</div>
                        @enderror
                    </div>

                    <!-- Preview Gambar -->
                    <div class="mb-3">
                        <label class="form-label">Preview Fasilitas</label><br>
                        <img id="facility-preview" src="" alt="Preview Fasilitas"
                            style="max-width: 100%; height: auto; display: none; border: 1px solid #ccc; padding: 5px;" />
                    </div>

                    <!-- Waktu Mulai -->
                    <div class="mb-3">
                        <label for="time_start" class="form-label">Waktu Mulai</label>
                        <input type="datetime-local" name="time_start" id="time_start"
                            class="form-control @error('time_start') is-invalid @enderror"
                            value="{{ old('time_start') ? date('Y-m-d\TH:i', strtotime(old('time_start'))) : '' }}">
                        @error('time_start')
                            <div class="invalid-feedback">Waktu mulai harus diisi dengan format yang benar.</div>
                        @enderror
                    </div>

                    <!-- Waktu Selesai -->
                    <div class="mb-3">
                        <label for="time_end" class="form-label">Waktu Selesai</label>
                        <input type="datetime-local" name="time_end" id="time_end"
                            class="form-control @error('time_end') is-invalid @enderror"
                            value="{{ old('time_end') ? date('Y-m-d\TH:i', strtotime(old('time_end'))) : '' }}">
                        @error('time_end')
                            <div class="invalid-feedback">Waktu selesai harus diisi dengan format yang benar.</div>
                        @enderror
                    </div>


                    <!-- Tujuan -->
                    <div class="mb-3">
                        <label for="purpose" class="form-label">Tujuan</label>
                        <textarea name="purpose" id="purpose" class="form-control @error('purpose') is-invalid @enderror" rows="3"
                            placeholder="Contoh: Latihan, Lomba, Kegiatan Mahasiswa">{{ old('purpose') }}</textarea>
                        @error('purpose')
                            <div class="invalid-feedback">Tujuan wajib diisi dan tidak boleh kosong.</div>
                        @enderror
                    </div>

                    <!-- Surat Pengajuan -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Bukti</label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">Surat pengajuan harus berupa gambar dengan format yang benar.</div>
                        @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-flex">
                        <button type="submit" class="btn btn-success ms-auto">Ajukan Reservasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('facility_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const imageUrl = selectedOption.getAttribute('data-image');
            const preview = document.getElementById('facility-preview');

            if (imageUrl) {
                preview.src = imageUrl;
                preview.style.display = 'block';
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });

        window.addEventListener('DOMContentLoaded', function() {
            document.getElementById('facility_id').dispatchEvent(new Event('change'));
        });
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            // Set waktu sekarang dalam format YYYY-MM-DDTHH:MM
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const formatted = `${year}-${month}-${day}T${hours}:${minutes}`;

            // Atur atribut min untuk kedua input waktu
            document.getElementById('time_start').setAttribute('min', formatted);
            document.getElementById('time_end').setAttribute('min', formatted);
        });
    </script>
@endsection

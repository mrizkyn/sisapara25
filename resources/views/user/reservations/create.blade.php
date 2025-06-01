@extends('layouts.user.main')

@section('main-content')
    <div class="ajukan" style="height: 15vh"></div>
    <div class="container-fluid mt-4">
        <h2 class="mb-4 fw-bold text-center">Ajukan Reservasi Fasilitas</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header text-white py-3" style="background-color: teal;">
                        <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i> Form Pengajuan Reservasi</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.reservasi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="facility_id" class="form-label">Fasilitas</label>
                                <select name="facility_id" id="facility_id"
                                    class="form-select @error('facility_id') is-invalid @enderror">
                                    <option value="">Pilih Fasilitas</option>
                                    @foreach ($facilities as $facility)
                                        <option value="{{ $facility->id }}"
                                            data-image="{{ asset('storage/' . $facility->banner) }}"
                                            data-bank="{{ $facility->bank_name }}"
                                            data-account="{{ $facility->account_number }}"
                                            data-name="{{ $facility->account_name }}" data-price="{{ $facility->price }}"
                                            {{ old('facility_id') == $facility->id ? 'selected' : '' }}>
                                            {{ $facility->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('facility_id')
                                    <div class="invalid-feedback">Fasilitas wajib dipilih.</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="row g-3 align-items-stretch">
                                    <div class="col-md-6 d-flex flex-column">
                                        <label class="form-label">Preview Fasilitas</label>
                                        <div class="border rounded flex-grow-1 d-flex align-items-center justify-content-center"
                                            style="background-color: #fdfdfd; min-height: 400px; ">
                                            <img id="facility-preview" src="" alt="Preview Fasilitas"
                                                class="img-fluid"
                                                style="width: 100%; height: 400px; display: none; border: 1px solid #ccc; padding: 5px; object-fit: cover;" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex flex-column">
                                        <label class="form-label">Informasi Pembayaran</label>
                                        <div class="border rounded p-3 flex-grow-1 d-flex flex-column justify-content-start"
                                            style="background-color: #f8f9fa;">
                                            <p class="mb-1"><strong>Bank:</strong> <span id="bank-name">-</span></p>
                                            <p class="mb-1"><strong>No. Rekening:</strong> <span
                                                    id="account-number">-</span></p>
                                            <p class="mb-1"><strong>Atas Nama:</strong> <span id="account-name">-</span>
                                            </p>
                                            <p class="mb-1"><strong>Harga / Jam:</strong> <span id="price-hour">Rp
                                                    0</span></p>
                                            <p class="mb-0"><strong>Total Bayar:</strong> <span id="total-display">Rp
                                                    0</span></p>
                                            <input type="hidden" name="total_payment" id="total_payment_raw">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="time_start" class="form-label">Waktu Mulai</label>
                                <input type="text" name="time_start" id="time_start"
                                    class="form-control @error('time_start') is-invalid @enderror"
                                    value="{{ old('time_start') }}" autocomplete="off">
                                @error('time_start')
                                    <div class="invalid-feedback">Waktu mulai harus lebih awal dari waktu selesai.</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="time_end" class="form-label">Waktu Selesai</label>
                                <input type="text" name="time_end" id="time_end"
                                    class="form-control @error('time_end') is-invalid @enderror"
                                    value="{{ old('time_end') }}" autocomplete="off">
                                @error('time_end')
                                    <div class="invalid-feedback">Minimal jarak antara waktu mulai dan selesai adalah 1 jam.
                                    </div>
                                </div>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label for="purpose" class="form-label">Tujuan</label>
                        <textarea name="purpose" id="purpose" class="form-control @error('purpose') is-invalid @enderror" rows="3"
                            placeholder="Contoh: Latihan, Lomba, Kegiatan Mahasiswa">{{ old('purpose') }}</textarea>
                        @error('purpose')
                            <div class="invalid-feedback">Tujuan wajib diisi dan tidak boleh kosong.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Bukti</label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">Bukti pembayaran harus berupa gambar dengan format yang benar.
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex">
                        <button type="submit" class="btn btn-success ms-auto">Ajukan Reservasi</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('script')
        <script>
            // Update preview gambar dan info pembayaran saat fasilitas dipilih
            document.getElementById('facility_id').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                // Image preview
                const imageUrl = selectedOption.getAttribute('data-image');
                const preview = document.getElementById('facility-preview');
                if (imageUrl) {
                    preview.src = imageUrl;
                    preview.style.display = 'block';
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }

                // Informasi pembayaran
                document.getElementById('bank-name').textContent = selectedOption.getAttribute('data-bank') || '-';
                document.getElementById('account-number').textContent = selectedOption.getAttribute('data-account') ||
                    '-';
                document.getElementById('account-name').textContent = selectedOption.getAttribute('data-name') || '-';

                const price = parseInt(selectedOption.getAttribute('data-price')) || 0;
                document.getElementById('price-hour').textContent = price.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                });

                // Hitung total bayar jika waktu sudah diisi
                hitungTotalBayar(price);
            });

            // Flatpickr initialization
            const startPicker = flatpickr("#time_start", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minuteIncrement: 60,
                minDate: "today",
                onChange: function(selectedDates) {
                    if (selectedDates.length > 0) {
                        const startDate = selectedDates[0];
                        const endPicker = document.querySelector("#time_end")._flatpickr;
                        if (endPicker) {
                            const endDate = endPicker.selectedDates[0] || new Date();
                            endDate.setMinutes(startDate.getMinutes());
                            endPicker.setDate(endDate, false);
                        }
                        const facilitySelect = document.getElementById('facility_id');
                        const price = parseInt(facilitySelect.options[facilitySelect.selectedIndex].getAttribute(
                            'data-price')) || 0;
                        hitungTotalBayar(price);
                    }
                }
            });

            const endPicker = flatpickr("#time_end", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minuteIncrement: 60,
                minDate: "today",
                onChange: function(selectedDates) {
                    if (selectedDates.length > 0) {
                        const endDate = selectedDates[0];
                        const startPicker = document.querySelector("#time_start")._flatpickr;
                        if (startPicker) {
                            const startMinutes = startPicker.selectedDates[0] ?
                                startPicker.selectedDates[0].getMinutes() :
                                0;
                            endDate.setMinutes(startMinutes);
                            this.setDate(endDate, false);
                        }
                        const facilitySelect = document.getElementById('facility_id');
                        const price = parseInt(facilitySelect.options[facilitySelect.selectedIndex].getAttribute(
                            'data-price')) || 0;
                        hitungTotalBayar(price);
                    }
                }
            });

            // Fungsi untuk hitung total bayar berdasarkan durasi jam * harga per jam
            function hitungTotalBayar(pricePerHour) {
                const start = document.getElementById('time_start').value;
                const end = document.getElementById('time_end').value;
                if (!start || !end) {
                    updateTotalDisplay(0);
                    return;
                }

                const startDate = new Date(start);
                const endDate = new Date(end);

                if (endDate <= startDate) {
                    updateTotalDisplay(0);
                    return;
                }

                // Hitung durasi dalam jam (bulatkan ke atas)
                let diffMs = endDate - startDate;
                let diffHours = diffMs / (1000 * 60 * 60);
                diffHours = Math.ceil(diffHours);

                const total = pricePerHour * diffHours;
                updateTotalDisplay(total);
            }

            function updateTotalDisplay(total) {
                document.getElementById('total-display').textContent = total.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                });
                document.getElementById('total_payment_raw').value = total;
            }

            // Trigger onchange sekali saat page load jika sudah ada pilihan lama
            window.addEventListener('DOMContentLoaded', function() {
                document.getElementById('facility_id').dispatchEvent(new Event('change'));
            });
        </script>
    @endpush
@endsection

@extends('layouts.panel.main')

@section('main')
    <div class="ajukan"></div>
    <div class="container-fluid">
        <h2 class="mb-4 fw-bold text-center">📋 Buat Reservasi</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header text-white py-3" style="background-color: teal;">
                        <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i> Form Reservasi</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('superadmin.reservasi.store') }}" method="POST"
                            enctype="multipart/form-data">
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
                                            data-name="{{ $facility->account_name }}"
                                            data-tariffs='@json($facility->tariffs)'
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
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="purpose" class="form-label">Tujuan</label>
                                <textarea name="purpose" id="purpose" class="form-control @error('purpose') is-invalid @enderror" rows="3">{{ old('purpose') }}</textarea>
                                @error('purpose')
                                    <div class="invalid-feedback">Tujuan wajib diisi.</div>
                                @enderror
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-success ms-auto">Simpan Reservasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                flatpickr("#time_start", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    time_24hr: true,
                    minuteIncrement: 60,
                    minDate: "today",
                    onChange: triggerRecalculate
                });

                flatpickr("#time_end", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    time_24hr: true,
                    minuteIncrement: 60,
                    minDate: "today",
                    onChange: triggerRecalculate
                });
            });
        </script>
        <script>
            document.getElementById('facility_id').addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                const preview = document.getElementById('facility-preview');

                // Preview Gambar
                const imageUrl = selected.getAttribute('data-image');
                preview.src = imageUrl || '';
                preview.style.display = imageUrl ? 'block' : 'none';

                // Bank Info
                document.getElementById('bank-name').textContent = selected.getAttribute('data-bank') || '-';
                document.getElementById('account-number').textContent = selected.getAttribute('data-account') || '-';
                document.getElementById('account-name').textContent = selected.getAttribute('data-name') || '-';

                // Tariff Dropdown
                const tariffSelect = document.getElementById('tariff-select');
                tariffSelect.innerHTML = '<option value="">Pilih Kategori...</option>';
                const tariffsRaw = selected.getAttribute('data-tariffs');
                try {
                    const tariffs = JSON.parse(tariffsRaw) || [];
                    tariffs.forEach(tariff => {
                        const opt = document.createElement('option');
                        opt.value = tariff.id;
                        opt.setAttribute('data-price', tariff.price);
                        opt.textContent =
                            `${tariff.day_type} - ${tariff.rental_type} - ${tariff.time_type} - Rp ${parseInt(tariff.price).toLocaleString('id-ID')}`;
                        tariffSelect.appendChild(opt);
                    });
                } catch (e) {
                    console.error('Tariff JSON parse error:', e);
                }

                // Reset harga
                document.getElementById('price-hour').textContent = 'Rp 0';
                updateTotalDisplay(0);
            });

            // document.getElementById('tariff-select').addEventListener('change', triggerRecalculate);
            document.getElementById('tariff-select').addEventListener('change', function() {
                triggerRecalculate();

                // Cek apakah kategori adalah "pembinaan" atau "sosial"
                const selectedText = this.options[this.selectedIndex]?.textContent?.toLowerCase() || '';
                const showExtra = selectedText.includes('pembinaan') || selectedText.includes('sosial');
                const extraImageGroup = document.getElementById('additional-image-group');
                if (extraImageGroup) {
                    extraImageGroup.classList.toggle('d-none', !showExtra);
                }
            });


            function triggerRecalculate() {
                const tariffSelect = document.getElementById('tariff-select');
                const selectedOption = tariffSelect.options[tariffSelect.selectedIndex];
                const price = parseInt(selectedOption.getAttribute('data-price')) || 0;

                document.getElementById('price-hour').textContent = price.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                });
                document.getElementById('selected_tariff_price').value = price;
                document.getElementById('facility_tariff_id').value = tariffSelect.value;

                hitungTotalBayar(price);
            }

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

                let diffHours = Math.ceil((endDate - startDate) / (1000 * 60 * 60));
                const total = pricePerHour * diffHours;
                updateTotalDisplay(total);
            }

            function updateTotalDisplay(total) {
                document.getElementById('total-display').textContent = total.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                });
                document.getElementById('total_payment_raw').value = total;
            }

            window.addEventListener('DOMContentLoaded', function() {
                document.getElementById('facility_id').dispatchEvent(new Event('change'));
            });
        </script>
    @endpush
@endsection

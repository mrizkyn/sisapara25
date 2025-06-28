@extends('layouts.panel.main')

@section('main')
    <div class="container py-5">

        <div class="row g-4 mb-5 align-items-stretch">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <img src="{{ asset('storage/' . $facility->banner) }}" alt="{{ $facility->name }}" class="img-fluid w-100"
                        style="height: 100%; object-fit: cover; max-height: 300px;">
                </div>
            </div>

            <div class="col-md-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <h1 class="fs-2 fw-bold text-dark mb-4">{{ $facility->name }}</h1>

                        <div class="row gy-3 mb-4">
                            <div class="col-sm-4">
                                <div class="d-flex align-items-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle me-3"
                                        style="width: 48px; height: 48px;">
                                        <i class="bi bi-people-fill text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Kapasitas</div>
                                        <h5 class="mb-0">{{ $facility->capacity }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="d-flex align-items-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle me-3"
                                        style="width: 48px; height: 48px;">
                                        <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Lokasi</div>
                                        <h5 class="mb-0">{{ $facility->location }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="d-flex align-items-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle me-3"
                                        style="width: 48px; height: 48px;">
                                        <i class="bi bi-bank text-warning fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Pembayaran ke</div>
                                        <h6 class="mb-0">{{ $facility->account_name }}</h6>
                                        <small class="text-muted d-block">
                                            {{ $facility->bank_name }} - {{ $facility->account_number }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-light p-4 rounded-3">
                            <h5 class="fw-semibold mb-2">Deskripsi</h5>
                            <p class="text-muted mb-0">{{ $facility->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($tariffGroups->count())
            <div class="mt-5">
                <h4 class="fw-bold mb-4 text-dark">Daftar Tarif Sewa</h4>
                <div class="row g-3">
                    @foreach ($tariffGroups as $rentalType => $tariffs)
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body">
                                    <div class="mb-3 d-flex align-items-center">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle me-3"
                                            style="width: 48px; height: 48px;">
                                            <i class="bi bi-clock-history text-success fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-semibold mb-0">{{ $rentalType }}</h6>
                                            <small class="text-muted">Tarif yang tersedia:</small>
                                        </div>
                                    </div>

                                    @foreach ($tariffs as $tariff)
                                        <div class="mb-2">
                                            <small class="text-muted d-block">{{ $tariff->day_type }} -
                                                {{ $tariff->time_type }}</small>
                                            <span class="fw-bold text-success">Rp
                                                {{ number_format($tariff->price, 0, ',', '.') }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif


        @if (!empty($facility->images))
            <section class="pt-5 px-2">
                <h4 class="fw-semibold mb-4 text-center text-dark">Galeri Fasilitas</h4>
                <div class="swiper mySwiper px-2 pb-5">
                    <div class="swiper-wrapper">
                        @foreach (json_decode($facility->images) as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery {{ $facility->name }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="height: 280px; object-fit: cover; width: 100%; transition: transform 0.3s ease;"
                                    onmouseover="this.style.transform='scale(1.03)';"
                                    onmouseout="this.style.transform='scale(1)';">
                            </div>
                        @endforeach
                        @foreach (json_decode($facility->images) as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery {{ $facility->name }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="height: 280px; object-fit: cover; width: 100%; transition: transform 0.3s ease;"
                                    onmouseover="this.style.transform='scale(1.03)';"
                                    onmouseout="this.style.transform='scale(1)';">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </section>
        @endif
    </div>

    @push('script')
        <script>
            const swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                breakpoints: {
                    576: {
                        slidesPerView: 1.2
                    },
                    768: {
                        slidesPerView: 2
                    },
                    992: {
                        slidesPerView: 3
                    }
                }
            });
        </script>
    @endpush
@endsection

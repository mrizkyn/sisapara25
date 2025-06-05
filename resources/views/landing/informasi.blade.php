@extends('layouts.user.main')
@section('title', '| Informasi')
@section('main-content')
    <section class="hero-fasilitas">
        <style>
            .hero-fasilitas {
                background: url('{{ asset('img/bg-tenis.jpg') }}') no-repeat center center;
                background-size: cover;
                height: 100vh;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
            }

            .hero::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
                background: rgba(0, 0, 0, 0.5);
                /* Overlay gelap */
                z-index: 1;
            }

            .hero-content {
                position: relative;
                z-index: 2;
                text-align: center;
            }

            .hero-fasilitas h1 {
                font-size: 3rem;
                font-weight: bold;
            }

            .hero-fasilitas p {
                font-size: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .hero-fasilitas .btn {
                font-weight: 600;
                padding: 0.75rem 1.5rem;
                border-radius: 2rem;
            }

            @media (max-width: 768px) {
                .hero-fasilitas h1 {
                    font-size: 2rem;
                }

                .hero-fasilitas p {
                    font-size: 1rem;
                }
            }
        </style>

        <div class="hero-content container">
            <h1>Sarana & Prasarana Olahraga</h1>
            <p>Informasi lengkap seputar fasilitas olahraga untuk menunjang aktivitas dan prestasi Anda.</p>
            <a href="{{ route('reservasi') }}" class="btn btn-light">Jelajahi Fasilitas</a>
        </div>
    </section>


    <section class="container my-2 ">
        <style>
            .section-title {
                text-align: center;
                margin-bottom: 2rem;
            }

            .swiper {
                padding-bottom: 40px;
            }

            .swiper-slide {
                background: #fff;
                border-radius: 5px;
                overflow: hidden;
                box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            }

            .sarana-card img {
                width: 100%;
                height: 250px;
                object-fit: cover;
            }

            .sarana-card .card-body {
                padding: 1rem;
            }

            .sarana-card h5 {
                font-weight: 600;
            }

            .swiper-button-next,
            .swiper-button-prev {
                color: #000;
            }
        </style>
        <div class="container my-5">
            <div class="text-start mb-4"> <small class="text-muted">// Sarana dan Prasarana</small>
                <h2 class="fw-bold">Kenali Fasilitas Kami <br><span style="color: #016974">Lapangan, Kolam, dan
                        Lainnya</span>
                </h2>
                <p class="w-75">Kami menyediakan berbagai fasilitas olahraga yang mendukung kegiatan rekreasi hingga
                    pembinaan prestasi. Temukan tempat yang tepat untuk berolahraga dan berkembang.</p>
            </div>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($facilities as $facility)
                        <div class="swiper-slide">
                            <div class="sarana-card">
                                <img src="{{ asset('storage/' . $facility->banner) }}" alt="{{ $facility->name }}" />
                                <div class="card-body">
                                    <h5>{{ $facility->name }}</h5>
                                    <p>Kap. Maksimal: {{ $facility->capacity }} orang</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigasi -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <style>
        .section-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: start;
        }

        .desc-text {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .img-box {
            position: relative;
            min-height: 320px;
            margin-bottom: 1.5rem;
        }

        .img-box img {
            border-radius: 1rem;
            object-fit: cover;
        }

        .img-1 {
            position: absolute;
            width: 200px;
            height: 240px;
            left: 40px;
            bottom: 0;
            z-index: 1;
        }

        .img-2 {
            position: absolute;
            width: 200px;
            height: 240px;
            left: 140px;
            top: 0;
            z-index: 2;
        }

        .learn-more-btn {
            background-color: #d5ff30;
            border-radius: 999px;
            padding: 0.5rem 1.2rem;
            border: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .learn-more-btn:hover {
            background-color: #b0e000;
        }

        .arrow-btn {
            background-color: #d5ff30;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .arrow-btn:hover {
            transform: translateX(5px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .img-box {
                min-height: 280px;
            }

            .img-1 {
                width: 200px;
                height: 180px;
                left: 0;
                bottom: 0;
            }

            .img-2 {
                width: 160px;
                height: 200px;
                left: 70px;
                top: 0;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .img-2 {
                left: 50%;
                transform: translateX(-50%);
            }

            .section-title {
                text-align: center;
            }

            .learn-more-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
    <section class="fasilitas">
        <div class="container p-5" style="background-color: #016974 ; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; ">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="img-box">
                        <img src="{{ asset('img/futsal.jpg') }}" alt="img1" class="img-1">
                        <img src="{{ asset('img/basket1.jpg') }}" alt="img2" class="img-2">
                    </div>
                </div>
                <div class="col-md-8 mt-4 mt-md-0">
                    <h3 class="fw-bold text-white section-title">Infrastruktur Berkualitas</h3>
                    <p class="desc-text text-white">
                        Setiap fasilitas kami dirancang dengan standar terbaik untuk kenyamanan dan keamanan
                        pengguna. Mulai
                        dari lapangan, kolam, hingga area pelatihan—semuanya disiapkan untuk mendukung aktivitas
                        olahraga
                        secara
                        optimal.
                    </p>
                    <a href="{{ route('reservasi') }}" class="learn-more-btn mt-2 text-black" style="text-decoration: none">
                        Selengkapnya
                        →</a>
                </div>
            </div>
        </div>
    </section>
    <style>
        .menu-img {
            height: 350px;
            object-fit: cover;
            border-radius: 10px;
        }

        .menu-card {
            overflow: hidden;
            border-radius: 10px;
        }

        .label {
            position: absolute;
            bottom: 10px;
            left: 15px;
            background-color: white;
            padding: 5px 10px;
            font-weight: 500;
            font-size: 14px;
            border-radius: 5px;
        }
    </style>

    <div class="container p-4 pt-5">
        <div class="row align-items-center">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <small class="text-muted">//Sarana & Fasilitas</small>
                <h2 class="fw-bold">JELAJAHI<br><span style="color: #016974">SARANA KAMI</span></h2>
                <p class="text-muted">Berbagai sarana olahraga tersedia untuk mendukung aktivitas dan pengembangan
                    bakat Anda.</p>
            </div>
            <div class="col-lg-8">
                <div class="row g-3">
                    @foreach ($equipments as $equipment)
                        <div class="col-md-4">
                            <div class="position-relative menu-card">
                                <img src="{{ asset('storage/' . $equipment->image) }}" alt="{{ $equipment->name }}"
                                    class="w-100 menu-img">
                                <span class="label">{{ $equipment->name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-img-top {
            max-height: 400px;
            object-fit: contain;
            border-bottom: 2px solid #f1f1f1;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }

        .card-text {
            font-size: 1rem;
            color: #333;
        }

        ul.list-group {
            padding-left: 0;
        }

        ul.list-group li {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        ul.list-group li:hover {
            background-color: #f4f4f4;
        }

        @media (max-width: 768px) {

            .col-md-8,
            .col-md-4 {
                padding-left: 0;
                padding-right: 0;
            }

            .card-img-top {
                height: 180px;
            }
        }
    </style>
    <section class="p-3">
        <div class="container">
            <div class="row text-start">
                <!-- Kiri: Artikel Terbaru -->
                <div class="col-md-8 mb-4">
                    @if ($latest)
                        <div class="card shadow-sm border-light rounded">
                            @if ($latest->image)
                                <img src="{{ asset('storage/' . $latest->image) }}" class="card-img-top"
                                    alt="Artikel Terbaru">
                            @endif
                            <div class="card-body">
                                <h3 class="card-title text-primary">{{ $latest->title }}</h3>
                                <p class="card-text">{!! Str::limit($latest->content, 300) !!}</p>

                                <p class="text-muted">Ditulis oleh: {{ $latest->user->name }}</p>
                                <!-- Menampilkan nama user -->
                                <a href="{{ route('article.show', $latest->slug) }}" class="btn btn-outline-primary">Baca
                                    Selengkapnya</a>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mt-3">
                            Belum ada artikel.
                        </div>
                    @endif
                </div>

                <!-- Kanan: List Artikel Sebelumnya -->
                <div class="col-md-4">
                    <h5 class="text-secondary mb-3">Artikel Sebelumnya</h5>
                    <ul class="list-group">
                        @foreach ($others as $article)
                            <li class="list-group-item mb-2">
                                <a href="{{ route('article.show', $article->slug) }}"
                                    class="text-decoration-none text-dark">
                                    {{ $article->title }} <br> <small class="text-muted">oleh
                                        {{ $article->user->name }}</small>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>



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

@extends('layouts.user.main')
@section('title', '| Informasi')

@push('css')
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

        p.small {
            color: #f1f1f1 !important;
        }

        .list-group-item {
            border-radius: 8px;
            padding: 15px;
            transition: background-color 0.3s ease;
        }

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

        .swiper {
            padding-bottom: 40px;
        }

        .swiper-slide {
            background: transparent;
            box-shadow: none;
            height: auto;
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

        .article-section {
            padding-top: 5rem;
            padding-bottom: 5rem;
            background-color: #f8f9fa;
        }

        .featured-article-card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .featured-article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .featured-article-card .card-img-top {
            max-height: 450px;
            object-fit: cover;
        }

        .featured-article-card .card-body {
            padding: 2rem;
        }

        .article-meta {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .article-sidebar {
            background-color: #016974;
            padding: 2rem;
            border-radius: 15px;
            position: static;
        }


        .article-sidebar .list-group-item {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 0.75rem !important;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .article-sidebar .list-group-item:hover {
            background-color: #ffffff;
            transform: translateX(5px);
        }

        .article-sidebar .list-group-item a {
            text-decoration: none;
            color: #212529;
            font-weight: 600;
        }

        .article-sidebar .list-group-item small {
            font-weight: 400;
            display: block;
            color: #6c757d !important;
        }

        @media (max-width: 768px) {
            .hero-fasilitas h1 {
                font-size: 2rem;
            }

            .hero-fasilitas p {
                font-size: 1rem;
            }

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
@endpush

@section('main-content')
    <section class="hero-fasilitas">
        <div class="hero-content container">
            <h1>Sarana & Prasarana Olahraga</h1>
            <p>Informasi lengkap seputar fasilitas olahraga untuk menunjang aktivitas dan prestasi Anda.</p>
            <a href="{{ route('reservasi') }}" class="btn btn-light">Jelajahi Fasilitas</a>
        </div>
    </section>

    <section class="article-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-start">
                    {{-- <small class="text-muted">// ARTIKEL TERBARU</small> --}}
                    <h2 class="fw-bold">Baca Wawasan & Info Terbaru<br><span style="color: #016974">dari Kami</span></h2>
                    <p class="w-75 text-muted">Dapatkan informasi terkini seputar kegiatan, tips, dan wawasan menarik
                        melalui artikel
                        yang kami sajikan.</p>
                </div>
            </div>

            <div class="row">
                {{-- Artikel Utama --}}
                <div class="col-lg-8 mb-4 mb-lg-0">
                    @if ($latest)
                        <div class="card shadow-sm featured-article-card">
                            @if ($latest->image)
                                <img src="{{ asset('storage/' . $latest->image) }}" class="card-img-top"
                                    alt="Gambar Artikel {{ $latest->title }}">
                            @endif
                            <div class="card-body">
                                <h3 class="card-title fw-bold mb-3" style="color: #016974;">{{ $latest->title }}</h3>
                                <div class="article-meta">
                                    <span>Ditulis oleh: <strong>{{ $latest->user->name }}</strong></span> |
                                    <span>{{ $latest->created_at ? $latest->created_at->translatedFormat('l, d F Y') : '' }}</span>
                                </div>
                                <p class="card-text text-muted">{!! Str::limit(strip_tags($latest->content), 280) !!}</p>
                                <a href="{{ route('article.show', $latest->slug) }}" class="btn btn-outline-primary mt-3">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">Belum ada artikel untuk ditampilkan.</div>
                    @endif
                </div>

                {{-- Sidebar Artikel Lainnya --}}
                <div class="col-lg-4">
                    <div class="article-sidebar">
                        <h5 class="text-white fw-bold mb-4">Artikel Lainnya</h5>
                        @if ($others->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach ($others as $article)
                                    <li class="list-group-item">
                                        <a href="{{ route('article.show', $article->slug) }}">
                                            {{ $article->title }}
                                            <small>oleh {{ $article->user->name }}</small>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-white-50">Tidak ada artikel lainnya.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fasilitas">
        <div class="container p-5" style="background-color: #016974 ; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="img-box">
                        <img src="{{ asset('img/futsal.jpg') }}" alt="img1" class="img-1">
                        <img src="{{ asset('img/basket1.jpg') }}" alt="img2" class="img-2">
                    </div>
                </div>
                <div class="col-md-8 mt-4 mt-md-0">
                    <h3 class="fw-bold text-white section-title">Infrastruktur Berkualitas</h3>
                    <p class="desc-text text-white">Setiap fasilitas kami dirancang dengan standar terbaik untuk kenyamanan
                        dan keamanan pengguna...</p>
                    <a href="{{ route('reservasi') }}" class="learn-more-btn mt-2 text-black"
                        style="text-decoration: none">
                        Selengkapnya →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="container p-4 pt-5">
        <div class="row align-items-center">
            <div class="col-lg-4 mb-4 mb-lg-0">
                {{-- <small class="text-muted">//Sarana & Fasilitas</small> --}}
                <h2 class="fw-bold">JELAJAHI<br><span style="color: #016974">SARANA KAMI</span></h2>
                <p class="text-muted">Berbagai sarana olahraga tersedia untuk mendukung aktivitas dan pengembangan bakat
                    Anda.</p>
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

    <section class="container my-2 ">
        <div class="container my-5">
            <div class="text-start mb-4">
                {{-- <small class="text-muted">// Sarana dan Prasarana</small> --}}
                <h2 class="fw-bold">Kenali Fasilitas Kami <br><span style="color: #016974">Lapangan, Kolam, dan
                    </span> <a href="{{ url('/reservasi') }}" style="color: #016974">Lainnya</a> </h2>
                <p class="w-75">Kami menyediakan berbagai fasilitas olahraga yang mendukung kegiatan rekreasi hingga
                    pembinaan prestasi. <a href="{{ url('/reservasi') }}" style="color: #016974">(Selengkapnya)</a></p>
            </div>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper p-2">
                    @foreach ($facilities as $facility)
                        <div class="swiper-slide">
                            <div class="sarana-card">
                                <img src="{{ asset('storage/' . $facility->banner) }}" alt="{{ $facility->name }}">
                                <div class="card-body">
                                    <h5>{{ $facility->name }}</h5>
                                    <p>Kap. Maksimal: {{ $facility->capacity }} orang</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>
@endsection

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

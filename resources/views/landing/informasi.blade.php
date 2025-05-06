@extends('layouts.user.main')
@section('title', '| Informasi')
@section('main-content')
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


    <section class="hero-fasilitas">
        <div class="hero-content container">
            <h1>Sarana & Prasarana Olahraga</h1>
            <p>Informasi lengkap seputar fasilitas olahraga untuk menunjang aktivitas dan prestasi Anda.</p>
            <a href="#fasilitas" class="btn btn-light">Jelajahi Fasilitas</a>

        </div>
    </section>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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

    <section class="container my-2 ">
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

                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="sarana-card">
                            <img src="{{ asset('img/basket.jpg') }}" alt="Kolam Renang" />
                            <div class="card-body">
                                <h5>Kolam Renang</h5>
                                <p>Fasilitas kolam renang standar nasional untuk latihan dan rekreasi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="sarana-card">
                            <img src="{{ asset('img/bola.jpg') }}" alt="Lapangan Futsal" />
                            <div class="card-body">
                                <h5>Lapangan Futsal</h5>
                                <p>Lapangan indoor berstandar internasional dengan pencahayaan modern.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <div class="sarana-card">
                            <img src="{{ asset('img/bet-tenis.jpg') }}" alt="Lapangan Basket" />
                            <div class="card-body">
                                <h5>Lapangan Basket</h5>
                                <p>Area outdoor luas untuk latihan dan pertandingan basket.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Navigasi -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
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
        <div class="container p-5"
            style="background-color: #016974 ;border-radius:5px;  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; ">
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
                        Setiap fasilitas kami dirancang dengan standar terbaik untuk kenyamanan dan keamanan pengguna. Mulai
                        dari lapangan, kolam, hingga area pelatihan—semuanya disiapkan untuk mendukung aktivitas olahraga
                        secara
                        optimal.
                    </p>
                    <a href="http://" class="learn-more-btn mt-2 text-black" style="text-decoration: none"> Selengkapnya
                        →</a>
                </div>
            </div>
        </div>
    </section>



@endsection

@extends('layouts.user.main')
@section('title', '| Informasi')
@section('main-content')
    <style>
        .hero-fasilitas {
            background: url('https://plus.unsplash.com/premium_photo-1666913667023-4bfd0f6cff0a?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTU3fHxzcG9ydHN8ZW58MHx8MHx8fDA%3D') no-repeat center center;
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
            <h1>Fasilitas Olahraga Lengkap</h1>
            <p>Temukan sarana dan prasarana terbaik untuk mendukung setiap semangat dan gaya hidup aktifmu.</p>
            <a href="#fasilitas" class="btn btn-light">Lihat Fasilitas</a>
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
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .sarana-card img {
            width: 100%;
            height: 200px;
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


    <section class="container my-5">
        <div class="section-title">
            <h2>Fasilitas Unggulan Kami</h2>
            <p> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Optio voluptatum non explicabo aliquid quas
                temporibus.</p>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="sarana-card">
                        <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Kolam Renang" />
                        <div class="card-body">
                            <h5>Kolam Renang</h5>
                            <p>Fasilitas kolam renang standar nasional untuk latihan dan rekreasi.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="sarana-card">
                        <img src="https://plus.unsplash.com/premium_photo-1666913667023-4bfd0f6cff0a?w=600"
                            alt="Lapangan Futsal" />
                        <div class="card-body">
                            <h5>Lapangan Futsal</h5>
                            <p>Lapangan indoor berstandar internasional dengan pencahayaan modern.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="sarana-card">
                        <img src="https://images.unsplash.com/photo-1599058917212-d750089bc07e?w=600"
                            alt="Lapangan Basket" />
                        <div class="card-body">
                            <h5>Lapangan Basket</h5>
                            <p>Area outdoor luas untuk latihan dan pertandingan basket.</p>
                        </div>
                    </div>
                </div>
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="sarana-card">
                        <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Kolam Renang" />
                        <div class="card-body">
                            <h5>Kolam Renang</h5>
                            <p>Fasilitas kolam renang standar nasional untuk latihan dan rekreasi.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="sarana-card">
                        <img src="https://plus.unsplash.com/premium_photo-1666913667023-4bfd0f6cff0a?w=600"
                            alt="Lapangan Futsal" />
                        <div class="card-body">
                            <h5>Lapangan Futsal</h5>
                            <p>Lapangan indoor berstandar internasional dengan pencahayaan modern.</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="sarana-card">
                        <img src="https://images.unsplash.com/photo-1599058917212-d750089bc07e?w=600"
                            alt="Lapangan Basket" />
                        <div class="card-body">
                            <h5>Lapangan Basket</h5>
                            <p>Area outdoor luas untuk latihan dan pertandingan basket.</p>
                        </div>
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

@endsection

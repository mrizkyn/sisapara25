@extends('layouts.user.main')
@section('title', '| Home')
@push('css')
    <style>
        .bg-gray {
            background-color: #f5f5f5;
        }

        .btn-outline-dark {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
        }

        .mySwiper1,
        .mySwiper2 {
            width: 100%;
            max-width: 300px;
            height: 400px;
            margin: 0 auto;
        }

        .mySwiper1 .swiper-slide img,
        .mySwiper2 .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 18px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 2rem;
        }

        .swiper {
            padding-bottom: 40px;
        }

        .swiper-slide {
            background: transparent;
            box-shadow: none;
            height: auto;
        }

        .artikel-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .artikel-card .card-body {
            padding: 1rem;
        }

        .artikel-card h5 {
            font-weight: 600;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #000;
        }

        .article-card-custom {
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .article-card-custom:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12), 0 4px 8px rgba(0, 0, 0, 0.06);
        }

        .article-card-custom .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .article-card-custom .card-title {
            font-weight: 600;
            min-height: 48px;
        }

        .article-card-custom .card-body {
            padding: 1.25rem;
        }

        .swiper-wrapper {
            align-items: stretch;
        }

        .swiper-slide {
            height: auto;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #016974;
            font-weight: bold;
        }

        @media (max-width: 768px) {

            .article-card-custom .card-title {
                font-size: 1.1rem;
                min-height: 44px;
            }
        }

        @media (max-width: 768px) {
            .swiper {
                max-width: 70%;
                height: 300px;
            }
        }
    </style>
@endpush

@section('main-content')
    <section class="hero Patterns">
        <div class="hero-text">
            <h1>SISAPARA</h1>
            <p> Sistem Informasi Sarana dan Prasarana Dispora (SISAPARA) adalah platform digital yang dirancang
                untuk mempermudah pengelolaan fasilitas dan inventaris sarana dan prasarana olahraga Dispora kota Bandung
                secara efisien dan transparan.
                Mulai dari peminjaman alat olahraga, gedung olahraga, hingga pelaporan kerusakan.
            </p>
            <div
                class="d-flex flex-wrap justify-content-start justify-content-md-start justify-content-center align-items-center gap-3 mb-3">
                <img src="{{ asset('img/logo1.png') }}" alt="Logo 1" style="max-height: 120px; width: auto;">
                <img src="{{ asset('img/logo2.png') }}" alt="Logo 2" style="max-height: 120px; width: auto;">
                <img src="{{ asset('img/logo3.png') }}" alt="Logo 3" style="max-height: 120px; width: auto;">
            </div>
            <div>
                <button class="hero-btn"><i class="animation"></i>selengkapnya<i class="animation"></i>
                </button>
            </div>
        </div>
        <div class="image-columns-wrapper">
            <div class="image-columns">
                <div class="scroll-column scroll-up">
                    <div class="scroll-track">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="image-box"><img src="{{ asset('img/bola.jpg') }}" alt="Image 1" /></div>
                            <div class="image-box"><img src="{{ asset('img/basket.jpg') }}" alt="Image 2" /></div>
                            <div class="image-box"><img src="{{ asset('img/raket.jpg') }}" alt="Image 3" /></div>
                        @endfor
                    </div>
                </div>
                <div class="scroll-column scroll-down">
                    <div class="scroll-track">
                        @for ($i = 0; $i < 2; $i++)
                            <div class="image-box"><img src="{{ asset('img/bola.jpg') }}" alt="Image 1" /></div>
                            <div class="image-box"><img src="{{ asset('img/basket.jpg') }}" alt="Image 2" /></div>
                            <div class="image-box"><img src="{{ asset('img/raket.jpg') }}" alt="Image 3" /></div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-2 pt-5 bg-body">
        <div class="row">
            <div class="col-md-7 mb-4">
                <div class="rounded overflow-hidden shadow-sm mb-3" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <img id="main-image" src="{{ asset('img/bet-tenis.jpg') }}" alt="Lapangan Tenis"
                        class="img-fluid w-100 d-block" style="object-fit: cover; height: 63vh;">
                </div>
                <div class="d-flex overflow-auto gap-3 d-md-none">
                    <div class="flex-shrink-0" style="width: 120px; height: 100px;">
                        <img id="image1-mobile" src="{{ asset('img/bet-tenis.jpg') }}" alt="Image 1"
                            class="img-fluid rounded object-fit-cover w-100 h-100 shadow-sm"
                            onclick="changeContent('image1')">
                    </div>
                    <div class="flex-shrink-0" style="width: 200px; height: 100px;">
                        <img id="image2-mobile" src="{{ asset('img/basket.jpg') }}" alt="Image 2"
                            class="img-fluid rounded object-fit-cover w-100 h-100 shadow-sm"
                            onclick="changeContent('image2')">
                    </div>
                </div>
            </div>

            <div class="col-md-5 d-flex flex-column justify-content-between" style="height: 63vh;">
                <div>
                    <small class="text-muted">Tentang SISAPARA</small>
                    <h3 class="mt-2" id="main-heading">
                        SISAPARA – Solusi Digital untuk <span class="text-danger">Reservasi</span> Fasilitas &
                        <span class="text-primary">Peminjaman</span> Sarana Olahraga Dispora Kota Bandung
                    </h3>
                </div>
                <p class="text-muted" id="main-text" style="flex-grow: 1; overflow-y: auto;">
                    SISAPARA adalah platform resmi dari Dispora Kota Bandung yang memudahkan masyarakat, komunitas, dan
                    lembaga untuk melakukan reservasi fasilitas olahraga serta meminjam sarana penunjang secara daring.
                    Semua prosesnya mudah, cepat, dan transparan – cukup dari genggaman tangan.
                </p>

                <div class="d-flex overflow-auto gap-3 pt-2 d-none d-md-flex">
                    <div class="flex-shrink-0" style="width: 160px; height: 200px;">
                        <img id="image1" src="{{ asset('img/bet-tenis.jpg') }}" alt="Image 1"
                            class="img-fluid rounded object-fit-cover w-100 h-100 shadow-sm"
                            onclick="changeContent('image1')">
                    </div>
                    <div class="flex-shrink-0" style="width: 320px; height: 200px;">
                        <img id="image2" src="{{ asset('img/basket.jpg') }}" alt="Image 2"
                            class="img-fluid rounded object-fit-cover w-100 h-100 shadow-sm"
                            onclick="changeContent('image2')">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray">
        <div class="container p-3">
            <div class="row">
                <div class="col-md-4 order-md-2">
                    <div class="swiper mySwiper1">
                        <div class="swiper-wrapper">
                            @foreach ($facilities as $facility)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $facility->banner) }}" alt="{{ $facility->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-8 order-md-1">
                    <div class="mb-4">
                        {{-- <small class="text-muted">// Prasarana</small> --}}
                        <h2 class="fw-bold">Fasilitas Olahraga Lengkap<br><span style="color: #016974">Dengan
                                Infrastruktur Modern</span></h2>
                        <p>Kami menyediakan berbagai prasarana seperti lapangan tenis, kolam renang, dan
                            lapangan serbaguna yang dirancang dengan standar tinggi untuk mendukung kegiatan pelatihan,
                            kompetisi, hingga acara olahraga skala besar.</p>
                    </div>
                    <a href="{{ route('reservasi') }}" class="btn btn-outline-dark">Lihat Detail</a>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-4">
                    <div class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                            @foreach ($equipments as $equipment)
                                <div class="swiper-slide"><img src="{{ asset('storage/' . $equipment->image) }}"
                                        alt="{{ $equipment->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="text-start mb-4">
                        {{-- <small class="text-muted">// Sarana</small> --}}
                        <h2 class="fw-bold">Peralatan & Penunjang Olahraga<br><span style="color: #016974">Yang Lengkap
                                dan Berkualitas</span></h2>
                        <p class="w-75">Selain infrastruktur, kami juga menyediakan sarana olahraga seperti bola, net,
                            alat kebugaran, papan skor digital, serta ruang ganti dan tribun penonton untuk kenyamanan
                            pengguna fasilitas kami.</p>
                    </div>
                    <a href="{{ route('reservasi') }}" class="btn btn-outline-dark">Lihat Detail</a>
                </div>
            </div>
        </div>
    </section>

    <section id="artikel" class="container my-5">
        <div class="text-center mb-5">
            {{-- <small class="text-muted">// Artikel Terbaru</small> --}}
            <h2 class="fw-bold">Baca Wawasan & Info Terbaru<br><span style="color: #016974">dari Kami</span></h2>
            <p class="w-100 w-md-75 mx-auto text-muted">
                Dapatkan informasi terkini seputar kegiatan, tips, dan wawasan menarik melalui artikel
                yang kami sajikan.
            </p>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper py-4">

                @forelse ($articles as $article)
                    <div class="swiper-slide">
                        <a href="{{ route('article.show', $article->slug) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm border-0 article-card-custom">
                                <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top"
                                    alt="{{ $article->title }}">

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $article->title }}</h5>
                                    <small class="text-muted mb-2">
                                        Dipublikasikan pada
                                        {{ $article->created_at ? $article->created_at->translatedFormat('l, d F Y') : '' }}
                                    </small>
                                    <p class="card-text">
                                        {{ Str::limit(strip_tags($article->content), 100) }}
                                    </p>

                                    <div class="mt-auto">
                                        <span class="btn btn-article mt-2" style="color: #016974">Baca Selengkapnya</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body text-center">
                                <p>Belum ada artikel yang dipublikasikan.</p>
                            </div>
                        </div>
                    </div>
                @endforelse


            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        function changeContent(imageId) {
            var mainImage = document.getElementById('main-image');
            var mainHeading = document.getElementById('main-heading');
            var mainText = document.getElementById('main-text');

            if (imageId === 'image1') {
                mainImage.src = document.getElementById('image1').src;
                mainHeading.innerHTML =
                    "SISAPARA – Solusi Digital untuk <span class='text-danger'>Reservasi</span> Fasilitas & <span class='text-primary'>Peminjaman</span> Sarana Olahraga Dispora Kota Bandung";
                mainText.innerHTML =
                    "SISAPARA hadir untuk mempermudah proses pemesanan fasilitas olahraga serta peminjaman alat penunjang olahraga di bawah naungan Dispora Kota Bandung. Semua dapat diakses secara praktis, cepat, dan transparan.";
            } else if (imageId === 'image2') {
                mainImage.src = document.getElementById('image2').src;
                mainHeading.innerHTML =
                    "Dukung Aktivitas Olahraga Masyarakat dengan <span class='text-danger'>Fasilitas Terstandar</span> & <span class='text-primary'>Layanan Terintegrasi</span> di SISAPARA";
                mainText.innerHTML =
                    "Melalui SISAPARA, Dispora Kota Bandung menyediakan sarana olahraga yang dapat diakses oleh masyarakat umum, komunitas, hingga instansi. Semua informasi pemesanan tersedia secara daring, aman, dan terkelola dengan baik.";
            }
        }

        new Swiper(".mySwiper1", {
            effect: "cards",
            grabCursor: true,
        });

        new Swiper(".mySwiper2", {
            effect: "cards",
            grabCursor: true,
        });

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

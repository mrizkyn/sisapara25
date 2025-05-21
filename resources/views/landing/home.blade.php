@extends('layouts.user.main')
@section('main-content')
    <section class="hero Patterns">
        <div class="hero-text">
            <h1>SISPARA</h1>
            <p> Sistem Informasi Sarana dan Prasarana (SISPARA) adalah platform digital yang dirancang
                untuk mempermudah pengelolaan fasilitas dan inventaris kampus secara efisien dan transparan.
                Mulai dari peminjaman alat olahraga, ruang kelas, hingga pelaporan kerusakan—semua bisa dari genggaman.
            </p>
            <div>
                <button class="hero-btn"><i class="animation"></i>selengkapnya<i class="animation"></i>
                </button>
            </div>
        </div>
        <div class="image-columns-wrapper">
            <div class="image-columns">
                <div class="scroll-column scroll-up">
                    <div class="scroll-track">
                        <div class="image-box"><img src="{{ asset('img/bola.jpg') }}" alt="Image 1" /></div>
                        <div class="image-box"><img src="{{ asset('img/basket.jpg') }}" alt=" Image 2" /></div>
                        <div class="image-box"><img src="{{ asset('img/raket.jpg') }}" alt="Image 3" /></div>
                        <div class="image-box"><img src="{{ asset('img/bola.jpg') }}" alt="Image 1" /></div>
                        <div class="image-box"><img src="{{ asset('img/basket.jpg') }}" alt=" Image 2" /></div>
                        <div class="image-box"><img src="{{ asset('img/raket.jpg') }}" alt="Image 3" /></div>
                        <div class="image-box"><img src="{{ asset('img/bola.jpg') }}" alt="Image 1" /></div>
                        <div class="image-box"><img src="{{ asset('img/basket.jpg') }}" alt=" Image 2" /></div>
                        <div class="image-box"><img src="{{ asset('img/raket.jpg') }}" alt="Image 3" /></div>
                    </div>
                </div>
                <div class="scroll-column scroll-down">
                    <div class="scroll-track">
                        <div class="image-box"><img src="{{ asset('img/bola.jpg') }}" alt="Image 1" /></div>
                        <div class="image-box"><img src="{{ asset('img/basket.jpg') }}" alt=" Image 2" /></div>
                        <div class="image-box"><img src="{{ asset('img/raket.jpg') }}" alt="Image 3" /></div>
                        <div class="image-box"><img src="{{ asset('img/bola.jpg') }}" alt="Image 1" /></div>
                        <div class="image-box"><img src="{{ asset('img/basket.jpg') }}" alt=" Image 2" /></div>
                        <div class="image-box"><img src="{{ asset('img/raket.jpg') }}" alt="Image 3" /></div>
                    </div>
                </div>
    </section>

    <section class="container py-2 pt-5 bg-body">
        <div class="row">
            <!-- Gambar Utama dan Galeri Mobile -->
            <div class="col-md-7 mb-4">
                <!-- Gambar Utama -->
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

            <!-- Konten Kanan + Galeri Desktop -->
            <div class="col-md-5 d-flex flex-column justify-content-between" style="height: 63vh;">
                <div>
                    <small class="text-muted">About Us</small>
                    <h3 class="mt-2" id="main-heading">
                        Goports – Empowering Your Sports Journey with
                        <span class="text-danger">Passion</span>,
                        <span class="text-primary">Innovation</span>, and
                        <span class="text-secondary">Dedication</span> for Every Athlete’s Ultimate Performance.
                    </h3>
                </div>
                <p class="text-muted" id="main-text" style="flex-grow: 1; overflow-y: auto;">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis modi dicta fugiat error, provident porro
                    odit alias quisquam reiciendis? Cumque natus autem, tempora et velit optio provident repellat eos
                    maiores. Dignissimos error eaque voluptatem!
                </p>

                <!-- Galeri Desktop -->
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
        <style>
            .bg-gray {
                background-color: #f5f5f5;
                padding: 20px 30px;
            }

            .btn-outline-dark {
                border-radius: 25px;
                padding: 8px 20px;
                font-weight: 500;
            }

            .swiper {
                width: 100%;
                max-width: 300px;
                height: 400px;
                margin: 0 auto;
            }

            .swiper-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 18px;
            }

            @media (max-width: 768px) {
                .swiper {
                    max-width: 70%;
                    height: 300px;
                }


            }
        </style>

        <div class="container p-3">
            <!-- Fitur 1 -->
            <div class="row">
                <div class="col-md-4 order-md-2">
                    <div class="swiper mySwiper1">
                        <div class="swiper-wrapper">
                            @foreach ($facilities as $facility)
                                <div class="swiper-slide"><img src="{{ asset('storage/' . $facility->banner) }}"
                                        alt="{{ $facility->banner }}" />
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-md-8 order-md-1">
                    <div class="mb-4">
                        <small class="text-muted">// Prasarana</small>
                        <h2 class="fw-bold ">Fasilitas Olahraga Lengkap<br><span style="color: #016974">Dengan
                                Infrastruktur Modern</span></h2>
                        <p>Kami menyediakan berbagai prasarana seperti lapangan tenis, kolam renang, dan
                            lapangan serbaguna yang dirancang dengan standar tinggi untuk mendukung kegiatan pelatihan,
                            kompetisi, hingga acara olahraga skala besar.</p>
                    </div>
                    <a href="{{ route('reservasi') }}" class="btn btn-outline-dark">Lihat Detail</a>
                </div>
            </div>

            <!-- Fitur 2 -->
            <div class="row pt-5">
                <div class="col-md-4">
                    <div class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="{{ asset('img/tenis1.jpg') }}" alt="Lapangan Tenis" />
                            </div>
                            <div class="swiper-slide"><img src="{{ asset('img/basket.jpg') }}" alt="Lapangan Tenis 2" />
                            </div>
                            <div class="swiper-slide"><img src="{{ asset('img/tenis1.jpg') }}" alt="Lapangan Tenis" />
                            </div>
                            <div class="swiper-slide"><img src="{{ asset('img/basket.jpg') }}" alt="Lapangan Tenis 2" />
                            </div>
                            <div class="swiper-slide"><img src="{{ asset('img/tenis1.jpg') }}" alt="Lapangan Tenis" />
                            </div>
                            <div class="swiper-slide"><img src="{{ asset('img/basket.jpg') }}" alt="Lapangan Tenis 2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="text-start mb-4">
                        <small class="text-muted">// Sarana</small>
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


    @push('script')
        <script>
            function changeContent(imageId) {
                var mainImage = document.getElementById('main-image');
                var mainHeading = document.getElementById('main-heading');
                var mainText = document.getElementById('main-text');

                if (imageId === 'image1') {
                    mainImage.src = document.getElementById('image1').src;
                    mainHeading.innerHTML =
                        "Goports – Empowering Your Sports Journey with <span class='text-danger'>Passion</span>, <span class='text-primary'>Innovation</span>, and <span class='text-secondary'>Dedication</span> for Every Athlete’s Ultimate Performance.";
                    mainText.innerHTML =
                        "Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis modi dicta fugiat error, provident porro odit alias quisquam reiciendis? Cumque natus autem, tempora et velit optio provident repellat eos maiores. Dignissimos error eaque voluptatem!";
                } else if (imageId === 'image2') {
                    mainImage.src = document.getElementById('image2').src;
                    Z
                    mainHeading.innerHTML =
                        "Goports – Innovating Your Sports Experience with <span class='text-danger'>Growth</span>, <span class='text-primary'>Tech</span>, and <span class='text-secondary'>Excellence</span> for a Smarter Future.";
                    mainText.innerHTML =
                        "Discover how Goports enhances your sports journey through cutting-edge technology, advanced analytics, and a passion for helping athletes reach their full potential. Join the revolution today!";
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
        </script>
    @endpush
@endsection

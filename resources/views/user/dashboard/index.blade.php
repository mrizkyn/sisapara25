@extends('layouts.user.main')
@section('main-content')
    <section>
        <style>
            .card-img-fixed {
                height: 200px;
                object-fit: cover;
            }

            .nav-pills .nav-link {
                border: 1px solid black;
                color: black;
                border-radius: 15px;
            }

            .nav-pills .nav-link.active {
                background-color: #016974;
                color: white;
                border-radius: 15px;
            }

            .col .card {
                box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            }

            .custom-btn {
                display: inline-block;
                border: 1px solid #016974;
                border-radius: 50px;
                padding: 5px 30px;
                color: black;
                text-align: center;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

            .custom-btn:hover {
                background-color: #016974;
                color: #F3F3F2;
            }
        </style>
        <div class="container">
            <div class="text-start mt-5">
                <small class="text-muted">// Reservasi Sarana dan Prasarana</small>
                <h2 class="fw-bold">Eksplorasi Fasilitas Kami <br><span style="color: teal">Lapangan, Kolam, dan
                        Lainnya</span></h2>
                <p class="w-75">Temukan fasilitas olahraga kami yang lengkap untuk mendukung kegiatan rekreasi dan
                    prestasi. Ayo, eksplor sekarang juga dan lakukan reservasi untuk pengalaman terbaik Anda!</p>
            </div>

        </div>
        <div class="card container border-0 bg-white">
            <div class="card-header border-0 bg-white">
                <ul class="nav nav-pills card-header-pills float-end">
                    <li class="nav-item me-2" role="presentation">
                        <a class="nav-link active" id="prasarana-tab" data-bs-toggle="pill" href="#prasarana"
                            role="tab">Prasarana</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="sarana-tab" data-bs-toggle="pill" href="#sarana" role="tab">Sarana</a>
                    </li>
                </ul>
            </div>

            <div class="card-body tab-content container container " id="myTabContent">
                <!-- Prasarana Tab -->
                <div class="tab-pane fade show active" id="prasarana" role="tabpanel">
                ss
                </div>


                <!-- Sarana Tab -->
                <div class="tab-pane fade" id="sarana" role="tabpanel">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">

                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset('img/bola.jpg') }}" class="card-img-top card-img-fixed"
                                    alt="Ruang Kelas A">
                                <div class="card-body d-flex justify-content-lg-between align-items-center"
                                    style="margin-bottom:0; ">
                                    <div class="text-container">
                                        <p class="fs-4">bola</p>
                                    </div>
                                    <div class="button-container ml-3">
                                        <a href="http://" class="custom-btn">Detail</a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p><i class='bx bx-user'></i>26</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset('img/basket.jpg') }}" class="card-img-top card-img-fixed"
                                    alt="Ruang Kelas A">
                                <div class="card-body d-flex justify-content-lg-between align-items-center"
                                    style="margin-bottom:0; ">
                                    <div class="text-container">
                                        <p class="fs-4">Basket</p>
                                    </div>
                                    <div class="button-container ml-3">
                                        <a href="http://" class="custom-btn">Detail</a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p><i class='bx bx-user'></i>26</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset('img/tenis.jpg') }}" class="card-img-top card-img-fixed"
                                    alt="Ruang Kelas A">
                                <div class="card-body d-flex justify-content-lg-between align-items-center"
                                    style="margin-bottom:0; ">
                                    <div class="text-container">
                                        <p class="fs-4">Tenis</p>
                                    </div>
                                    <div class="button-container ml-3">
                                        <a href="http://" class="custom-btn">Detail</a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p><i class='bx bx-user'></i>26</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset('img/bola.jpg') }}" class="card-img-top card-img-fixed"
                                    alt="Ruang Kelas A">
                                <div class="card-body d-flex justify-content-lg-between align-items-center"
                                    style="margin-bottom:0; ">
                                    <div class="text-container">
                                        <p class="fs-4">bola</p>
                                    </div>
                                    <div class="button-container ml-3">
                                        <a href="http://" class="custom-btn">Detail</a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p><i class='bx bx-user'></i>26</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset('img/basket.jpg') }}" class="card-img-top card-img-fixed"
                                    alt="Ruang Kelas A">
                                <div class="card-body d-flex justify-content-lg-between align-items-center"
                                    style="margin-bottom:0; ">
                                    <div class="text-container">
                                        <p class="fs-4">Basket</p>
                                    </div>
                                    <div class="button-container ml-3">
                                        <a href="http://" class="custom-btn">Detail</a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p><i class='bx bx-user'></i>26</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset('img/tenis.jpg') }}" class="card-img-top card-img-fixed"
                                    alt="Ruang Kelas A">
                                <div class="card-body d-flex justify-content-lg-between align-items-center"
                                    style="margin-bottom:0; ">
                                    <div class="text-container">
                                        <p class="fs-4">Tenis</p>
                                    </div>
                                    <div class="button-container ml-3">
                                        <a href="http://" class="custom-btn">Detail</a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p><i class='bx bx-user'></i>26</p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

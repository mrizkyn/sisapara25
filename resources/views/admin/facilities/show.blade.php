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
                        <div class="pt-3 pb-4">
                            <h1 class="fs-2 fw-bold mb-0" style="color:  #000000">{{ $facility->name }}</h1>
                        </div>
                        <div class="row gy-3 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-people-fill text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Kapasitas</div>
                                        <h5 class="mb-0">{{ $facility->capacity }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">Lokasi</div>
                                        <h5 class="mb-0">{{ $facility->location }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-light p-4 rounded-3">
                            <h5 class="fw-semibold mb-2">Deskripsi</h5>
                            <p class="text-muted mb-0">{{ $facility->description }}</p>
                        </div>
                        <div class="pt-3">
                            <a href="{{ route('admin.facilities.index') }}" class="btn btn-outline-secondary mb-4">
                                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Galeri --}}
        @if (!empty($facility->images))
            <section class="pt-2 px-2 ">
                <h4 class="fw-semibold mb-4 text-center" style="color:  #000000">Galeri Fasilitas</h4>
                <div class="swiper mySwiper px-2 pb-5">
                    <div class="swiper-wrapper">
                        @foreach (json_decode($facility->images) as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery {{ $facility->name }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="max-height: 280px; object-fit: cover; width: 100%; transition: transform 0.3s ease;"
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

    {{-- CDN & Style --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    {{-- Script Swiper --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper(".mySwiper", {
                loop: true,
                slidesPerView: 3,
                spaceBetween: 20,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                    576: {
                        slidesPerView: 2,
                        spaceBetween: 15
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                },
            });
        });
    </script>

@endsection

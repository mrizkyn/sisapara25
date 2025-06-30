<style>
    .footer-logos img {
        max-height: 50px;
        width: auto;
        opacity: 0.8;
        filter: grayscale(80%);
        transition: opacity 0.3s ease, filter 0.3s ease;
    }

    .footer-logos img:hover {
        opacity: 1;
        filter: grayscale(0%);
    }

    .footer-link {
        color: white !important;
        text-decoration: none;
    }

    .footer-link:hover {
        text-decoration: underline;
    }

    .footer-section h6 {
        color: white;
    }

    .social-icon {
        color: white !important;
        font-size: 1.5rem;
        transition: color 0.3s ease;
    }

    .social-icon:hover {
        color: #ccc;
    }
</style>
<footer class="text-white pt-5 pb-4" style="background-color: #016974;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">SISAPARA</h5>
                <p class="text-white-75">
                    Platform digital untuk mempermudah pengelolaan dan reservasi sarana prasarana olahraga
                    milik Dispora Kota Bandung secara efisien dan transparan.
                </p>

                <div class="mt-4 footer-logos">
                    <p class="text-white-75 mb-2">Didukung oleh:</p>
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('img/logo1.png') }}" alt="Logo 1">
                        <img src="{{ asset('img/logo2.png') }}" alt="Logo 2">
                        <img src="{{ asset('img/logo3.png') }}" alt="Logo 3">
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <a href="mailto:dispora@bandung.go.id" class="social-icon" title="Email">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                    <a href="https://dispora.bandung.go.id/" target="_blank" class="social-icon" title="Website">
                        <i class="bi bi-globe"></i>
                    </a>
                    <a href="https://www.instagram.com/disporakotabandung/" target="_blank" class="social-icon"
                        title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/@disporakotabandung" target="_blank" class="social-icon"
                        title="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="fw-bold text-uppercase mb-3">Navigasi</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}" class="footer-link">Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('informasi') }}" class="footer-link">Informasi</a></li>
                    <li class="mb-2"><a href="{{ route('reservasi') }}" class="footer-link">Reservasi</a></li>
                    <li class="mb-2"><a href="{{ route('faq') }}" class="footer-link">FAQ</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="fw-bold text-uppercase mb-3">Layanan</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link">Data Sarana</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Data Prasarana</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Permintaan Jadwal</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Riwayat Reservasi</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="fw-bold text-uppercase mb-3">Hubungi Kami</h6>
                <ul class="list-unstyled text-white-75">
                    <li class="d-flex align-items-start mb-2">
                        <i class="bi bi-geo-alt-fill me-3 mt-1"></i>
                        <span>Jl. Tamansari No.65, Lb. Siliwangi, Kecamatan Coblong, Kota Bandung</span>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-telephone-fill me-3"></i>
                        <span>(022) 2516651</span>
                    </li>
                    <li class="d-flex align-items-center mb-2">
                        <i class="bi bi-envelope-fill me-3"></i>
                        <span>dispora@bandung.go.id</span>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-center pt-4 mt-4 border-top border-white border-opacity-25">
            <p class="mb-3 mb-md-0 text-white-75 text-center text-md-start">
                © {{ date('Y') }} SISAPARA - DISPORA Kota Bandung.
            </p>
            <div class="text-center text-md-end">
                {{-- <a href="#" class="footer-link me-3">Kebijakan Privasi</a>
                <a href="#" class="footer-link">Syarat & Ketentuan</a> --}}
            </div>
        </div>
    </div>
</footer>

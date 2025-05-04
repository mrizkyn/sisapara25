<div class="cusstom-navbar">
    <a href="#" class="logo">
        <img src="logo.png" alt="Logo" class="logo-img">
    </a>
    <ul class="cusstom-nav-links" id="nav-links">
        <li class="login-mobile">
            {{-- <a href="{{ route('login') }}" class="cusstom-nav-btn">
                <i class="animation"></i>Login<i class="animation"></i>
            </a> --}}
            @php
                $currentRoute = Route::currentRouteName();
            @endphp

            @guest
                <a href="{{ $currentRoute === 'login' ? route('register') : route('login') }}" class="cusstom-nav-btn">
                    <i class="animation"></i>
                    {{ $currentRoute === 'login' ? 'Register' : 'Login' }}
                    <i class="animation"></i>
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="cusstom-nav-btn">
                    <i class="animation"></i>
                    Dashboard
                    <i class="animation"></i>
                </a>
            @endguest

        </li>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('informasi') }}">Informasi</a></li>
        <li><a href="{{ route('reservasi') }}">Reservasi</a></li>
        <li><a href="{{ route('faq') }}">FAQ</a></li>
    </ul>

    <div class="right-icons ">
        {{-- <a href="{{ route('login') }}" class="cusstom-nav-btn">
            <i class="animation"></i>Login<i class="animation"></i>
        </a> --}}
        @php
            $currentRoute = Route::currentRouteName();
        @endphp

        @guest
            <a href="{{ $currentRoute === 'login' ? route('register') : route('login') }}"
                class=" login-desktop cusstom-nav-btn">
                <i class="animation"></i>
                {{ $currentRoute === 'login' ? 'Register' : 'Login' }}
                <i class="animation"></i>
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="cusstom-nav-btn">
                <i class="animation"></i>
                Dashboard
                <i class="animation"></i>
            </a>
        @endguest

        <button class="menu-toggle" id="menu-toggle" aria-label="Buka menu">☰</button>
        <button class="menu-close" id="menu-close" aria-label="Tutup menu">X</button>
    </div>
</div>

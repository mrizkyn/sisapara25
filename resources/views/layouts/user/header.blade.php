<style>
    :root {
        --main-color: #40b3a2;
        --white-color: #F4F4F2;
        --black-color: #000000;
    }

    body {
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .cusstom-navbar {
        top: 20px;
        background: var(--white-color);
        padding: 15px 20px;
        margin: 20px auto;
        position: fixed;
        width: 95%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 100;
        border-radius: 50px;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: #40b3a242 0px 2px 8px 0px;
    }

    .logo-img {
        height: 50px;
        width: auto;
    }

    .cusstom-nav-links {
        list-style: none;
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .cusstom-nav-links li a {
        text-decoration: none;
        color: var(--black);
        font-weight: 600;
        font-size: 18px;
        padding: 10px 10px;
        align-items: center;
        position: relative;
    }

    .cusstom-nav-links li a::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 2px;
        background-color: var(--main-color);
        transform: scaleX(0);
        transform-origin: bottom right;
        transition: transform 0.3s ease-out;
    }

    .cusstom-nav-links li a:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    .active-link {
        border-bottom: 2px solid var(--main-color);
        color: var(--main-color);
    }

    .right-icons {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .menu-toggle {
        display: none;
        font-size: 24px;
        background: none;
        border: none;
        color: var(--black);
        cursor: pointer;
    }

    .menu-close {
        display: none;
        font-size: 36px;
        color: var(--black-color);
        background: none;
        border: none;
        cursor: pointer;
        position: absolute;
        top: 20px;
        right: 20px;
    }

    a {
        text-decoration: none
    }

    .cusstom-nav-btn {
        outline: 0;
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        background: var(--main-color);
        min-width: 150px;
        border: 0;
        border-radius: 15px;
        box-sizing: border-box;
        padding: 12px 24px;
        color: var(--white-color);
        font-size: 16px;
        font-weight: 600;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        overflow: hidden;
        cursor: pointer;
        transition: background-color 0.3s ease;
        cursor: pointer;
    }


    .hero-btn .animation,
    .cusstom-nav-btn .animation {
        border-radius: 100%;
        animation: ripple 0.6s linear infinite;
    }

    .login-desktop {
        display: inline-flex;
    }

    .login-mobile {
        display: none;
    }

    @keyframes ripple {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1), 0 0 0 20px rgba(255, 255, 255, 0.1), 0 0 0 40px rgba(255, 255, 255, 0.1), 0 0 0 60px rgba(255, 255, 255, 0.1);
        }

        100% {
            box-shadow: 0 0 0 20px rgba(255, 255, 255, 0.1), 0 0 0 40px rgba(255, 255, 255, 0.1), 0 0 0 60px rgba(255, 255, 255, 0.1), 0 0 0 80px rgba(255, 255, 255, 0);
        }
    }

    @media (max-width: 768px) {
        .cusstom-nav-links {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            height: 100vh;
            background-color: var(--white-color);
            z-index: 50;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 30px;
            opacity: 0;
            transform: translateY(-100%);
            pointer-events: none;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .cusstom-nav-links.active {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .cusstom-nav-links li {
            opacity: 0;
            transform: translateY(20px);
            animation: menuItemFade 0.4s ease forwards;
        }

        .cusstom-nav-links.active li:nth-child(1) {
            animation-delay: 0.1s;
        }

        .cusstom-nav-links.active li:nth-child(2) {
            animation-delay: 0.2s;
        }

        .cusstom-nav-links.active li:nth-child(3) {
            animation-delay: 0.3s;
        }

        .cusstom-nav-links.active li:nth-child(4) {
            animation-delay: 0.4s;
        }

        .cusstom-nav-links.active li:nth-child(5) {
            animation-delay: 0.5s;
        }

        @keyframes menuItemFade {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .menu-toggle {
            display: block;
            z-index: 100;
        }

        .menu-close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 36px;
            background: none;
            border: none;
            color: var(--black-color);
            cursor: pointer;
            z-index: 1000;
        }

        .login-desktop {
            display: none;
        }

        .login-mobile {
            display: block;
        }

        .login-mobile .cusstom-nav-btn {
            color: var(--white-color);
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-mobile .cusstom-nav-btn:hover {
            background-color: #333;
        }

        .dropdown-menu {
            position: absolute;
            top: 50px;
            left: 0;
            width: 100%;
            display: none;
            background-color: var(--white-color);
            padding: 0;
            border-radius: 0;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
        }

        .dropdown.active .dropdown-menu {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .dropdown-toggle {
            width: 100%;
            padding: 14px;
            font-size: 18px;
        }
    }
</style>
<div class="cusstom-navbar">
    <a href="#" class="logo">
        <img src="logo.png" alt="Logo" class="logo-img">
    </a>
    <ul class="cusstom-nav-links" id="nav-links">
        <li class="login-mobile">
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
                <!-- Menampilkan dropdown saat sudah login -->
                <div class="dropdown">
                    <button class="cusstom-nav-btn dropdown-toggle">
                        <i class="animation"></i>
                        {{ Auth::user()->name }}
                        <i class="animation"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout-btn"><i class='bx bx-log-out'></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </li>

        <li><a href="{{ route('home') }}"
                class="{{ Route::currentRouteName() === 'home' ? 'active-link' : '' }}">Home</a></li>
        <li><a href="{{ route('informasi') }}"
                class="{{ Route::currentRouteName() === 'informasi' ? 'active-link' : '' }}">Informasi</a></li>
        <li><a href="{{ route('reservasi') }}"
                class="{{ Route::currentRouteName() === 'reservasi' ? 'active-link' : '' }}">Reservasi</a></li>
        <li><a href="{{ route('faq') }}"
                class="{{ Route::currentRouteName() === 'faq' ? 'active-link' : '' }}">FAQ</a></li>
    </ul>

    <div class="right-icons">
        @php
            $currentRoute = Route::currentRouteName();
        @endphp

        @guest
            <a href="{{ $currentRoute === 'login' ? route('register') : route('login') }}"
                class="login-desktop cusstom-nav-btn">
                <i class="animation"></i>
                {{ $currentRoute === 'login' ? 'Register' : 'Login' }}
                <i class="animation"></i>
            </a>
        @else
            <!-- Menampilkan dropdown saat sudah login -->
            <div class="dropdown login-desktop">
                <button class="cusstom-nav-btn dropdown-toggle">
                    <i class="animation"></i>
                    {{ Auth::user()->name }}
                    <i class="animation"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn"><i class='bx bx-log-out'></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endguest

        <button class="menu-toggle" id="menu-toggle" aria-label="Buka menu">☰</button>
        <button class="menu-close" id="menu-close" aria-label="Tutup menu">X</button>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const dropdown = document.querySelector('.dropdown');

        dropdownToggle.addEventListener('click', function() {
            dropdown.classList.toggle('active');
        });
    });
</script>

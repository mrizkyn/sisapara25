<nav class="sidebar">
    <div class="menu_content">
        @can('superadmin')
            <ul class="menu_items">
                <div class="menu_title menu_setting"></div>
                <li class="item">
                    <a href="{{ route('superadmin.dashboard') }}" class="nav_link">
                        <span class="navlink_icon">
                            <i class='bx bxs-dashboard'></i>
                        </span>
                        <span class="navlink">Dashboard</span>
                    </a>
                </li>
                {{-- <div class="menu_title menu_setting"></div> --}}
                <li class="item">
                    <a href="{{ route('superadmin.admin-management.index') }}" class="nav_link">
                        <span class="navlink_icon">
                            <i class='bx bxs-user-circle'></i>
                        </span>
                        <span class="navlink">Kelola Admin</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{ route('superadmin.articles.index') }}" class="nav_link">
                        <span class="navlink_icon">
                            <i class='bx bx-news'></i>
                        </span>
                        <span class="navlink">Artikel</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{ route('superadmin.reservasi.index') }}" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-calendar"></i>

                        </span>
                        <span class="navlink">Reservasi</span>
                    </a>
                </li>

                {{-- <li class="item">
                    <div href="#" class="nav_link submenu_item">
                        <span class="navlink_icon">
                            <i class="bx bx-calendar"></i>
                        </span>
                        <span class="navlink">Reservasi</span>
                        <i class="bx bx-chevron-right arrow-left"></i>
                    </div>
                    <ul class="menu_items submenu">
                        <a href="{{ route('superadmin.reservasi.index') }}" class="nav_link sublink">Semua
                            Reservasi</a>
                        <a href="{{ route('superadmin.reservasi.indexVerified') }}" class="nav_link sublink">Perlu
                            Persetujuan</a>
                        <a href="{{ route('superadmin.reservasi.indexapproved') }}" class="nav_link sublink">Sudah
                            Distujui</a>
                    </ul>
                </li> --}}
            </ul>
        @endcan
        @can('admin')
            <ul class="menu_items">
                <li class="item">
                    <a href="{{ route('admin.dashboard') }}" class="nav_link">
                        <span class="navlink_icon">
                            <i class='bx bxs-dashboard'></i>
                        </span>
                        <span class="navlink">Dashboard</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{ route('admin.profiles.index') }}" class="nav_link">
                        <span class="navlink_icon">
                            <i class='bx bxs-user'></i>
                        </span>
                        <span class="navlink">Profile</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{ route('admin.facilities.index') }}" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-building-house"></i>
                        </span>
                        <span class="navlink">Prasarana</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{ route('admin.equipments.index') }}" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-football"></i>
                        </span>
                        <span class="navlink">Sarana</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{ route('admin.reservasi.index') }}" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-calendar"></i>
                        </span>
                        <span class="navlink">Reservasi</span>
                    </a>
                </li>
            </ul>
        @endcan
        <div class="bottom_content">
            <div class="bottom expand_sidebar">
                <span> Expand</span>
                <i class='bx bx-log-in'></i>
            </div>
            <div class="bottom collapse_sidebar">
                <span> Collapse</span>
                <i class='bx bx-log-out'></i>
            </div>
        </div>
    </div>
</nav>

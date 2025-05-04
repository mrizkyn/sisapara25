<nav class="sidebar">
    <div class="menu_content">
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
            <div class="menu_title menu_setting"></div>
            <li class="item">
                <a href="{{ route('superadmin.admin-management.index') }}" class="nav_link">
                    <span class="navlink_icon">
                        <i class='bx bxs-user-circle'></i>
                    </span>
                    <span class="navlink">Kelola Admin</span>
                </a>
            </li>
        </ul>
        <ul class="menu_items">
            <div class="menu_title menu_dahsboard"></div>
            <li class="item">
                <div href="#" class="nav_link submenu_item">
                    <span class="navlink_icon">
                        <i class="bx bx-grid-alt"></i>
                    </span>
                    <span class="navlink">Sarana</span>
                    <i class="bx bx-chevron-right arrow-left"></i>
                </div>
                <ul class="menu_items submenu">
                    <a href="#" class="nav_link sublink">Nav Sub Link</a>
                    <a href="#" class="nav_link sublink">Nav Sub Link</a>
                    <a href="#" class="nav_link sublink">Nav Sub Link</a>
                    <a href="#" class="nav_link sublink">Nav Sub Link</a>
                </ul>
            </li>
        </ul>
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

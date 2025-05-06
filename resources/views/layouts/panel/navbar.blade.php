<nav class="navbar">
    <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        SISPARA
    </div>
    <div class="navbar_content">
        <i class="bi bi-grid"></i>
        <div class="profile-dropdown">
            <img src="{{ asset('img/undraw_profile.svg') }}" alt="" class="profile" id="profileBtn" />
            <ul class="dropdown-menu" id="profileMenu">
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button class="dropdown-item" type="submit" id="logout"><i
                                class="bx bx-log-out"></i>Logout</button>
                    </form>
                </li>
            </ul>
        </div>


    </div>
</nav>

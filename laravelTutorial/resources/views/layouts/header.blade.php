<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/dashboard">
        <img src="{{ asset('storage/logo.webp') }}" alt="logo" class="logo">
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            @php
                $avatarUrl = Auth::user()->getFirstMediaUrl('avatar');
            @endphp
            <a class="nav-link d-flex align-items-center dropdown-toggle" id="navbarDropdown" href="#"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="avatar" src="{{ $avatarUrl }}" alt="{{ Auth::user()->name }}">
                <span class="info-name">
                    {{ Auth::user()->name }}
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <a class="dropdown-item {{ Request::is('profile/*') ? 'active' : '' }}"
                        href="/profile/{{ Auth::user()->id }}">
                        Trang cá nhân</a>
                </li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Đăng xuất
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

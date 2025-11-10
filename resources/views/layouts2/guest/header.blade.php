<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">

    <!-- Top Bar -->
    <div class="top-bar text-white-50 row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York, USA</small>
            <small class="ms-4"><i class="fa fa-envelope me-2"></i>info@example.com</small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small>Follow us:</small>
            <a class="text-white-50 ms-3" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="text-white-50 ms-3" href=""><i class="fab fa-twitter"></i></a>
            <a class="text-white-50 ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
            <a class="text-white-50 ms-3" href=""><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{ route('home') }}" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-primary m-0">Chari<span class="text-white">Team</span></h1>
        </a>

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto p-4 p-lg-0">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
    <a href="{{ route('home') }}" class="nav-link d-flex align-items-center gap-2">
        <i class="fa fa-home"></i>
        <span>Home</span>
    </a>
</li>

<li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
    <a href="{{ route('about') }}" class="nav-link d-flex align-items-center gap-2">
        <i class="fa fa-info-circle"></i>
        <span>About</span>
    </a>
</li>

<li class="nav-item {{ request()->routeIs('pendaftar') ? 'active' : '' }}">
    <a href="{{ route('index') }}" class="nav-link d-flex align-items-center gap-2">
        <i class="fa fa-user-plus"></i>
        <span>Pendaftar</span>
    </a>
</li>

<li class="nav-item {{ request()->routeIs('program') ? 'active' : '' }}">
    <a href="{{ route('program.index') }}" class="nav-link d-flex align-items-center gap-2">
        <i class="fa fa-list"></i>
        <span>Program</span>
    </a>
</li>

<li class="nav-item {{ request()->routeIs('verifikasi') ? 'active' : '' }}">
    <a href="{{ route('verifikasi.index') }}" class="nav-link d-flex align-items-center gap-2">
        <i class="fa fa-check-circle"></i>
        <span>Lapangan</span>
    </a>
</li>

<li class="nav-item dropdown {{ request()->routeIs('warga') || request()->routeIs('users.*') || request()->routeIs('riwayat.*') ? 'active' : '' }}">
    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
        <i class="fa fa-folder-open"></i>
        <span>Pages</span>
    </a>

    <ul class="dropdown-menu m-0">
        <li>
            <a href="{{ route('warga.index') }}" class="dropdown-item d-flex align-items-center gap-2">
                <i class="fa fa-users"></i>
                <span>Data Warga</span>
            </a>
        </li>

        <li>
            <a href="{{ route('users.index') }}" class="dropdown-item d-flex align-items-center gap-2">
                <i class="fa fa-user-shield"></i>
                <span>Data Users</span>
            </a>
        </li>

        <li>
            <a href="{{ route('riwayat.index') }}" class="dropdown-item d-flex align-items-center gap-2">
                <i class="fa fa-history"></i>
                <span>Riwayat Penyaluran</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item {{ request()->routeIs('penerima') ? 'active' : '' }}">
    <a href="{{ route('penerima.index') }}" class="nav-link d-flex align-items-center gap-2">
        <i class="fa fa-handshake"></i>
        <span>Bantuan</span>
    </a>
</li>

@guest
<li class="nav-item">
    <a href="{{ route('login') }}" class="nav-link d-flex align-items-center gap-2">
        <i class="fa fa-sign-in-alt"></i>
        <span>Login</span>
    </a>
</li>
@endguest

@auth
<li class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1b6ca8&color=ffffff&size=64"
             class="rounded-circle" style="width:30px; height:30px;">
        <span>{{ Auth::user()->name }}</span>
    </a>

    <ul class="dropdown-menu navbar-profile-dropdown m-0 shadow-lg">
        <li><a href="{{ route('profile') }}" class="dropdown-item">Profil Saya</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button class="dropdown-item" type="submit">Logout</button>
            </form>
        </li>
    </ul>
</li>
@endauth

<<<<<<< HEAD
                <!-- Tombol Logout -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light ms-3">
                            <i class="fa fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </li>

            </ul>
=======
>>>>>>> 0cfebcd1b9ddcc39e876d606f2efc6cd79cf3e49
        </div>
    </nav>
</div>
<!-- Navbar End -->

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

                <li class="nav-item {{ request()->routeIs('home.*') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>

                <li class="nav-item {{ request()->routeIs('about.*') ? 'active' : '' }}">
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                </li>

                <li class="nav-item {{ request()->routeIs('pendaftar.*') ? 'active' : '' }}">
                    <a href="{{ route('pendaftar.index') }}" class="nav-link">Pendaftar Bantuan</a>
                </li>

                <li class="nav-item {{ request()->routeIs('program.*') ? 'active' : '' }}">
                    <a href="{{ route('program.index') }}" class="nav-link">Program Bantuan</a>
                </li>

                <li class="nav-item {{ request()->routeIs('verifikasi.*') ? 'active' : '' }}">
                    <a href="{{ route('verifikasi.index') }}" class="nav-link">Verifikasi Lapangan</a>
                </li>

                <li class="nav-item dropdown {{ request()->routeIs('warga.*') || request()->routeIs('users.*') || request()->routeIs('riwayat.*') ? 'active' : '' }}">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <ul class="dropdown-menu m-0">
                        <li><a href="{{ route('warga.index') }}" class="dropdown-item">Data Warga</a></li>
                        <li><a href="{{ route('users.index') }}" class="dropdown-item">Data Users</a></li>
                        <li><a href="{{ route('riwayat.index') }}" class="dropdown-item">Riwayat Penyaluran</a></li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->routeIs('penerima.*') ? 'active' : '' }}">
                    <a href="{{ route('penerima.index') }}" class="nav-link">Penerima Bantuan</a>
                </li>

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
        </div>
    </nav>
</div>
<!-- Navbar End -->


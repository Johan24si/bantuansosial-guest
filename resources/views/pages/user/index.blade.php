<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ChariTeam - Free Nonprofit Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">

   @include('layouts2.css')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    @include('layouts2.header')
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Data Users</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Data Users</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Donate Start -->
   <div class="container-fluid py-5" style="background-color: #001b20; min-height: 100vh;">
    <div class="container">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="text-white fw-bold">
                <i class="fa fa-users me-2 text-warning"></i> Data Users
            </h2>
            <a href="{{ route('users.create') }}" class="btn btn-success d-flex align-items-center rounded-pill px-4 shadow-sm">
                <i class="fa fa-plus-circle me-2"></i> Tambah User
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
        @endif

        <!-- Grid User Cards -->
        <div class="row g-4">
            @forelse($users as $user)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg h-100 rounded-4 position-relative overflow-hidden"
                         style="transition: 0.3s; background-color: #ffffff;">

                        <div class="card-body p-4">
                            <!-- Header Avatar -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 55px; height: 55px; background-color: #00b894; color: #fff; font-weight: bold; font-size: 1.3rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>

                            <!-- Info -->
                            <p class="mb-0">
                                <i class="fa fa-calendar-alt text-primary me-2"></i>
                                <strong>Dibuat:</strong> {{ $user->created_at->format('d M Y') }}
                            </p>

                            <hr class="my-4" style="border-top: 2px solid #f0f0f0;">

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="btn btn-warning w-50 me-2 rounded-3 fw-bold shadow-sm">
                                    <i class="fa fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus user ini?')" class="w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100 rounded-3 fw-bold shadow-sm">
                                        <i class="fa fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Accent Bar -->
                        <div class="position-absolute top-0 start-0 w-100" style="height: 6px; background: linear-gradient(90deg, #00c6ff, #0072ff);"></div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-white">
                    <p class="fs-5">Belum ada data user.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

    <!-- Donate End -->


    <!-- Footer Start -->
    @include('layouts2.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


   @include('layouts2.js')
</body>

</html>

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

    <!--start css-->
   @include('layouts2.guest.css')
    <!-- end css-->
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    @include('layouts2.guest.header')
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Data Warga</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Data Warga</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Donate Start -->
    <div class="bg-dark p-4 rounded-4 shadow-lg">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white fw-bold">
            <i class="bi bi-people-fill me-2"></i> Data Warga
        </h3>
        <a href="{{ route('warga.create') }}" class="btn btn-success fw-semibold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Warga
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @foreach($data as $w)
        <div class="col-md-4">
            <div class="card border-0 shadow-lg h-100 hover-zoom"
                 style="transition:0.3s; border-radius:18px;">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-bold text-primary mb-0">
                            <i class="bi bi-person-circle me-1"></i> {{ $w->nama }}
                        </h5>
                        <span class="badge {{ $w->jenis_kelamin == 'L' ? 'bg-info' : 'bg-danger' }}">
                            {{ $w->jenis_kelamin }}
                        </span>
                    </div>

                    <small class="text-muted">NIK:</small>
                    <p class="mb-2 fw-semibold">{{ $w->no_ktp }}</p>

                    <div class="mb-3">
                        <p class="mb-1"><i class="bi bi-telephone"></i> {{ $w->telp }}</p>
                        <p class="mb-0"><i class="bi bi-envelope"></i> {{ $w->email }}</p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('warga.edit', $w->warga_id) }}"
                           class="btn btn-warning btn-sm w-50 shadow-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <form action="{{ route('warga.delete', $w->warga_id) }}" method="POST" class="w-50">
                            @csrf
                            @method('DELETE')
                            <button
                                class="btn btn-danger btn-sm w-100 shadow-sm"
                                onclick="return confirm('Yakin hapus data?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.hover-zoom:hover {
    transform: scale(1.04);
    box-shadow: 0 8px 30px rgba(0,0,0,0.3) !important;
}
</style>


    <!-- Donate End -->


    <!-- Footer Start -->
    @include('layouts2.guest.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- start js-->
   @include('layouts2.guest.js')
    <!-- end js-->
</body>

</html>

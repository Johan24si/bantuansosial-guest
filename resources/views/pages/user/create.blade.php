@extends('layouts2.guest.app')
@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Tambah Data Warga</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Tambah Data Warga</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Form Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Donate Now</div>
                <h1 class="display-6 mb-5">Thanks For The Results Achieved With You</h1>
                <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100 bg-secondary p-5">
                    <h2>Tambah User</h2>

                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Media (opsional, bisa lebih dari 1)</label>
                            <input type="file" name="media[]" class="form-control" multiple>
                            <small class="text-muted">Bisa upload: jpg, jpeg, png, webp, mp4, pdf (max 5MB per file)</small>
                        </div>

                        <button class="btn btn-success">Simpan</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

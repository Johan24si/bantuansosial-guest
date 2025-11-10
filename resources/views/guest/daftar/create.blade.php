@extends('layouts2.guest.app')
@section('content')
<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Tambah data</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Tambah data</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Donate Start -->
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
                        <form action="{{ route('store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Program ID</label>
            <input type="number" name="program_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Warga ID</label>
            <input type="number" name="warga_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status Seleksi</label>
            <input type="text" name="status_seleksi" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('index') }}" class="btn btn-secondary">Kembali</a>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
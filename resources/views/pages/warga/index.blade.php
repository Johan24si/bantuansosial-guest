@extends('layouts2.guest.app')
@section('content')
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
@endsection

    <!-- Donate End -->

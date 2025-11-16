@extends('layouts2.guest.app')
@section('content')
<!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Pendaftar bantuan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Pendaftar bantuan</li>
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
                <i class="fa fa-users me-2 text-warning"></i> Data Pendaftar Bantuan
            </h2>
            <a href="{{ route('create') }}" class="btn btn-success d-flex align-items-center rounded-pill px-4 shadow-sm">
                <i class="fa fa-plus-circle me-2"></i> Tambah Pendaftar
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
        @endif

        <!-- Grid Data -->
        <div class="row g-4">
            @forelse($data as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg h-100 rounded-4 position-relative overflow-hidden"
                         style="transition: 0.3s; background-color: #ffffff;">
                         
                        <div class="card-body p-4">
                            <!-- Avatar & ID -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="width: 50px; height: 50px; background-color: #ff8c00; color: #fff; font-weight: bold; font-size: 1.2rem;">
                                    {{ strtoupper(substr($item->pendaftar_id, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-0">Pendaftar #{{ $item->pendaftar_id }}</h5>
                                    <small class="text-muted">ID Warga: {{ $item->warga_id }}</small>
                                </div>
                                <span class="badge bg-info text-dark ms-auto py-2 px-3">{{ $item->status_seleksi }}</span>
                            </div>

                            <!-- Info Detail -->
                           <div class="mt-3">
    <p class="mb-2">
        <i class="fa fa-list-alt text-primary me-2"></i>
        <strong>Program:</strong> {{ $item->program->nama_program }} ({{ $item->program->tahun }})
    </p>
    <p class="mb-0">
        <i class="fa fa-calendar text-success me-2"></i>
        <strong>Tanggal Daftar:</strong> {{ $item->created_at->format('d M Y') }}
    </p>
</div>

                            <!-- Divider -->
                            <hr class="my-4" style="border-top: 2px solid #f0f0f0;">

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('edit', $item->pendaftar_id) }}"
                                   class="btn btn-warning w-50 me-2 rounded-3 fw-bold shadow-sm">
                                    <i class="fa fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('delete', $item->pendaftar_id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="w-50">
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
                    <p class="fs-5">Belum ada data pendaftar bantuan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
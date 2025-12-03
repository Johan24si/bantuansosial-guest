@extends('layouts2.guest.app')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Tambah Data</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Tambah Data</li>
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
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Form Pendaftaran</div>
                <h1 class="display-6 mb-5">Silakan isi data sesuai ketentuan</h1>
                <p class="mb-0">Isi data pendaftar bantuan dengan benar. Pastikan file yang diupload tidak lebih dari 5MB.</p>
            </div>

            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100 bg-secondary p-5">

                    <form action="{{ route('store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">

                        @csrf

                        <!-- Program Bantuan -->
                        <div class="mb-3">
                            <label>Program Bantuan</label>
                            <select name="program_id" class="form-control" required>
                                <option value="">-- Pilih Program --</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->program_id }}">
                                        {{ $program->nama_program }} ({{ $program->tahun }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Warga ID -->
                        <div class="mb-3">
                            <label>Warga ID</label>
                            <input type="number" name="warga_id" class="form-control" required>
                        </div>

                        <!-- Status Seleksi -->
                        <div class="mb-3">
                            <label>Status Seleksi</label>
                            <input type="text" 
                                   name="status_seleksi" 
                                   class="form-control" 
                                   placeholder="contoh: Lulus / TidakLulus / ditolak (opsional)">
                        </div>

                        <!-- Upload Media -->
                        <div class="mb-3">
                            <label>Upload Berkas (bisa lebih dari satu)</label>
                            <input type="file" 
                                   name="media[]" 
                                   class="form-control" 
                                   multiple
                                   accept=".jpg,.jpeg,.png,.webp,.mp4,.pdf">
                        </div>

                        <!-- Buttons -->
                        <button class="btn btn-success">Simpan</button>
                        <a href="{{ route('index') }}" class="btn btn-secondary">Kembali</a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

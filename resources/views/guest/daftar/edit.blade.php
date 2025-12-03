@extends('layouts2.guest.app')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Edit Data</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Edit Data</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Edit Form Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5 align-items-center">

            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Edit Form</div>
                <h1 class="display-6 mb-5">Silakan perbarui data pendaftar</h1>
                <p class="mb-0">
                    Anda dapat memperbarui informasi pendaftar dan menambah file media baru.
                </p>
            </div>

            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100 bg-secondary p-5">

                    <form action="{{ route('update', $data->pendaftar_id) }}" 
                          method="POST" 
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <!-- Program -->
                        <div class="mb-3">
                            <label>Program Bantuan</label>
                            <select name="program_id" class="form-control" required>
                                <option value="">-- Pilih Program --</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->program_id }}"
                                        {{ $program->program_id == $data->program_id ? 'selected' : '' }}>
                                        {{ $program->nama_program }} ({{ $program->tahun }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Warga ID -->
                        <div class="mb-3">
                            <label>Warga ID</label>
                            <input type="number" 
                                   name="warga_id" 
                                   class="form-control" 
                                   value="{{ $data->warga_id }}" 
                                   required>
                        </div>

                        <!-- Status Seleksi -->
                        <div class="mb-3">
                            <label>Status Seleksi</label>
                            <input type="text" 
                                   name="status_seleksi" 
                                   value="{{ $data->status_seleksi }}" 
                                   class="form-control">
                        </div>

                        <!-- Media Lama -->
                        <div class="mb-3">
                            <label>Media Lama</label>
                            <div class="row">
                                @forelse($data->media as $media)
                                    <div class="col-4 mb-2">
                                        @if(str_contains($media->mime_type, 'image'))
                                            <img src="{{ asset('storage/' . $media->file_name) }}" 
                                                 class="img-fluid rounded">
                                        @else
                                            <a href="{{ asset('storage/' . $media->file_name) }}" 
                                               target="_blank"
                                               class="btn btn-sm btn-dark w-100">
                                                Lihat File
                                            </a>
                                        @endif
                                    </div>
                                @empty
                                    <p>Tidak ada media</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Upload Media Baru -->
                        <div class="mb-3">
                            <label>Tambah Media Baru (opsional)</label>
                            <input type="file" 
                                   name="media[]" 
                                   class="form-control" 
                                   multiple
                                   accept=".jpg,.jpeg,.png,.webp,.mp4,.pdf">
                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('index') }}" class="btn btn-secondary">Kembali</a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

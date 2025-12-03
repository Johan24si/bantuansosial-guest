@extends('layouts2.guest.app')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Edit Program Bantuan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Edit data</li>
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
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Update</div>
                <h1 class="display-6 mb-5">Edit Program Bantuan</h1>
                <p class="mb-0">Silakan perbarui data program bantuan sesuai kebutuhan.</p>
            </div>

            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100 bg-secondary p-5">
                    <h2>Edit Program</h2>

                    <form action="{{ route('program_bantuan.update', $program->program_id) }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Kode</label>
                            <input type="text" name="kode" value="{{ $program->kode }}"
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Nama Program</label>
                            <input type="text" name="nama_program" value="{{ $program->nama_program }}"
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Tahun</label>
                            <input type="number" name="tahun" value="{{ $program->tahun }}"
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Anggaran</label>
                            <input type="number" step="0.01" name="anggaran"
                                   value="{{ $program->anggaran }}" class="form-control" required>
                        </div>

                        <!-- ⬇⬇⬇ Field DESKRIPSI (DITAMBAHKAN) -->
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4">{{ $program->deskripsi }}</textarea>
                        </div>
                        <!-- ⬆⬆⬆ End Deskripsi -->

                        <!-- Media Existing -->
                        <div class="mb-3">
                            <label>Media Saat Ini</label><br>

                            @if ($program->media->count() > 0)
                                @foreach ($program->media as $m)
                                    {{-- file_name sudah mengandung path uploads/program_bantuan/... --}}
                                    @php
                                        $url = asset('storage/' . $m->file_name);
                                    @endphp

                                    @if (Str::startsWith($m->mime_type, 'image/'))
                                        <img src="{{ $url }}" width="140" height="90" 
                                             class="rounded mb-2 me-2">
                                    @else
                                        <a href="{{ $url }}" target="_blank" class="d-block mb-2">
                                            📄 {{ basename($m->file_name) }}
                                        </a>
                                    @endif
                                @endforeach
                            @else
                                <p><i>Tidak ada file</i></p>
                            @endif
                        </div>

                        <!-- Upload Media Baru -->
                        <div class="mb-3">
                            <label>Upload Media Baru (Opsional)</label>
                            <input type="file" name="media[]" class="form-control" multiple>
                            <small class="text-muted">Bisa upload lebih dari satu file</small>
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('program_bantuan.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

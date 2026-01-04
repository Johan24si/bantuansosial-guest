@extends('layouts2.guest.app')

@section('content')

<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">
            Verifikasi Lapangan
        </h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-warning active">Verifikasi</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4>Edit Verifikasi Lapangan</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('verifikasi.update', $verifikasi->verifikasi_id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- PETUGAS --}}
            <div class="mb-3">
                <label class="form-label">Petugas</label>
                <input type="text"
                       name="petugas"
                       class="form-control"
                       value="{{ $verifikasi->petugas }}"
                       required>
            </div>

            {{-- TANGGAL --}}
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date"
                       name="tanggal"
                       class="form-control"
                       value="{{ $verifikasi->tanggal }}"
                       required>
            </div>

            {{-- CATATAN --}}
            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="catatan"
                          class="form-control"
                          rows="3">{{ $verifikasi->catatan }}</textarea>
            </div>

            {{-- FOTO --}}
            <div class="mb-4">
                <label class="form-label">Foto Verifikasi</label><br>

                @php
                    $media = $verifikasi->media->first();
                    $foto = $media
                        ? asset('storage/' . $media->file_name)
                        : 'https://images.unsplash.com/photo-1581090700227-1e37b190418e?auto=format&fit=crop&w=600&q=80';
                @endphp

                {{-- Preview Foto --}}
                <img id="previewFoto"
                     src="{{ $foto }}"
                     class="img-fluid rounded mb-3"
                     style="max-height:200px; object-fit:cover;">

                {{-- Upload Baru --}}
                <input type="file"
                       name="foto"
                       class="form-control"
                       onchange="previewImage(event)">

                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti foto
                </small>
            </div>

            {{-- BUTTON --}}
            <div class="mt-3">
                <button class="btn btn-success">Update</button>
                <a href="{{ route('pages.verifikasi.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>

{{-- PREVIEW JS --}}
<script>
function previewImage(event) {
    const img = document.getElementById('previewFoto');
    img.src = URL.createObjectURL(event.target.files[0]);
}
</script>

@endsection

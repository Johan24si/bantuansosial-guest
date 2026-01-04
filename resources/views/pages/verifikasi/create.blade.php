@extends('layouts2.guest.app')

@section('content')

<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Verifikasi Lapangan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-warning active" aria-current="page">verifikasi</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>Tambah Verifikasi Lapangan</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('verifikasi.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
    <label class="form-label">Pendaftar</label>
    <select name="pendaftar_id" class="form-control" required>
        <option value="">-- Pilih Pendaftar --</option>

        @foreach ($pendaftar as $p)
            <option value="{{ $p->pendaftar_id }}">
    {{ $p->pendaftar_id }}
</option>
        @endforeach

    </select>
</div>

            <div class="mb-3">
                <label>Petugas</label>
                <input type="text"
                       name="petugas"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date"
                       name="tanggal"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan"
                          class="form-control"></textarea>
            </div>

            {{-- FOTO VERIFIKASI (DISESUAIKAN, TANPA UBAH LOGIC) --}}
            <div class="mb-4">
                <label>Foto</label><br>

                {{-- Placeholder preview --}}
                <img id="previewFoto"
                     src="https://images.unsplash.com/photo-1581090700227-1e37b190418e?auto=format&fit=crop&w=600&q=80"
                     class="img-fluid rounded mb-3"
                     style="max-height:200px; object-fit:cover;">

                <input type="file"
                       name="foto"
                       class="form-control"
                       onchange="previewImage(event)">
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('pages.verifikasi.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>

{{-- Preview JS (HANYA TAMBAHAN, TIDAK MENGUBAH LOGIC) --}}
<script>
function previewImage(event) {
    const img = document.getElementById('previewFoto');
    img.src = URL.createObjectURL(event.target.files[0]);
}
</script>
@endsection

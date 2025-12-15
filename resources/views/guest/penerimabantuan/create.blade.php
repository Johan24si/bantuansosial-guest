@extends('layouts2.guest.app')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header  wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Penerima Bantuan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-warning active" aria-current="page">Penerima Bantuan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <h4>Tambah Penerima Bantuan</h4>

    <form action="{{ route('penerima_bantuan.store') }}" method="POST">
        @csrf

        <!-- Program Bantuan -->
        <div class="mb-3">
            <label class="form-label">Program Bantuan</label>
            <select name="program_id" class="form-control" required>
                <option value="">-- Pilih Program --</option>
                @foreach($program as $p)
                    <option value="{{ $p->program_id }}">
                        {{ $p->nama_program }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Warga -->
        <div class="mb-3">
            <label class="form-label">Warga</label>
            <select name="warga_id" class="form-control" required>
                <option value="">-- Pilih Warga --</option>
                @foreach($warga as $w)
                    <option value="{{ $w->warga_id }}">
                        {{ $w->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Keterangan -->
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('penerima_bantuan.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection

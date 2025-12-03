@extends('layouts2.guest.app')
@section('content')

<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Program Bantuan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Program Bantuan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-dark p-4 rounded-4 shadow-lg">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white fw-bold">
            <i class="bi bi-clipboard-data-fill me-2"></i> Data Program Bantuan
        </h3>
        <a href="{{ route('program_bantuan.create') }}" class="btn btn-success fw-semibold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Program
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    {{-- SEARCH & FILTER --}}
    <div class="row mb-4">

        <div class="col-md-5">
            <form method="GET" action="{{ route('program_bantuan.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari program..."
                           value="{{ request('search') }}">

                    <button class="btn btn-primary">Cari</button>

                    @if(request('search'))
                        <a href="{{ route('program_bantuan.index', ['tahun' => request('tahun')]) }}"
                           class="btn btn-outline-secondary ms-2">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="col-md-3">
            <form method="GET" action="{{ route('program_bantuan.index') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">

                <select name="tahun" class="form-select" onchange="this.form.submit()">
                    <option value="">Filter Tahun</option>
                    @foreach($programs->pluck('tahun')->unique() as $th)
                        <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>
                            {{ $th }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

    </div>

    {{-- LIST CARD --}}
    <div class="row g-4">
        @foreach($programs as $p)
        <div class="col-md-4">
            <div class="card border-0 shadow-lg h-100 hover-zoom" style="border-radius:18px; overflow:hidden;">

                {{-- Thumbnail Gambar --}}
                <div style="height:180px; overflow:hidden;">

                    @php
                        $img = $p->media->first();

                        if ($img && file_exists(storage_path('app/public/' . $img->file_name))) {
                            $imgPath = asset('storage/' . $img->file_name);
                        } else {
                            $imgPath = 'https://via.placeholder.com/400x200?text=No+Image';
                        }
                    @endphp

                    <img src="{{ $imgPath }}" class="w-100 h-100 object-fit-cover">

                </div>

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-primary mb-0">
                            <i class="bi bi-journal-text me-1"></i> {{ $p->nama_program }}
                        </h5>
                        <span class="badge bg-secondary">{{ $p->tahun }}</span>
                    </div>

                    <small class="text-muted">Kode Program:</small>
                    <p class="mb-2 fw-semibold">{{ $p->kode }}</p>

                    <p class="mb-1">
                        <i class="bi bi-cash-stack me-1"></i>
                        Rp{{ number_format($p->anggaran, 2, ',', '.') }}
                    </p>

                    <p class="text-muted">
                        <i class="bi bi-card-text me-1"></i>
                        {{ \Illuminate\Support\Str::limit($p->deskripsi, 60) }}
                    </p>

                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('program_bantuan.edit', $p->program_id) }}"
                           class="btn btn-warning btn-sm w-50 shadow-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <form action="{{ route('program_bantuan.destroy', $p->program_id) }}"
                              method="POST" class="w-50">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100 shadow-sm"
                                    onclick="return confirm('Yakin hapus program ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $programs->links('pagination::bootstrap-5') }}
    </div>

</div>

<style>
.hover-zoom:hover {
    transform: scale(1.04);
    box-shadow: 0 8px 30px rgba(0,0,0,0.3) !important;
}
.object-fit-cover {
    object-fit: cover;
}
</style>

@endsection

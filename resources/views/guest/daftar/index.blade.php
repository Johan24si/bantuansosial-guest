@extends('layouts2.guest.app')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Pendaftar Bantuan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Pendaftar Bantuan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-dark p-4 rounded-4 shadow-lg">

    <!-- Header Title + Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white fw-bold">
            <i class="bi bi-people-fill me-2"></i> Data Pendaftar Bantuan
        </h3>
        <a href="{{ route('create') }}" class="btn btn-success fw-semibold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Pendaftar
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <!-- SEARCH + FILTER -->
    <div class="row mb-4">

        <!-- SEARCH -->
        <div class="col-md-5">
            <form method="GET" action="{{ route('index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari pendaftar..." value="{{ $search }}">

                    <button class="btn btn-primary">Cari</button>

                    @if($search)
                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                           class="btn btn-outline-secondary ms-2">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- FILTER STATUS -->
        <div class="col-md-3">
            <form method="GET" action="{{ route('index') }}">
                <select name="filter" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Filter Status --</option>
                    <option value="lulus"       {{ $filter=='lulus' ? 'selected' : '' }}>Lulus</option>
                    <option value="TidakLulus" {{ $filter=='TidakLulus' ? 'selected' : '' }}>Tidak Lulus</option>
                    <option value="menunggu"    {{ $filter=='menunggu' ? 'selected' : '' }}>Menunggu</option>
                </select>
            </form>
        </div>

    </div>

    <!-- CARD LIST -->
    <div class="row g-4">

        @forelse($pendaftar as $item)

          @php
    $media = $item->media->first();

    if ($media && file_exists(storage_path('app/public/' . $media->file_name))) {
        $foto = asset('storage/' . $media->file_name);
    } else {
        $foto = asset('images/noimage.png');
    }
@endphp
            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100 hover-zoom"
                     style="border-radius:18px; overflow:hidden;">

                    <!-- FOTO -->
                    <div style="height:180px; overflow:hidden;">
                        <img src="{{ $foto }}" class="w-100 h-100 object-fit-cover">
                             class="w-100 h-100 object-fit-cover">
                    </div>

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold text-primary mb-0">
                                <i class="bi bi-person-vcard-fill me-1"></i>
                                Pendaftar #{{ $item->pendaftar_id }}
                            </h5>

                            <span class="badge bg-info text-dark">{{ $item->status_seleksi }}</span>
                        </div>

                        <small class="text-muted">ID Warga:</small>
                        <p class="mb-2 fw-semibold">{{ $item->warga_id }}</p>

                        <p class="mb-1">
                            <i class="bi bi-list-stars me-1"></i>
                            <strong>Program:</strong> {{ $item->program->nama_program }}
                            ({{ $item->program->tahun }})
                        </p>

                        <p class="text-muted">
                            <i class="bi bi-calendar-event me-1"></i>
                            {{ $item->created_at->format('d M Y') }}
                        </p>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('edit', $item->pendaftar_id) }}"
                               class="btn btn-warning btn-sm w-50 shadow-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('delete', $item->pendaftar_id) }}"
                                  method="POST" class="w-50"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100 shadow-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        @empty

            <div class="col-12 text-center text-white">
                <p class="fs-5">Belum ada data pendaftar bantuan.</p>
            </div>

        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-center mt-4">
        {{ $pendaftar->links('pagination::bootstrap-5') }}
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

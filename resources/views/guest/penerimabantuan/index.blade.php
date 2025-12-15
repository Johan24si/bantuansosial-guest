@extends('layouts2.guest.app')
@section('content')

<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4 cosmic-title">Penerima Bantuan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-warning active" aria-current="page">Penerima Bantuan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid py-5 cosmic-bg" style="min-height: 100vh;">
    <div class="container">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="text-white fw-bold cosmic-title">
                    <i class="bi bi-handbag-fill me-3"></i> Penerima Bantuan
                </h2>
                <p class="text-light mb-0 opacity-75">Kelola data penerima bantuan dengan sistem yang terintegrasi</p>
            </div>
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('penerima_bantuan.create') }}" class="btn btn-success d-flex align-items-center px-4 py-3 btn-glow">
                    <i class="bi bi-plus-circle me-2 fs-5"></i> Tambah Penerima
                </a>
            @endif
        </div>

        {{-- SEARCH & FILTER --}}
        <div class="card border-0 shadow-lg rounded-4 mb-5 bg-space">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('penerima_bantuan.index') }}">
                    <div class="row g-3">
                        {{-- Search --}}
                        <div class="col-md-4">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-space border-space input-group-prepend-custom">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       class="form-control search-input-custom border-space search-input-glow"
                                       placeholder="Cari nama warga..."
                                       value="{{ request('search') }}"
                                       id="searchInput">

                                @if(request('search'))
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null, 'page' => null]) }}"
                                       class="input-group-text bg-space border-space input-group-append-custom text-danger">
                                        <i class="bi bi-x-circle"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Filter Program --}}
                        <div class="col-md-4">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-space border-space input-group-prepend-custom">
                                    <i class="bi bi-award"></i>
                                </span>
                                <select name="program" 
                                        class="form-select select-custom border-space select-glow"
                                        onchange="this.form.submit()">
                                    <option value="">Semua Program</option>
                                    @foreach($programs as $program)
                                        <option value="{{ $program->program_id }}" 
                                                {{ request('program') == $program->program_id ? 'selected' : '' }}>
                                            {{ $program->nama_program }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Filter Button --}}
                        <div class="col-md-2">
                            <button type="submit" 
                                    class="btn btn-primary w-100 h-100 btn-glow">
                                <i class="bi bi-funnel me-2"></i> Filter
                            </button>
                        </div>

                        {{-- Clear Filter --}}
                        @if(request('search') || request('program'))
                            <div class="col-md-2">
                                <a href="{{ request()->fullUrlWithQuery(['search' => null, 'program' => null, 'page' => null]) }}"
                                   class="btn btn-outline-light w-100 h-100 d-flex align-items-center justify-content-center text-danger">
                                    <i class="bi bi-x-circle me-2"></i> Clear
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success alert-glow-success shadow-lg rounded-4 mb-4 border-0">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-3 fs-4"></i>
                    <div class="flex-grow-1">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        {{-- STATS CARD --}}
        <div class="row mb-5 g-4">
            <div class="col-md-3">
                <div class="stats-card-2 p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3" style="background: rgba(0, 123, 255, 0.1);">
                            <i class="bi bi-people-fill text-primary"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ $data->total() }}</h3>
                            <p class="text-muted mb-0">Total Penerima</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card-2 p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3" style="background: rgba(25, 135, 84, 0.1);">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ $data->count() }}</h3>
                            <p class="text-muted mb-0">Status Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card-2 p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3" style="background: rgba(255, 193, 7, 0.1);">
                            <i class="bi bi-award-fill text-warning"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ $programs->count() }}</h3>
                            <p class="text-muted mb-0">Program Bantuan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card-2 p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3" style="background: rgba(111, 66, 193, 0.1);">
                            <i class="bi bi-calendar-heart-fill text-info"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ now()->format('M Y') }}</h3>
                            <p class="text-muted mb-0">Periode Saat Ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PENERIMA BANTUAN CARDS --}}
        <div class="row g-4">
            @forelse($data as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg h-100 rounded-4 card-3d penerima-card"
                         style="border-left: 5px solid #3498db;">

                        {{-- Top Gradient Border --}}
                        <div class="position-absolute top-0 start-0 w-100 penerima-gradient-border"
                             style="height: 8px; background: linear-gradient(90deg, #3498db, #2980b9);">
                        </div>

                        <div class="card-body p-4 bg-space">
                            {{-- Header --}}
                            <div class="d-flex align-items-start mb-4">
                                {{-- Avatar --}}
                                <div class="position-relative me-3">
                                    <div class="avatar-wrapper rounded-circle overflow-hidden"
                                         style="width: 70px; height: 70px; background: linear-gradient(135deg, #3498db, #2980b9);">
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                            <span class="text-white fw-bold fs-3">
                                                {{ strtoupper(substr($item->warga->nama ?? 'W', 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="position-absolute bottom-0 end-0 status-indicator bg-success">
                                        <i class="bi bi-check-circle text-white"></i>
                                    </div>
                                </div>

                                {{-- Info --}}
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="text-white fw-bold mb-1">{{ $item->warga->nama ?? 'N/A' }}</h5>
                                            <p class="text-muted mb-1">
                                                <i class="bi bi-person-badge me-1"></i> 
                                                {{ $item->warga->nik ?? 'Tidak tersedia' }}
                                            </p>
                                        </div>
                                        {{-- Program Badge --}}
                                        @if($item->program)
                                            @php
                                                $programColors = ['#e74c3c', '#3498db', '#2ecc71', '#f39c12', '#9b59b6'];
                                                $colorIndex = $item->program->program_id % count($programColors);
                                                $programColor = $programColors[$colorIndex];
                                            @endphp
                                            <span class="badge program-badge" style="background: {{ $programColor }};">
                                                {{ $item->program->nama_program }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Contact Info --}}
                                    <div class="mt-3">
                                        <p class="text-light mb-1">
                                            <i class="bi bi-telephone me-2"></i>
                                            <span class="contact-info">{{ $item->warga->telepon ?? 'Tidak tersedia' }}</span>
                                        </p>
                                        @if($item->warga->email)
                                            <p class="text-light mb-0">
                                                <i class="bi bi-envelope me-2"></i>
                                                <span class="contact-info">{{ $item->warga->email }}</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Program & Nomor Kartu --}}
                            <div class="row g-2 mb-3">
                                <div class="col-12">
                                    <div class="program-card p-3 rounded-3 mb-3" style="background: rgba(52, 152, 219, 0.1);">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-award-fill text-info me-2"></i>
                                            <small class="text-muted">Program Bantuan</small>
                                        </div>
                                        <h6 class="mb-0 text-white">{{ $item->program->nama_program ?? 'Tidak tersedia' }}</h6>
                                    </div>
                                </div>
                            </div>

                            {{-- Nomor Kartu Bantuan --}}
                            <div class="nomor-kartu-box p-3 rounded-3 mb-3" style="background: rgba(255, 255, 255, 0.05); border: 1px dashed rgba(255, 255, 255, 0.2);">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-credit-card-fill text-warning me-2"></i>
                                    <small class="text-muted">Nomor Kartu Bantuan</small>
                                </div>
                                <div class="text-center">
                                    <h5 class="text-white font-monospace mb-0" style="letter-spacing: 2px;">
                                        {{ $item->warga->nik ?? 'Tidak tersedia' }}
                                    </h5>
                                </div>
                            </div>

                            {{-- Quick Stats --}}
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="penerima-stat p-2 text-center rounded-3">
                                        <small class="text-muted d-block">ID Warga</small>
                                        <h6 class="mb-0 text-white">#{{ $item->warga->warga_id ?? 'N/A' }}</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="penerima-stat p-2 text-center rounded-3">
                                        <small class="text-muted d-block">Status</small>
                                        <span class="text-success">
                                            <i class="bi bi-check-circle me-1"></i>Aktif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Keterangan --}}
                            @if($item->keterangan)
                                <div class="keterangan-box p-3 rounded-3 mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-chat-left-text-fill text-warning me-2"></i>
                                        <small class="text-muted">Keterangan</small>
                                    </div>
                                    <p class="text-light mb-0 small">{{ Str::limit($item->keterangan, 100) }}</p>
                                </div>
                            @endif

                            {{-- Action Buttons --}}
                            <div class="d-flex gap-2 mt-3">
                                @if(auth()->user()->role == 'admin')
                                    <a href="{{ route('penerima_bantuan.edit', $item->penerima_id) }}"
                                       class="btn btn-warning flex-fill py-2 btn-glow">
                                        <i class="bi bi-pencil-square me-2"></i> Edit
                                    </a>

                                    <button type="button" 
                                            class="btn btn-info flex-fill py-2 btn-glow"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalDetail{{ $item->penerima_id }}">
                                        <i class="bi bi-eye me-2"></i> View
                                    </button>

                                    <form action="{{ route('penerima_bantuan.destroy', $item->penerima_id) }}" 
                                          method="POST"
                                          onsubmit="return confirm('Yakin hapus data penerima ini?')" 
                                          class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100 py-2 btn-glow">
                                            <i class="bi bi-trash me-2"></i> Hapus
                                        </button>
                                    </form>
                                @else
                                    <button type="button" 
                                            class="btn btn-info flex-fill py-2 btn-glow"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalDetail{{ $item->penerima_id }}">
                                        <i class="bi bi-eye me-2"></i> Detail
                                    </button>
                                    <button type="button" class="btn btn-outline-light flex-fill py-2">
                                        <i class="bi bi-download me-2"></i> Export
                                    </button>
                                    <button type="button" class="btn btn-outline-light flex-fill py-2">
                                        <i class="bi bi-share me-2"></i> Share
                                    </button>
                                @endif
                            </div>

                            {{-- Quick Actions --}}
                            <div class="text-center mt-3">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-light btn-sm px-3"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalDetail{{ $item->penerima_id }}">
                                        <i class="bi bi-card-text"></i> Detail
                                    </button>
                                    
                                    {{-- Modal Detail --}}
                                    <div class="modal fade" id="modalDetail{{ $item->penerima_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content cosmic-bg" style="border-radius:20px; border:1px solid rgba(255,255,255,0.1);">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title text-white fw-bold">
                                                        <i class="bi bi-handbag-fill me-2 text-info"></i> Detail Penerima Bantuan
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <div class="rounded-circle overflow-hidden shadow mx-auto"
                                                                 style="width:150px; height:150px; background:linear-gradient(135deg, #3498db, #2980b9); display:flex; align-items:center; justify-content:center;">
                                                                <span class="text-white fw-bold" style="font-size:4rem;">
                                                                    {{ strtoupper(substr($item->warga->nama ?? 'W', 0, 1)) }}
                                                                </span>
                                                            </div>
                                                            <div class="mt-4">
                                                                <span class="badge bg-success px-3 py-2 fw-bold">
                                                                    <i class="bi bi-check-circle me-1"></i>Status Aktif
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h4 class="text-white fw-bold mb-3">{{ $item->warga->nama ?? 'N/A' }}</h4>
                                                            <div class="mb-3">
                                                                <h6 class="text-info mb-2">
                                                                    <i class="bi bi-award me-2"></i>Program Bantuan
                                                                </h6>
                                                                <p class="text-light">{{ $item->program->nama_program ?? 'Tidak tersedia' }}</p>
                                                            </div>
                                                            <p class="text-light mb-2">
                                                                <i class="bi bi-person-vcard me-2"></i>
                                                                <b>NIK:</b> {{ $item->warga->nik ?? 'Tidak tersedia' }}
                                                            </p>
                                                            <p class="text-light mb-2">
                                                                <i class="bi bi-telephone me-2 text-info"></i>
                                                                <b>Telp:</b> {{ $item->warga->telepon ?? 'Tidak tersedia' }}
                                                            </p>
                                                            @if($item->warga->email)
                                                                <p class="text-light mb-2">
                                                                    <i class="bi bi-envelope me-2 text-warning"></i>
                                                                    <b>Email:</b> {{ $item->warga->email }}
                                                                </p>
                                                            @endif
                                                            <p class="text-light mb-2">
                                                                <i class="bi bi-hash me-2"></i>
                                                                <b>ID Warga:</b> #{{ $item->warga->warga_id ?? 'N/A' }}
                                                            </p>
                                                            <p class="text-light mb-2">
                                                                <i class="bi bi-credit-card me-2"></i>
                                                                <b>Nomor Kartu:</b> {{ $item->warga->nik ?? 'Tidak tersedia' }}
                                                            </p>
                                                            @if($item->keterangan)
                                                                <div class="mt-3">
                                                                    <h6 class="text-warning mb-2">
                                                                        <i class="bi bi-chat-left-text me-2"></i>Keterangan
                                                                    </h6>
                                                                    <p class="text-light">{{ $item->keterangan }}</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    @if(auth()->user()->role == 'admin')
                                                        <a href="{{ route('penerima_bantuan.edit', $item->penerima_id) }}" class="btn btn-warning">
                                                            <i class="bi bi-pencil me-2"></i>Edit
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-outline-light btn-sm px-3">
                                        <i class="bi bi-file-earmark-pdf"></i> Export
                                    </button>
                                    <button type="button" class="btn btn-outline-light btn-sm px-3">
                                        <i class="bi bi-share"></i> Share
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Card Footer --}}
                        <div class="card-footer bg-space border-top-0 text-center py-3">
                            <small class="text-muted">
                                <i class="bi bi-calendar-event me-1"></i>
                                Terdaftar: {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : 'N/A' }}
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state-card text-center p-5">
                        <div class="empty-state-icon mb-4">
                            <i class="bi bi-handbag display-1 text-muted"></i>
                        </div>
                        <h4 class="text-white mb-3">Belum ada data penerima bantuan</h4>
                        <p class="text-muted mb-4">Mulai dengan menambahkan penerima bantuan baru</p>
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('penerima_bantuan.create') }}" class="btn btn-success btn-lg btn-glow px-4">
                                <i class="bi bi-plus-circle me-2"></i> Tambah Penerima Pertama
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($data->hasPages())
            <div class="d-flex justify-content-center mt-5">
                <div class="pagination-wrapper">
                    {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif

    </div>
</div>

<style>
/* Cosmic Background */
.cosmic-bg {
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%);
    position: relative;
    overflow: hidden;
}

.cosmic-bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        radial-gradient(circle at 20% 80%, rgba(52, 152, 219, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(155, 89, 182, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(46, 204, 113, 0.1) 0%, transparent 50%);
    animation: twinkle 8s infinite alternate;
    z-index: -1;
}

/* Card 3D Effect */
.card-3d {
    transform-style: preserve-3d;
    perspective: 1000px;
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(30, 30, 46, 0.8);
    backdrop-filter: blur(10px);
}

.card-3d:hover {
    transform: translateY(-15px) rotateX(5deg);
    box-shadow:
        0 25px 50px rgba(0, 0, 0, 0.5),
        0 0 100px rgba(52, 152, 219, 0.3) !important;
}

.penerima-card:hover .penerima-gradient-border {
    animation: gradientFlow 2s infinite;
}

/* Glow Effects */
.btn-glow {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.btn-glow::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: all 0.5s ease;
}

.btn-glow:hover::before {
    left: 100%;
}

.btn-glow:hover {
    box-shadow: 0 0 20px rgba(var(--bs-btn-bg-rgb), 0.8);
    transform: scale(1.05);
}

/* Stats Cards */
.stats-card-2 {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.stats-card-2:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 255, 255, 0.2);
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
}

/* Status Indicator */
.status-indicator {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    border: 2px solid #2c3e50;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    box-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
}

/* Program Badge */
.program-badge {
    animation: badgeFloat 3s ease-in-out infinite;
    font-size: 0.8rem;
    padding: 0.4em 0.8em;
    border-radius: 50rem;
    color: white;
    font-weight: 500;
}

/* Program Card */
.program-card {
    background: rgba(52, 152, 219, 0.1);
    border-left: 3px solid #3498db;
    transition: all 0.3s ease;
}

.program-card:hover {
    background: rgba(52, 152, 219, 0.2);
    transform: translateX(5px);
}

/* Nomor Kartu Box */
.nomor-kartu-box {
    transition: all 0.3s ease;
}

.nomor-kartu-box:hover {
    border-style: solid !important;
    border-color: rgba(255, 193, 7, 0.5) !important;
    background: rgba(255, 255, 255, 0.08);
}

/* Penerima Stats */
.penerima-stat {
    background: rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.penerima-stat:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

/* Keterangan Box */
.keterangan-box {
    background: rgba(255, 193, 7, 0.05);
    border-left: 3px solid #ffc107;
}

/* Avatar */
.avatar-wrapper {
    border: 3px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.penerima-card:hover .avatar-wrapper {
    border-color: rgba(52, 152, 219, 0.6);
    transform: scale(1.05);
}

/* Contact Info */
.contact-info {
    background: linear-gradient(45deg, #fff, #3498db);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.contact-info:hover {
    background: linear-gradient(45deg, #3498db, #2980b9);
    -webkit-background-clip: text;
    background-clip: text;
}

/* Background Space */
.bg-space {
    background: rgba(20, 20, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.border-space {
    border-color: rgba(255, 255, 255, 0.2) !important;
}

/* INPUT SEARCH FIX - TEKS TERLIHAT JELAS */
.input-group-prepend-custom {
    background: rgba(255, 255, 255, 0.1) !important;
    border-color: rgba(255, 255, 255, 0.3) !important;
    color: #ffffff !important;
}

.input-group-append-custom {
    background: rgba(255, 255, 255, 0.1) !important;
    border-color: rgba(255, 255, 255, 0.3) !important;
}

/* Input Search Styling */
.search-input-custom {
    background: rgba(255, 255, 255, 0.1) !important;
    border-color: rgba(255, 255, 255, 0.3) !important;
    color: #ffffff !important;
    transition: all 0.3s ease;
}

/* Saat input aktif (sedang diketik) */
.search-input-custom:focus {
    background: rgba(255, 255, 255, 0.15) !important;
    color: #ffffff !important;
    border-color: #3498db !important;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.3),
                0 0 20px rgba(52, 152, 219, 0.2) !important;
}

/* Placeholder warna lebih terang */
.search-input-custom::placeholder {
    color: rgba(255, 255, 255, 0.6) !important;
}

/* Saat ada teks di input */
.search-input-custom:not(:placeholder-shown) {
    color: #ffffff !important;
    background: rgba(255, 255, 255, 0.15) !important;
}

/* Select Custom Styling */
.select-custom {
    background: rgba(255, 255, 255, 0.1) !important;
    border-color: rgba(255, 255, 255, 0.3) !important;
    color: #ffffff !important;
    transition: all 0.3s ease;
}

.select-custom:focus {
    background: rgba(255, 255, 255, 0.15) !important;
    color: #ffffff !important;
    border-color: #3498db !important;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.3),
                0 0 20px rgba(52, 152, 219, 0.2) !important;
}

/* Option styling untuk select */
.select-custom option {
    background: #1a1a2e !important;
    color: #ffffff !important;
}

.select-custom option:checked {
    background: #3498db !important;
    color: #ffffff !important;
}

/* Input Effects */
.search-input-glow:focus,
.select-glow:focus {
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.5),
                0 0 30px rgba(52, 152, 219, 0.3) !important;
    border-color: #3498db !important;
}

/* Cosmic Title */
.cosmic-title {
    background: linear-gradient(45deg, #fff, #3498db);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Empty State */
.empty-state-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 20px;
    border: 2px dashed rgba(255, 255, 255, 0.1);
}

.empty-state-icon {
    animation: bounce 2s infinite;
}

/* Alert Glow */
.alert-glow-success {
    animation: alertPulse 2s infinite;
    background: linear-gradient(45deg, #198754, #20c997);
    border: none;
    color: white;
}

/* Pagination */
.pagination-wrapper .page-link {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #fff;
    margin: 0 5px;
    border-radius: 10px !important;
    transition: all 0.3s ease;
}

.pagination-wrapper .page-link:hover {
    background: rgba(52, 152, 219, 0.3);
    transform: translateY(-2px);
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(45deg, #3498db, #2980b9);
    border-color: transparent;
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
}

/* ========================================= */
/* FIX MODAL TIDAK BISA DITUTUP */
/* ========================================= */

.modal,
.modal-backdrop {
    z-index: 999999 !important;
}

body.modal-open .card-3d {
    transform: none !important;
}

.modal.fade.show {
    transform: none !important;
}
.modal-backdrop.show {
    display: none !important;
}

.modal.show {
    z-index: 2000000 !important;
    position: fixed !important;
}
body.modal-open .card-3d {
    pointer-events: none !important;
}

/* Animations */
@keyframes badgeFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

@keyframes gradientFlow {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

@keyframes twinkle {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes alertPulse {
    0%, 100% { box-shadow: 0 0 10px #198754; }
    50% { box-shadow: 0 0 20px #20c997; }
}

/* Responsive */
@media (max-width: 768px) {
    .card-3d:hover {
        transform: translateY(-5px);
    }

    .stats-card-2 {
        padding: 1.5rem !important;
    }

    .avatar-wrapper {
        width: 60px !important;
        height: 60px !important;
    }

    .penerima-stat {
        padding: 0.5rem !important;
    }
    
    /* Perbaikan input di mobile */
    .search-input-custom,
    .select-custom {
        font-size: 1rem !important;
    }
}
</style>

<script>
// Add interactive effects
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.penerima-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.zIndex = '1000';
        });

        card.addEventListener('mouseleave', () => {
            card.style.zIndex = '1';
        });
    });

    // Add click animation to contact info
    const contactInfos = document.querySelectorAll('.contact-info');
    contactInfos.forEach(info => {
        info.addEventListener('click', function(e) {
            if(this.textContent.includes('@')) {
                window.location.href = 'mailto:' + this.textContent;
            } else if(this.textContent.match(/\d+/)) {
                window.location.href = 'tel:' + this.textContent.replace(/\D/g, '');
            }
        });
    });

    // Add hover effect to program cards
    const programCards = document.querySelectorAll('.program-card');
    programCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateX(5px)';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateX(0)';
        });
    });

    // Add copy functionality to nomor kartu
    const nomorKartuBoxes = document.querySelectorAll('.nomor-kartu-box');
    nomorKartuBoxes.forEach(box => {
        box.addEventListener('click', function() {
            const nomor = this.querySelector('h5').textContent.trim();
            navigator.clipboard.writeText(nomor).then(() => {
                const originalHTML = this.innerHTML;
                this.innerHTML = `
                    <div class="text-center">
                        <i class="bi bi-check-circle-fill text-success mb-2 d-block" style="font-size: 1.5rem;"></i>
                        <small class="text-success">Nomor kartu disalin!</small>
                    </div>
                `;
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                }, 2000);
            });
        });
    });

    // Focus effect untuk search input
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.parentElement.classList.add('input-focused');
        });
        
        searchInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('input-focused');
        });
    }
});
</script>

@endsection
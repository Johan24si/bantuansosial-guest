@extends('layouts2.guest.app')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header  wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Pendaftar Bantuan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-warning active" aria-current="page">Pendaftar Bantuan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-dark p-4 rounded-4 shadow-lg cosmic-bg">

    <!-- Header Title + Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('create') }}" class="btn btn-success fw-semibold shadow-lg btn-glow">
            <i class="bi bi-plus-circle me-1"></i> Tambah Pendaftar
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-lg alert-glow-success">{{ session('success') }}</div>
    @endif

    <!-- SEARCH + FILTER -->
    <div class="row mb-4">
        <!-- SEARCH -->
        <div class="col-md-5">
            <form method="GET" action="{{ route('index') }}">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-space text-white border-space">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control bg-space text-white border-space search-input-glow"
                           placeholder="Cari pendaftar..." value="{{ $search }}">

                    <button class="btn btn-primary px-4 btn-glow">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>

                    @if($search)
                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                           class="btn btn-outline-danger ms-2 border-space">
                            <i class="bi bi-x-circle me-1"></i> Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- FILTER STATUS -->
        <div class="col-md-3">
            <form method="GET" action="{{ route('index') }}">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-space text-white border-space">
                        <i class="bi bi-funnel"></i>
                    </span>
                    <select name="filter" class="form-select bg-space text-white border-space select-glow" onchange="this.form.submit()">
                        <option value="">-- Filter Status --</option>
                        <option value="lulus" {{ $filter=='lulus' ? 'selected' : '' }}>✅ Lulus</option>
                        <option value="TidakLulus" {{ $filter=='TidakLulus' ? 'selected' : '' }}>❌ Tidak Lulus</option>
                        <option value="menunggu" {{ $filter=='menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="col-md-4 text-end">
            <div class="stats-card p-3">
                <h5 class="text-white mb-0">Total: {{ $pendaftar->total() }} Pendaftar</h5>
            </div>
        </div>

    </div>

    <!-- CARD LIST -->
    <div class="row g-4">

        @forelse($pendaftar as $item)

          @php
    $img = $item->media->first();

    if ($img && file_exists(storage_path('app/public/' . $img->file_name))) {
        $foto = asset('storage/' . $img->file_name);
    } else {
        // Placeholder dari Unsplash (compressed)
        $foto = 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=400&q=80';
    }

    // Define status colors
    $statusColors = [
        'lulus' => ['badge' => 'bg-success-glow', 'border' => '#00ff88'],
        'TidakLulus' => ['badge' => 'bg-danger-glow', 'border' => '#ff4757'],
        'menunggu' => ['badge' => 'bg-warning-glow', 'border' => '#ffa502']
    ];

    $statusColor = $statusColors[$item->status_seleksi] ?? ['badge' => 'bg-secondary', 'border' => '#6c757d'];
@endphp

            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100 card-3d"
                     style="border-radius:20px; overflow:hidden; border-left: 5px solid {{ $statusColor['border'] }};">

                    <!-- FOTO -->
                    <div style="height:200px; overflow:hidden; position: relative;">
                        <img src="{{ $foto }}" class="w-100 h-100 object-fit-cover card-image">
                        <div class="card-image-overlay"></div>

                        <!-- Floating Status Badge -->
                        <div class="position-absolute top-3 end-3">
                            <span class="badge {{ $statusColor['badge'] }} px-3 py-2 fw-bold badge-floating">
                                {{ $item->status_seleksi }}
                            </span>
                        </div>

                        <!-- ID Badge -->
                        <div class="position-absolute bottom-3 start-3">
                            <span class="badge bg-dark bg-opacity-75 px-3 py-2">
                                <i class="bi bi-person-badge me-1"></i> ID: {{ $item->warga_id }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-4 bg-space">

                        <!-- Program Info -->
                        <div class="program-card mb-3 p-3 rounded-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-award-fill text-warning me-2 fs-5"></i>
                                <h6 class="mb-0 text-white">Program Bantuan</h6>
                            </div>
                            <h5 class="text-warning fw-bold">{{ $item->program->nama_program }}</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-info bg-opacity-25 text-info">
                                    <i class="bi bi-calendar me-1"></i> {{ $item->program->tahun }}
                                </span>
                                <small class="text-light opacity-75">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="stat-box p-2 text-center rounded-3">
                                    <small class="d-block text-muted">ID Pendaftar</small>
                                    <h6 class="mb-0 text-white">#{{ $item->pendaftar_id }}</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-box p-2 text-center rounded-3">
                                    <small class="d-block text-muted">Tanggal Daftar</small>
                                    <h6 class="mb-0 text-white">{{ $item->created_at->format('d/m/Y') }}</h6>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('edit', $item->pendaftar_id) }}"
                               class="btn btn-warning btn-glow w-50 py-2">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>

                            <form action="{{ route('delete', $item->pendaftar_id) }}"
                                  method="POST" class="w-50"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-glow w-100 py-2">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>

                       <!-- Quick View -->
<div class="text-center mt-3">
    <a href="#" class="text-info text-decoration-none me-3"
       data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->pendaftar_id }}">
        <i class="bi bi-eye me-1"></i> Lihat Detail
    </a>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail{{ $item->pendaftar_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content cosmic-bg"
             style="border-radius:20px; border:1px solid rgba(255,255,255,0.1);">

            <div class="modal-header border-0">
                <h5 class="modal-title text-white fw-bold">
                    <i class="bi bi-eye-fill me-2 text-info"></i> Detail Pendaftar
                </h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

          @php
    $img = $item->media->first();

    if ($img && file_exists(storage_path('app/public/' . $img->file_name))) {
        $imgPath = asset('storage/' . $img->file_name);
    } else {
        // fallback sama seperti card (biar konsisten)
        $imgPath = 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=400&q=80';
    }
@endphp

                <div class="row">
                    <div class="col-md-5 text-center">
                   <img src="{{ $imgPath }}" class="img-fluid rounded shadow"
     style="max-height:220px; object-fit:cover;">

                        <span class="badge mt-3 px-3 py-2 fw-bold bg-info">
                            <i class="bi bi-person-badge me-1"></i> ID: {{ $item->pendaftar_id }}
                        </span>
                    </div>

                    <div class="col-md-7">

                        <h4 class="text-white fw-bold mb-3">
                            {{ $item->nama_lengkap ?? 'Tidak Ada Nama' }}
                        </h4>

                        <p class="text-light mb-2">
                            <i class="bi bi-check2-circle text-success me-2"></i>
                            <b>Status Seleksi:</b> {{ $item->status_seleksi }}
                        </p>

                        <p class="text-light mb-2">
                            <i class="bi bi-award-fill me-2 text-warning"></i>
                            <b>Program:</b> {{ $item->program->nama_program }}
                        </p>

                        <p class="text-light mb-2">
                            <i class="bi bi-calendar me-2"></i>
                            <b>Tahun Program:</b> {{ $item->program->tahun }}
                        </p>

                        <p class="text-light mb-2">
                            <i class="bi bi-clock-history me-2"></i>
                            <b>Didaftarkan:</b> {{ $item->created_at->format('d M Y') }}
                        </p>

                        <p class="text-light mb-2">
                            <i class="bi bi-info-circle me-2"></i>
                            <b>Catatan:</b> {{ $item->catatan ?? '-' }}
                        </p>

                        <hr class="border-secondary">

                        <p class="text-light">
                            <b>Deskripsi Program:</b><br>
                            {{ $item->program->deskripsi ?? 'Tidak ada deskripsi' }}
                        </p>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


                    </div>
                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="empty-state-card text-center p-5">
                    <div class="empty-state-icon mb-4">
                        <i class="bi bi-people display-1 text-muted"></i>
                    </div>
                    <h4 class="text-white mb-3">Belum ada data pendaftar</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan pendaftar bantuan pertama Anda</p>
                    <a href="{{ route('create') }}" class="btn btn-success btn-lg btn-glow px-4">
                        <i class="bi bi-plus-circle me-2"></i> Tambah Pendaftar
                    </a>
                </div>
            </div>

        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-center mt-5">
        <div class="pagination-wrapper">
            {{ $pendaftar->links('pagination::bootstrap-5') }}
        </div>
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
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.1) 0%, transparent 50%);
    animation: twinkle 8s infinite alternate;
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
        0 0 100px rgba(var(--bs-primary-rgb), 0.3) !important;
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

/* Badge Glow */
.bg-success-glow {
    background: linear-gradient(45deg, #00b09b, #96c93d);
    animation: badgePulse 2s infinite;
}

.bg-danger-glow {
    background: linear-gradient(45deg, #ff416c, #ff4b2b);
    animation: badgePulse 2s infinite;
}

.bg-warning-glow {
    background: linear-gradient(45deg, #f7971e, #ffd200);
    animation: badgePulse 2s infinite;
}

.badge-floating {
    animation: float 3s ease-in-out infinite;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

/* Image Effects */
.card-image {
    transition: transform 0.5s ease;
}

.card-3d:hover .card-image {
    transform: scale(1.1);
}

.card-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, 0.7));
}

/* Input Glow */
.search-input-glow:focus {
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.5),
                0 0 30px rgba(13, 110, 253, 0.3) !important;
    border-color: #0d6efd !important;
}

.select-glow:focus {
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.5),
                0 0 30px rgba(13, 110, 253, 0.3) !important;
    border-color: #0d6efd !important;
}

/* Background Space */
.bg-space {
    background: rgba(20, 20, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.border-space {
    border-color: rgba(255, 255, 255, 0.2) !important;
}

/* Program Card */
.program-card {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(255, 193, 7, 0.05));
    border: 1px solid rgba(255, 193, 7, 0.2);
}

/* Stat Box */
.stat-box {
    background: rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.stat-box:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
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
    background: rgba(var(--bs-primary-rgb), 0.3);
    transform: translateY(-2px);
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border-color: transparent;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes badgePulse {
    0%, 100% { box-shadow: 0 0 10px currentColor; }
    50% { box-shadow: 0 0 20px currentColor; }
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

/* Cosmic Title */
.cosmic-title {
    background: linear-gradient(45deg, #fff, #ffd700);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Stats Card */
.stats-card {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
    border-radius: 15px;
    border: 1px solid rgba(102, 126, 234, 0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .card-3d:hover {
        transform: translateY(-5px);
    }

    .cosmic-bg {
        padding: 1.5rem !important;
    }
}

.object-fit-cover {
    object-fit: cover;
}
</style>

<script>
// Add hover sound effects (optional)
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card-3d');
    const buttons = document.querySelectorAll('.btn-glow');

    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.zIndex = '1000';
        });

        card.addEventListener('mouseleave', () => {
            card.style.zIndex = '1';
        });
    });

    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            button.style.transform = 'scale(1.05)';
        });

        button.addEventListener('mouseleave', () => {
            button.style.transform = 'scale(1)';
        });
    });
});
</script>

@endsection

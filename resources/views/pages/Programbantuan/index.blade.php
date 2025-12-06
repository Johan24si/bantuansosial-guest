@extends('layouts2.guest.app')
@section('content')

<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Program Bantuan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-warning active" aria-current="page">Program Bantuan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-dark p-4 rounded-4 shadow-lg cosmic-bg">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="text-white fw-bold cosmic-title">
                <i class="bi bi-stars me-2"></i> Data Program Bantuan
            </h3>
            <p class="text-light mb-0 opacity-75">Kelola program bantuan sosial dengan efektif</p>
        </div>
        <a href="{{ route('program_bantuan.create') }}" class="btn btn-success fw-semibold shadow-lg btn-glow">
            <i class="bi bi-plus-circle me-1"></i> Tambah Program
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-lg alert-glow-success">{{ session('success') }}</div>
    @endif

    {{-- SEARCH & FILTER --}}
    <div class="row mb-4">
        <div class="col-md-5">
            <form method="GET" action="{{ route('program_bantuan.index') }}">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-space text-white border-space">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control bg-space text-white border-space search-input-glow"
                           placeholder="Cari program..."
                           value="{{ request('search') }}">

                    <button class="btn btn-primary px-4 btn-glow">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>

                    @if(request('search'))
                        <a href="{{ route('program_bantuan.index', ['tahun' => request('tahun')]) }}"
                           class="btn btn-outline-danger ms-2 border-space">
                            <i class="bi bi-x-circle me-1"></i> Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="col-md-3">
            <form method="GET" action="{{ route('program_bantuan.index') }}">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-space text-white border-space">
                        <i class="bi bi-filter"></i>
                    </span>
                    <select name="tahun" class="form-select bg-space text-white border-space select-glow" onchange="this.form.submit()">
                        <option value="">Tahun Program</option>
                        @foreach($programs->pluck('tahun')->unique() as $th)
                            <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>
                                📅 {{ $th }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="col-md-4 text-end">
            <div class="stats-card p-3">
                <h5 class="text-white mb-0">Total: {{ $programs->total() }} Program</h5>
            </div>
        </div>
    </div>

    {{-- LIST CARD --}}
    <div class="row g-4">
        @foreach($programs as $p)
        @php
            $img = $p->media->first();
            if ($img && file_exists(storage_path('app/public/' . $img->file_name))) {
                $imgPath = asset('storage/' . $img->file_name);
            } else {
                $imgPath = 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=400&q=80';
            }
            
            // Color based on year
            $yearColors = [
                '2024' => '#ff6b6b',
                '2023' => '#48dbfb',
                '2022' => '#1dd1a1',
                '2021' => '#feca57',
                '2020' => '#ff9ff3'
            ];
            $borderColor = $yearColors[$p->tahun] ?? '#6c757d';
        @endphp
        
        <div class="col-md-4">
            <div class="card border-0 shadow-lg h-100 card-3d"
                 style="border-radius:20px; overflow:hidden; border-left: 5px solid {{ $borderColor }};">
                
                {{-- Thumbnail Gambar --}}
                <div style="height:200px; overflow:hidden; position: relative;">
                    <img src="{{ $imgPath }}" class="w-100 h-100 object-fit-cover card-image">
                    <div class="card-image-overlay"></div>
                    
                    {{-- Year Badge --}}
                    <div class="position-absolute top-3 end-3">
                        <span class="badge year-badge px-3 py-2 fw-bold" style="background: {{ $borderColor }};">
                            <i class="bi bi-calendar-check me-1"></i> {{ $p->tahun }}
                        </span>
                    </div>
                    
                    {{-- Kode Badge --}}
                    <div class="position-absolute bottom-3 start-3">
                        <span class="badge bg-dark bg-opacity-75 px-3 py-2">
                            <i class="bi bi-hash me-1"></i> {{ $p->kode }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4 bg-space">
                    
                    {{-- Program Title --}}
                    <h5 class="text-white fw-bold mb-3 program-title">
                        <i class="bi bi-journal-text me-2"></i> {{ $p->nama_program }}
                    </h5>
                    
                    {{-- Anggaran Card --}}
                    <div class="budget-card mb-3 p-3 rounded-3">
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi bi-cash-stack text-success me-2"></i>
                            <small class="text-muted">Anggaran Program</small>
                        </div>
                        <h4 class="text-success fw-bold mb-0">
                            Rp{{ number_format($p->anggaran, 0, ',', '.') }}
                        </h4>
                    </div>
                    
                    {{-- Deskripsi --}}
                    <div class="description-box p-3 rounded-3 mb-3">
                        <p class="text-light mb-0">
                            <i class="bi bi-card-text me-2"></i>
                            {{ \Illuminate\Support\Str::limit($p->deskripsi, 80) }}
                        </p>
                    </div>
                    
                    {{-- Quick Stats --}}
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="stat-box p-2 text-center rounded-3">
                                <small class="d-block text-muted">ID Program</small>
                                <h6 class="mb-0 text-white">#{{ $p->program_id }}</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box p-2 text-center rounded-3">
                                <small class="d-block text-muted">Status</small>
                                <h6 class="mb-0 text-success">Aktif</h6>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('program_bantuan.edit', $p->program_id) }}"
                           class="btn btn-warning btn-glow w-50 py-2">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>

                        <form action="{{ route('program_bantuan.destroy', $p->program_id) }}"
                              method="POST" class="w-50">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-glow w-100 py-2"
                                    onclick="return confirm('Yakin hapus program ini?')">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                    
                    {{-- Quick Actions --}}
                    <div class="text-center mt-3">
                        <a href="#" class="text-info text-decoration-none me-3">
                            <i class="bi bi-eye me-1"></i> Lihat Detail
                        </a>
                        <a href="#" class="text-warning text-decoration-none">
                            <i class="bi bi-people me-1"></i> Pendaftar
                        </a>
                    </div>

                </div>
                
                {{-- Card Footer --}}
                <div class="card-footer bg-space border-top-0 text-center py-2">
                    <small class="text-muted">
                        <i class="bi bi-clock me-1"></i>
                        Terakhir diperbarui: {{ $p->updated_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Empty State --}}
    @if($programs->isEmpty())
    <div class="col-12">
        <div class="empty-state-card text-center p-5">
            <div class="empty-state-icon mb-4">
                <i class="bi bi-clipboard-data display-1 text-muted"></i>
            </div>
            <h4 class="text-white mb-3">Belum ada program bantuan</h4>
            <p class="text-muted mb-4">Mulai dengan membuat program bantuan pertama</p>
            <a href="{{ route('program_bantuan.create') }}" class="btn btn-success btn-lg btn-glow px-4">
                <i class="bi bi-plus-circle me-2"></i> Buat Program
            </a>
        </div>
    </div>
    @endif

    {{-- Pagination --}}
    @if($programs->hasPages())
    <div class="d-flex justify-content-center mt-5">
        <div class="pagination-wrapper">
            {{ $programs->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif

</div>

<style>
/* Cosmic Background */
.cosmic-bg {
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%);
    position: relative;
    overflow: hidden;
    min-height: 80vh;
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

/* Year Badge */
.year-badge {
    animation: badgeFloat 3s ease-in-out infinite;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

/* Budget Card */
.budget-card {
    background: linear-gradient(135deg, rgba(25, 135, 84, 0.1), rgba(25, 135, 84, 0.05));
    border: 1px solid rgba(25, 135, 84, 0.2);
    transition: all 0.3s ease;
}

.budget-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(25, 135, 84, 0.2);
}

/* Description Box */
.description-box {
    background: rgba(255, 255, 255, 0.05);
    border-left: 3px solid #0dcaf0;
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

/* Input Effects */
.search-input-glow:focus,
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

/* Program Title */
.program-title {
    min-height: 3rem;
    display: flex;
    align-items: center;
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
    background: rgba(var(--bs-primary-rgb), 0.3);
    transform: translateY(-2px);
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border-color: transparent;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

/* Animations */
@keyframes badgeFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
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

@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

/* Responsive */
@media (max-width: 768px) {
    .card-3d:hover {
        transform: translateY(-5px);
    }
    
    .cosmic-bg {
        padding: 1.5rem !important;
    }
    
    .program-title {
        font-size: 1.1rem;
    }
}

.object-fit-cover {
    object-fit: cover;
}
</style>

<script>
// Add interactive effects
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card-3d');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.zIndex = '1000';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.zIndex = '1';
        });
    });
    
    // Add click effect to budget cards
    const budgetCards = document.querySelectorAll('.budget-card');
    budgetCards.forEach(card => {
        card.addEventListener('click', () => {
            card.style.transform = 'scale(0.95)';
            setTimeout(() => {
                card.style.transform = '';
            }, 150);
        });
    });
});
</script>

@endsection
@extends('layouts2.guest.app')
@section('content')

<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4 cosmic-title">Data Warga</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-warning active" aria-current="page">Data Warga</li>
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
                    <i class="bi bi-people-fill me-3"></i> Data Warga
                </h2>
                <p class="text-light mb-0 opacity-75">Kelola data warga dengan sistem yang terintegrasi</p>
            </div>
            <a href="{{ route('warga.create') }}" class="btn btn-success d-flex align-items-center px-4 py-3 btn-glow">
                <i class="bi bi-plus-circle me-2 fs-5"></i> Tambah Warga
            </a>
        </div>

        {{-- SEARCH & FILTER --}}
        <div class="card border-0 shadow-lg rounded-4 mb-5 bg-space">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('warga.index') }}">
                    <div class="row g-3">
                        {{-- Search --}}
                        <div class="col-md-6">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-space text-white border-space">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       class="form-control bg-space text-white border-space search-input-glow"
                                       placeholder="Cari nama / NIK..."
                                       value="{{ request('search') }}">

                                @if(request('search'))
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null, 'page' => null]) }}"
                                       class="input-group-text bg-space text-danger border-space">
                                        <i class="bi bi-x-circle"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Filter Gender --}}
                        <div class="col-md-4">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-space text-white border-space">
                                    <i class="bi bi-gender-ambiguous"></i>
                                </span>
                                <select name="jenis_kelamin" class="form-select bg-space text-white border-space select-glow">
                                    <option value="">Semua Jenis Kelamin</option>
                                    <option value="L" {{ request('jenis_kelamin')=='L'?'selected':'' }}>👨 Laki-laki</option>
                                    <option value="P" {{ request('jenis_kelamin')=='P'?'selected':'' }}>👩 Perempuan</option>
                                </select>
                            </div>
                        </div>

                        {{-- Filter Button --}}
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100 h-100 btn-glow">
                                <i class="bi bi-funnel me-2"></i> Filter
                            </button>
                        </div>
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
                        <div class="stats-icon me-3">
                            <i class="bi bi-people-fill text-primary"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ $data->total() }}</h3>
                            <p class="text-muted mb-0">Total Warga</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card-2 p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-gender-male text-info"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ $data->where('jenis_kelamin', 'L')->count() }}</h3>
                            <p class="text-muted mb-0">Laki-laki</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card-2 p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-gender-female text-danger"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ $data->where('jenis_kelamin', 'P')->count() }}</h3>
                            <p class="text-muted mb-0">Perempuan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card-2 p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-house-fill text-success"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ $data->pluck('alamat')->unique()->count() }}</h3>
                            <p class="text-muted mb-0">Alamat Unik</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- WARGA CARDS --}}
        <div class="row g-4">
            @foreach($data as $w)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg h-100 rounded-4 card-3d warga-card"
                         style="border-left: 5px solid {{ $w->jenis_kelamin == 'L' ? '#3498db' : '#e74c3c' }};">

                        {{-- Top Gradient Border --}}
                        <div class="position-absolute top-0 start-0 w-100 warga-gradient-border"
                             style="height: 8px; background: linear-gradient(90deg,
                                 {{ $w->jenis_kelamin == 'L' ? '#3498db, #2980b9' : '#e74c3c, #c0392b' }});">
                        </div>

                        <div class="card-body p-4 bg-space">
                            {{-- Header --}}
                            <div class="d-flex align-items-start mb-4">
                                {{-- Avatar --}}
                                <div class="position-relative me-3">
                                    <div class="avatar-wrapper rounded-circle overflow-hidden"
                                         style="width: 70px; height: 70px; background: {{ $w->jenis_kelamin == 'L' ? 'linear-gradient(135deg, #3498db, #2980b9)' : 'linear-gradient(135deg, #e74c3c, #c0392b)' }};">
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                            <span class="text-white fw-bold fs-3">
                                                {{ strtoupper(substr($w->nama, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="position-absolute bottom-0 end-0 gender-indicator
                                        {{ $w->jenis_kelamin == 'L' ? 'bg-info' : 'bg-danger' }}">
                                        <i class="bi {{ $w->jenis_kelamin == 'L' ? 'bi-gender-male' : 'bi-gender-female' }} text-white"></i>
                                    </div>
                                </div>

                                {{-- Info --}}
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="text-white fw-bold mb-1">{{ $w->nama }}</h5>
                                            <p class="text-muted mb-1">
                                                <i class="bi bi-person-badge me-1"></i> {{ $w->no_ktp }}
                                            </p>
                                        </div>
                                        {{-- Age Badge --}}
                                        @if($w->tanggal_lahir)
                                            @php
                                                $age = \Carbon\Carbon::parse($w->tanggal_lahir)->age;
                                                $ageColor = $age < 18 ? 'bg-info' : ($age < 60 ? 'bg-success' : 'bg-warning');
                                            @endphp
                                            <span class="badge {{ $ageColor }} age-badge">
                                                {{ $age }} tahun
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Contact Info --}}
                                    <div class="mt-3">
                                        <p class="text-light mb-1">
                                            <i class="bi bi-telephone me-2"></i>
                                            <span class="contact-info">{{ $w->telp }}</span>
                                        </p>
                                        @if($w->email)
                                            <p class="text-light mb-0">
                                                <i class="bi bi-envelope me-2"></i>
                                                <span class="contact-info">{{ $w->email }}</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Address --}}
                            @if($w->alamat)
                                <div class="address-box p-3 rounded-3 mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-house-door-fill text-warning me-2"></i>
                                        <small class="text-muted">Alamat</small>
                                    </div>
                                    <p class="text-light mb-0 small">{{ Str::limit($w->alamat, 80) }}</p>
                                </div>
                            @endif

                            {{-- Quick Stats --}}
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="warga-stat p-2 text-center rounded-3">
                                        <small class="text-muted d-block">ID Warga</small>
                                        <h6 class="mb-0 text-white">#{{ $w->warga_id }}</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="warga-stat p-2 text-center rounded-3">
                                        <small class="text-muted d-block">Status</small>
                                        <span class="text-success">Aktif</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('warga.edit', $w->warga_id) }}"
                                   class="btn btn-warning flex-fill py-2 btn-glow">
                                    <i class="bi bi-pencil-square me-2"></i> Edit
                                </a>

                                <a href="#" class="btn btn-info flex-fill py-2 btn-glow">
                                    <i class="bi bi-eye me-2"></i> View
                                </a>

                                <form action="{{ route('warga.delete', $w->warga_id) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus data warga ini?')" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100 py-2 btn-glow">
                                        <i class="bi bi-trash me-2"></i> Hapus
                                    </button>
                                </form>
                            </div>

                            {{-- Quick Actions --}}
                            <div class="text-center mt-3">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-light btn-sm px-3"
data-bs-toggle="modal" data-bs-target="#modalDetail{{ $w->warga_id }}">
<i class="bi bi-card-text"></i> Detail
</button>


<!-- Modal Detail Warga -->
<div class="modal fade" id="modalDetail{{ $w->warga_id }}" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content cosmic-bg" style="border-radius:20px; border:1px solid rgba(255,255,255,0.1);">


<div class="modal-header border-0">
<h5 class="modal-title text-white fw-bold">
<i class="bi bi-eye-fill me-2 text-info"></i> Detail Data Warga
</h5>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>


<div class="modal-body">
<div class="row">
<div class="col-md-5 text-center">
<div class="rounded-circle overflow-hidden shadow mx-auto"
style="width:180px; height:180px; background:#222; display:flex; align-items:center; justify-content:center;">
<span class="text-white fw-bold" style="font-size:5rem;">
{{ strtoupper(substr($w->nama, 0, 1)) }}
</span>
</div>


<span class="badge mt-3 px-3 py-2 fw-bold"
style="background: {{ $w->jenis_kelamin == 'L' ? '#3498db' : '#e74c3c' }};">
<i class="bi bi-gender-ambiguous me-1"></i>
{{ $w->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
</span>
</div>


<div class="col-md-7">
<h4 class="text-white fw-bold mb-3">{{ $w->nama }}</h4>


<p class="text-light mb-2">
<i class="bi bi-person-vcard me-2"></i>
<b>NIK:</b> {{ $w->no_ktp }}
</p>


<p class="text-light mb-2">
<i class="bi bi-telephone me-2 text-info"></i>
<b>Telp:</b> {{ $w->telp }}
</p>


@if($w->email)
<p class="text-light mb-2">
<i class="bi bi-envelope me-2 text-warning"></i>
<b>Email:</b> {{ $w->email }}
</p>
@endif


<p class="text-light mb-2">
<i class="bi bi-calendar-heart me-2"></i>
<b>Tanggal Lahir:</b> {{ $w->tanggal_lahir }}
</p>


<p class="text-light mb-2">
<i class="bi bi-hash me-2"></i>
<b>ID Warga:</b> #{{ $w->warga_id }}
</p>


<hr class="border-secondary">


<p class="text-light">
<b>Alamat:</b><br>
{{ $w->alamat }}
</p>
</div>
</div>
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
                                Terdaftar: {{ \Carbon\Carbon::parse($w->created_at)->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Empty State --}}
        @if($data->isEmpty())
        <div class="col-12">
            <div class="empty-state-card text-center p-5">
                <div class="empty-state-icon mb-4">
                    <i class="bi bi-people display-1 text-muted"></i>
                </div>
                <h4 class="text-white mb-3">Belum ada data warga</h4>
                <p class="text-muted mb-4">Mulai dengan menambahkan warga baru</p>
                <a href="{{ route('warga.create') }}" class="btn btn-success btn-lg btn-glow px-4">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Warga Pertama
                </a>
            </div>
        </div>
        @endif

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
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.1) 0%, transparent 50%);
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
        0 0 100px rgba(var(--bs-primary-rgb), 0.3) !important;
}

.warga-card:hover .warga-gradient-border {
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
    background: rgba(var(--bs-primary-rgb), 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
}

/* Gender Indicator */
.gender-indicator {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    border: 2px solid #2c3e50;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    box-shadow: 0 0 10px currentColor;
}

/* Age Badge */
.age-badge {
    animation: badgeFloat 3s ease-in-out infinite;
    font-size: 0.8rem;
    padding: 0.4em 0.8em;
    border-radius: 50rem;
}

/* Address Box */
.address-box {
    background: rgba(255, 255, 255, 0.05);
    border-left: 3px solid #f39c12;
}

/* Warga Stats */
.warga-stat {
    background: rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.warga-stat:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

/* Avatar */
.avatar-wrapper {
    border: 3px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.warga-card:hover .avatar-wrapper {
    border-color: rgba(255, 255, 255, 0.4);
    transform: scale(1.05);
}

/* Contact Info */
.contact-info {
    background: linear-gradient(45deg, #fff, #00b894);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 500;
}

/* Background Space */
.bg-space {
    background: rgba(20, 20, 40, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.border-space {
    border-color: rgba(255, 255, 255, 0.2) !important;
}

/* Input Effects */
.search-input-glow:focus,
.select-glow:focus {
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.5),
                0 0 30px rgba(13, 110, 253, 0.3) !important;
    border-color: #0d6efd !important;
}

/* Cosmic Title */
.cosmic-title {
    background: linear-gradient(45deg, #fff, #ffd700);
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
    background: rgba(var(--bs-primary-rgb), 0.3);
    transform: translateY(-2px);
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border-color: transparent;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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

    .warga-stat {
        padding: 0.5rem !important;
    }
}
</style>

<script>
// Add interactive effects
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.warga-card');

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

    // Add hover effect to address box
    const addressBoxes = document.querySelectorAll('.address-box');
    addressBoxes.forEach(box => {
        box.addEventListener('mouseenter', () => {
            box.style.transform = 'translateX(5px)';
        });

        box.addEventListener('mouseleave', () => {
            box.style.transform = 'translateX(0)';
        });
    });
});
</script>

@endsection

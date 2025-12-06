@extends('layouts2.guest.app')
@section('content')

<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4 cosmic-title">Data Users</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-warning active" aria-current="page">Data Users</li>
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
                    <i class="bi bi-people-fill me-3"></i> Data Users
                </h2>
                <p class="text-light mb-0 opacity-75">Kelola pengguna sistem dengan mudah</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-success d-flex align-items-center px-4 py-3 btn-glow">
                <i class="bi bi-plus-circle me-2 fs-5"></i> Tambah User
            </a>
        </div>

        {{-- SEARCH & FILTER --}}
        <div class="card border-0 shadow-lg rounded-4 mb-5 bg-space">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('users.index') }}">
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
                                       placeholder="Cari nama / email..."
                                       value="{{ request('search') }}">
                                
                                @if(request('search'))
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null, 'page' => null]) }}"
                                       class="input-group-text bg-space text-danger border-space">
                                        <i class="bi bi-x-circle"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Filter Role --}}
                        <div class="col-md-4">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-space text-white border-space">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                                <select name="role" class="form-select bg-space text-white border-space select-glow">
                                    <option value="">Semua Role</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>👤 User</option>
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
            <div class="col-md-4">
                <div class="stats-card-2 p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-people-fill text-primary"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ $users->total() }}</h3>
                            <p class="text-muted mb-0">Total Users</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card-2 p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-shield-check text-success"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ $users->where('role', 'admin')->count() }}</h3>
                            <p class="text-muted mb-0">Admin</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card-2 p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon me-3">
                            <i class="bi bi-person-check text-info"></i>
                        </div>
                        <div>
                            <h3 class="text-white mb-0">{{ $users->where('role', 'user')->count() }}</h3>
                            <p class="text-muted mb-0">Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD USERS --}}
        <div class="row g-4">
            @forelse($users as $user)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg h-100 rounded-4 card-3d user-card">
                        
                        {{-- Top Gradient Border --}}
                        <div class="position-absolute top-0 start-0 w-100 user-gradient-border"
                             style="height: 8px; background: linear-gradient(90deg, 
                                 {{ $user->role == 'admin' ? '#ff6b6b, #ffa502' : '#00b894, #0984e3' }});">
                        </div>

                        <div class="card-body p-4 bg-space">
                            {{-- User Info --}}
                            <div class="d-flex align-items-start mb-4">
                                {{-- Profile Avatar --}}
                                <div class="position-relative">
                                    <div class="avatar-wrapper rounded-circle overflow-hidden"
                                         style="width: 70px; height: 70px;">
                                        @if($user->media->count() && Str::startsWith($user->media->first()->mime_type, 'image'))
                                            <img src="{{ asset('storage/'.$user->media->first()->file_name) }}"
                                                 class="w-100 h-100 object-fit-cover">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                                 style="background: linear-gradient(135deg, #667eea, #764ba2); color:#fff; font-weight:bold; font-size:1.8rem;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="position-absolute bottom-0 end-0 status-indicator 
                                        {{ $user->role == 'admin' ? 'bg-danger' : 'bg-success' }}">
                                    </div>
                                </div>

                                <div class="ms-4 flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="text-white fw-bold mb-1">{{ $user->name }}</h5>
                                            <p class="text-muted mb-1">
                                                <i class="bi bi-envelope me-1"></i> {{ $user->email }}
                                            </p>
                                        </div>
                                        {{-- Role Badge --}}
                                        <span class="badge role-badge {{ $user->role == 'admin' ? 'admin-badge' : 'user-badge' }}">
                                            <i class="bi {{ $user->role == 'admin' ? 'bi-shield-check' : 'bi-person-check' }} me-1"></i>
                                            {{ strtoupper($user->role) }}
                                        </span>
                                    </div>
                                    
                                    {{-- User Stats --}}
                                    <div class="row mt-3 g-2">
                                        <div class="col-6">
                                            <div class="user-stat p-2 rounded-3">
                                                <small class="text-muted d-block">Terdaftar</small>
                                                <span class="text-white">{{ $user->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="user-stat p-2 rounded-3">
                                                <small class="text-muted d-block">Status</small>
                                                <span class="text-success">Aktif</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Last Activity --}}
                            <div class="mb-4">
                                <small class="text-muted">
                                    <i class="bi bi-clock-history me-1"></i>
                                    Terakhir login: {{ $user->updated_at->diffForHumans() }}
                                </small>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-flex gap-2 mt-4">
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="btn btn-warning flex-fill py-2 btn-glow">
                                    <i class="bi bi-pencil-square me-2"></i> Edit
                                </a>

                                <a href="#" class="btn btn-info flex-fill py-2 btn-glow">
                                    <i class="bi bi-eye me-2"></i> View
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus user ini?')" class="flex-fill">
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
                                    <button type="button" class="btn btn-outline-light btn-sm px-3">
                                        <i class="bi bi-key"></i> Reset
                                    </button>
                                    <button type="button" class="btn btn-outline-light btn-sm px-3">
                                        <i class="bi bi-chat"></i> Message
                                    </button>
                                    <button type="button" class="btn btn-outline-light btn-sm px-3">
                                        <i class="bi bi-gear"></i> Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Card Footer --}}
                        <div class="card-footer bg-space border-top-0 text-center py-3">
                            <small class="text-muted">
                                <i class="bi bi-person-circle me-1"></i>
                                User ID: #{{ $user->id }}
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-12">
                    <div class="empty-state-card text-center p-5">
                        <div class="empty-state-icon mb-4">
                            <i class="bi bi-people display-1 text-muted"></i>
                        </div>
                        <h4 class="text-white mb-3">Belum ada data user</h4>
                        <p class="text-muted mb-4">Mulai dengan menambahkan user baru</p>
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-lg btn-glow px-4">
                            <i class="bi bi-plus-circle me-2"></i> Tambah User Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($users->hasPages())
            <div class="d-flex justify-content-center mt-5">
                <div class="pagination-wrapper">
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
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

.user-card:hover .user-gradient-border {
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

/* Role Badges */
.role-badge {
    font-size: 0.75rem;
    padding: 0.5em 1em;
    border-radius: 50rem;
    animation: badgeFloat 3s ease-in-out infinite;
}

.admin-badge {
    background: linear-gradient(45deg, #ff6b6b, #ffa502);
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
}

.user-badge {
    background: linear-gradient(45deg, #00b894, #0984e3);
    box-shadow: 0 4px 15px rgba(0, 184, 148, 0.4);
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

/* Status Indicator */
.status-indicator {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 2px solid #2c3e50;
    box-shadow: 0 0 10px currentColor;
}

/* User Stats */
.user-stat {
    background: rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

.user-stat:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

/* Avatar */
.avatar-wrapper {
    border: 3px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.user-card:hover .avatar-wrapper {
    border-color: rgba(255, 255, 255, 0.4);
    transform: scale(1.05);
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
}

.object-fit-cover {
    object-fit: cover;
}
</style>

<script>
// Add interactive effects
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.user-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.zIndex = '1000';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.zIndex = '1';
        });
    });
    
    // Add click animation to stats cards
    const statCards = document.querySelectorAll('.user-stat');
    statCards.forEach(card => {
        card.addEventListener('click', () => {
            card.style.transform = 'scale(0.95)';
            setTimeout(() => {
                card.style.transform = '';
            }, 150);
        });
    });
    
    // Add hover sound effect to buttons
    const buttons = document.querySelectorAll('.btn-glow');
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
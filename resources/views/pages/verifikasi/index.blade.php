@extends('layouts2.guest.app')
@section('content')

<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Verifikasi Lapangan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-warning active" aria-current="page">Verifikasi Lapangan</li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-dark p-4 rounded-4 shadow-lg cosmic-bg">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="cosmic-title mb-0">Data Verifikasi Lapangan</h3>
        <a href="{{ route('verifikasi.create') }}" class="btn btn-success fw-semibold shadow-lg btn-glow">
            <i class="bi bi-plus-circle me-1"></i> Tambah Verifikasi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-lg alert-glow-success">{{ session('success') }}</div>
    @endif

    {{-- SEARCH & FILTER --}}
    <div class="row mb-4">
        <div class="col-md-5">
            <form method="GET" action="{{ route('pages.verifikasi.index') }}">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-space border-space">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control bg-space border-space search-input-glow text-dark"
                           placeholder="Cari petugas / catatan..."
                           value="{{ request('search') }}">

                    <button class="btn btn-primary px-4 btn-glow">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>

                    @if(request('search'))
                        <a href="{{ route('pages.verifikasi.index') }}"
                           class="btn btn-outline-danger ms-2 border-space">
                            <i class="bi bi-x-circle me-1"></i> Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="col-md-3">
            <form method="GET" action="{{ route('pages.verifikasi.index') }}">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-space border-space">
                        <i class="bi bi-filter"></i>
                    </span>
                    <input type="date" name="tanggal" class="form-control bg-space border-space select-glow text-dark" 
                           value="{{ request('tanggal') }}" onchange="this.form.submit()">
                </div>
            </form>
        </div>

        <div class="col-md-4 text-end">
            <div class="stats-card p-3">
                <h5 class="text-white mb-0">Total: {{ $data->total() }} Verifikasi</h5>
            </div>
        </div>
    </div>

    {{-- LIST CARD --}}
    <div class="row g-4">
        @foreach($data as $d)
        @php
            // Get media/image
            $media = $d->media->first();
            if ($media && Storage::disk('public')->exists($media->file_name)) {
                $imgPath = asset('storage/' . $media->file_name);
            } else {
                $imgPath = 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=400&q=80';
            }

            // Color based on day (Convert to Indonesian)
            $dateColors = [
                'Senin' => '#ff6b6b',
                'Selasa' => '#48dbfb',
                'Rabu' => '#1dd1a1',
                'Kamis' => '#feca57',
                'Jumat' => '#ff9ff3',
                'Sabtu' => '#5f27cd',
                'Minggu' => '#00d2d3'
            ];
            
            // Convert English day to Indonesian
            $daysEnglish = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $daysIndonesian = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            
            $dayEnglish = date('l', strtotime($d->tanggal));
            $dayIndex = array_search($dayEnglish, $daysEnglish);
            $hari = $daysIndonesian[$dayIndex] ?? $dayEnglish;
            
            $borderColor = $dateColors[$hari] ?? '#6c757d';
            
            // Format tanggal
            $tanggalFormatted = date('d M Y', strtotime($d->tanggal));
            $tanggalFull = date('d F Y', strtotime($d->tanggal));
            
            // Count media
            $mediaCount = $d->media->count();
        @endphp

        <div class="col-md-4">
            <div class="card border-0 shadow-lg h-100 card-3d"
                 style="border-radius:20px; overflow:hidden; border-left: 5px solid {{ $borderColor }};">

                {{-- Thumbnail Gambar --}}
                <div style="height:200px; overflow:hidden; position: relative;">
                    <img src="{{ $imgPath }}" class="w-100 h-100 object-fit-cover card-image"
                         onerror="this.src='https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=400&q=80'">
                    <div class="card-image-overlay"></div>

                    {{-- Date Badge --}}
                    <div class="position-absolute top-3 end-3">
                        <span class="badge year-badge px-3 py-2 fw-bold" style="background: {{ $borderColor }};">
                            <i class="bi bi-calendar-check me-1"></i> {{ $tanggalFormatted }}
                        </span>
                    </div>

                    {{-- Media Count Badge --}}
                    @if($mediaCount > 0)
                    <div class="position-absolute top-3 start-3">
                        <span class="badge bg-info bg-opacity-90 px-3 py-2">
                            <i class="bi bi-image me-1"></i> {{ $mediaCount }}
                        </span>
                    </div>
                    @endif

                    {{-- Petugas Badge --}}
                    <div class="position-absolute bottom-3 start-3">
                        <span class="badge bg-dark bg-opacity-75 px-3 py-2">
                            <i class="bi bi-person-badge me-1"></i> {{ \Illuminate\Support\Str::limit($d->petugas, 15) }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4 bg-space">

                    {{-- Petugas Info --}}
                    <h5 class="text-white fw-bold mb-3 program-title">
                        <i class="bi bi-person-circle me-2"></i> {{ $d->petugas }}
                    </h5>

                    {{-- Tanggal Card --}}
                    <div class="budget-card mb-3 p-3 rounded-3">
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi bi-calendar-date text-warning me-2"></i>
                            <small class="text-muted">Tanggal Verifikasi</small>
                        </div>
                        <h4 class="text-warning fw-bold mb-0">
                            {{ $tanggalFull }}
                        </h4>
                        <small class="text-muted d-block mt-1">
                            <i class="bi bi-calendar-week me-1"></i> Hari: {{ $hari }}
                        </small>
                    </div>

                    {{-- Catatan --}}
                    <div class="description-box p-3 rounded-3 mb-3">
                        <p class="text-light mb-0">
                            <i class="bi bi-chat-text me-2"></i>
                            {{ \Illuminate\Support\Str::limit($d->catatan, 80) }}
                            @if(strlen($d->catatan) > 80)
                                <span class="text-info">...selengkapnya</span>
                            @endif
                        </p>
                    </div>

                    {{-- Media Preview --}}
                    @if($mediaCount > 0)
                    <div class="mb-3">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-images me-1"></i> Bukti Foto/Dokumen:
                        </small>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($d->media->take(3) as $mediaItem)
                            <a href="{{ asset('storage/' . $mediaItem->file_name) }}" 
                               target="_blank"
                               class="position-relative" style="width: 60px; height: 60px;">
                                @if(str_contains($mediaItem->mime_type, 'image'))
                                    <img src="{{ asset('storage/' . $mediaItem->file_name) }}" 
                                         class="rounded-2 w-100 h-100 object-fit-cover border border-white border-opacity-25"
                                         onerror="this.src='https://via.placeholder.com/60x60?text=Image'">
                                @elseif(str_contains($mediaItem->mime_type, 'pdf'))
                                    <div class="w-100 h-100 bg-danger rounded-2 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-pdf text-white fs-5"></i>
                                    </div>
                                @endif
                            </a>
                            @endforeach
                            @if($mediaCount > 3)
                            <a href="#" class="position-relative d-flex align-items-center justify-content-center"
                               style="width: 60px; height: 60px;"
                               data-bs-toggle="modal" data-bs-target="#modalGallery{{ $d->verifikasi_id }}">
                                <div class="w-100 h-100 bg-secondary bg-opacity-50 rounded-2 d-flex align-items-center justify-content-center">
                                    <span class="text-white fw-bold">+{{ $mediaCount - 3 }}</span>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- Quick Stats --}}
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="stat-box p-2 text-center rounded-3">
                                <small class="d-block text-muted">ID Verifikasi</small>
                                <h6 class="mb-0 text-white">#{{ $d->verifikasi_id }}</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box p-2 text-center rounded-3">
                                <small class="d-block text-muted">Jumlah Media</small>
                                <h6 class="mb-0 text-info">{{ $mediaCount }}</h6>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('verifikasi.edit', $d->verifikasi_id) }}"
                           class="btn btn-warning btn-glow w-50 py-2">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>

                        <form action="{{ route('verifikasi.destroy', $d->verifikasi_id) }}"
                              method="POST" class="w-50">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-glow w-100 py-2"
                                    onclick="return confirm('Yakin hapus verifikasi ini? Data tidak dapat dikembalikan.')">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="text-center mt-3">
                        <a href="#" class="text-info text-decoration-none me-3"
                           data-bs-toggle="modal" data-bs-target="#modalDetail{{ $d->verifikasi_id }}">
                            <i class="bi bi-eye me-1"></i> Lihat Detail
                        </a>
                    </div>

                </div>

                {{-- Card Footer --}}
                <div class="card-footer bg-space border-top-0 text-center py-2">
                    <small class="text-muted">
                        <i class="bi bi-clock me-1"></i>
                        Dibuat: {{ $d->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>

        <!-- Modal Detail -->
        <div class="modal fade" id="modalDetail{{ $d->verifikasi_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content cosmic-bg" style="border-radius:20px; border:1px solid rgba(255,255,255,0.1);">

                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white fw-bold">
                            <i class="bi bi-eye-fill me-2 text-info"></i> Detail Verifikasi Lapangan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-5 text-center">
                                <img src="{{ $imgPath }}" class="img-fluid rounded shadow"
                                     style="max-height:220px; object-fit:cover;"
                                     onerror="this.src='https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=400&q=80'">
                                
                                <span class="badge mt-3 px-3 py-2 fw-bold"
                                      style="background: {{ $borderColor }};">
                                    <i class="bi bi-calendar-check me-1"></i> {{ $tanggalFormatted }}
                                </span>

                                @if($mediaCount > 0)
                                <div class="mt-3">
                                    <h6 class="text-white">
                                        <i class="bi bi-images me-2"></i> Bukti Upload ({{ $mediaCount }})
                                    </h6>
                                </div>
                                @endif
                            </div>

                            <div class="col-md-7">
                                <h4 class="text-white fw-bold mb-3">{{ $d->petugas }}</h4>

                                <p class="text-light mb-2">
                                    <i class="bi bi-person-badge me-2"></i>
                                    <b>Petugas:</b> {{ $d->petugas }}
                                </p>

                                <p class="text-light mb-2">
                                    <i class="bi bi-calendar me-2 text-warning"></i>
                                    <b>Tanggal:</b> {{ $tanggalFull }}
                                </p>

                                <p class="text-light mb-2">
                                    <i class="bi bi-calendar-week me-2"></i>
                                    <b>Hari:</b> {{ $hari }}
                                </p>

                                <p class="text-light mb-2">
                                    <i class="bi bi-clock-history me-2"></i>
                                    <b>Dibuat:</b> {{ $d->created_at->format('d M Y H:i') }}
                                </p>

                                <p class="text-light mb-2">
                                    <i class="bi bi-clock me-2"></i>
                                    <b>Update Terakhir:</b> {{ $d->updated_at->diffForHumans() }}
                                </p>

                                <hr class="border-secondary">

                                <p class="text-light">
                                    <b>Catatan:</b><br>
                                    {{ $d->catatan }}
                                </p>

                                {{-- Media List in Modal --}}
                                @if($mediaCount > 0)
                                <div class="mt-4 pt-3 border-top border-white border-opacity-25">
                                    <h6 class="text-white mb-3">
                                        <i class="bi bi-paperclip me-2"></i> File Bukti:
                                    </h6>
                                    <div class="row g-2">
                                        @foreach($d->media as $mediaItem)
                                        <div class="col-6">
                                            <a href="{{ asset('storage/' . $mediaItem->file_name) }}" 
                                               target="_blank"
                                               class="d-flex align-items-center p-2 rounded-3 bg-dark bg-opacity-50 text-decoration-none">
                                                @if(str_contains($mediaItem->mime_type, 'image'))
                                                    <i class="bi bi-image text-info me-2"></i>
                                                    <small class="text-white text-truncate">Foto {{ $loop->iteration }}</small>
                                                @elseif(str_contains($mediaItem->mime_type, 'pdf'))
                                                    <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                                    <small class="text-white text-truncate">PDF {{ $loop->iteration }}</small>
                                                @endif
                                                <small class="ms-auto text-muted">
                                                    <i class="bi bi-box-arrow-up-right"></i>
                                                </small>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Gallery (for many images) -->
        @if($mediaCount > 3)
        <div class="modal fade" id="modalGallery{{ $d->verifikasi_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content cosmic-bg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white">
                            <i class="bi bi-images me-2"></i> Galeri Bukti Verifikasi
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            @foreach($d->media as $mediaItem)
                            <div class="col-md-4 col-6">
                                <div class="gallery-item position-relative">
                                    @if(str_contains($mediaItem->mime_type, 'image'))
                                        <img src="{{ asset('storage/' . $mediaItem->file_name) }}"
                                             class="img-fluid rounded-3 w-100 h-100 object-fit-cover"
                                             style="height: 200px;"
                                             onerror="this.src='https://via.placeholder.com/300x200?text=Image+Error'">
                                    @elseif(str_contains($mediaItem->mime_type, 'pdf'))
                                        <div class="w-100 h-100 bg-danger rounded-3 d-flex align-items-center justify-content-center"
                                             style="height: 200px;">
                                            <div class="text-center">
                                                <i class="bi bi-file-earmark-pdf text-white display-4 mb-2"></i>
                                                <p class="text-white mb-0">PDF Document</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="position-absolute top-3 end-3">
                                        <a href="{{ asset('storage/' . $mediaItem->file_name) }}" 
                                           target="_blank"
                                           class="btn btn-sm btn-primary btn-glow">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @endforeach
    </div>

    {{-- Empty State --}}
    @if($data->isEmpty())
    <div class="col-12">
        <div class="empty-state-card text-center p-5">
            <div class="empty-state-icon mb-4">
                <i class="bi bi-clipboard-check display-1 text-muted"></i>
            </div>
            <h4 class="text-white mb-3">Belum ada data verifikasi</h4>
            <p class="text-muted mb-4">Mulai dengan membuat verifikasi lapangan pertama</p>
            <a href="{{ route('verifikasi.create') }}" class="btn btn-success btn-lg btn-glow px-4">
                <i class="bi bi-plus-circle me-2"></i> Buat Verifikasi
            </a>
        </div>
    </div>
    @endif

    {{-- Pagination --}}
    @if($data->hasPages())
    <div class="d-flex justify-content-center mt-5">
        <div class="pagination-wrapper">
            {{ $data->links('pagination::bootstrap-5') }}
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
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(255, 193, 7, 0.05));
    border: 1px solid rgba(255, 193, 7, 0.2);
    transition: all 0.3s ease;
}

.budget-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.2);
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

/* Text color for inputs */
.search-input-glow,
.select-glow {
    color: #000000 !important;
}

/* Placeholder text color */
.search-input-glow::placeholder {
    color: #666666 !important;
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

/* Modal Fix */
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

/* Date Input Customization */
input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(0) !important;
    opacity: 0.7;
    cursor: pointer;
}

input[type="date"] {
    color: #000000 !important;
}

/* Input background for better readability */
.search-input-glow,
.select-glow {
    background-color: rgba(255, 255, 255, 0.9) !important;
}

.search-input-glow:hover,
.select-glow:hover {
    background-color: #ffffff !important;
}
/* Gallery item hover effect */
.gallery-item {
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: scale(1.03);
}

/* PDF thumbnail styling */
.bi-file-earmark-pdf {
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
}

/* Day indicator */
.bi-calendar-week {
    font-size: 0.9rem;
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

    .search-input-glow,
    .select-glow {
        font-size: 14px !important;
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

    // Make date inputs more readable
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
        // Set default value if empty and not in request
        if (!input.value && !new URLSearchParams(window.location.search).has('tanggal')) {
            const today = new Date().toISOString().split('T')[0];
            input.value = today;
        }
    });

    // Initialize gallery modals
    const galleryModals = document.querySelectorAll('[id^="modalGallery"]');
    galleryModals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', function() {
            // Lazy load images
            const images = this.querySelectorAll('img');
            images.forEach(img => {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                }
            });
        });
    });
});
</script>

@endsection
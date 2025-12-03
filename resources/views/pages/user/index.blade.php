@extends('layouts2.guest.app')
@section('content')

<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Data Users</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Data Users</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid py-5" style="background-color: #001b20; min-height: 100vh;">
    <div class="container">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white fw-bold">
                <i class="fa fa-users me-2 text-warning"></i> Data Users
            </h2>
            <a href="{{ route('users.create') }}" class="btn btn-success d-flex align-items-center rounded-pill px-4 shadow-sm">
                <i class="fa fa-plus-circle me-2"></i> Tambah User
            </a>
        </div>

        {{-- SEARCH BAR --}}
        <form method="GET" action="{{ route('users.index') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Cari nama / email..."
                               value="{{ request('search') }}">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null, 'page' => null]) }}"
                               class="btn btn-outline-secondary">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
        @endif

        {{-- CARD USERS --}}
        <div class="row g-4">
            @forelse($users as $user)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg h-100 rounded-4 position-relative overflow-hidden"
                         style="transition: 0.3s; background-color: #ffffff;">

                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">

                                {{-- FOTO PROFIL ATAU INISIAL --}}
                                <div class="rounded-circle overflow-hidden me-3"
                                     style="width: 55px; height: 55px;">

                                    @if($user->media->count() && Str::startsWith($user->media->first()->mime_type, 'image'))
                                        <img src="{{ asset('storage/'.$user->media->first()->file_name) }}"
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                             style="background-color:#00b894; color:#fff; font-weight:bold; font-size:1.3rem;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>

                            <p class="mb-0">
                                <i class="fa fa-calendar-alt text-primary me-2"></i>
                                <strong>Dibuat:</strong> {{ $user->created_at->format('d M Y') }}
                            </p>

                            <hr class="my-4" style="border-top: 2px solid #f0f0f0;">

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="btn btn-warning w-50 me-2 rounded-3 fw-bold shadow-sm">
                                    <i class="fa fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus user ini?')" class="w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100 rounded-3 fw-bold shadow-sm">
                                        <i class="fa fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="position-absolute top-0 start-0 w-100"
                             style="height: 6px; background: linear-gradient(90deg, #00c6ff, #0072ff);"></div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-white">
                    <p class="fs-5">Belum ada data user.</p>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        <div class="mt-4 d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">

                    {{-- Previous --}}
                    @if ($users->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">«</span></li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->appends(request()->query())->previousPageUrl() }}">«</a>
                        </li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if ($page == $users->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->appends(request()->query())->nextPageUrl() }}">»</a>
                        </li>
                    @else
                        <li class="page-item disabled"><span class="page-link">»</span></li>
                    @endif

                </ul>
            </nav>
        </div>

    </div>
</div>

@endsection

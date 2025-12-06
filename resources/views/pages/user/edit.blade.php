@extends('layouts2.guest.app')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Edit Data User</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Edit Data</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Form Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5 align-items-center">

            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Edit User</div>
                <h1 class="display-6 mb-4">Perbarui Data User Anda</h1>
                <p class="mb-0 text-light">
                    Halaman ini digunakan untuk mengedit data user, termasuk memperbarui informasi, password, dan media profil.
                </p>
            </div>

            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100 bg-secondary p-5 rounded-3 shadow-lg">

                    <h2 class="mb-4">Edit Data User</h2>

                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password <small>(Kosongkan jika tidak diubah)</small></label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <!-- ========================== -->
                        <!-- FIELD ROLE (DITAMBAHKAN) -->
                        <!-- ========================== -->
                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                        <!-- ========================== -->

                        <!-- Media Lama -->
                        @if($user->media->count())
                            <div class="mb-3">
                                <label class="fw-bold">Media Lama</label>
                                <div class="d-flex flex-wrap gap-3">

                                    @foreach($user->media as $media)
                                        <div class="position-relative">

                                            @if(Str::startsWith($media->mime_type, 'image'))
                                                <img src="{{ asset('storage/'.$media->file_name) }}"
                                                     class="rounded-circle border shadow"
                                                     style="width: 80px; height: 80px; object-fit: cover;">
                                            @elseif(Str::startsWith($media->mime_type, 'video'))
                                                <video width="120" class="rounded shadow" controls>
                                                    <source src="{{ asset('storage/'.$media->file_name) }}" type="{{ $media->mime_type }}">
                                                </video>
                                            @else
                                                <a href="{{ asset('storage/'.$media->file_name) }}" target="_blank"
                                                   class="btn btn-outline-light btn-sm">
                                                    {{ basename($media->file_name) }}
                                                </a>
                                            @endif

                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endif

                        <!-- Tambah Media Baru -->
                        <div class="mb-3">
                            <label>Tambah Media Baru (opsional)</label>
                            <input type="file" name="media[]" class="form-control" multiple>
                            <small class="text-warning">Boleh upload beberapa file. Max 5MB per file.</small>
                        </div>

                        <button class="btn btn-primary px-4">Update</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary px-4">Kembali</a>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

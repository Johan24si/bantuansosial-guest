@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5 text-center">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&size=120"
                         class="rounded-circle mb-4 shadow-sm" alt="Avatar">

                    <h3 class="fw-bold mb-1">{{ Auth::user()->name }}</h3>
                    <small class="text-muted d-block mb-4">{{ Auth::user()->email }}</small>

                    <hr class="my-4">

                    <div class="text-start mb-4">
                        <p><strong>Nama Lengkap:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Alamat Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Dibuat pada:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>

                    <a href="{{ route('home') }}" class="btn btn-primary px-4 rounded-pill">
                        <i class="fa fa-arrow-left me-2"></i> Kembali
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
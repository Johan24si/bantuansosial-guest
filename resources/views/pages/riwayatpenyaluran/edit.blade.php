@extends('layouts2.guest.app')

@section('content')
<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">
            Riwayat Penyaluran
        </h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item">
                    <a class="text-white" href="#">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-white" href="#">Pages</a>
                </li>
                <li class="breadcrumb-item text-warning active">
                    Riwayat
                </li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <h4 class="mb-3">Edit Riwayat Penyaluran Bantuan</h4>

    <form action="{{ route('riwayat_penyaluran.update', $item->penyaluran_id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- PROGRAM --}}
        <div class="mb-3">
            <label class="form-label">Program Bantuan</label>
            <select name="program_id" class="form-control" required>
                @foreach($program as $p)
                    <option value="{{ $p->program_id }}"
                        {{ $item->program_id == $p->program_id ? 'selected' : '' }}>
                        {{ $p->nama_program }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- PENERIMA --}}
        <div class="mb-3">
            <label class="form-label">Penerima Bantuan</label>
            <select name="penerima_id" class="form-control" required>
                @foreach($penerima as $pn)
                    <option value="{{ $pn->penerima_id }}"
                        {{ $item->penerima_id == $pn->penerima_id ? 'selected' : '' }}>
                        {{ $pn->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- TAHAP --}}
        <div class="mb-3">
            <label class="form-label">Tahap Ke</label>
            <input type="number"
                   name="tahap_ke"
                   class="form-control"
                   value="{{ $item->tahap_ke }}"
                   required>
        </div>

        {{-- TANGGAL --}}
        <div class="mb-3">
            <label class="form-label">Tanggal Penyaluran</label>
            <input type="date"
                   name="tanggal"
                   class="form-control"
                   value="{{ $item->tanggal }}"
                   required>
        </div>

        {{-- NILAI --}}
        <div class="mb-3">
            <label class="form-label">Nilai Bantuan</label>
            <input type="number"
                   name="nilai"
                   class="form-control"
                   value="{{ $item->nilai }}"
                   required>
        </div>

        {{-- MEDIA SAAT INI --}}
        <div class="mb-3">
            <label class="form-label">Bukti Penyaluran Saat Ini</label><br>

            @if($item->media->count() > 0)
                @foreach($item->media as $m)
                    @if(
                        $m->mime_type == 'image/jpeg' ||
                        $m->mime_type == 'image/png'  ||
                        $m->mime_type == 'image/jpg'
                    )
                        <img src="{{ asset('storage/'.$m->file_name) }}"
                             width="90"
                             class="rounded me-2 mb-2">
                    @else
                        <a href="{{ asset('storage/'.$m->file_name) }}"
                           target="_blank"
                           class="d-block mb-2">
                            Lihat Dokumen
                        </a>
                    @endif
                @endforeach
            @else
                <p class="text-muted">Belum ada bukti penyaluran</p>
            @endif
        </div>

        {{-- TAMBAH MEDIA BARU --}}
        <div class="mb-3">
            <label class="form-label">
                Tambah Bukti Baru (Foto / PDF)
            </label>
            <input type="file"
                   name="media[]"
                   class="form-control"
                   multiple
                   accept="image/*,application/pdf">
        </div>

        {{-- BUTTON --}}
        <button class="btn btn-primary">
            Update
        </button>
        <a href="{{ route('riwayat_penyaluran.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
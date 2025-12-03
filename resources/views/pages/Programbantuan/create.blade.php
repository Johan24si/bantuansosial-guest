@extends('layouts2.guest.app')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Tambah Program Bantuan</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Tambah Program Bantuan</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5 align-items-center">

            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Program Bantuan</div>
                <h1 class="display-6 mb-5">Tambah Program Bantuan Baru</h1>
                <p class="mb-0">
                    Silakan isi semua informasi terkait program bantuan dan upload gambar / file jika diperlukan.
                </p>
            </div>

            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100 bg-secondary p-5">
                    <h2 class="mb-4">Form Tambah Program Bantuan</h2>

                    <form action="{{ route('program_bantuan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Kode</label>
                            <input type="text" name="kode" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Nama Program</label>
                            <input type="text" name="nama_program" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Tahun</label>
                            <input type="number" name="tahun" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Anggaran</label>
                            <input type="number" step="0.01" name="anggaran" class="form-control" required>
                        </div>

                        <!-- ⬇⬇⬇ FIELD DESKRIPSI (DITAMBAHKAN SESUAI CONTROLLER) -->
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                        </div>
                        <!-- ⬆⬆⬆ END DESKRIPSI -->

                        <!-- Media Upload -->
                        <div class="mb-3">
                            <label>Media (Gambar / File)
                                <small class="text-muted">(boleh upload lebih dari satu)</small>
                            </label>

                            <input type="file" name="media[]" multiple class="form-control">

                            <div id="preview" class="mt-2"></div>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Simpan</button>
                        <a href="{{ route('program_bantuan.index') }}" class="btn btn-secondary mt-3">Kembali</a>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Preview JS --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const input = document.querySelector('input[name="media[]"]');

    if (input) {
        input.addEventListener('change', function (e) {
            const preview = document.getElementById('preview');
            preview.innerHTML = "";

            [...e.target.files].forEach(file => {
                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.width = 120;
                        img.classList.add("me-2", "mb-2", "rounded");
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    }
});
</script>

@endsection

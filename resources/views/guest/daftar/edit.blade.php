@extends('layouts2.guest.app')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Edit Data</h1>
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


<!-- Edit Form Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5 justify-content-center">

            <div class="col-lg-8 wow fadeIn" data-wow-delay="0.1s">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-5">
                        
                        <div class="text-center mb-5">
                            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Edit Form</div>
                            <h1 class="display-6 mb-3">Form Pendaftaran Bantuan</h1>
                            <p class="text-muted mb-0">
                                Silakan perbarui data pendaftar dengan benar sesuai ketentuan
                            </p>
                            <div class="border-bottom mt-4 mb-4"></div>
                        </div>

                        <form action="{{ route('update', $data->pendaftar_id) }}" 
                              method="POST" 
                              enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <!-- Section: Program Bantuan -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Program Bantuan *</h5>
                                
                                <!-- Pilih Program -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Pilih Program</label>
                                    <select name="program_id" class="form-select form-control-lg" required>
                                        <option value="">-- Pilih program bantuan yang tersedia --</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->program_id }}"
                                                {{ $program->program_id == $data->program_id ? 'selected' : '' }}>
                                                {{ $program->nama_program }} ({{ $program->tahun }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status Seleksi -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Status Seleksi</label>
                                    <select name="status_seleksi" class="form-select form-control-lg">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Lulus" {{ $data->status_seleksi == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                                        <option value="Tidak Lulus" {{ $data->status_seleksi == 'Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                        <option value="Ditolak" {{ $data->status_seleksi == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <div class="form-text">Opsional - dapat dikosongkan</div>
                                </div>

                                <!-- Upload Berkas -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Upload Berkas (bisa lebih dari satu)</label>
                                    <div class="upload-area border rounded-3 p-4 text-center bg-light">
                                        <i class="bi bi-cloud-upload fs-1 text-muted mb-3 d-block"></i>
                                        <p class="text-muted mb-2">Drag & Drop files here or click to upload</p>
                                        <input type="file" 
                                               name="media[]" 
                                               class="form-control d-none" 
                                               id="fileUpload"
                                               multiple
                                               accept=".jpg,.jpeg,.png,.webp,.mp4,.pdf">
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('fileUpload').click()">
                                            Pilih File
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Warga ID -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Warga ID *</h5>
                                
                                <!-- Pilih Warga -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Pilih Warga</label>
                                    <input type="number" 
                                           name="warga_id" 
                                           class="form-control form-control-lg" 
                                           value="{{ $data->warga_id }}" 
                                           placeholder="Masukkan ID warga yang valid"
                                           required>
                                    <div class="form-text">Pilih warga berdasarkan NIK dan Nama</div>
                                </div>
                            </div>

                            <!-- Media Lama Section -->
                            @if($data->media && count($data->media) > 0)
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Media Terlampir</h5>
                                <div class="row g-3">
                                    @foreach($data->media as $media)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="card border">
                                                <div class="card-body text-center p-3">
                                                    @if(str_contains($media->mime_type, 'image'))
                                                        <img src="{{ asset('storage/' . $media->file_name) }}" 
                                                             class="img-fluid rounded mb-2"
                                                             style="max-height: 120px; object-fit: cover;">
                                                        <p class="text-muted small mb-0">Gambar</p>
                                                    @else
                                                        <div class="bg-light rounded-circle mx-auto mb-2" 
                                                             style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="bi bi-file-earmark-text fs-1 text-dark"></i>
                                                        </div>
                                                        <p class="text-muted small mb-0">Dokumen</p>
                                                    @endif
                                                    <a href="{{ asset('storage/' . $media->file_name) }}" 
                                                       target="_blank"
                                                       class="btn btn-sm btn-outline-primary mt-2">
                                                        Lihat
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Upload Media Baru -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Tambah Media Baru</h5>
                                <div class="input-group">
                                    <input type="file" 
                                           name="media[]" 
                                           class="form-control form-control-lg" 
                                           multiple
                                           accept=".jpg,.jpeg,.png,.webp,.mp4,.pdf">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="bi bi-paperclip"></i>
                                    </button>
                                </div>
                                <div class="form-text">Opsional - dapat dikosongkan</div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                                <a href="{{ route('index') }}" class="btn btn-secondary me-md-2 px-4">Kembali</a>
                                <button class="btn btn-primary px-5" type="submit">Update Data</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.upload-area {
    border: 2px dashed #dee2e6;
    transition: all 0.3s;
    cursor: pointer;
}

.upload-area:hover {
    border-color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.05);
}

.form-control-lg {
    padding: 0.75rem 1rem;
    font-size: 1rem;
}

.card {
    border-radius: 12px;
    overflow: hidden;
}
</style>

<script>
// Drag and drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.querySelector('.upload-area');
    const fileInput = document.getElementById('fileUpload');
    
    if (uploadArea) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            uploadArea.style.borderColor = '#0d6efd';
            uploadArea.style.backgroundColor = 'rgba(13, 110, 253, 0.1)';
        }
        
        function unhighlight() {
            uploadArea.style.borderColor = '#dee2e6';
            uploadArea.style.backgroundColor = '#f8f9fa';
        }
        
        uploadArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
        }
        
        uploadArea.addEventListener('click', function() {
            fileInput.click();
        });
    }
});
</script>

@endsection
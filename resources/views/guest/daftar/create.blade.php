@extends('layouts2.guest.app')
@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header  wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Tambah Data</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Tambah Data</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Main Container -->
<div class="container-fluid py-5 cosmic-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Main Form Card -->
                <div class="cosmic-card rounded-4 overflow-hidden">
                    <!-- Card Header -->
                    <div class="cosmic-card-header p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3 class="mb-0">
                                    <i class="fas fa-user-plus me-2 cosmic-icon"></i>
                                    Form Pendaftaran Bantuan
                                </h3>
                                <p class="mb-0 mt-2 cosmic-subtitle">
                                    Silakan isi data pendaftar dengan benar sesuai ketentuan
                                </p>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="d-inline-block cosmic-status-badge">
                                    <i class="fas fa-clock me-1"></i>
                                    <span>Draft</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5">
                        <form action="{{ route('store') }}" 
                              method="POST" 
                              enctype="multipart/form-data"
                              class="cosmic-form">
                            
                            @csrf

                            <!-- Program Bantuan -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="cosmic-form-label">
                                        <i class="fas fa-handshake me-2 cosmic-icon"></i>
                                        Program Bantuan
                                        <span class="cosmic-required">*</span>
                                    </label>
                                    <div class="cosmic-input-group">
                                        <div class="cosmic-input-icon">
                                            <i class="fas fa-list"></i>
                                        </div>
                                        <select name="program_id" class="cosmic-form-select" required>
                                            <option value="" disabled selected>-- Pilih Program --</option>
                                            
                                            <!-- Debug: Cek apakah variable $programs ada -->
                                            @php
                                                // Debug info
                                                // echo "<!-- Debug: \$programs count = " . (isset($programs) ? count($programs) : 0) . " -->";
                                            @endphp
                                            
                                            @if(isset($programs) && count($programs) > 0)
                                                @foreach($programs as $program)
                                                    @php
                                                        // Debug data program
                                                        // echo "<!-- Debug: Program ID: " . ($program->id ?? $program->program_id ?? 'N/A') . " -->";
                                                        // echo "<!-- Debug: Program Name: " . ($program->nama_program ?? $program->name ?? 'N/A') . " -->";
                                                        // echo "<!-- Debug: Tahun: " . ($program->tahun ?? $program->year ?? 'N/A') . " -->";
                                                    @endphp
                                                    <option value="{{ $program->id ?? $program->program_id ?? '' }}">
                                                        {{ $program->nama_program ?? $program->name ?? 'Unknown' }} 
                                                        ({{ $program->tahun ?? $program->year ?? 'N/A' }})
                                                    </option>
                                                @endforeach
                                            @else
                                                <!-- Fallback jika tidak ada data -->
                                                <option value="1">Program Keluarga Harapan (2024)</option>
                                                <option value="2">Program Pendidikan (2024)</option>
                                                <option value="3">Program Kesehatan (2024)</option>
                                                <option value="4">Program Sosial (2024)</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="cosmic-form-text">Pilih program bantuan yang tersedia</div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="cosmic-form-label">
                                        <i class="fas fa-id-card me-2 cosmic-icon"></i>
                                        Warga ID
                                        <span class="cosmic-required">*</span>
                                    </label>
                                   <div class="col-md-6">

    <div class="cosmic-input-group">
        <div class="cosmic-input-icon">
            <i class="fas fa-user"></i>
        </div>

        <select name="warga_id" class="cosmic-form-select" required>
            <option value="" disabled selected>-- Pilih Warga --</option>

            @foreach($wargas as $warga)
                <option value="{{ $warga->warga_id }}">
                    {{ $warga->no_ktp }} - {{ $warga->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="cosmic-form-text">
        Pilih warga berdasarkan NIK dan Nama
    </div>
</div>

                                    <div class="cosmic-form-text">Masukkan ID warga yang valid</div>
                                </div>
                            </div>

                            <!-- Status Seleksi -->
                            <div class="mb-4">
                                <label class="cosmic-form-label">
                                    <i class="fas fa-clipboard-check me-2 cosmic-icon"></i>
                                    Status Seleksi
                                </label>
                                <div class="cosmic-input-group">
                                    <div class="cosmic-input-icon">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    <input type="text" 
                                           name="status_seleksi" 
                                           class="cosmic-form-control" 
                                           placeholder="Contoh: Lulus, Tidak Lulus, Ditolak">
                                </div>
                                <div class="cosmic-form-text">Opsional - dapat dikosongkan</div>
                            </div>

                            <!-- Upload Media -->
                            <div class="mb-5">
                                <label class="cosmic-form-label">
                                    <i class="fas fa-file-upload me-2 cosmic-icon"></i>
                                    Upload Berkas (bisa lebih dari satu)
                                </label>
                                <div class="cosmic-upload-area" id="uploadArea">
                                    <div class="text-center py-5">
                                        <i class="fas fa-cloud-upload-alt cosmic-upload-icon mb-3"></i>
                                        <h5 class="mb-2">Drag & Drop files here or click to upload</h5>
                                        <p class="cosmic-upload-text mb-0">
                                            Maksimal 5MB per file. Format: JPG, PNG, WEBP, MP4, PDF
                                        </p>
                                    </div>
                                    <input type="file" 
                                           name="media[]" 
                                           class="cosmic-file-input" 
                                           multiple
                                           accept=".jpg,.jpeg,.png,.webp,.mp4,.pdf"
                                           id="fileUpload">
                                </div>
                                <div id="fileList" class="mt-3"></div>
                            </div>

                            <!-- Important Notes -->
                            <div class="cosmic-notes-card p-4 rounded-3 mb-5">
                                <div class="d-flex">
                                    <i class="fas fa-exclamation-circle cosmic-note-icon mt-1 me-3"></i>
                                    <div>
                                        <h6 class="cosmic-note-title mb-2">Perhatian Penting:</h6>
                                        <ul class="cosmic-note-list mb-0">
                                            <li>Pastikan semua data yang dimasukkan sudah benar dan valid</li>
                                            <li>File yang diupload maksimal 5MB per file</li>
                                            <li>Data yang sudah disimpan tidak dapat diubah tanpa persetujuan admin</li>
                                            <li>Proses verifikasi membutuhkan waktu 3-5 hari kerja</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top cosmic-border">
                                <a href="{{ route('index') }}" class="btn btn-cosmic-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-cosmic-outline me-3">
                                        <i class="fas fa-redo me-2"></i> Reset Form
                                    </button>
                                    <button type="submit" class="btn btn-cosmic-success">
                                        <i class="fas fa-save me-2"></i> Simpan Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Debug: Log ke console jika diperlukan
    console.log('Form loaded successfully');
    
    const fileInput = document.getElementById('fileUpload');
    const fileList = document.getElementById('fileList');
    const uploadArea = document.getElementById('uploadArea');
    
    // Upload area click handler
    if (uploadArea && fileInput) {
        uploadArea.addEventListener('click', function() {
            fileInput.click();
        });
        
        // Drag and drop functionality
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
            uploadArea.classList.add('cosmic-upload-highlight');
        }
        
        function unhighlight() {
            uploadArea.classList.remove('cosmic-upload-highlight');
        }
        
        uploadArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            handleFiles(files);
        }
    }
    
    // File input change handler
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });
    }
    
    function handleFiles(files) {
        fileList.innerHTML = '';
        
        if (files.length > 0) {
            const fileCount = document.createElement('div');
            fileCount.className = 'cosmic-file-count mb-3';
            fileCount.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-file me-2"></i>
                        <strong>${files.length} file dipilih</strong>
                    </div>
                    <button type="button" class="btn btn-sm btn-cosmic-outline" onclick="clearFiles()">
                        <i class="fas fa-times me-1"></i> Hapus Semua
                    </button>
                </div>
            `;
            fileList.appendChild(fileCount);
            
            const fileItems = document.createElement('div');
            fileItems.className = 'row';
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileSize = (file.size / (1024 * 1024)).toFixed(2);
                const fileType = file.type.split('/')[1] || file.name.split('.').pop();
                const fileName = file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name;
                
                const fileItem = document.createElement('div');
                fileItem.className = 'col-md-4 mb-3';
                fileItem.innerHTML = `
                    <div class="cosmic-file-item">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="cosmic-file-icon">
                                <i class="fas fa-file"></i>
                            </div>
                            <button type="button" class="btn btn-sm btn-cosmic-danger" onclick="removeFile(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="cosmic-file-name">${fileName}</div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="cosmic-file-type">${fileType}</span>
                            <span class="cosmic-file-size">${fileSize} MB</span>
                        </div>
                    </div>
                `;
                fileItems.appendChild(fileItem);
            }
            
            fileList.appendChild(fileItems);
        }
    }
    
    // Clear all files
    window.clearFiles = function() {
        if (fileInput) {
            fileInput.value = '';
            fileList.innerHTML = '';
        }
    };
    
    // Remove single file
    window.removeFile = function(button) {
        const fileItem = button.closest('.col-md-4');
        if (fileItem) {
            fileItem.remove();
            
            // Update file count
            const remainingFiles = document.querySelectorAll('.cosmic-file-item').length;
            const fileCountElement = document.querySelector('.cosmic-file-count strong');
            if (fileCountElement) {
                fileCountElement.textContent = `${remainingFiles} file dipilih`;
            }
            
            if (remainingFiles === 0) {
                fileList.innerHTML = '';
            }
        }
    };
});

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.cosmic-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                
                // Add validation styles
                const inputs = form.querySelectorAll('.cosmic-form-control, .cosmic-form-select');
                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
            }
            form.classList.add('was-validated');
        }, false);
    });
});
</script>

<!-- Cosmic CSS -->
<style>
:root {
    --cosmic-primary: #6c63ff;
    --cosmic-secondary: #1a1a2e;
    --cosmic-accent: #00d4ff;
    --cosmic-dark: #0f3460;
    --cosmic-light: #e6f7ff;
    --cosmic-success: #00b894;
    --cosmic-danger: #ff4757;
    --cosmic-warning: #f9ca24;
    --cosmic-gradient: linear-gradient(135deg, #6c63ff 0%, #00d4ff 100%);
    --cosmic-bg: radial-gradient(circle at 50% 50%, #1a1a2e 0%, #16213e 100%);
}

/* Header */
.page-header-cosmic {
    background: var(--cosmic-gradient);
    position: relative;
    overflow: hidden;
    padding: 80px 0 60px !important;
}

.page-header-cosmic::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><circle cx="20" cy="30" r="1" fill="rgba(255,255,255,0.3)"/><circle cx="50" cy="20" r="0.8" fill="rgba(255,255,255,0.3)"/><circle cx="80" cy="40" r="1.2" fill="rgba(255,255,255,0.3)"/><circle cx="30" cy="70" r="0.7" fill="rgba(255,255,255,0.3)"/><circle cx="70" cy="60" r="1" fill="rgba(255,255,255,0.3)"/></svg>');
    opacity: 0.2;
}

.cosmic-gradient-text {
    background: linear-gradient(45deg, #ffffff, var(--cosmic-accent));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    font-weight: 800;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.cosmic-active {
    color: var(--cosmic-accent) !important;
    font-weight: 600;
}

/* Background */
.cosmic-bg {
    background: var(--cosmic-bg);
    min-height: calc(100vh - 200px);
}

/* Main Card */
.cosmic-card {
    background: rgba(26, 26, 46, 0.95);
    border: 1px solid rgba(108, 99, 255, 0.2);
    backdrop-filter: blur(20px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    border-radius: 20px;
    overflow: hidden;
}

.cosmic-card-header {
    background: linear-gradient(90deg, rgba(108, 99, 255, 0.2), rgba(0, 212, 255, 0.2));
    border-bottom: 1px solid rgba(108, 99, 255, 0.3);
    color: white;
}

.cosmic-card-header h3 {
    color: white;
    font-weight: 600;
    font-size: 1.5rem;
}

.cosmic-subtitle {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
}

.cosmic-status-badge {
    background: rgba(249, 202, 36, 0.2);
    color: var(--cosmic-warning);
    padding: 6px 15px;
    border-radius: 20px;
    border: 1px solid rgba(249, 202, 36, 0.3);
    font-size: 0.9rem;
    font-weight: 500;
}

/* Form Elements - SELECT khusus */
.cosmic-form-label {
    color: white;
    font-weight: 500;
    margin-bottom: 8px;
    display: block;
    font-size: 0.95rem;
}

.cosmic-required {
    color: var(--cosmic-danger);
}

.cosmic-input-group {
    position: relative;
    margin-bottom: 5px;
}

.cosmic-input-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--cosmic-accent);
    z-index: 2;
    font-size: 1rem;
}

/* Fix untuk dropdown agar teks terlihat */
.cosmic-form-control,
.cosmic-form-select {
    width: 100%;
    padding: 14px 20px 14px 45px;
    background: rgba(255, 255, 255, 0.08);
    border: 2px solid rgba(108, 99, 255, 0.2);
    border-radius: 12px;
    color: white !important; /* Force white text */
    font-size: 16px;
    transition: all 0.3s ease;
}

/* Fix warna option di dropdown */
.cosmic-form-select option {
    background: #1a1a2e;
    color: white;
    padding: 10px;
}

/* Hover state untuk option */
.cosmic-form-select option:hover,
.cosmic-form-select option:focus {
    background: var(--cosmic-primary);
    color: white;
}

/* Selected option */
.cosmic-form-select option:checked {
    background: var(--cosmic-primary);
    color: white;
}

/* Placeholder styling */
.cosmic-form-select option[value=""][disabled] {
    color: rgba(255, 255, 255, 0.5);
    background: #1a1a2e;
}

.cosmic-form-control:focus,
.cosmic-form-select:focus {
    outline: none;
    border-color: var(--cosmic-primary);
    box-shadow: 0 0 25px rgba(108, 99, 255, 0.3);
    background: rgba(255, 255, 255, 0.12);
    transform: translateY(-2px);
}

.cosmic-form-control.is-invalid {
    border-color: var(--cosmic-danger);
    background: rgba(255, 71, 87, 0.1);
}

.cosmic-form-text {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.85rem;
    margin-top: 5px;
}

/* Upload Area */
.cosmic-upload-area {
    background: rgba(108, 99, 255, 0.05);
    border: 2px dashed rgba(108, 99, 255, 0.3);
    border-radius: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.cosmic-upload-area:hover {
    border-color: var(--cosmic-primary);
    background: rgba(108, 99, 255, 0.1);
    transform: translateY(-2px);
}

.cosmic-upload-highlight {
    border-color: var(--cosmic-accent) !important;
    background: rgba(0, 212, 255, 0.15) !important;
    transform: scale(1.02);
}

.cosmic-upload-icon {
    font-size: 3.5rem;
    color: var(--cosmic-primary);
    opacity: 0.7;
    transition: all 0.3s ease;
}

.cosmic-upload-area:hover .cosmic-upload-icon {
    transform: translateY(-5px);
    opacity: 1;
}

.cosmic-upload-text {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9rem;
}

.cosmic-file-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

/* File List */
.cosmic-file-count {
    color: white;
    padding: 15px;
    background: rgba(108, 99, 255, 0.1);
    border-radius: 12px;
    border-left: 4px solid var(--cosmic-primary);
}

.cosmic-file-item {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(108, 99, 255, 0.2);
    border-radius: 12px;
    padding: 15px;
    height: 100%;
    transition: all 0.3s ease;
}

.cosmic-file-item:hover {
    background: rgba(108, 99, 255, 0.1);
    border-color: var(--cosmic-primary);
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.cosmic-file-icon {
    font-size: 2rem;
    color: var(--cosmic-primary);
}

.cosmic-file-name {
    color: white;
    font-weight: 500;
    font-size: 0.9rem;
    margin-bottom: 5px;
    word-break: break-word;
}

.cosmic-file-size {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.85rem;
}

.cosmic-file-type {
    background: rgba(0, 212, 255, 0.2);
    color: var(--cosmic-accent);
    padding: 3px 10px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Notes Card */
.cosmic-notes-card {
    background: rgba(249, 202, 36, 0.1);
    border: 1px solid rgba(249, 202, 36, 0.3);
}

.cosmic-note-icon {
    color: var(--cosmic-warning);
    font-size: 1.5rem;
}

.cosmic-note-title {
    color: var(--cosmic-warning);
    font-weight: 600;
    font-size: 1.1rem;
}

.cosmic-note-list {
    color: rgba(255, 255, 255, 0.8);
    padding-left: 20px;
    margin-bottom: 0;
}

.cosmic-note-list li {
    margin-bottom: 5px;
    font-size: 0.95rem;
}

/* Buttons */
.btn-cosmic-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    padding: 12px 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-cosmic-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: white;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(255, 255, 255, 0.1);
}

.btn-cosmic-outline {
    background: transparent;
    color: var(--cosmic-accent);
    border: 2px solid var(--cosmic-accent);
    border-radius: 12px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-cosmic-outline:hover {
    background: rgba(0, 212, 255, 0.1);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0, 212, 255, 0.2);
}

.btn-cosmic-success {
    background: linear-gradient(135deg, var(--cosmic-success), #00d9a6);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 35px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-cosmic-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 30px rgba(0, 184, 148, 0.4);
    color: white;
}

.btn-cosmic-danger {
    background: rgba(255, 71, 87, 0.1);
    color: var(--cosmic-danger);
    border: 1px solid rgba(255, 71, 87, 0.3);
    border-radius: 8px;
    padding: 5px 10px;
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.btn-cosmic-danger:hover {
    background: rgba(255, 71, 87, 0.2);
    border-color: var(--cosmic-danger);
    color: white;
    transform: scale(1.1);
}

/* Border */
.cosmic-border {
    border-top: 1px solid rgba(108, 99, 255, 0.2) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .page-header-cosmic {
        padding: 60px 0 40px !important;
    }
    
    .cosmic-gradient-text {
        font-size: 2.5rem;
    }
    
    .cosmic-card {
        margin: 0 15px;
    }
    
    .cosmic-stat-card {
        margin-bottom: 15px;
    }
}
</style>

@endsection
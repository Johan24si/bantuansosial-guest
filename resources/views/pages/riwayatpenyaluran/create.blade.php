@extends('layouts2.guest.app')

@section('content')
<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">
            Tambah Riwayat Penyaluran
        </h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item">
                    <a class="text-white" href="#">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-white" href="#">Pages</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-white" href="{{ route('riwayat_penyaluran.index') }}">Riwayat</a>
                </li>
                <li class="breadcrumb-item text-warning active">
                    Tambah
                </li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-dark p-4 rounded-4 shadow-lg cosmic-bg mb-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                
                {{-- Card Form --}}
                <div class="card border-0 shadow-lg card-3d">
                    <div class="card-header cosmic-form-header py-4">
                        <h4 class="text-white fw-bold mb-0 text-center">
                            <i class="bi bi-plus-circle me-2"></i>
                            Tambah Data Penyaluran Baru
                        </h4>
                    </div>
                    
                    <div class="card-body p-4 bg-space">
                        <form action="{{ route('riwayat_penyaluran.store') }}"
                              method="POST"
                              enctype="multipart/form-data"
                              id="penyaluranForm">
                            @csrf
                            
                            {{-- Alert Area --}}
                            @if($errors->any())
                            <div class="alert alert-danger alert-glow-danger mb-4">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Periksa kesalahan berikut:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            
                            {{-- PROGRAM BANTUAN --}}
                            <div class="form-group mb-4">
                                <label class="form-label text-white fw-bold mb-2">
                                    <i class="bi bi-box-seam me-2 text-info"></i>
                                    Program Bantuan <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-space border-space">
                                        <i class="bi bi-box-seam"></i>
                                    </span>
                                    <select name="program_id" 
                                            class="form-control bg-white border-space select-input"
                                            required>
                                        <option value="" disabled selected>-- Pilih Program Bantuan --</option>
                                        @foreach($program as $p)
                                            <option value="{{ $p->program_id }}" 
                                                {{ old('program_id') == $p->program_id ? 'selected' : '' }}>
                                                {{ $p->nama_program }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('program_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            {{-- PENERIMA BANTUAN --}}
                            <div class="form-group mb-4">
                                <label class="form-label text-white fw-bold mb-2">
                                    <i class="bi bi-person-check me-2 text-success"></i>
                                    Penerima Bantuan <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-space border-space">
                                        <i class="bi bi-person-check"></i>
                                    </span>
                                    <select name="penerima_id" 
                                            class="form-control bg-white border-space select-input"
                                            required>
                                        <option value="" disabled selected>-- Pilih Penerima Bantuan --</option>
                                        @foreach($penerima as $pn)
                                            <option value="{{ $pn->penerima_id }}"
                                                {{ old('penerima_id') == $pn->penerima_id ? 'selected' : '' }}>
                                                {{ $pn->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('penerima_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            {{-- TWO COLUMN: TAHAP & TANGGAL --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-white fw-bold mb-2">
                                            <i class="bi bi-123 me-2 text-warning"></i>
                                            Tahap Ke <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-space border-space">
                                                <i class="bi bi-123"></i>
                                            </span>
                                            <input type="number" 
                                                   name="tahap_ke" 
                                                   class="form-control bg-white border-space text-input"
                                                   required
                                                   value="{{ old('tahap_ke') }}"
                                                   min="1"
                                                   placeholder="Contoh: 1"
                                                   id="tahapInput">
                                        </div>
                                        @error('tahap_ke')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-white fw-bold mb-2">
                                            <i class="bi bi-calendar-date me-2 text-warning"></i>
                                            Tanggal Penyaluran <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-space border-space">
                                                <i class="bi bi-calendar-date"></i>
                                            </span>
                                            <input type="date" 
                                                   name="tanggal" 
                                                   class="form-control bg-white border-space text-input"
                                                   required
                                                   value="{{ old('tanggal', date('Y-m-d')) }}"
                                                   id="tanggalInput">
                                        </div>
                                        @error('tanggal')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            {{-- NILAI BANTUAN --}}
                            <div class="form-group mb-4">
                                <label class="form-label text-white fw-bold mb-2">
                                    <i class="bi bi-cash-coin me-2 text-warning"></i>
                                    Nilai Bantuan <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-space border-space">
                                        <i class="bi bi-cash-coin"></i>
                                    </span>
                                    <input type="text" 
                                           name="nilai" 
                                           class="form-control bg-white border-space text-input nilai-input"
                                           required
                                           value="{{ old('nilai') }}"
                                           id="nilaiInput"
                                           placeholder="Contoh: 1000000">
                                    <span class="input-group-text bg-space border-space">
                                        Rp
                                    </span>
                                </div>
                                @error('nilai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <small class="text-white-50 mt-1 d-block">
                                    <i class="bi bi-info-circle me-1"></i> Masukkan angka tanpa titik atau koma
                                </small>
                            </div>
                            
                            {{-- UPLOAD MEDIA --}}
                            <div class="form-group mb-4">
                                <label class="form-label text-white fw-bold mb-2">
                                    <i class="bi bi-images me-2 text-info"></i>
                                    Bukti Penyaluran (Opsional)
                                </label>
                                
                                {{-- File Upload Box --}}
                                <div class="file-upload-box border-dashed rounded-3 p-4 text-center mb-3"
                                     style="border: 2px dashed rgba(255,255,255,0.3); background: rgba(255,255,255,0.05);">
                                    <div class="upload-icon mb-3">
                                        <i class="bi bi-cloud-arrow-up display-4 text-white-50"></i>
                                    </div>
                                    <p class="text-white-50 mb-3">
                                        Klik tombol di bawah untuk memilih file<br>
                                        <small>Format: JPG, PNG, PDF (Maks. 2MB per file)</small>
                                    </p>
                                    <div class="file-input-wrapper">
                                        <input type="file"
                                               name="media[]"
                                               class="form-control bg-white"
                                               multiple
                                               id="mediaInput"
                                               accept="image/*,application/pdf">
                                    </div>
                                </div>
                                
                                @error('media.*')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            {{-- BUTTONS --}}
                            <div class="d-flex gap-3 mt-5 pt-3 border-top border-white border-opacity-25">
                                <button type="submit" 
                                        class="btn btn-success btn-glow flex-fill py-3 fw-bold"
                                        id="submitBtn">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Simpan Data
                                </button>
                                
                                <a href="{{ route('riwayat_penyaluran.index') }}" 
                                   class="btn btn-outline-light border-space flex-fill py-3 fw-bold">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                    
                    {{-- Card Footer --}}
                    <div class="card-footer bg-space border-top-0 text-center py-3">
                        <small class="text-white-50">
                            <i class="bi bi-info-circle me-1"></i>
                            Pastikan data yang diinput sudah benar sebelum disimpan
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

/* Form Header */
.cosmic-form-header {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

/* Card 3D Effect */
.card-3d {
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(30, 30, 46, 0.8);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    overflow: hidden;
}

/* Background Space */
.bg-space {
    background: rgba(20, 20, 40, 0.8);
}

.border-space {
    border-color: rgba(255, 255, 255, 0.2) !important;
}

/* Input Styling - PERBAIKAN UTAMA */
.text-input,
.select-input {
    background-color: #ffffff !important;
    color: #000000 !important;
    border-color: #dee2e6 !important;
}

.text-input::placeholder {
    color: #6c757d !important;
    opacity: 0.8 !important;
}

.select-input option {
    color: #000000 !important;
    background-color: #ffffff !important;
}

.text-input:focus,
.select-input:focus {
    background-color: #ffffff !important;
    color: #000000 !important;
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25) !important;
}

/* Input group text styling */
.input-group-text {
    background-color: rgba(20, 20, 40, 0.8) !important;
    color: #ffffff !important;
    border-color: rgba(255, 255, 255, 0.2) !important;
}

/* File Upload Box */
.file-upload-box:hover {
    border-color: #0d6efd !important;
    background: rgba(13, 110, 253, 0.1) !important;
}

.file-upload-box input[type="file"] {
    background-color: #ffffff !important;
    color: #000000 !important;
}

/* Text Colors */
.text-white-50 {
    color: rgba(255, 255, 255, 0.7) !important;
}

/* Animations */
@keyframes twinkle {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
}

/* Responsive */
@media (max-width: 768px) {
    .cosmic-bg {
        padding: 1.5rem !important;
    }
    
    .input-group-lg {
        flex-wrap: nowrap;
    }
    
    .input-group-lg .form-control {
        font-size: 14px !important;
    }
}

/* Date Input Styling */
input[type="date"] {
    color: #000000 !important;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(0) !important;
    opacity: 0.7;
}

/* Custom Select Arrow */
select.select-input {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23000000' class='bi bi-chevron-down' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px 12px;
    padding-right: 2.5rem !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('penyaluranForm');
    const submitBtn = document.getElementById('submitBtn');
    const nilaiInput = document.getElementById('nilaiInput');
    const tahapInput = document.getElementById('tahapInput');
    const tanggalInput = document.getElementById('tanggalInput');
    
    // Format nilai dengan titik ribuan saat blur
    nilaiInput.addEventListener('blur', function() {
        let value = this.value.replace(/\D/g, '');
        if (value) {
            this.value = parseInt(value).toLocaleString('id-ID');
        }
    });
    
    // Hapus format titik saat fokus
    nilaiInput.addEventListener('focus', function() {
        this.value = this.value.replace(/\./g, '');
    });
    
    // Validasi tahap ke (hanya angka)
    tahapInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });
    
    // Set tanggal default jika kosong
    if (tanggalInput && !tanggalInput.value) {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        tanggalInput.value = `${yyyy}-${mm}-${dd}`;
    }
    
    // Handle form submission
    form.addEventListener('submit', function(e) {
        // Validasi semua field wajib
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#dc3545';
                field.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.25)';
                
                // Scroll ke field yang error
                if (!document.querySelector('.alert-danger')) {
                    field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                field.style.borderColor = '';
                field.style.boxShadow = '';
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            
            // Tampilkan alert jika belum ada
            if (!document.querySelector('.alert-danger:not(.alert-glow-danger)')) {
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger mb-4';
                alertDiv.innerHTML = `
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Mohon lengkapi semua field yang wajib diisi!</strong>
                `;
                form.prepend(alertDiv);
                
                // Hapus alert setelah 5 detik
                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }
            return false;
        }
        
        // Hapus titik dari nilai sebelum submit
        if (nilaiInput.value) {
            nilaiInput.value = nilaiInput.value.replace(/\./g, '');
        }
        
        // Tampilkan loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Menyimpan...';
        submitBtn.disabled = true;
        
        // Kembalikan state setelah 3 detik jika gagal
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);
        
        return true;
    });
    
    // Real-time validation untuk setiap input
    const inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => {
        // Hapus error styling saat user mulai mengetik
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.style.borderColor = '';
                this.style.boxShadow = '';
                
                // Hapus alert error
                const alert = document.querySelector('.alert-danger:not(.alert-glow-danger)');
                if (alert) {
                    alert.remove();
                }
            }
        });
        
        // Validasi saat keluar dari field
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.style.borderColor = '#dc3545';
                this.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.25)';
            }
        });
    });
});
</script>
@endsection
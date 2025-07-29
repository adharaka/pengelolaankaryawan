@extends('layouts.app')

@section('title', 'Edit Karyawan: ' . $karyawan->nama)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-fill me-1"></i>Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}"><i class="bi bi-people-fill me-1"></i>Data Karyawan</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="bi bi-pencil-fill me-1"></i>Edit Karyawan</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-4">
                <i class="bi bi-person-gear display-1 text-warning mb-3"></i>
                <h2 class="mb-2">Edit Data Karyawan</h2>
                <p class="text-muted">Perbarui informasi karyawan di bawah ini</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-file-earmark-text me-2"></i>Form Edit Data Karyawan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form id="editForm" action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nik" class="form-label">
                                    <i class="bi bi-card-text me-1"></i>NIK <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="nik" 
                                       id="nik" 
                                       class="form-control @error('nik') is-invalid @enderror" 
                                       value="{{ old('nik', $karyawan->nik) }}" 
                                       placeholder="Contoh: 12345678" 
                                       required
                                       maxlength="20">
                                @error('nik')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>Nomor Induk Karyawan (wajib diisi)
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">
                                    <i class="bi bi-person me-1"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="nama" 
                                       id="nama" 
                                       class="form-control @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama', $karyawan->nama) }}" 
                                       placeholder="Masukkan nama lengkap karyawan" 
                                       required
                                       maxlength="100">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>Nama lengkap karyawan (wajib diisi)
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="departemen" class="form-label">
                                    <i class="bi bi-building me-1"></i>Departemen
                                </label>
                                <select name="departemen" 
                                        id="departemen" 
                                        class="form-select @error('departemen') is-invalid @enderror">
                                    <option value="">Pilih Departemen</option>
                                    <option value="Operational" {{ old('departemen', $karyawan->departemen) == 'Operational' ? 'selected' : '' }}>Operational</option>
                                    <option value="Produksi" {{ old('departemen', $karyawan->departemen) == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                                    <option value="HR" {{ old('departemen', $karyawan->departemen) == 'HR' ? 'selected' : '' }}>HR</option>
                                    <option value="Warehouse" {{ old('departemen', $karyawan->departemen) == 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
                                    <option value="GA" {{ old('departemen', $karyawan->departemen) == 'GA' ? 'selected' : '' }}>GA</option>
                                </select>
                                @error('departemen')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>Pilih departemen karyawan
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="shift" class="form-label">
                                    <i class="bi bi-clock me-1"></i>Shift Kerja
                                </label>
                                <select name="shift" 
                                        id="shift" 
                                        class="form-select @error('shift') is-invalid @enderror">
                                    <option value="">Pilih Shift</option>
                                    <option value="Shift 1" {{ old('shift', $karyawan->shift) == 'Shift 1' ? 'selected' : '' }}>Shift 1</option>
                                    <option value="Shift 2" {{ old('shift', $karyawan->shift) == 'Shift 2' ? 'selected' : '' }}>Shift 2</option>
                                    <option value="Shift 3" {{ old('shift', $karyawan->shift) == 'Shift 3' ? 'selected' : '' }}>Shift 3</option>
                                    <option value="Non-Shift" {{ old('shift', $karyawan->shift) == 'Non-Shift' ? 'selected' : '' }}>Non-Shift</option>
                                </select>
                                @error('shift')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>Pilih shift kerja karyawan
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('karyawan.index') }}" class="btn btn-secondary btn-lg">
                                <i class="bi bi-x-circle-fill me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg" onclick="return confirmUpdate()">
                                <i class="bi bi-arrow-clockwise me-2"></i>Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmUpdate() {
    const nik = document.getElementById('nik').value.trim();
    const nama = document.getElementById('nama').value.trim();
    
    if (!nik || !nama) {
        Swal.fire({
            icon: 'error',
            title: 'Data Tidak Lengkap',
            text: 'Mohon lengkapi data NIK dan Nama yang wajib diisi!',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    
    Swal.fire({
        title: 'Konfirmasi Update',
        html: `Apakah Anda yakin ingin memperbarui data karyawan <strong>${nama}</strong> dengan NIK <strong>${nik}</strong>?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="bi bi-arrow-clockwise me-1"></i>Ya, Update!',
        cancelButtonText: '<i class="bi bi-x-circle me-1"></i>Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading();
            document.getElementById('editForm').submit();
        }
    });
    
    return false;
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    // Ensure loading overlay is hidden when page loads
    if (typeof hideLoading === 'function') {
        hideLoading();
    }
    
    const form = document.getElementById('editForm');
    const nikInput = document.getElementById('nik');
    const namaInput = document.getElementById('nama');
    
    // NIK validation - only numbers
    nikInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
    // Nama validation - only letters and spaces
    namaInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });
    
    // Real-time validation feedback
    form.addEventListener('input', function() {
        const nik = nikInput.value.trim();
        const nama = namaInput.value.trim();
        
        if (nik && nama) {
            document.querySelector('button[type="submit"]').disabled = false;
        } else {
            document.querySelector('button[type="submit"]').disabled = true;
        }
    });
});
</script>
@endsection
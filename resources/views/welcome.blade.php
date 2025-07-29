@extends('layouts.app')

@section('title', 'Dashboard - Manajemen Karyawan')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><i class="bi bi-house-fill me-1"></i>Dashboard</li>
@endsection

@section('content')
<div class="container py-4">
    <!-- Welcome Section -->
    <div class="text-center mb-5">
        <div class="mb-4">
            <img src="{{ asset('image/logo_perusahaan.jpg') }}" alt="Logo Perusahaan" class="mx-auto mb-3" style="height: 80px; width: auto; border-radius: 15px;">
        </div>
        <h1 class="display-4 fw-bold mb-3">Selamat Datang di</h1>
        <h2 class="h1 mb-4">Sistem Manajemen Karyawan</h2>
        <p class="lead text-muted">Kelola data karyawan dengan mudah dan efisien</p>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-5">
        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill display-4 mb-2 text-purple"></i>
                    <h3 class="mb-1 text-dark">{{ App\Models\Karyawan::count() }}</h3>
                    <p class="mb-0 text-muted">Total Karyawan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body text-center">
                    <i class="bi bi-building-fill display-4 mb-2 text-purple"></i>
                    <h3 class="mb-1 text-dark">{{ App\Models\Karyawan::where('departemen', 'Operational')->count() }}</h3>
                    <p class="mb-0 text-muted">Operational</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body text-center">
                    <i class="bi bi-gear-fill display-4 mb-2 text-purple"></i>
                    <h3 class="mb-1 text-dark">{{ App\Models\Karyawan::where('departemen', 'Produksi')->count() }}</h3>
                    <p class="mb-0 text-muted">Produksi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body text-center">
                    <i class="bi bi-clock-fill display-4 mb-2 text-purple"></i>
                    <h3 class="mb-1 text-dark">{{ App\Models\Karyawan::where('shift', 'Shift 1')->count() }}</h3>
                    <p class="mb-0 text-muted">Shift 1</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-lightning-fill me-2"></i>Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('karyawan.create') }}" class="btn btn-success btn-lg w-100">
                                <i class="bi bi-plus-circle-fill me-2"></i>Tambah Karyawan Baru
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('karyawan.index') }}" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-people-fill me-2"></i>Lihat Semua Karyawan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-graph-up me-2"></i>Statistik
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Operational</span>
                            <span>{{ App\Models\Karyawan::where('departemen', 'Operational')->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" style="width: {{ App\Models\Karyawan::count() > 0 ? (App\Models\Karyawan::where('departemen', 'Operational')->count() / App\Models\Karyawan::count()) * 100 : 0 }}%; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Produksi</span>
                            <span>{{ App\Models\Karyawan::where('departemen', 'Produksi')->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" style="width: {{ App\Models\Karyawan::count() > 0 ? (App\Models\Karyawan::where('departemen', 'Produksi')->count() / App\Models\Karyawan::count()) * 100 : 0 }}%; background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>HR</span>
                            <span>{{ App\Models\Karyawan::count() > 0 ? (App\Models\Karyawan::where('departemen', 'HR')->count() / App\Models\Karyawan::count()) * 100 : 0 }}%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-purple" style="width: {{ App\Models\Karyawan::count() > 0 ? (App\Models\Karyawan::where('departemen', 'HR')->count() / App\Models\Karyawan::count()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Employees -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>Karyawan Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $recentEmployees = App\Models\Karyawan::latest()->take(5)->get();
                    @endphp
                    
                    @if($recentEmployees->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Departemen</th>
                                        <th>Shift</th>
                                        <th>Tanggal Ditambahkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentEmployees as $employee)
                                    <tr>
                                        <td><span class="badge bg-primary">{{ $employee->nik }}</span></td>
                                        <td>{{ $employee->nama }}</td>
                                        <td>
                                            @php
                                                $deptClass = '';
                                                switch(strtolower($employee->departemen ?? '')) {
                                                    case 'operational': $deptClass = 'bg-operational'; break;
                                                    case 'produksi': $deptClass = 'bg-produksi'; break;
                                                    case 'hr': $deptClass = 'bg-hr'; break;
                                                    case 'warehouse': $deptClass = 'bg-warehouse'; break;
                                                    case 'ga': $deptClass = 'bg-ga'; break;
                                                    default: $deptClass = 'bg-secondary'; break;
                                                }
                                            @endphp
                                            <span class="badge {{ $deptClass }}">{{ $employee->departemen ?? 'Tidak ada' }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $shiftClass = '';
                                                switch(strtolower($employee->shift ?? '')) {
                                                    case 'shift 1': $shiftClass = 'bg-shift1'; break;
                                                    case 'shift 2': $shiftClass = 'bg-shift2'; break;
                                                    case 'shift 3': $shiftClass = 'bg-shift3'; break;
                                                    case 'non-shift': $shiftClass = 'bg-nonshift'; break;
                                                    default: $shiftClass = 'bg-secondary'; break;
                                                }
                                            @endphp
                                            <span class="badge {{ $shiftClass }}">{{ $employee->shift ?? 'Tidak ada' }}</span>
                                        </td>
                                        <td>{{ $employee->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-people display-1 text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada data karyawan</h5>
                            <p class="text-muted">Mulai dengan menambahkan karyawan pertama Anda!</p>
                            <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle-fill me-2"></i>Tambah Karyawan Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-star-fill me-2"></i>Fitur Unggulan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="text-center">
                                <i class="bi bi-search display-4 text-primary mb-3"></i>
                                <h5>Pencarian & Filter</h5>
                                <p class="text-muted">Cari dan filter karyawan berdasarkan departemen, shift, atau nama dengan mudah.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="text-center">
                                <i class="bi bi-download display-4 text-success mb-3"></i>
                                <h5>Export Data</h5>
                                <p class="text-muted">Export data karyawan ke format CSV untuk keperluan laporan dan backup.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="text-center">
                                <i class="bi bi-shield-check display-4 text-warning mb-3"></i>
                                <h5>Keamanan Data</h5>
                                <p class="text-muted">Data karyawan tersimpan dengan aman dengan validasi dan konfirmasi aksi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.progress-bar.bg-purple {
    background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 100%) !important;
}
</style>
@endsection

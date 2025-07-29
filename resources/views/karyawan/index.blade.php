@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-fill me-1"></i>Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="bi bi-people-fill me-1"></i>Data Karyawan</li>
@endsection

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Daftar Karyawan</h2>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill display-4 mb-2 text-purple"></i>
                    <h3 class="mb-1 text-dark">{{ $karyawan->count() }}</h3>
                    <p class="mb-0 text-muted">Total Karyawan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body text-center">
                    <i class="bi bi-building-fill display-4 mb-2 text-purple"></i>
                    <h3 class="mb-1 text-dark">{{ $karyawan->where('departemen', 'Operational')->count() }}</h3>
                    <p class="mb-0 text-muted">Operational</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body text-center">
                    <i class="bi bi-gear-fill display-4 mb-2 text-purple"></i>
                    <h3 class="mb-1 text-dark">{{ $karyawan->where('departemen', 'Produksi')->count() }}</h3>
                    <p class="mb-0 text-muted">Produksi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card stat-card-purple">
                <div class="card-body text-center">
                    <i class="bi bi-clock-fill display-4 mb-2 text-purple"></i>
                    <h3 class="mb-1 text-dark">{{ $karyawan->where('shift', 'Shift 1')->count() }}</h3>
                    <p class="mb-0 text-muted">Shift 1</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="searchInput" class="form-label">
                        <i class="bi bi-search me-1"></i>Cari Karyawan
                    </label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan NIK, nama, atau departemen...">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="filterDepartemen" class="form-label">
                        <i class="bi bi-funnel me-1"></i>Filter Departemen
                    </label>
                    <select id="filterDepartemen" class="form-select">
                        <option value="">Semua Departemen</option>
                        <option value="Operational">Operational</option>
                        <option value="Produksi">Produksi</option>
                        <option value="HR">HR</option>
                        <option value="Warehouse">Warehouse</option>
                        <option value="GA">GA</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="filterShift" class="form-label">
                        <i class="bi bi-clock me-1"></i>Filter Shift
                    </label>
                    <select id="filterShift" class="form-select">
                        <option value="">Semua Shift</option>
                        <option value="Shift 1">Shift 1</option>
                        <option value="Shift 2">Shift 2</option>
                        <option value="Shift 3">Shift 3</option>
                        <option value="Non-Shift">Non-Shift</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button id="clearFilters" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-clockwise me-1"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('karyawan.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle-fill me-2"></i>Tambah Karyawan Baru
        </a>
        <div class="d-flex align-items-center">
            <span class="text-muted me-3">
                <i class="bi bi-eye-fill me-1"></i>
                Menampilkan <span id="visibleCount">{{ $karyawan->count() }}</span> dari {{ $karyawan->count() }} karyawan
            </span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="exportToCSV()">
                    <i class="bi bi-download me-1"></i>Export CSV
                </button>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="printTable()">
                    <i class="bi bi-printer me-1"></i>Print
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($karyawan->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-people display-1 text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada data karyawan</h4>
                    <p class="text-muted">Silakan tambahkan karyawan pertama Anda!</p>
                    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill me-2"></i>Tambah Karyawan Pertama
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover" id="karyawanTable">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center" style="width: 80px;">
                                    <i class="bi bi-hash"></i> No
                                </th>
                                <th scope="col" class="sortable" data-sort="nik">
                                    <i class="bi bi-card-text me-1"></i>NIK
                                    <i class="bi bi-arrow-down-up ms-1"></i>
                                </th>
                                <th scope="col" class="sortable" data-sort="nama">
                                    <i class="bi bi-person me-1"></i>NAMA
                                    <i class="bi bi-arrow-down-up ms-1"></i>
                                </th>
                                <th scope="col" class="sortable" data-sort="departemen">
                                    <i class="bi bi-building me-1"></i>DEPARTEMEN
                                    <i class="bi bi-arrow-down-up ms-1"></i>
                                </th>
                                <th scope="col" class="sortable" data-sort="shift">
                                    <i class="bi bi-clock me-1"></i>SHIFT
                                    <i class="bi bi-arrow-down-up ms-1"></i>
                                </th>
                                <th scope="col" class="text-center" style="width: 200px;">
                                    <i class="bi bi-gear me-1"></i>AKSI
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karyawan as $index => $data)
                            <tr class="karyawan-row" 
                                data-nik="{{ $data->nik }}" 
                                data-nama="{{ $data->nama }}" 
                                data-departemen="{{ $data->departemen }}" 
                                data-shift="{{ $data->shift }}">
                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $data->nik }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-circle text-primary me-2" style="font-size: 1.2rem;"></i>
                                        <div>
                                            <div class="fw-semibold">{{ $data->nama }}</div>
                                            <small class="text-muted">ID: {{ $data->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $deptClass = '';
                                        switch(strtolower($data->departemen ?? '')) {
                                            case 'operational': $deptClass = 'bg-operational'; break;
                                            case 'produksi': $deptClass = 'bg-produksi'; break;
                                            case 'hr': $deptClass = 'bg-hr'; break;
                                            case 'warehouse': $deptClass = 'bg-warehouse'; break;
                                            case 'ga': $deptClass = 'bg-ga'; break;
                                            default: $deptClass = 'bg-secondary'; break;
                                        }
                                    @endphp
                                    <span class="badge {{ $deptClass }}">{{ $data->departemen ?? 'Tidak ada' }}</span>
                                </td>
                                <td>
                                    @php
                                        $shiftClass = '';
                                        switch(strtolower($data->shift ?? '')) {
                                            case 'shift 1': $shiftClass = 'bg-shift1'; break;
                                            case 'shift 2': $shiftClass = 'bg-shift2'; break;
                                            case 'shift 3': $shiftClass = 'bg-shift3'; break;
                                            case 'non-shift': $shiftClass = 'bg-nonshift'; break;
                                            default: $shiftClass = 'bg-secondary'; break;
                                        }
                                    @endphp
                                    <span class="badge {{ $shiftClass }}">{{ $data->shift ?? 'Tidak ada' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('karyawan.edit', $data->id) }}" 
                                           class="btn btn-sm btn-edit" 
                                           title="Edit Karyawan"
                                           onclick="showLoading()">
                                            <i class="bi bi-pencil-fill me-1"></i>Edit
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-delete" 
                                                title="Hapus Karyawan"
                                                onclick="confirmDelete({{ $data->id }}, '{{ $data->nama }}')">
                                            <i class="bi bi-trash-fill me-1"></i>Hapus
                                        </button>
                                    </div>
                                    
                                    <!-- Hidden form for delete -->
                                    <form id="delete-form-{{ $data->id }}" 
                                          action="{{ route('karyawan.destroy', $data->id) }}" 
                                          method="POST" 
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        html: `Apakah Anda yakin ingin menghapus karyawan <strong>${nama}</strong>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<i class="bi bi-trash-fill me-1"></i>Ya, Hapus!',
        cancelButtonText: '<i class="bi bi-x-circle me-1"></i>Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading();
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
}

// Search and Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterDepartemen = document.getElementById('filterDepartemen');
    const filterShift = document.getElementById('filterShift');
    const clearFilters = document.getElementById('clearFilters');
    const karyawanRows = document.querySelectorAll('.karyawan-row');
    const visibleCount = document.getElementById('visibleCount');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedDepartemen = filterDepartemen.value.toLowerCase();
        const selectedShift = filterShift.value.toLowerCase();
        let visibleCount = 0;

        karyawanRows.forEach(row => {
            const nik = row.getAttribute('data-nik').toLowerCase();
            const nama = row.getAttribute('data-nama').toLowerCase();
            const departemen = row.getAttribute('data-departemen').toLowerCase();
            const shift = row.getAttribute('data-shift').toLowerCase();

            const matchesSearch = nik.includes(searchTerm) || 
                                nama.includes(searchTerm) || 
                                departemen.includes(searchTerm);
            const matchesDepartemen = !selectedDepartemen || departemen === selectedDepartemen;
            const matchesShift = !selectedShift || shift === selectedShift;

            if (matchesSearch && matchesDepartemen && matchesShift) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('visibleCount').textContent = visibleCount;
    }

    searchInput.addEventListener('input', filterTable);
    filterDepartemen.addEventListener('change', filterTable);
    filterShift.addEventListener('change', filterTable);

    clearFilters.addEventListener('click', function() {
        searchInput.value = '';
        filterDepartemen.value = '';
        filterShift.value = '';
        filterTable();
    });

    // Add row hover effect
    karyawanRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});

// Export to CSV function
function exportToCSV() {
    const table = document.getElementById('karyawanTable');
    const rows = table.querySelectorAll('tbody tr:not([style*="display: none"])');
    
    let csv = 'NIK,Nama,Departemen,Shift\n';
    
    rows.forEach(row => {
        const nik = row.getAttribute('data-nik');
        const nama = row.getAttribute('data-nama');
        const departemen = row.getAttribute('data-departemen') || 'Tidak ada';
        const shift = row.getAttribute('data-shift') || 'Tidak ada';
        
        csv += `"${nik}","${nama}","${departemen}","${shift}"\n`;
    });
    
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', 'data_karyawan.csv');
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Print function
function printTable() {
    const printWindow = window.open('', '_blank');
    const table = document.getElementById('karyawanTable');
    const visibleRows = table.querySelectorAll('tbody tr:not([style*="display: none"])');
    
    let printContent = `
        <html>
        <head>
            <title>Data Karyawan</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .badge { padding: 4px 8px; border-radius: 4px; color: white; font-size: 12px; }
                .bg-primary { background-color: #007bff; }
                .bg-operational { background-color: #28a745; }
                .bg-produksi { background-color: #007bff; }
                .bg-hr { background-color: #6f42c1; }
                .bg-warehouse { background-color: #fd7e14; }
                .bg-ga { background-color: #6c757d; }
                .bg-shift1 { background-color: #28a745; }
                .bg-shift2 { background-color: #ffc107; color: #212529; }
                .bg-shift3 { background-color: #dc3545; }
                .bg-nonshift { background-color: #6c757d; }
            </style>
        </head>
        <body>
            <h1>Data Karyawan</h1>
            <p>Tanggal: ${new Date().toLocaleDateString('id-ID')}</p>
            <p>Total: ${visibleRows.length} karyawan</p>
    `;
    
    printContent += table.outerHTML;
    printContent += '</body></html>';
    
    printWindow.document.write(printContent);
    printWindow.document.close();
    printWindow.print();
}

// Sorting functionality
let currentSort = { column: null, direction: 'asc' };

function sortTable(column) {
    const tbody = document.querySelector('#karyawanTable tbody');
    const rows = Array.from(tbody.querySelectorAll('tr:not([style*="display: none"])'));
    
    // Update sort direction
    if (currentSort.column === column) {
        currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
    } else {
        currentSort.column = column;
        currentSort.direction = 'asc';
    }
    
    // Sort rows
    rows.sort((a, b) => {
        let aValue, bValue;
        
        switch(column) {
            case 'nik':
                aValue = a.getAttribute('data-nik');
                bValue = b.getAttribute('data-nik');
                break;
            case 'nama':
                aValue = a.getAttribute('data-nama');
                bValue = b.getAttribute('data-nama');
                break;
            case 'departemen':
                aValue = a.getAttribute('data-departemen') || '';
                bValue = b.getAttribute('data-departemen') || '';
                break;
            case 'shift':
                aValue = a.getAttribute('data-shift') || '';
                bValue = b.getAttribute('data-shift') || '';
                break;
            default:
                return 0;
        }
        
        if (currentSort.direction === 'asc') {
            return aValue.localeCompare(bValue);
        } else {
            return bValue.localeCompare(aValue);
        }
    });
    
    // Update sort indicators
    document.querySelectorAll('.sortable i.bi-arrow-down-up').forEach(icon => {
        icon.className = 'bi bi-arrow-down-up ms-1';
    });
    
    const currentColumn = document.querySelector(`[data-sort="${column}"]`);
    if (currentColumn) {
        const icon = currentColumn.querySelector('i:last-child');
        if (currentSort.direction === 'asc') {
            icon.className = 'bi bi-arrow-up ms-1';
        } else {
            icon.className = 'bi bi-arrow-down ms-1';
        }
    }
    
    // Reorder rows
    rows.forEach(row => tbody.appendChild(row));
    
    // Update row numbers
    updateRowNumbers();
}

function updateRowNumbers() {
    const visibleRows = document.querySelectorAll('#karyawanTable tbody tr:not([style*="display: none"])');
    visibleRows.forEach((row, index) => {
        const numberCell = row.querySelector('td:first-child');
        if (numberCell) {
            numberCell.textContent = index + 1;
        }
    });
}

// Add click event listeners for sorting
document.addEventListener('DOMContentLoaded', function() {
    // Ensure loading overlay is hidden when page loads
    if (typeof hideLoading === 'function') {
        hideLoading();
    }
    
    document.querySelectorAll('.sortable').forEach(header => {
        header.addEventListener('click', function() {
            const column = this.getAttribute('data-sort');
            sortTable(column);
        });
    });
    
    // Add hover effect for sortable headers
    document.querySelectorAll('.sortable').forEach(header => {
        header.style.cursor = 'pointer';
        header.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
        });
        header.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
});
</script>
@endsection
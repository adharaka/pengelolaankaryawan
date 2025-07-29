<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Aplikasi Karyawan')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('image/logo_perusahaan.jpg') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Additional Meta Tags -->
    <meta name="description" content="Sistem Manajemen Karyawan - Kelola data karyawan dengan mudah dan efisien">
    <meta name="author" content="Adha Raka Firmansyah">
    
    @stack('styles')
</head>
<body>
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="loading-content">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-white">Memproses data...</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-primary mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('image/logo_perusahaan.jpg') }}" alt="Logo Perusahaan" class="me-2" style="height: 40px; width: auto; border-radius: 8px;">
                <span class="brand-text">Manajemen Karyawan</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="bi bi-house-fill me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('karyawan.*') ? 'active' : '' }}" href="{{ route('karyawan.index') }}">
                            <i class="bi bi-people-fill me-1"></i>Data Karyawan
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear-fill me-1"></i>Pengaturan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="showAbout()">
                                <i class="bi bi-info-circle me-2"></i>Tentang Aplikasi
                            </a></li>
                            <li><a class="dropdown-item" href="#" onclick="showHelp()">
                                <i class="bi bi-question-circle me-2"></i>Bantuan
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="showSystemInfo()">
                                <i class="bi bi-cpu me-2"></i>Info Sistem
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    @hasSection('breadcrumb')
    <div class="container mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @yield('breadcrumb')
            </ol>
        </nav>
    </div>
    @endif

    <!-- Main Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container text-center py-4">
            <div class="row">
                <div class="col-md-4">
                    <h6 class="text-white mb-2">Sistem Manajemen Karyawan</h6>
                    <p class="text-white-50 small mb-0">Kelola data karyawan dengan mudah dan efisien</p>
                </div>
                <div class="col-md-4">
                    <p class="mb-0">
                        Made with <i class="bi bi-heart-fill text-danger"></i> by Adha Raka Firmansyah
                    </p>
                    <small class="text-white-50">© {{ date('Y') }} All rights reserved</small>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="text-white-50" onclick="showAbout()" title="Tentang Aplikasi">
                            <i class="bi bi-info-circle"></i>
                        </a>
                        <a href="#" class="text-white-50" onclick="showHelp()" title="Bantuan">
                            <i class="bi bi-question-circle"></i>
                        </a>
                        <a href="#" class="text-white-50" onclick="showSystemInfo()" title="Info Sistem">
                            <i class="bi bi-cpu"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        // Loading overlay functions
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Form submission with loading
        document.addEventListener('DOMContentLoaded', function() {
            // Hide loading overlay immediately when page loads
            hideLoading();
            
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    showLoading();
                });
            });
            
            // Add active class to current nav item
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });

        // Handle page visibility changes (for back/forward navigation)
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                hideLoading();
            }
        });

        // Handle beforeunload event
        window.addEventListener('beforeunload', function() {
            hideLoading();
        });

        // Success message handler
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        // Error message handler
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        // About modal
        function showAbout() {
            Swal.fire({
                title: 'Tentang Aplikasi',
                html: `
                    <div class="text-start">
                        <h6>Sistem Manajemen Karyawan</h6>
                        <p class="mb-3">Aplikasi web untuk mengelola data karyawan dengan fitur lengkap dan interface yang user-friendly.</p>
                        
                        <h6>Fitur Utama:</h6>
                        <ul class="text-start">
                            <li>Manajemen data karyawan (CRUD)</li>
                            <li>Pencarian dan filter data</li>
                            <li>Export data ke CSV</li>
                            <li>Print data karyawan</li>
                            <li>Dashboard dengan statistik</li>
                            <li>Interface responsif</li>
                        </ul>
                        
                        <h6>Teknologi:</h6>
                        <ul class="text-start">
                            <li>Laravel 10</li>
                            <li>Bootstrap 5.3.3</li>
                            <li>Bootstrap Icons</li>
                            <li>SweetAlert2</li>
                            <li>MySQL</li>
                        </ul>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#007bff'
            });
        }

        // Help modal
        function showHelp() {
            Swal.fire({
                title: 'Bantuan Penggunaan',
                html: `
                    <div class="text-start">
                        <h6>Cara Menggunakan Aplikasi:</h6>
                        
                        <h6>1. Dashboard</h6>
                        <p>Halaman utama yang menampilkan statistik dan ringkasan data karyawan.</p>
                        
                        <h6>2. Data Karyawan</h6>
                        <p>Halaman untuk melihat, menambah, mengedit, dan menghapus data karyawan.</p>
                        
                        <h6>3. Fitur Pencarian</h6>
                        <p>Gunakan kotak pencarian untuk mencari karyawan berdasarkan nama atau NIK.</p>
                        
                        <h6>4. Filter Data</h6>
                        <p>Filter data berdasarkan departemen atau shift untuk melihat data yang lebih spesifik.</p>
                        
                        <h6>5. Export & Print</h6>
                        <p>Export data ke CSV atau print data karyawan untuk keperluan laporan.</p>
                        
                        <h6>6. Sorting</h6>
                        <p>Klik pada header kolom untuk mengurutkan data (ascending/descending).</p>
                    </div>
                `,
                icon: 'question',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#28a745'
            });
        }

        // System info modal
        function showSystemInfo() {
            Swal.fire({
                title: 'Informasi Sistem',
                html: `
                    <div class="text-start">
                        <table class="table table-sm">
                            <tr>
                                <td><strong>Versi Aplikasi:</strong></td>
                                <td>1.0.0</td>
                            </tr>
                            <tr>
                                <td><strong>Framework:</strong></td>
                                <td>Laravel 10</td>
                            </tr>
                            <tr>
                                <td><strong>Database:</strong></td>
                                <td>MySQL</td>
                            </tr>
                            <tr>
                                <td><strong>UI Framework:</strong></td>
                                <td>Bootstrap 5.3.3</td>
                            </tr>
                            <tr>
                                <td><strong>Icons:</strong></td>
                                <td>Bootstrap Icons 1.11.1</td>
                            </tr>
                            <tr>
                                <td><strong>Modal Library:</strong></td>
                                <td>SweetAlert2</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Update:</strong></td>
                                <td>{{ date('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#6c757d'
            });
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K untuk focus ke search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('input[type="search"], input[placeholder*="cari"], input[placeholder*="search"]');
                if (searchInput) {
                    searchInput.focus();
                }
            }
            
            // Ctrl/Cmd + N untuk tambah karyawan baru
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                const addButton = document.querySelector('a[href*="create"], .btn-success');
                if (addButton) {
                    addButton.click();
                }
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
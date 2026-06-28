<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Admin') | Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #FFD700;
            --secondary-color: #1a1a2e;
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--secondary-color);
            color: #fff;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand h4 {
            font-weight: 800;
            margin: 0;
        }

        .sidebar-brand span {
            color: var(--primary-color);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-header {
            padding: 10px 25px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
        }

        .menu-item {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover,
        .menu-item.active {
            background: rgba(255,215,0,0.1);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .menu-item i {
            font-size: 1.2rem;
            margin-right: 12px;
            width: 25px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Top Navbar */
        .top-navbar {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--secondary-color);
            cursor: pointer;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--secondary-color);
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .stat-icon.primary { background: rgba(255,215,0,0.2); color: #b8860b; }
        .stat-icon.success { background: rgba(40,167,69,0.2); color: #28a745; }
        .stat-icon.info { background: rgba(23,162,184,0.2); color: #17a2b8; }
        .stat-icon.warning { background: rgba(255,193,7,0.2); color: #ffc107; }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Table Card */
        .table-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .table-card-header {
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-card-body {
            padding: 0;
        }

        .table-card-footer {
            padding: 15px 25px;
            border-top: 1px solid #eee;
        }

        /* Buttons */
        .btn-admin-primary {
            background: var(--primary-color);
            color: var(--secondary-color);
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-admin-primary:hover {
            background: #e6c200;
            color: var(--secondary-color);
        }

        .btn-admin-danger {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        /* Dark Mode */
        [data-bs-theme="dark"] {
            --bs-body-bg: #0f0f23;
            --bs-body-color: #e0e0e0;
        }

        [data-bs-theme="dark"] .main-content {
            background: #0f0f23;
        }

        [data-bs-theme="dark"] .top-navbar,
        [data-bs-theme="dark"] .stat-card,
        [data-bs-theme="dark"] .table-card {
            background: #1a1a3e;
            color: #e0e0e0;
        }

        [data-bs-theme="dark"] .table {
            --bs-table-bg: transparent;
            --bs-table-color: #e0e0e0;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4>Web<span>Dev</span>Pro</h4>
            <small class="text-white-50">Admin Panel</small>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-header">Menu Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            
            <div class="menu-header">Manajemen</div>
            <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Users
            </a>
            <a href="{{ route('admin.pakets.index') }}" class="menu-item {{ request()->routeIs('admin.pakets.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Paket
            </a>
            <a href="{{ route('admin.portofolios.index') }}" class="menu-item {{ request()->routeIs('admin.portofolios.*') ? 'active' : '' }}">
                <i class="bi bi-grid-3x3-gap"></i> Portofolio
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="menu-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Blog
            </a>
            <a href="{{ route('admin.testimonis.index') }}" class="menu-item {{ request()->routeIs('admin.testimonis.*') ? 'active' : '' }}">
                <i class="bi bi-star"></i> Testimoni
            </a>
            <a href="{{ route('admin.faqs.index') }}" class="menu-item {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                <i class="bi bi-question-circle"></i> FAQ
            </a>
            <a href="{{ route('admin.pesanans.index') }}" class="menu-item {{ request()->routeIs('admin.pesanans.*') ? 'active' : '' }}">
                <i class="bi bi-cart-check"></i> Pesanan
            </a>
            
            <div class="menu-header">Pengaturan</div>
            <a href="{{ route('admin.settings.index') }}" class="menu-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Pengaturan Website
            </a>
            
            <div class="mt-4 pt-4 border-top border-secondary">
                <a href="{{ route('home') }}" class="menu-item" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Website
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="menu-item border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <button class="sidebar-toggle d-lg-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-outline-secondary rounded-circle" onclick="toggleDarkMode()" style="width: 40px; height: 40px;">
                    <i class="bi bi-moon-fill" id="darkModeIcon"></i>
                </button>
                
                <div class="dropdown">
                    <div class="user-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="d-none d-md-block">
                            <div class="fw-bold small">{{ auth()->user()->name }}</div>
                            <div class="text-muted smaller">Administrator</div>
                        </div>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-left me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="content-area">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        function toggleDarkMode() {
            const html = document.documentElement;
            const icon = document.getElementById('darkModeIcon');
            
            if (html.getAttribute('data-bs-theme') === 'dark') {
                html.setAttribute('data-bs-theme', 'light');
                icon.classList.replace('bi-sun-fill', 'bi-moon-fill');
                localStorage.setItem('adminDarkMode', 'false');
            } else {
                html.setAttribute('data-bs-theme', 'dark');
                icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
                localStorage.setItem('adminDarkMode', 'true');
            }
        }

        // Check saved preference
        if (localStorage.getItem('adminDarkMode') === 'true') {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            document.getElementById('darkModeIcon').classList.replace('bi-moon-fill', 'bi-sun-fill');
        }

        // Initialize DataTables
        $(document).ready(function() {
            $('.datatable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                }
            });
        });

        // Delete confirmation
        function confirmDelete(formId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
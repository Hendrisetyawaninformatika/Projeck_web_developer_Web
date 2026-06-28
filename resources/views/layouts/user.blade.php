<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | {{ config('app.name') }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #FFD700;
            --secondary-color: #1a1a2e;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
        }

        .user-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #fff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            z-index: 1000;
            padding: 20px 0;
        }

        .user-sidebar-brand {
            text-align: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .user-sidebar-brand h5 {
            font-weight: 800;
            color: var(--secondary-color);
            margin: 0;
        }

        .user-sidebar-brand span {
            color: var(--primary-color);
        }

        .user-menu-item {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            color: #666;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .user-menu-item:hover,
        .user-menu-item.active {
            background: rgba(255,215,0,0.1);
            color: var(--secondary-color);
            border-left-color: var(--primary-color);
        }

        .user-menu-item i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .user-main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .user-navbar {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-content {
            padding: 30px;
        }

        @media (max-width: 991px) {
            .user-sidebar {
                transform: translateX(-100%);
            }
            .user-main {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="user-sidebar">
        <div class="user-sidebar-brand">
            <h5>Web<span>Dev</span>Pro</h5>
        </div>
        
        <div class="user-menu">
            <a href="{{ route('user.dashboard') }}" class="user-menu-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('user.profile') }}" class="user-menu-item {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <i class="bi bi-person"></i> Profil Saya
            </a>
            <a href="{{ route('user.pesanans.index') }}" class="user-menu-item {{ request()->routeIs('user.pesanans.*') ? 'active' : '' }}">
                <i class="bi bi-cart-check"></i> Pesanan Saya
            </a>
            
            <div class="mt-4 pt-4 border-top">
                <a href="{{ route('home') }}" class="user-menu-item">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Website
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="user-menu-item border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main -->
    <div class="user-main">
        <nav class="user-navbar">
            <h5 class="fw-bold mb-0">@yield('title')</h5>
            <div class="d-flex align-items-center gap-3">
                <a href="https://wa.me/6281234567890?text=Halo%20Admin" target="_blank" class="btn btn-sm btn-success">
                    <i class="bi bi-whatsapp me-1"></i> Chat Admin
                </a>
                <div class="dropdown">
                    <div class="d-flex align-items-center gap-2 dropdown-toggle" data-bs-toggle="dropdown" style="cursor: pointer;">
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 35px; height: 35px; font-weight: 700; color: var(--secondary-color);">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="fw-semibold small">{{ auth()->user()->name }}</span>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-left me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="user-content">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
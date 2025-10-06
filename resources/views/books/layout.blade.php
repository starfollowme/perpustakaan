<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan Digital')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --light-bg: #ecf0f1;
            --dark-text: #2c3e50;
            --light-text: #ffffff;
            --card-shadow: 0 4px 8px rgba(0,0,0,0.1);
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --transition-speed: 0.3s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: var(--light-text);
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.3);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 1.75rem 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            font-weight: 600;
            font-size: 1.3rem;
            color: var(--light-text);
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            transition: all var(--transition-speed);
        }

        .sidebar-brand:hover {
            color: var(--secondary-color);
        }

        .sidebar-brand i {
            font-size: 1.6rem;
            margin-right: 0.875rem;
            flex-shrink: 0;
        }

        .sidebar.collapsed .sidebar-brand span {
            display: none;
        }

        .toggle-btn {
            background: rgba(255,255,255,0.1);
            border: none;
            color: var(--light-text);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-btn:hover {
            background-color: rgba(255,255,255,0.2);
            transform: scale(1.1);
        }

        .sidebar.collapsed .toggle-btn {
            transform: rotate(180deg);
        }

        .sidebar.collapsed .toggle-btn:hover {
            transform: rotate(180deg) scale(1.1);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 1rem 0;
        }

        .sidebar-menu li {
            margin-bottom: 0.25rem;
            padding: 0 0.75rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.875rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap;
            overflow: hidden;
            border-radius: 8px;
            position: relative;
        }

        .sidebar-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: var(--secondary-color);
            transition: width 0.3s ease;
            border-radius: 8px 0 0 8px;
        }

        .sidebar-menu a i {
            font-size: 1.25rem;
            margin-right: 0.875rem;
            flex-shrink: 0;
            z-index: 1;
        }

        .sidebar-menu a span {
            z-index: 1;
            font-weight: 500;
        }

        .sidebar-menu a:hover {
            background-color: rgba(255,255,255,0.1);
            color: var(--light-text);
            transform: translateX(5px);
        }

        .sidebar-menu a:hover::before {
            width: 4px;
        }

        .sidebar-menu a.active {
            background-color: rgba(52, 152, 219, 0.2);
            color: var(--light-text);
            font-weight: 600;
        }

        .sidebar-menu a.active::before {
            width: 4px;
        }

        .sidebar.collapsed .sidebar-menu a {
            justify-content: center;
            padding: 0.875rem 0.5rem;
        }

        .sidebar.collapsed .sidebar-menu a span {
            display: none;
        }

        .sidebar.collapsed .sidebar-menu a i {
            margin-right: 0;
        }

        .sidebar-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            margin: 1.5rem 1rem;
        }

        .sidebar-footer {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: auto;
            background: rgba(0,0,0,0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .user-info:hover {
            background: rgba(255,255,255,0.1);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.875rem;
            flex-shrink: 0;
            border: 2px solid rgba(255,255,255,0.2);
            font-size: 1.25rem;
        }

        .user-details {
            white-space: nowrap;
            overflow: hidden;
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--light-text);
            margin-bottom: 0.125rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.7);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar.collapsed .user-details {
            display: none;
        }

        .sidebar.collapsed .user-avatar {
            margin-right: 0;
        }

        .btn-logout {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.3);
            color: var(--light-text);
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 0.625rem 1rem;
        }

        .btn-logout:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--light-text);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }

        .sidebar.collapsed .btn-logout {
            padding: 0.625rem 0.5rem;
        }

        .sidebar.collapsed .btn-logout span {
            display: none;
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        .top-bar {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .mobile-toggle {
            display: none;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: var(--dark-text);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .mobile-toggle:hover {
            background: var(--light-bg);
        }

        .page-title {
            font-weight: 700;
            font-size: 1.75rem;
            margin: 0;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }

        .page-title i {
            margin-right: 0.75rem;
            color: var(--secondary-color);
        }

        .content-container {
            flex-grow: 1;
            padding: 2rem;
        }

        .content-card {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .content-card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.12);
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            border: none;
            font-weight: 500;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            animation: slideInDown 0.4s ease-out;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert i {
            font-size: 1.25rem;
            margin-right: 0.75rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left: 4px solid var(--accent-color);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            color: #856404;
            border-left: 4px solid var(--warning-color);
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            color: #0c5460;
            border-left: 4px solid var(--secondary-color);
        }

        /* Footer Styling */
        .footer {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: var(--light-text);
            padding: 2rem 0;
            text-align: center;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
        }

        .footer p {
            margin: 0;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .footer a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--light-text);
        }

        /* Overlay for mobile */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            z-index: 999;
            display: none;
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }

        .overlay.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.expanded {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }

            .top-bar {
                padding: 1rem 1.5rem;
            }

            .page-title {
                font-size: 1.35rem;
            }

            .content-container {
                padding: 1.5rem 1rem;
            }

            .content-card {
                padding: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.15rem;
            }

            .content-card {
                padding: 1.25rem;
                border-radius: 12px;
            }
        }
    </style>
    @yield('extra-css')
</head>
<body>

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ auth()->check() ? (auth()->user()->role === 'admin' ? route('books.index') : route('user.dashboard')) : route('login') }}" class="sidebar-brand">
                <i class="bi bi-book-half"></i>
                <span>Perpustakaan</span>
            </a>
            <button class="toggle-btn" id="sidebarToggle">
                <i class="bi bi-chevron-left"></i>
            </button>
        </div>

        <ul class="sidebar-menu">
            @auth
                @if (auth()->user()->role === 'admin')
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('books.index') }}" class="{{ Request::routeIs('books.index') || Request::routeIs('books.show') || Request::routeIs('books.edit') ? 'active' : '' }}">
                            <i class="bi bi-journal-text"></i>
                            <span>Daftar Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('books.create') }}" class="{{ Request::routeIs('books.create') ? 'active' : '' }}">
                            <i class="bi bi-plus-circle"></i>
                            <span>Tambah Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" class="{{ Request::routeIs('categories.*') ? 'active' : '' }}">
                            <i class="bi bi-tags"></i>
                            <span>Kategori Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="{{ Request::routeIs('users.*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>Kelola Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reports.index') }}" class="{{ Request::routeIs('reports.*') ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-bar-graph"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('user.dashboard') }}" class="{{ Request::routeIs('user.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-house-door"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.books') }}" class="{{ Request::routeIs('user.books') ? 'active' : '' }}">
                            <i class="bi bi-collection"></i>
                            <span>Koleksi Buku</span>
                        </a>
                    </li>
                @endif
            @endauth

            @guest
                <li>
                    <a href="{{ route('login') }}" class="{{ Request::routeIs('login') ? 'active' : '' }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="{{ Request::routeIs('register') ? 'active' : '' }}">
                        <i class="bi bi-person-plus"></i>
                        <span>Register</span>
                    </a>
                </li>
            @endguest
        </ul>

        @auth
        <div class="sidebar-divider"></div>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pengguna' }}</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-logout w-100">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="ms-1">Logout</span>
                </button>
            </form>
        </div>
        @endauth
    </aside>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="top-bar">
            <button class="mobile-toggle" id="mobileToggle">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="page-title">@yield('page-title', '')</h1>
            <div></div>
        </div>

        <div class="content-container">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ $message }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ $message }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $message }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($message = Session::get('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle-fill"></i>
                <span>{{ $message }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="content-card">
                @yield('content')
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p>&copy; {{ date('Y') }} <strong>Perpustakaan Digital</strong>. Hak Cipta Dilindungi.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileToggle = document.getElementById('mobileToggle');
            const overlay = document.getElementById('overlay');

            // Load saved sidebar state
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (sidebarCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }

            // Toggle sidebar collapse/expand
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });

            // Toggle mobile sidebar
            mobileToggle.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('active');
            });

            // Close mobile sidebar when clicking overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('active');
            });

            // Close mobile sidebar when window is resized to desktop size
            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    sidebar.classList.remove('mobile-open');
                    overlay.classList.remove('active');
                }
            });

            // Auto dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>

    @yield('extra-js')
</body>
</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - CanyoKuy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f7f9fa;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #2F6B5E 0%, #1a4a40 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 100;
        }

        .sidebar-header {
            padding: 30px 24px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            margin-bottom: 20px;
        }

        .sidebar-header .logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 12px;
        }

        .sidebar-header h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #ffdec2;
        }

        .sidebar-header p {
            font-size: 12px;
            font-weight: 500;
            opacity: 0.7;
            letter-spacing: 1px;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            padding: 0 16px;
        }

        .nav-item {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 14px;
            border-radius: 12px;
            margin-bottom: 4px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: #ffdec2;
            font-weight: 600;
        }

        .nav-item i {
            width: 24px;
            font-size: 18px;
            text-align: center;
        }

        .logout-btn {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin-bottom: 20px;
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 24px 32px;
            min-height: 100vh;
        }

        /* Card & Table Styles */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-info h3 {
            font-size: 28px;
            font-weight: bold;
            color: #2F6B5E;
        }

        .stat-info p {
            color: #666;
            font-size: 14px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: #e8f5e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #2F6B5E;
        }

        .table-container {
            background: white;
            border-radius: 20px;
            padding: 24px;
            overflow-x: auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        th {
            background: #f8fafc;
            font-weight: 600;
            color: #1e293b;
            font-size: 13px;
        }

        /* Badges */
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-pending {
            background: #cfe2ff;
            color: #084298;
        }

        /* Buttons */
        .btn-action {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-view {
            background: #2F6B5E;
            color: white;
        }

        .btn-view:hover {
            background: #1e4a40;
        }

        .btn-edit {
            background: #f59e0b;
            color: white;
        }

        .btn-edit:hover {
            background: #d97706;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-box {
            background: white;
            border-radius: 20px;
            max-width: 500px;
            width: 90%;
            padding: 24px;
            max-height: 90vh;
            overflow-y: auto;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #2F6B5E;
            box-shadow: 0 0 0 3px rgba(47, 107, 94, 0.1);
        }

        /* Guide Card */
        .guides-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 24px;
        }

        .guide-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .guide-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .guide-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 12px;
        }

        /* Banner Hijau untuk halaman booking dll */
        .green-banner-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 16px;
            padding: 28px 32px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.15);
        }

        .banner-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .banner-icon {
            background: rgba(255, 255, 255, 0.2);
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            color: white;
        }

        .page-subtitle {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
            margin: 4px 0 0 0;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .sidebar-header .logo img {
                width: 45px;
                height: 45px;
            }

            .sidebar-header h3,
            .sidebar-header p,
            .nav-item span {
                display: none;
            }

            .main-content {
                margin-left: 80px;
                padding: 16px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .green-banner-header {
                flex-direction: column;
                text-align: center;
            }

            .banner-left {
                flex-direction: column;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #2F6B5E;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <div class="admin-container">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="{{ asset('images/logo.jpg') }}" alt="CanyoKuy Logo">
                </div>
                <h3>CanyoKuy</h3>
                <p>Admin Panel</p>
            </div>

            <div class="nav-menu">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.booking') }}" class="nav-item {{ request()->routeIs('admin.booking') ? 'active' : '' }}">
                    <i class="fas fa-book"></i>
                    <span>Data Booking</span>
                </a>
                <a href="{{ route('admin.jadwal') }}" class="nav-item {{ request()->routeIs('admin.jadwal') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Kelola Jadwal</span>
                </a>
                <a href="{{ route('admin.guide') }}" class="nav-item {{ request()->routeIs('admin.guide') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Kelola Tour Guide</span>
                </a>
                <a href="{{ route('admin.testimoni') }}" class="nav-item {{ request()->routeIs('admin.testimoni') ? 'active' : '' }}">
                    <i class="fas fa-star"></i>
                    <span>Kelola Testimoni</span>
                </a>

                <div class="logout-btn">
                    <a href="{{ route('admin.logout') }}" class="nav-item" onclick="return confirm('Yakin ingin logout?')">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT - TOP BAR SUDAH DIHAPUS! -->
        <div class="main-content">
            @yield('content')
        </div>

    </div>

    @yield('scripts')
</body>

</html>
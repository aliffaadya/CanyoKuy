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

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #4da674 0%, #29604c 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 30px 24px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* --- PENYESUAIAN LOGO BULAT --- */
        .sidebar-header .logo img {
            width: 80px;
            height: 80px;
            margin-bottom: 5px;
            border-radius: 50%; /* Diubah menjadi 50% agar bulat sempurna */
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.2);
            background-color: white;
        }

        .sidebar-header p {
            font-size: 13px;
            font-weight: 500;
            opacity: 0.8;
            margin-top: 5px;
            letter-spacing: 0.5px;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding-top: 20px;
        }

        .nav-item {
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
            font-size: 15px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-left: 4px solid #ffffff;
            font-weight: 600;
        }

        .nav-item i {
            width: 24px;
            font-size: 18px;
            text-align: center;
        }

        .logout-btn {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding: 20px 0;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 30px 40px;
        }

        .table-container {
            background: white;
            border-radius: 20px;
            padding: 20px;
            overflow-x: auto;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }

        th {
            background: #f8fafc;
            font-weight: 600;
            color: #1e293b;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }

        .status-pending { background: #fff3cd; color: #856404; }
        .status-waiting { background: #cfe2ff; color: #084298; }
        .status-paid { background: #d4edda; color: #155724; }

        .btn-view { background: #29604c; color: white; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 600; }
        .btn-edit { background: #f59e0b; color: white; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 600; margin-right: 5px; }
        .btn-delete { background: #ef4444; color: white; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 600; }

        .btn-view:hover { background: #1a3c34; }
        .btn-edit:hover { background: #d97706; }
        .btn-delete:hover { background: #dc2626; }

        @media (max-width: 768px) {
            .sidebar { width: 80px; }
            .sidebar-header .logo img { width: 40px; height: 40px; border-radius: 50%; }
            .sidebar-header p, .nav-item span { display: none; }
            .main-content { margin-left: 80px; padding: 20px; }
        }
    </style>
</head>

<body>
    <div class="admin-container">
        
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="{{ asset('images/logo.jpg') }}" alt="CanyoKuy Logo">
                </div>
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
                    <a href="{{ route('admin.logout') }}" class="nav-item">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="main-content">
            @yield('content')
        </div>
        
    </div>

    @yield('scripts')
</body>

</html>
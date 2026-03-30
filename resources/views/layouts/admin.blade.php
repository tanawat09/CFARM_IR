<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CFARM Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background: #f4f6f9;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all .3s;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, .7);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all .2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, .1);
            color: #fff;
        }

        .sidebar .nav-link i {
            width: 24px;
            margin-right: 10px;
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        .card-hover {
            transition: all .3s ease;
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, .08);
        }

        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, .15);
        }

        .top-bar {
            background: #fff;
            border-bottom: 1px solid #e3e6ec;
            padding: 12px 24px;
            margin: -20px -20px 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    {{-- Sidebar --}}
    <div class="sidebar d-flex flex-column">
        <div class="p-3 text-center">
            <h5 class="text-white fw-bold mb-0"><i class="bi bi-building"></i> CFARM</h5>
            <small class="text-white-50">ระบบจัดการหลังบ้าน CFARM Investor</small>
        </div>
        <hr class="border-secondary mx-3">
        <nav class="flex-grow-1">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i
                    class="bi bi-speedometer2"></i> แดชบอร์ด</a>
            <a href="{{ route('admin.news.index') }}"
                class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}"><i
                    class="bi bi-newspaper"></i> ข่าวสาร</a>
            <a href="{{ route('admin.financial-reports.index') }}"
                class="nav-link {{ request()->routeIs('admin.financial-reports.*') ? 'active' : '' }}"><i
                    class="bi bi-bar-chart"></i> ข้อมูลทางการเงิน</a>
            <a href="{{ route('admin.documents.index') }}"
                class="nav-link {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}"><i
                    class="bi bi-file-earmark-text"></i> เอกสารเผยแพร่</a>
            <a href="{{ route('admin.events.index') }}"
                class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}"><i
                    class="bi bi-calendar-event"></i> กิจกรรมนักลงทุน</a>
            <a href="{{ route('admin.shareholders.index') }}"
                class="nav-link {{ request()->routeIs('admin.shareholders.*') ? 'active' : '' }}"><i
                    class="bi bi-pie-chart-fill"></i> ข้อมูลผู้ถือหุ้น</a>
            <a href="{{ route('admin.board.index') }}"
                class="nav-link {{ request()->routeIs('admin.board.*') ? 'active' : '' }}"><i class="bi bi-people"></i>
                คณะกรรมการ</a>
            <a href="{{ route('admin.contacts.index') }}"
                class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}"><i
                    class="bi bi-envelope"></i> ข้อความติดต่อ</a>
            <hr class="border-secondary mx-3">
            <a href="{{ route('admin.revenue-structures.index') }}"
                class="nav-link {{ request()->routeIs('admin.revenue-structures.*') ? 'active' : '' }}"><i
                    class="bi bi-pie-chart"></i> โครงสร้างรายได้</a>
            <a href="{{ route('admin.settings.financial_highlights') }}"
                class="nav-link {{ request()->routeIs('admin.settings.financial_highlights') ? 'active' : '' }}"><i
                    class="bi bi-bar-chart-line"></i> ข้อมูลการเงิน (หน้าแรก)</a>
            <a href="{{ route('admin.settings.company_profile') }}"
                class="nav-link {{ request()->routeIs('admin.settings.company_profile') ? 'active' : '' }}"><i
                    class="bi bi-building-gear"></i> ข้อมูลบริษัท</a>
            <hr class="border-secondary mx-3">
            <a href="{{ route('admin.users.index') }}"
                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i
                    class="bi bi-person-gear"></i> จัดการผู้ใช้</a>
            <a href="{{ route('admin.audit-logs.index') }}"
                class="nav-link {{ request()->routeIs('admin.audit-logs.*') ? 'active' : '' }}"><i
                    class="bi bi-shield-check"></i> ประวัติระบบ</a>
            <a href="{{ route('home') }}" class="nav-link" target="_blank"><i class="bi bi-box-arrow-up-right"></i>
                ดูเว็บไซต์</a>
        </nav>
        <div class="p-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm w-100"><i class="bi bi-box-arrow-right"></i>
                    ออกจากระบบ</button>
            </form>
        </div>
    </div>

    {{-- Main content --}}
    <div class="main-content">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <h6 class="mb-0">สวัสดี, {{ auth()->user()->name ?? 'Admin' }}</h6>
            <small class="text-muted">{{ now()->format('d M Y H:i') }}</small>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CFARM - นักลงทุนสัมพันธ์ | บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน)')</title>
    <meta name="description" content="@yield('meta_description', 'บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) - นักลงทุนสัมพันธ์ | CHUWIT FARM (2019) PUBLIC COMPANY LIMITED')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --cfarm-green: #2e7d32;
            --cfarm-green-light: #43a047;
            --cfarm-green-dark: #1b5e20;
            --cfarm-green-glow: rgba(46,125,50,0.3);
            --cfarm-red: #e53935;
            --cfarm-orange: #ff9800;
            --cfarm-text: #2d3436;
            --cfarm-text-light: #636e72;
            --cfarm-bg-light: #f5f7fa;
            --cfarm-bg-white: #ffffff;
            --cfarm-shadow: 0 8px 32px rgba(0,0,0,0.08);
            --cfarm-shadow-hover: 0 16px 48px rgba(0,0,0,0.15);
        }

        /* ── Animations ── */
        @keyframes fadeInUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        @keyframes slideDown { from { opacity:0; transform:translateY(-20px); } to { opacity:1; transform:translateY(0); } }
        @keyframes float { 0%,100% { transform:translateY(0); } 50% { transform:translateY(-8px); } }
        @keyframes pulse { 0%,100% { opacity:1; } 50% { opacity:.6; } }
        @keyframes shimmer { 0% { background-position:-200% 0; } 100% { background-position:200% 0; } }
        @keyframes gradientShift { 0% { background-position:0% 50%; } 50% { background-position:100% 50%; } 100% { background-position:0% 50%; } }
        @keyframes growWidth { from { width:0; } to { width:60px; } }

        .animate-on-scroll { opacity:0; transform:translateY(30px); transition: opacity .8s ease, transform .8s ease; }
        .animate-on-scroll.visible { opacity:1; transform:translateY(0); }

        /* Premium UI Utilities */
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px 0 rgba(46, 125, 50, 0.05);
        }
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .delay-1 { transition-delay: 0.2s; }
        .delay-2 { transition-delay: 0.4s; }
        .delay-3 { transition-delay: 0.6s; }
        
        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px -10px rgba(46, 125, 50, 0.2) !important;
        }

        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; }
        body { font-family:'Kanit',sans-serif; color:var(--cfarm-text); font-weight:300; line-height:1.8; overflow-x:hidden; }

        /* ── Stock Ticker Bar ── */
        .stock-ticker {
            background: linear-gradient(90deg, #1b5e20, #2e7d32, #388e3c);
            background-size: 200% 100%;
            animation: gradientShift 8s ease infinite;
            padding: 10px 0;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.9);
        }
        .stock-ticker .stock-price { font-weight:500; color:#fff; }
        .stock-ticker .stock-change.up { color:#a5d6a7; }
        .stock-ticker .stock-change.down { color:#ef9a9a; }

        /* ── Main Navbar ── */
        .navbar-cfarm {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding: 10px 0;
            transition: all .4s cubic-bezier(.4,0,.2,1);
        }
        .navbar-cfarm.scrolled {
            background: rgba(255,255,255,0.95);
            box-shadow: 0 4px 30px rgba(0,0,0,0.08);
            padding: 6px 0;
        }
        .navbar-cfarm .navbar-brand { font-weight:600; color:var(--cfarm-green) !important; font-size:1.5rem; letter-spacing:1px; }
        .navbar-cfarm .navbar-brand span { color:var(--cfarm-red); }
        .navbar-cfarm .nav-link {
            color:var(--cfarm-text) !important;
            font-weight:400;
            font-size:0.88rem;
            padding:8px 12px !important;
            transition:all .3s;
            position:relative;
        }
        .navbar-cfarm .nav-link::after {
            content:''; position:absolute; bottom:2px; left:12px; right:12px; height:2px;
            background:var(--cfarm-green); transform:scaleX(0); transition:transform .3s;
        }
        .navbar-cfarm .nav-link:hover { color:var(--cfarm-green) !important; }
        .navbar-cfarm .nav-link:hover::after { transform:scaleX(1); }
        .navbar-cfarm .nav-search {
            border: 1.5px solid #e0e0e0;
            border-radius: 25px;
            padding: 8px 20px;
            font-size: 0.85rem;
            outline: none;
            width: 150px;
            transition: all .4s cubic-bezier(.4,0,.2,1);
            background: rgba(248,249,250,0.8);
        }
        .navbar-cfarm .nav-search:focus { width:220px; border-color:var(--cfarm-green); box-shadow:0 0 0 3px var(--cfarm-green-glow); background:#fff; }
        .navbar-cfarm .lang-switch {
            border: 1.5px solid #e0e0e0;
            border-radius: 25px;
            padding: 6px 16px;
            font-size: 0.85rem;
            background: transparent;
            cursor: pointer;
            transition: all .3s;
        }
        .navbar-cfarm .lang-switch:hover { border-color:var(--cfarm-green); color:var(--cfarm-green); }
        .burger-menu {
            width:30px; height:22px; cursor:pointer; position:relative; display:flex; flex-direction:column; justify-content:space-between;
        }
        .burger-menu span {
            display:block; height:2.5px; background:var(--cfarm-green); border-radius:3px; transition:.4s cubic-bezier(.4,0,.2,1);
            transform-origin: center;
        }
        .burger-menu:hover span:nth-child(1) { transform:translateX(3px); }
        .burger-menu:hover span:nth-child(3) { transform:translateX(-3px); }

        /* ── Hero Section ── */
        .hero-ir {
            position: relative;
            height: 75vh;
            min-height: 550px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-ir .hero-bg {
            position:absolute; inset:0; background-size:cover; background-position:center;
        }
        .hero-ir .hero-content {
            position:relative; z-index:2; text-align:center; color:#fff;
            animation: fadeInUp 1.2s ease;
        }
        .hero-ir .hero-title {
            font-size:3.8rem; font-weight:200; letter-spacing:6px;
            text-shadow: 0 4px 40px rgba(0,0,0,0.3);
        }
        .hero-ir .hero-subtitle {
            font-size:1.2rem; font-weight:300; opacity:.75; margin-top:12px; letter-spacing:3px;
        }

        /* ── Stock Price Section ── */
        .stock-section {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 50%, #1b5e20 100%);
            background-size: 200% 200%;
            animation: gradientShift 10s ease infinite;
            color: #fff;
            padding: 50px 0;
            text-align: center;
            position: relative;
        }
        .stock-section::before {
            content:''; position:absolute; inset:0;
            background: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.05) 0%, transparent 50%),
                        radial-gradient(circle at 80% 50%, rgba(255,255,255,0.03) 0%, transparent 50%);
        }
        .stock-section .stock-symbol { font-size:1rem; font-weight:400; letter-spacing:3px; opacity:0.85; text-transform:uppercase; }
        .stock-section .stock-main-price { font-size:4.5rem; font-weight:100; line-height:1.1; }
        .stock-section .stock-unit { font-size:1.5rem; font-weight:300; opacity:.8; }
        .stock-section .stock-date { font-size:0.85rem; opacity:0.6; }
        .stock-section .stock-metric-label { font-size:0.8rem; opacity:0.65; }
        .stock-section .stock-metric-value { font-size:1.5rem; font-weight:400; }

        /* ── Section Styles ── */
        .section-ir { padding:90px 0; }
        .section-ir.bg-light-grey { background: linear-gradient(180deg, #f8fafb 0%, #eef2f5 100%); }
        .section-ir .section-heading {
            text-align:center;
            font-size:2.2rem;
            font-weight:400;
            margin-bottom:55px;
            color:var(--cfarm-text);
            letter-spacing:1px;
        }
        .section-ir .section-heading::after {
            content:'';
            display:block;
            width:60px;
            height:3px;
            background: linear-gradient(90deg, var(--cfarm-green-light), var(--cfarm-green-dark));
            margin:15px auto 0;
            border-radius:3px;
            animation: growWidth .8s ease forwards;
        }

        /* ── Pill Button ── */
        .btn-pill {
            border:1.5px solid var(--cfarm-text);
            border-radius:50px;
            padding:12px 32px;
            color:var(--cfarm-text);
            font-weight:400;
            font-size:0.9rem;
            background:transparent;
            text-decoration:none;
            transition: all .4s cubic-bezier(.4,0,.2,1);
            display:inline-flex;
            align-items:center;
            gap:8px;
            position:relative;
            overflow:hidden;
        }
        .btn-pill::before {
            content:''; position:absolute; inset:0;
            background:var(--cfarm-green);
            transform:scaleX(0);
            transform-origin:right;
            transition:transform .4s cubic-bezier(.4,0,.2,1);
            z-index:-1;
            border-radius:50px;
        }
        .btn-pill:hover::before { transform:scaleX(1); transform-origin:left; }
        .btn-pill:hover { border-color:var(--cfarm-green); color:#fff; box-shadow:0 4px 20px var(--cfarm-green-glow); }
        .btn-pill:hover i { transform:translateX(4px); }
        .btn-pill i { transition:transform .3s; }
        .btn-pill-green { border-color:var(--cfarm-green); color:var(--cfarm-green); }
        .btn-pill-white { border-color:rgba(255,255,255,0.8); color:#fff; }
        .btn-pill-white::before { background:#fff; }
        .btn-pill-white:hover { color:var(--cfarm-green); box-shadow:0 4px 20px rgba(255,255,255,0.3); }

        /* ── Cards ── */
        .card-news {
            border:none;
            border-radius:16px;
            overflow:hidden;
            box-shadow: var(--cfarm-shadow);
            transition: all .5s cubic-bezier(.4,0,.2,1);
            background:#fff;
        }
        .card-news:hover {
            box-shadow: var(--cfarm-shadow-hover);
            transform: translateY(-8px);
        }
        .card-news .news-date { font-size:0.8rem; color:var(--cfarm-text-light); display:flex; align-items:center; gap:5px; }
        .card-news .news-title { font-size:1rem; font-weight:400; color:var(--cfarm-text); line-height:1.6; }
        .card-news .card-body { padding:20px 24px; }

        /* ── Financial Highlight ── */
        .financial-highlight {
            text-align:center;
            padding:35px 20px;
            border-radius:16px;
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            transition: all .4s;
        }
        .financial-highlight:hover { transform:translateY(-5px); box-shadow:var(--cfarm-shadow); }
        .financial-highlight .fh-label { font-size:0.85rem; color:var(--cfarm-text-light); margin-bottom:8px; }
        .financial-highlight .fh-value { font-size:2.8rem; font-weight:300; color:var(--cfarm-green); line-height:1; }
        .financial-highlight .fh-unit { font-size:0.85rem; color:var(--cfarm-text-light); margin-top:5px; }

        /* ── Footer ── */
        .footer-ir {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at top left, rgba(67, 160, 71, 0.18), transparent 34%),
                radial-gradient(circle at 85% 20%, rgba(255, 152, 0, 0.12), transparent 24%),
                linear-gradient(180deg, #f3f8f2 0%, #dde9df 52%, #d0dfd3 100%);
            padding: 72px 0 30px;
            color: rgba(45,52,54,0.78);
            font-size: 0.95rem;
        }
        .footer-ir::before {
            content:'';
            position:absolute;
            inset:0;
            background-image:
                linear-gradient(rgba(46,125,50,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(46,125,50,0.06) 1px, transparent 1px);
            background-size: 32px 32px;
            opacity: 0.45;
            pointer-events: none;
        }
        .footer-ir::after {
            content:'';
            position:absolute;
            inset:auto auto -130px -110px;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(67,160,71,0.18) 0%, rgba(67,160,71,0) 72%);
            filter: blur(8px);
            pointer-events: none;
        }
        .footer-shell {
            position: relative;
            z-index: 1;
            padding: 34px;
            border-radius: 30px;
            background: linear-gradient(180deg, rgba(255,255,255,0.62), rgba(243,248,244,0.42));
            border:1px solid rgba(255,255,255,0.68);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.86), 0 18px 40px rgba(27,94,32,0.08);
        }
        .footer-brand {
            display:flex;
            align-items:center;
            gap:16px;
            margin-bottom:18px;
        }
        .footer-brand-mark {
            width:64px;
            height:64px;
            border-radius:18px;
            background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(243,249,244,0.86));
            border:1px solid rgba(46,125,50,0.08);
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow: 0 18px 30px rgba(46,125,50,0.10);
        }
        .footer-brand-mark img { max-width: 42px; }
        .footer-brand-title {
            color:var(--cfarm-text);
            font-size:1.12rem;
            font-weight:500;
            line-height:1.45;
            margin-bottom:0;
        }
        .footer-brand-subtitle {
            color:rgba(45,52,54,0.52);
            font-size:0.82rem;
            letter-spacing:0.08em;
            text-transform:uppercase;
        }
        .footer-description {
            color: rgba(45,52,54,0.72);
            max-width: 420px;
            margin-bottom: 22px;
        }
        .footer-contact-list,
        .footer-links {
            display:grid;
            gap:12px;
        }
        .footer-contact-item {
            display:flex;
            align-items:flex-start;
            gap:12px;
            color:rgba(45,52,54,0.74);
        }
        .footer-contact-item i,
        .footer-links a i {
            color:var(--cfarm-green);
            font-size:1rem;
            line-height:1.6;
        }
        .footer-link-group h6,
        .footer-cta h6 {
            font-weight:500;
            color:var(--cfarm-text);
            margin-bottom:18px;
            font-size:1rem;
            letter-spacing:0.04em;
        }
        .footer-links a {
            color:rgba(45,52,54,0.72);
            text-decoration:none;
            transition:all .3s;
            display:flex;
            align-items:center;
            gap:10px;
        }
        .footer-links a:hover {
            color:var(--cfarm-green-dark);
            transform:translateX(6px);
        }
        .footer-cta-panel {
            padding:24px;
            border-radius:24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.74), rgba(240,246,241,0.58));
            border:1px solid rgba(46,125,50,0.10);
            height:100%;
        }
        .footer-cta-panel p {
            color:rgba(45,52,54,0.68);
            margin-bottom:20px;
        }
        .footer-cta-actions {
            display:flex;
            flex-wrap:wrap;
            gap:12px;
        }
        .footer-action {
            display:inline-flex;
            align-items:center;
            gap:10px;
            border-radius:999px;
            padding:12px 18px;
            text-decoration:none;
            transition:all .3s;
            font-weight:400;
        }
        .footer-action-primary {
            background: linear-gradient(135deg, var(--cfarm-green-light), var(--cfarm-green));
            color:#fff;
            box-shadow: 0 12px 26px rgba(46,125,50,0.28);
        }
        .footer-action-primary:hover {
            color:#fff;
            transform:translateY(-2px);
            box-shadow: 0 18px 34px rgba(46,125,50,0.35);
        }
        .footer-action-secondary {
            color:var(--cfarm-green-dark);
            border:1px solid rgba(46,125,50,0.14);
            background: rgba(255,255,255,0.74);
        }
        .footer-action-secondary:hover {
            color:var(--cfarm-green-dark);
            border-color:rgba(46,125,50,0.3);
            background: rgba(255,255,255,0.96);
            transform:translateY(-2px);
        }
        .footer-ir .social-icon {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            width:46px;
            height:46px;
            border-radius:16px;
            background: rgba(255,255,255,0.76);
            color:var(--cfarm-green);
            font-size:1.15rem;
            transition:all .3s;
            margin-right:8px;
            border:1px solid rgba(46,125,50,0.08);
        }
        .footer-ir .social-icon:hover {
            background: linear-gradient(135deg, var(--cfarm-green-light), var(--cfarm-green));
            color:#fff;
            transform:translateY(-3px);
            box-shadow:0 10px 24px rgba(46,125,50,0.26);
        }
        .footer-bottom {
            position: relative;
            z-index: 1;
            border-top:1px solid rgba(46,125,50,0.10);
            padding-top:24px;
            margin-top:28px;
        }
        .footer-bottom p {
            margin-bottom:0;
            color:rgba(45,52,54,0.58);
        }
        .footer-bottom-links {
            display:flex;
            justify-content:flex-end;
            flex-wrap:wrap;
            gap:18px;
        }
        .footer-bottom-links a {
            color:rgba(45,52,54,0.62);
            text-decoration:none;
            transition:color .3s;
        }
        .footer-bottom-links a:hover { color:var(--cfarm-green-dark); }

        /* ── Offcanvas Menu ── */
        .offcanvas-cfarm {
            width:100% !important;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(20px);
        }
        .offcanvas-cfarm .nav-link {
            font-size:1.4rem;
            font-weight:300;
            padding:18px 30px !important;
            color:var(--cfarm-text) !important;
            border-bottom:1px solid rgba(0,0,0,0.04);
            transition: all .3s;
        }
        .offcanvas-cfarm .nav-link:hover {
            color:var(--cfarm-green) !important;
            background:rgba(46,125,50,0.04);
            padding-left:40px !important;
        }
        .offcanvas-cfarm .nav-link i { margin-left:auto; color:#ccc; transition:transform .3s; }
        .offcanvas-cfarm .nav-link:hover i { transform:translateX(5px); color:var(--cfarm-green); }

        /* ── Subpage Banner ── */
        .subpage-banner {
            background: linear-gradient(135deg, #1b5e20, #2e7d32, #388e3c);
            background-size:200% 200%;
            animation:gradientShift 8s ease infinite;
            padding:70px 0;
            color:#fff;
            text-align:center;
            position:relative;
        }
        .subpage-banner::after {
            content:''; position:absolute; bottom:0; left:0; right:0; height:4px;
            background:linear-gradient(90deg, var(--cfarm-green-light), var(--cfarm-orange), var(--cfarm-red));
        }
        .subpage-banner h1 { font-size:2.5rem; font-weight:200; letter-spacing:3px; animation:fadeInUp .8s ease; }

        /* ── Misc ── */
        .read-more-link {
            color:var(--cfarm-green);
            text-decoration:none;
            font-weight:400;
            display:inline-flex;
            align-items:center;
            gap:6px;
            transition: all .3s;
            position:relative;
        }
        .read-more-link::after {
            content:''; position:absolute; bottom:-2px; left:0; width:0; height:1.5px;
            background:var(--cfarm-green); transition:width .3s;
        }
        .read-more-link:hover { color:var(--cfarm-green-dark); gap:12px; }
        .read-more-link:hover::after { width:100%; }
        .divider-green { width:60px; height:3px; background:linear-gradient(90deg,var(--cfarm-green),var(--cfarm-green-light)); border-radius:3px; }
        .tab-green .nav-link { color:var(--cfarm-text-light); font-weight:400; border:none; padding:12px 24px; transition:.3s; border-radius:25px; }
        .tab-green .nav-link:hover { background:rgba(46,125,50,0.06); }
        .tab-green .nav-link.active { color:#fff; background:var(--cfarm-green); font-weight:400; box-shadow:0 4px 15px var(--cfarm-green-glow); }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width:8px; }
        ::-webkit-scrollbar-track { background:#f1f1f1; }
        ::-webkit-scrollbar-thumb { background:var(--cfarm-green-light); border-radius:10px; }
        ::-webkit-scrollbar-thumb:hover { background:var(--cfarm-green); }

        @media (max-width: 768px) {
            .hero-ir { height:55vh; min-height:380px; }
            .hero-ir .hero-title { font-size:2.2rem; letter-spacing:2px; }
            .stock-section .stock-main-price { font-size:2.8rem; }
            .section-ir { padding:60px 0; }
            .section-ir .section-heading { font-size:1.6rem; }
            .footer-ir { padding: 56px 0 24px; }
            .footer-shell { padding: 24px; }
            .footer-bottom-links { justify-content:flex-start; margin-top:14px; gap:14px; }
        }

        @yield('extra_css')
    </style>
</head>
<body>
    {{-- Main Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-cfarm sticky-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="/images/cfarm-logo.png" alt="CFARM" style="height:40px;">
            </a>
            {{-- Desktop Navigation Links --}}
            <div class="d-none d-lg-flex align-items-center gap-1 mx-auto">
                <a class="nav-link" href="{{ route('company.profile') }}">{{ __('messages.about_us') }}</a>
                <a class="nav-link" href="{{ route('news.index') }}">{{ __('messages.news') }}</a>
                <a class="nav-link" href="{{ route('financial.index') }}">{{ __('messages.financial') }}</a>
                <a class="nav-link" href="{{ route('documents.index') }}">{{ __('messages.documents') }}</a>
                <a class="nav-link" href="{{ route('events.index') }}">{{ __('messages.events') }}</a>
                <a class="nav-link" href="{{ route('shareholders.index') }}">{{ __('messages.shareholders') }}</a>
                <a class="nav-link" href="{{ route('contact.index') }}">{{ __('messages.contact_us') }}</a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <form action="{{ route('search') }}" method="GET" class="d-none d-md-block">
                    <input type="search" name="q" class="nav-search" placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('q') }}">
                </form>
                <div class="dropdown">
                    <button class="lang-switch dropdown-toggle" data-bs-toggle="dropdown">{{ strtoupper(session('locale', config('app.locale'))) }}</button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item {{ session('locale') == 'th' ? 'active' : '' }}" href="{{ route('lang.switch', 'th') }}">TH</a></li>
                        <li><a class="dropdown-item {{ session('locale') == 'en' ? 'active' : '' }}" href="{{ route('lang.switch', 'en') }}">EN</a></li>
                    </ul>
                </div>
                <div class="burger-menu d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#navMenu">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>
    </nav>

    {{-- Offcanvas Navigation --}}
    <div class="offcanvas offcanvas-end offcanvas-cfarm" tabindex="-1" id="navMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title"><img src="/images/cfarm-logo.png" alt="CFARM" style="height:35px;"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="d-flex flex-column">
                <a class="nav-link d-flex justify-content-between" href="{{ route('company.profile') }}">{{ __('messages.about_us') }} <i class="bi bi-chevron-right"></i></a>
                <a class="nav-link d-flex justify-content-between" href="{{ route('news.index') }}">{{ __('messages.news_and_events') }} <i class="bi bi-chevron-right"></i></a>
                <a class="nav-link d-flex justify-content-between" href="{{ route('financial.index') }}">{{ __('messages.financial') }} <i class="bi bi-chevron-right"></i></a>
                <a class="nav-link d-flex justify-content-between" href="{{ route('documents.index') }}">{{ __('messages.documents') }} <i class="bi bi-chevron-right"></i></a>
                <a class="nav-link d-flex justify-content-between" href="{{ route('events.index') }}">{{ __('messages.events') }} <i class="bi bi-chevron-right"></i></a>
                <a class="nav-link d-flex justify-content-between" href="{{ route('governance.index') }}">{{ __('messages.governance') }} <i class="bi bi-chevron-right"></i></a>
                <a class="nav-link d-flex justify-content-between" href="{{ route('shareholders.index') }}">{{ __('messages.shareholders') }} <i class="bi bi-chevron-right"></i></a>
                <a class="nav-link d-flex justify-content-between" href="{{ route('contact.index') }}">{{ __('messages.contact_us') }}</a>
            </nav>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-0 rounded-0" role="alert">
            <div class="container">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Main Content --}}
    <main>@yield('content')</main>

    {{-- Footer --}}
    <footer class="footer-ir">
        <div class="container position-relative">
            <div class="footer-shell">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="footer-brand">
                            <div class="footer-brand-mark">
                                <img src="/images/cfarm-logo.png" alt="CFARM">
                            </div>
                            <div>
                                <div class="footer-brand-subtitle">Chuwit Farm 2019 PCL</div>
                                <p class="footer-brand-title">บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน)</p>
                            </div>
                        </div>
                                                <div class="footer-contact-list">
                            <div class="footer-contact-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>723 ถ.โชคชัย-เดชอุดม ต.นางรอง อ.นางรอง จ.บุรีรัมย์ 31110</span>
                            </div>
                            <div class="footer-contact-item">
                                <i class="bi bi-telephone"></i>
                                <span>044-115-155</span>
                            </div>
                            <div class="footer-contact-item">
                                <i class="bi bi-envelope"></i>
                                <span>admin@chuwitfarm.com</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-link-group">
                            <h6>{{ __('messages.investor_relations') }}</h6>
                            <div class="footer-links">
                                <a href="{{ route('financial.index') }}"><i class="bi bi-bar-chart-line"></i> {{ __('messages.financial') }}</a>
                                <a href="{{ route('documents.index') }}"><i class="bi bi-file-earmark-text"></i> {{ __('messages.documents') }}</a>
                                <a href="{{ route('shareholders.index') }}"><i class="bi bi-people"></i> {{ __('messages.shareholders') }}</a>
                                <a href="{{ route('governance.index') }}"><i class="bi bi-shield-check"></i> {{ __('messages.governance') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="footer-cta">
                            <div class="footer-cta-panel">
                                <h6>{{ __('messages.news_and_events') }}</h6>
                               
                                <div class="footer-cta-actions">
                                    <a href="{{ route('news.index') }}" class="footer-action footer-action-primary">
                                        <i class="bi bi-arrow-up-right-circle"></i>
                                        {{ __('messages.set_news') }}
                                    </a>
                                    <a href="{{ route('contact.index') }}" class="footer-action footer-action-secondary">
                                        <i class="bi bi-headset"></i>
                                        {{ __('messages.contact_us') }}
                                    </a>
                                </div>
                                <div class="mt-4">
                                    <a href="https://www.facebook.com/people/Cfarm-Chuwit-Farm-2019-Plc/100095446091411/" target="_blank" class="social-icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="https://www.youtube.com/watch?si=TJ09ducGmhOxOzHz&v=bftZHV3seIc" target="_blank" class="social-icon" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                                    <a href="https://www.chuwitfarm.com/" target="_blank" class="social-icon" aria-label="Website"><i class="bi bi-globe"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-7">
                            <p>&copy; {{ __('messages.all_rights_reserved') }} {{ date('Y') + 543 }} CHUWIT FARM (2019) PUBLIC COMPANY LIMITED</p>
                        </div>
                        <div class="col-md-5">
                            <div class="footer-bottom-links">
                                <a href="{{ route('privacy.policy') }}">{{ __('messages.privacy_policy') }}</a>
                                <a href="{{ route('cookie.policy') }}">{{ __('messages.cookie_policy') }}</a>
                                <a href="{{ route('events.index') }}">{{ __('messages.event_calendar') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- Cookie & Privacy Consent Banner (Floating Widget Style) --}}
    <div x-data="cookieConsent()" x-show="showBanner" x-transition.translate.y.100.duration.600ms.opacity 
         class="position-fixed" style="bottom: 30px; left: 30px; width: 360px; max-width: calc(100vw - 60px); z-index: 9999; display: none;">
        <div class="bg-white p-4" style="border-radius: 20px; box-shadow: 0 15px 50px rgba(0,0,0,0.15); border: 1px solid rgba(46,125,50,0.1);">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                    <i class="bi bi-shield-lock-fill fs-5"></i>
                </div>
                <h6 class="fw-bold mb-0 text-dark" style="font-size: 1.05rem;">การคุ้มครองข้อมูลส่วนบุคคล</h6>
            </div>
            <p class="text-muted mb-4" style="font-size: 0.88rem; line-height: 1.6;">
                เว็บไซต์ของเรามีการใช้งานคุกกี้ (Cookies) เพื่อมอบประสบการณ์ที่ดีที่สุดในการใช้งานให้กับคุณ และช่วยให้เราพัฒนาคุณภาพของเว็บไซต์ การเข้าใช้งานเว็บไซต์ถือเป็นการยอมรับ <a href="{{ route('privacy.policy') }}" target="_blank" class="text-success text-decoration-none fw-medium" style="border-bottom: 1px dashed var(--cfarm-green);">นโยบายความเป็นส่วนตัว</a> และ <a href="{{ route('cookie.policy') }}" target="_blank" class="text-success text-decoration-none fw-medium" style="border-bottom: 1px dashed var(--cfarm-green);">นโยบายคุกกี้</a> ของเรา
            </p>
            <div class="d-grid gap-2">
                <button @click="acceptCookies()" class="btn btn-success rounded-pill shadow-sm py-2 fw-medium" style="background: linear-gradient(135deg, var(--cfarm-green-light), var(--cfarm-green)); border: none; transition: all 0.3s;">ยอมรับทั้งหมด</button>
                <a href="{{ route('cookie.policy') }}" class="btn btn-light rounded-pill py-2 fw-medium" style="color: var(--cfarm-text-light); border: 1px solid #e0e0e0; transition: all 0.3s; background: #f8f9fa;">การตั้งค่าคุกกี้</a>
            </div>
        </div>
    </div>

    <script>
        function cookieConsent() {
            return {
                showBanner: false,
                init() {
                    // Show banner if consent hasn't been given yet
                    if (!localStorage.getItem('cfarm_cookie_consent')) {
                        setTimeout(() => {
                            this.showBanner = true;
                        }, 1200);
                    }
                },
                acceptCookies() {
                    localStorage.setItem('cfarm_cookie_consent', 'accepted');
                    this.showBanner = false;
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar Scrolled State
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-cfarm');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Intersection Observer for Scroll Reveals
        document.addEventListener("DOMContentLoaded", function () {
            const reveals = document.querySelectorAll(".reveal, .animate-on-scroll");
            
            const revealOptions = {
                threshold: 0.15,
                rootMargin: "0px 0px -50px 0px"
            };

            const revealOnScroll = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("active", "visible");
                        observer.unobserve(entry.target);
                    }
                });
            }, revealOptions);

            reveals.forEach(reveal => {
                revealOnScroll.observe(reveal);
            });

            document.querySelectorAll('.section-ir, .card-news, .financial-highlight, .card, [class*="col-"]').forEach(el => {
                el.classList.add('animate-on-scroll');
                revealOnScroll.observe(el);
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    </script>
    @yield('scripts')
</body>
</html>

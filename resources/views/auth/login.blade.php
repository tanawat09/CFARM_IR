<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - CFARM Investor Relations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-wrapper {
            background: #ffffff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.08);
            display: flex;
            min-height: 620px;
        }
        .login-sidebar {
            background: linear-gradient(135deg, #2E7D32 0%, #1B5E20 100%);
            color: white;
            padding: 3.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .login-sidebar::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -20%;
            width: 140%;
            height: 140%;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 60%);
            transform: rotate(20deg);
        }
        .login-form-area {
            padding: 4.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }
        .form-control {
            padding: 0.9rem 1.2rem;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #4ade80;
            box-shadow: 0 0 0 4px rgba(74, 222, 128, 0.15);
            background: #ffffff;
        }
        .input-group-text {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #94a3b8;
        }
        .form-control:focus + .input-group-text,
        .input-group:focus-within .input-group-text {
            border-color: #4ade80;
            background: #ffffff;
            color: #2E7D32;
        }
        .btn-primary {
            background-color: #2E7D32;
            border-color: #2E7D32;
            padding: 0.9rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: #1B5E20;
            border-color: #1B5E20;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(27, 94, 32, 0.2);
        }
        .brand-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            width: 90px;
            height: 90px;
            text-align: center;
            line-height: 90px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }
        .hover-underline:hover {
            text-decoration: underline !important;
        }
        
        @media (max-width: 991px) {
            .login-form-area { padding: 3rem; }
            .login-wrapper { min-height: auto; }
        }
        @media (max-width: 576px) {
            .login-form-area { padding: 2rem; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">
            <div class="login-wrapper">
                <div class="row g-0 w-100">
                    <!-- Brand Section (Left) -->
                    <div class="col-md-5 d-none d-md-block login-sidebar">
                        <div class="position-relative z-1">
                            <i class="bi bi-building-check brand-icon"></i>
                            <h2 class="fw-bold mb-3" style="line-height: 1.3;">CFARM<br>Investor Relations</h2>
                            <p class="text-white opacity-75 mb-0" style="font-size: 0.95rem; line-height: 1.7;">
                                ระบบบริหารจัดการข้อมูลหลังบ้านและนักลงทุนสัมพันธ์<br>
                                บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน)
                            </p>
                        </div>
                    </div>
                    
                    <!-- Login Form Section (Right) -->
                    <div class="col-md-7 login-form-area">
                        <div class="text-center mb-4 d-md-none">
                            <i class="bi bi-building-check text-success fs-1"></i>
                            <h3 class="fw-bold text-success mt-2">CFARM IR</h3>
                        </div>
                        
                        <h4 class="fw-bold mb-2 text-dark">เข้าสู่ระบบ (Login)</h4>
                        <p class="text-secondary mb-4 small">กรุณากรอกข้อมูลเพื่อเข้าสู่ระบบผู้ดูแลระบบ</p>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4 rounded-3 border-0 bg-success bg-opacity-10 text-success fw-medium">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-medium text-dark small">อีเมล (Email)</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i class="bi bi-envelope"></i></span>
                                    <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="your-email@cfarm.co.th">
                                </div>
                                @error('email')
                                    <div class="text-danger mt-1 small"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="password" class="form-label fw-medium text-dark small mb-0">รหัสผ่าน (Password)</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-success text-decoration-none small hover-underline fw-medium">ลืมรหัสผ่าน?</a>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0"><i class="bi bi-lock"></i></span>
                                    <input id="password" type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                                </div>
                                @error('password')
                                    <div class="text-danger mt-1 small"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4 form-check">
                                <input class="form-check-input border-secondary" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label text-secondary small" for="remember_me">
                                    จดจำการเข้าสู่ระบบไว้
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 shadow-sm mt-2">
                                <i class="bi bi-box-arrow-in-right me-2"></i> ยืนยันเข้าสู่ระบบ
                            </button>
                        </form>
                        
                        <div class="mt-5 text-center">
                            <p class="text-muted small mb-0">&copy; {{ date('Y') }} CFARM (2019) PCL. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

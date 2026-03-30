@extends('layouts.app')
@section('title', 'ติดต่อเรา - CFARM ชูวิทย์ฟาร์ม')

@section('extra_css')
    <style>
        /* Hero Banner for Contact */
        .contact-hero {
            position: relative;
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #0a2e13 0%, #1b5e20 50%, #2e7d32 100%);
            overflow: hidden;
            color: white;
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(76, 175, 80, 0.2) 0%, transparent 50%);
            z-index: 1;
        }

        .contact-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.05;
            z-index: 1;
        }

        .contact-hero .container {
            position: relative;
            z-index: 2;
        }

        /* Contact Info Cards */
        .contact-info-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 30px;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .contact-info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--cfarm-green);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
            z-index: -1;
        }

        .contact-info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(46, 125, 50, 0.15);
        }

        .contact-info-card:hover::before {
            transform: scaleX(1);
        }

        .icon-box-lg {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 25px;
            background: rgba(46, 125, 50, 0.08);
            color: var(--cfarm-green);
            transition: all 0.3s ease;
        }

        .contact-info-card:hover .icon-box-lg {
            background: var(--cfarm-green);
            color: white;
            transform: scale(1.1) rotate(5deg);
        }

        /* Floating Label Form */
        .form-floating>.form-control,
        .form-floating>.form-select {
            height: 3.5rem;
            line-height: 1.25;
            border-radius: 12px;
            border: 2px solid #eef2f5;
            background-color: #f8fafb;
            transition: all 0.3s ease;
        }

        .form-floating>textarea.form-control {
            height: auto;
            min-height: 150px;
        }

        .form-floating>.form-control:focus,
        .form-floating>.form-select:focus {
            border-color: var(--cfarm-green-light);
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.15);
            background-color: #fff;
        }

        .form-floating>label {
            padding: 1rem 1.25rem;
            color: #6c757d;
        }

        .form-card {
            background: #fff;
            border-radius: 24px;
            padding: 50px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .form-card::after {
            content: '';
            position: absolute;
            top: -15px;
            right: -15px;
            bottom: 15px;
            left: 15px;
            border-radius: 24px;
            border: 2px dashed rgba(46, 125, 50, 0.2);
            z-index: -1;
        }

        /* Map Section */
        .map-container {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            position: relative;
            height: 500px;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
            filter: grayscale(20%) contrast(1.1);
            /* Stylized map */
            transition: filter 0.5s ease;
        }

        .map-container:hover iframe {
            filter: grayscale(0%) contrast(1);
        }

        .map-overlay-card {
            position: absolute;
            bottom: 30px;
            left: 30px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 320px;
            z-index: 10;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
@endsection

@section('content')

    {{-- 1. Hero Section --}}
    <section class="contact-hero text-center">
        <div class="container reveal">
            <span
                class="badge bg-white bg-opacity-25 text-white border border-light border-opacity-50 px-4 py-2 rounded-pill fw-medium tracking-widest mb-4">GET
                IN TOUCH</span>
            <h1 class="display-3 fw-bold mb-3">{{ __('messages.contact_us') }}</h1>
            <p class="lead fw-light text-white-50 mx-auto" style="max-width: 600px;">
                We'd love to hear from you. Whether you have an investor inquiry, comment, or just want to connect with our
                team.
            </p>
        </div>
    </section>

    {{-- 2. Contact Info Cards --}}
    <section class="py-6" style="margin-top: -60px; position: relative; z-index: 10;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                {{-- Address Card --}}
                <div class="col-lg-4 col-md-6 reveal delay-1">
                    <div class="contact-info-card text-center d-flex flex-column align-items-center">
                        <div class="icon-box-lg shadow-sm">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h4 class="fw-bold mb-3">{{ __('messages.head_office') }}</h4>
                        <p class="text-muted mb-0">
                            <strong>บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน)</strong><br>
                            723 ถนนโชคชัย-เดชอุดม ตำบลนางรอง<br>
                            อำเภอนางรอง จังหวัดบุรีรัมย์ 31110
                        </p>
                    </div>
                </div>

                {{-- Communication Card --}}
                <div class="col-lg-4 col-md-6 reveal delay-2">
                    <div class="contact-info-card text-center d-flex flex-column align-items-center">
                        <div class="icon-box-lg shadow-sm">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Communication</h4>
                        <ul class="list-unstyled text-muted mb-0 space-y-2">
                            <li class="mb-2"><i class="bi bi-telephone text-success me-2"></i> 044-115-155</li>
                            <li><i class="bi bi-envelope-fill text-success me-2"></i> <a href="mailto:ir@chuwitfarm.com"
                                    class="text-muted text-decoration-none hover-success">ir@chuwitfarm.com</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Social Media Card --}}
                <div class="col-lg-4 col-md-6 reveal delay-3">
                    <div class="contact-info-card text-center d-flex flex-column align-items-center">
                        <div class="icon-box-lg shadow-sm">
                            <i class="bi bi-share-fill"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Connect With Us</h4>
                        <p class="text-muted mb-4">ติดตามเราได้ทางโซเชียลมีเดียเพื่อรับข่าวสารล่าสุด</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="https://www.facebook.com/people/Cfarm-Chuwit-Farm-2019-Plc/100095446091411/"
                                target="_blank"
                                class="btn btn-outline-primary rounded-circle d-flex align-items-center justify-content-center hover-scale"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-facebook fs-5"></i>
                            </a>
                            <a href="https://www.youtube.com/watch?si=TJ09ducGmhOxOzHz&v=bftZHV3seIc" target="_blank"
                                class="btn btn-outline-danger rounded-circle d-flex align-items-center justify-content-center hover-scale"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-youtube fs-5"></i>
                            </a>
                            <a href="https://www.chuwitfarm.com/" target="_blank"
                                class="btn btn-outline-success rounded-circle d-flex align-items-center justify-content-center hover-scale"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-globe fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Form & Map Section --}}
    <section class="py-5 bg-light position-relative overflow-hidden">
        <!-- Decorative background shape -->
        <div class="position-absolute rounded-circle"
            style="width: 800px; height: 800px; background: rgba(76,175,80,0.03); top: -20px; right: -200px; z-index: 0;">
        </div>

        <div class="container position-relative z-1 py-5">
            <div class="row align-items-center g-5">

                {{-- Contact Form --}}
                <div class="col-lg-5 reveal delay-1">
                    <div class="form-card">
                        <div class="mb-5">
                            <span class="text-success fw-bold tracking-widest text-uppercase small">Let's Talk</span>
                            <h2 class="display-6 fw-bold text-dark mt-2 mb-0">{{ __('messages.send_message') }}</h2>
                            <div class="bg-success rounded-pill mt-3" style="width: 50px; height: 3px;"></div>
                        </div>

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="name" id="nameInput"
                                            class="form-control fw-medium @error('name') is-invalid @enderror"
                                            placeholder="Name" value="{{ old('name') }}" required>
                                        <label for="nameInput"><i
                                                class="bi bi-person me-2"></i>{{ __('messages.name_label') }}</label>
                                        @error('name')<div class="invalid-feedback ps-3">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" name="email" id="emailInput"
                                            class="form-control fw-medium @error('email') is-invalid @enderror"
                                            placeholder="Email" value="{{ old('email') }}" required>
                                        <label for="emailInput"><i
                                                class="bi bi-envelope me-2"></i>{{ __('messages.email_label') }}</label>
                                        @error('email')<div class="invalid-feedback ps-3">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="phone" id="phoneInput" class="form-control fw-medium"
                                            placeholder="Phone" value="{{ old('phone') }}">
                                        <label for="phoneInput"><i
                                                class="bi bi-telephone me-2"></i>{{ __('messages.phone_label') }}
                                            (Optional)</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="message" id="messageInput"
                                            class="form-control fw-medium @error('message') is-invalid @enderror"
                                            placeholder="Message" required
                                            style="height: 150px;">{{ old('message') }}</textarea>
                                        <label for="messageInput"><i
                                                class="bi bi-chat-text me-2"></i>{{ __('messages.message_label') }}</label>
                                        @error('message')<div class="invalid-feedback ps-3">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit"
                                        class="btn btn-success w-100 py-3 rounded-pill fw-bold fs-5 hover-lift shadow d-flex align-items-center justify-content-center gap-2"
                                        style="background: linear-gradient(45deg, #1b5e20, #4caf50); border: none;">
                                        {{ __('messages.submit_message') }} <i class="bi bi-arrow-right-circle-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Google Map --}}
                <div class="col-lg-7 reveal delay-2">
                    <div class="map-container">
                        <!-- Google Maps Iframe Generator - CFARM Location -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15442.2384728562!2d102.7663297129598!3d14.62413123841027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3119f9bb49f80993%3A0x6b4fb6fb0dd3d640!2z4Lia4Lij4Li04Lip4Lix4LiXIOC4iuC4ueC4p-C4tOC4l-C4ouC5jOC4n-C4suC4o-C5jOC4oSAoMjAxOSkg4LiI4Liz4LiB4Lix4LiEIChDSEVXSVQgRkFSTSAoMjAxOSkgQ08uLCBMVEQuKQ!5e0!3m2!1sen!2sth!4v1709949661413!5m2!1sen!2sth"
                            loading="lazy"></iframe>

                        <div class="map-overlay-card d-none d-md-block">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-success rounded-circle p-2 text-white me-3 d-flex align-items-center justify-content-center"
                                    style="width: 40px; height: 40px;">
                                    <i class="bi bi-pin-map-fill fs-5"></i>
                                </div>
                                <h6 class="fw-bold mb-0 text-dark">CFARM Headquarters</h6>
                            </div>
                            <p class="small text-muted mb-0">Nang Rong District, Buriram 31110, Thailand</p>
                            <a href="https://maps.app.goo.gl/RuTXM5pFeaGD8Rek8" target="_blank"
                                class="small text-success fw-bold text-decoration-none mt-2 d-inline-block">Get Directions
                                <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
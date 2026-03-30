@extends('layouts.app')

@section('title', 'เกี่ยวกับเรา - CFARM ชูวิทย์ฟาร์ม')

@php
    $settings = \App\Models\Setting::where('group', 'company_profile')->get()->keyBy('key');
    $locale = session('locale', config('app.locale'));
    $getSetting = function($key) use ($settings, $locale) {
        $s = $settings->get($key);
        if (!$s) return '';
        return $locale === 'th' ? ($s->value_th ?? '') : ($s->value_en ?? '');
    };
@endphp

@section('extra_css')
/* ── Company Profile Premium V2 ── */
.cp-hero-section {
    position: relative;
    min-height: 420px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0d3d11 0%, #1b5e20 30%, #2e7d32 60%, #388e3c 100%);
    background-size: 300% 300%;
    animation: gradientShift 12s ease infinite;
    overflow: hidden;
}
.cp-hero-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.06) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.04) 0%, transparent 40%),
        radial-gradient(circle at 50% 50%, rgba(0,0,0,0.1) 0%, transparent 70%);
}
.cp-hero-section::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 80px;
    background: linear-gradient(0deg, #fff, transparent);
    z-index: 2;
}
.cp-hero-content {
    position: relative;
    z-index: 3;
    text-align: center;
    color: #fff;
    animation: fadeInUp 1s ease;
}
.cp-hero-content h1 {
    font-size: 3.2rem;
    font-weight: 200;
    letter-spacing: 6px;
    text-shadow: 0 4px 30px rgba(0,0,0,0.3);
    margin-bottom: 10px;
}
.cp-hero-content p {
    font-size: 1rem;
    letter-spacing: 8px;
    text-transform: uppercase;
    opacity: 0.7;
    font-weight: 300;
}

/* Stats Cards overlapping hero */
.cp-stats-row {
    margin-top: -55px;
    position: relative;
    z-index: 5;
    margin-bottom: 60px;
}
.cp-stat {
    background: #fff;
    border-radius: 16px;
    padding: 30px 20px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    border: 1px solid rgba(0,0,0,0.04);
    transition: all 0.4s cubic-bezier(.4,0,.2,1);
}
.cp-stat:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(46,125,50,0.15);
    border-color: var(--cfarm-green);
}
.cp-stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    margin-bottom: 15px;
}
.cp-stat .num {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--cfarm-green-dark);
    line-height: 1;
    margin-bottom: 5px;
}
.cp-stat .label {
    font-size: 0.85rem;
    color: var(--cfarm-text-light);
    font-weight: 400;
}

/* About Section */
.cp-about-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    border-radius: 50px;
    background: linear-gradient(135deg, rgba(46,125,50,0.1), rgba(46,125,50,0.05));
    color: var(--cfarm-green);
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 20px;
    border: 1px solid rgba(46,125,50,0.15);
}
.cp-about-quote {
    position: relative;
    padding: 25px 30px;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(46,125,50,0.03), rgba(46,125,50,0.07));
    border-left: 4px solid var(--cfarm-green);
    margin-top: 25px;
}
.cp-about-quote::before {
    content: '\201C';
    position: absolute;
    top: -10px;
    left: 20px;
    font-size: 4rem;
    color: rgba(46,125,50,0.15);
    font-family: Georgia, serif;
    line-height: 1;
}

/* Image Card */
.cp-image-card {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 25px 60px rgba(0,0,0,0.15);
    border: 5px solid #fff;
}
.cp-image-inner {
    width: 100%;
    padding-bottom: 115%;
    position: relative;
    background: linear-gradient(150deg, #1b5e20 0%, #2e7d32 40%, #43a047 100%);
}
.cp-image-inner::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 30% 60%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 70% 30%, rgba(255,255,255,0.06) 0%, transparent 45%);
}
.cp-float-badge {
    position: absolute;
    top: -12px;
    right: -12px;
    background: linear-gradient(135deg, #ff9800, #f57c00);
    color: #fff;
    padding: 10px 18px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(255,152,0,0.4);
    font-weight: 600;
    font-size: 0.85rem;
    z-index: 10;
    animation: float 3s ease infinite;
}

/* Vision & Mission */
.cp-vision-card {
    background: #fff;
    border-radius: 20px;
    padding: 45px 35px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    border-top: 5px solid var(--cfarm-green);
    text-align: center;
    position: relative;
    overflow: hidden;
    height: 100%;
}
.cp-vision-card::after {
    content: '\F32E';
    font-family: 'Bootstrap Icons';
    position: absolute;
    bottom: -20px;
    right: -10px;
    font-size: 10rem;
    color: rgba(46,125,50,0.03);
}
.cp-vision-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(46,125,50,0.15), rgba(46,125,50,0.05));
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
}
.cp-mission-card {
    background: #fff;
    border-radius: 20px;
    padding: 40px 35px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    height: 100%;
}
.cp-mission-item {
    display: flex;
    align-items: flex-start;
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 10px;
    background: rgba(46,125,50,0.03);
    border: 1px solid rgba(46,125,50,0.06);
    transition: all 0.3s ease;
}
.cp-mission-item:hover {
    background: rgba(46,125,50,0.08);
    transform: translateX(6px);
    border-color: rgba(46,125,50,0.15);
    box-shadow: 0 4px 15px rgba(46,125,50,0.08);
}
.cp-mission-num {
    width: 30px;
    height: 30px;
    min-width: 30px;
    border-radius: 8px;
    background: linear-gradient(135deg, var(--cfarm-green), var(--cfarm-green-dark));
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.8rem;
    margin-right: 14px;
    margin-top: 2px;
}

/* Info Section */
.cp-info-panel {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    border: 1px solid rgba(0,0,0,0.04);
}
.cp-info-sidebar {
    background: linear-gradient(160deg, #0d3d11 0%, #1b5e20 40%, #2e7d32 100%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 50px 30px;
    position: relative;
    overflow: hidden;
}
.cp-info-sidebar::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 100%, rgba(255,255,255,0.08) 0%, transparent 60%);
}
.cp-info-sidebar-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}
.cp-info-row {
    display: flex;
    align-items: flex-start;
    padding: 18px 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.cp-info-row:last-child { border-bottom: none; }
.cp-info-icon {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 10px;
    background: rgba(46,125,50,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: var(--cfarm-green);
}
.cp-info-label {
    font-weight: 500;
    color: var(--cfarm-text);
    font-size: 0.9rem;
    margin-bottom: 2px;
}
.cp-info-value {
    font-weight: 300;
    color: var(--cfarm-text-light);
    font-size: 0.95rem;
}

/* CTA Section */
.cp-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 30px;
    border-radius: 50px;
    font-weight: 500;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(.4,0,.2,1);
    position: relative;
    overflow: hidden;
}
.cp-cta-primary {
    background: linear-gradient(135deg, var(--cfarm-green), var(--cfarm-green-dark));
    color: #fff;
    border: none;
    box-shadow: 0 8px 25px rgba(46,125,50,0.3);
}
.cp-cta-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(46,125,50,0.4);
    color: #fff;
}
.cp-cta-outline {
    background: transparent;
    color: var(--cfarm-text);
    border: 1.5px solid #ddd;
}
.cp-cta-outline:hover {
    border-color: var(--cfarm-green);
    color: var(--cfarm-green);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(46,125,50,0.1);
}

/* Floating Particles */
.cp-particle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.06);
    animation: float 6s ease-in-out infinite;
}

@media (max-width: 768px) {
    .cp-hero-content h1 { font-size: 2rem; letter-spacing: 3px; }
    .cp-stat .num { font-size: 1.8rem; }
    .cp-info-sidebar { min-height: 200px; }
}
@endsection

@section('content')
{{-- ══════════════ HERO ══════════════ --}}
<div class="cp-hero-section">
    {{-- Floating particles --}}
    <div class="cp-particle" style="width:120px; height:120px; top:20%; left:10%; animation-delay:0s;"></div>
    <div class="cp-particle" style="width:80px; height:80px; top:60%; right:15%; animation-delay:2s;"></div>
    <div class="cp-particle" style="width:60px; height:60px; top:30%; right:30%; animation-delay:4s;"></div>

    <div class="cp-hero-content">
        <h1>{{ __('messages.about_us') }}</h1>
        <p>About Us</p>
        <div style="width:50px; height:3px; background:var(--cfarm-orange); margin:20px auto 0; border-radius:3px;"></div>
    </div>
</div>

{{-- ══════════════ STATS CARDS ══════════════ --}}
<div class="container cp-stats-row">
    <div class="row g-3">
        <div class="col-6 col-lg-3">
            <div class="cp-stat">
                <div class="cp-stat-icon" style="background:rgba(46,125,50,0.1); color:var(--cfarm-green);"><i class="bi bi-calendar3"></i></div>
                <div class="num">{{ date('Y') - 1997 }}</div>
                <div class="label">{{ $locale === 'th' ? 'ปีแห่งประสบการณ์' : 'Years Experience' }}</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="cp-stat">
                <div class="cp-stat-icon" style="background:rgba(255,152,0,0.1); color:#ff9800;"><i class="bi bi-houses"></i></div>
                <div class="num">{{ $getSetting('cp_farms_count') ?: '8' }}</div>
                <div class="label">{{ $locale === 'th' ? 'ฟาร์มทั่วภาคอีสาน' : 'Farms' }}</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="cp-stat">
                <div class="cp-stat-icon" style="background:rgba(33,150,243,0.1); color:#2196f3;"><i class="bi bi-cash-stack"></i></div>
                <div class="num">580<small style="font-size:0.4em; font-weight:400;">M</small></div>
                <div class="label">{{ $locale === 'th' ? 'ทุนจดทะเบียน (บาท)' : 'Registered Capital' }}</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="cp-stat">
                <div class="cp-stat-icon" style="background:rgba(76,175,80,0.1); color:#4caf50;"><i class="bi bi-graph-up-arrow"></i></div>
                <div class="num" style="font-size:2rem; letter-spacing:2px;">CFARM</div>
                <div class="label">{{ $locale === 'th' ? 'ตลาดหลักทรัพย์ mai' : 'mai Market' }}</div>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════ ABOUT ══════════════ --}}
<section style="padding: 30px 0 90px;">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <div class="cp-about-badge">
                    <i class="bi bi-buildings"></i>
                    {{ $locale === 'th' ? 'เกี่ยวกับองค์กร' : 'About Us' }}
                </div>

                <h2 style="font-weight:400; font-size:2rem; color:var(--cfarm-text); line-height:1.5; margin-bottom:25px;">
                    {{ $getSetting('cp_company_name') }}
                </h2>

                <p style="font-weight:300; font-size:1.05rem; line-height:2; color:var(--cfarm-text-light);">
                    {{ $getSetting('cp_about_desc_1') }}
                </p>

                @if($getSetting('cp_about_desc_2'))
                <div class="cp-about-quote">
                    <p style="font-weight:300; font-size:1rem; line-height:1.9; color:var(--cfarm-text-light); margin:0; font-style:italic; position:relative; z-index:1;">
                        {{ $getSetting('cp_about_desc_2') }}
                    </p>
                </div>
                @endif
            </div>

            <div class="col-lg-5">
                <div class="position-relative">
                    <div class="cp-float-badge">
                        <i class="bi bi-patch-check-fill me-1"></i> mai : CFARM
                    </div>
                    <div class="cp-image-card">
                        @if($settings->get('cp_company_image')?->value_th)
                            <img src="{{ Storage::url($settings->get('cp_company_image')->value_th) }}" 
                                 alt="{{ $getSetting('cp_company_name') ?: 'CFARM' }}" 
                                 style="width: 100%; height: auto; display: block; min-height: 350px; object-fit: cover;">
                        @else
                        <div class="cp-image-inner">
                            <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-55%); text-align:center; z-index:2;">
                                <i class="bi bi-tree" style="font-size:4.5rem; color:rgba(255,255,255,0.12);"></i>
                                <h3 style="color:#fff; font-weight:300; letter-spacing:5px; margin-top:15px; font-size:1.6rem;">CFARM</h3>
                                <div style="width:35px; height:2px; background:var(--cfarm-orange); margin:12px auto;"></div>
                                <p style="color:rgba(255,255,255,0.6); font-size:0.85rem; letter-spacing:3px;">SINCE 1997</p>
                            </div>
                            <div style="position:absolute; bottom:0; left:0; width:100%; padding:22px 25px; background:linear-gradient(0deg, rgba(0,0,0,0.7),transparent); z-index:2;">
                                <p style="color:rgba(255,255,255,0.9); font-size:0.9rem; margin:0; font-weight:400;">
                                    🏢 {{ $locale === 'th' ? 'ผู้นำด้านเทคโนโลยีฟาร์มปิด EVAP' : 'Leader in EVAP Closed Farm Technology' }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ VISION & MISSION ══════════════ --}}
<section style="padding:90px 0; background: linear-gradient(180deg, #f8fafb 0%, #eef2f5 100%);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-heading" style="margin-bottom:10px;">{{ __('messages.vision') }} & {{ __('messages.mission') }}</h2>
        </div>

        <div class="row g-4">
            {{-- Vision --}}
            <div class="col-lg-5">
                <div class="cp-vision-card">
                    <div class="cp-vision-icon">
                        <i class="bi bi-eye text-success" style="font-size:1.8rem;"></i>
                    </div>
                    <h3 style="font-weight:500; color:var(--cfarm-green-dark); margin-bottom:20px; font-size:1.3rem;">
                        {{ __('messages.vision') }}
                    </h3>
                    <p style="font-size:1.15rem; font-weight:300; line-height:1.9; color:var(--cfarm-text); font-style:italic; position:relative; z-index:1;">
                        "{{ $getSetting('cp_vision') }}"
                    </p>
                </div>
            </div>

            {{-- Mission --}}
            <div class="col-lg-7">
                <div class="cp-mission-card">
                    <h3 style="font-weight:500; color:var(--cfarm-green-dark); margin-bottom:25px; font-size:1.3rem; padding-bottom:15px; border-bottom:2px solid rgba(46,125,50,0.08);">
                        <i class="bi bi-flag-fill text-warning me-2"></i> {{ __('messages.mission') }}
                    </h3>

                    @php $mNum = 0; @endphp
                    @for($i = 1; $i <= 9; $i++)
                        @php $mt = $getSetting('cp_mission_'.$i); @endphp
                        @if(!empty(trim($mt)))
                            @php $mNum++; @endphp
                            <div class="cp-mission-item">
                                <div class="cp-mission-num">{{ $mNum }}</div>
                                <p style="margin:0; font-weight:300; color:var(--cfarm-text-light); line-height:1.7; font-size:0.98rem;">
                                    {{ $mt }}
                                </p>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

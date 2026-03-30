@extends('layouts.app')
@section('title', 'CFARM - นักลงทุนสัมพันธ์ | ชูวิทย์ฟาร์ม (2019)')
@section('meta_description', 'บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) CFARM นักลงทุนสัมพันธ์ ธุรกิจฟาร์มเลี้ยงไก่พันธุ์เนื้อ')

@section('content')

{{-- ══════════════ 1. Hero Banner (Redesigned) ══════════════ --}}
<section class="hero-ir position-relative overflow-hidden d-flex align-items-center justify-content-center" style="min-height: 85vh; background: #000;">
    <!-- Hero Background: Video / Image / Gradient -->
    @if(!empty($heroMedia) && Str::endsWith($heroMedia, ['.mp4', '.webm', '.mov']))
        <video class="position-absolute w-100 h-100" style="top:0; left:0; object-fit:cover; z-index:0;" autoplay muted loop playsinline>
            <source src="{{ Storage::url($heroMedia) }}" type="video/{{ pathinfo($heroMedia, PATHINFO_EXTENSION) }}">
        </video>
        <div class="position-absolute w-100 h-100" style="top:0; left:0; background: rgba(0,0,0,0.45); z-index:0;"></div>
    @elseif(!empty($heroMedia))
        <div class="position-absolute w-100 h-100" style="top:0; left:0; background: url('{{ Storage::url($heroMedia) }}') center/cover no-repeat; z-index: 0;"></div>
        <div class="position-absolute w-100 h-100" style="top:0; left:0; background: rgba(0,0,0,0.35); z-index:0;"></div>
    @else
        <div class="position-absolute w-100 h-100" style="top:0; left:0; background: linear-gradient(135deg, #0a2e13 0%, #1b5e20 50%, #2e7d32 100%); z-index: 0;"></div>
    @endif
    
    <!-- Animated Light Orbs -->
    <div class="position-absolute w-100 h-100 overflow-hidden" style="top:0; left:0; z-index: 1;">
        <div class="position-absolute rounded-circle" style="width: 600px; height: 600px; background: radial-gradient(circle, rgba(76,175,80,0.4) 0%, rgba(0,0,0,0) 70%); top: -20%; left: -10%; animation: pulseOrb 8s infinite alternate ease-in-out;"></div>
        <div class="position-absolute rounded-circle" style="width: 500px; height: 500px; background: radial-gradient(circle, rgba(165,214,167,0.3) 0%, rgba(0,0,0,0) 70%); bottom: -20%; right: -10%; animation: pulseOrb 10s infinite alternate-reverse ease-in-out;"></div>
    </div>
    
    <!-- Grid Pattern Overlay -->
    <div class="position-absolute w-100 h-100" style="top:0; left:0; background-image: linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 50px 50px; z-index: 2; opacity: 0.5;"></div>

    <div class="container position-relative z-3 text-center text-white pb-5">
        <span class="badge bg-white bg-opacity-25 text-white border border-light border-opacity-50 px-4 py-2 rounded-pill fw-medium tracking-widest mb-4 slide-up" style="backdrop-filter: blur(10px); animation: fadeInUp 0.8s ease forwards;">CHUWIT FARM (2019) PCL.</span>
        
        <h1 class="display-2 fw-bold mb-4 slide-up" style="animation: fadeInUp 0.8s ease 0.2s forwards; opacity: 0; text-shadow: 0 10px 30px rgba(0,0,0,0.5); letter-spacing: -2px;">
            นักลงทุนสัมพันธ์
        </h1>
        
        <p class="lead fw-light mb-5 mx-auto slide-up" style="max-width: 700px; animation: fadeInUp 0.8s ease 0.4s forwards; opacity: 0; color: rgba(255,255,255,0.85); font-size: 1.3rem;">
            มุ่งมั่นสร้างการเติบโตอย่างยั่งยืน ด้วยหลักธรรมาภิบาลและความโปร่งใส<br>เพื่อผลตอบแทนที่มั่นคงแด่ผู้ถือหุ้น
        </p>
        
        <div class="d-flex justify-content-center gap-3 slide-up" style="animation: fadeInUp 0.8s ease 0.6s forwards; opacity: 0;">
            <a href="#stock-info" class="btn btn-success btn-lg rounded-pill px-5 border-0 hover-scale shadow-lg" style="background: linear-gradient(45deg, #2e7d32, #4caf50);">ข้อมูลหุ้น <i class="bi bi-graph-up-arrow ms-2"></i></a>
            <a href="{{ route('documents.index') }}" class="btn btn-outline-light btn-lg rounded-pill px-5 hover-scale" style="backdrop-filter: blur(5px);">ศูนย์รวมเอกสาร <i class="bi bi-file-earmark-text ms-2"></i></a>
        </div>
    </div>
    
    <!-- Scroll Down Indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x pb-4 z-3 text-center slide-up" style="animation: fadeInUp 0.8s ease 1s forwards; opacity: 0;">
        
        <div class="text-white opacity-50 mx-auto" style="animation: bounce 2s infinite;">
            <i class="bi bi-chevron-down fs-4"></i>
        </div>
    </div>
</section>

{{-- ══════════════ 2. Floating Stock Widget (Redesigned) ══════════════ --}}
<section id="stock-info" class="position-relative z-4" style="margin-top: -60px;">
    <div class="container reveal">
        <div class="card border-0 rounded-4 overflow-hidden" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); box-shadow: 0 20px 50px rgba(0,0,0,0.1); border: 1px solid rgba(255,255,255,0.7);">
            <div class="card-body p-5">
                <div class="row align-items-center">
                    
                    {{-- 2.1 Logo & Symbol --}}
                    <div class="col-lg-3 col-md-6 text-center text-lg-start mb-4 mb-lg-0 border-end-lg" style="border-color: rgba(0,0,0,0.05) !important;">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3 shadow-sm" style="width: 70px; height: 70px;">
                            <img src="/images/cfarm-logo.png" alt="CFARM Logo" style="max-width: 50px; object-fit: contain;">
                        </div>
                        <h4 class="fw-bold text-dark mb-0 tracking-widest">CFARM</h4>
                        <span class="text-muted small">SET : mai</span>
                    </div>

                    {{-- 2.2 Current Price --}}
                    <div class="col-lg-3 col-md-6 text-center mb-4 mb-lg-0 border-end-lg" style="border-color: rgba(0,0,0,0.05) !important;">
                        <span class="text-muted small text-uppercase tracking-wider fw-medium mb-2 d-block">ราคาล่าสุด</span>
                        <div class="d-flex align-items-baseline justify-content-center">
                            <span id="price_val" class="display-4 fw-bold text-dark skeleton" style="line-height: 1; letter-spacing: -1px;">-</span>
                            <span class="fs-5 text-muted ms-2 fw-light">THB</span>
                        </div>
                    </div>

                    {{-- 2.3 Change & Volume --}}
                    <div class="col-lg-4 text-center text-lg-start ps-lg-4 mb-4 mb-lg-0">
                        <div class="row g-3">
                            <div class="col-6">
                                <span class="text-muted small text-uppercase tracking-wider fw-medium mb-2 d-block">{{ __('messages.change') }}</span>
                                <div id="change_badge" class="badge rounded-pill px-3 py-2 fs-6 skeleton transition-all" style="background: #f1f3f5; color: #6c757d;">
                                    <i></i> <span id="change_val">-</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <span class="text-muted small text-uppercase tracking-wider fw-medium mb-2 d-block">{{ __('messages.volume_shares') ?? 'Volume' }}</span>
                                <div class="badge bg-light text-dark rounded-pill px-3 py-2 fs-6 border skeleton" id="vol_val">-</div>
                            </div>
                        </div>
                        <div class="mt-3 text-muted small">
                            <i class="bi bi-clock me-1"></i> <span id="update_val" class="skeleton">-</span>
                        </div>
                    </div>

                    {{-- 2.4 Action Button --}}
                    <div class="col-lg-2 text-center text-lg-end pt-3 pt-lg-0 border-top-sm pt-sm-4 border-top-lg-0">
                        <a href="https://www.set.or.th/th/market/product/stock/quote/CFARM/price" target="_blank" class="btn btn-outline-success rounded-circle hover-scale d-inline-flex align-items-center justify-content-center pulse-btn" style="width: 60px; height: 60px;">
                            <i class="bi bi-graph-up fs-4"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Real-time Stock Script Wrapper (Retained from existing code) --}}
<script>
    (function() {
        document.addEventListener("DOMContentLoaded", () => {
            const url = "https://script.googleusercontent.com/macros/echo?user_content_key=84qPSD3vwws0xpynuC0ayFfARbeICJP65PisFOjVYanlF43CPt7e-4EftsnvWHo5Z8PKsYjt4kuOyxo6G3ULmPLdAW8dJsAlm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnO06LR84Rl_AHj5xhB3X670Zl-fAbPXWoLLOOOyQ-naLBJzsOEHdTv1rGsQ0mw7jLnbMIpil8Bn9HZ9cLpmm2Y4xSQEBFyVHRdz9Jw9Md8uu&lib=MLhEypUg6JfsJzQcL-r3-yMmKhE6OkvAQ";

            const priceEl = document.getElementById("price_val");
            const changeBadge = document.getElementById("change_badge");
            const changeVal = document.getElementById("change_val");
            const volEl = document.getElementById("vol_val");
            const updateEl = document.getElementById("update_val");
            const iconEl = changeBadge.querySelector("i");

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (!data || !data.data || !data.data[0]) return;

                    const { A: price, B: change, C: volume, D: updated } = data.data[0];

                    [priceEl, changeBadge, volEl, updateEl].forEach(el => el.classList.remove('skeleton'));

                    const volumeStr = String(volume).replace(/,/g, '');
                    const formattedVolume = Number(volumeStr).toLocaleString('th-TH');
                    
                    const date = new Date(updated);
                    let year = date.getFullYear();
                    if (year < 2500) { year += 543; } 
                    
                    const formattedDate = date.toLocaleString('th-TH', {
                        day: 'numeric', month: 'short', year: '2-digit',
                        hour: '2-digit', minute: '2-digit'
                    });

                    priceEl.textContent = price;
                    volEl.textContent = formattedVolume === 'NaN' ? volume : formattedVolume;
                    updateEl.textContent = formattedDate;

                    const changeStr = String(change).replace(/,/g, '');
                    const changeNum = parseFloat(changeStr);
                    const displayChange = changeNum > 0 ? `+${change}` : change;
                    changeVal.textContent = displayChange;

                    iconEl.className = ""; 

                    if (changeNum > 0) {
                        changeBadge.style.background = 'rgba(76, 175, 80, 0.15)';
                        changeBadge.style.color = '#2e7d32';
                        changeBadge.style.border = '1px solid rgba(76, 175, 80, 0.3)';
                        iconEl.classList.add('bi', 'bi-caret-up-fill', 'me-1');
                    } else if (changeNum < 0) {
                        changeBadge.style.background = 'rgba(244, 67, 54, 0.15)';
                        changeBadge.style.color = '#c62828';
                        changeBadge.style.border = '1px solid rgba(244, 67, 54, 0.3)';
                        iconEl.classList.add('bi', 'bi-caret-down-fill', 'me-1');
                    } else {
                        changeBadge.style.background = '#f1f3f5';
                        changeBadge.style.color = '#6c757d';
                        changeBadge.style.border = '1px solid #e9ecef';
                        iconEl.classList.add('bi', 'bi-dash', 'me-1');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    priceEl.textContent = "N/A";
                    [priceEl, changeBadge, volEl, updateEl].forEach(el => el.classList.remove('skeleton'));
                });
        });
    })();
</script>

{{-- ══════════════ 3. Business Overview (Redesigned) ══════════════ --}}
<section class="py-6 position-relative z-1" style="background-image: radial-gradient(rgba(0,0,0,0.03) 1px, transparent 1px); background-size: 30px 30px;">
    @php
        $revenueStructures = App\Models\RevenueStructure::ordered()->get();
        $colorMap = ['primary' => '#0d6efd', 'success' => '#2e7d32', 'warning' => '#ffcc00', 'danger' => '#dc3545', 'info' => '#0dcaf0', 'dark' => '#212529'];
        $chartLabels = $revenueStructures->pluck('title')->toArray();
        $chartData = $revenueStructures->pluck('percentage')->toArray();
        $chartColors = $revenueStructures->map(fn($s) => $colorMap[$s->color ?? 'primary'] ?? '#2e7d32')->toArray();
    @endphp

    <div class="container py-5">
        <div class="text-center mb-5 reveal">
            <span class="text-success fw-bold tracking-widest text-uppercase small">{{ __('messages.revenue') ?? 'Revenue Structure' }}</span>
            <h2 class="display-5 fw-bold text-dark mt-2">{{ __('messages.business_overview') }}</h2>
            <div class="mx-auto bg-success rounded-pill mt-3" style="width: 60px; height: 4px;"></div>
        </div>

        <div class="row align-items-center g-5">
            {{-- Chart Side --}}
            <div class="col-lg-5 position-relative text-center reveal delay-1">
                <!-- Decorative Glow Behind Chart -->
                <div class="position-absolute rounded-circle" style="width: 350px; height: 350px; background: rgba(76,175,80,0.1); filter: blur(50px); top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 0Pointer-events: none;"></div>
                
                <div class="position-relative mx-auto chart-container" style="width: 350px; height: 350px; z-index: 1;">
                    <canvas id="revenueChart"></canvas>
                    <div class="position-absolute w-100 text-center" style="top: 50%; transform: translateY(-50%); pointer-events: none;">
                        <span class="d-block fs-6 text-muted fw-medium tracking-widest mb-1">CFARM</span>
                        <span class="d-block fs-2 fw-bold text-dark lh-1">100%</span>
                    </div>
                </div>
            </div>
            
            {{-- Details Side --}}
            <div class="col-lg-7 ps-lg-5 reveal delay-2">
                <div class="bg-white p-5 rounded-4 shadow-sm border" style="border-radius: 24px !important;">
                    <h4 class="fw-bold mb-4" style="color: #1b5e20;">{{ __('messages.core_revenue_structure') }}</h4>
                    
                    <div class="revenue-list">
                        @foreach($revenueStructures as $index => $structure)
                        <div class="revenue-item d-flex align-items-center p-3 mb-3 rounded-3 transition-all cursor-pointer group-hover-effect border border-transparent hover-border">
                            <div class="flex-shrink-0 position-relative">
                                <!-- Colored Dot indicator based on chart color -->
                                <div class="position-absolute rounded-circle" style="width: 12px; height: 12px; top: 18px; left: -25px; background-color: {{ $chartColors[$index] }}; box-shadow: 0 0 10px {{ $chartColors[$index] }}80;"></div>
                                
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center border group-hover-bg" style="width: 50px; height: 50px; color: {{ $chartColors[$index] }};">
                                    <x-revenue-structure-icon :icon="$structure->icon_class" class="fs-4" style="width: 1em; height: 1em;" />
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3" style="min-width: 0;">
                                <h6 class="fw-bold mb-1 text-dark group-hover-text text-truncate">{{ $structure->title }}</h6>
                                <p class="text-muted mb-0 small text-truncate">{{ Str::limit($structure->description, 60) }}</p>
                            </div>
                            <div class="ms-3 text-end ps-3 border-start">
                                <span class="fs-4 fw-bold" style="color: {{ $chartColors[$index] }};">{{ $structure->percentage }}<span class="fs-6">%</span></span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ 3.5 Business Video ══════════════ --}}
@if(isset($youtubeId) && $youtubeId)
<section class="py-5 bg-white position-relative border-top z-1">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 reveal">
                <div class="ratio ratio-16x9 rounded-4 shadow-lg overflow-hidden position-relative" style="border: 1px solid rgba(0,0,0,0.05); background: #000;">
                    <!-- Decorative Element -->
                    <div class="position-absolute w-100 h-100 pe-none" style="background: url('data:image/svg+xml;utf8,<svg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'><circle cx=\'2\' cy=\'2\' r=\'1\' fill=\'rgba(255,255,255,0.05)\'/></svg>'); z-index: 1;"></div>
                    
                    <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}?autoplay=1&mute=1&rel=0&loop=1&playlist={{ $youtubeId }}" title="CFARM Business Overview Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="z-index: 2; width: 100%; height: 100%; position: absolute; top: 0; left: 0;"></iframe>
                </div>
            </div>
            
            <div class="col-lg-5 reveal delay-1 text-center text-lg-start">
                <div class="mb-4 d-inline-flex align-items-center bg-white rounded-pill px-3 py-2 border shadow-sm" style="transform: translateY(0); transition: transform 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
                    <!-- Pulsing Dot effect -->
                    <div class="spinner-grow text-danger me-2" role="status" style="width: 0.8rem; height: 0.8rem; animation-duration: 1.5s;">
                        <span class="visually-hidden">Plating...</span>
                    </div>
                    <!-- Premium Gradient Text -->
                    <span class="fw-light text-uppercase" style="background: linear-gradient(135deg, #198754 0%, #0dcaf0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: 1.5px; font-size: 0.85rem;">
                        CFARM Corporate VDO
                    </span>
                </div>
                <div class="position-relative z-1">
                    <h5 class="fw-light mb-0 text-dark" style="line-height: 1.8;">
                        {{ App\Models\Setting::where('key', 'home_business_company_desc')->first()?->value ?? __('messages.company_desc_short') }}
                    </h5>
                </div>
                <div class="mt-4 pt-3 border-top d-inline-block d-lg-block">
                    <a href="{{ route('company.profile') }}" class="btn btn-outline-success border-2 rounded-pill px-4 fw-bold hover-scale shadow-sm">
                        {{ __('messages.view_company_profile') ?? 'ทำความรู้จักเรามากขึ้น' }} <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<section class="py-5 bg-white position-relative border-top z-1">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center reveal">
                <div class="d-flex position-relative justify-content-center">
                    <i class="bi bi-quote fs-1 text-success opacity-25 position-absolute" style="top: -20px; left: -20px;"></i>
                    <p class="mb-0 text-muted fst-italic position-relative z-1" style="line-height: 1.8; font-size: 1.25rem;">
                        {{ App\Models\Setting::where('key', 'home_business_company_desc')->first()?->value ?? __('messages.company_desc_short') }}
                    </p>
                    <i class="bi bi-quote fs-1 text-success opacity-25 position-absolute" style="bottom: -15px; right: -20px; transform: scaleX(-1);"></i>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Chart.js Initialization --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        // Custom plugin for subtle shadow
        const shadowPlugin = {
            id: 'shadowPlugin',
            beforeDraw: (chart) => {
                const { ctx } = chart;
                ctx.save();
                ctx.shadowColor = 'rgba(0, 0, 0, 0.15)';
                ctx.shadowBlur = 20;
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 15;
            },
            afterDraw: (chart) => { chart.ctx.restore(); }
        };

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: {!! json_encode($chartColors) !!},
                    borderWidth: 4,
                    borderColor: '#ffffff',
                    hoverOffset: 15,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                layout: { padding: 20 },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.98)',
                        titleColor: '#1b5e20',
                        bodyColor: '#333',
                        borderColor: 'rgba(0,0,0,0.1)',
                        borderWidth: 1,
                        padding: 15,
                        boxPadding: 6,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        callbacks: {
                            label: function(context) { return ` ${context.raw}%`; }
                        }
                    }
                },
                animation: { animateScale: true, animateRotate: true, duration: 2500, easing: 'easeOutQuart' }
            },
            plugins: [shadowPlugin]
        });
    });
</script>

{{-- ══════════════ 4. Financial Highlights (Redesigned) ══════════════ --}}
<section class="py-6 bg-light position-relative">
    <!-- Slanted Top Edge Decor -->
    <div class="position-absolute w-100 bg-white" style="height: 50px; top: -1px; left: 0; clip-path: polygon(0 0, 100% 0, 100% 100%, 0 0);"></div>

    <div class="container py-5">
        <div class="text-center mb-5 reveal">
            <h2 class="display-5 fw-bold text-dark">{{ __('messages.financial_highlights') }}</h2>
            <div class="mx-auto bg-success rounded-pill mt-3 mb-5" style="width: 60px; height: 4px;"></div>
        </div>

        {{-- 4.1 Number Counters --}}
        <div class="row justify-content-center g-4 mb-5 pb-4 border-bottom">
            <div class="col-md-4 reveal delay-1">
                <div class="card border-0 bg-white shadow-sm rounded-4 h-100 hover-lift text-center p-4">
                    <div class="icon-circle bg-success bg-opacity-10 text-success mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px;">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>
                    <span class="text-muted small text-uppercase tracking-widest fw-medium mb-2 d-block">{{ __('messages.registered_capital') }}</span>
                    <div class="d-flex align-items-center justify-content-center">
                        <h2 class="display-4 fw-bold text-dark mb-0 counter-value" data-target="{{ $fh->get('fh_registered_capital')?->value_th ?? '580' }}">0</h2>
                        <span class="fs-6 text-muted ms-2 mt-3">{{ __('messages.million_thb') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 reveal delay-2">
                <div class="card border-0 bg-success text-white shadow-lg rounded-4 h-100 hover-lift text-center p-4" style="background: linear-gradient(135deg, #2e7d32, #1b5e20);">
                    <div class="icon-circle bg-white bg-opacity-25 text-white mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px;">
                        <i class="bi bi-shield-check fs-3"></i>
                    </div>
                    <span class="text-white-50 small text-uppercase tracking-widest fw-medium mb-2 d-block">{{ __('messages.paid_up_capital') }}</span>
                    <div class="d-flex align-items-center justify-content-center">
                        <h2 class="display-4 fw-bold text-white mb-0 counter-value" data-target="{{ $fh->get('fh_paid_up_capital')?->value_th ?? '580' }}">0</h2>
                        <span class="fs-6 text-white-50 ms-2 mt-3">{{ __('messages.million_thb') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 reveal delay-3">
                <div class="card border-0 bg-white shadow-sm rounded-4 h-100 hover-lift text-center p-4">
                    <div class="icon-circle bg-warning bg-opacity-10 text-warning mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px;">
                        <i class="bi bi-buildings fs-3"></i>
                    </div>
                    <span class="text-muted small text-uppercase tracking-widest fw-medium mb-2 d-block">{{ __('messages.number_of_farms') }}</span>
                    <div class="d-flex align-items-center justify-content-center">
                        <h2 class="display-4 fw-bold text-dark mb-0 counter-value" data-target="{{ $fh->get('fh_farms_count')?->value_th ?? '8' }}">0</h2>
                        <span class="fs-6 text-muted ms-2 mt-3">{{ __('messages.evap_farms') ?? 'Farms' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4.2 Alpine.js Interactive Chart --}}
        <div class="row align-items-center pt-4 reveal delay-2" x-data="{
            activeTab: 'revenue',
            years: ['{{ $fh->get('fh_year_1')?->value_th ?? '2566' }}', '{{ $fh->get('fh_year_2')?->value_th ?? '2567' }}', '{{ $fh->get('fh_year_3')?->value_th ?? '2568' }}'],
            data: {
                'revenue': { values: [{{ $fh->get('fh_revenue_1')?->value_th ?? '240.99' }}, {{ $fh->get('fh_revenue_2')?->value_th ?? '224.31' }}, {{ $fh->get('fh_revenue_3')?->value_th ?? '210.72' }}], max: 250, label: '{{ __('messages.total_revenue') }}', color: '2e7d32' },
                'profit': { values: [{{ $fh->get('fh_profit_1')?->value_th ?? '30.49' }}, {{ $fh->get('fh_profit_2')?->value_th ?? '10.14' }}, {{ $fh->get('fh_profit_3')?->value_th ?? '10.85' }}], max: 40, label: '{{ __('messages.net_profit') }}', color: '1565c0' },
                'assets': { values: [{{ $fh->get('fh_assets_1')?->value_th ?? '730.13' }}, {{ $fh->get('fh_assets_2')?->value_th ?? '869.87' }}, {{ $fh->get('fh_assets_3')?->value_th ?? '840.42' }}], max: 900, label: '{{ __('messages.total_assets') }}', color: 'f57f17' }
            }
        }">
            <div class="col-lg-4 mb-4 mb-lg-0 pe-lg-5">
                <h3 class="fw-bold mb-4">{{ __('messages.financial_highlights') ?? 'Financial Performance' }}</h3>
                <p class="text-muted mb-4">Explore our consistent financial performance across the past three years. Select a key indicator below to update the chart.</p>
                
                <div class="nav flex-column nav-pills custom-v-pills gap-2">
                    <button class="nav-link text-start py-3 px-4 rounded-3 border fw-medium d-flex justify-content-between align-items-center transition-all bg-white" 
                            :class="{ 'active-revenue shadow-sm border-success text-success': activeTab === 'revenue' }" 
                            @click="activeTab = 'revenue'">
                        <span><i class="bi bi-graph-up me-2"></i> {{ __('messages.total_revenue') }}</span>
                        <i class="bi" :class="activeTab === 'revenue' ? 'bi-chevron-right' : 'bi-dash'"></i>
                    </button>
                    <button class="nav-link text-start py-3 px-4 rounded-3 border fw-medium d-flex justify-content-between align-items-center transition-all bg-white" 
                            :class="{ 'active-profit shadow-sm border-primary text-primary': activeTab === 'profit' }" 
                            @click="activeTab = 'profit'">
                        <span><i class="bi bi-cash-coin me-2"></i> {{ __('messages.net_profit') }}</span>
                        <i class="bi" :class="activeTab === 'profit' ? 'bi-chevron-right' : 'bi-dash'"></i>
                    </button>
                    <button class="nav-link text-start py-3 px-4 rounded-3 border fw-medium d-flex justify-content-between align-items-center transition-all bg-white" 
                            :class="{ 'active-assets shadow-sm border-warning text-warning': activeTab === 'assets' }" 
                            @click="activeTab = 'assets'">
                        <span><i class="bi bi-bank me-2"></i> {{ __('messages.total_assets') }}</span>
                        <i class="bi" :class="activeTab === 'assets' ? 'bi-chevron-right' : 'bi-dash'"></i>
                    </button>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="card border-0 bg-white rounded-4 shadow-sm h-100 overflow-hidden">
                    <div class="card-header bg-transparent border-0 pt-4 pb-0 text-center">
                        <span class="fs-4 fw-bold text-dark" x-text="data[activeTab].values[2].toFixed(2)"></span>
                        <span class="text-muted"> {{ __('messages.million_thb') }}</span>
                        <p class="text-muted small mt-1" x-text="'Latest '+data[activeTab].label"></p>
                    </div>
                    <div class="card-body p-4 p-md-5 pt-0">
                        <div class="d-flex align-items-end justify-content-around" style="height: 250px; padding-top: 30px;">
                            <template x-for="(year, i) in years" :key="i">
                                <div class="bar-wrapper text-center w-25 group">
                                    <!-- Value Label -->
                                    <div class="mb-2 fw-medium text-dark opacity-100 transition-all font-monospace" 
                                         x-text="data[activeTab].values[i].toFixed(2)"></div>
                                    
                                    <!-- Bar -->
                                    <div class="mx-auto rounded-top-3 transition-all animate-bar shadow-sm"
                                         :style="`height: ${(data[activeTab].values[i] / data[activeTab].max) * 180}px; width: 60%; background: #${activeTab === 'revenue' ? (i===2 ? '2e7d32':'a5d6a7') : activeTab === 'profit' ? (i===2 ? '1565c0':'90caf9') : (i===2 ? 'f57f17':'ffe082')};`"></div>
                                    
                                    <!-- Year Label -->
                                    <div class="mt-3 text-muted fw-bold small transition-all" 
                                         :style="`color: #${i===2 ? data[activeTab].color : '6c757d'} !important;`" 
                                         x-text="year"></div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5 pt-3 reveal delay-3">
            <a href="{{ route('financial.index') }}" class="btn btn-outline-success rounded-pill px-5 py-2 fw-medium hover-scale">
                {{ __('messages.view_full_financial_report') }} <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- Number Animation Script --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll('.counter-value');
        const speed = 200; 

        const animateCounters = () => {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(animateCounters, 1);
                } else {
                    counter.innerText = target;
                }
            });
        };

        // Observer to start animation when in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    });
</script>

{{-- ══════════════ 5. Document Center (Redesigned) ══════════════ --}}
<section class="py-6 position-relative">
    <div class="container py-5">
        <div class="row align-items-end mb-5 reveal">
            <div class="col-md-6">
                <!-- <span class="text-success fw-bold tracking-widest text-uppercase small">{{ __('messages.downloads') ?? 'Downloads' }}</span> -->
                <h2 class="display-6 fw-bold text-dark mt-2 mb-0">{{ __('messages.document_center') }}</h2>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0 d-none d-md-block">
                <a href="{{ route('documents.index') }}" class="btn btn-light rounded-pill px-4 hover-scale border shadow-sm">
                    {{ __('messages.view_all_documents') }} <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            {{-- Feature Card (Highlight Document) --}}
            <div class="col-lg-4 reveal delay-1">
                @if($highlightDocument)
                <div class="card h-100 border-0 rounded-4 overflow-hidden text-white hover-lift" style="background: linear-gradient(135deg, #1b5e20, #388e3c); box-shadow: 0 15px 35px rgba(46,125,50,0.2);">
                    <div class="position-absolute w-100 h-100" style="background: url('data:image/svg+xml;utf8,<svg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'><circle cx=\'2\' cy=\'2\' r=\'1\' fill=\'rgba(255,255,255,0.1)\'/></svg>');"></div>
                    
                    <div class="card-body p-5 d-flex flex-column position-relative z-1">
                        <div class="d-flex justify-content-between align-items-start mb-auto">
                            <span class="badge bg-white text-success rounded-pill px-3 py-2 fw-bold">HIGHLIGHT</span>
                            <i class="bi bi-journal-bookmark-fill fs-2 text-white-50"></i>
                        </div>
                        
                        <div class="mt-5 pt-3">
                            <h3 class="fw-bold mb-2">{{ app()->getLocale() === 'th' ? $highlightDocument->title_th : $highlightDocument->title_en }}</h3>
                            <p class="text-white opacity-75 mb-4">{{ $highlightDocument->category ? (app()->getLocale() === 'th' ? $highlightDocument->category->name_th : $highlightDocument->category->name_en) : '' }} {{ $highlightDocument->year ? $highlightDocument->year->year : '' }}</p>
                            
                            <a href="{{ route('documents.download', $highlightDocument->id) }}" class="btn btn-light w-100 rounded-pill fw-bold text-success hover-scale shadow" target="_blank">
                                <i class="bi bi-cloud-arrow-down-fill me-2"></i> {{ __('messages.download_pdf') }}
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Document List Cards --}}
            <div class="col-lg-8 reveal delay-2">
                <div class="row g-3">
                    @foreach($latestDocuments as $doc)
                    <div class="col-md-6">
                        <div class="card border-0 rounded-4 shadow-sm hover-lift bg-white h-100 p-2 border border-light">
                            <div class="card-body d-flex align-items-center p-3">
                                <div class="icon-square bg-success bg-opacity-10 text-success rounded-4 d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 60px; height: 60px;">
                                    @if(Str::contains(strtolower($doc->category ? $doc->category->name_en : ''), 'financial'))
                                        <i class="bi bi-file-earmark-bar-graph fs-3"></i>
                                    @elseif(Str::contains(strtolower($doc->category ? $doc->category->name_en : ''), 'presentation'))
                                        <i class="bi bi-file-earmark-slides fs-3"></i>
                                    @else
                                        <i class="bi bi-file-earmark-text fs-3"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold text-dark mb-1 text-truncate" style="max-width: 200px;" title="{{ app()->getLocale() === 'th' ? $doc->title_th : $doc->title_en }}">
                                        {{ app()->getLocale() === 'th' ? $doc->title_th : $doc->title_en }}
                                    </h6>
                                    <span class="text-muted small">
                                        {{ $doc->category ? (app()->getLocale() === 'th' ? $doc->category->name_th : $doc->category->name_en) : '' }} 
                                        {{ $doc->year ? $doc->year->year : '' }}
                                    </span>
                                </div>
                                <a href="{{ route('documents.download', $doc->id) }}" class="btn btn-sm btn-light rounded-circle text-success p-2 hover-bg-success" target="_blank" title="Download">
                                    <i class="bi bi-download fs-5 mx-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-center mt-4 d-block d-md-none reveal delay-3">
            <a href="{{ route('documents.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm border w-100 py-2">
                {{ __('messages.view_all_documents') }}
            </a>
        </div>
    </div>
</section>

{{-- ══════════════ 6. Latest News (Bento Grid) ══════════════ --}}
<section class="py-6 bg-light border-top">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-5 reveal">
            <div>
                <span class="text-success fw-bold tracking-widest text-uppercase small">Updates</span>
                <h2 class="display-6 fw-bold text-dark mt-2 mb-0">{{ __('messages.latest_news') }}</h2>
            </div>
            <a href="{{ route('news.index') }}" class="btn btn-outline-dark rounded-pill px-4 d-none d-md-inline-flex hover-scale">
                {{ __('messages.view_all_news') }} <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
        
        <div class="row g-4 bento-grid">
            @foreach($latestNews->take(3) as $index => $item)
                @if($index === 0)
                    {{-- 6.1 Featured Featured News (Large) --}}
                    <div class="col-lg-6 reveal delay-1">
                        <a href="{{ route('news.show', $item->slug) }}" class="card border-0 rounded-4 shadow-sm overflow-hidden text-decoration-none hover-lift h-100 bento-card text-white dark-overlay">
                            @if($item->image_path)
                                <img src="{{ Storage::url($item->image_path) }}" class="card-img h-100 object-fit-cover bento-img" alt="{{ $item->title_th }}">
                            @else
                                <div class="bg-dark h-100 w-100 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('images/logo.png') ?? '' }}" alt="CFARM" style="opacity: 0.2; width: 150px;">
                                </div>
                            @endif
                            <!-- Overlay Gradient -->
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-5" style="background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, transparent 100%);">
                                <span class="badge bg-success rounded-pill align-self-start mb-3 px-3 py-2 fw-medium border border-success border-opacity-50">LATEST</span>
                                <h3 class="card-title fw-bold text-white mb-2">{{ Str::limit($item->title_th, 80) }}</h3>
                                <p class="card-text text-white-50"><i class="bi bi-calendar3 me-2"></i> {{ $item->published_at?->format('d M Y') }}</p>
                            </div>
                        </a>
                    </div>
                @else
                    {{-- 6.2 Smaller News Cards --}}
                    <div class="col-lg-3 col-md-6 reveal delay-{{ $index + 1 }}">
                        <a href="{{ route('news.show', $item->slug) }}" class="card border-0 rounded-4 shadow-sm overflow-hidden text-decoration-none hover-lift h-100 d-flex flex-column bg-white">
                            <div class="position-relative overflow-hidden" style="height: 200px;">
                                @if($item->image_path)
                                    <img src="{{ Storage::url($item->image_path) }}" class="w-100 h-100 object-fit-cover hover-scale-img transition-all" alt="{{ $item->title_th }}">
                                @else
                                    <div class="bg-success bg-opacity-10 h-100 w-100 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-newspaper fs-1 text-success opacity-50"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <p class="card-text small text-muted mb-2"><i class="bi bi-calendar3 text-success me-2"></i> {{ $item->published_at?->format('d M Y') }}</p>
                                <h6 class="card-title fw-bold text-dark mb-0">{{ Str::limit($item->title_th, 60) }}</h6>
                                
                                <div class="mt-auto pt-3">
                                    <span class="text-success small fw-bold tracking-wider text-uppercase">Read More <i class="bi bi-arrow-right ms-1"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
        
        <div class="text-center mt-4 d-block d-md-none reveal delay-4">
            <a href="{{ route('news.index') }}" class="btn btn-outline-dark rounded-pill px-5 py-2 w-100">
                {{ __('messages.view_all_news') }}
            </a>
        </div>
    </div>
</section>



{{-- ══════════════ Global Custom Styles ══════════════ --}}
<style>
    /* Fonts & Typography */
    .tracking-wider { letter-spacing: 1px; }
    .tracking-widest { letter-spacing: 2px; }
    
    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes pulseOrb {
        0% { transform: scale(1) translate(0, 0); opacity: 0.5; }
        50% { transform: scale(1.2) translate(50px, -50px); opacity: 0.8; }
        100% { transform: scale(0.9) translate(-20px, 30px); opacity: 0.5; }
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(10px); }
    }

    .slide-up { opacity: 0; } /* Will be animated via inline styles */

    /* Scroll Reveal Classes (Handled by app.js or simple Intersection Observer below) */
    .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
    .reveal.active { opacity: 1; transform: translateY(0); }
    .delay-1 { transition-delay: 0.1s; }
    .delay-2 { transition-delay: 0.2s; }
    .delay-3 { transition-delay: 0.3s; }
    .delay-4 { transition-delay: 0.4s; }

    /* Interaction Utility Classes */
    .transition-all { transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); }
    .hover-scale { transition: transform 0.3s ease; }
    .hover-scale:hover { transform: scale(1.05); }
    .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-lift:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important; z-index: 10; }
    
    /* Specific hover effects */
    .hover-border:hover { border-color: var(--cfarm-green) !important; background-color: #f8fff9; }
    .group-hover-effect:hover .group-hover-bg { background-color: var(--cfarm-green) !important; color: white !important; border-color: transparent !important; }
    .group-hover-effect:hover .group-hover-text { color: var(--cfarm-green) !important; }
    
    .hover-bg-success:hover { background-color: var(--cfarm-green) !important; color: white !important; }
    .bg-white-hover:hover { background-color: white !important; color: var(--cfarm-green) !important; }
    
    .card:hover .hover-scale-img { transform: scale(1.1); }
    .cursor-pointer { cursor: pointer; }

    /* Custom Layouts */
    .py-6 { padding-top: 5rem; padding-bottom: 5rem; }
    .skeleton { background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeletonLoading 1.5s infinite; color: transparent !important; user-select: none; border-radius: 4px; }
    @keyframes skeletonLoading { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

    /* Bento Grid Overlay */
    .bento-card::after { content: ''; position: absolute; inset: 0; background: rgba(0,0,0,0.2); transition: background 0.3s ease; z-index: 0Pointer-events: none; }
    .bento-card:hover::after { background: transparent; }
    
    /* Responsive Borders */
    @media (min-width: 992px) {
        .border-end-lg { border-right: 1px solid rgba(0,0,0,0.1) !important; }
        .border-top-lg-0 { border-top: 0 !important; }
    }
    @media (max-width: 576px) {
        .border-top-sm { border-top: 1px solid rgba(0,0,0,0.1) !important; }
    }
</style>

{{-- Global Scroll Reveal Script --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const reveals = document.querySelectorAll(".reveal");

        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                    observer.unobserve(entry.target); // Only animate once
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px"
        });

        reveals.forEach(reveal => revealObserver.observe(reveal));
    });
</script>
@endsection

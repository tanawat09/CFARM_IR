@extends('layouts.app')
@section('title', 'โครงสร้างผู้ถือหุ้น - CFARM IR')
@section('content')

{{-- Hero Section for Shareholders --}}
<section class="page-hero position-relative overflow-hidden pt-5 pb-5">
    <!-- Premium Gradient Background -->
    <div class="position-absolute w-100 h-100" style="top:0; left:0; background: linear-gradient(135deg, #0f3e1b 0%, #1b5e20 40%, #2e7d32 100%); z-index: -2;"></div>
    
    <!-- Sophisticated Abstract Overlay -->
    <div class="position-absolute w-100 h-100 opacity-25" style="top:0; left:0; background: radial-gradient(circle at 80% 20%, rgba(255,255,255,0.15) 0%, transparent 40%), radial-gradient(circle at 20% 80%, rgba(76,175,80,0.2) 0%, transparent 50%); z-index: -1;"></div>
    
    <!-- Floating Particles -->
    <div class="particles-container position-absolute w-100 h-100" style="top:0; left:0; z-index: 0; pointer-events: none;">
        @for($i=0; $i<10; $i++)
            <div class="particle bg-white rounded-circle position-absolute" style="width: {{ rand(3, 8) }}px; height: {{ rand(3, 8) }}px; opacity: {{ rand(10, 40)/100 }}; top: {{ rand(10, 90) }}%; left: {{ rand(10, 90) }}%; animation: floatParticle {{ rand(10, 20) }}s infinite linear {{ rand(0, 5) }}s;"></div>
        @endfor
    </div>

    <div class="container position-relative z-1 text-center py-5 mt-5">
        <span class="badge bg-white text-success px-4 py-2 rounded-pill fw-medium tracking-wide mb-3 slide-up" style="letter-spacing: 2px; font-size: 0.85rem; animation: fadeInUp 0.8s ease forwards; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">INVESTOR RELATIONS</span>
        <h1 class="display-3 fw-bold mb-3 text-white slide-up" style="animation: fadeInUp 0.8s ease 0.1s forwards; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">{{ __('messages.shareholding_structure') }}</h1>
        <p class="lead fw-light text-white opacity-75 slide-up mx-auto" style="max-width: 600px; animation: fadeInUp 0.8s ease 0.2s forwards; opacity:0;">{{ session('locale') == 'en' ? 'Transparency and structure of our major shareholders.' : 'โครงสร้างและสัดส่วนของผู้ถือหุ้นรายใหญ่ของเรา' }}</p>
    </div>
</section>

{{-- Stats Summary Section --}}
<section class="position-relative" style="margin-top: -40px; z-index: 10;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 rounded-4 overflow-hidden" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); box-shadow: 0 15px 35px rgba(0,0,0,0.06); border: 1px solid rgba(255,255,255,0.4);">
                    <div class="card-body p-0">
                        <div class="row g-0 text-center">
                            <!-- Detail 1 -->
                            <div class="col-md-4 py-4 px-3 position-relative stat-box">
                                <div class="text-success mb-2"><i class="fas fa-chart-pie fs-3 opacity-75"></i></div>
                                <div class="text-muted small fw-medium mb-1 text-uppercase tracking-wider">{{ __('messages.paid_capital_label') }}</div>
                                <h3 class="fw-bold text-dark mb-0 number-font">580<span class="fs-5 text-muted fw-normal ms-1">M {{ __('messages.thb') }}</span></h3>
                                <div class="position-absolute h-75 border-end d-none d-md-block" style="top: 12.5%; right: 0; border-color: rgba(0,0,0,0.05)!important;"></div>
                            </div>
                            
                            <!-- Detail 2 -->
                            <div class="col-md-4 py-4 px-3 position-relative stat-box">
                                <div class="text-success mb-2"><i class="fas fa-crown fs-3 opacity-75"></i></div>
                                <div class="text-muted small fw-medium mb-1 text-uppercase tracking-wider">{{ __('messages.top_1_shareholder') }}</div>
                                <h4 class="fw-bold text-dark mb-0 text-truncate px-2" title="{{ session('locale') == 'en' && !empty($shareholders->first()?->shareholder_name_en) ? $shareholders->first()->shareholder_name_en : ($shareholders->first()?->shareholder_name_th ?? '-') }}">
                                    {{ session('locale') == 'en' && !empty($shareholders->first()?->shareholder_name_en) ? $shareholders->first()->shareholder_name_en : ($shareholders->first()?->shareholder_name_th ?? '-') }}
                                </h4>
                                <div class="position-absolute h-75 border-end d-none d-md-block" style="top: 12.5%; right: 0; border-color: rgba(0,0,0,0.05)!important;"></div>
                            </div>
                            
                            <!-- Detail 3 -->
                            <div class="col-md-4 py-4 px-3 stat-box">
                                <div class="text-success mb-2"><i class="fas fa-calendar-check fs-3 opacity-75"></i></div>
                                <div class="text-muted small fw-medium mb-1 text-uppercase tracking-wider">{{ __('messages.as_of_date') }}</div>
                                <h4 class="fw-bold text-dark mb-0 border-bottom border-success border-2 d-inline-block pb-1 number-font">{{ $shareholders->first()?->as_of_date?->addYears(session('locale') == 'th' ? 543 : 0)->format('d M Y') ?? '14 Mar 2025' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: linear-gradient(180deg, #f8fafc 0%, #eef2f6 100%);">
    <div class="container py-5">
        
        <div class="row g-5 align-items-center mb-5 reveal">
            {{-- Modern Interactive Chart Side --}}
            <div class="col-lg-5 text-center position-relative">
                <!-- Decorative Elements -->
                <div class="position-absolute bg-success rounded-circle blur-element" style="width: 250px; height: 250px; top: 50%; left: 50%; transform: translate(-50%, -50%); filter: blur(60px); opacity: 0.15; z-index: 0;"></div>
                
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative z-1" style="background: rgba(255,255,255,0.85); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.6) !important;">
                    <div class="card-body p-5 chart-container">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0 text-dark">{{ __('messages.major_shareholders_proportion') }}</h5>
                            <button class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border" onclick="animateChart()"><i class="fas fa-sync-alt text-success"></i></button>
                        </div>
                        <div class="position-relative mx-auto" style="width: 320px; height: 320px;">
                            <!-- Center Text Overlay for Chart -->
                            <div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center" style="top: 0; left: 0; z-index: 0; pointer-events: none;">
                                <img src="{{ asset('images/cfarm-logo.png') }}" alt="CFARM Logo" class="chart-center-logo" style="max-width: 130px; opacity: 0.95;">
                            </div>
                            <canvas id="shareholderChart" class="position-relative z-1"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Engaging Content Side --}}
            <div class="col-lg-7 ps-lg-5">
                <div class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-3 fw-medium border border-success border-opacity-25">
                    <i class="fas fa-info-circle me-2"></i> {{ session('locale') == 'en' ? 'Shareholding Data' : 'ข้อมูลสัดส่วนผู้ถือหุ้น' }}
                </div>
                <h2 class="fw-bold mb-4 text-dark" style="line-height: 1.3;">{{ session('locale') == 'en' ? 'Transparent Ownership Structure for Sustainable Growth' : 'โครงสร้างความเป็นเจ้าของที่โปร่งใสเพื่อการเติบโตอย่างยั่งยืน' }}</h2>
                <p class="text-muted fs-5 mb-5" style="line-height: 1.8;">
                    {{ __('messages.major_shareholders_desc') }}
                </p>
                
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start benefit-item p-3 rounded-4 transition-all">
                            <div class="icon-box bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center text-success flex-shrink-0" style="width: 50px; height: 50px;">
                                <i class="fas fa-hand-holding-usd fs-5"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold text-dark mb-1">{{ session('locale') == 'en' ? 'Stable Foundation' : 'รากฐานที่มั่นคง' }}</h6>
                                <p class="text-muted small mb-0">{{ session('locale') == 'en' ? 'Strong backing from major stakeholders.' : 'การสนับสนุนที่แข็งแกร่งจากผู้มีส่วนได้ส่วนเสียหลัก' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start benefit-item p-3 rounded-4 transition-all">
                            <div class="icon-box bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center text-success flex-shrink-0" style="width: 50px; height: 50px;">
                                <i class="fas fa-shield-alt fs-5"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold text-dark mb-1">{{ session('locale') == 'en' ? 'High Governance' : 'ธรรมาภิบาลสูง' }}</h6>
                                <p class="text-muted small mb-0">{{ session('locale') == 'en' ? 'Committed to SET transparent guidelines.' : 'มุ่งมั่นปฏิบัติตามแนวทางที่โปร่งใสของตลท.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Beautiful Ranking List Section --}}
        <div class="mt-5 pt-4 reveal delay-1">
            <div class="d-flex justify-content-between align-items-end mb-4 px-2">
                <div>
                    <h3 class="fw-bold text-dark mb-1">{{ __('messages.top_12_shareholders') }}</h3>
                    <p class="text-muted mb-0">List of major shareholders descending by ownership percentage.</p>
                </div>
            </div>

            <div class="ranking-container bg-white p-4 rounded-4 shadow-sm border-0 position-relative z-1">
                @foreach($shareholders as $i => $sh)
                    <div class="shareholder-row d-flex align-items-center p-3 mb-3 bg-light rounded-4 transition-all position-relative overflow-hidden group-hover-effect">
                        <!-- Progress Bar Background based on percentage -->
                        <div class="position-absolute h-100 top-0 left-0 bg-success bg-opacity-10 transition-all row-progress" style="width: {{ $i === 0 ? '100%' : ($sh->percentage * 1.5) . '%' }}; z-index: 0;"></div>
                        
                        <div class="position-relative z-1 d-flex w-100 align-items-center flex-wrap flex-md-nowrap">
                            <!-- Rank -->
                            <div class="pe-4 flex-shrink-0 text-center" style="width: 60px;">
                                @if($i === 0)
                                    <div class="rank-badge bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 35px; height: 35px;">1</div>
                                @elseif($i === 1)
                                    <div class="rank-badge text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 35px; height: 35px; background: #9e9e9e;">2</div>
                                @elseif($i === 2)
                                    <div class="rank-badge text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 35px; height: 35px; background: #cd7f32;">3</div>
                                @else
                                    <div class="text-muted fw-bold fs-5">{{ $i + 1 }}</div>
                                @endif
                            </div>

                            <!-- Name -->
                            <div class="flex-grow-1 min-width-0 pe-3 mb-2 mb-md-0">
                                <h6 class="fw-bold text-dark mb-0 text-truncate" style="font-size: 1.1rem;">
                                    {{ session('locale') == 'en' && !empty($sh->shareholder_name_en) ? $sh->shareholder_name_en : $sh->shareholder_name_th }}
                                </h6>
                            </div>

                            <!-- Shares & Percentage -->
                            <div class="d-flex align-items-center flex-shrink-0 justify-content-between justify-content-md-end w-100 w-md-auto mt-2 mt-md-0 pt-2 pt-md-0 border-top border-md-0">
                                <div class="text-end pe-4 me-2 border-end border-2 border-light d-flex flex-column justify-content-center">
                                    <span class="text-muted small text-uppercase tracking-wider fw-medium mb-1">{{ __('messages.shares') }}</span>
                                    <span class="fw-bold fs-5 text-dark number-font">{{ number_format($sh->number_of_shares) }}</span>
                                </div>
                                <div class="text-center" style="width: 100px;">
                                    <span class="text-muted small text-uppercase tracking-wider fw-medium d-block mb-1">{{ __('messages.percentage') }}</span>
                                    @if($i === 0)
                                        <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm w-100 number-font" style="font-size: 1rem;">{{ number_format($sh->percentage, 2) }}%</span>
                                    @elseif($i < 3)
                                        <span class="badge bg-success bg-opacity-75 text-white px-3 py-2 rounded-pill w-100 number-font" style="font-size: 0.95rem;">{{ number_format($sh->percentage, 2) }}%</span>
                                    @else
                                        <span class="badge bg-light text-dark border border-secondary border-opacity-25 px-3 py-2 rounded-pill w-100 number-font" style="font-size: 0.95rem;">{{ number_format($sh->percentage, 2) }}%</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="text-center mt-5">
            <div class="d-inline-flex border rounded-pill px-4 py-2 bg-white shadow-sm align-items-center text-muted small">
                <i class="fas fa-info-circle text-success me-2"></i> {{ __('messages.set_reference_note') }}
            </div>
        </div>

    </div>
</section>

{{-- Additional Styling --}}
<style>
    .tracking-wide { letter-spacing: 1px; }
    .tracking-wider { letter-spacing: 2px; }
    .tracking-widest { letter-spacing: 3px; }
    
    @keyframes floatParticle {
        0% { transform: translateY(0) translateX(0); }
        33% { transform: translateY(-20px) translateX(10px); }
        66% { transform: translateY(10px) translateX(-15px); }
        100% { transform: translateY(0) translateX(0); }
    }
    
    @keyframes breatheLogo {
        0% { transform: scale(1); filter: drop-shadow(0 0 10px rgba(46,125,50,0.2)); }
        50% { transform: scale(1.05); filter: drop-shadow(0 0 20px rgba(46,125,50,0.5)); }
        100% { transform: scale(1); filter: drop-shadow(0 0 10px rgba(46,125,50,0.2)); }
    }
    .chart-center-logo {
        animation: breatheLogo 4s ease-in-out infinite;
    }
    
    .number-font {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        letter-spacing: 0.5px;
    }
    
    .stat-box { transition: transform 0.3s ease; }
    .stat-box:hover { transform: translateY(-5px); }
    
    .benefit-item:hover { background: #ffffff; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transform: translateY(-3px); }
    
    .shareholder-row { border: 1px solid transparent; }
    .shareholder-row:hover { background: #ffffff !important; border-color: rgba(76, 175, 80, 0.2); box-shadow: 0 8px 25px rgba(0,0,0,0.08) !important; transform: scale(1.02); z-index: 10; }
    .shareholder-row .row-progress { opacity: 0.4; border-radius: 1rem; }
    .shareholder-row:hover .row-progress { opacity: 0.8; }
    
    .chart-container:hover .blur-element { opacity: 0.3; transform: translate(-50%, -50%) scale(1.1); transition: all 0.5s ease; }

    /* Fix responsive layouts for rows */
    @media (min-width: 768px) {
        .w-md-auto { width: auto !important; }
        .border-md-0 { border-top: 0 !important; }
        .pt-md-0 { padding-top: 0 !important; }
    }
</style>

{{-- Chart.js Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let myChart;
    
    function initChart() {
        const ctx = document.getElementById('shareholderChart').getContext('2d');
        
        // Data prep: top 4 and others
        const labels = [];
        const data = [];
        
        @php
            $top4 = $shareholders->take(4);
            $others_pct = 100 - $top4->sum('percentage');
        @endphp

        @foreach($top4 as $sh)
            labels.push('{{ session('locale') == 'en' && !empty($sh->shareholder_name_en) ? $sh->shareholder_name_en : $sh->shareholder_name_th }}');
            data.push({{ $sh->percentage }});
        @endforeach
        
        labels.push('{{ __('messages.other_shareholders') }}');
        data.push({{ $others_pct }});

        myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#1b5e20', // Dark Green
                        '#388e3c', // Green
                        '#66bb6a', // Light Green
                        '#a5d6a7', // Very Light Green
                        '#e0e0e0'  // Grey for others
                    ],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 15,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                layout: {
                    padding: 20
                },
                plugins: {
                    legend: {
                        display: false 
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#1b5e20',
                        bodyColor: '#333',
                        borderColor: 'rgba(76, 175, 80, 0.2)',
                        borderWidth: 2,
                        padding: 15,
                        boxPadding: 6,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 14, weight: 'bold' },
                        callbacks: {
                            label: function(context) {
                                return context.raw.toFixed(2) + '%';
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
    }

    function animateChart() {
        if(myChart) {
            myChart.destroy();
            initChart();
        }
    }

    document.addEventListener('DOMContentLoaded', initChart);
</script>
@endsection

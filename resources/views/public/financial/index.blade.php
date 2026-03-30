@extends('layouts.app')
@section('title', 'Financial Information - CFARM IR')

@php
    $locale = session('locale', config('app.locale'));
    $catIcons = [
        'งบการเงิน' => 'bi-file-earmark-spreadsheet',
        'Financial Statements' => 'bi-file-earmark-spreadsheet',
        'คำอธิบายและการวิเคราะห์ของฝ่ายจัดการ (MD&A)' => 'bi-clipboard-data',
        'MD&A' => 'bi-clipboard-data',
        'รายงานประจำปี' => 'bi-journal-richtext',
        'Annual Report' => 'bi-journal-richtext',
    ];
    $catColors = ['#2e7d32', '#1565c0', '#e65100', '#6a1b9a', '#00838f'];
@endphp

@section('extra_css')
/* ── Financial Page ── */
.fin-hero {
    position: relative;
    padding: 60px 0 80px;
    background: linear-gradient(135deg, #0d3d11 0%, #1b5e20 35%, #2e7d32 65%, #388e3c 100%);
    overflow: hidden;
    text-align: center;
    color: #fff;
}
.fin-hero::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 50px;
    background: linear-gradient(0deg, #f5f7f9, transparent);
    z-index: 2;
}
.fin-hero h1 {
    font-size: 2.2rem;
    font-weight: 300;
    letter-spacing: 3px;
    margin: 0;
    position: relative;
    z-index: 1;
}
.fin-hero p {
    font-size: 0.85rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    opacity: 0.5;
    margin-top: 6px;
    position: relative;
    z-index: 1;
}
.fin-hero .dot {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
}

/* Main Layout */
.fin-main {
    background: #f5f7f9;
    padding-bottom: 60px;
}
.fin-wrapper {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 24px;
    margin-top: -40px;
    position: relative;
    z-index: 5;
}

/* Sidebar Filters */
.fin-sidebar {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
    padding: 24px;
    align-self: start;
    position: sticky;
    top: 90px;
}
.fin-sidebar-title {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--cfarm-text-light);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.fin-sidebar-divider {
    height: 1px;
    background: rgba(0,0,0,0.06);
    margin: 16px 0;
}
.fin-nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 10px;
    text-decoration: none;
    color: var(--cfarm-text-light);
    font-size: 0.9rem;
    font-weight: 400;
    transition: all 0.25s ease;
    margin-bottom: 4px;
}
.fin-nav-item:hover {
    background: rgba(46,125,50,0.05);
    color: var(--cfarm-green);
}
.fin-nav-item.active {
    background: linear-gradient(135deg, var(--cfarm-green), var(--cfarm-green-dark));
    color: #fff;
    font-weight: 500;
    box-shadow: 0 4px 12px rgba(46,125,50,0.25);
}
.fin-nav-item i { font-size: 1.1rem; }
.fin-nav-count {
    margin-left: auto;
    font-size: 0.75rem;
    padding: 2px 8px;
    border-radius: 8px;
    background: rgba(0,0,0,0.05);
    font-weight: 600;
}
.fin-nav-item.active .fin-nav-count {
    background: rgba(255,255,255,0.2);
    color: #fff;
}

/* Year dropdown */
.fin-year-select {
    width: 100%;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1.5px solid rgba(0,0,0,0.08);
    background: #fff;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--cfarm-text);
    cursor: pointer;
    appearance: auto;
    transition: all 0.25s ease;
    outline: none;
}
.fin-year-select:hover {
    border-color: var(--cfarm-green);
}
.fin-year-select:focus {
    border-color: var(--cfarm-green);
    box-shadow: 0 0 0 3px rgba(46,125,50,0.1);
}

/* Content Area */
.fin-content {
    min-width: 0;
}
.fin-content-header {
    background: #fff;
    border-radius: 16px;
    padding: 18px 24px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.fin-content-title {
    font-size: 1rem;
    font-weight: 500;
    color: var(--cfarm-text);
}
.fin-content-count {
    font-size: 0.85rem;
    color: var(--cfarm-text-light);
}

/* Document Cards */
.fin-doc {
    background: #fff;
    border-radius: 14px;
    padding: 20px 24px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.04);
    transition: all 0.3s ease;
}
.fin-doc:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.07);
    border-color: rgba(46,125,50,0.12);
}
.fin-doc-icon {
    width: 44px;
    height: 44px;
    min-width: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}
.fin-doc-body { flex: 1; min-width: 0; }
.fin-doc-name {
    font-weight: 500;
    font-size: 0.95rem;
    color: var(--cfarm-text);
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.fin-doc-sub {
    font-size: 0.8rem;
    color: var(--cfarm-text-light);
    font-weight: 300;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.fin-doc-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}
.fin-badge {
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 0.72rem;
    font-weight: 600;
    color: #fff;
    white-space: nowrap;
}
.fin-year-tag {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--cfarm-text);
    background: rgba(0,0,0,0.04);
    padding: 4px 12px;
    border-radius: 6px;
}
.fin-dl-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 16px;
    border-radius: 8px;
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--cfarm-green);
    background: rgba(46,125,50,0.07);
    border: 1px solid rgba(46,125,50,0.12);
    text-decoration: none;
    transition: all 0.25s;
    white-space: nowrap;
}
.fin-dl-btn:hover {
    background: var(--cfarm-green);
    color: #fff;
    border-color: var(--cfarm-green);
    box-shadow: 0 3px 12px rgba(46,125,50,0.25);
}

/* Empty State */
.fin-empty {
    text-align: center;
    padding: 50px 20px;
    background: #fff;
    border-radius: 14px;
}
.fin-empty i { font-size: 3rem; color: #ddd; }

/* Responsive */
@media (max-width: 992px) {
    .fin-wrapper {
        grid-template-columns: 1fr;
    }
    .fin-sidebar {
        position: static;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding: 16px;
    }
    .fin-sidebar-title { width: 100%; }
    .fin-sidebar-divider { width: 100%; margin: 8px 0; }
    .fin-nav-item { padding: 8px 14px; margin: 0; }
}
@media (max-width: 768px) {
    .fin-hero { padding: 40px 0 60px; }
    .fin-hero h1 { font-size: 1.6rem; }
    .fin-doc { flex-wrap: wrap; }
    .fin-doc-actions { width: 100%; justify-content: flex-end; margin-top: 8px; padding-top: 8px; border-top: 1px solid rgba(0,0,0,0.04); }
}
@endsection

@section('content')
{{-- ══════════ HERO ══════════ --}}
<div class="fin-hero">
    <div class="dot" style="width:90px; height:90px; top:15%; left:8%;"></div>
    <div class="dot" style="width:60px; height:60px; top:50%; right:12%;"></div>
    <div class="dot" style="width:45px; height:45px; bottom:20%; right:30%;"></div>
    <h1>{{ __('messages.financial_information') }}</h1>
    <p>Financial Information</p>
</div>

{{-- ══════════ MAIN ══════════ --}}
<div class="fin-main">
    <div class="container">
        <div class="fin-wrapper">
            {{-- ── LEFT SIDEBAR ── --}}
            <aside class="fin-sidebar">
                <div class="fin-sidebar-title"><i class="bi bi-calendar3 text-success"></i> {{ __('messages.year') }}</div>
                <select class="fin-year-select" onchange="if(this.value) window.location.href=this.value;">
                    <option value="{{ route('financial.index') }}" {{ !$yearId ? 'selected' : '' }}>{{ __('messages.all') }}</option>
                    @foreach($years as $y)
                        <option value="{{ route('financial.index', ['year' => $y->id]) }}" {{ $yearId == $y->id ? 'selected' : '' }}>{{ $y->year }}</option>
                    @endforeach
                </select>

                <div class="fin-sidebar-divider"></div>

                <div class="fin-sidebar-title"><i class="bi bi-funnel text-success"></i> {{ __('messages.category') }}</div>

                <a href="{{ route('financial.index') }}" class="fin-nav-item {{ !$categoryId ? 'active' : '' }}">
                    <i class="bi bi-grid-3x3-gap"></i> {{ __('messages.all') }}
                    <span class="fin-nav-count">{{ $reports->total() }}</span>
                </a>
                @foreach($categories as $cat)
                    @php
                        $catName = $locale == 'en' && !empty($cat->name_en) ? $cat->name_en : $cat->name_th;
                        $icon = $catIcons[$cat->name_th] ?? ($catIcons[$cat->name_en ?? ''] ?? 'bi-file-earmark');
                    @endphp
                    <a href="{{ route('financial.index', ['category' => $cat->id]) }}"
                       class="fin-nav-item {{ $categoryId == $cat->id ? 'active' : '' }}">
                        <i class="bi {{ $icon }}"></i>
                        <span style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $catName }}</span>
                    </a>
                @endforeach
            </aside>

            {{-- ── RIGHT CONTENT ── --}}
            <div class="fin-content">
                {{-- Header bar --}}
                <div class="fin-content-header">
                    <div class="fin-content-title">
                        <i class="bi bi-file-earmark-text text-success me-2"></i>
                        @if($categoryId)
                            @php $activeCat = $categories->firstWhere('id', $categoryId); @endphp
                            {{ $activeCat ? ($locale == 'en' && !empty($activeCat->name_en) ? $activeCat->name_en : $activeCat->name_th) : __('messages.all') }}
                        @else
                            {{ $locale === 'th' ? 'เอกสารทั้งหมด' : 'All Documents' }}
                        @endif
                        @if($yearId)
                            @php $activeYear = $years->firstWhere('id', $yearId); @endphp
                            @if($activeYear) · {{ $activeYear->year }} @endif
                        @endif
                    </div>
                    <div class="fin-content-count">
                        {{ $reports->total() }} {{ $locale === 'th' ? 'รายการ' : 'item(s)' }}
                    </div>
                </div>

                {{-- Document list --}}
                @forelse($reports as $report)
                    @php
                        $cName = $locale == 'en' && !empty($report->category->name_en) ? $report->category->name_en : ($report->category->name_th ?? '');
                        $cIcon = $catIcons[$report->category->name_th ?? ''] ?? ($catIcons[$report->category->name_en ?? ''] ?? 'bi-file-earmark');
                        $cIdx = $report->category_id % count($catColors);
                        $color = $catColors[$cIdx];
                        $title = $locale == 'en' && !empty($report->title_en) ? $report->title_en : $report->title_th;
                        $sub = $locale == 'en' ? $report->title_th : $report->title_en;
                    @endphp
                    <div class="fin-doc">
                        <div class="fin-doc-icon" style="background:{{ $color }}10; color:{{ $color }};">
                            <i class="bi {{ $cIcon }}"></i>
                        </div>
                        <div class="fin-doc-body">
                            <div class="fin-doc-name">{{ $title }}</div>
                            @if(!empty($sub))
                                <div class="fin-doc-sub">{{ $sub }}</div>
                            @endif
                        </div>
                        <div class="fin-doc-actions">
                            <span class="fin-badge" style="background:{{ $color }};">{{ $cName }}</span>
                            <span class="fin-year-tag">{{ $report->year->year ?? '-' }}</span>
                            <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank" class="fin-dl-btn">
                                <i class="bi bi-download"></i> {{ __('messages.download') }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="fin-empty">
                        <i class="bi bi-folder2-open d-block mb-3"></i>
                        <h5 style="font-weight:400; color:#999;">{{ __('messages.no_reports') }}</h5>
                        <p class="text-muted" style="font-size:0.9rem;">{{ $locale === 'th' ? 'ยังไม่มีเอกสารในหมวดนี้' : 'No documents in this category' }}</p>
                    </div>
                @endforelse

                {{-- Pagination --}}
                @if($reports->hasPages())
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $reports->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

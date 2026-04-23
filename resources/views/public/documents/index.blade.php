@extends('layouts.app')
@section('title', 'Document Library - CFARM IR')

@php
    $locale = session('locale', config('app.locale'));

    // Category specific stock images
    $catImages = [
        'รายงานประจำปี' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=600&h=400&fit=crop', // Financial accounting
        'Annual Report' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=600&h=400&fit=crop',
        'แบบ 56-1 One Report' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop', // Charts/Data
        'One Report' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop',
        'เอกสารนำเสนอ & Webcasts' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=600&h=400&fit=crop', // Presentation
        'Presentation' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=600&h=400&fit=crop',
        'หนังสือชี้ชวน' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&h=400&fit=crop', // Legal doc
        'Prospectus' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&h=400&fit=crop',
        'หนังสือเชิญประชุมผู้ถือหุ้น' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=600&h=400&fit=crop', // Meeting
        'Invitation to Shareholders' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=600&h=400&fit=crop',
        'รายงานการประชุมผู้ถือหุ้น' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32b7?w=600&h=400&fit=crop', // Boardroom
        'Shareholders Meeting Minutes' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32b7?w=600&h=400&fit=crop',
        'รายงานความยั่งยืน' => 'https://images.unsplash.com/photo-1473448912268-2022ce9509d8?w=600&h=400&fit=crop', // Sustainability
        'Sustainability Report' => 'https://images.unsplash.com/photo-1473448912268-2022ce9509d8?w=600&h=400&fit=crop',
    ];
    $defaultImage = 'https://images.unsplash.com/photo-1618044733300-9472054094ee?w=600&h=400&fit=crop';

    // Category Icons for sidebar
    $catIcons = [
        'รายงานประจำปี' => 'bi-journal-richtext',
        'Annual Report' => 'bi-journal-richtext',
        'แบบ 56-1 One Report' => 'bi-file-earmark-bar-graph',
        'One Report' => 'bi-file-earmark-bar-graph',
        'เอกสารนำเสนอ & Webcasts' => 'bi-easel',
        'Presentation' => 'bi-easel',
        'หนังสือชี้ชวน' => 'bi-file-earmark-text',
        'Prospectus' => 'bi-file-earmark-text',
        'หนังสือเชิญประชุมผู้ถือหุ้น' => 'bi-envelope-paper',
        'Invitation to Shareholders' => 'bi-envelope-paper',
        'รายงานการประชุมผู้ถือหุ้น' => 'bi-people',
        'Shareholders Meeting Minutes' => 'bi-people',
        'รายงานความยั่งยืน' => 'bi-tree',
        'Sustainability Report' => 'bi-tree',
    ];
@endphp

@section('extra_css')
    /* ── Documents Layout Premium ── */
    .doc-hero {
    position: relative;
    padding: 65px 0 85px;
    background: linear-gradient(135deg, #0d3d11 0%, #1b5e20 40%, #2e7d32 80%, #388e3c 100%);
    overflow: hidden;
    text-align: center;
    color: #fff;
    }
    .doc-hero::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 50px;
    background: linear-gradient(0deg, #f5f7f9, transparent);
    z-index: 2;
    }
    .doc-hero h1 {
    font-size: 2.3rem;
    font-weight: 300;
    letter-spacing: 3px;
    margin: 0 0 8px 0;
    text-shadow: 0 4px 15px rgba(0,0,0,0.2);
    position: relative;
    z-index: 1;
    }
    .doc-hero p {
    font-size: 0.9rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    opacity: 0.6;
    margin: 0;
    position: relative;
    z-index: 1;
    }
    .doc-hero .dot {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    }

    .doc-main {
    background: #f5f7f9;
    padding-bottom: 70px;
    }
    .doc-wrapper {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 30px;
    margin-top: -45px;
    position: relative;
    z-index: 5;
    }

    /* Sidebar */
    .doc-sidebar {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    padding: 25px;
    align-self: start;
    position: sticky;
    top: 90px;
    }
    .doc-sidebar-title {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--cfarm-text-light);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
    }
    .doc-sidebar-divider {
    height: 1px;
    background: rgba(0,0,0,0.06);
    margin: 20px 0;
    }
    .doc-nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border-radius: 12px;
    text-decoration: none;
    color: var(--cfarm-text-light);
    font-size: 0.9rem;
    font-weight: 400;
    transition: all 0.25s ease;
    margin-bottom: 5px;
    }
    .doc-nav-item:hover {
    background: rgba(46,125,50,0.05);
    color: var(--cfarm-green);
    }
    .doc-nav-item.active {
    background: linear-gradient(135deg, var(--cfarm-green), var(--cfarm-green-dark));
    color: #fff;
    font-weight: 500;
    box-shadow: 0 4px 15px rgba(46,125,50,0.25);
    }
    .doc-nav-count {
    margin-left: auto;
    font-size: 0.75rem;
    padding: 2px 8px;
    border-radius: 8px;
    background: rgba(0,0,0,0.06);
    color: var(--cfarm-text-light);
    font-weight: 600;
    }
    .doc-nav-item.active .doc-nav-count {
    background: rgba(255,255,255,0.25);
    color: #fff;
    }
    .doc-year-select {
    width: 100%;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid rgba(0,0,0,0.1);
    background: #fff;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--cfarm-text);
    cursor: pointer;
    transition: all 0.25s;
    outline: none;
    }
    .doc-year-select:hover, .doc-year-select:focus {
    border-color: var(--cfarm-green);
    box-shadow: 0 0 0 3px rgba(46,125,50,0.1);
    }

    /* Header */
    .doc-header-card {
    background: #fff;
    border-radius: 18px;
    padding: 18px 25px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    }
    .doc-header-title {
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--cfarm-text);
    }
    .doc-header-count {
    font-size: 0.9rem;
    color: var(--cfarm-text-light);
    background: rgba(0,0,0,0.04);
    padding: 4px 14px;
    border-radius: 20px;
    }

    /* Document Cards (Image Grid Style) */
    .doc-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
    }
    .doc-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.04);
    transition: all 0.35s cubic-bezier(.4,0,.2,1);
    display: flex;
    flex-direction: column;
    }
    .doc-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    border-color: rgba(46,125,50,0.15);
    }
    .doc-card-image {
    width: 100%;
    height: 160px;
    background-size: cover;
    background-position: center;
    background-color: #f0f0f0;
    position: relative;
    }
    .doc-card-image::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0) 50%, rgba(0,0,0,0.6) 100%);
    }
    .doc-card-year {
    position: absolute;
    bottom: 12px;
    right: 12px;
    background: var(--cfarm-green);
    color: #fff;
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    z-index: 2;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    .doc-card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    }
    .doc-card-meta {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--cfarm-orange);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
    }
    .doc-card-title {
    font-size: 1rem;
    font-weight: 500;
    color: var(--cfarm-text);
    margin-bottom: 4px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    }
    .doc-card-sub {
    font-size: 0.82rem;
    color: var(--cfarm-text-light);
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 15px;
    }
    .doc-card-footer {
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid rgba(0,0,0,0.06);
    display: flex;
    align-items: center;
    justify-content: space-between;
    }
    .doc-stat {
    font-size: 0.8rem;
    color: var(--cfarm-text-light);
    display: flex;
    align-items: center;
    gap: 5px;
    }
    .doc-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 8px;
    background: rgba(46,125,50,0.08);
    color: var(--cfarm-green);
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s;
    }
    .doc-btn:hover {
    background: var(--cfarm-green);
    color: #fff;
    box-shadow: 0 4px 15px rgba(46,125,50,0.25);
    }

    /* Empty State */
    .doc-empty {
    text-align: center;
    background: #fff;
    border-radius: 16px;
    padding: 60px 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .doc-empty i { font-size: 3.5rem; color: #ddd; }

    @media (max-width: 992px) {
    .doc-wrapper { grid-template-columns: 1fr; }
    .doc-sidebar { position: static; display: flex; flex-wrap: wrap; gap: 10px; padding: 18px; }
    .doc-sidebar-title, .doc-sidebar-divider { width: 100%; margin: 5px 0; }
    .doc-nav-item { margin: 0; padding: 8px 12px; }
    }
    @media (max-width: 576px) {
    .doc-grid { grid-template-columns: 1fr; }
    }
@endsection

@section('content')
    {{-- HERO --}}
    <div class="doc-hero">
        <div class="dot" style="width:120px; height:120px; top:-20%; left:5%;"></div>
        <div class="dot" style="width:70px; height:70px; top:40%; right:15%;"></div>
        <div class="dot" style="width:40px; height:40px; bottom:20%; right:35%;"></div>
        <h1>เอกสารเผยแพร่</h1>
        <p>Published Documents</p>
    </div>

    {{-- MAIN --}}
    <div class="doc-main">
        <div class="container">
            <div class="doc-wrapper">

                {{-- SIDEBAR --}}
                <aside class="doc-sidebar">
                    <div class="doc-sidebar-title"><i class="bi bi-calendar-event text-success"></i>
                        {{ __('messages.year') }}</div>
                    <select class="doc-year-select" onchange="if(this.value) window.location.href=this.value;">
                        <option value="{{ route('documents.index') }}" {{ !$yearId ? 'selected' : '' }}>
                            {{ __('messages.all') }} {{ __('messages.year') }}</option>
                        @foreach($years as $y)
                            <option value="{{ route('documents.index', ['year' => $y->id]) }}" {{ $yearId == $y->id ? 'selected' : '' }}>
                                {{ $locale == 'en' ? ($y->year - 543) : $y->year }}
                            </option>
                        @endforeach
                    </select>

                    <div class="doc-sidebar-divider"></div>

                    <div class="doc-sidebar-title"><i class="bi bi-folder2-open text-success"></i>
                        {{ __('messages.category') }}</div>

                    <a href="{{ route('documents.index') }}" class="doc-nav-item {{ !$categoryId ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2"></i> {{ __('messages.all') }}
                        <span class="doc-nav-count">{{ $documents->total() }}</span>
                    </a>

                    @foreach($categories as $cat)
                        @php
                            $catName = $locale == 'en' && !empty($cat->name_en) ? $cat->name_en : $cat->name_th;
                            $icon = $catIcons[$cat->name_th] ?? ($catIcons[$cat->name_en ?? ''] ?? 'bi-file-earmark-text');
                        @endphp
                        <a href="{{ route('documents.index', ['category' => $cat->id]) }}"
                            class="doc-nav-item {{ $categoryId == $cat->id ? 'active' : '' }}">
                            <i class="bi {{ $icon }}"></i>
                            <span style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $catName }}</span>
                        </a>
                    @endforeach
                </aside>

                {{-- CONTENT --}}
                <div>
                    {{-- Header Card --}}
                    <div class="doc-header-card">
                        <div class="doc-header-title">
                            <i class="bi bi-folder-check text-success me-2"></i>
                            @if($categoryId)
                                @php $activeCat = $categories->firstWhere('id', $categoryId); @endphp
                                {{ $activeCat ? ($locale == 'en' && !empty($activeCat->name_en) ? $activeCat->name_en : $activeCat->name_th) : __('messages.all') }}
                            @else
                                {{ $locale === 'th' ? 'เอกสารทั้งหมด' : 'All Documents' }}
                            @endif
                            @if($yearId)
                                @php $activeYear = $years->firstWhere('id', $yearId); @endphp
                                @if($activeYear) · {{ $locale == 'en' ? ($activeYear->year - 543) : $activeYear->year }} @endif
                            @endif
                        </div>
                        <div class="doc-header-count">{{ $documents->total() }}
                            {{ $locale === 'th' ? 'รายการ' : 'item(s)' }}</div>
                    </div>

                    {{-- Grid --}}
                    <div class="doc-grid">
                        @forelse($documents as $doc)
                            @php
                                $cName = $locale == 'en' && !empty($doc->category->name_en) ? $doc->category->name_en : ($doc->category->name_th ?? '');
                                $title = $locale == 'en' && !empty($doc->title_en) ? $doc->title_en : $doc->title_th;
                                $sub = $locale == 'en' ? $doc->title_th : $doc->title_en;
                                $bgImg = $catImages[$doc->category->name_th ?? ''] ?? ($catImages[$doc->category->name_en ?? ''] ?? $defaultImage);
                                $year = $doc->year->year ?? '-';
                                if ($locale == 'en' && is_numeric($year))
                                    $year = $year - 543;
                            @endphp

                            <div class="doc-card">
                                {{-- Cover Image --}}
                                <div class="doc-card-image" style="background-image: url('{{ $bgImg }}');">
                                    {{-- Year moved to meta below --}}
                                </div>

                                {{-- Body --}}
                                <div class="doc-card-body">
                                    <div class="doc-card-meta" style="color: var(--cfarm-text-light);">
                                        <span
                                            style="color: var(--cfarm-green); font-weight: 700; font-size: 0.85rem; margin-right: 6px;">{{ $year }}</span>
                                        <i class="bi bi-dot"></i>
                                        <i class="bi bi-stack ms-1"></i> {{ $cName }}
                                    </div>
                                    <div class="doc-card-title" title="{{ $title }}">{{ $title }}</div>
                                    @if(!empty($sub))
                                        <div class="doc-card-sub" title="{{ $sub }}">{{ $sub }}</div>
                                    @endif

                                    <div class="doc-card-footer" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; padding-top: 18px; border-top: 1px solid rgba(0,0,0,0.06);">
                                        @if($doc->external_link)
                                            <a href="{{ route('documents.download', $doc) }}" target="_blank" class="doc-btn" style="grid-column: 1 / -1; border-radius: 10px; padding: 10px 15px;">
                                                <i class="bi bi-box-arrow-up-right"></i> {{ $locale == 'en' ? 'Open Link' : 'เปิดลิงก์' }}
                                            </a>
                                        @else
                                            <a href="{{ route('documents.view', $doc) }}" target="_blank" class="doc-btn" style="background: #f4f5f7; color: #333; border-radius: 10px; padding: 10px 15px;">
                                                <i class="bi bi-eye"></i> {{ $locale == 'en' ? 'View Online' : 'ดูออนไลน์' }}
                                            </a>
                                            <a href="{{ route('documents.download', $doc) }}" class="doc-btn" style="background: #ebf5ed; color: #2e7d32; border-radius: 10px; padding: 10px 15px;">
                                                <i class="bi bi-download"></i> {{ __('messages.download') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="doc-empty" style="grid-column: 1 / -1;">
                                <i class="bi bi-inboxes d-block mb-3"></i>
                                <h5 style="font-weight:400; color:#888;">{{ __('messages.no_documents') }}</h5>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if($documents->hasPages())
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $documents->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
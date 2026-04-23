@extends('layouts.app')
@section('title', __('messages.governance') . ' - CFARM IR')

@php
    $locale = session('locale', config('app.locale'));
@endphp

@section('extra_css')
    /* ── Governance Layout Premium ── */
    .gov-hero {
        position: relative;
        padding: 65px 0 85px;
        background: linear-gradient(135deg, #0d3d11 0%, #1b5e20 40%, #2e7d32 80%, #388e3c 100%);
        overflow: hidden;
        text-align: center;
        color: #fff;
    }
    .gov-hero::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 50px;
        background: linear-gradient(0deg, #f5f7f9, transparent);
        z-index: 2;
    }
    .gov-hero h1 {
        font-size: 2.3rem;
        font-weight: 300;
        letter-spacing: 3px;
        margin: 0 0 8px 0;
        text-shadow: 0 4px 15px rgba(0,0,0,0.2);
        position: relative;
        z-index: 1;
    }
    .gov-hero p {
        font-size: 0.9rem;
        letter-spacing: 5px;
        text-transform: uppercase;
        opacity: 0.6;
        margin: 0;
        position: relative;
        z-index: 1;
    }
    .gov-hero .dot {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }

    .gov-main {
        background: #f5f7f9;
        padding-bottom: 70px;
    }
    .gov-wrapper {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 30px;
        margin-top: -45px;
        position: relative;
        z-index: 5;
    }

    /* Sidebar */
    .gov-sidebar {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        padding: 25px;
        align-self: start;
        position: sticky;
        top: 90px;
    }
    .gov-sidebar-title {
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
    .gov-nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 12px;
        text-decoration: none;
        color: var(--cfarm-text-light);
        font-size: 0.88rem;
        font-weight: 400;
        transition: all 0.25s ease;
        margin-bottom: 4px;
        line-height: 1.4;
    }
    .gov-nav-item:hover {
        background: rgba(46,125,50,0.05);
        color: var(--cfarm-green);
    }
    .gov-nav-item.active {
        background: linear-gradient(135deg, var(--cfarm-green), var(--cfarm-green-dark));
        color: #fff;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(46,125,50,0.25);
    }
    .gov-nav-item i.nav-icon {
        font-size: 1.1rem;
        flex-shrink: 0;
        width: 20px;
        text-align: center;
    }
    .gov-nav-count {
        margin-left: auto;
        font-size: 0.72rem;
        padding: 2px 8px;
        border-radius: 8px;
        background: rgba(0,0,0,0.06);
        color: var(--cfarm-text-light);
        font-weight: 600;
        flex-shrink: 0;
    }
    .gov-nav-item.active .gov-nav-count {
        background: rgba(255,255,255,0.25);
        color: #fff;
    }

    /* Content Header */
    .gov-header-card {
        background: #fff;
        border-radius: 18px;
        padding: 20px 25px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .gov-header-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--cfarm-text);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .gov-header-count {
        font-size: 0.9rem;
        color: var(--cfarm-text-light);
        background: rgba(0,0,0,0.04);
        padding: 4px 14px;
        border-radius: 20px;
    }

    /* Document Cards */
    .gov-doc-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .gov-doc-card {
        background: #fff;
        border-radius: 16px;
        padding: 22px 28px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.35s cubic-bezier(.4,0,.2,1);
    }
    .gov-doc-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        border-color: rgba(46,125,50,0.15);
    }
    .gov-doc-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(46,125,50,0.08), rgba(46,125,50,0.15));
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--cfarm-green);
        font-size: 1.3rem;
    }
    .gov-doc-info {
        flex: 1;
        min-width: 0;
    }
    .gov-doc-title {
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--cfarm-text);
        margin-bottom: 4px;
        line-height: 1.4;
    }
    .gov-doc-sub {
        font-size: 0.82rem;
        color: var(--cfarm-text-light);
    }
    .gov-doc-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.78rem;
        color: var(--cfarm-text-light);
        margin-top: 6px;
    }
    .gov-doc-meta span {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .gov-doc-actions {
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }
    .gov-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s;
    }
    .gov-btn-primary {
        background: rgba(46,125,50,0.08);
        color: var(--cfarm-green);
    }
    .gov-btn-primary:hover {
        background: var(--cfarm-green);
        color: #fff;
        box-shadow: 0 4px 15px rgba(46,125,50,0.25);
    }

    /* Section Content (Rich text + Image) */
    .gov-content-card {
        background: #fff;
        border-radius: 16px;
        padding: 30px 35px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.04);
        margin-bottom: 25px;
    }
    .gov-content-card .content-body {
        color: var(--cfarm-text);
        font-size: 0.92rem;
        line-height: 1.9;
    }
    .gov-content-card .content-body h3 { font-size: 1.1rem; font-weight: 600; color: var(--cfarm-green-dark); margin-top: 20px; margin-bottom: 10px; }
    .gov-content-card .content-body h4 { font-size: 1rem; font-weight: 600; color: var(--cfarm-text); margin-top: 16px; margin-bottom: 8px; }
    .gov-content-card .content-body ul { padding-left: 20px; }
    .gov-content-card .content-body li { margin-bottom: 6px; }
    .gov-content-card .content-body p { margin-bottom: 12px; }
    .gov-content-image {
        text-align: center;
        margin-top: 20px;
    }
    .gov-content-image img {
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }
    .gov-content-image .img-caption {
        font-size: 0.82rem;
        color: var(--cfarm-text-light);
        margin-top: 10px;
    }

    /* Documents heading between content and list */
    .gov-doc-heading {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--cfarm-text);
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid rgba(46,125,50,0.1);
    }

    /* Empty State */
    .gov-empty {
        text-align: center;
        background: #fff;
        border-radius: 16px;
        padding: 80px 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }
    .gov-empty i { font-size: 3.5rem; color: #ddd; margin-bottom: 15px; display: block; }
    .gov-empty h5 { font-weight: 400; color: #888; font-size: 1rem; }
    .gov-empty p { font-size: 0.88rem; color: #aaa; margin-top: 5px; }

    @media (max-width: 992px) {
        .gov-wrapper { grid-template-columns: 1fr; }
        .gov-sidebar { position: static; }
    }
@endsection

@section('content')
    {{-- HERO --}}
    <div class="gov-hero">
        <div class="dot" style="width:120px; height:120px; top:-20%; left:5%;"></div>
        <div class="dot" style="width:70px; height:70px; top:40%; right:15%;"></div>
        <div class="dot" style="width:40px; height:40px; bottom:20%; right:35%;"></div>
        <h1>{{ __('messages.governance') }}</h1>
        <p>{{ __('messages.governance_subtitle') }}</p>
    </div>

    {{-- MAIN --}}
    <div class="gov-main">
        <div class="container">
            <div class="gov-wrapper">

                {{-- SIDEBAR --}}
                <aside class="gov-sidebar">
                    <div class="gov-sidebar-title">
                        <i class="bi bi-shield-check text-success"></i>
                        {{ __('messages.governance') }}
                    </div>

                    @foreach($sections as $key => $sec)
                        @php
                            $label = $locale == 'en' ? $sec['en'] : $sec['th'];
                            $count = $sectionCounts[$key] ?? 0;
                        @endphp
                        <a href="{{ route('governance.index', ['section' => $key]) }}"
                           class="gov-nav-item {{ $section == $key ? 'active' : '' }}">
                            <i class="bi {{ $sec['icon'] }} nav-icon"></i>
                            <span style="overflow:hidden; text-overflow:ellipsis;">{{ $label }}</span>
                            @if($count > 0)
                                <span class="gov-nav-count">{{ $count }}</span>
                            @endif
                        </a>
                    @endforeach
                </aside>

                {{-- CONTENT --}}
                <div>
                    {{-- Header Card --}}
                    <div class="gov-header-card">
                        <div class="gov-header-title">
                            <i class="bi {{ $sections[$section]['icon'] }} text-success"></i>
                            {{ $locale == 'en' ? $sections[$section]['en'] : $sections[$section]['th'] }}
                        </div>
                        <div class="gov-header-count">
                            {{ $documents->count() }} {{ __('messages.governance_total_documents') }}
                        </div>
                    </div>

                    {{-- Section Rich Content --}}
                    @if($sectionContent)
                        <div class="gov-content-card">
                            @php
                                $content = $locale == 'en' && !empty($sectionContent->content_en) ? $sectionContent->content_en : $sectionContent->content_th;
                            @endphp
                            @if($content)
                                <div class="content-body">{!! $content !!}</div>
                            @endif
                            @if($sectionContent->image_path)
                                <div class="gov-content-image">
                                    <img src="{{ asset('storage/' . $sectionContent->image_path) }}" alt="{{ $locale == 'en' ? $sections[$section]['en'] : $sections[$section]['th'] }}">
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Document List --}}
                    @if($documents->count() > 0)
                        <div class="gov-doc-heading">
                            <i class="bi bi-file-earmark-text text-success"></i>
                            เอกสารที่เกี่ยวข้อง ({{ $documents->count() }})
                        </div>
                        <div class="gov-doc-list">
                            @foreach($documents as $doc)
                                @php
                                    $title = $locale == 'en' && !empty($doc->title_en) ? $doc->title_en : $doc->title_th;
                                    $sub = $locale == 'en' ? $doc->title_th : $doc->title_en;
                                @endphp
                                <div class="gov-doc-card">
                                    <div class="gov-doc-icon">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </div>
                                    <div class="gov-doc-info">
                                        <div class="gov-doc-title">{{ $title }}</div>
                                        @if(!empty($sub))
                                            <div class="gov-doc-sub">{{ $sub }}</div>
                                        @endif
                                        <div class="gov-doc-meta">
                                            @if($doc->version)
                                                <span><i class="bi bi-tag"></i> {{ __('messages.version') }} {{ $doc->version }}</span>
                                            @endif
                                            @if($doc->effective_date)
                                                <span><i class="bi bi-calendar3"></i> {{ $doc->effective_date->format('d/m/Y') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="gov-doc-actions">
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="gov-btn gov-btn-primary">
                                            <i class="bi bi-download"></i> {{ __('messages.download') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="gov-empty">
                            <i class="bi bi-folder2-open"></i>
                            <h5>{{ __('messages.governance_no_documents') }}</h5>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection

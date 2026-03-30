@extends('layouts.app')
@section('title', 'Events - CFARM IR')

@php
    $locale = session('locale', config('app.locale'));
@endphp

@section('extra_css')
/* ── Events Premium Layout ── */
.events-hero {
    position: relative;
    padding: 70px 0 90px;
    background: linear-gradient(135deg, #0d3d11 0%, #1b5e20 30%, #2e7d32 70%, #4caf50 100%);
    overflow: hidden;
    text-align: center;
    color: #fff;
    margin-bottom: -40px;
}
.events-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('data:image/svg+xml;utf8,<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2" fill="rgba(255,255,255,0.05)"/></svg>');
    opacity: 0.5;
}
.events-hero::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 50px;
    background: linear-gradient(0deg, #f8f9fa, transparent);
    z-index: 2;
}
.events-hero h1 {
    font-size: 2.6rem;
    font-weight: 300;
    letter-spacing: 2px;
    margin: 0 0 10px 0;
    text-shadow: 0 4px 15px rgba(0,0,0,0.2);
    position: relative;
    z-index: 1;
}
.events-hero p {
    font-size: 1rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    opacity: 0.8;
    margin: 0;
    position: relative;
    z-index: 1;
}

body { background: #f8f9fa; }

/* Section Titles */
.ev-section-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--cfarm-text);
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.ev-section-title i {
    color: var(--cfarm-green);
    background: rgba(46,125,50,0.1);
    width: 40px; height: 40px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
}

/* Upcoming Events - Horizontal Cards */
.ev-upcoming-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    display: flex;
    overflow: hidden;
    position: relative;
    margin-bottom: 24px;
    transition: all 0.4s cubic-bezier(.4,0,.2,1);
    border: 1px solid rgba(0,0,0,0.02);
    z-index: 5;
}
.ev-upcoming-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}
.ev-date-box {
    flex: 0 0 130px;
    background: linear-gradient(135deg, var(--cfarm-green), var(--cfarm-green-dark));
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    position: relative;
    overflow: hidden;
}
.ev-date-box::after {
    content: ''; position: absolute; top:-50%; left:-50%; width:200%; height:200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
    opacity: 0; transition: opacity 0.4s;
}
.ev-upcoming-card:hover .ev-date-box::after { opacity: 1; }
.ev-date-box .ev-day { font-size: 2.8rem; font-weight: 700; line-height: 1; margin-bottom: 5px; }
.ev-date-box .ev-month { font-size: 1rem; font-weight: 500; text-transform: uppercase; letter-spacing: 2px; }

.ev-details {
    padding: 25px 30px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.ev-type-badge {
    align-self: flex-start;
    padding: 6px 14px;
    background: rgba(220,110,25,0.1);
    color: var(--cfarm-orange);
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 12px;
}
.ev-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--cfarm-text);
    margin-bottom: 6px;
    line-height: 1.3;
}
.ev-subtitle { font-size: 0.9rem; color: var(--cfarm-text-light); margin-bottom: 15px; }
.ev-meta-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px dashed rgba(0,0,0,0.08);
}
.ev-meta-item {
    display: flex; align-items: center; gap: 8px;
    font-size: 0.85rem; color: #666; font-weight: 500;
}
.ev-meta-item i { color: var(--cfarm-green); font-size: 1rem; }

.ev-action {
    padding: 25px 30px 25px 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ev-btn {
    width: 50px; height: 50px;
    border-radius: 50%;
    background: #f0f4f1;
    color: var(--cfarm-green);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; text-decoration: none;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.ev-upcoming-card:hover .ev-btn {
    background: var(--cfarm-green); color: #fff; transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(46,125,50,0.3);
}

/* All Events Grid (Past/Archive) */
.ev-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    margin-top: 30px;
}
.ev-card {
    background: #fff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.04);
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
}
.ev-card::before {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
    background: #e0e0e0; transition: background 0.3s;
}
.ev-card:hover {
    transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.06);
}
.ev-card:hover::before { background: var(--cfarm-green); }

.ev-card-date {
    font-size: 0.8rem; font-weight: 700; color: var(--cfarm-text-light); text-transform: uppercase;
    letter-spacing: 1px; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;
}
.ev-card-date i { color: var(--cfarm-green); }
.ev-card-title { font-size: 1.1rem; font-weight: 600; color: var(--cfarm-text); margin-bottom: 4px; line-height: 1.4; }
.ev-card-sub { font-size: 0.85rem; color: #888; margin-bottom: 15px; }
.ev-card-loc { font-size: 0.8rem; color: #666; display: flex; align-items: flex-start; gap: 6px; }
.ev-card-loc i { color: #aaa; margin-top: 2px; }

@media (max-width: 768px) {
    .ev-upcoming-card { flex-direction: column; }
    .ev-date-box { flex-direction: row; gap: 10px; padding: 15px; }
    .ev-date-box .ev-day { font-size: 1.8rem; margin: 0; }
    .ev-action { padding: 0 25px 25px 25px; justify-content: flex-start; }
    .ev-btn { width: 100%; border-radius: 10px; height: 45px; gap: 10px; }
    .ev-btn::after { content: 'View Details'; font-size: 0.9rem; font-weight: 600; }
}
@endsection

@section('content')

{{-- Hero Banner --}}
<div class="events-hero">
    <div class="container position-relative z-index-1">
        <h1>{{ __('messages.investor_events') }}</h1>
        <p>Corporate Activities & Meetings</p>
    </div>
</div>

<div class="container pb-5" style="position: relative; z-index: 10;">
    
    {{-- UPCOMING EVENTS --}}
    @if($upcoming->count() > 0)
        <div class="ev-section-title mt-2">
            <i class="bi bi-stars"></i> {{ __('messages.upcoming_events') }}
        </div>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                @foreach($upcoming as $event)
                    @php
                        $title = $locale == 'en' && !empty($event->title_en) ? $event->title_en : $event->title_th;
                        $sub = $locale == 'en' ? $event->title_th : $event->title_en;
                        $type = $locale == 'en' && !empty($event->eventType->name_en) ? $event->eventType->name_en : ($event->eventType->name_th ?? '');
                    @endphp
                    <div class="ev-upcoming-card">
                        <div class="ev-date-box">
                            <span class="ev-day">{{ $event->event_start->format('d') }}</span>
                            <span class="ev-month">{{ $event->event_start->format('M Y') }}</span>
                        </div>
                        
                        <div class="ev-details">
                            <span class="ev-type-badge">{{ $type }}</span>
                            <h3 class="ev-title">{{ $title }}</h3>
                            @if(!empty($sub)) <div class="ev-subtitle">{{ $sub }}</div> @endif
                            
                            <div class="ev-meta-row">
                                <div class="ev-meta-item">
                                    <i class="bi bi-clock-history"></i>
                                    {{ $event->event_start->format('H:i') }}
                                    @if($event->event_end) - {{ $event->event_end->format('H:i') }} @endif
                                </div>
                                @if($event->location)
                                <div class="ev-meta-item">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    {{ $event->location }}
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="ev-action">
                            <a href="{{ route('events.show', $event->id) }}" class="ev-btn" title="View Details">
                                <i class="bi bi-arrow-right-short fs-3"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    {{-- ALL EVENTS (Replaced Table with Grid) --}}
    <div class="mt-5">
        <div class="ev-section-title">
            <i class="bi bi-calendar4-week"></i> {{ __('messages.all_events') }}
        </div>
        
        @if($events->count() > 0)
            <div class="ev-grid">
                @foreach($events as $event)
                    @php
                        $title = $locale == 'en' && !empty($event->title_en) ? $event->title_en : $event->title_th;
                        $sub = $locale == 'en' ? $event->title_th : $event->title_en;
                        $type = $locale == 'en' && !empty($event->eventType->name_en) ? $event->eventType->name_en : ($event->eventType->name_th ?? '');
                    @endphp
                    <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none">
                        <div class="ev-card">
                            <div class="ev-card-date">
                                <i class="bi bi-calendar-event"></i>
                                {{ $event->event_start->format('d M Y') }}
                            </div>
                            
                            <h4 class="ev-card-title">{{ $title }}</h4>
                            @if(!empty($sub)) <div class="ev-card-sub">{{ $sub }}</div> @endif
                            
                            @if($event->location)
                            <div class="ev-card-loc">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $event->location }}</span>
                            </div>
                            @endif
                            
                            <div class="mt-3">
                                <span class="badge bg-light text-dark border">{{ $type }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            @if($events->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $events->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-light">
                <i class="bi bi-calendar-x d-block mb-3" style="font-size: 3rem; color: #ddd;"></i>
                <h5 class="text-muted fw-normal">{{ __('messages.no_events') }}</h5>
            </div>
        @endif
    </div>

</div>
@endsection

@extends('layouts.app')
@section('title', 'News & Announcements - CFARM IR')

@php
    $locale = session('locale', config('app.locale'));
@endphp

@section('extra_css')
/* ── News Page Premium Layout ── */
.news-hero {
    position: relative;
    padding: 70px 0 90px;
    background: linear-gradient(135deg, #0d3d11 0%, #1b5e20 40%, #2e7d32 80%, #388e3c 100%);
    overflow: hidden;
    text-align: center;
    color: #fff;
    margin-bottom: 20px;
}
.news-hero::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 50px;
    background: linear-gradient(0deg, #f5f7f9, transparent);
    z-index: 2;
}
.news-hero h1 {
    font-size: 2.5rem;
    font-weight: 300;
    letter-spacing: 2px;
    margin: 0 0 10px 0;
    text-shadow: 0 4px 15px rgba(0,0,0,0.2);
    position: relative;
    z-index: 1;
}
.news-hero p {
    font-size: 1rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    opacity: 0.7;
    margin: 0;
    position: relative;
    z-index: 1;
}
.news-hero .particle {
    position: absolute;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
    animation: float 10s infinite ease-in-out alternate;
}
@keyframes float {
    0% { transform: translateY(0) scale(1); }
    100% { transform: translateY(-30px) scale(1.1); }
}

body { background: #f5f7f9; }

/* Filter Bar */
.news-filter-bar {
    background: #fff;
    border-radius: 50px;
    padding: 8px 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    display: inline-flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-top: -65px;
    position: relative;
    z-index: 10;
    margin-bottom: 40px;
}
.news-filter-btn {
    padding: 8px 24px;
    border-radius: 30px;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--cfarm-text);
    text-decoration: none;
    transition: all 0.3s cubic-bezier(.4,0,.2,1);
    background: transparent;
    border: 1px solid transparent;
}
.news-filter-btn:hover {
    background: rgba(46,125,50,0.05);
    color: var(--cfarm-green);
}
.news-filter-btn.active {
    background: linear-gradient(135deg, var(--cfarm-green), var(--cfarm-green-dark));
    color: #fff;
    box-shadow: 0 4px 15px rgba(46,125,50,0.3);
}

/* Featured Layout */
.news-featured {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    display: flex;
    margin-bottom: 50px;
    transition: all 0.4s ease;
    border: 1px solid rgba(0,0,0,0.03);
}
.news-featured:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
}
.news-featured-img {
    flex: 0 0 55%;
    position: relative;
    overflow: hidden;
    min-height: 400px;
}
.news-featured-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease;
}
.news-featured:hover .news-featured-img img {
    transform: scale(1.05);
}
.news-featured-img::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(0,0,0,0) 50%, rgba(255,255,255,1) 100%);
}
.news-featured-content {
    flex: 1;
    padding: 40px 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: #fff;
    position: relative;
    z-index: 2;
}
.news-tag {
    display: inline-block;
    padding: 5px 14px;
    background: rgba(220,110,25,0.1);
    color: var(--cfarm-orange);
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 15px;
}
.news-featured-title {
    font-size: 1.8rem;
    font-weight: 600;
    color: var(--cfarm-text);
    line-height: 1.3;
    margin-bottom: 15px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.news-featured-excerpt {
    font-size: 1rem;
    color: var(--cfarm-text-light);
    line-height: 1.6;
    margin-bottom: 30px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.news-meta {
    font-size: 0.85rem;
    color: #999;
    display: flex;
    align-items: center;
    gap: 15px;
}

/* Setup Grid */
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
}

/* Premium News Card */
.news-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.04);
    transition: all 0.4s cubic-bezier(.4,0,.2,1);
    border: 1px solid rgba(0,0,0,0.03);
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
}
.news-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}
.news-card-img-wrap {
    height: 220px;
    overflow: hidden;
    position: relative;
}
.news-card-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.news-card:hover .news-card-img-wrap img {
    transform: scale(1.08);
}
.news-card-img-wrap::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0) 50%);
    opacity: 0;
    transition: opacity 0.4s;
}
.news-card:hover .news-card-img-wrap::after {
    opacity: 1;
}
.news-card-body {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.news-card-title {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--cfarm-text);
    margin-bottom: 12px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-decoration: none;
    transition: color 0.2s;
}
.news-card-title:hover {
    color: var(--cfarm-green);
}
.news-card-excerpt {
    font-size: 0.9rem;
    color: var(--cfarm-text-light);
    line-height: 1.6;
    margin-bottom: 20px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}
.news-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 15px;
    border-top: 1px solid rgba(0,0,0,0.05);
}
.read-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--cfarm-green);
    text-transform: uppercase;
    letter-spacing: 1px;
    text-decoration: none;
    position: relative;
    padding: 8px 16px;
    border-radius: 8px;
    background: rgba(46,125,50,0.05);
    transition: all 0.3s;
}
.read-more-btn:hover {
    background: var(--cfarm-green);
    color: #fff;
}
.read-more-btn i {
    transition: transform 0.3s;
}
.read-more-btn:hover i {
    transform: translateX(4px);
}

.news-card-meta-float {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255,255,255,0.95);
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--cfarm-text);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    backdrop-filter: blur(5px);
    z-index: 2;
}

@media (max-width: 992px) {
    .news-featured { flex-direction: column; }
    .news-featured-img { min-height: 300px; }
    .news-featured-img::after { display: none; }
    .news-featured-content { padding: 30px; }
}
@media (max-width: 768px) {
    .news-filter-bar { padding: 5px; flex-direction: column; width: 100%; border-radius: 12px; }
    .news-filter-btn { text-align: center; border-radius: 8px; }
    .news-hero h1 { font-size: 2rem; }
}
@endsection

@section('content')

{{-- Hero Banner --}}
<div class="news-hero">
    <div class="particle" style="width:150px; height:150px; left:-5%; top:10%; animation-delay: 0s;"></div>
    <div class="particle" style="width:80px; height:80px; right:15%; top:20%; animation-delay: 2s;"></div>
    <div class="particle" style="width:50px; height:50px; right:30%; bottom:20%; animation-delay: 4s;"></div>
    
    <div class="container position-relative z-index-1">
        <h1>{{ __('messages.news_announcements') }}</h1>
        <p>Updates & Press Releases</p>
    </div>
</div>

<div class="container pb-5">
    
    {{-- Centered Filter Bar --}}
    <div class="text-center">
        <div class="news-filter-bar">
            <a href="{{ route('news.index') }}" class="news-filter-btn {{ !$categoryId ? 'active' : '' }}">
                <i class="bi bi-grid me-1"></i> {{ __('messages.all') }}
            </a>
            @foreach($categories as $cat)
                @php
                    $catName = $locale == 'en' && !empty($cat->name_en) ? $cat->name_en : ($cat->name_th ?? '');
                @endphp
                <a href="{{ route('news.index', ['category' => $cat->id]) }}" class="news-filter-btn {{ $categoryId == $cat->id ? 'active' : '' }}">
                    {{ $catName }}
                </a>
            @endforeach
        </div>
    </div>

    @if($news->count() > 0)
        
        {{-- Featured News (First Item) --}}
        @php $featured = $news->first(); @endphp
        <div class="news-featured">
            <div class="news-featured-img">
                @if($featured->image_path)
                    <img src="{{ Storage::url($featured->image_path) }}" alt="{{ $featured->title_th }}">
                @else
                    <div style="width:100%; height:100%; background:linear-gradient(135deg,rgba(46,125,50,0.1),rgba(46,125,50,0.05)); display:flex; align-items:center; justify-content:center;">
                        <i class="bi bi-newspaper" style="font-size:6rem; color:var(--cfarm-green); opacity:0.1;"></i>
                    </div>
                @endif
            </div>
            <div class="news-featured-content">
                <div>
                    @php $catName = $locale == 'en' && !empty($featured->category->name_en) ? $featured->category->name_en : ($featured->category->name_th ?? ''); @endphp
                    <span class="news-tag"><i class="bi bi-bookmark-star-fill me-1"></i> {{ $catName }}</span>
                    
                    <a href="{{ route('news.show', $featured->slug) }}" class="text-decoration-none">
                        <h3 class="news-featured-title">{{ $locale == 'en' && !empty($featured->title_en) ? $featured->title_en : $featured->title_th }}</h3>
                    </a>
                    
                    <p class="news-featured-excerpt">
                        @if($locale == 'en' && !empty($featured->title_en))
                            {{ $featured->title_th }} {{-- Use Thai title as subtitle in EN mode --}}
                        @else
                            {{ $featured->title_en }} {{-- Use EN title as subtitle in TH mode --}}
                        @endif
                    </p>
                    
                    <div class="d-flex align-items-center justify-content-between mt-auto">
                        <div class="news-meta">
                            <i class="bi bi-calendar3"></i> {{ $featured->published_at?->format('d M Y') }}
                        </div>
                        <a href="{{ route('news.show', $featured->slug) }}" class="read-more-btn">
                            {{ __('messages.read_more') }} <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- News Grid (Remaining Items) --}}
        <div class="news-grid">
            @foreach($news->skip(1) as $item)
                @php
                    $itemCatName = $locale == 'en' && !empty($item->category->name_en) ? $item->category->name_en : ($item->category->name_th ?? '');
                    $itemTitle = $locale == 'en' && !empty($item->title_en) ? $item->title_en : $item->title_th;
                    $itemSub = $locale == 'en' ? $item->title_th : $item->title_en;
                @endphp
                <div class="news-card">
                    <div class="news-card-meta-float">
                        <i class="bi bi-tag-fill text-success me-1"></i> {{ $itemCatName }}
                    </div>
                    
                    <div class="news-card-img-wrap">
                        @if($item->image_path)
                            <img src="{{ Storage::url($item->image_path) }}" alt="{{ $itemTitle }}">
                        @else
                            <div style="width:100%; height:100%; background:linear-gradient(135deg,rgba(46,125,50,0.1),rgba(46,125,50,0.05)); display:flex; align-items:center; justify-content:center;">
                                <i class="bi bi-image" style="font-size:3rem; color:var(--cfarm-green); opacity:0.1;"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="news-card-body">
                        <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none">
                            <h4 class="news-card-title" title="{{ $itemTitle }}">{{ $itemTitle }}</h4>
                        </a>
                        
                        <div class="news-card-excerpt">
                            {{ $itemSub }}
                        </div>
                        
                        <div class="news-card-footer">
                            <div class="news-meta">
                                <i class="bi bi-clock"></i> {{ $item->published_at?->format('d M Y') }}
                            </div>
                            <a href="{{ route('news.show', $item->slug) }}" class="read-more-btn px-2 py-1">
                                <i class="bi bi-arrow-right fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($news->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $news->links() }}
            </div>
        @endif
        
    @else
        <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-light">
            <i class="bi bi-newspaper d-block mb-3" style="font-size: 3rem; color: #ddd;"></i>
            <h5 class="text-muted fw-normal">{{ __('messages.no_news') }}</h5>
            <a href="{{ route('news.index') }}" class="btn btn-outline-success mt-3 rounded-pill px-4">Clear Filters</a>
        </div>
    @endif

</div>
@endsection

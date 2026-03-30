@extends('layouts.app')
@section('title', $news->title_en . ' - CFARM IR')
@section('meta_description', Str::limit(strip_tags($news->content_en), 160))
@section('content')
<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}">{{ __('messages.news') }}</a></li>
                <li class="breadcrumb-item active">{{ Str::limit(session('locale') == 'en' && !empty($news->title_en) ? $news->title_en : $news->title_th, 40) }}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-8">
                <span class="badge badge-category mb-2">{{ session('locale') == 'en' && !empty($news->category->name_en) ? $news->category->name_en : ($news->category->name_th ?? '') }}</span>
                <h1 class="mb-2">{{ session('locale') == 'en' && !empty($news->title_en) ? $news->title_en : $news->title_th }}</h1>
                <h5 class="text-muted mb-3">{{ session('locale') == 'en' ? $news->title_th : $news->title_en }}</h5>
                <p class="text-muted small"><i class="bi bi-calendar3"></i> {{ $news->published_at?->format('d M Y H:i') }} | <i class="bi bi-person"></i> {{ $news->author->name ?? '' }}</p>
                <hr>
                @if($news->image_path)
                <div class="mb-4 rounded-3 overflow-hidden shadow-sm">
                    <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title_th }}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
                </div>
                @endif
                <div class="mb-4">{!! nl2br(e(session('locale') == 'en' && !empty($news->content_en) ? $news->content_en : $news->content_th)) !!}</div>
                @if(session('locale') == 'en' && $news->content_th && $news->content_en)
                <hr><h5>Thai Version</h5>
                <div>{!! nl2br(e($news->content_th)) !!}</div>
                @elseif(session('locale') != 'en' && $news->content_en)
                <hr><h5>English Version</h5>
                <div>{!! nl2br(e($news->content_en)) !!}</div>
                @endif
                <div class="mt-3">
                    @foreach($news->tags as $tag)
                        <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title">{{ __('messages.related_news') }}</h5>
                @foreach($related as $item)
                <div class="card card-hover mb-3">
                    <div class="card-body py-3">
                        <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none text-dark">
                            <h6 class="mb-1">{{ session('locale') == 'en' && !empty($item->title_en) ? $item->title_en : $item->title_th }}</h6>
                            <small class="text-muted">{{ $item->published_at?->format('d M Y') }}</small>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

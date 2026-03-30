@extends('layouts.app')
@section('title', 'Search - CFARM IR')
@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="section-title">{{ __('messages.search') }}</h2>
        <form action="{{ route('search') }}" method="GET" class="mb-4">
            <div class="input-group input-group-lg">
                <input type="search" name="q" class="form-control" placeholder="{{ __('messages.search_placeholder') }}" value="{{ $query }}">
                <button class="btn btn-cfarm"><i class="bi bi-search"></i> {{ __('messages.search_button') }}</button>
            </div>
        </form>
        @if($query)
        <p class="text-muted">{{ __('messages.found') }} {{ $results->count() }} {{ __('messages.results_for') }} "<strong>{{ $query }}</strong>"</p>
        @foreach($results as $result)
        <div class="card card-hover mb-3">
            <div class="card-body">
                <span class="badge bg-{{ $result['type'] === 'news' ? 'primary' : ($result['type'] === 'document' ? 'success' : ($result['type'] === 'financial' ? 'danger' : 'info')) }} mb-2">{{ __('messages.' . $result['type']) }}</span>
                <h5>{{ session('locale') == 'en' && !empty($result['item']->title_en) ? $result['item']->title_en : $result['item']->title_th }}</h5>
                <p class="text-muted small">{{ session('locale') == 'en' ? $result['item']->title_th : $result['item']->title_en }}</p>
                @if($result['type'] === 'news')
                    <a href="{{ route('news.show', $result['item']->slug) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.read_more') }}</a>
                @endif
            </div>
        </div>
        @endforeach
        @endif
    </div>
</section>
@endsection

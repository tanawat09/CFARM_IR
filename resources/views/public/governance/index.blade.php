@extends('layouts.app')
@section('title', 'Corporate Governance - CFARM IR')
@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="section-title">{{ __('messages.governance') }}</h2>
        <div class="row g-4">
            @foreach($documents as $doc)
            <div class="col-md-6 col-lg-4">
                <div class="card card-hover h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-shield-check fs-1 text-info mb-3"></i>
                        <h6>{{ session('locale') == 'en' && !empty($doc->title_en) ? $doc->title_en : $doc->title_th }}</h6>
                        <p class="text-muted small">{{ session('locale') == 'en' ? $doc->title_th : $doc->title_en }}</p>
                        <p class="small"><strong>{{ __('messages.version') }}:</strong> {{ $doc->version }} | <strong>{{ __('messages.effective_date') }}:</strong> {{ $doc->effective_date?->format('d M Y') }}</p>
                    </div>
                    <div class="card-footer bg-transparent text-center">
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="bi bi-download"></i> {{ __('messages.download') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

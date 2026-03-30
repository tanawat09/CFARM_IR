@extends('layouts.app')
@section('title', 'Board of Directors - CFARM IR')
@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="section-title">{{ __('messages.board_of_directors') }}</h2>
        <div class="row g-4">
            @foreach($directors as $director)
            <div class="col-md-6 col-lg-4">
                <div class="card card-hover h-100 text-center">
                    <div class="card-body">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;font-size:2rem;">
                            @if($director->image_path)
                                <img src="{{ asset('storage/' . $director->image_path) }}" class="rounded-circle" style="width:80px;height:80px;object-fit:cover;">
                            @else
                                <i class="bi bi-person"></i>
                            @endif
                        </div>
                        <h5>{{ session('locale') == 'en' && !empty($director->name_en) ? $director->name_en : $director->name_th }}</h5>
                        <p class="text-muted small">{{ session('locale') == 'en' ? $director->name_th : $director->name_en }}</p>
                        <p class="fw-bold text-primary small">{{ session('locale') == 'en' && !empty($director->position_en) ? $director->position_en : $director->position_th }}</p>
                        <p class="text-muted small">{{ session('locale') == 'en' ? $director->position_th : $director->position_en }}</p>
                        @if(session('locale') == 'en' ? $director->biography_en : $director->biography_th)
                        <hr>
                        <p class="small">{{ Str::limit(session('locale') == 'en' ? $director->biography_en : $director->biography_th, 150) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

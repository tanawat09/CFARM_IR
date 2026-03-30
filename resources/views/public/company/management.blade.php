@extends('layouts.app')
@section('title', 'Management Team - CFARM IR')
@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="section-title">{{ __('messages.management_team') }}</h2>
        <div class="row g-4">
            @foreach($team as $member)
            <div class="col-md-6 col-lg-4">
                <div class="card card-hover h-100 text-center">
                    <div class="card-body">
                        <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;font-size:2rem;">
                            <i class="bi bi-person"></i>
                        </div>
                        <h5>{{ session('locale') == 'en' && !empty($member->name_en) ? $member->name_en : $member->name_th }}</h5>
                        <p class="text-muted small">{{ session('locale') == 'en' ? $member->name_th : $member->name_en }}</p>
                        <p class="fw-bold text-success small">{{ session('locale') == 'en' && !empty($member->position_en) ? $member->position_en : $member->position_th }}</p>
                        <p class="text-muted small">{{ session('locale') == 'en' ? $member->position_th : $member->position_en }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

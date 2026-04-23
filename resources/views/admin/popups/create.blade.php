@extends('layouts.admin')
@section('title', 'สร้าง Popup - CFARM Admin')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.popups.index') }}" class="text-decoration-none text-muted"><i class="bi bi-arrow-left"></i> กลับไปรายการ</a>
    <h3 class="mt-2"><i class="bi bi-window-plus"></i> สร้าง Popup ใหม่</h3>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.popups.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.popups._form')
            <hr>
            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> บันทึก</button>
            <a href="{{ route('admin.popups.index') }}" class="btn btn-light ms-2">ยกเลิก</a>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'เพิ่มโครงสร้างรายได้ - CFARM IR')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.revenue-structures.index') }}" class="btn btn-outline-secondary me-3 shadow-sm">
        <i class="bi bi-arrow-left"></i> กลับ
    </a>
    <h2 class="h3 text-gray-800 mb-0">
        <i class="bi bi-plus-circle text-primary me-2"></i> เพิ่มโครงสร้างรายได้ใหม่
    </h2>
</div>

@if ($errors->any())
<div class="alert alert-danger shadow-sm">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow border-0 mb-5">
    <div class="card-body p-4">
        <form action="{{ route('admin.revenue-structures.store') }}" method="POST">
            @csrf

            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label class="form-label fw-bold">หัวข้อภาษาไทย (TH) <span class="text-danger">*</span></label>
                    <input type="text" name="title_th" class="form-control" value="{{ old('title_th') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-secondary">หัวข้อภาษาอังกฤษ (EN)</label>
                    <input type="text" name="title_en" class="form-control bg-light" value="{{ old('title_en') }}">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label class="form-label fw-bold">รายละเอียดภาษาไทย (TH)</label>
                    <textarea name="description_th" class="form-control" rows="3">{{ old('description_th') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-secondary">รายละเอียดภาษาอังกฤษ (EN)</label>
                    <textarea name="description_en" class="form-control bg-light" rows="3">{{ old('description_en') }}</textarea>
                </div>
            </div>

            <div class="row mb-4 bg-light p-3 rounded-3 border">
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="form-label fw-bold">สัดส่วน (%) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" name="percentage" class="form-control" value="{{ old('percentage', 0) }}" min="0" max="100" required>
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="form-label fw-bold">Icon class or custom icon</label>
                    <input type="text" name="icon_class" class="form-control" value="{{ old('icon_class') }}" placeholder="cfarm-chicken">
                    <small class="text-muted">Examples: <code>cfarm-chicken</code>, <code>bi bi-pie-chart</code></small>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="form-label fw-bold">สีของส่วนประกอบ</label>
                    <select name="color" class="form-select">
                        <option value="primary" {{ old('color') == 'primary' ? 'selected' : '' }}>Primary (น้ำเงิน)</option>
                        <option value="success" {{ old('color') == 'success' ? 'selected' : '' }}>Success (เขียว)</option>
                        <option value="warning" {{ old('color') == 'warning' ? 'selected' : '' }}>Warning (ส้ม)</option>
                        <option value="danger" {{ old('color') == 'danger' ? 'selected' : '' }}>Danger (แดง)</option>
                        <option value="info" {{ old('color') == 'info' ? 'selected' : '' }}>Info (ฟ้า)</option>
                        <option value="dark" {{ old('color') == 'dark' ? 'selected' : '' }}>Dark (ดำ)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">ลำดับการแสดงผล <span class="text-danger">*</span></label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0" required>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                    <i class="bi bi-save me-2"></i> บันทึกข้อมูล
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

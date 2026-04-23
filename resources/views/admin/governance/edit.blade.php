@extends('layouts.admin')
@section('title', 'แก้ไขเอกสารกำกับดูแลกิจการ - CFARM Admin')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.governance.index') }}" class="text-decoration-none text-muted"><i class="bi bi-arrow-left"></i> กลับไปรายการ</a>
    <h3 class="mt-2"><i class="bi bi-shield-check"></i> แก้ไขเอกสารกำกับดูแลกิจการ</h3>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.governance.update', $governance) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">หัวข้อ (ไทย) <span class="text-danger">*</span></label>
                    <input type="text" name="title_th" class="form-control @error('title_th') is-invalid @enderror" value="{{ old('title_th', $governance->title_th) }}" required>
                    @error('title_th') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">หัวข้อ (อังกฤษ)</label>
                    <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en', $governance->title_en) }}">
                    @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">หมวดหมู่ <span class="text-danger">*</span></label>
                    <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                        <option value="">-- เลือกหมวดหมู่ --</option>
                        @foreach($sections as $key => $sec)
                            <option value="{{ $key }}" {{ old('category', $governance->category) == $key ? 'selected' : '' }}>{{ $sec['th'] }}</option>
                        @endforeach
                    </select>
                    @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">เวอร์ชัน</label>
                    <input type="text" name="version" class="form-control" value="{{ old('version', $governance->version) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">ลำดับการแสดง</label>
                    <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $governance->display_order) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">วันที่มีผลบังคับใช้</label>
                    <input type="date" name="effective_date" class="form-control" value="{{ old('effective_date', $governance->effective_date?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">ไฟล์เอกสาร</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.doc,.docx">
                    @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if($governance->file_path)
                        <small class="text-muted">ไฟล์ปัจจุบัน: <a href="{{ asset('storage/' . $governance->file_path) }}" target="_blank">{{ basename($governance->file_path) }}</a></small>
                    @endif
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> อัปเดต</button>
            <a href="{{ route('admin.governance.index') }}" class="btn btn-light ms-2">ยกเลิก</a>
        </form>
    </div>
</div>
@endsection

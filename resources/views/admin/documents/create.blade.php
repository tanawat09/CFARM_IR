@extends('layouts.admin')
@section('title', 'เพิ่มเอกสาร - CFARM Admin')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.documents.index') }}" class="text-decoration-none text-muted"><i class="bi bi-arrow-left"></i> กลับไปรายการเอกสาร</a>
    <h3 class="mt-2"><i class="bi bi-file-earmark-plus"></i> เพิ่มเอกสารใหม่</h3>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">หัวข้อ (ไทย) <span class="text-danger">*</span></label>
                    <input type="text" name="title_th" class="form-control @error('title_th') is-invalid @enderror" value="{{ old('title_th') }}" required>
                    @error('title_th') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">หัวข้อ (อังกฤษ)</label>
                    <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en') }}">
                    @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">หมวดหมู่ <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- เลือกหมวดหมู่ --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name_th }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">ปี</label>
                    <select name="year_id" class="form-select @error('year_id') is-invalid @enderror">
                        <option value="">-- เลือกปี (ไม่บังคับ) --</option>
                        @foreach($years as $year)
                            <option value="{{ $year->id }}" {{ old('year_id') == $year->id ? 'selected' : '' }}>
                                {{ $year->year }}
                            </option>
                        @endforeach
                    </select>
                    @error('year_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">ไฟล์เอกสาร (PDF, DOCX, XLSX) <span class="text-danger">*</span></label>
                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required accept=".pdf,.doc,.docx,.xls,.xlsx">
                <small class="text-muted">ขนาดไฟล์สูงสุด: 20MB</small>
                @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save"></i> บันทึกเอกสาร</button>
            </div>
        </form>
    </div>
</div>
@endsection

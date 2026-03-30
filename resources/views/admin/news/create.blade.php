@extends('layouts.admin')
@section('title', 'เพิ่มข่าว - CFARM Admin')
@section('content')
<h3 class="mb-4"><i class="bi bi-plus-lg"></i> เพิ่มข่าวใหม่</h3>
<div class="card card-hover">
    <div class="card-body">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">หัวข้อ (ไทย) *</label>
                    <input type="text" name="title_th" class="form-control @error('title_th') is-invalid @enderror" value="{{ old('title_th') }}" required>
                    @error('title_th')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">หัวข้อ (อังกฤษ)</label>
                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">เนื้อหา (ไทย)</label>
                <textarea name="content_th" rows="5" class="form-control">{{ old('content_th') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">เนื้อหา (อังกฤษ)</label>
                <textarea name="content_en" rows="5" class="form-control">{{ old('content_en') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">หมวดหมู่ *</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name_en }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">วันที่เผยแพร่</label>
                    <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at') }}">
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <div class="form-check">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" value="1" class="form-check-input" id="is_published" {{ old('is_published') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">เผยแพร่ทันที</label>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">รูปปก</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                <small class="text-muted">ขนาดแนะนำ: 800x600 พิกเซล สูงสุด: 5MB</small>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">แท็ก</label>
                <div>@foreach($tags as $tag)<div class="form-check form-check-inline"><input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="form-check-input"><label class="form-check-label">{{ $tag->name }}</label></div>@endforeach</div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> บันทึก</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>
</div>
@endsection

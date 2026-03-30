@extends('layouts.admin')
@section('title', 'แก้ไขข่าว - CFARM Admin')
@section('content')
<h3 class="mb-4"><i class="bi bi-pencil"></i> แก้ไขข่าว</h3>
<div class="card card-hover">
    <div class="card-body">
        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">หัวข้อ (ไทย) *</label>
                    <input type="text" name="title_th" class="form-control" value="{{ old('title_th', $news->title_th) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">หัวข้อ (อังกฤษ)</label>
                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $news->title_en) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">เนื้อหา (ไทย)</label>
                <textarea name="content_th" rows="5" class="form-control">{{ old('content_th', $news->content_th) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">เนื้อหา (อังกฤษ)</label>
                <textarea name="content_en" rows="5" class="form-control">{{ old('content_en', $news->content_en) }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">หมวดหมู่ *</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $cat)<option value="{{ $cat->id }}" {{ $news->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name_en }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">วันที่เผยแพร่</label>
                    <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', $news->published_at?->format('Y-m-d\TH:i')) }}">
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <div class="form-check">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" value="1" class="form-check-input" id="is_published" {{ $news->is_published ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">เผยแพร่แล้ว</label>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">รูปปก</label>
                @if($news->image_path)
                    <div class="mb-2">
                        <img src="{{ Storage::url($news->image_path) }}" alt="รูปปัจจุบัน" class="img-thumbnail" style="max-height: 150px;">
                    </div>
                @endif
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                <small class="text-muted">ขนาดแนะนำ: 800x600 พิกเซล สูงสุด: 5MB อัปโหลดรูปใหม่เพื่อแทนที่รูปเดิม</small>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">แท็ก</label>
                <div>@foreach($tags as $tag)<div class="form-check form-check-inline"><input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="form-check-input" {{ $news->tags->contains($tag->id) ? 'checked' : '' }}><label class="form-check-label">{{ $tag->name }}</label></div>@endforeach</div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> อัปเดต</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>
</div>
@endsection

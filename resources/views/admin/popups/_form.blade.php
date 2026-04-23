@php $p = $popup ?? null; @endphp

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">หัวข้อ (ไทย) <span class="text-danger">*</span></label>
        <input type="text" name="title_th" class="form-control @error('title_th') is-invalid @enderror" value="{{ old('title_th', $p?->title_th) }}" required>
        @error('title_th') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">หัวข้อ (English)</label>
        <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en', $p?->title_en) }}">
        @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">เนื้อหา (ไทย)</label>
        <textarea name="content_th" class="form-control" rows="4">{{ old('content_th', $p?->content_th) }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">เนื้อหา (English)</label>
        <textarea name="content_en" class="form-control" rows="4">{{ old('content_en', $p?->content_en) }}</textarea>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">รูปภาพ Popup</label>
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">แนะนำขนาด 600x400px (JPG, PNG, WebP สูงสุด 10MB)</small>
        @if($p?->image_path)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $p->image_path) }}" class="img-fluid rounded" style="max-height:120px;">
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <label class="form-label">ลิงก์ URL (ถ้ามี)</label>
        <input type="url" name="link_url" class="form-control" value="{{ old('link_url', $p?->link_url) }}" placeholder="https://...">
        <div class="row mt-2">
            <div class="col-6">
                <label class="form-label small">ข้อความปุ่ม (ไทย)</label>
                <input type="text" name="link_text_th" class="form-control form-control-sm" value="{{ old('link_text_th', $p?->link_text_th ?? 'ดูรายละเอียด') }}">
            </div>
            <div class="col-6">
                <label class="form-label small">ข้อความปุ่ม (EN)</label>
                <input type="text" name="link_text_en" class="form-control form-control-sm" value="{{ old('link_text_en', $p?->link_text_en ?? 'View Details') }}">
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <label class="form-label">แสดงที่</label>
        <select name="display_pages" class="form-select">
            <option value="home" {{ old('display_pages', $p?->display_pages) == 'home' ? 'selected' : '' }}>หน้าแรกเท่านั้น</option>
            <option value="all" {{ old('display_pages', $p?->display_pages) == 'all' ? 'selected' : '' }}>ทุกหน้า</option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">ลำดับ</label>
        <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $p?->display_order ?? 0) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">วันเริ่มแสดง</label>
        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $p?->start_date?->format('Y-m-d')) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">วันสิ้นสุด</label>
        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $p?->end_date?->format('Y-m-d')) }}">
        @error('end_date') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $p?->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">เปิดใช้งาน Popup</label>
    </div>
</div>

@extends('layouts.admin')
@section('title', 'แก้ไขเนื้อหาหมวด - CFARM Admin')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.governance.index') }}" class="text-decoration-none text-muted"><i class="bi bi-arrow-left"></i> กลับไปรายการ</a>
    <h3 class="mt-2"><i class="bi bi-{{ $sections[$key]['icon'] }}"></i> แก้ไขเนื้อหาหมวด: {{ $sections[$key]['th'] }}</h3>
    <p class="text-muted">{{ $sections[$key]['en'] }}</p>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.governance.section.update', $key) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">เนื้อหา (ไทย)</label>
                <small class="text-muted d-block mb-2">รองรับ HTML - สามารถใส่ &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;&lt;li&gt;, &lt;strong&gt; ได้</small>
                <textarea name="content_th" class="form-control" rows="12" style="font-family: monospace; font-size: 0.85rem;">{{ old('content_th', $sectionContent->content_th) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">เนื้อหา (English)</label>
                <textarea name="content_en" class="form-control" rows="12" style="font-family: monospace; font-size: 0.85rem;">{{ old('content_en', $sectionContent->content_en) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">รูปภาพประกอบ (เช่น แผนผังองค์กร)</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @if($sectionContent->image_path)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $sectionContent->image_path) }}" class="img-fluid rounded" style="max-height:200px;">
                        <small class="text-muted d-block">ไฟล์ปัจจุบัน: {{ basename($sectionContent->image_path) }}</small>
                    </div>
                @endif
            </div>

            <hr>
            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> บันทึก</button>
            <a href="{{ route('admin.governance.index') }}" class="btn btn-light ms-2">ยกเลิก</a>
        </form>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header bg-light"><strong>ตัวอย่าง HTML</strong></div>
    <div class="card-body">
        <pre class="bg-light p-3 rounded" style="font-size:0.8rem;"><code>&lt;h3&gt;โครงสร้างองค์กร&lt;/h3&gt;
&lt;p&gt;บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) มีโครงสร้างการกำกับดูแลกิจการที่ดี ประกอบด้วย...&lt;/p&gt;
&lt;ul&gt;
    &lt;li&gt;คณะกรรมการบริษัท&lt;/li&gt;
    &lt;li&gt;คณะกรรมการตรวจสอบ&lt;/li&gt;
    &lt;li&gt;คณะกรรมการบริหาร&lt;/li&gt;
&lt;/ul&gt;</code></pre>
    </div>
</div>
@endsection

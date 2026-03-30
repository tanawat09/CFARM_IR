@extends('layouts.admin')
@section('title', 'แก้ไขรายงานทางการเงิน')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">แก้ไขรายงาน: {{ $financialReport->title_th }}</h2>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.financial-reports.index') }}" class="btn btn-secondary btn-sm">
            <i class="fe fe-arrow-left"></i> กลับไปรายการ
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('admin.financial-reports.update', $financialReport->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title_th">หัวข้อ (ไทย) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title_th" name="title_th" value="{{ old('title_th', $financialReport->title_th) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="title_en">หัวข้อ (อังกฤษ)</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en', $financialReport->title_en) }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category_id">หมวดหมู่ <span class="text-danger">*</span></label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">เลือกหมวดหมู่</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $financialReport->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_th }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="year_id">ปี <span class="text-danger">*</span></label>
                            <select class="form-control" id="year_id" name="year_id" required>
                                <option value="">เลือกปี</option>
                                @foreach($years as $year)
                                    <option value="{{ $year->id }}" {{ old('year_id', $financialReport->year_id) == $year->id ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="file_path">เปลี่ยนไฟล์รายงาน (เว้นว่างหากไม่ต้องการเปลี่ยน)</label>
                        @if($financialReport->file_path)
                            <div class="mb-2">
                                <a href="{{ Storage::url($financialReport->file_path) }}" target="_blank" class="small text-primary"><i class="fe fe-paperclip"></i> ไฟล์ปัจจุบัน</a>
                            </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_path" name="file_path" accept=".pdf,.xls,.xlsx,.doc,.docx">
                            <label class="custom-file-label" for="file_path">เลือกไฟล์ใหม่</label>
                        </div>
                        <small class="text-muted">ขนาดไฟล์สูงสุด: 10MB</small>
                    </div>

                    <button type="submit" class="btn btn-primary">อัปเดตรายงาน</button>
                    <a href="{{ route('admin.financial-reports.index') }}" class="btn btn-light ml-2">ยกเลิก</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.custom-file-input').on('change',function(){
        var fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endsection

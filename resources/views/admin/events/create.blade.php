@extends('layouts.admin')
@section('title', 'เพิ่มกิจกรรม')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">เพิ่มกิจกรรมใหม่</h2>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-sm">
            <i class="fe fe-arrow-left"></i> กลับไปรายการ
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
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
                
                <form action="{{ route('admin.events.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title_th">หัวข้อกิจกรรม (ไทย) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title_th" name="title_th" value="{{ old('title_th') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="title_en">หัวข้อกิจกรรม (อังกฤษ)</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en') }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="event_type_id">ประเภทกิจกรรม <span class="text-danger">*</span></label>
                            <select class="form-control" id="event_type_id" name="event_type_id" required>
                                <option value="">เลือกประเภทกิจกรรม</option>
                                @foreach(\App\Models\EventType::all() as $type)
                                    <option value="{{ $type->id }}" {{ old('event_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name_th }} / {{ $type->name_en }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="event_start">วันเวลาเริ่ม <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="event_start" name="event_start" value="{{ old('event_start') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="event_end">วันเวลาสิ้นสุด</label>
                            <input type="datetime-local" class="form-control" id="event_end" name="event_end" value="{{ old('event_end') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location">สถานที่ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="description_th">รายละเอียด (ไทย)</label>
                            <textarea class="form-control" id="description_th" name="description_th" rows="4">{{ old('description_th') }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="description_en">รายละเอียด (อังกฤษ)</label>
                            <textarea class="form-control" id="description_en" name="description_en" rows="4">{{ old('description_en') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="status">สถานะ</label>
                        <select class="form-control" id="status" name="status">
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>เผยแพร่</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>ฉบับร่าง</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">บันทึกกิจกรรม</button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-light ml-2">ยกเลิก</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

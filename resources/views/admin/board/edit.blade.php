@extends('layouts.admin')
@section('title', 'แก้ไขกรรมการ')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">แก้ไขกรรมการ: {{ $director->name_th }}</h2>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.board.index') }}" class="btn btn-secondary btn-sm">
            <i class="fe fe-arrow-left"></i> กลับไปรายการ
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-10 mx-auto">
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
                
                <form action="{{ route('admin.board.update', $director->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name_th">ชื่อ (ไทย) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name_th" name="name_th" value="{{ old('name_th', $director->name_th) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name_en">ชื่อ (อังกฤษ)</label>
                            <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en', $director->name_en) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="position_th">ตำแหน่ง (ไทย) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="position_th" name="position_th" value="{{ old('position_th', $director->position_th) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="position_en">ตำแหน่ง (อังกฤษ)</label>
                            <input type="text" class="form-control" id="position_en" name="position_en" value="{{ old('position_en', $director->position_en) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="biography_th">ประวัติ (ไทย)</label>
                            <textarea class="form-control" id="biography_th" name="biography_th" rows="4">{{ old('biography_th', $director->biography_th) }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="biography_en">ประวัติ (อังกฤษ)</label>
                            <textarea class="form-control" id="biography_en" name="biography_en" rows="4">{{ old('biography_en', $director->biography_en) }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="image">เปลี่ยนรูปโปรไฟล์ (JPG, PNG)</label>
                            @if($director->image_path)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($director->image_path) }}" alt="{{ $director->name_en }}" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            @endif
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/jpeg,image/png">
                                <label class="custom-file-label" for="image">เลือกรูปใหม่</label>
                            </div>
                            <small class="text-muted">ขนาดไฟล์สูงสุด: 2MB เว้นว่างหากไม่ต้องการเปลี่ยน</small>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="display_order">ลำดับการแสดง <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="display_order" name="display_order" value="{{ old('display_order', $director->display_order) }}" required>
                            <small class="text-muted">ตัวเลขน้อยกว่าจะแสดงก่อน</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">อัปเดตกรรมการ</button>
                    <a href="{{ route('admin.board.index') }}" class="btn btn-light ml-2">ยกเลิก</a>
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

@extends('layouts.admin')
@section('title', 'แก้ไขผู้ถือหุ้น')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">แก้ไขผู้ถือหุ้น: {{ $shareholder->shareholder_name_th }}</h2>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.shareholders.index') }}" class="btn btn-secondary btn-sm">
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
                
                <form action="{{ route('admin.shareholders.update', $shareholder->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="shareholder_name_th">ชื่อ (ไทย) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="shareholder_name_th" name="shareholder_name_th" value="{{ old('shareholder_name_th', $shareholder->shareholder_name_th) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="shareholder_name_en">ชื่อ (อังกฤษ)</label>
                            <input type="text" class="form-control" id="shareholder_name_en" name="shareholder_name_en" value="{{ old('shareholder_name_en', $shareholder->shareholder_name_en) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="number_of_shares">จำนวนหุ้น <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="number_of_shares" name="number_of_shares" value="{{ old('number_of_shares', $shareholder->number_of_shares) }}" required min="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="percentage">สัดส่วน (%) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="percentage" name="percentage" value="{{ old('percentage', $shareholder->percentage) }}" required min="0" max="100">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="as_of_date">ข้อมูล ณ วันที่</label>
                            <input type="date" class="form-control" id="as_of_date" name="as_of_date" value="{{ old('as_of_date', $shareholder->as_of_date ? $shareholder->as_of_date->format('Y-m-d') : '') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">อัปเดตผู้ถือหุ้น</button>
                    <a href="{{ route('admin.shareholders.index') }}" class="btn btn-light ml-2">ยกเลิก</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

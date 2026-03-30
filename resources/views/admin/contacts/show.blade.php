@extends('layouts.admin')

@section('title', 'รายละเอียดข้อความติดต่อ')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">รายละเอียดข้อความติดต่อ</h1>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> กลับไปหน้ารายการ
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow border-0 mb-4 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="m-0 font-weight-bold text-primary">ข้อมูลผู้ติดต่อ</h5>
                </div>
                <div class="card-body px-4 py-4">
                    <div class="row mb-3 pb-3 border-bottom">
                        <div class="col-md-3 text-muted">วันที่ส่ง:</div>
                        <div class="col-md-9 fw-bold">{{ $contact->created_at ? $contact->created_at->format('d F Y เวลา H:i น.') : '-' }}</div>
                    </div>
                    <div class="row mb-3 pb-3 border-bottom">
                        <div class="col-md-3 text-muted">ชื่อผู้ติดต่อ:</div>
                        <div class="col-md-9 fw-bold">{{ $contact->name }}</div>
                    </div>
                    <div class="row mb-3 pb-3 border-bottom">
                        <div class="col-md-3 text-muted">อีเมล:</div>
                        <div class="col-md-9"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></div>
                    </div>
                    <div class="row mb-3 pb-3 border-bottom">
                        <div class="col-md-3 text-muted">เบอร์โทรศัพท์:</div>
                        <div class="col-md-9">{{ $contact->phone ?? 'ไม่ได้ระบุ' }}</div>
                    </div>

                    <div class="mt-4">
                        <h6 class="text-muted fw-bold mb-3"><i class="fas fa-comment-alt me-2"></i> ข้อความ:</h6>
                        <div class="p-4 bg-light rounded-3" style="font-size: 1.1rem; line-height: 1.6; white-space: pre-wrap;">{{ $contact->message }}</div>
                    </div>

                    <div class="mt-5 text-end">
                        <a href="mailto:{{ $contact->email }}" class="btn btn-primary px-4 rounded-pill">
                            <i class="fas fa-reply"></i> ตอบกลับทางอีเมล
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('ยืนยันการลบข้อความนี้ใช่หรือไม่?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger px-4 rounded-pill">
                                <i class="fas fa-trash-alt"></i> ลบข้อความ
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

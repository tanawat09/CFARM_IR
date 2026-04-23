@extends('layouts.admin')
@section('title', 'จัดการ Popup - CFARM Admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h5 page-title"><i class="bi bi-window-stack"></i> จัดการ Popup</h2>
        <p class="text-muted mb-0">รายการ Popup ทั้งหมด {{ $popups->count() }} รายการ</p>
    </div>
    <a href="{{ route('admin.popups.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> สร้าง Popup ใหม่</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle"></i> {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:50px">#</th>
                    <th>รูปภาพ</th>
                    <th>หัวข้อ</th>
                    <th>แสดงที่</th>
                    <th>ช่วงเวลา</th>
                    <th>สถานะ</th>
                    <th style="width:140px">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($popups as $i => $popup)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        @if($popup->image_path)
                            <img src="{{ asset('storage/' . $popup->image_path) }}" class="rounded" style="width:60px; height:40px; object-fit:cover;">
                        @else
                            <span class="text-muted"><i class="bi bi-image"></i></span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $popup->title_th }}</strong>
                        @if($popup->title_en)<br><small class="text-muted">{{ $popup->title_en }}</small>@endif
                    </td>
                    <td>
                        <span class="badge {{ $popup->display_pages == 'all' ? 'bg-primary' : 'bg-info' }}">
                            {{ $popup->display_pages == 'all' ? 'ทุกหน้า' : 'หน้าแรก' }}
                        </span>
                    </td>
                    <td>
                        @if($popup->start_date || $popup->end_date)
                            <small>{{ $popup->start_date?->format('d/m/Y') ?? '-' }} ถึง {{ $popup->end_date?->format('d/m/Y') ?? '-' }}</small>
                        @else
                            <small class="text-muted">ไม่จำกัด</small>
                        @endif
                    </td>
                    <td>
                        @if($popup->is_active)
                            <span class="badge bg-success">เปิดใช้งาน</span>
                        @else
                            <span class="badge bg-secondary">ปิด</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.popups.edit', $popup) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.popups.destroy', $popup) }}" method="POST" class="d-inline" onsubmit="return confirm('ยืนยันลบ Popup นี้?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4"><i class="bi bi-window-stack fs-3 d-block mb-2"></i>ยังไม่มี Popup</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

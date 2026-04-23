@extends('layouts.admin')
@section('title', 'จัดการเอกสารกำกับดูแลกิจการ - CFARM Admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h5 page-title">จัดการเอกสารกำกับดูแลกิจการ</h2>
        <p class="text-muted mb-0">รายการเอกสารทั้งหมด {{ $documents->count() }} รายการ</p>
    </div>
    <a href="{{ route('admin.governance.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> เพิ่มเอกสาร</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle"></i> {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

{{-- Section Content Management --}}
<div class="card mb-4">
    <div class="card-header bg-light">
        <strong><i class="bi bi-layout-text-sidebar-reverse"></i> จัดการเนื้อหาแต่ละหมวด</strong>
        <small class="text-muted ms-2">(เนื้อหา HTML + รูปภาพประกอบ)</small>
    </div>
    <div class="card-body">
        <div class="row g-2">
            @foreach($sections as $key => $sec)
                <div class="col-md-4 col-lg-3">
                    <a href="{{ route('admin.governance.section.edit', $key) }}" 
                       class="btn btn-outline-secondary btn-sm w-100 text-start {{ in_array($key, $sectionContents) ? 'border-success text-success' : '' }}">
                        <i class="bi {{ $sec['icon'] }} me-1"></i>
                        {{ $sec['th'] }}
                        @if(in_array($key, $sectionContents))
                            <i class="bi bi-check-circle-fill text-success float-end mt-1"></i>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Documents Table --}}
<div class="card">
    <div class="card-header bg-light"><strong><i class="bi bi-file-earmark-text"></i> เอกสารทั้งหมด</strong></div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:40px">#</th>
                    <th>หัวข้อ</th>
                    <th>หมวดหมู่</th>
                    <th>เวอร์ชัน</th>
                    <th>วันที่มีผลบังคับ</th>
                    <th style="width:140px">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $i => $doc)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <strong>{{ $doc->title_th }}</strong>
                        @if($doc->title_en)<br><small class="text-muted">{{ $doc->title_en }}</small>@endif
                    </td>
                    <td>
                        @if(isset($sections[$doc->category]))
                            <span class="badge bg-success bg-opacity-10 text-success">{{ $sections[$doc->category]['th'] }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $doc->version ?? '-' }}</td>
                    <td>{{ $doc->effective_date?->format('d/m/Y') ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.governance.edit', $doc) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.governance.destroy', $doc) }}" method="POST" class="d-inline" onsubmit="return confirm('ยืนยันลบ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">ไม่พบเอกสาร</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.admin')
@section('title', 'รายละเอียดประวัติ (Audit Log Detail)')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">รายละเอียดประวัติ (Log ID: {{ $auditLog->id }})</h2>
        <p class="text-muted mb-0">ดูรายละเอียดการเปลี่ยนแปลงและตรวจสอบความถูกต้องของข้อมูล</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.audit-logs.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> กลับหน้ารวม
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card shadow border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-primary">ข้อมูลทั่วไป (General Info)</h6>
                <div>
                    @if($isValidIntegrity)
                        <span class="badge bg-success fs-6"><i class="bi bi-shield-check"></i> ข้อมูลสมบูรณ์ (Verified Intact)</span>
                    @else
                        <span class="badge bg-danger fs-6"><i class="bi bi-shield-exclamation"></i> ข้อมูลถูกดัดแปลง (Tamper Detected)</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td class="text-muted" style="width: 150px;">ผู้ใช้งาน:</td>
                                <td class="fw-bold">{{ $auditLog->user->name ?? 'System/Guest' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">เหตุการณ์:</td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ strtoupper($auditLog->event) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Target Model:</td>
                                <td><code>{{ $auditLog->auditable_type }}</code> (ID: {{ $auditLog->auditable_id }})</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td class="text-muted" style="width: 150px;">เวลา:</td>
                                <td>{{ $auditLog->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">IP Address:</td>
                                <td>{{ $auditLog->ip_address }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">User Agent:</td>
                                <td><small class="text-muted">{{ mb_strimwidth($auditLog->user_agent, 0, 50, '...') }}</small></td>
                            </tr>
                            <tr>
                                <td class="text-muted">URL:</td>
                                <td><a href="{{ current(explode('?', $auditLog->url)) }}" target="_blank" class="text-decoration-none"><small>{{ current(explode('?', $auditLog->url)) }}</small></a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(in_array($auditLog->event, ['created', 'updated', 'deleted']))
<div class="row">
    <div class="col-md-6">
        <div class="card shadow border-0 h-100">
            <div class="card-header bg-light py-3">
                <h6 class="m-0 fw-bold text-danger">ข้อมูลก่อนหน้า (Old Values)</h6>
            </div>
            <div class="card-body bg-light">
                @if(empty($auditLog->old_values))
                    <p class="text-muted text-center py-4 mb-0">ไม่มีข้อมูล (หรือเป็นแบบฟอร์มสร้างใหม่)</p>
                @else
                    <pre class="bg-white border p-3 rounded text-danger" style="font-size:13px; white-space: pre-wrap;">{{ json_encode($auditLog->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow border-0 h-100">
            <div class="card-header bg-light py-3">
                <h6 class="m-0 fw-bold text-success">ข้อมูลล่าสุด (New Values)</h6>
            </div>
            <div class="card-body bg-light">
                @if(empty($auditLog->new_values))
                    <p class="text-muted text-center py-4 mb-0">ไม่มีข้อมูล (หรือเป็นการลบข้อมูล)</p>
                @else
                    <pre class="bg-white border p-3 rounded text-success" style="font-size:13px; white-space: pre-wrap;">{{ json_encode($auditLog->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection

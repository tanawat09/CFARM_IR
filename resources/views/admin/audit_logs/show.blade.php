@extends('layouts.admin')
@section('title', 'รายละเอียดประวัติ (Audit Log Detail)')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark"><i class="bi bi-file-earmark-medical text-primary me-2"></i> รายละเอียดประวัติ</h3>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">Log ID: #{{ $auditLog->id }} • ตรวจสอบและการเปลี่ยนแปลงเจาะลึก</p>
    </div>
    <div>
        <a href="{{ route('admin.audit-logs.index') }}" class="btn btn-light border shadow-sm rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i> กลับหน้ารวม
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-dark"><i class="bi bi-info-circle text-primary me-1"></i> ข้อมูลทั่วไป (General Info)</h6>
                <div>
                    @if($isValidIntegrity)
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 border border-success border-opacity-25"><i class="bi bi-shield-check"></i> ข้อมูลสมบูรณ์ (Verified Intact)</span>
                    @else
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 border border-danger border-opacity-25"><i class="bi bi-shield-exclamation"></i> ข้อมูลถูกดัดแปลง (Tamper Detected)</span>
                    @endif
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="bg-light rounded-4 p-3 h-100 border">
                            <table class="table table-borderless table-sm mb-0">
                                <tr>
                                    <td class="text-muted" style="width: 150px;">ผู้ใช้งาน:</td>
                                    <td class="fw-bold text-dark">{{ $auditLog->user->name ?? 'System/Guest' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">เหตุการณ์:</td>
                                    <td>
                                        <span class="badge bg-white text-dark border px-3 py-1 rounded-pill">{{ strtoupper($auditLog->event) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Target Model:</td>
                                    <td><code class="bg-white border rounded px-2 py-1 text-primary">{{ $auditLog->auditable_type }}</code> (ID: {{ $auditLog->auditable_id }})</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light rounded-4 p-3 h-100 border">
                            <table class="table table-borderless table-sm mb-0">
                                <tr>
                                    <td class="text-muted" style="width: 150px;">เวลา:</td>
                                    <td class="text-dark fw-medium">{{ $auditLog->created_at->format('d M Y, H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">IP Address:</td>
                                    <td class="text-dark d-flex align-items-center"><i class="bi bi-globe me-1 text-muted"></i> {{ $auditLog->ip_address }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">User Agent:</td>
                                    <td><small class="text-muted">{{ mb_strimwidth($auditLog->user_agent, 0, 80, '...') }}</small></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">URL:</td>
                                    <td><a href="{{ current(explode('?', $auditLog->url)) }}" target="_blank" class="text-decoration-none text-primary"><small style="word-break: break-all;">{{ current(explode('?', $auditLog->url)) }}</small></a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(in_array($auditLog->event, ['created', 'updated', 'deleted']))
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
            <div class="card-header bg-danger bg-opacity-10 py-3 border-bottom border-danger border-opacity-25">
                <h6 class="m-0 fw-bold text-danger"><i class="bi bi-clock-history me-1"></i> ข้อมูลก่อนหน้า (Old Values)</h6>
            </div>
            <div class="card-body p-0">
                @if(empty($auditLog->old_values))
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 p-5 text-muted">
                        <i class="bi bi-dash-circle fs-1 mb-2 opacity-50"></i>
                        <p class="mb-0">ไม่มีข้อมูล (หรือเป็นการสร้างใหม่)</p>
                    </div>
                @else
                    <div class="p-3 h-100 bg-light">
                        <pre class="bg-dark text-white p-4 rounded-4 shadow-sm mb-0 h-100" style="font-size:13px; white-space: pre-wrap; font-family: 'Fira Code', monospace; overflow-x: auto;">{{ json_encode($auditLog->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
            <div class="card-header bg-success bg-opacity-10 py-3 border-bottom border-success border-opacity-25">
                <h6 class="m-0 fw-bold text-success"><i class="bi bi-stars me-1"></i> ข้อมูลล่าสุด (New Values)</h6>
            </div>
            <div class="card-body p-0">
                @if(empty($auditLog->new_values))
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 p-5 text-muted">
                        <i class="bi bi-dash-circle fs-1 mb-2 opacity-50"></i>
                        <p class="mb-0">ไม่มีข้อมูล (หรือเป็นการลบข้อมูล)</p>
                    </div>
                @else
                    <div class="p-3 h-100 bg-light">
                        <pre class="bg-dark text-white p-4 rounded-4 shadow-sm mb-0 h-100" style="font-size:13px; white-space: pre-wrap; font-family: 'Fira Code', monospace; overflow-x: auto;">{{ json_encode($auditLog->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection

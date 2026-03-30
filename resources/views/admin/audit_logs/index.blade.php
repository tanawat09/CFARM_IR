@extends('layouts.admin')
@section('title', 'ประวัติระบบ (Audit Logs)')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark"><i class="bi bi-shield-check text-success me-2"></i> ประวัติการใช้งานระบบ</h3>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">ระบบบันทึกความเคลื่อนไหวและการเปลี่ยนแปลงข้อมูลสำคัญ (Audit Logs)</p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-sm">
                <thead class="table-light text-muted" style="font-size: 0.85rem; letter-spacing: 0.5px; text-transform: uppercase;">
                    <tr>
                        <th class="ps-4 py-3 fw-semibold border-0">Timestamp</th>
                        <th class="py-3 fw-semibold border-0">ผู้ใช้งาน (User)</th>
                        <th class="py-3 fw-semibold border-0 text-center">เหตุการณ์ (Action)</th>
                        <th class="py-3 fw-semibold border-0">ข้อมูลอ้างอิง (Target)</th>
                        <th class="py-3 fw-semibold border-0">IP Address</th>
                        <th class="py-3 fw-semibold border-0 text-center pe-4" style="width: 100px;">รายละเอียด</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($logs as $log)
                    <tr style="transition: all 0.2s;">
                        <td class="ps-4 text-muted" style="font-size: 0.85rem;">
                            <div class="fw-medium text-dark">{{ $log->created_at->format('d M Y') }}</div>
                            <small>{{ $log->created_at->format('H:i:s') }}</small>
                        </td>
                        <td>
                            @if($log->user)
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width:34px;height:34px;font-size:14px; background: linear-gradient(135deg, var(--cfarm-green), #4caf50);">
                                        {{ mb_strtoupper(mb_substr($log->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $log->user->name }}</div>
                                        <small class="text-muted text-xs">ID: {{ $log->user_id }}</small>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-secondary border shadow-sm" style="width:34px;height:34px;font-size:14px;">
                                        <i class="bi bi-robot"></i>
                                    </div>
                                    <span class="text-muted fw-medium">System / Guest</span>
                                </div>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($log->event === 'created')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 border border-success border-opacity-25"><i class="bi bi-plus-circle me-1"></i> เพิ่มข้อมูล</span>
                            @elseif($log->event === 'updated')
                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2 border border-warning border-opacity-25"><i class="bi bi-pencil-square me-1"></i> แก้ไขข้อมูล</span>
                            @elseif($log->event === 'deleted')
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 border border-danger border-opacity-25"><i class="bi bi-trash me-1"></i> ลบข้อมูล</span>
                            @elseif($log->event === 'login')
                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2 border border-info border-opacity-25"><i class="bi bi-box-arrow-in-right me-1"></i> เข้าสู่ระบบ</span>
                            @elseif($log->event === 'logout')
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 border border-secondary border-opacity-25"><i class="bi bi-box-arrow-right me-1"></i> ออกจากระบบ</span>
                            @else
                                <span class="badge bg-light text-dark rounded-pill px-3 py-2 border">{{ $log->event }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-medium text-dark"><i class="bi bi-layers text-muted me-1"></i> {{ class_basename($log->auditable_type) }}</span>
                                <small class="text-muted">ID: {{ $log->auditable_id }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="d-inline-flex align-items-center px-2 py-1 rounded bg-light border text-muted" style="font-family: monospace; font-size: 0.8rem;">
                                <i class="bi bi-globe me-1"></i> {{ $log->ip_address }}
                            </div>
                        </td>
                        <td class="text-center pe-4">
                            <a href="{{ route('admin.audit-logs.show', $log->id) }}" class="btn btn-sm btn-light border shadow-sm rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 35px; height: 35px;" title="ดูรายละเอียด">
                                <i class="bi bi-chevron-right text-dark"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-shield-x" style="font-size: 3rem; opacity: 0.5;"></i>
                                <h5 class="mt-3 fw-normal">ยังไม่มีประวัติการใช้งานในระบบ</h5>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($logs->hasPages())
    <div class="card-footer bg-white border-top-0 d-flex justify-content-end p-4">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection

@extends('layouts.admin')
@section('title', 'ประวัติระบบ (Audit Logs)')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">ประวัติการใช้งานระบบ (Audit Logs)</h2>
        <p class="text-muted mb-0">ระบบบันทึกความเคลื่อนไหวและการเปลี่ยนแปลงข้อมูลสำคัญ</p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>วันเวลาที่บันทึก</th>
                                <th>ผู้ใช้งาน</th>
                                <th>เหตุการณ์</th>
                                <th>เป้าหมายข้อมูล</th>
                                <th>IP Address</th>
                                <th style="width: 100px;">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    @if($log->user)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width:24px;height:24px;font-size:10px;">
                                                {{ mb_strtoupper(mb_substr($log->user->name, 0, 1)) }}
                                            </div>
                                            <span>{{ $log->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">System / Guest</span>
                                    @endif
                                </td>
                                <td>
                                    @if($log->event === 'created')
                                        <span class="badge bg-success">สร้าง (Created)</span>
                                    @elseif($log->event === 'updated')
                                        <span class="badge bg-warning text-dark">อัปเดต (Updated)</span>
                                    @elseif($log->event === 'deleted')
                                        <span class="badge bg-danger">ลบ (Deleted)</span>
                                    @elseif($log->event === 'login')
                                        <span class="badge bg-info text-dark">เข้าสู่ระบบ (Login)</span>
                                    @elseif($log->event === 'logout')
                                        <span class="badge bg-secondary">ออกจากระบบ (Logout)</span>
                                    @else
                                        <span class="badge bg-light text-dark">{{ $log->event }}</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="d-block text-muted">{{ class_basename($log->auditable_type) }}</small>
                                    <span class="badge bg-light border text-dark">ID: {{ $log->auditable_id }}</span>
                                </td>
                                <td><small class="text-muted">{{ $log->ip_address }}</small></td>
                                <td>
                                    <a href="{{ route('admin.audit-logs.show', $log->id) }}" class="btn btn-sm btn-outline-primary" title="ดูรายละเอียด">
                                        <i class="bi bi-eye"></i> ดูข้อมูล
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">ไม่พบประวัติการใช้งาน</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Pagination --}}
                <div class="d-flex justify-content-end mt-4">
                    {{ $logs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

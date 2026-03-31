@extends('layouts.admin')
@section('title', 'จัดการข้อมูลทางการเงิน')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">จัดการข้อมูลทางการเงิน</h2>
        <p class="text-muted mb-0">อัปโหลดและจัดการงบการเงินและรายงาน MD&A</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.financial-reports.create') }}" class="btn btn-primary btn-sm">
            <i class="fe fe-plus"></i> เพิ่มรายงาน
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table datatables table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>ปี</th>
                                <th>หมวดหมู่</th>
                                <th>หัวข้อ (ไทย)</th>
                                <th>ไฟล์</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->documentYear->year ?? '-' }}</td>
                                <td>{{ $report->category->name_th ?? '-' }}</td>
                                <td>{{ $report->title_th }}</td>
                                <td>
                                    @if($report->file_path)
                                        <a href="{{ Storage::url($report->file_path) }}" target="_blank" class="text-primary"><i class="fe fe-file-text"></i> ดูไฟล์</a>
                                    @else
                                        <span class="text-muted">ไม่มีไฟล์</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.financial-reports.edit', $report->id) }}" class="btn btn-sm btn-outline-primary shadow-sm" style="border-radius: 8px;">
                                            <i class="bi bi-pencil-square"></i> แก้ไข
                                        </a>
                                        <form action="{{ route('admin.financial-reports.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('ต้องการลบรายงานนี้หรือไม่?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm" style="border-radius: 8px;">
                                                <i class="bi bi-trash"></i> ลบ
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">ไม่พบรายงานทางการเงิน</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

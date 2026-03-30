@extends('layouts.admin')

@section('title', 'โครงสร้างรายได้ - CFARM IR')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 text-gray-800 mb-0">
        <i class="bi bi-pie-chart text-primary me-2"></i> จัดการโครงสร้างรายได้ (Revenue Structure)
    </h2>
    <a href="{{ route('admin.revenue-structures.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> เพิ่มโครงสร้างรายได้
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
    <strong><i class="bi bi-check-circle me-2"></i>สำเร็จ!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow mb-4 border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">ลำดับ (Order)</th>
                        <th class="py-3">ไอคอน</th>
                        <th class="py-3">หัวข้อ (TH/EN)</th>
                        <th class="py-3 text-center">สัดส่วน (%)</th>
                        <th class="py-3 text-end px-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($structures as $structure)
                    <tr>
                        <td class="px-4 py-3 fw-bold text-gray-500">{{ $structure->order }}</td>
                        <td class="py-3">
                            <x-revenue-structure-icon :icon="$structure->icon_class" class="fs-4 text-{{ $structure->color ?? 'primary' }}" style="width: 1em; height: 1em;" />
                        </td>
                        <td class="py-3">
                            <h6 class="mb-1 text-dark fw-bold">{{ $structure->title_th }}</h6>
                            <small class="text-muted">{{ $structure->title_en }}</small>
                        </td>
                        <td class="py-3 text-center">
                            <span class="badge bg-{{ $structure->color ?? 'primary' }} fs-6">{{ $structure->percentage }}%</span>
                        </td>
                        <td class="py-3 text-end px-4">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.revenue-structures.edit', $structure) }}" class="btn btn-sm btn-outline-primary" title="แก้ไข">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.revenue-structures.destroy', $structure) }}" method="POST" class="d-inline" onsubmit="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="ลบ">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                            ยังไม่มีข้อมูลโครงสร้างรายได้
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')
@section('title', 'จัดการกิจกรรม')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">จัดการกิจกรรมนักลงทุน</h2>
        <p class="text-muted mb-0">รายการกิจกรรมนักลงทุนทั้งหมด</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
            <i class="fe fe-plus"></i> เพิ่มกิจกรรม
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
                                <th>หัวข้อ (ไทย)</th>
                                <th>ประเภทกิจกรรม</th>
                                <th>วันที่เริ่ม</th>
                                <th>สถานที่</th>
                                <th>สถานะ</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $event->title_th }}</td>
                                <td>{{ $event->eventType->name_th ?? '-' }}</td>
                                <td>{{ $event->event_start->format('d M Y, H:i') }}</td>
                                <td>{{ $event->location }}</td>
                                <td>
                                    <span class="badge badge-{{ $event->status === 'published' ? 'success' : 'warning' }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-outline-primary shadow-sm" style="border-radius: 8px;">
                                            <i class="bi bi-pencil-square"></i> แก้ไข
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('ต้องการลบกิจกรรมนี้หรือไม่?');">
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
                                <td colspan="7" class="text-center text-muted">ไม่พบกิจกรรม</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

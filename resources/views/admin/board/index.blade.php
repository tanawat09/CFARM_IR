@extends('layouts.admin')
@section('title', 'จัดการคณะกรรมการ')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">จัดการคณะกรรมการบริษัท</h2>
        <p class="text-muted mb-0">รายชื่อกรรมการทั้งหมด</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.board.create') }}" class="btn btn-primary btn-sm">
            <i class="fe fe-plus"></i> เพิ่มกรรมการ
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
                                <th>ลำดับ</th>
                                <th>รูปภาพ</th>
                                <th>ชื่อ (ไทย)</th>
                                <th>ตำแหน่ง (ไทย)</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($directors as $director)
                            <tr>
                                <td>{{ $director->display_order }}</td>
                                <td>
                                    @if($director->image_path)
                                        <img src="{{ Storage::url($director->image_path) }}" alt="{{ $director->name_en }}" class="img-thumbnail" style="max-height: 50px;">
                                    @else
                                        <span class="text-muted">ไม่มีรูป</span>
                                    @endif
                                </td>
                                <td>{{ $director->name_th }}<br><small class="text-muted">{{ $director->name_en }}</small></td>
                                <td>{{ $director->position_th }}<br><small class="text-muted">{{ $director->position_en }}</small></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('admin.board.edit', $director->id) }}">แก้ไข</a>
                                            <form action="{{ route('admin.board.destroy', $director->id) }}" method="POST" onsubmit="return confirm('ต้องการลบกรรมการท่านนี้หรือไม่?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">ลบ</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">ไม่พบข้อมูลกรรมการ</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

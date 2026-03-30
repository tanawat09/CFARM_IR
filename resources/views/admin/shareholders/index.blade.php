@extends('layouts.admin')
@section('title', 'จัดการข้อมูลผู้ถือหุ้น')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">จัดการโครงสร้างผู้ถือหุ้น</h2>
        <p class="text-muted mb-0">รายชื่อผู้ถือหุ้นรายใหญ่และสัดส่วน</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.shareholders.create') }}" class="btn btn-primary btn-sm">
            <i class="fe fe-plus"></i> เพิ่มผู้ถือหุ้น
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
                    <table class="table datatables table-hover custom-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>ชื่อ (ไทย)</th>
                                <th>ชื่อ (อังกฤษ)</th>
                                <th>จำนวนหุ้น</th>
                                <th>สัดส่วน (%)</th>
                                <th>ข้อมูล ณ วันที่</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($shareholders as $shareholder)
                            <tr>
                                <td class="font-weight-bold">{{ $loop->iteration }}</td>
                                <td>{{ $shareholder->shareholder_name_th }}</td>
                                <td>{{ $shareholder->shareholder_name_en ?? '-' }}</td>
                                <td>{{ number_format($shareholder->number_of_shares) }}</td>
                                <td>
                                    <span class="badge badge-success">{{ number_format($shareholder->percentage, 2) }}%</span>
                                </td>
                                <td>{{ $shareholder->as_of_date ? $shareholder->as_of_date->format('d M Y') : '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle more-vertical" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted sr-only">Action</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('admin.shareholders.edit', $shareholder->id) }}">แก้ไข</a>
                                            <form action="{{ route('admin.shareholders.destroy', $shareholder->id) }}" method="POST" onsubmit="return confirm('ต้องการลบข้อมูลนี้หรือไม่?');">
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
                                <td colspan="7" class="text-center text-muted">ไม่พบข้อมูลผู้ถือหุ้น</td>
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

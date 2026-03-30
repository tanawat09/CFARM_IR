@extends('layouts.admin')

@section('title', 'จัดการข้อความติดต่อ')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">จัดการข้อความติดต่อ (Contact Messages)</h1>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="contactTable">
                    <thead class="table-light">
                        <tr>
                            <th>วันที่รับข้อความ</th>
                            <th>ชื่อผู้ติดต่อ</th>
                            <th>อีเมล</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $msg)
                            <tr>
                                <td>{{ $msg->created_at ? $msg->created_at->format('d/m/Y H:i') : '-' }}</td>
                                <td><strong>{{ $msg->name }}</strong></td>
                                <td><a href="mailto:{{ $msg->email }}">{{ $msg->email }}</a></td>
                                <td>{{ $msg->phone ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.contacts.show', $msg->id) }}" class="btn btn-sm btn-info text-white" title="อ่านข้อความ">
                                        <i class="fas fa-eye"></i> อ่าน
                                    </a>
                                    <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('ยืนยันการลบข้อความนี้ใช่หรือไม่?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="ลบข้อความ">
                                            <i class="fas fa-trash"></i> ลบ
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#contactTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/th.json"
            },
            "order": [[ 0, "desc" ]] // เรียงตามวันที่ (คอลัมน์แรก) ล่าสุดขึ้นก่อน
        });
    });
</script>
@endsection

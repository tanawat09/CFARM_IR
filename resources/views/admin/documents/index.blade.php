@extends('layouts.admin')
@section('title', 'จัดการเอกสาร - CFARM Admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-file-earmark-pdf"></i> จัดการเอกสารเผยแพร่</h3>
    <a href="{{ route('admin.documents.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> เพิ่มเอกสาร</a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card card-hover">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr class="table-light"><th>หัวข้อ (ไทย)</th><th>หมวดหมู่</th><th>ปี</th><th>ไฟล์</th><th>จัดการ</th></tr></thead>
                <tbody>
                    @forelse($documents as $doc)
                    <tr>
                        <td>{{ Str::limit($doc->title_th, 50) }}</td>
                        <td><span class="badge bg-info text-dark">{{ $doc->category->name_th ?? '-' }}</span></td>
                        <td><span class="badge bg-secondary">{{ $doc->year->year ?? '-' }}</span></td>
                        <td>
                            @if($doc->external_link)
                                <a href="{{ $doc->external_link }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="bi bi-link-45deg"></i> ลิงก์ภายนอก</a>
                            @elseif($doc->file_path)
                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="bi bi-file-pdf"></i> ไฟล์เอกสาร</a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.documents.edit', $doc) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.documents.destroy', $doc) }}" method="POST" class="d-inline" onsubmit="return confirm('ต้องการลบเอกสารนี้หรือไม่?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">ไม่พบเอกสาร</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $documents->links() }}
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')
@section('title', 'จัดการข่าวสาร - CFARM Admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-newspaper"></i> จัดการข่าวสาร</h3>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> เพิ่มข่าว</a>
</div>
<div class="card card-hover">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>รูปภาพ</th><th>หัวข้อ</th><th>หมวดหมู่</th><th>สถานะ</th><th>วันที่</th><th>จัดการ</th></tr></thead>
                <tbody>
                    @foreach($news as $item)
                    <tr>
                        <td>
                            @if($item->image_path)
                                <img src="{{ Storage::url($item->image_path) }}" alt="News Image" class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                            @else
                                <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 40px; font-size: 0.8rem;">ไม่มีรูป</div>
                            @endif
                        </td>
                        <td>{{ Str::limit($item->title_th, 50) }}</td>
                        <td><span class="badge bg-light text-dark">{{ $item->category->name_en ?? '' }}</span></td>
                        <td><span class="badge {{ $item->is_published ? 'bg-success' : 'bg-secondary' }}">{{ $item->is_published ? 'เผยแพร่แล้ว' : 'ฉบับร่าง' }}</span></td>
                        <td>{{ $item->published_at?->format('d M Y') ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('ต้องการลบข่าวนี้หรือไม่?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $news->links() }}
    </div>
</div>
@endsection

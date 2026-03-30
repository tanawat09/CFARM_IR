@extends('layouts.admin')
@section('title', 'แดชบอร์ด - CFARM IR')
@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4"><i class="bi bi-speedometer2"></i> แดชบอร์ด</h2>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card bg-primary text-white card-hover">
                <div class="card-body"><h3>{{ $stats['total_news'] }}</h3><p class="mb-0">ข่าวสารทั้งหมด</p></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card bg-success text-white card-hover">
                <div class="card-body"><h3>{{ $stats['total_documents'] }}</h3><p class="mb-0">เอกสาร</p></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card bg-info text-white card-hover">
                <div class="card-body"><h3>{{ $stats['total_events'] }}</h3><p class="mb-0">กิจกรรม</p></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card bg-warning text-dark card-hover">
                <div class="card-body"><h3>{{ $stats['unresolved_messages'] }}</h3><p class="mb-0">ข้อความรอดำเนินการ</p></div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Latest News --}}
        <div class="col-lg-6">
            <div class="card card-hover">
                <div class="card-header bg-white fw-bold"><i class="bi bi-newspaper"></i> ข่าวสารล่าสุด</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($latestNews as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div>{{ Str::limit($item->title_th, 50) }}<br><small class="text-muted">{{ $item->created_at->format('d M Y') }}</small></div>
                            <span class="badge {{ $item->is_published ? 'bg-success' : 'bg-secondary' }}">{{ $item->is_published ? 'เผยแพร่แล้ว' : 'ฉบับร่าง' }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Upcoming Events --}}
        <div class="col-lg-6">
            <div class="card card-hover">
                <div class="card-header bg-white fw-bold"><i class="bi bi-calendar-event"></i> กิจกรรมที่กำลังจะมาถึง</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($upcomingEvents as $event)
                        <li class="list-group-item">
                            <strong>{{ $event->event_start->format('d M Y') }}</strong> - {{ $event->title_th }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Recent Messages --}}
        <div class="col-12">
            <div class="card card-hover">
                <div class="card-header bg-white fw-bold"><i class="bi bi-envelope"></i> ข้อความติดต่อล่าสุด</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead><tr><th>ชื่อ</th><th>อีเมล</th><th>ข้อความ</th><th>วันที่</th></tr></thead>
                            <tbody>
                                @foreach($recentMessages as $msg)
                                <tr>
                                    <td>{{ $msg->name }}</td>
                                    <td>{{ $msg->email }}</td>
                                    <td>{{ Str::limit($msg->message, 60) }}</td>
                                    <td>{{ $msg->created_at->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

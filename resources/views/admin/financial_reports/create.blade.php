@extends('layouts.admin')
@section('title', 'เพิ่มรายงานทางการเงิน')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h2 class="h5 page-title">เพิ่มรายงานทางการเงิน</h2>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.financial-reports.index') }}" class="btn btn-secondary btn-sm">
            <i class="fe fe-arrow-left"></i> กลับไปรายการ
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('admin.financial-reports.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title_th">หัวข้อ (ไทย) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title_th" name="title_th" value="{{ old('title_th') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="title_en">หัวข้อ (อังกฤษ)</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en') }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category_id">หมวดหมู่ <span class="text-danger">*</span></label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">เลือกหมวดหมู่</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_th }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="year_id">ปี <span class="text-danger">*</span></label>
                            <div class="d-flex gap-2 align-items-start">
                                <div class="flex-grow-1">
                                    <select class="form-control" id="year_id" name="year_id" required>
                                        <option value="">เลือกปี</option>
                                        @foreach($years as $year)
                                            <option value="{{ $year->id }}" {{ old('year_id') == $year->id ? 'selected' : '' }}>
                                                {{ $year->year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button" class="btn btn-outline-success btn-add-year" onclick="toggleAddYear()" title="เพิ่มปีใหม่" style="white-space:nowrap; height:38px;">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                            <div class="add-year-form mt-2 d-none" id="addYearForm">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="newYearInput" placeholder="เช่น 2569" min="2500" max="2600">
                                    <button type="button" class="btn btn-success" onclick="submitNewYear()">
                                        <i class="bi bi-check-lg"></i> เพิ่ม
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="toggleAddYear()">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                                <div class="add-year-feedback text-danger small mt-1 d-none" id="yearFeedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="file_path">ไฟล์รายงาน (PDF, Excel, Word) <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_path" name="file_path" accept=".pdf,.xls,.xlsx,.doc,.docx" required>
                            <label class="custom-file-label" for="file_path">เลือกไฟล์</label>
                        </div>
                        <small class="text-muted">ขนาดไฟล์สูงสุด: 10MB</small>
                    </div>

                    <button type="submit" class="btn btn-primary">บันทึกรายงาน</button>
                    <a href="{{ route('admin.financial-reports.index') }}" class="btn btn-light ml-2">ยกเลิก</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.custom-file-input').on('change',function(){
        var fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
    });

    function toggleAddYear() {
        const form = document.getElementById('addYearForm');
        form.classList.toggle('d-none');
        if (!form.classList.contains('d-none')) {
            document.getElementById('newYearInput').focus();
        }
    }

    function submitNewYear() {
        const input = document.getElementById('newYearInput');
        const feedback = document.getElementById('yearFeedback');
        const yearVal = input.value.trim();

        feedback.classList.add('d-none');

        if (!yearVal || yearVal < 2500 || yearVal > 2600) {
            feedback.textContent = 'กรุณาระบุปี พ.ศ. ที่ถูกต้อง (2500-2600)';
            feedback.classList.remove('d-none');
            return;
        }

        fetch("{{ route('admin.document-years.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ year: parseInt(yearVal) })
        })
        .then(r => r.text())
        .then(text => {
            const jsonMatch = text.match(/\{[\s\S]*\}$/);
            if (!jsonMatch) throw new Error('Invalid response');
            const data = JSON.parse(jsonMatch[0]);
            if (data.success) {
                const select = document.getElementById('year_id');
                const option = new Option(data.year, data.id, true, true);
                let inserted = false;
                for (let i = 1; i < select.options.length; i++) {
                    if (parseInt(select.options[i].text) < data.year) {
                        select.add(option, select.options[i]);
                        inserted = true;
                        break;
                    }
                }
                if (!inserted) select.add(option);
                select.value = data.id;

                input.value = '';
                document.getElementById('addYearForm').classList.add('d-none');
            } else if (data.errors) {
                feedback.textContent = Object.values(data.errors).flat().join(', ');
                feedback.classList.remove('d-none');
            }
        })
        .catch(err => {
            feedback.textContent = 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง';
            feedback.classList.remove('d-none');
        });
    }

    document.getElementById('newYearInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') { e.preventDefault(); submitNewYear(); }
        if (e.key === 'Escape') toggleAddYear();
    });
</script>
@endsection

@extends('layouts.admin')
@section('title', 'เพิ่มเอกสาร - CFARM Admin')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.documents.index') }}" class="text-decoration-none text-muted"><i class="bi bi-arrow-left"></i> กลับไปรายการเอกสาร</a>
    <h3 class="mt-2"><i class="bi bi-file-earmark-plus"></i> เพิ่มเอกสารใหม่</h3>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">หัวข้อ (ไทย) <span class="text-danger">*</span></label>
                    <input type="text" name="title_th" class="form-control @error('title_th') is-invalid @enderror" value="{{ old('title_th') }}" required>
                    @error('title_th') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">หัวข้อ (อังกฤษ)</label>
                    <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en') }}">
                    @error('title_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">หมวดหมู่ <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- เลือกหมวดหมู่ --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name_th }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">ปี</label>
                    <div class="d-flex gap-2 align-items-start">
                        <div class="flex-grow-1">
                            <select name="year_id" id="year_id" class="form-select @error('year_id') is-invalid @enderror">
                                <option value="">-- เลือกปี (ไม่บังคับ) --</option>
                                @foreach($years as $year)
                                    <option value="{{ $year->id }}" {{ old('year_id') == $year->id ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                            @error('year_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <button type="button" class="btn btn-outline-success btn-add-year" onclick="toggleAddYear(this)" title="เพิ่มปีใหม่" style="white-space:nowrap;">
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

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">ไฟล์เอกสาร (PDF, DOCX, XLSX)</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <small class="text-muted">อัปโหลดไฟล์ หรือ ใส่ลิงก์ภายนอกอย่างใดอย่างหนึ่ง</small>
                    @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">ลิงก์เอกสารภายนอก (URL)</label>
                    <input type="url" name="external_link" class="form-control @error('external_link') is-invalid @enderror" value="{{ old('external_link') }}" placeholder="https://...">
                    @error('external_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save"></i> บันทึกเอกสาร</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
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
            // Insert in sorted position (desc)
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

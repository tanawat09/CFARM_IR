@extends('layouts.admin')

@section('title', 'ข้อมูลทางการเงิน (หน้าแรก) - CFARM Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 text-gray-800 mb-0">
        <i class="bi bi-bar-chart-line text-primary me-2"></i> จัดการข้อมูลทางการเงิน (หน้าแรก)
    </h2>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
    <strong><i class="bi bi-check-circle me-2"></i>สำเร็จ!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="_group" value="financial_highlights">

    {{-- ══════════════ Section 1: Counter Numbers ══════════════ --}}
    <div class="card shadow border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-speedometer2"></i> ตัวเลขสรุป (Counter)</h6>
            <small class="text-muted">ตัวเลขที่แสดงด้านบนของส่วน Financial Highlights ในหน้าแรก</small>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ทุนจดทะเบียน (ล้านบาท)</label>
                    <input type="number" name="fh_registered_capital[th]" class="form-control" 
                           value="{{ $settings->get('fh_registered_capital')?->value_th ?? '580' }}" 
                           step="0.01" placeholder="580">
                    <input type="hidden" name="fh_registered_capital[en]" 
                           value="{{ $settings->get('fh_registered_capital')?->value_en ?? $settings->get('fh_registered_capital')?->value_th ?? '580' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ทุนชำระแล้ว (ล้านบาท)</label>
                    <input type="number" name="fh_paid_up_capital[th]" class="form-control" 
                           value="{{ $settings->get('fh_paid_up_capital')?->value_th ?? '580' }}" 
                           step="0.01" placeholder="580">
                    <input type="hidden" name="fh_paid_up_capital[en]" 
                           value="{{ $settings->get('fh_paid_up_capital')?->value_en ?? $settings->get('fh_paid_up_capital')?->value_th ?? '580' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">จำนวนฟาร์ม</label>
                    <input type="number" name="fh_farms_count[th]" class="form-control" 
                           value="{{ $settings->get('fh_farms_count')?->value_th ?? '8' }}" 
                           step="1" placeholder="8">
                    <input type="hidden" name="fh_farms_count[en]" 
                           value="{{ $settings->get('fh_farms_count')?->value_en ?? $settings->get('fh_farms_count')?->value_th ?? '8' }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════ Section 2: Chart - Year Labels ══════════════ --}}
    <div class="card shadow border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-calendar3"></i> ปีที่แสดงในกราฟ</h6>
            <small class="text-muted">ป้ายปี (พ.ศ.) ที่แสดงใต้แท่งกราฟ เรียงจากเก่า → ใหม่</small>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปีที่ 1 (เก่าสุด)</label>
                    <input type="text" name="fh_year_1[th]" class="form-control" 
                           value="{{ $settings->get('fh_year_1')?->value_th ?? '2566' }}" placeholder="2566">
                    <input type="hidden" name="fh_year_1[en]" value="{{ $settings->get('fh_year_1')?->value_en ?? $settings->get('fh_year_1')?->value_th ?? '2566' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปีที่ 2</label>
                    <input type="text" name="fh_year_2[th]" class="form-control" 
                           value="{{ $settings->get('fh_year_2')?->value_th ?? '2567' }}" placeholder="2567">
                    <input type="hidden" name="fh_year_2[en]" value="{{ $settings->get('fh_year_2')?->value_en ?? $settings->get('fh_year_2')?->value_th ?? '2567' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปีที่ 3 (ล่าสุด)</label>
                    <input type="text" name="fh_year_3[th]" class="form-control" 
                           value="{{ $settings->get('fh_year_3')?->value_th ?? '2568' }}" placeholder="2568">
                    <input type="hidden" name="fh_year_3[en]" value="{{ $settings->get('fh_year_3')?->value_en ?? $settings->get('fh_year_3')?->value_th ?? '2568' }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════ Section 3: Revenue Data ══════════════ --}}
    <div class="card shadow border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-success"><i class="bi bi-graph-up"></i> รายได้รวม (ล้านบาท)</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปี {{ $settings->get('fh_year_1')?->value_th ?? '2566' }}</label>
                    <input type="number" name="fh_revenue_1[th]" class="form-control" step="0.01"
                           value="{{ $settings->get('fh_revenue_1')?->value_th ?? '240.99' }}" placeholder="240.99">
                    <input type="hidden" name="fh_revenue_1[en]" value="{{ $settings->get('fh_revenue_1')?->value_en ?? $settings->get('fh_revenue_1')?->value_th ?? '240.99' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปี {{ $settings->get('fh_year_2')?->value_th ?? '2567' }}</label>
                    <input type="number" name="fh_revenue_2[th]" class="form-control" step="0.01"
                           value="{{ $settings->get('fh_revenue_2')?->value_th ?? '224.31' }}" placeholder="224.31">
                    <input type="hidden" name="fh_revenue_2[en]" value="{{ $settings->get('fh_revenue_2')?->value_en ?? $settings->get('fh_revenue_2')?->value_th ?? '224.31' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปี {{ $settings->get('fh_year_3')?->value_th ?? '2568' }}</label>
                    <input type="number" name="fh_revenue_3[th]" class="form-control" step="0.01"
                           value="{{ $settings->get('fh_revenue_3')?->value_th ?? '210.72' }}" placeholder="210.72">
                    <input type="hidden" name="fh_revenue_3[en]" value="{{ $settings->get('fh_revenue_3')?->value_en ?? $settings->get('fh_revenue_3')?->value_th ?? '210.72' }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════ Section 4: Profit Data ══════════════ --}}
    <div class="card shadow border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-cash-coin"></i> กำไรสุทธิ (ล้านบาท)</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปี {{ $settings->get('fh_year_1')?->value_th ?? '2566' }}</label>
                    <input type="number" name="fh_profit_1[th]" class="form-control" step="0.01"
                           value="{{ $settings->get('fh_profit_1')?->value_th ?? '30.49' }}" placeholder="30.49">
                    <input type="hidden" name="fh_profit_1[en]" value="{{ $settings->get('fh_profit_1')?->value_en ?? $settings->get('fh_profit_1')?->value_th ?? '30.49' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปี {{ $settings->get('fh_year_2')?->value_th ?? '2567' }}</label>
                    <input type="number" name="fh_profit_2[th]" class="form-control" step="0.01"
                           value="{{ $settings->get('fh_profit_2')?->value_th ?? '10.14' }}" placeholder="10.14">
                    <input type="hidden" name="fh_profit_2[en]" value="{{ $settings->get('fh_profit_2')?->value_en ?? $settings->get('fh_profit_2')?->value_th ?? '10.14' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปี {{ $settings->get('fh_year_3')?->value_th ?? '2568' }}</label>
                    <input type="number" name="fh_profit_3[th]" class="form-control" step="0.01"
                           value="{{ $settings->get('fh_profit_3')?->value_th ?? '10.85' }}" placeholder="10.85">
                    <input type="hidden" name="fh_profit_3[en]" value="{{ $settings->get('fh_profit_3')?->value_en ?? $settings->get('fh_profit_3')?->value_th ?? '10.85' }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════ Section 5: Assets Data ══════════════ --}}
    <div class="card shadow border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-warning"><i class="bi bi-bank"></i> สินทรัพย์รวม (ล้านบาท)</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปี {{ $settings->get('fh_year_1')?->value_th ?? '2566' }}</label>
                    <input type="number" name="fh_assets_1[th]" class="form-control" step="0.01"
                           value="{{ $settings->get('fh_assets_1')?->value_th ?? '730.13' }}" placeholder="730.13">
                    <input type="hidden" name="fh_assets_1[en]" value="{{ $settings->get('fh_assets_1')?->value_en ?? $settings->get('fh_assets_1')?->value_th ?? '730.13' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปี {{ $settings->get('fh_year_2')?->value_th ?? '2567' }}</label>
                    <input type="number" name="fh_assets_2[th]" class="form-control" step="0.01"
                           value="{{ $settings->get('fh_assets_2')?->value_th ?? '869.87' }}" placeholder="869.87">
                    <input type="hidden" name="fh_assets_2[en]" value="{{ $settings->get('fh_assets_2')?->value_en ?? $settings->get('fh_assets_2')?->value_th ?? '869.87' }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">ปี {{ $settings->get('fh_year_3')?->value_th ?? '2568' }}</label>
                    <input type="number" name="fh_assets_3[th]" class="form-control" step="0.01"
                           value="{{ $settings->get('fh_assets_3')?->value_th ?? '840.42' }}" placeholder="840.42">
                    <input type="hidden" name="fh_assets_3[en]" value="{{ $settings->get('fh_assets_3')?->value_en ?? $settings->get('fh_assets_3')?->value_th ?? '840.42' }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════ Save Button ══════════════ --}}
    <div class="sticky-bottom bg-white p-3 shadow-sm border-top d-flex justify-content-end rounded-bottom mb-5" style="z-index: 1020;">
        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold">
            <i class="bi bi-save me-2"></i> บันทึกข้อมูลทางการเงิน
        </button>
    </div>

</form>
@endsection

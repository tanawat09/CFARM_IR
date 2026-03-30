@extends('layouts.admin')

@section('title', 'ตั้งค่าข้อมูลองค์กร (Company Profile) - CFARM IR')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 text-gray-800 mb-0">
            <i class="bi bi-building-gear text-primary me-2"></i> ตั้งค่าข้อมูลองค์กร (Company Profile)
        </h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <strong><i class="bi bi-check-circle me-2"></i>สำเร็จ!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- Pass the specific setting group we want to save into --}}
        <input type="hidden" name="_group" value="company_profile">

        {{-- ══════════════ Company Profile Image ══════════════ --}}
        <div class="card shadow border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-image"></i> รูปภาพองค์กร (Company Image)</h6>
                <small class="text-muted">รูปภาพที่แสดงในหน้าเกี่ยวกับเรา</small>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center mb-3">
                        @if($settings->get('cp_company_image')?->value_th)
                            <img src="{{ Storage::url($settings->get('cp_company_image')->value_th) }}" alt="Company Image"
                                class="img-fluid rounded shadow-sm" style="max-height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <div class="text-center text-muted">
                                    <i class="bi bi-image fs-1"></i>
                                    <p class="mb-0 mt-2 small">ยังไม่มีรูปภาพ</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold">อัปโหลดรูปภาพองค์กร</label>
                        <input type="file" name="cp_company_image" class="form-control"
                            accept="image/jpeg,image/png,image/webp">
                        <small class="text-muted">รองรับ JPG, PNG, WebP ขนาดไม่เกิน 5MB</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════ Hero Media (Homepage Banner) ══════════════ --}}
        <div class="card shadow border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-display"></i> รูปภาพ/วิดีโอหน้าแรก (Hero
                    Banner)</h6>
                <small class="text-muted">รูปภาพหรือวิดีโอพื้นหลังที่แสดงเป็น Banner ด้านบนหน้าแรก</small>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-5 text-center mb-3">
                        @php $heroMedia = $settings->get('cp_hero_media')?->value_th; @endphp
                        @if($heroMedia)
                            @if(Str::endsWith($heroMedia, ['.mp4', '.webm', '.mov']))
                                <video src="{{ Storage::url($heroMedia) }}" class="img-fluid rounded shadow-sm"
                                    style="max-height: 200px;" muted autoplay loop playsinline></video>
                            @else
                                <img src="{{ Storage::url($heroMedia) }}" alt="Hero Banner" class="img-fluid rounded shadow-sm"
                                    style="max-height: 200px; object-fit: cover;">
                            @endif
                            <div class="mt-2">
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>ใช้งานอยู่</span>
                            </div>
                        @else
                            <div class="bg-dark rounded d-flex align-items-center justify-content-center"
                                style="height: 150px;">
                                <div class="text-center text-white-50">
                                    <i class="bi bi-display fs-1"></i>
                                    <p class="mb-0 mt-2 small">ใช้ Gradient เริ่มต้น</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <label class="form-label fw-bold">อัปโหลดรูปภาพหรือวิดีโอ</label>
                        <input type="file" name="cp_hero_media" class="form-control"
                            accept="image/jpeg,image/png,image/webp,video/mp4,video/webm">
                        <small class="text-muted d-block mt-1">
                            <i class="bi bi-info-circle me-1"></i>
                            รองรับ: <strong>รูปภาพ</strong> (JPG, PNG, WebP) หรือ <strong>วิดีโอ</strong> (MP4, WebM)<br>
                            ขนาดแนะนำ: 1920x1080px ขึ้นไป / ไม่เกิน 20MB
                        </small>
                        @if($heroMedia)
                            <div class="mt-2 p-2 bg-light rounded small">
                                <i class="bi bi-file-earmark me-1"></i> ไฟล์ปัจจุบัน: <code>{{ basename($heroMedia) }}</code>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════ Homepage Video ══════════════ --}}
        <div class="card shadow border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-youtube"></i> วิดีโอนำเสนอธุรกิจหน้าแรก
                    (Business Video)</h6>
                <small class="text-muted">วิดีโอจาก YouTube ที่จะแสดงผลใต้ส่วน "CFARM Corporate VDO" ในหน้าแรก</small>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-5 text-center mb-3">
                        @php $videoUrl = $settings->get('cp_homepage_video_url')?->value_th; @endphp
                        @if($videoUrl)
                            @php
                                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $videoUrl, $match);
                                $youtubeId = $match[1] ?? null;
                            @endphp
                            @if($youtubeId)
                                <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
                                    <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" title="YouTube video player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                                <div class="mt-2 text-success small"><i class="bi bi-check-circle me-1"></i>วิดีโอพร้อมใช้งาน</div>
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center border border-danger p-3"
                                    style="height: 150px;">
                                    <div class="text-center text-danger">
                                        <i class="bi bi-exclamation-triangle fs-1"></i>
                                        <p class="mb-0 mt-2 small">URL ของ YouTube ไม่ถูกต้อง</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                style="height: 150px;">
                                <div class="text-center text-muted">
                                    <i class="bi bi-youtube fs-1"></i>
                                    <p class="mb-0 mt-2 small">ยังไม่ได้ตั้งค่าวิดีโอ</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <label class="form-label fw-bold">YouTube URL</label>
                        <input type="url" name="cp_homepage_video_url[th]" class="form-control"
                            placeholder="https://www.youtube.com/watch?v=..." value="{{ $videoUrl }}">
                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle me-1"></i>
                            รองรับลิ้งก์รูปแบบ <code>youtube.com/watch?v=...</code> หรือ <code>youtu.be/...</code><br>
                            ฝั่งภาษาอังกฤษจะใช้วิดีโอเดียวกันกับภาษาไทยโดยอัตโนมัติ
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-info-circle"></i> เกี่ยวกับองค์กร (About)</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit">ประวัติองค์กร ร่างที่ 1 (TH)</label>
                        <textarea name="cp_about_desc_1[th]" class="form-control"
                            rows="4">{{ $settings->get('cp_about_desc_1')?->value_th }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit text-secondary">ประวัติองค์กร ร่างที่ 1 (EN)</label>
                        <textarea name="cp_about_desc_1[en]" class="form-control bg-light"
                            rows="4">{{ $settings->get('cp_about_desc_1')?->value_en }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit">ประวัติองค์กร ร่างที่ 2 (TH)</label>
                        <textarea name="cp_about_desc_2[th]" class="form-control"
                            rows="4">{{ $settings->get('cp_about_desc_2')?->value_th }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit text-secondary">ประวัติองค์กร ร่างที่ 2 (EN)</label>
                        <textarea name="cp_about_desc_2[en]" class="form-control bg-light"
                            rows="4">{{ $settings->get('cp_about_desc_2')?->value_en }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-compass"></i> วิสัยทัศน์ & พันธกิจ (Vision &
                    Mission)</h6>
            </div>
            <div class="card-body">
                {{-- Vision --}}
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit">วิสัยทัศน์ (Vision - TH)</label>
                        <textarea name="cp_vision[th]" class="form-control"
                            rows="3">{{ $settings->get('cp_vision')?->value_th }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit text-secondary">วิสัยทัศน์ (Vision - EN)</label>
                        <textarea name="cp_vision[en]" class="form-control bg-light"
                            rows="3">{{ $settings->get('cp_vision')?->value_en }}</textarea>
                    </div>
                </div>

                {{-- Mission --}}
                <h6 class="fw-bold mb-3 border-bottom pb-2">พันธกิจ (Missions)</h6>
                @for($i = 1; $i <= 9; $i++)
                    <div class="row mb-3 align-items-center">
                        <div class="col-auto">
                            <span class="badge bg-secondary">{{ $i }}</span>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="cp_mission_{{ $i }}[th]" class="form-control"
                                placeholder="พันธกิจข้อที่ {{ $i }} (TH)"
                                value="{{ $settings->get('cp_mission_' . $i)?->value_th }}">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="cp_mission_{{ $i }}[en]" class="form-control bg-light"
                                placeholder="พันธกิจข้อที่ {{ $i }} (EN)"
                                value="{{ $settings->get('cp_mission_' . $i)?->value_en }}">
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="card shadow border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-card-list"></i> ข้อมูลบริษัท (Company Info)
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit">ชื่อองค์กร (TH)</label>
                        <input type="text" name="cp_company_name[th]" class="form-control"
                            value="{{ $settings->get('cp_company_name')?->value_th }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit text-secondary">ชื่อองค์กร (EN)</label>
                        <input type="text" name="cp_company_name[en]" class="form-control bg-light"
                            value="{{ $settings->get('cp_company_name')?->value_en }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit">ทุนจดทะเบียน (TH & EN) <small
                                class="text-muted">(ไม่ต้องใส่คำว่า ล้านบาท)</small></label>
                        <input type="text" name="cp_capital[th]" class="form-control"
                            value="{{ $settings->get('cp_capital')?->value_th }}">
                        <input type="hidden" name="cp_capital[en]"
                            value="{{ $settings->get('cp_capital')?->value_en ?? $settings->get('cp_capital')?->value_th }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit">จำนวนฟาร์ม (TH / EN)</label>
                        <div class="input-group">
                            <input type="text" name="cp_farms_count[th]" class="form-control" placeholder="8 ฟาร์ม"
                                value="{{ $settings->get('cp_farms_count')?->value_th }}">
                            <input type="text" name="cp_farms_count[en]" class="form-control bg-light" placeholder="8 Farms"
                                value="{{ $settings->get('cp_farms_count')?->value_en }}">
                        </div>
                    </div>
                </div>

                <div class="row mt-3 border-top pt-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit">ที่ตั้งสำนักงาน (TH)</label>
                        <textarea name="cp_address[th]" class="form-control"
                            rows="2">{{ $settings->get('cp_address')?->value_th }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold font-kanit text-secondary">ที่ตั้งสำนักงาน (EN)</label>
                        <textarea name="cp_address[en]" class="form-control bg-light"
                            rows="2">{{ $settings->get('cp_address')?->value_en }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Fixed Save Button at the bottom --}}
        <div class="sticky-bottom bg-white p-3 shadow-sm border-top d-flex justify-content-end rounded-bottom mb-5"
            style="z-index: 1020;">
            <button type="submit" class="btn btn-primary px-5 py-2 fw-bold">
                <i class="bi bi-save me-2"></i> บันทึกข้อมูลองค์กร
            </button>
        </div>
    </form>
@endsection
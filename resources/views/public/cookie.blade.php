@extends('layouts.app')
@section('title', __('messages.cookie_policy') ?? 'นโยบายคุกกี้ - CFARM IR')

@section('content')
<div class="subpage-banner">
    <div class="container">
        <h1>{{ __('messages.cookie_policy') ?? 'นโยบายด้านคุกกี้' }}</h1>
        <p class="mb-0 text-white-50" style="letter-spacing: 2px; text-transform: uppercase;">Cookie Policy</p>
    </div>
</div>

<div class="section-ir bg-light-grey" style="padding: 60px 0 100px;">
    <div class="container">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4 p-md-5 bg-white" style="line-height: 1.8; color: #444;">
                
                <h4 class="fw-bold mb-4 text-dark" style="border-left: 4px solid var(--cfarm-green); padding-left: 15px;">นโยบายคุกกี้ (Cookie Policy)</h4>
                
                <p class="mb-4 text-muted">อัปเดตล่าสุด: {{ date('d M Y') }}</p>

                <p>เว็บไซต์นักลงทุนสัมพันธ์ของ บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) มีการใช้งานเทคโนโลยีคุกกี้เพื่อจดจำรูปแบบการใช้งานและปรับปรุงประสิทธิภาพการทำงาน เพื่อให้ท่านได้รับประสบการณ์ที่ดีที่สุดในการเรียกดูหน้าเว็บไซต์</p>

                <h5 class="fw-bold mt-5 mb-3 text-dark">1. คุกกี้ (Cookies) คืออะไร?</h5>
                <p>คุกกี้ คือ ไฟล์ข้อมูลขนาดเล็กมากที่ถูกดาวน์โหลดไปยังคอมพิวเตอร์ แท็บเล็ต หรืออุปกรณ์มือถือของท่านเมื่อท่านเข้าชมเว็บไซต์ คุกกี้จะถูกส่งกลับไปยังเว็บไซต์ต้นทางเพื่อช่วยให้เว็บไซต์จดจำอุปกรณ์ของท่านและประมวลผลให้การนำทางหน้าเว็บไหลลื่นขึ้น เช่น การจดจำภาษาที่ท่านเลือก หรือเซสซันการยืนยันตัวตนต่างๆ</p>

                <h5 class="fw-bold mt-5 mb-3 text-dark">2. ประเภทของคุกกี้ที่บริษัทใช้งาน</h5>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 25%;">ประเภทของคุกกี้</th>
                                <th>คำอธิบายและการนำไปใช้งาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong class="text-success"><i class="bi bi-shield-lock me-1"></i> คุกกี้ที่มีความจำเป็นอย่างยิ่ง<br>(Strictly Necessary Cookies)</strong></td>
                                <td>เป็นคุกกี้ที่จำเป็นพื้นฐานเพื่อให้เว็บไซต์สามารถทำงานได้อย่างสมบูรณ์ ปลอดภัย และมีเสถียรภาพ คุกกี้ประเภทนี้ไม่สามารถรวมหรือปิดการใช้งานในระบบของเราได้ เช่น คุกกี้ด้านความปลอดภัยในการ Login หรือการจัดการตะกร้าการซิงค์ข้อมูล</td>
                            </tr>
                            <tr>
                                <td><strong class="text-primary"><i class="bi bi-gear-wide-connected me-1"></i> คุกกี้เพื่อประสิทธิภาพการทำงาน<br>(Performance Cookies)</strong></td>
                                <td>ใช้สำหรับเก็บบันทึกข้อมูลเชิงสถิติ (แบบไม่ระบุตัวตน) เพื่อให้เราทราบว่าผู้เข้าชมส่วนใหญ่ปฏิสัมพันธ์กับหน้าเว็บอย่างไร และใช้หน้าไหนนานที่สุด เพื่อนำปปรับปรุงเลย์เอาท์และโครงสร้างให้ตอบสนองความต้องการมากยิ่งขึ้น</td>
                            </tr>
                            <tr>
                                <td><strong class="text-info text-dark"><i class="bi bi-palette me-1"></i> คุกกี้เพื่อการทำงานของเว็บไซต์<br>(Functional Cookies)</strong></td>
                                <td>ใช้สำหรับจดจำตัวเลือกของท่าน อาทิ การตั้งค่าฟอนต์ สี ภูมิภาค หรือภาษา (เช่น <code>session('locale')</code> ของ Laravel) เพื่อช่วยให้ไม่ต้องตั้งค่าใหม่ในทุกรอบที่เข้าใช้งาน</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h5 class="fw-bold mt-5 mb-3 text-dark">3. คุกกี้ของบุคคลที่สาม (Third-Party Cookies)</h5>
                <p>ในบางกรณี เว็บไซต์ของเราจะมีการใช้คุกกี้จากบุคคลที่สามที่เชื่อถือได้ (เช่น Google Analytics หรือคุกกี้จากสื่อ Social Media ต่างๆ) เพื่ออำนวยความสะดวกในการวิเคราะห์สถิติ โดยคุกกี้เหล่านี้จะถูกควบคุมนโยบายจากผู้ให้บริการภายนอก บริษัทไม่มีอำนาจการเข้าไปแทรกแซงเทคนิคการเก็บข้อมูลดังกล่าว</p>

                <h5 class="fw-bold mt-5 mb-3 text-dark">4. การจัดการและตั้งค่าคุกกี้</h5>
                <p>ท่านสามารถบล็อกหรือลบการตั้งค่าคุกกี้บนอุปกรณ์ของท่านได้ตลอดเวลาผ่านทางหมวดหมู่การตั้งค่าของ Browser ที่ท่านใช้งานอยู่ แต่โปรดทราบว่าหากท่านปิดการทำงานของคุกกี้ทั้งหมด บริการฟังก์ชันบางอย่างบนหน้าเว็บอาจจะไม่สามารถทำงานได้อย่างเต็มประสิทธิภาพ:</p>
                <div class="row g-3 mt-1">
                    <div class="col-sm-6 col-md-3">
                        <a href="https://support.google.com/chrome/answer/95647" target="_blank" class="btn btn-outline-secondary w-100"><i class="bi bi-browser-chrome text-primary"></i> Chrome</a>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <a href="https://support.apple.com/th-th/guide/safari/sfri11471/mac" target="_blank" class="btn btn-outline-secondary w-100"><i class="bi bi-browser-safari text-info"></i> Safari</a>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <a href="https://support.mozilla.org/en-US/kb/enhanced-tracking-protection-firefox-desktop" target="_blank" class="btn btn-outline-secondary w-100"><i class="bi bi-browser-firefox text-warning"></i> Firefox</a>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <a href="https://support.microsoft.com/en-us/windows/microsoft-edge-browsing-data-and-privacy-bb8174ba-9d73-dcf2-9b4a-c582b4e640dd" target="_blank" class="btn btn-outline-secondary w-100"><i class="bi bi-browser-edge text-primary"></i> Edge</a>
                    </div>
                </div>

                <h5 class="fw-bold mt-5 mb-3 text-dark">5. การอัปเดตนโยบายคุกกี้</h5>
                <p>บริษัทอาจมีปรับปรุงแก้ไขนโยบายฉบับนี้เป็นครั้งคราวให้สอดคล้องกับระเบียบข้อบังคับ เราขอแนะนำให้ท่านตรวจสอบหน้านี้อย่างสม่ำเสมอเพื่อติดตามทบทวนนโยบายใหม่ๆ หากมีการเปลี่ยนแปลงข้อมูลสำคัญเราจะแสดงแถบแจ้งเตือนที่หน้าแรกของเว็บไซต์</p>

            </div>
        </div>
    </div>
</div>
@endsection

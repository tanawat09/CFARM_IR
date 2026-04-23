<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Role, Permission, User, NewsCategory, News, NewsTag,
    DocumentCategory, DocumentYear, Document,
    FinancialCategory, FinancialReport,
    EventType, Event,
    BoardDirector, ManagementTeam,
    ShareholdingStructure, GovernanceDocument
};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Roles ──
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);

        // ── Permissions ──
        foreach (['manage_news','manage_documents','manage_events','manage_users','manage_settings'] as $p) {
            $perm = Permission::create(['name' => $p]);
            $admin->permissions()->attach($perm);
        }
        foreach (['manage_news','manage_documents','manage_events'] as $p) {
            $editor->permissions()->attach(Permission::where('name', $p)->first());
        }

        // ── Users ──
        User::create([
            'name' => 'Admin CFARM',
            'email' => 'admin@chuwitfarm.com',
            'password' => Hash::make((string) env('ADMIN_PASSWORD', Str::random(32))),
            'role_id' => $admin->id,
        ]);
        User::create([
            'name' => 'Editor CFARM',
            'email' => 'editor@chuwitfarm.com',
            'password' => Hash::make((string) env('EDITOR_PASSWORD', Str::random(32))),
            'role_id' => $editor->id,
        ]);

        // ── News Categories ──
        $nc1 = NewsCategory::create(['name_th' => 'ข่าวแจ้งตลาดหลักทรัพย์', 'name_en' => 'SET Announcements']);
        $nc2 = NewsCategory::create(['name_th' => 'ข่าวประชาสัมพันธ์', 'name_en' => 'Press Releases']);
        $nc3 = NewsCategory::create(['name_th' => 'กิจกรรมเพื่อสังคม (CSR)', 'name_en' => 'CSR Activities']);

        // ── News Tags ──
        $t1 = NewsTag::create(['name' => 'Financial']);
        $t2 = NewsTag::create(['name' => 'CSR']);
        $t3 = NewsTag::create(['name' => 'AGM']);

        // ── News ──
        $news1 = News::create([
            'category_id' => $nc1->id,
            'user_id' => 1,
            'title_th' => 'CFARM แจ้งผลการดำเนินงานประจำปี 2568',
            'title_en' => 'CFARM Announces Annual Operating Results 2025',
            'content_th' => 'บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) แจ้งผลการดำเนินงานประจำปี 2568 โดยมีรายได้จากการขายไก่เนื้อจากฟาร์มทั้ง 8 แห่ง เติบโตอย่างต่อเนื่อง',
            'content_en' => 'CHUWIT FARM (2019) PCL announces its 2025 annual operating results with continuous revenue growth from all 8 broiler chicken farms.',
            'slug' => 'cfarm-annual-results-2025',
            'is_published' => true,
            'published_at' => now(),
        ]);
        $news1->tags()->attach([$t1->id]);

        $news2 = News::create([
            'category_id' => $nc3->id,
            'user_id' => 1,
            'title_th' => 'CFARM ร่วมกิจกรรม CSR ช่วยเหลือพี่น้องชาวไทยชายแดนไทย-กัมพูชา',
            'title_en' => 'CFARM CSR: Providing Aid to Citizens at Thai-Cambodian Border',
            'content_th' => 'บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) จัดกิจกรรม CSR ให้ความช่วยเหลือพี่น้องประชาชนบริเวณชายแดนไทย-กัมพูชา พร้อมมอบสิ่งของจำเป็นแก่ชุมชน',
            'content_en' => 'CHUWIT FARM (2019) PCL organized CSR activities to provide aid to citizens along the Thai-Cambodian border.',
            'slug' => 'cfarm-csr-border-aid',
            'is_published' => true,
            'published_at' => now()->subDays(5),
        ]);
        $news2->tags()->attach([$t2->id]);

        News::create([
            'category_id' => $nc3->id,
            'user_id' => 1,
            'title_th' => 'CFARM รักษ์สิ่งแวดล้อม ร่วมปลูกหญ้าแฝกอนุรักษ์ดินและน้ำ',
            'title_en' => 'CFARM Environmental Conservation: Planting Vetiver Grass',
            'content_th' => 'บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) ดำเนินโครงการอนุรักษ์สิ่งแวดล้อมโดยร่วมปลูกหญ้าแฝกเพื่อรักษาหน้าดินและแหล่งน้ำ สอดคล้องกับพันธกิจด้านการอยู่ร่วมกับสิ่งแวดล้อมอย่างยั่งยืน',
            'content_en' => 'CHUWIT FARM (2019) PCL launched an environmental conservation project by planting vetiver grass for soil and water conservation.',
            'slug' => 'cfarm-vetiver-grass-conservation',
            'is_published' => true,
            'published_at' => now()->subDays(10),
        ]);

        News::create([
            'category_id' => $nc1->id,
            'user_id' => 1,
            'title_th' => 'แจ้งมติที่ประชุมสามัญผู้ถือหุ้นประจำปี 2568',
            'title_en' => 'Resolution of Annual General Meeting 2025',
            'content_th' => 'บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) ขอแจ้งมติที่ประชุมสามัญผู้ถือหุ้นประจำปี 2568 ต่อตลาดหลักทรัพย์',
            'content_en' => 'CHUWIT FARM (2019) PCL announces the resolutions of the 2025 Annual General Meeting of Shareholders.',
            'slug' => 'cfarm-agm-resolution-2025',
            'is_published' => true,
            'published_at' => now()->subDays(15),
        ]);

        News::create([
            'category_id' => $nc2->id,
            'user_id' => 1,
            'title_th' => 'CFARM ขยายกำลังการผลิตฟาร์มไก่เนื้อ เดินหน้าตามแผนการเติบโต',
            'title_en' => 'CFARM Expands Broiler Farm Production Capacity',
            'content_th' => 'บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) ประกาศแผนขยายกำลังการผลิตฟาร์มเลี้ยงไก่เนื้อ เพื่อรองรับความต้องการของตลาดที่เพิ่มขึ้น',
            'content_en' => 'CHUWIT FARM (2019) PCL announces plans to expand broiler chicken farm production capacity.',
            'slug' => 'cfarm-farm-expansion-plan',
            'is_published' => true,
            'published_at' => now()->subDays(20),
        ]);

        // ── Document Categories & Years ──
        $dc1 = DocumentCategory::create(['name_th' => 'รายงานประจำปี (แบบ 56-1 One Report)', 'name_en' => 'Annual Report (Form 56-1 One Report)']);
        $dc2 = DocumentCategory::create(['name_th' => 'เอกสารนำเสนอ & Webcasts', 'name_en' => 'Investor Presentations & Webcasts']);
        $dc3 = DocumentCategory::create(['name_th' => 'หนังสือชี้ชวน', 'name_en' => 'Prospectus']);
        $dc4 = DocumentCategory::create(['name_th' => 'หนังสือเชิญประชุมผู้ถือหุ้น', 'name_en' => 'Shareholder Meeting Invitation']);
        $dc5 = DocumentCategory::create(['name_th' => 'รายงานความยั่งยืน', 'name_en' => 'Sustainability Report']);

        $y1 = DocumentYear::create(['year' => 2568]);
        $y2 = DocumentYear::create(['year' => 2567]);
        $y3 = DocumentYear::create(['year' => 2566]);

        Document::create([
            'category_id' => $dc1->id, 'year_id' => $y1->id,
            'title_th' => 'แบบ 56-1 One Report ปี 2568', 'title_en' => 'Form 56-1 One Report 2025',
            'file_path' => 'documents/56-1-one-report-2568.pdf', 'downloads' => 120,
        ]);
        Document::create([
            'category_id' => $dc4->id, 'year_id' => $y1->id,
            'title_th' => 'หนังสือเชิญประชุมสามัญผู้ถือหุ้นประจำปี 2569', 'title_en' => 'AGM 2026 Invitation',
            'file_path' => 'documents/agm-2569-invitation.pdf', 'downloads' => 85,
        ]);

        // ── Financial Categories & Reports ──
        $fc1 = FinancialCategory::create(['name_th' => 'งบการเงิน', 'name_en' => 'Financial Statements']);
        $fc2 = FinancialCategory::create(['name_th' => 'คำอธิบายและการวิเคราะห์ของฝ่ายจัดการ (MD&A)', 'name_en' => 'MD&A']);
        $fc3 = FinancialCategory::create(['name_th' => 'รายงานประจำปี', 'name_en' => 'Annual Report']);

        FinancialReport::create([
            'category_id' => $fc1->id, 'year_id' => $y1->id,
            'title_th' => 'งบการเงินรวม ไตรมาส 4/2568', 'title_en' => 'Consolidated Financial Statements Q4/2025',
            'file_path' => 'financial/fs-q4-2568.pdf',
        ]);
        FinancialReport::create([
            'category_id' => $fc2->id, 'year_id' => $y1->id,
            'title_th' => 'คำอธิบายและการวิเคราะห์ของฝ่ายจัดการ ไตรมาส 4/2568', 'title_en' => 'MD&A Q4/2025',
            'file_path' => 'financial/mda-q4-2568.pdf',
        ]);
        FinancialReport::create([
            'category_id' => $fc3->id, 'year_id' => $y1->id,
            'title_th' => 'รายงานประจำปี 2568', 'title_en' => 'Annual Report 2025',
            'file_path' => 'financial/annual-report-2568.pdf',
        ]);

        // ── Event Types & Events ──
        $et1 = EventType::create(['name_th' => 'ประชุมสามัญผู้ถือหุ้น', 'name_en' => 'AGM']);
        $et2 = EventType::create(['name_th' => 'Opportunity Day', 'name_en' => 'Opportunity Day']);
        $et3 = EventType::create(['name_th' => 'บริษัทจดทะเบียนพบผู้ลงทุน', 'name_en' => 'Company Visit']);

        Event::create([
            'event_type_id' => $et1->id,
            'title_th' => 'การประชุมสามัญผู้ถือหุ้นประจำปี 2569',
            'title_en' => 'Annual General Meeting 2026',
            'description_th' => 'ขอเรียนเชิญผู้ถือหุ้นเข้าร่วมประชุมสามัญผู้ถือหุ้นประจำปี 2569 ของบริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน)',
            'description_en' => 'Shareholders are invited to attend the 2026 AGM of CHUWIT FARM (2019) PCL.',
            'event_start' => '2026-04-25 09:00:00',
            'event_end' => '2026-04-25 12:00:00',
            'location' => 'สำนักงานใหญ่ ชูวิทย์ฟาร์ม จ.บุรีรัมย์',
        ]);
        Event::create([
            'event_type_id' => $et2->id,
            'title_th' => 'Opportunity Day ไตรมาส 1/2569',
            'title_en' => 'Opportunity Day Q1/2026',
            'description_th' => 'บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) จัดงาน Opportunity Day นำเสนอผลการดำเนินงานไตรมาส 1/2569',
            'description_en' => 'CFARM Opportunity Day Q1/2026 earnings presentation.',
            'event_start' => '2026-05-20 13:00:00',
            'event_end' => '2026-05-20 15:00:00',
            'location' => 'ตลาดหลักทรัพย์ เอ็ม เอ ไอ (mai)',
        ]);

        // ── Board of Directors (Real from chuwitfarm.com) ──
        BoardDirector::create([
            'name_th' => 'นายชูวิทย์ จังตนะสมบูรณ์', 'name_en' => 'Mr. Chuwit Jungtanasomboon',
            'position_th' => 'ประธานกรรมการ / ประธานเจ้าหน้าที่บริหาร', 'position_en' => 'Chairman / CEO',
            'biography_th' => 'ผู้ก่อตั้งและผู้นำธุรกิจฟาร์มเลี้ยงไก่เนื้อชั้นนำ ผู้ถือหุ้นใหญ่ถือหุ้น 41.96%',
            'biography_en' => 'Founder and leader of the leading broiler chicken farming business. Major shareholder with 41.96% stake.',
            'display_order' => 1,
        ]);
        BoardDirector::create([
            'name_th' => 'นางสาวสิรินทิพย์ จังตนะสมบูรณ์', 'name_en' => 'Ms. Sirinthip Jungtanasomboon',
            'position_th' => 'กรรมการ', 'position_en' => 'Director',
            'biography_th' => 'กรรมการบริษัท ผู้ถือหุ้นสัดส่วน 13.45%',
            'biography_en' => 'Director of the company. Holds 13.45% of shares.',
            'display_order' => 2,
        ]);
        BoardDirector::create([
            'name_th' => 'นางสาวปสิกา จังตนะสมบูรณ์', 'name_en' => 'Ms. Pasika Jungtanasomboon',
            'position_th' => 'กรรมการ', 'position_en' => 'Director',
            'biography_th' => 'กรรมการบริษัท ผู้ถือหุ้นสัดส่วน 13.45%',
            'biography_en' => 'Director of the company. Holds 13.45% of shares.',
            'display_order' => 3,
        ]);
        BoardDirector::create([
            'name_th' => 'นางสาวพิมพ์ทบัติ จังตนะสมบูรณ์', 'name_en' => 'Ms. Pimtabhat Jungtanasomboon',
            'position_th' => 'กรรมการ', 'position_en' => 'Director',
            'biography_th' => 'กรรมการบริษัท ผู้ถือหุ้นสัดส่วน 13.45%',
            'biography_en' => 'Director of the company. Holds 13.45% of shares.',
            'display_order' => 4,
        ]);

        // ── Management Team ──
        ManagementTeam::create([
            'name_th' => 'นายชูวิทย์ จังตนะสมบูรณ์', 'name_en' => 'Mr. Chuwit Jungtanasomboon',
            'position_th' => 'ประธานเจ้าหน้าที่บริหาร', 'position_en' => 'Chief Executive Officer (CEO)',
            'display_order' => 1,
        ]);
        ManagementTeam::create([
            'name_th' => 'นางปนิดา จังตนะสมบูรณ์', 'name_en' => 'Mrs. Panida Jungtanasomboon',
            'position_th' => 'รองประธานเจ้าหน้าที่บริหาร / เลขานุการบริษัท', 'position_en' => 'Deputy CEO / Company Secretary',
            'display_order' => 2,
        ]);

        // ── Shareholding Structure (Real from SET data) ──
        $sh_data = [
            ['name_th' => 'น.ส. มธุชา จึงธนสมบูรณ์', 'shares' => 237170000, 'percent' => 40.89],
            ['name_th' => 'น.ส. วิลาสิณี จึงธนสมบูรณ์', 'shares' => 72575000, 'percent' => 12.51],
            ['name_th' => 'นาย จิรายุส จึงธนสมบูรณ์', 'shares' => 72575000, 'percent' => 12.51],
            ['name_th' => 'นาย ชูวิทย์ จึงธนสมบูรณ์', 'shares' => 20840000, 'percent' => 3.59],
            ['name_th' => 'นาง ภณิดา จึงธนสมบูรณ์', 'shares' => 18040000, 'percent' => 3.11],
            ['name_th' => 'นาย สิปปกร ขาวสอาด', 'shares' => 8354100, 'percent' => 1.44],
            ['name_th' => 'นาย ประเสริฐ เหลืองสมบูรณ์', 'shares' => 6400000, 'percent' => 1.10],
            ['name_th' => 'นาย วรพัทธ อีวานากะ', 'shares' => 5380000, 'percent' => 0.93],
            ['name_th' => 'น.ส. ศรินยา จึงธนสมบูรณ์', 'shares' => 4200000, 'percent' => 0.72],
            ['name_th' => 'นาย นรินทร์ จึงธนสมบูรณ์', 'shares' => 4200000, 'percent' => 0.72],
            ['name_th' => 'นาง ชุม จึงธนสมบูรณ์', 'shares' => 4200000, 'percent' => 0.72],
            ['name_th' => 'นาง สุดใจ วุฒิศักดิ์ศิลป์', 'shares' => 3015800, 'percent' => 0.52],
        ];

        foreach ($sh_data as $sh) {
            ShareholdingStructure::create([
                'shareholder_name_th' => $sh['name_th'],
                'shareholder_name_en' => '-',
                'number_of_shares' => $sh['shares'],
                'percentage' => $sh['percent'],
                'as_of_date' => '2025-03-14',
            ]);
        }

        // ── Governance Documents ──
        GovernanceDocument::create([
            'title_th' => 'นโยบายการกำกับดูแลกิจการ', 'title_en' => 'Corporate Governance Policy',
            'file_path' => 'governance/cg-policy.pdf', 'version' => '1.0', 'effective_date' => '2023-03-13',
        ]);
        GovernanceDocument::create([
            'title_th' => 'จรรยาบรรณธุรกิจ', 'title_en' => 'Code of Conduct',
            'file_path' => 'governance/code-of-conduct.pdf', 'version' => '1.0', 'effective_date' => '2023-03-13',
        ]);
        GovernanceDocument::create([
            'title_th' => 'นโยบายต่อต้านการทุจริตคอร์รัปชัน', 'title_en' => 'Anti-Corruption Policy',
            'file_path' => 'governance/anti-corruption.pdf', 'version' => '1.0', 'effective_date' => '2023-03-13',
        ]);
    }
}

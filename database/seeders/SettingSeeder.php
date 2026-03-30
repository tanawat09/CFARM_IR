<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'home_business_company_desc',
                'value_th' => 'บริษัทดำเนินธุรกิจฟาร์มเลี้ยงไก่พันธุ์เนื้อประเภทประกันราคาแบบมีสัญญาผูกพัน (Contract Farming) โดยเลี้ยงในโรงเรือนระบบปิดปรับอากาศ (EVAP) จำนวน 8 ฟาร์ม เทคโนโลยีทันสมัย ปลอดภัยตามมาตรฐานสากล',
                'value_en' => 'The company operates a Contract Farming broiler business, raised in 8 Evaporative Cooling System (EVAP) closed houses with modern technology and international safety standards.',
                'type' => 'textarea',
                'group' => 'home_page'
            ],
            [
                'key' => 'home_business_broilers_title',
                'value_th' => 'ไก่เนื้อ - Contract Farming',
                'value_en' => 'Broilers - Contract Farming',
                'type' => 'text',
                'group' => 'home_page'
            ],
            [
                'key' => 'home_business_broilers_percentage',
                'value_th' => '90',
                'value_en' => '90',
                'type' => 'text',
                'group' => 'home_page'
            ],
            [
                'key' => 'home_business_broilers_desc',
                'value_th' => 'รายได้จากการจำหน่ายไก่เนื้อรูปแบบประกันราคา',
                'value_en' => 'Revenue from the sale of broilers under a guaranteed price contract.',
                'type' => 'textarea',
                'group' => 'home_page'
            ],
            [
                'key' => 'home_business_by_products_title',
                'value_th' => 'ผลพลอยได้ (มูลไก่)',
                'value_en' => 'By-products (Chicken Manure)',
                'type' => 'text',
                'group' => 'home_page'
            ],
            [
                'key' => 'home_business_by_products_percentage',
                'value_th' => '10',
                'value_en' => '10',
                'type' => 'text',
                'group' => 'home_page'
            ],
            [
                'key' => 'home_business_by_products_desc',
                'value_th' => 'รายได้จากการขายมูลไก่เพื่อทำปุ๋ยชีวภาพ',
                'value_en' => 'Revenue from selling chicken manure for bio-fertilizer.',
                'type' => 'textarea',
                'group' => 'home_page'
            ],
            // ==========================================
            // Company Profile Settings
            // ==========================================
            [
                'key' => 'cp_about_desc_1',
                'value_th' => 'บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน) ("บริษัทฯ") มุ่งมั่นในการพัฒนาและประกอบการธุรกิจฟาร์มปศุสัตว์ที่ยั่งยืนและมีมาตรฐานสูงสุด...',
                'value_en' => 'CHUWIT FARM (2019) PUBLIC COMPANY LIMITED is committed to developing and operating sustainable livestock farming business...',
                'type' => 'textarea',
                'group' => 'company_profile'
            ],
            [
                'key' => 'cp_about_desc_2',
                'value_th' => 'เราเริ่มดำเนินการตั้งแต่ปี 2540 ด้วยความมุ่งมั่นที่จะพัฒนาคุณภาพ...',
                'value_en' => 'We started operations since 1997 with a commitment to quality development...',
                'type' => 'textarea',
                'group' => 'company_profile'
            ],
            [
                'key' => 'cp_vision',
                'value_th' => '“เป็นผู้นำในการฟาร์มปศุสัตว์ที่ทันสมัย ปลอดภัย และยั่งยืน เพื่อยกระดับคุณภาพชีวิตของสังคม”',
                'value_en' => '“To be a leader in modern, safe, and sustainable livestock farming to elevate the society\'s quality of life”',
                'type' => 'textarea',
                'group' => 'company_profile'
            ],
            [
                'key' => 'cp_mission_1',
                'value_th' => 'นำเทคโนโลยีที่ทันสมัยมาใช้ในระบบ EVAP เพื่อการจัดการที่มีประสิทธิภาพ',
                'value_en' => 'Utilize modern technology in EVAP systems for efficient management.',
                'type' => 'text',
                'group' => 'company_profile'
            ],
            [
                'key' => 'cp_mission_2',
                'value_th' => 'ให้ความสำคัญกับมาตรฐานความปลอดภัยด้านอาหาร (Food Safety)',
                'value_en' => 'Focus on Food Safety standards.',
                'type' => 'text',
                'group' => 'company_profile'
            ],
            [
                'key' => 'cp_mission_3',
                'value_th' => 'ดูแลใส่ใจสิ่งแวดล้อมและลดผลกระทบต่อชุมชนรอบข้าง',
                'value_en' => 'Care for the environment and minimize community impact.',
                'type' => 'text',
                'group' => 'company_profile'
            ],
            // Company Info section
            [
                'key' => 'cp_company_name',
                'value_th' => 'บริษัท ชูวิทย์ฟาร์ม (2019) จำกัด (มหาชน)',
                'value_en' => 'CHUWIT FARM (2019) PUBLIC COMPANY LIMITED',
                'type' => 'text',
                'group' => 'company_profile'
            ],
            [
                'key' => 'cp_capital',
                'value_th' => '580,000,000',
                'value_en' => '580,000,000',
                'type' => 'text',
                'group' => 'company_profile'
            ],
            [
                'key' => 'cp_farms_count',
                'value_th' => '8 ฟาร์ม',
                'value_en' => '8 Farms',
                'type' => 'text',
                'group' => 'company_profile'
            ],
            [
                'key' => 'cp_address',
                'value_th' => '723 ถ.โชคชัย-เดชอุดม ต.นางรอง อ.นางรอง จ.บุรีรัมย์ 31110',
                'value_en' => '723 Chokchai-Det Udom Rd., Nang Rong, Buriram 31110',
                'type' => 'text',
                'group' => 'company_profile'
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}

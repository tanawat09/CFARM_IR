<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RevenueStructure;

class RevenueStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $structures = [
            [
                'title_th' => 'ไก่เนื้อ - Contract Farming',
                'title_en' => 'Broilers - Contract Farming',
                'description_th' => 'รายได้จากการจำหน่ายไก่เนื้อรูปแบบประกันราคา',
                'description_en' => 'Revenue from the sale of broilers under a guaranteed price contract.',
                'percentage' => 90,
                'icon_class' => 'bi bi-egg',
                'color' => 'success',
                'order' => 1,
            ],
            [
                'title_th' => 'ผลพลอยได้ (มูลไก่)',
                'title_en' => 'By-products (Chicken Manure)',
                'description_th' => 'รายได้จากการขายมูลไก่เพื่อทำปุ๋ยชีวภาพ',
                'description_en' => 'Revenue from selling chicken manure for bio-fertilizer.',
                'percentage' => 10,
                'icon_class' => 'bi bi-recycle',
                'color' => 'warning',
                'order' => 2,
            ]
        ];

        foreach ($structures as $structure) {
            RevenueStructure::updateOrCreate(
                ['title_th' => $structure['title_th']],
                $structure
            );
        }
    }
}

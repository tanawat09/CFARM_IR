<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShareholdingStructure;
use Illuminate\Support\Facades\DB;

class UpdateShareholdersSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ShareholdingStructure::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $data = [
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

        foreach ($data as $item) {
            ShareholdingStructure::create([
                'shareholder_name_th' => $item['name_th'],
                'shareholder_name_en' => '-',
                'number_of_shares' => $item['shares'],
                'percentage' => $item['percent'],
                'as_of_date' => '2025-03-14', // 14 มี.ค. 2568 (Buddhist year - 543)
            ]);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'year_id', 'title_th', 'title_en', 'file_path',
    ];

    public function category()
    {
        return $this->belongsTo(FinancialCategory::class, 'category_id');
    }

    public function year()
    {
        return $this->belongsTo(DocumentYear::class, 'year_id');
    }

    public function documentYear()
    {
        return $this->year();
    }
}

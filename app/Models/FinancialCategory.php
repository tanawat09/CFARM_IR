<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name_th', 'name_en'];

    public function reports()
    {
        return $this->hasMany(FinancialReport::class, 'category_id');
    }
}

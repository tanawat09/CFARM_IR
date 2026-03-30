<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentYear extends Model
{
    use HasFactory;

    protected $fillable = ['year'];

    public function documents()
    {
        return $this->hasMany(Document::class, 'year_id');
    }

    public function financialReports()
    {
        return $this->hasMany(FinancialReport::class, 'year_id');
    }
}

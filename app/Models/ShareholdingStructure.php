<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareholdingStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'shareholder_name_th', 'shareholder_name_en',
        'number_of_shares', 'percentage', 'as_of_date',
    ];

    protected $casts = [
        'percentage' => 'decimal:2',
        'as_of_date' => 'date',
    ];
}

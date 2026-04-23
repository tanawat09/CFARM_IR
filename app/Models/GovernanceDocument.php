<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernanceDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_th', 'title_en', 'category', 'file_path', 'version', 'effective_date', 'display_order',
    ];

    protected $casts = [
        'effective_date' => 'date',
    ];
}

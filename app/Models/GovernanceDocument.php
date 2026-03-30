<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernanceDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_th', 'title_en', 'file_path', 'version', 'effective_date',
    ];

    protected $casts = [
        'effective_date' => 'date',
    ];
}

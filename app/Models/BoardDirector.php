<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardDirector extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_th', 'name_en', 'position_th', 'position_en',
        'biography_th', 'biography_en', 'image_path', 'display_order',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];
}

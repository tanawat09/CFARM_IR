<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernanceSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_key', 'content_th', 'content_en', 'image_path',
    ];
}

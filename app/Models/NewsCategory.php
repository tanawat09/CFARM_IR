<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name_th', 'name_en'];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value_th',
        'value_en',
        'type',
        'group',
    ];

    /**
     * Helper to get localized value
     */
    public function getValueAttribute()
    {
        $locale = session('locale', 'th');
        return $locale === 'en' && !empty($this->value_en) ? $this->value_en : $this->value_th;
    }
}

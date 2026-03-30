<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevenueStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_th',
        'title_en',
        'description_th',
        'description_en',
        'percentage',
        'icon_class',
        'color',
        'order',
    ];

    /**
     * Scope a query to only include ordered sections.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Get the localized title based on the application locale.
     */
    public function getTitleAttribute()
    {
        return app()->getLocale() === 'en' && $this->title_en ? $this->title_en : $this->title_th;
    }

    /**
     * Get the localized description based on the application locale.
     */
    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'en' && $this->description_en ? $this->description_en : $this->description_th;
    }
}

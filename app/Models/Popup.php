<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_th', 'title_en', 'content_th', 'content_en',
        'image_path', 'link_url', 'link_text_th', 'link_text_en',
        'is_active', 'start_date', 'end_date', 'display_pages', 'display_order',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    /**
     * Get active popups for the current date and page
     */
    public static function getActive($page = 'home')
    {
        $today = now()->toDateString();

        return self::where('is_active', true)
            ->where(function ($q) use ($page) {
                $q->where('display_pages', 'all')
                  ->orWhere('display_pages', $page);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', $today);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', $today);
            })
            ->orderBy('display_order')
            ->get();
    }
}

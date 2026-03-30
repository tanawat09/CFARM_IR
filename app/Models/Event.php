<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type_id', 'title_th', 'title_en',
        'description_th', 'description_en',
        'event_start', 'event_end', 'location', 'document_path',
    ];

    protected $casts = [
        'event_start' => 'datetime',
        'event_end' => 'datetime',
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_start', '>=', now())->orderBy('event_start');
    }
}

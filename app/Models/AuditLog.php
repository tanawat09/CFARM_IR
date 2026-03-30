<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event',
        'auditable_type',
        'auditable_id',
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent',
        'hash_signature',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    /**
     * Get the user that triggered the audit event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the owning auditable model.
     */
    public function auditable()
    {
        return $this->morphTo();
    }

    protected static function booted()
    {
        // Hash chaining logic when creating a new Log
        static::creating(function ($auditLog) {
            $payload = json_encode([
                'user_id' => $auditLog->user_id,
                'event' => $auditLog->event,
                'auditable_type' => $auditLog->auditable_type,
                'auditable_id' => $auditLog->auditable_id,
                'old_values' => $auditLog->old_values,
                'new_values' => $auditLog->new_values,
                'created_at' => now()->toIso8601String(),
            ]);

            // Get the hash of the most recent log to chain it
            $previousLog = static::latest('id')->first();
            $previousHash = $previousLog ? $previousLog->hash_signature : 'genesis';

            $secret = config('app.key');
            
            // Generate HMAC SHA-256 for the chain
            $auditLog->hash_signature = hash_hmac('sha256', $previousHash . $payload, $secret);
        });
    }
}

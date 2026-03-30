<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->latest();

        // Optional filtering by event type or auditable type (for future extensions)
        if ($request->has('event') && $request->event != '') {
            $query->where('event', $request->event);
        }

        $logs = $query->paginate(20);
        return view('admin.audit_logs.index', compact('logs'));
    }

    public function show(AuditLog $auditLog)
    {
        $auditLog->load('user');

        // Verify Hash Signature for Data Integrity Check
        $previousLog = AuditLog::where('id', '<', $auditLog->id)->orderBy('id', 'desc')->first();
        $previousHash = $previousLog ? $previousLog->hash_signature : 'genesis';

        $payload = json_encode([
            'user_id' => $auditLog->user_id,
            'event' => $auditLog->event,
            'auditable_type' => $auditLog->auditable_type,
            'auditable_id' => $auditLog->auditable_id,
            'old_values' => $auditLog->old_values,
            'new_values' => $auditLog->new_values,
            'created_at' => $auditLog->created_at->toIso8601String(),
        ]);

        $calculatedHash = hash_hmac('sha256', $previousHash . $payload, config('app.key'));
        $isValidIntegrity = hash_equals($auditLog->hash_signature ?? '', $calculatedHash);

        return view('admin.audit_logs.show', compact('auditLog', 'isValidIntegrity'));
    }
}

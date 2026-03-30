<?php

namespace App\Listeners;

use App\Models\AuditLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class LogAuthenticationEvents
{
    public function handleLogin(Login $event)
    {
        $this->logEvent($event->user->id, 'login', get_class($event->user), $event->user->id);
    }

    public function handleLogout(Logout $event)
    {
        if ($event->user) {
            $this->logEvent($event->user->id, 'logout', get_class($event->user), $event->user->id);
        }
    }

    protected function logEvent($userId, $action, $auditableType, $auditableId)
    {
        AuditLog::create([
            'user_id'        => $userId,
            'event'          => $action,
            'auditable_type' => $auditableType,
            'auditable_id'   => $auditableId,
            'url'            => request()->fullUrl(),
            'ip_address'     => request()->ip(),
            'user_agent'     => request()->userAgent(),
        ]);
    }
}

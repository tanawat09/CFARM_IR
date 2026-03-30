<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;

class AuditObserver
{
    protected function logEvent(Model $model, string $event)
    {
        $oldValues = [];
        $newValues = [];

        if ($event === 'created') {
            $newValues = $model->getAttributes();
        } elseif ($event === 'updated') {
            $oldValues = array_intersect_key($model->getOriginal(), $model->getDirty());
            $newValues = $model->getDirty();
        } elseif ($event === 'deleted') {
            $oldValues = $model->getAttributes();
        }

        AuditLog::create([
            'user_id'        => auth()->id(),
            'event'          => $event,
            'auditable_type' => get_class($model),
            'auditable_id'   => $model->getKey(),
            'old_values'     => !empty($oldValues) ? $oldValues : null,
            'new_values'     => !empty($newValues) ? $newValues : null,
            'url'            => request()->fullUrl(),
            'ip_address'     => request()->ip(),
            'user_agent'     => request()->userAgent(),
        ]);
    }

    public function created(Model $model)
    {
        $this->logEvent($model, 'created');
    }

    public function updated(Model $model)
    {
        $this->logEvent($model, 'updated');
    }

    public function deleted(Model $model)
    {
        $this->logEvent($model, 'deleted');
    }
}

<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function getUpcoming($limit = 10)
    {
        return Event::upcoming()
            ->with('eventType')
            ->limit($limit)
            ->get();
    }

    public function getAll($perPage = 10)
    {
        return Event::with('eventType')
            ->orderBy('event_start', 'desc')
            ->paginate($perPage);
    }

    public function find($id)
    {
        return Event::with('eventType')->findOrFail($id);
    }

    public function store(array $data)
    {
        return Event::create($data);
    }

    public function update(Event $event, array $data)
    {
        $event->update($data);
        return $event;
    }

    public function delete(Event $event)
    {
        return $event->delete();
    }
}

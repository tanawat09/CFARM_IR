<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(protected EventService $eventService) {}

    public function index()
    {
        $events = $this->eventService->getAll(12);
        $upcoming = $this->eventService->getUpcoming(5);

        return view('public.events.index', compact('events', 'upcoming'));
    }

    public function show($id)
    {
        $event = $this->eventService->find($id);
        return view('public.events.show', compact('event'));
    }
}

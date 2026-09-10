<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $upcoming = Event::where('active', true)->where('start_at','>=',now())->orderBy('start_at')->paginate(9);
        return view('pages.events.index', compact('upcoming'));
    }

    public function show(Event $event)
    {
        abort_unless($event->active, 404);
        return view('pages.events.show', compact('event'));
    }
}

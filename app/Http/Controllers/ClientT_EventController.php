<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\T_Event;

class ClientT_EventController extends Controller
{
    public function index()
    {
        // Latest event is main event
        $mainEvent = T_Event::orderBy('event_date','desc')->first();

        // All other events are previous
        $previousEvents = T_Event::where('id','!=',$mainEvent->id ?? 0)
                                ->orderBy('event_date','desc')
                                ->paginate(4);

        return view('tourna_and_events', compact('mainEvent','previousEvents'));
    }
}

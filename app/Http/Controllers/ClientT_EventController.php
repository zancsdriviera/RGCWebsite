<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\T_Events;
use Carbon\Carbon;


class ClientT_EventController extends Controller
{

        public function index()
        {
            $today = Carbon::today();

            // Main Event (Upcoming or Today)
            $mainEvent = T_Events::whereDate('event_date', '>=', $today)
                                ->orderBy('event_date','asc')
                                ->first();

            // Previous Events (Already Finished)
            $previousEvents = T_Events::whereDate('event_date', '<', $today)
                                    ->orderBy('event_date','desc')
                                    ->paginate(4);

            return view('tourna_and_events', compact('mainEvent','previousEvents'));
        }
}

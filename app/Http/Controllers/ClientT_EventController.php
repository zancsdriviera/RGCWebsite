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

        $mainEvents = T_Events::whereDate('event_date', '>=', $today)
            ->orderBy('event_date', 'asc')
            ->get();

        $mainEventsGrouped = $mainEvents->groupBy('event_date');

        $previousEvents = T_Events::whereDate('event_date', '<', $today)
            ->orderBy('event_date', 'desc')
            ->get();

        return view('tourna_and_events', compact(
            'mainEvents',
            'mainEventsGrouped',
            'previousEvents'
        ));
    }
}
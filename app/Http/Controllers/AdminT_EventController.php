<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\T_Events;
use Carbon\Carbon; // <-- fixed import

class AdminT_EventController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // All events for admin, sorted by date descending, paginated
        $events = T_Events::orderBy('event_date', 'desc')->paginate(10);

        // Upcoming and previous events (optional, if you want to show in client page)
        $upcomingEvents = T_Events::whereDate('event_date', '>=', $today)
            ->orderBy('event_date', 'asc')
            ->get();

        $mainEventsGrouped = $upcomingEvents->groupBy(function($event) {
            return $event->event_date;
        });

        $previousEvents = T_Events::whereDate('event_date', '<', $today)
            ->orderBy('event_date', 'desc')
            ->get();

        return view('admin.admin_tevent', compact('events', 'mainEventsGrouped', 'previousEvents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'main_image' => 'nullable|image',
            'secondary_image' => 'nullable|image',
            'subtitles.*' => 'required',
            'texts.*' => 'required',
            'file1' => 'nullable|file',
            'file2' => 'nullable|file',
            'winners_image' => 'nullable|image',
        ]);

        $event = new T_Events();
        $event->title = $request->title;
        $event->event_date = $request->event_date;

        if ($request->hasFile('main_image')) {
            $event->main_image = $request->file('main_image')->store('t_events', 'public');
        }

        if ($request->hasFile('secondary_image')) {
            $event->secondary_image = $request->file('secondary_image')->store('t_events', 'public');
        }

        // Save subtitles and texts as JSON
        $subtitles_texts = [];
        if($request->subtitles && $request->texts){
            foreach($request->subtitles as $key => $subtitle){
                $subtitles_texts[] = [
                    'subtitle' => $subtitle,
                    'text' => $request->texts[$key]
                ];
            }
        }
        $event->subtitles_texts = json_encode($subtitles_texts);

        if ($request->hasFile('file1')) {
            $event->file1 = $request->file('file1')->store('t_events', 'public');
        }

        if ($request->hasFile('file2')) {
            $event->file2 = $request->file('file2')->store('t_events', 'public');
        }

        if ($request->hasFile('winners_image')) {
            $event->winners_image = $request->file('winners_image')->store('t_events', 'public');
        }

        $event->save();

        return redirect()->route('admin.tournaments.index')->with('success', 'Tournament added successfully.');
    }

    public function update(Request $request, T_Events $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'main_image' => 'nullable|image',
            'secondary_image' => 'nullable|image',
            'subtitles.*' => 'required',
            'texts.*' => 'required',
            'file1' => 'nullable|file',
            'file2' => 'nullable|file',
            'winners_image' => 'nullable|image',
        ]);

        $event->title = $request->title;
        $event->event_date = $request->event_date;

        if ($request->hasFile('main_image')) {
            $event->main_image = $request->file('main_image')->store('t_events', 'public');
        }

        if ($request->hasFile('secondary_image')) {
            $event->secondary_image = $request->file('secondary_image')->store('t_events', 'public');
        }

        if ($request->subtitles && $request->texts) {
            $subtitles_texts = [];
            foreach($request->subtitles as $key => $subtitle){
                $subtitles_texts[] = [
                    'subtitle' => $subtitle,
                    'text' => $request->texts[$key]
                ];
            }
            $event->subtitles_texts = json_encode($subtitles_texts);
        }

        if ($request->hasFile('file1')) {
            $event->file1 = $request->file('file1')->store('t_events', 'public');
        }

        if ($request->hasFile('file2')) {
            $event->file2 = $request->file('file2')->store('t_events', 'public');
        }

        if ($request->hasFile('winners_image')) {
            $event->winners_image = $request->file('winners_image')->store('t_events', 'public');
        }

        $event->save();

        return redirect()->route('admin.tournaments.index')->with('success', 'Tournament updated successfully.');
    }

    public function destroy(T_Events $event)
    {
        $event->delete();
        return redirect()->route('admin.tournaments.index')->with('success', 'Tournament deleted.');
    }
}
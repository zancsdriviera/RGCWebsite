<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseScheduleContent;
use Carbon\Carbon;

class CourseScheduleController extends Controller
{
    // Show calendar for a month (client view)
    public function index(Request $request)
    {
        // accept optional month/year query params, else current
        $year = $request->query('year', date('Y'));
        $month = $request->query('month', date('n')); // 1..12

        // ensure ints
        $year = (int) $year;
        $month = (int) $month;

        // startOfMonth Carbon instance
        $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();

        // fetch all schedules in that month (and future logic can filter by month only)
        $start = $startOfMonth->copy()->startOfMonth()->toDateString();
        $end = $startOfMonth->copy()->endOfMonth()->toDateString();

        $rows = CourseScheduleContent::whereBetween('date', [$start, $end])
                ->orderBy('date','asc')
                ->get();

        // build events keyed by date (YYYY-MM-DD) with Langer and Couples
        $events = [];
        foreach ($rows as $r) {
            $dateKey = $r->date->toDateString();
            $events[$dateKey] = [
                'Langer'   => ($r->langer_status === 'Others' ? ($r->langer_other ?: 'TBA') : ($r->langer_status ?: 'TBA')),
                'Couples'  => ($r->couples_status === 'Others' ? ($r->couples_other ?: 'TBA') : ($r->couples_status ?: 'TBA')),
            ];
        }

        return view('coursesched', compact('year','month','startOfMonth','events'));
    }
}

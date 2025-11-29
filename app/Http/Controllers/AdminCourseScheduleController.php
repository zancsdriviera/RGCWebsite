<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseScheduleContent;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AdminCourseScheduleController extends Controller
{
    // Display admin list, date-range filter, paginated (15)
    public function index(Request $request)
    {
        $query = CourseScheduleContent::orderBy('date', 'desc');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        } elseif ($request->start_date) {
            $query->where('date', '>=', $request->start_date);
        } elseif ($request->end_date) {
            $query->where('date', '<=', $request->end_date);
        }

        $events = $query->paginate(15)->withQueryString();

        return view('admin.admin_coursesched', compact('events'));
    }

    // Store multiple rows from dynamic modal
    public function store(Request $request)
    {
        $request->validate([
            'rows' => 'required|array|min:1',
            'rows.*.date' => 'required|date',
            'rows.*.langer_status' => ['required', Rule::in(['Open','Close','Tournament','Others'])],
            'rows.*.langer_other' => 'nullable|string',
            'rows.*.couples_status' => ['required', Rule::in(['Open','Close','Tournament','Others'])],
            'rows.*.couples_other' => 'nullable|string',
        ]);

        foreach ($request->rows as $row) {
            CourseScheduleContent::updateOrCreate(
                ['date' => $row['date']],
                [
                    'langer_status'  => $row['langer_status'],
                    'langer_other'   => $row['langer_status'] === 'Others' ? ($row['langer_other'] ?? null) : null,
                    'couples_status' => $row['couples_status'],
                    'couples_other'  => $row['couples_status'] === 'Others' ? ($row['couples_other'] ?? null) : null,
                ]
            );
        }

        return redirect()->route('admin.coursesched.index')->with('success', 'Course schedule added successfully!');
    }

    // Update single record
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => ['required','date', Rule::unique('course_schedules_contents','date')->ignore($id)],
            'langer_status' => ['required', Rule::in(['Open','Close','Tournament','Others'])],
            'langer_other' => 'nullable|string',
            'couples_status' => ['required', Rule::in(['Open','Close','Tournament','Others'])],
            'couples_other' => 'nullable|string',
        ]);

        $event = CourseScheduleContent::findOrFail($id);

        $event->update([
            'date' => $request->date,
            'langer_status' => $request->langer_status,
            'langer_other' => $request->langer_status === 'Others' ? $request->langer_other : null,
            'couples_status' => $request->couples_status,
            'couples_other' => $request->couples_status === 'Others' ? $request->couples_other : null,
        ]);

        return redirect()->route('admin.coursesched.index')->with('success', 'Course schedule updated successfully!');
    }

    // Destroy
    public function destroy($id)
    {
        CourseScheduleContent::destroy($id);
        return redirect()->route('admin.coursesched.index')->with('success', 'Course schedule deleted successfully!');
    }
}

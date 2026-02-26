<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\T_Events;
use Illuminate\Support\Facades\Storage;

class AdminT_EventController extends Controller
{
    public function index()
    {
        $events = T_Events::orderBy('event_date','desc')->paginate(5);
        return view('admin.admin_tevent', compact('events')); // <-- matches your file name
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'main_image' => 'nullable|image',
            'secondary_image' => 'nullable|image',
            'subtitles.*' => 'required|string',
            'texts.*' => 'required|string',
            'file1' => 'nullable|file',
            'file2' => 'nullable|file',
            'winners_image' => 'nullable|image',
        ]);

        // Handle file uploads
        if($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('events', 'public');
        }
        if($request->hasFile('secondary_image')) {
            $data['secondary_image'] = $request->file('secondary_image')->store('events', 'public');
        }
        if($request->hasFile('file1')) {
            $data['file1'] = $request->file('file1')->store('events', 'public');
        }
        if($request->hasFile('file2')) {
            $data['file2'] = $request->file('file2')->store('events', 'public');
        }
        if($request->hasFile('winners_image')) {
            $data['winners_image'] = $request->file('winners_image')->store('events','public');
        }

        // Combine subtitles and texts as JSON
        $subtitles_texts = [];
        if(isset($request->subtitles) && isset($request->texts)){
            foreach($request->subtitles as $i => $subtitle){
                $subtitles_texts[] = [
                    'subtitle' => $subtitle,
                    'text' => $request->texts[$i] ?? ''
                ];
            }
        }
        $data['subtitles_texts'] = json_encode($subtitles_texts);

        T_Events::create($data);

        return redirect()->back()->with('success','Tournament Event Added Successfully');
    }

    public function update(Request $request, T_Events $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'main_image' => 'nullable|image',
            'secondary_image' => 'nullable|image',
            'subtitles.*' => 'required|string',
            'texts.*' => 'required|string',
            'file1' => 'nullable|file',
            'file2' => 'nullable|file',
            'winners_image' => 'nullable|image',
        ]);

        // Update images if uploaded
        if($request->hasFile('main_image')) {
            if($event->main_image) Storage::disk('public')->delete($event->main_image);
            $data['main_image'] = $request->file('main_image')->store('events','public');
        }
        if($request->hasFile('secondary_image')) {
            if($event->secondary_image) Storage::disk('public')->delete($event->secondary_image);
            $data['secondary_image'] = $request->file('secondary_image')->store('events','public');
        }
        if($request->hasFile('file1')) {
            if($event->file1) Storage::disk('public')->delete($event->file1);
            $data['file1'] = $request->file('file1')->store('events','public');
        }
        if($request->hasFile('file2')) {
            if($event->file2) Storage::disk('public')->delete($event->file2);
            $data['file2'] = $request->file('file2')->store('events','public');
        }
        if($request->hasFile('winners_image')) {
            if($event->winners_image){
                Storage::disk('public')->delete($event->winners_image);
            }
            $data['winners_image'] = $request->file('winners_image')->store('events','public');
        }

        $subtitles_texts = [];
        if(isset($request->subtitles) && isset($request->texts)){
            foreach($request->subtitles as $i => $subtitle){
                $subtitles_texts[] = [
                    'subtitle' => $subtitle,
                    'text' => $request->texts[$i] ?? ''
                ];
            }
        }
        $data['subtitles_texts'] = json_encode($subtitles_texts);

        $event->update($data);

        return redirect()->back()->with('success','Tournament Event Updated Successfully');
    }

    public function destroy(T_Event $event)
    {
        // Delete files
        foreach(['main_image','secondary_image','file1','file2'] as $file){
            if($event->$file) Storage::disk('public')->delete($event->$file);
        }

        $event->delete();

        return redirect()->back()->with('success','Tournament Event Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\FaqContent;
use App\Models\IconContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = FaqContent::all();
        $icons = IconContent::all();
        return view('admin.admin_faq', compact('faqs', 'icons'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'faq_title' => 'required|string',
            'faq_image' => 'required|image',
            'faq_icon_class' => 'nullable|string',
        ]);

        if($request->hasFile('faq_image')){
            $file = $request->file('faq_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images/FAQ'), $filename);
            $data['faq_image'] = $filename;
        }

        FaqContent::create($data);
        return redirect()->back()->with('success','FAQ added successfully!');
    }

    public function edit(FaqContent $faq)
    {
        return response()->json($faq);
    }

    public function update(Request $request, FaqContent $faq)
    {
        $data = $request->validate([
            'faq_title' => 'required|string',
            'faq_image' => 'nullable|image',
            'faq_icon_class' => 'nullable|string',
        ]);

        if($request->hasFile('faq_image')){
            if($faq->faq_image && file_exists(public_path('images/FAQ/'.$faq->faq_image))){
                unlink(public_path('images/FAQ/'.$faq->faq_image));
            }
            $file = $request->file('faq_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images/FAQ'), $filename);
            $data['faq_image'] = $filename;
        }

        $faq->update($data);
        return redirect()->back()->with('success','FAQ updated successfully!');
    }

    public function destroy(FaqContent $faq)
    {
        if($faq->faq_image && file_exists(public_path('images/FAQ/'.$faq->faq_image))){
            unlink(public_path('images/FAQ/'.$faq->faq_image));
        }
        $faq->delete();
        return redirect()->back()->with('success','FAQ deleted successfully!');
    }
}

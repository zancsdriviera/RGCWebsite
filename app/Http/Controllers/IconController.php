<?php

namespace App\Http\Controllers;

use App\Models\IconContent;
use Illuminate\Http\Request;

class IconController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'class' => 'required|string',
        ]);

        IconContent::create($data);
        return redirect()->back()->with('success','Icon added successfully!');
    }
}

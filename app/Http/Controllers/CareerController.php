<?php

namespace App\Http\Controllers;

use App\Models\CareerContent;

class CareerController extends Controller
{
    public function index()
    {
        $careers = CareerContent::orderBy('created_at', 'desc')->get();
        return view('careers', compact('careers'));
    }
}

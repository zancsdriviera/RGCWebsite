<?php

namespace App\Http\Controllers;

use App\Models\AcgrContent;

class AcgrController extends Controller
{
    public function index()
    {
        $documents = AcgrContent::orderBy('year', 'desc')->get();

        return view('acgr', compact('documents'));
    }
}

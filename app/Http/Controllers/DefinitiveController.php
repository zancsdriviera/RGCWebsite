<?php

namespace App\Http\Controllers;

use App\Models\DefinitiveContent;

class DefinitiveController extends Controller
{
    public function index()
    {
        $documents = DefinitiveContent::orderBy('year', 'desc')->get();

        return view('definitive', compact('documents'));
    }
}


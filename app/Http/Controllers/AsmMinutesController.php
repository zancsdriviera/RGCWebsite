<?php

namespace App\Http\Controllers;

use App\Models\AsmMinutesContent;

class AsmMinutesController extends Controller
{
    public function index()
    {
        $documents = AsmMinutesContent::orderBy('year', 'desc')->get();

        return view('asm_minutes', compact('documents'));
    }
}

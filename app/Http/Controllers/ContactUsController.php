<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUsContent;

class ContactUsController extends Controller
{
    /**
     * Show contact us page (front-end).
     */
    public function index()
    {
        // main info (address + main contact number) — type = 'main'
        $mainInfo = ContactUsContent::where('type', 'main')->first();

        // departments (cards below) — type = 'department'
        $departments = ContactUsContent::where('type', 'department')->orderBy('id')->get();

        return view('contact_us', compact('mainInfo', 'departments'));
    }
}

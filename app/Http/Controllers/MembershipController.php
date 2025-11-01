<?php

namespace App\Http\Controllers;

use App\Models\MembershipContent;

class MembershipController extends Controller
{
    public function index()
    {
        $downloads = MembershipContent::where('type', 'download')->get();
        $applicants = MembershipContent::where('type', 'applicant')->get();
        $banks = MembershipContent::where('type', 'bank')->get();

        return view('membership', compact('downloads', 'applicants', 'banks'));
    }
}
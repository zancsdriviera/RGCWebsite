<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipContent;

class MembershipController extends Controller
{
    public function index()
    {
        $downloads = MembershipContent::where('type', 'download')->get();

        // Applicants are now single card images
        $members_data = MembershipContent::where('type', 'members_data')->get();

        $banks = MembershipContent::where('type', 'bank')->get();

        return view('membership', compact('downloads', 'members_data', 'banks'));
    }
}

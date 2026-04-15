<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gsection;

class CPRatesController extends Controller
{
    public function index()
    {
        $sections = Gsection::with([
            'gpeaks' => function ($q) {
                $q->orderBy('type') // title comes before golf_rate alphabetically
                  ->orderBy('sort_order');
            }
        ])->orderBy('order_number')->get();

        return view('rates2', compact('sections'));
    }
}
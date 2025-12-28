<?php

namespace App\Http\Controllers;

use App\Models\FaqContent;

class FaqController extends Controller
{
    public function show()
    {
        // Get Document items grouped by category
        $docItems = FaqContent::active()
            ->doc() // Changed from qa() to doc()
            ->orderBy('category')
            ->orderBy('created_at')
            ->get();
        
        // Group Documents by category dynamically
        $faqCategories = $docItems->groupBy('category');
        
        // Get QR feedback items
        $qrFaqs = FaqContent::active()
            ->qr()
            ->orderBy('created_at')
            ->get();
        
        return view('faq', compact('faqCategories', 'qrFaqs'));
    }
}
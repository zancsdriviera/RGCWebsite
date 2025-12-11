<?php

namespace App\Http\Controllers;

use App\Models\FaqContent;

class FaqController extends Controller
{
    public function show()
    {
        // Get all active FAQs
        $faqs = FaqContent::active()
            ->orderBy('category')
            ->orderBy('created_at')
            ->get();
        
        // Group by category dynamically
        $faqCategories = $faqs->groupBy('category');
        
        // QR codes data (keep your existing logic)
        $qrFaqs = []; // Replace with your actual QR code model if needed
        
        return view('faq', compact('faqCategories', 'qrFaqs'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\FaqContent;

class FaqController extends Controller
{
    public function show()
    {
        // Get Q&A items grouped by category
        $qaItems = FaqContent::active()
            ->qa()
            ->orderBy('category')
            ->orderBy('created_at')
            ->get();
        
        // Group Q&A by category dynamically
        $faqCategories = $qaItems->groupBy('category');
        
        // Get QR feedback items
        $qrFaqs = FaqContent::active()
            ->qr()
            ->orderBy('created_at')
            ->get();
        
        return view('faq', compact('faqCategories', 'qrFaqs'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\FaqContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFaqController extends Controller
{
    public function show()
    {
        $faqs = FaqContent::orderBy('type')
            ->orderBy('category')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $categories = FaqContent::getExistingCategories();
        
        return view('admin.admin_faq', compact('faqs', 'categories'));
    }

    public function create(Request $request)
{
    $type = $request->input('type', 'doc');
    $maxSize = $type === 'doc' ? 10240 : 3072; // 10MB for docs, 3MB for QR
    
    if ($type === 'doc') {
        $validated = $request->validate([
            'type' => 'required|in:doc,qr',
            'category' => 'required|string|max:100',
            'document_title' => 'required|string|max:255',
            'document_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ], [
            'document_file.max' => 'The document must not be greater than 10MB.',
            'document_file.mimes' => 'The document must be a PDF, DOC, or DOCX file.',
        ]);
    } else {
        $validated = $request->validate([
            'type' => 'required|in:doc,qr',
            'faq_title' => 'required|string|max:100',
            'faq_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
        ], [
            'faq_image.max' => 'The image must not be greater than 3MB.',
            'faq_image.image' => 'The image must be an image file.',
            'faq_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg, webp.',
        ]);
    }

    $faqImagePath = null;
    if ($type === 'qr' && $request->hasFile('faq_image')) {
        $imageFile = $request->file('faq_image');
        if ($imageFile->getSize() > 3145728) { // 3MB in bytes
            return back()->withErrors(['faq_image' => 'File size exceeds 3MB limit.'])->withInput();
        }
        
        $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
        Storage::disk('public')->put('FAQ/' . $imageName, file_get_contents($imageFile));
        $faqImagePath = $imageName;
    }

    $documentPath = null;
    if ($type === 'doc' && $request->hasFile('document_file')) {
        $documentFile = $request->file('document_file');
        if ($documentFile->getSize() > 10485760) { // 10MB in bytes
            return back()->withErrors(['document_file' => 'File size exceeds 10MB limit.'])->withInput();
        }
        
        $documentName = time() . '_' . uniqid() . '.' . $documentFile->getClientOriginalExtension();
        Storage::disk('public')->put('faqdocuments/' . $documentName, file_get_contents($documentFile));
        $documentPath = $documentName;
    }

    $data = [
        'type' => $type,
        'is_active' => $request->has('is_active')
    ];

    if ($type === 'doc') {
        $data = array_merge($data, [
            'category' => $validated['category'],
            'document_title' => $validated['document_title'],
            'document_file' => $documentPath,
            'faq_title' => null,
            'faq_image' => null,
        ]);
    } else {
        $data = array_merge($data, [
            'faq_title' => $validated['faq_title'],
            'faq_image' => $faqImagePath,
            'category' => 'QR Feedback',
            'document_title' => null,
            'document_file' => null,
        ]);
    }

    FaqContent::create($data);

    return back()->with('success', ucfirst($type) . ' item created successfully.');
}

    public function update(Request $request, $id)
    {
        $faq = FaqContent::findOrFail($id);
        $type = $faq->type;
        
        if ($type === 'doc') {
            $validated = $request->validate([
                'category' => 'required|string|max:100',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
                'document_title' => 'required|string|max:255',
                'document_link_text' => 'required|string|max:255',
                'document_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            ], [
                'icon.max' => 'The icon must not be greater than 3MB.',
                'icon.image' => 'The icon must be an image file.',
                'icon.mimes' => 'The icon must be a file of type: jpeg, png, jpg, gif, svg, webp.',
                'document_file.max' => 'The document must not be greater than 10MB.',
                'document_file.mimes' => 'The document must be a PDF, DOC, or DOCX file.',
            ]);
        } else {
            $validated = $request->validate([
                'faq_title' => 'required|string|max:100',
                'faq_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            ], [
                'faq_image.max' => 'The image must not be greater than 3MB.',
                'faq_image.image' => 'The image must be an image file.',
                'faq_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg, webp.',
            ]);
        }

        // Handle icon update (for Document)
        if ($type === 'doc' && $request->hasFile('icon')) {
            $iconFile = $request->file('icon');
            if ($iconFile->getSize() > 3145728) { // 3MB in bytes
                return back()->withErrors(['icon' => 'File size exceeds 3MB limit.'])->withInput();
            }
            
            if ($faq->icon) {
                Storage::disk('public')->delete('faqicons/' . $faq->icon);
            }
            
            $iconName = time() . '_' . uniqid() . '.' . $iconFile->getClientOriginalExtension();
            Storage::disk('public')->put('faqicons/' . $iconName, file_get_contents($iconFile));
            $iconPath = $iconName;
        } else {
            $iconPath = $faq->icon;
        }

        // Handle faq_image update (for QR)
        if ($type === 'qr' && $request->hasFile('faq_image')) {
            $imageFile = $request->file('faq_image');
            if ($imageFile->getSize() > 3145728) { // 3MB in bytes
                return back()->withErrors(['faq_image' => 'File size exceeds 3MB limit.'])->withInput();
            }
            
            if ($faq->faq_image) {
                Storage::disk('public')->delete('FAQ/' . $faq->faq_image);
            }
            
            $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            Storage::disk('public')->put('FAQ/' . $imageName, file_get_contents($imageFile));
            $faqImagePath = $imageName;
        } else {
            $faqImagePath = $faq->faq_image;
        }

        // Handle document file update (for Document)
        if ($type === 'doc' && $request->hasFile('document_file')) {
            $documentFile = $request->file('document_file');
            if ($documentFile->getSize() > 10485760) { // 10MB in bytes
                return back()->withErrors(['document_file' => 'File size exceeds 10MB limit.'])->withInput();
            }
            
            if ($faq->document_file) {
                Storage::disk('public')->delete('faqdocuments/' . $faq->document_file);
            }
            
            $documentName = time() . '_' . uniqid() . '.' . $documentFile->getClientOriginalExtension();
            Storage::disk('public')->put('faqdocuments/' . $documentName, file_get_contents($documentFile));
            $documentPath = $documentName;
        } else {
            $documentPath = $faq->document_file;
        }

        $data = [
            'is_active' => $request->has('is_active')
        ];

        if ($type === 'doc') {
            $data = array_merge($data, [
                'category' => $validated['category'],
                'icon' => $iconPath,
                'document_title' => $validated['document_title'],
                'document_link_text' => $validated['document_link_text'],
                'document_file' => $documentPath,
            ]);
        } else {
            $data = array_merge($data, [
                'faq_title' => $validated['faq_title'],
                'faq_image' => $faqImagePath,
            ]);
        }

        $faq->update($data);

        return back()->with('success', ucfirst($type) . ' item updated successfully.');
    }

    public function delete($id)
    {
        $faq = FaqContent::findOrFail($id);
        
        if ($faq->icon) {
            Storage::disk('public')->delete('faqicons/' . $faq->icon);
        }
        
        if ($faq->faq_image) {
            Storage::disk('public')->delete('FAQ/' . $faq->faq_image);
        }
        
        if ($faq->document_file) {
            Storage::disk('public')->delete('faqdocuments/' . $faq->document_file);
        }
        
        $faq->delete();
        
        return back()->with('success', 'Item deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $faq = FaqContent::findOrFail($id);
        $faq->update(['is_active' => !$faq->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $faq->is_active
        ]);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqContent extends Model
{
    protected $fillable = [
        'type', // 'doc' or 'qr'
        'category',
        'document_title',
        'document_link_text',
        'document_file',
        'faq_title', // For QR items
        'faq_image', // For QR items
        'icon', // For category icons
        'is_active'
        // REMOVED: 'question', 'answer'
    ];

    protected $attributes = [
        'type' => 'doc', // Default is now 'doc' instead of 'qa'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Get all unique categories for document type
    public static function getExistingCategories()
    {
        return self::where('type', 'doc')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->toArray();
    }

    // Get icon URL - returns uploaded icon or default
    public function getIconUrl()
    {
        if ($this->icon) {
            return asset('storage/faqicons/' . $this->icon);
        }
        return asset('images/default-faq-icon.png');
    }

    // Get document URL - NEW METHOD
    public function getDocumentUrl()
    {
        if ($this->document_file) {
            return asset('storage/faqdocuments/' . $this->document_file);
        }
        return null;
    }

    // Get image URL for QR items
    public function getFaqImageUrl()
    {
        if ($this->faq_image) {
            return asset('storage/FAQ/' . $this->faq_image);
        }
        return null;
    }

    // Scope for active FAQs
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for Document items - NEW SCOPE (replaces qa)
    public function scopeDoc($query)
    {
        return $query->where('type', 'doc');
    }

    // Scope for QR items
    public function scopeQr($query)
    {
        return $query->where('type', 'qr');
    }
    
    // Keep qa scope for backward compatibility during transition
    public function scopeQa($query)
    {
        return $query->where('type', 'doc'); // Map old qa to new doc
    }
}
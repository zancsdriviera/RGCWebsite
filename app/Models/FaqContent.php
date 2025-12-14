<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqContent extends Model
{
    protected $fillable = [
        'type', // 'qa' or 'qr'
        'category',
        'faq_title', // For QR items
        'faq_image', // For QR items
        // REMOVED: 'faq_icon_class',
        'icon', // For Q&A category icons
        'question',
        'answer',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Get all unique categories
    public static function getExistingCategories()
    {
        return self::where('type', 'qa')
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

    // Scope for Q&A items
    public function scopeQa($query)
    {
        return $query->where('type', 'qa');
    }

    // Scope for QR items
    public function scopeQr($query)
    {
        return $query->where('type', 'qr');
    }
}
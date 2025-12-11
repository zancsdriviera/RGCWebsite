<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqContent extends Model
{
    protected $fillable = [
        'category',
        'icon', // New field
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
        return self::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->toArray();
    }

    // Get icon URL - returns uploaded icon or default
    public function getIconUrl()
    {
        if ($this->icon) {
            return asset('storage/faq-icons/' . $this->icon);
        }
        return asset('images/default-faq-icon.png'); // Default icon
    }

    // Scope for active FAQs
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
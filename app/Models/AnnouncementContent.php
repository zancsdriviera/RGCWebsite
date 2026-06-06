<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'is_published',
        'published_date',
        'order'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_date' => 'date'
    ];

    public static function getPublished()
    {
        return self::where('is_published', true)
            ->orderBy('order')
            ->orderBy('published_date', 'desc')
            ->get();
    }

    public static function getBySlug($slug)
    {
        return self::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
    }
}
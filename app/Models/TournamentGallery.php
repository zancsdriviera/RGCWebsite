<?php

// TournamentGallery.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TournamentGallery extends Model
{
    protected $fillable = ['title', 'slug', 'event_date', 'thumbnail_path'];

    // Accessor for front-end usage
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path
            ? asset('storage/' . $this->thumbnail_path)
            : asset('images/COURSES/default-thumb.jpg');
    }

public function images()
{
    return $this->hasMany(GalleryImage::class, 'gallery_id');
}

}


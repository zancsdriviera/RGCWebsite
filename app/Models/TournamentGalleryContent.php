<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TournamentGalleryContent extends Model
{
    protected $fillable = ['title', 'slug', 'event_date', 'thumbnail_path'];

    protected $table = 'tournament_galleries_contents'; // ✅ check actual table name

    // Accessor for front-end usage
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path
            ? asset('storage/' . $this->thumbnail_path)
            : asset('images/COURSES/default-thumb.jpg');
    }

public function images()
{
    return $this->hasMany(GalleryImageContent::class, 'gallery_id');
}

}


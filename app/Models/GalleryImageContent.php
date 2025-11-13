<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImageContent extends Model
{
    use HasFactory;

    protected $table = 'gallery_images_contents'; // ✅ check actual table name

    protected $fillable = [
        'gallery_id',
        'path',
        'label',
        'sort_order',
    ];

    public function gallery()
    {
        return $this->belongsTo(TournamentGalleryContent::class, 'gallery_id');
    }
}

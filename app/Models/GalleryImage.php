<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $table = 'gallery_images'; // ✅ check actual table name

    protected $fillable = [
        'gallery_id',
        'path',
        'label',
        'sort_order',
    ];

    public function gallery()
    {
        return $this->belongsTo(TournamentGallery::class, 'gallery_id');
    }
}

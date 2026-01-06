<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsContent extends Model
{
    use HasFactory;

    protected $table = 'about_us_contents';

    protected $fillable = [
        'mission_title',
        'mission_text',
        'mission_image',
        'vision_title',
        'vision_text',
        'vision_image',
        'boards',
        'officers', // ADDED
        'board_year',
        // 'officers_year', // ADD if you want separate year
        'facilities_caption',
        'facilities_bullets',
        'facilities_image',
        'values',
    ];

    protected $casts = [
        'boards' => 'array',
        'officers' => 'array', // ADDED
        'facilities_bullets' => 'array',
        'values' => 'array',
    ];
}
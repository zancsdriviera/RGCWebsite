<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageContent extends Model
{
    protected $fillable = [
        'carousel1', 'carousel1Caption',
        'carousel2', 'carousel2Caption',
        'carousel3', 'carousel3Caption',
        'carousel4', 'carousel4Caption',
        'carousel5', 'carousel5Caption',
        'headline',
        'subheadline',
        'card1_image', 'card1_title',
        'card2_image', 'card2_title',
        'card3_image', 'card3_title',
        'map_embed',
        'dynamic_carousels', // new JSON field
    ];

    protected $casts = [
        'dynamic_carousels' => 'array', // automatically cast JSON to array
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrillContent extends Model
{
    protected $table = 'grill_contents';

    protected $fillable = [
        'carousel_images',
        'menu_items',
    ];

    protected $casts = [
        'carousel_images' => 'array',
        'menu_items' => 'array', // each item: ['name'=>'','price'=>'','image'=>'path.jpg']
    ];
}

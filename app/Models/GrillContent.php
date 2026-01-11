<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrillContent extends Model
{
    protected $table = 'grill_contents';

    protected $fillable = [
        'carousel_images',
        'menu_items',
        'menu_categories',
    ];

    protected $casts = [
        'carousel_images' => 'array',
        'menu_items' => 'array', // each item: ['name'=>'','price'=>'','image'=>'path.jpg', 'category_id'=>'1']
        'menu_categories' => 'array', // each category: ['id'=>1, 'name'=>'Appetizers', 'description'=>'Starters...']
    ];
}
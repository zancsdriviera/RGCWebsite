<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeehouseContent extends Model
{
    use HasFactory;

    protected $table = 'teehouse_contents';

    protected $fillable = [
        'lf9_images',
        'hwl_images',
        'cf9_images',
        'hwc_images',
        'teepav_images',
    ];

    protected $casts = [
        'lf9_images' => 'array',
        'hwl_images' => 'array',
        'cf9_images' => 'array',
        'hwc_images' => 'array',
        'teepav_images' => 'array',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Course extends Model
{
    protected $fillable = [
        'langer_Mtitle',
        'langer_Mimage',
        'couples_Mtitle',
        'couples_Mimage',
        'langer_title',
        'langer_description',
        'langer_images',
        'couples_title',
        'couples_description',
        'couples_images',
    ];

    protected $casts = [
        'langer_images' => 'array',
        'couples_images' => 'array',
    ];
}

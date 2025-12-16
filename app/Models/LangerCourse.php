<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LangerCourse extends Model
{
    protected $table = 'langer_courses';
    
    protected $fillable = [
        'title',
        'description',
        'image1',
        'image2', 
        'image3',
        'image4',
        'image5',
        'image6'
    ];
}
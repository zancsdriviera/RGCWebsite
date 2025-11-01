<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouplesCourse extends Model
{
    // If your table name is different, adjust this:
    protected $table = 'players_couples';

    protected $fillable = [
        'title',
        'description',
        'image_path' // path to image if you store it
    ];

    public $timestamps = false;
}

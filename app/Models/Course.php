<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'langer_Mtitle',
        'langer_Mimage',
        'couples_Mtitle',
        'couples_Mimage',
    ];
}

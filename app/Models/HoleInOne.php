<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoleInOne extends Model
{
    protected $table = 'hole_in_one';

    protected $fillable = [
        'category',
        'first_name',
        'last_name',
        'hole_number',
        'date',
    ];

    protected $casts = [
        'hole_number' => 'integer',
        'date' => 'date',
    ];
}

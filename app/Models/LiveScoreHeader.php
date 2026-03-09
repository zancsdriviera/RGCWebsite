<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveScoreHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'status', // 1=active, 0=inactive
    ];
}
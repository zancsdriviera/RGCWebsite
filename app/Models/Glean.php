<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Glean extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title1', 'total1', 'body1', 'price1', 'sched1',
        'title2', 'paragraph2', 'total2', 'body2', 'price2', 'sched2',
        'title3', 'paragraph3', 'body3', 'price3',
    ];
}
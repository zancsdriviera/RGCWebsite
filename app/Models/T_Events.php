<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Events extends Model
{
    use HasFactory;

    protected $table = 't_events';

    protected $fillable = [
        'title',
        'event_date',
        'main_image',
        'secondary_image',
        'winners_image',   // ADD THIS
        'subtitles_texts',
        'paragraph',
        'file1',
        'file2'
    ];
}

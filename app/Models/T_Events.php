<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class T_Events extends Model
{
    use HasFactory;

    // Set the correct table name
    protected $table = 't_events'; // ✅ match your actual table name

    protected $fillable = [
        'title', 
        'event_date', 
        'main_image', 
        'secondary_image', 
        'subtitles_texts', 
        'file1', 
        'file2', 
        'winners_image'
    ];

    // Scope for upcoming events
    public function scopeUpcoming($query) {
        return $query->whereDate('event_date', '>=', now()->format('Y-m-d'));
    }

    public function scopePrevious($query) {
        return $query->whereDate('event_date', '<', now()->format('Y-m-d'));
    }
}
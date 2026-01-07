<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AsmMinutesContent extends Model
{
    protected $fillable = [
        'meeting_date',
        'file_path'
    ];

    protected $casts = [
        'meeting_date' => 'date'
    ];

    // Accessor for formatted date
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->meeting_date)->format('F j, Y');
    }

    // Accessor for year only (backward compatibility if needed)
    public function getYearAttribute()
    {
        return Carbon::parse($this->meeting_date)->year;
    }
}
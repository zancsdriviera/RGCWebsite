<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseScheduleContent extends Model
{
    protected $table = 'course_schedules_contents';

    protected $fillable = [
        'date',
        'langer_status',
        'langer_other',
        'couples_status',
        'couples_other',
    ];

    protected $casts = [
        'date' => 'date',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LockerRoomContent extends Model
{
    protected $table = 'locker_contents';

    protected $fillable = [
        'description',
        'image_path',
    ];
}

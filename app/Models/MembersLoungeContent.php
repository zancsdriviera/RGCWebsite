<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembersLoungeContent extends Model
{
    protected $table = 'memberslounge_contents';

    protected $fillable = [
        'description',
        'image_path',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUsContent extends Model
{
    protected $table = 'contact_us_contents';

    protected $fillable = [
        'type',       // 'main' or 'department'
        'address',    // main row
        'main_phone', // main row
        'title',      // department name
        'phone',      // department phone
        'email',      // department email
        'sort_order',
    ];
}

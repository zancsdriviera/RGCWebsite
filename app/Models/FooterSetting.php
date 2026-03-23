<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_path',
        'phone_number',
        'location_url',
        'address',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'copyright_text',
        'club_name'
    ];

    // Get the active footer settings (assuming only one record)
    public static function getActive()
    {
        return self::first();
    }
}
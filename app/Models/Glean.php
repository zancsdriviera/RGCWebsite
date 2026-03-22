<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Glean extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'setting_key',
        'setting_value',
        'title1', 'total1', 'body1', 'price1', 'sched1',
        'title2', 'paragraph2', 'total2', 'body2', 'price2', 'sched2',
        'title3', 'paragraph3', 'body3', 'price3',
    ];

    // Helper method to get setting value
    public static function getSetting($key, $default = null)
    {
        $setting = self::where('type', 'setting')
                       ->where('setting_key', $key)
                       ->first();
        
        return $setting ? $setting->setting_value : $default;
    }

    // Helper method to update or create setting
    public static function setSetting($key, $value)
    {
        return self::updateOrCreate(
            ['type' => 'setting', 'setting_key' => $key],
            ['setting_value' => $value]
        );
    }
}
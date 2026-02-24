<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'langer_Mtitle',
        'langer_Mimage',
        'langer_title',
        'langer_description',
        'langer_images',
        'couples_Mtitle',
        'couples_Mimage',
        'couples_title',
        'couples_description',
        'couples_images',
    ];

    protected $casts = [
        'langer_images' => 'array',
        'couples_images' => 'array',
    ];

    /**
     * Get the hole details for a specific image in couples course
     */
    public function getCouplesHoleDetails($index)
    {
        $images = $this->couples_images ?? [];
        if (isset($images[$index])) {
            return [
                'hole' => $images[$index]['hole'] ?? 1,
                'par' => $images[$index]['par'] ?? 4,
                'gold' => $images[$index]['gold'] ?? 0,
                'blue' => $images[$index]['blue'] ?? 0,
                'white' => $images[$index]['white'] ?? 0,
                'red' => $images[$index]['red'] ?? 0,
            ];
        }
        return null;
    }
}
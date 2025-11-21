<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IconContent extends Model
{
    use HasFactory;

    protected $table = 'icons_contents';

    protected $fillable = [
        'name',       // Display name of the icon, e.g., "Facebook"
        'class',      // Class for the icon, e.g., "bi bi-facebook"
    ];
}

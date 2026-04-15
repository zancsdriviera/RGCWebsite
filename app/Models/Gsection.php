<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gsection extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
    ];

    public function gpeaks()
    {
        return $this->hasMany(Gpeak::class, 'gsection_id');
    }
}
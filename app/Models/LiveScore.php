<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'team',
        'couples_grs',
        'langer_grs',
        'couples_net',
        'langer_net',
        'total_grs',
        'total_net',
        'class',
    ];

    // Auto calculate totals on save
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_grs = $model->couples_grs + $model->langer_grs;
            $model->total_net = $model->couples_net + $model->langer_net;
        });
    }
}
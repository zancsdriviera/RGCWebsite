<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpeak extends Model
{
    use HasFactory;

    protected $fillable = [
        'gsection_id',
        'type',
        'sort_order',
        'title',
        'description',
        'gr_title',
        'gr_title_description',
        'gr_total',
        'gr_content',
        'gr_content_price',
        'gr_schedule',
        'gr_description',
    ];

    public function section()
    {
        return $this->belongsTo(Gsection::class, 'gsection_id');
    }

    public function getTypeLabelAttribute()
    {
        return match ($this->type) {
            'title'     => 'Title',
            'golf_rate' => 'Golf Rates',
            default     => ucfirst($this->type),
        };
    }

    public function getDisplayTitleAttribute()
    {
        return $this->type === 'title' ? $this->title : $this->gr_title;
    }
}

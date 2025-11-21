<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqContent extends Model
{
    use HasFactory;

    protected $table = 'faqs_contents';

    protected $fillable = [
        'faq_title',
        'faq_image',
        'faq_icon_class'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipContent extends Model
{
    protected $fillable = [
        'type',       // 'download', 'applicant', 'bank'
        'title',      // for downloads (optional for bank)
        'file_path',  // PDF for downloads or card image for applicant
        'top_image',  // for bank
        'qr_image',   // for bank
    ];
}

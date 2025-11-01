<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipContent extends Model
{
    protected $fillable = [
        'type',       // e.g., 'download', 'applicant', 'bank'
        'title',      // for downloads or banks
        'file_path',  // for download PDF
        'name',       // for applicant
        'company',    // for applicant
        'position',   // for applicant
        'age',        // for applicant
        'avatar',     // for applicant
        'top_image',  // for bank
        'qr_image',   // for bank
    ];
}
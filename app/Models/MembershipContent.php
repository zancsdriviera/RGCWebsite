<?php
// app/Models/MembershipContent.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipContent extends Model
{
    use HasFactory; // This is correct here - in the Model, not Controller

    protected $table = 'membership_contents'; // Specify if your table name is different

    protected $fillable = [
        'type',
        'title',
        'file_path',
        'top_image',
        'qr_image',
        'original_filename'
    ];
}
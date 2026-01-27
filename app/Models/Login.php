<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'login'; // Should be 'login'
    protected $fillable = ['email', 'password', 'two_factor_code', 'two_factor_expires_at'];
    
    // Add timestamps if your table has them
    public $timestamps = true;
}


// rgci_admin@rivieragolfclub
// P0sitive@2025

// it@rivieragolfclub
// Csdadmin@2k25

// zancsdriviera@gmail.com
// P0sitive@2025
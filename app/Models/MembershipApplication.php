<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipApplication extends Model
{
    protected $fillable = [
        'family_name','given_name','middle_name',
        'address','billing_address',
        'cell_no','email','tel_no',
        'date_of_birth','place_of_birth',
        'nationality','civil_status','sex',
        'passport_id_no','tin',
        'college_university','degree_obtained','photo_2x2',
        'company_name','job_title','company_address',
        'type_of_business','business_tel_no','business_fax_no',
        'spouse_name','spouse_dob','spouse_place_of_birth',
        'spouse_nationality','spouse_company_name','spouse_job_title',
        'spouse_company_address','spouse_type_of_business',
        'spouse_business_tel_no','spouse_business_fax_no',
        'spouse_membership_card','children',
        'other_golf_clubs','class_of_membership',
        'membership_type','transfer_of_share_cert','preferred_billing_address',
    ];

    protected $casts = [
        'children'         => 'array',
        'other_golf_clubs' => 'array',
        'membership_type'  => 'array',
        'date_of_birth'    => 'date',
        'spouse_dob'       => 'date',
    ];
}
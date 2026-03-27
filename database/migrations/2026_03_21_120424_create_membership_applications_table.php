<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('membership_applications', function (Blueprint $table) {
            $table->id();

            // Personal Information
            $table->string('family_name');
            $table->string('given_name');
            $table->string('middle_name')->nullable();
            $table->text('address');
            $table->text('billing_address')->nullable();
            $table->string('cell_no');
            $table->string('email');
            $table->string('tel_no')->nullable();
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('nationality');
            $table->string('civil_status');
            $table->string('sex');
            $table->string('passport_id_no')->nullable();
            $table->string('tin')->nullable();
            $table->string('college_university')->nullable();
            $table->string('degree_obtained')->nullable();
            $table->string('photo_2x2')->nullable();

            // Employment
            $table->string('company_name')->nullable();
            $table->string('job_title')->nullable();
            $table->text('company_address')->nullable();
            $table->string('type_of_business')->nullable();
            $table->string('business_tel_no')->nullable();
            $table->string('business_fax_no')->nullable();

            // Family – Spouse
            $table->string('spouse_name')->nullable();
            $table->date('spouse_dob')->nullable();
            $table->string('spouse_place_of_birth')->nullable();
            $table->string('spouse_nationality')->nullable();
            $table->string('spouse_company_name')->nullable();
            $table->string('spouse_job_title')->nullable();
            $table->text('spouse_company_address')->nullable();
            $table->string('spouse_type_of_business')->nullable();
            $table->string('spouse_business_tel_no')->nullable();
            $table->string('spouse_business_fax_no')->nullable();
            $table->string('spouse_membership_card')->nullable();
            $table->json('children')->nullable();

            // Golf / Membership
            $table->json('other_golf_clubs')->nullable();
            $table->string('class_of_membership')->nullable();
            $table->json('membership_type')->nullable();
            $table->string('transfer_of_share_cert')->nullable();
            $table->string('preferred_billing_address')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_applications');
    }
};
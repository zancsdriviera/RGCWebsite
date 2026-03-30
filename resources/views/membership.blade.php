@extends('layouts.app')
@section('title', 'Membership')

@push('styles')
    <link href="{{ asset('css/membership.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/RivieraHeaderLogo3.png') }}">
@endpush

@section('content')

    {{-- ── Validation errors — visible at top regardless of accordion state ── --}}

    {{-- ── Hero Banner ─────────────────────────────────────────────────────── --}}
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">MEMBERSHIP</h1>
    </div>

    {{-- ── Download Section ────────────────────────────────────────────────── --}}
    <div class="top_caption my-0 text-center">
        <h2 class="top-title">CLICK TO DOWNLOAD THE PDF</h2>
    </div>

    <div class="bullet_container my-4">
        <div
            class="d-flex flex-column flex-md-row justify-content-center align-items-md-center align-items-start gap-4 gap-md-5">
            @php
                $downloadsCount = $downloads->count();
                $chunkedDownloads = $downloads->chunk(max(1, ceil($downloadsCount / 2)));
            @endphp

            {{-- Desktop --}}
            <div class="d-none d-md-flex flex-md-row justify-content-center align-items-center gap-5 w-100">
                @foreach ($chunkedDownloads as $group)
                    <ul class="list-unstyled text-start m-0 download-column">
                        @foreach ($group as $item)
                            <li class="download-item">
                                <i class="bi bi-file-earmark-arrow-down me-2 text-success"></i>
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">{{ $item->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>

            {{-- Mobile --}}
            <div class="d-flex d-md-none flex-row flex-wrap justify-content-center align-items-start gap-3 w-100">
                @php
                    $mc = min(4, max(2, ceil($downloadsCount / 4)));
                    $mobileChunks = $downloads->chunk(max(1, ceil($downloadsCount / $mc)));
                @endphp
                @foreach ($mobileChunks as $group)
                    <ul class="list-unstyled text-start m-0 download-column-mobile">
                        @foreach ($group as $item)
                            <li class="download-item-mobile">
                                <i class="bi bi-file-earmark-arrow-down me-1"></i>
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">{{ $item->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════════════════
     MEMBERSHIP APPLICATION ACCORDION
══════════════════════════════════════════════════════════════════════ --}}
    <div class="application-accordion-wrapper">
        <div class="application-accordion" id="applicationAccordion">

            <button class="accordion-trigger" id="accordionToggleBtn" type="button" aria-expanded="false">
                <span class="accordion-label">
                    <i class="bi bi-person-plus-fill me-2" style="color:var(--rgc-dark);"></i>
                    Membership Application Form
                </span>
                <span class="accordion-icon" id="accordionIcon">+</span>
            </button>

            <div class="accordion-body-panel" id="accordionPanel" style="display:none;">
                <div class="accordion-form-inner">

                    @if ($errors->any())
                        <div class="alert alert-danger mb-4 rounded-0 border-start border-danger border-4">
                            <strong class="d-block mb-1"><i class="bi bi-exclamation-circle me-2"></i>Please fix the
                                following:</strong>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Step Indicators --}}
                    <div class="step-indicators">
                        <div class="step-item active" data-step="1">
                            <div class="step-circle">1</div>
                            <span class="step-label">Personal</span>
                        </div>
                        <div class="step-divider"></div>
                        <div class="step-item" data-step="2">
                            <div class="step-circle">2</div>
                            <span class="step-label">Employment</span>
                        </div>
                        <div class="step-divider"></div>
                        <div class="step-item" data-step="3">
                            <div class="step-circle">3</div>
                            <span class="step-label">Membership</span>
                        </div>
                    </div>

                    <form action="{{ route('membership.application.store') }}" method="POST" enctype="multipart/form-data"
                        id="membershipAppForm" novalidate>
                        @csrf
                        <input type="hidden" name="submission_token" value="{{ uniqid('sub_', true) }}">

                        {{-- ══════════════════════════════════════
                         STEP 1 — PERSONAL INFORMATION
                    ══════════════════════════════════════ --}}
                        <div class="form-step" id="step1">

                            <div class="form-section-header">
                                <h4>Personal Information</h4>
                            </div>

                            {{-- Full Name --}}
                            <div class="form-group-block">
                                <label class="field-label">Full Name <span class="req">*</span></label>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <input type="text" name="family_name" class="app-input" placeholder="Family Name"
                                            value="{{ old('family_name') }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="given_name" class="app-input" placeholder="Given Name"
                                            value="{{ old('given_name') }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="middle_name" class="app-input" placeholder="Middle Name"
                                            value="{{ old('middle_name') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Address --}}
                            <div class="form-group-block">
                                <label class="field-label">Address <span class="req">*</span></label>
                                <input type="text" name="address" class="app-input" placeholder="Complete home address"
                                    value="{{ old('address') }}" required>
                            </div>

                            {{-- Billing Address --}}
                            <div class="form-group-block">
                                <label class="field-label">Billing (Local Address)</label>
                                <input type="text" name="billing_address" class="app-input"
                                    placeholder="Billing or local address" value="{{ old('billing_address') }}">
                            </div>

                            {{-- Contact info --}}
                            <div class="form-group-block">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label">Cell No. <span class="req">*</span></label>
                                        <input type="text" name="cell_no" class="app-input"
                                            placeholder="e.g. 09XX XXX XXXX" value="{{ old('cell_no') }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label">Email <span class="req">*</span></label>
                                        <input type="email" name="email" class="app-input"
                                            placeholder="yourname@email.com" value="{{ old('email') }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label">Tel No.</label>
                                        <input type="text" name="tel_no" class="app-input"
                                            placeholder="Telephone number" value="{{ old('tel_no') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- DOB + POB --}}
                            <div class="form-group-block">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="field-label">Date of Birth <span class="req">*</span></label>
                                        <input type="date" name="date_of_birth" class="app-input"
                                            value="{{ old('date_of_birth') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">Place of Birth <span class="req">*</span></label>
                                        <input type="text" name="place_of_birth" class="app-input"
                                            placeholder="City, Province, Country" value="{{ old('place_of_birth') }}"
                                            required>
                                    </div>
                                </div>
                            </div>

                            {{-- Nationality + Civil Status --}}
                            <div class="form-group-block">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="field-label">Nationality <span class="req">*</span></label>
                                        <select name="nationality" class="app-select" required>
                                            <option value="">Select Nationality</option>
                                            @foreach (['Filipino', 'American', 'Japanese', 'Korean', 'Chinese', 'British', 'Australian', 'Canadian', 'Singaporean', 'Other'] as $nat)
                                                <option value="{{ $nat }}"
                                                    {{ old('nationality') == $nat ? 'selected' : '' }}>{{ $nat }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">Civil Status <span class="req">*</span></label>
                                        <select name="civil_status" class="app-select" required>
                                            <option value="">Select Civil Status</option>
                                            @foreach (['Single', 'Married', 'Widowed', 'Divorced', 'Separated'] as $cs)
                                                <option value="{{ $cs }}"
                                                    {{ old('civil_status') == $cs ? 'selected' : '' }}>{{ $cs }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Sex --}}
                            <div class="form-group-block">
                                <label class="field-label">Sex <span class="req">*</span></label>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="sex" value="Male"
                                            {{ old('sex', 'Male') == 'Male' ? 'checked' : '' }} required> Male
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="sex" value="Female"
                                            {{ old('sex') == 'Female' ? 'checked' : '' }}> Female
                                    </label>
                                </div>
                            </div>

                            {{-- Passport + TIN --}}
                            <div class="form-group-block">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="field-label">Passport / Identity Card No.</label>
                                        <input type="text" name="passport_id_no" class="app-input"
                                            placeholder="Passport or ID number" value="{{ old('passport_id_no') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">TIN</label>
                                        <input type="text" name="tin" class="app-input"
                                            placeholder="Tax Identification Number" value="{{ old('tin') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Education --}}
                            <div class="form-group-block">
                                <label class="field-label">College / Universities Attended</label>
                                <input type="text" name="college_university" class="app-input"
                                    placeholder="University or college name" value="{{ old('college_university') }}">
                            </div>

                            <div class="form-group-block">
                                <label class="field-label">Degree Obtained</label>
                                <input type="text" name="degree_obtained" class="app-input"
                                    placeholder="e.g. Bachelor of Science in Business Administration"
                                    value="{{ old('degree_obtained') }}">
                            </div>

                            {{-- 2x2 Photo --}}
                            <div class="form-group-block">
                                <label class="field-label">Upload Image (2x2)</label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="photo-upload-area" id="photoUploadArea" title="Click to upload photo">
                                        <input type="file" name="photo_2x2" id="photo2x2Input"
                                            accept="image/jpg,image/jpeg,image/png" class="d-none">
                                        {{-- Preserve photo across validation --}}
                                        <input type="hidden" name="photo_2x2_b64" id="photo2x2Compressed"
                                            value="{{ old('photo_2x2_b64') }}">
                                        <div id="photoPlaceholder"
                                            class="photo-placeholder {{ old('photo_2x2_b64') ? 'd-none' : '' }}">
                                            <i class="bi bi-person-bounding-box fs-2 text-muted d-block mb-1"></i>
                                            <small class="text-muted">Click to upload</small>
                                        </div>
                                        <img id="photoPreview" src="{{ old('photo_2x2_b64') ?: '#' }}" alt="Preview"
                                            class="photo-preview {{ old('photo_2x2_b64') ? '' : 'd-none' }}">
                                    </div>
                                    <div>
                                        <p class="mb-1 small text-muted">Accepted: JPG, PNG</p>
                                        <p class="mb-0 small text-muted">Max size: 2MB</p>
                                    </div>
                                </div>
                            </div>

                            <div class="step-nav justify-content-end">
                                <button type="button" class="btn-step btn-step-next" onclick="goToStep(2)">
                                    Next <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>{{-- /step1 --}}

                        {{-- ══════════════════════════════════════
                         STEP 2 — EMPLOYMENT + FAMILY
                    ══════════════════════════════════════ --}}
                        <div class="form-step d-none" id="step2">

                            {{-- Employment --}}
                            <div class="form-section-header">
                                <h4>Employment / Business Information</h4>
                            </div>

                            <div class="form-group-block">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="field-label">Company Name <span class="req">*</span></label>
                                        <input type="text" name="company_name" class="app-input"
                                            placeholder="Name of company or business" value="{{ old('company_name') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label">Job Title <span class="req">*</span></label>
                                        <input type="text" name="job_title" class="app-input"
                                            placeholder="Your position" value="{{ old('job_title') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-block">
                                <label class="field-label">Company Address <span class="req">*</span></label>
                                <input type="text" name="company_address" class="app-input"
                                    placeholder="Complete company address" value="{{ old('company_address') }}">
                            </div>

                            <div class="form-group-block">
                                <label class="field-label">Type of Business <span class="req">*</span></label>
                                <input type="text" name="type_of_business" class="app-input"
                                    placeholder="e.g. Real Estate, Manufacturing, etc."
                                    value="{{ old('type_of_business') }}">
                            </div>

                            <div class="form-group-block">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="field-label">Business Tel. No. <span class="req">*</span></label>
                                        <input type="text" name="business_tel_no" class="app-input"
                                            placeholder="Business telephone" value="{{ old('business_tel_no') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">Business Fax No.</label>
                                        <input type="text" name="business_fax_no" class="app-input"
                                            placeholder="Business fax" value="{{ old('business_fax_no') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Family --}}
                            <div class="form-section-header mt-4">
                                <h4>Family Information</h4>
                                <small>All fields in this section are optional</small>
                            </div>

                            <div class="form-group-block">
                                <label class="field-label">Spouse Name</label>
                                <input type="text" name="spouse_name" class="app-input"
                                    placeholder="Full name of spouse" value="{{ old('spouse_name') }}">
                            </div>

                            <div class="form-group-block">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="field-label">Date of Birth</label>
                                        <input type="date" name="spouse_dob" class="app-input"
                                            value="{{ old('spouse_dob') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label">Place of Birth</label>
                                        <input type="text" name="spouse_place_of_birth" class="app-input"
                                            placeholder="City / Province" value="{{ old('spouse_place_of_birth') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label">Nationality</label>
                                        <select name="spouse_nationality" class="app-select">
                                            <option value="">Select</option>
                                            @foreach (['Filipino', 'American', 'Japanese', 'Korean', 'Chinese', 'British', 'Australian', 'Canadian', 'Singaporean', 'Other'] as $nat)
                                                <option value="{{ $nat }}"
                                                    {{ old('spouse_nationality') == $nat ? 'selected' : '' }}>
                                                    {{ $nat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-block">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="field-label">Company Name</label>
                                        <input type="text" name="spouse_company_name" class="app-input"
                                            value="{{ old('spouse_company_name') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="field-label">Job Title</label>
                                        <input type="text" name="spouse_job_title" class="app-input"
                                            value="{{ old('spouse_job_title') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-block">
                                <label class="field-label">Company Address</label>
                                <input type="text" name="spouse_company_address" class="app-input"
                                    value="{{ old('spouse_company_address') }}">
                            </div>

                            <div class="form-group-block">
                                <label class="field-label">Type of Business</label>
                                <input type="text" name="spouse_type_of_business" class="app-input"
                                    value="{{ old('spouse_type_of_business') }}">
                            </div>

                            <div class="form-group-block">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="field-label">Business Tel. No.</label>
                                        <input type="text" name="spouse_business_tel_no" class="app-input"
                                            value="{{ old('spouse_business_tel_no') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label">Business Fax No.</label>
                                        <input type="text" name="spouse_business_fax_no" class="app-input"
                                            value="{{ old('spouse_business_fax_no') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-block">
                                <label class="field-label">Spouse to receive a Membership Card</label>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="spouse_membership_card" value="Yes"
                                            {{ old('spouse_membership_card', 'Yes') == 'Yes' ? 'checked' : '' }}> Yes
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="spouse_membership_card" value="No"
                                            {{ old('spouse_membership_card') == 'No' ? 'checked' : '' }}> No
                                    </label>
                                </div>
                            </div>

                            {{-- Children Table --}}
                            <div class="form-group-block">
                                <label class="field-label">Children</label>
                                <div class="dynamic-table-wrapper">
                                    <table class="dynamic-table">
                                        <thead>
                                            <tr>
                                                <th>Name of Children</th>
                                                <th>Date of Birth</th>
                                                <th>Sex</th>
                                                <th>Membership Card</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="childrenBody">
                                            @php $oldChildren = old('children', [['name'=>'','dob'=>'','sex'=>'','membership_card'=>'']]); @endphp
                                            @foreach ($oldChildren as $ci => $child)
                                                <tr>
                                                    <td><input type="text" name="children[{{ $ci }}][name]"
                                                            class="app-input app-input-sm" placeholder="Child's name"
                                                            value="{{ $child['name'] ?? '' }}"></td>
                                                    <td><input type="date" name="children[{{ $ci }}][dob]"
                                                            class="app-input app-input-sm"
                                                            value="{{ $child['dob'] ?? '' }}"></td>
                                                    <td>
                                                        <div class="radio-group" style="gap:10px;">
                                                            <label class="radio-label"><input type="radio"
                                                                    name="children[{{ $ci }}][sex]"
                                                                    value="Male"
                                                                    {{ ($child['sex'] ?? '') == 'Male' ? 'checked' : '' }}>
                                                                M</label>
                                                            <label class="radio-label"><input type="radio"
                                                                    name="children[{{ $ci }}][sex]"
                                                                    value="Female"
                                                                    {{ ($child['sex'] ?? '') == 'Female' ? 'checked' : '' }}>
                                                                F</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="radio-group" style="gap:10px;">
                                                            <label class="radio-label"><input type="radio"
                                                                    name="children[{{ $ci }}][membership_card]"
                                                                    value="Yes"
                                                                    {{ ($child['membership_card'] ?? '') == 'Yes' ? 'checked' : '' }}>
                                                                Y</label>
                                                            <label class="radio-label"><input type="radio"
                                                                    name="children[{{ $ci }}][membership_card]"
                                                                    value="No"
                                                                    {{ ($child['membership_card'] ?? '') == 'No' ? 'checked' : '' }}>
                                                                N</label>
                                                        </div>
                                                    </td>
                                                    <td><button type="button"
                                                            class="btn-table-action {{ $ci === 0 ? 'btn-add-child' : 'btn-delete-row' }}">{{ $ci === 0 ? 'Add' : 'Delete' }}</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="step-nav justify-content-between">
                                <button type="button" class="btn-step btn-step-back" onclick="goToStep(1)">
                                    <i class="bi bi-arrow-left"></i> Back
                                </button>
                                <button type="button" class="btn-step btn-step-next" onclick="goToStep(3)">
                                    Next <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>{{-- /step2 --}}

                        {{-- ══════════════════════════════════════
                         STEP 3 — GOLF / MEMBERSHIP
                    ══════════════════════════════════════ --}}
                        <div class="form-step d-none" id="step3">

                            <div class="form-section-header">
                                <h4>Golf / Membership Information</h4>
                            </div>

                            {{-- Golf Clubs Table --}}
                            <div class="form-group-block">
                                <label class="field-label">Membership in other Golf / Sport Clubs</label>
                                <div class="dynamic-table-wrapper">
                                    <table class="dynamic-table">
                                        <thead>
                                            <tr>
                                                <th style="width:60%;">Club Name</th>
                                                <th style="width:30%;">Handicap</th>
                                                <th style="width:10%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="golfBody">
                                            @php $oldGolf = old('other_golf_clubs', [['club'=>'','handicap'=>'']]); @endphp
                                            @foreach ($oldGolf as $gi => $golf)
                                                <tr>
                                                    <td><input type="text"
                                                            name="other_golf_clubs[{{ $gi }}][club]"
                                                            class="app-input app-input-sm"
                                                            placeholder="Golf or sport club name"
                                                            value="{{ $golf['club'] ?? '' }}"></td>
                                                    <td><input type="text"
                                                            name="other_golf_clubs[{{ $gi }}][handicap]"
                                                            class="app-input app-input-sm" placeholder="Handicap"
                                                            value="{{ $golf['handicap'] ?? '' }}"></td>
                                                    <td><button type="button"
                                                            class="btn-table-action {{ $gi === 0 ? 'btn-add-golf' : 'btn-delete-row' }}">{{ $gi === 0 ? 'Add' : 'Delete' }}</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Class of Membership --}}
                            <div class="form-group-block">
                                <label class="field-label">Class of Membership <span class="req">*</span></label>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="class_of_membership" value="A"
                                            {{ old('class_of_membership', 'A') == 'A' ? 'checked' : '' }} required> "A"
                                        Share
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="class_of_membership" value="B"
                                            {{ old('class_of_membership') == 'B' ? 'checked' : '' }}> "B" Share
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="class_of_membership" value="C"
                                            {{ old('class_of_membership') == 'C' ? 'checked' : '' }}> "C" Share (Corporate)
                                    </label>
                                </div>
                            </div>

                            {{-- Membership Type — A & B --}}
                            <div class="form-group-block" id="typeBlockAB">
                                <label class="field-label">Type of Application</label>
                                <div class="radio-group flex-column" style="gap:10px;">
                                    <label class="radio-label">
                                        <input type="radio" name="membership_type" value="Purchase of Share"
                                            {{ old('membership_type', 'Purchase of Share') == 'Purchase of Share' ? 'checked' : '' }}>
                                        Purchase of Share
                                    </label>
                                    <div>
                                        <label class="radio-label">
                                            <input type="radio" name="membership_type" value="Transfer of Share"
                                                id="transferChkAB"
                                                {{ old('membership_type') == 'Transfer of Share' ? 'checked' : '' }}>
                                            Transfer of Share
                                        </label>
                                        <div id="transferCertBlockAB"
                                            style="display:{{ old('membership_type') == 'Transfer of Share' ? 'block' : 'none' }}; margin-left:28px; margin-top:6px;">
                                            <label class="field-label">Stock Certificate No.</label>
                                            <input type="text" name="transfer_of_share_cert" id="certInputAB"
                                                class="app-input" placeholder="Enter stock certificate number"
                                                value="{{ old('transfer_of_share_cert') }}" style="max-width:340px;">
                                        </div>
                                    </div>
                                    <label class="radio-label">
                                        <input type="radio" name="membership_type" value="Assignment of Playing Rights"
                                            {{ old('membership_type') == 'Assignment of Playing Rights' ? 'checked' : '' }}>
                                        Assignment of Playing Rights
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="membership_type" value="Change of Corporate Nominee"
                                            {{ old('membership_type') == 'Change of Corporate Nominee' ? 'checked' : '' }}>
                                        Change of Corporate Nominee
                                    </label>
                                </div>
                            </div>

                            {{-- Membership Type — C only --}}
                            <div class="form-group-block d-none" id="typeBlockC">
                                <label class="field-label">Type of Application</label>
                                <div class="radio-group flex-column" style="gap:10px;">
                                    <label class="radio-label">
                                        <input type="radio" name="membership_type" value="Purchase of Share"
                                            {{ old('membership_type', 'Purchase of Share') == 'Purchase of Share' ? 'checked' : '' }}>
                                        Purchase of Share
                                    </label>
                                    <div>
                                        <label class="radio-label">
                                            <input type="radio" name="membership_type" value="Transfer of Share"
                                                id="transferChkC"
                                                {{ old('membership_type') == 'Transfer of Share' ? 'checked' : '' }}>
                                            Transfer of Share
                                        </label>
                                        <div id="transferCertBlockC"
                                            style="display:{{ old('membership_type') == 'Transfer of Share' ? 'block' : 'none' }}; margin-left:28px; margin-top:6px;">
                                            <label class="field-label">Stock Certificate No.</label>
                                            <input type="text" name="transfer_of_share_cert" id="certInputC"
                                                class="app-input" placeholder="Enter stock certificate number"
                                                value="{{ old('transfer_of_share_cert') }}" style="max-width:340px;">
                                        </div>
                                    </div>
                                    <label class="radio-label">
                                        <input type="radio" name="membership_type" value="Change of Corporate Nominee"
                                            {{ old('membership_type') == 'Change of Corporate Nominee' ? 'checked' : '' }}>
                                        Change of Corporate Nominee
                                    </label>
                                </div>
                            </div>

                            {{-- Preferred Billing --}}
                            <div class="form-group-block">
                                <label class="field-label">Preferred Mailing and Billing Address <span
                                        class="req">*</span></label>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="preferred_billing_address" value="Home Address"
                                            {{ old('preferred_billing_address', 'Home Address') == 'Home Address' ? 'checked' : '' }}
                                            required> Home Address
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="preferred_billing_address"
                                            value="Billing (Local) Address"
                                            {{ old('preferred_billing_address') == 'Billing (Local) Address' ? 'checked' : '' }}>
                                        Billing (Local) Address
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="preferred_billing_address" value="Email"
                                            {{ old('preferred_billing_address') == 'Email' ? 'checked' : '' }}> Email
                                    </label>
                                </div>
                                <p class="corp-note mt-3">
                                    <strong>NOTE:</strong> For corporate "C" shares, the billing statements, Club
                                    Newsletters, and other social information will be mailed to the corporation's corporate
                                    address.
                                </p>
                            </div>

                            <div class="step-nav justify-content-between">
                                <button type="button" class="btn-step btn-step-back" onclick="goToStep(2)">
                                    <i class="bi bi-arrow-left"></i> Back
                                </button>
                                <button type="button" class="btn-step btn-step-submit" onclick="showSubmitConfirm()">
                                    Submit Application <i class="bi bi-send"></i>
                                </button>
                            </div>
                        </div>{{-- /step3 --}}

                    </form>
                </div>{{-- /accordion-form-inner --}}
            </div>{{-- /accordion-body-panel --}}
        </div>{{-- /application-accordion --}}
    </div>{{-- /wrapper --}}

    {{-- ── Submit Confirm Modal ─────────────────────────────────────────────── --}}
    <div class="modal fade" id="submitConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0"
                    style="background:linear-gradient(135deg,#1b5e20,#2e7d32);border-radius:4px 4px 0 0;">
                    <h5 class="modal-title text-white fs-6">
                        <i class="bi bi-send-check me-2"></i>Confirm Submission
                    </h5>
                </div>
                <div class="modal-body pt-3">
                    <p class="mb-1 fw-semibold">Do you want to proceed with submission?</p>
                    <p class="text-muted small mb-0">Please verify all information before continuing.</p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm text-white" style="background:var(--rgc-dark);"
                        onclick="submitApplication()">
                        <i class="bi bi-check2 me-1"></i>Yes, Submit
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Membership Applicants Carousel ──────────────────────────────────── --}}
    {{-- <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <h2 class="bot-title">MEMBERSHIP APPLICANTS</h2>
            </div>
        </div>
    </div>
    <br>
    <div class="carousel-wrapper">
        <div class="carousel-container" id="membershipCarousel">
            <button class="carousel-btn prev" data-action="prev" aria-label="Previous">&#10094;</button>
            <div class="carousel-viewport">
                <div class="carousel-track" role="list" aria-live="polite">
                    @foreach ($members_data as $card)
                        <div class="members-page" role="listitem">
                            <div class="app-card text-center">
                                <img src="{{ asset('storage/' . $card->file_path) }}" alt="Member"
                                    class="img-fluid membership-thumb" style="cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#membershipLightboxModal"
                                    data-src="{{ asset('storage/' . $card->file_path) }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="carousel-btn next" data-action="next" aria-label="Next">&#10095;</button>
        </div>
    </div>
    <br> --}}
    {{-- ── Bank Transfer ────────────────────────────────────────────────────── --}}
    <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <h2 class="bot-title">ONLINE BANK TRANSFER</h2>
            </div>
        </div>
    </div>

    <div class="container-fluid my-0 banks_container">
        <div class="row justify-content-center text-center gx-2">
            @foreach ($banks as $bank)
                <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                    <div class="bank-column">
                        @if ($bank->top_image)
                            <img src="{{ asset('storage/' . $bank->top_image) }}"
                                alt="{{ $bank->title ?? 'Bank Top Image' }}" class="card-img custom-card-img-top mb-3">
                        @endif
                        @if ($bank->qr_image)
                            <img src="{{ asset('storage/' . $bank->qr_image) }}" alt="{{ $bank->title ?? 'Bank QR' }}"
                                class="card-img custom-card-img">
                        @endif
                        <br>
                        <p class="mb-3 bank-title {{ strtolower(str_replace(' ', '-', $bank->title ?? 'bank')) }}">
                            {{ $bank->title ?? 'PAY BILLS PROCEDURE' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Lightbox Modal --}}
    <div class="modal fade" id="membershipLightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0" style="background:transparent; box-shadow:none;">
                <div class="position-relative d-inline-block">
                    <img id="membershipLightboxImage" src="" alt="Member" class="lightbox-img">
                    <button type="button" class="lightbox-close" data-bs-dismiss="modal">&times;</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ── Accordion ─────────────────────────────────────────────────────── */
            const toggleBtn = document.getElementById('accordionToggleBtn');
            const panel = document.getElementById('accordionPanel');
            const icon = document.getElementById('accordionIcon');

            toggleBtn.addEventListener('click', function() {
                const isOpen = panel.style.display !== 'none';
                panel.style.display = isOpen ? 'none' : 'block';
                icon.textContent = isOpen ? '+' : '−';
                toggleBtn.classList.toggle('open', !isOpen);
                toggleBtn.setAttribute('aria-expanded', String(!isOpen));
            });

            @if ($errors->any())
                // Auto-open accordion on validation error
                panel.style.display = 'block';
                icon.textContent = '−';
                toggleBtn.classList.add('open');
                toggleBtn.setAttribute('aria-expanded', 'true');

                const errKeys = @json($errors->keys());
                const step1Fields = ['family_name', 'given_name', 'middle_name', 'address', 'billing_address',
                    'cell_no', 'email', 'tel_no', 'date_of_birth', 'place_of_birth', 'nationality',
                    'civil_status', 'sex', 'passport_id_no', 'tin', 'college_university', 'degree_obtained',
                    'photo_2x2'
                ];
                const step2Fields = ['company_name', 'job_title', 'company_address', 'type_of_business',
                    'business_tel_no', 'business_fax_no'
                ];
                const step3Fields = ['class_of_membership', 'preferred_billing_address'];

                let targetStep = 1;
                if (errKeys.some(k => step3Fields.includes(k))) targetStep = 3;
                else if (errKeys.some(k => step2Fields.includes(k))) targetStep = 2;
                else if (errKeys.some(k => step1Fields.includes(k))) targetStep = 1;

                goToStep(targetStep);

                // Scroll to first error field
                setTimeout(() => {
                    let scrolled = false;
                    for (const key of errKeys) {
                        const field = document.querySelector('[name="' + key + '"]');
                        if (field) {
                            field.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                            field.focus();
                            scrolled = true;
                            break;
                        }
                    }
                    if (!scrolled) {
                        document.getElementById('applicationAccordion').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }, 300);
            @endif

            // Auto-open accordion if ?fresh=1 (coming from Submit Another button)
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('fresh') === '1') {
                panel.style.display = 'block';
                icon.textContent = '−';
                toggleBtn.classList.add('open');
                toggleBtn.setAttribute('aria-expanded', 'true');
                goToStep(1);
                // Scroll to form
                setTimeout(() => {
                    document.getElementById('applicationAccordion').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 300);
                // Clean URL without reload
                window.history.replaceState({}, '', '{{ route('membership.frontend') }}');
            }

            /* ── Photo Upload — compress via canvas before submit ─────────────── */
            const photoArea = document.getElementById('photoUploadArea');
            const photoInput = document.getElementById('photo2x2Input');
            const photoPreview = document.getElementById('photoPreview');
            const photoHolder = document.getElementById('photoPlaceholder');

            // Hidden field that carries the compressed base64 JPG
            let compressedPhotoInput = document.getElementById('photo2x2Compressed');
            if (!compressedPhotoInput) {
                compressedPhotoInput = document.createElement('input');
                compressedPhotoInput.type = 'hidden';
                compressedPhotoInput.name = 'photo_2x2_b64';
                compressedPhotoInput.id = 'photo2x2Compressed';
                photoInput.parentNode.insertBefore(compressedPhotoInput, photoInput.nextSibling);
            }

            photoArea.addEventListener('click', () => photoInput.click());

            photoInput.addEventListener('change', function() {
                if (!this.files || !this.files[0]) return;
                const file = this.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        // Resize to max 600x600 (2x2 photo — doesn't need to be huge)
                        const MAX = 600;
                        let w = img.width,
                            h = img.height;
                        if (w > MAX || h > MAX) {
                            if (w > h) {
                                h = Math.round(h * MAX / w);
                                w = MAX;
                            } else {
                                w = Math.round(w * MAX / h);
                                h = MAX;
                            }
                        }
                        const canvas = document.createElement('canvas');
                        canvas.width = w;
                        canvas.height = h;
                        const ctx = canvas.getContext('2d');
                        ctx.fillStyle = '#ffffff';
                        ctx.fillRect(0, 0, w, h);
                        ctx.drawImage(img, 0, 0, w, h);

                        // Compress to JPG at 85% quality — always small
                        const dataUrl = canvas.toDataURL('image/jpeg', 0.85);
                        compressedPhotoInput.value = dataUrl;

                        // Show preview
                        photoPreview.src = dataUrl;
                        photoPreview.classList.remove('d-none');
                        photoHolder.classList.add('d-none');
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });

            /* ── Class of Membership Toggle ────────────────────────────────────── */
            document.querySelectorAll('input[name="class_of_membership"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const isC = this.value === 'C';
                    document.getElementById('typeBlockAB').classList.toggle('d-none', isC);
                    document.getElementById('typeBlockC').classList.toggle('d-none', !isC);
                });
            });

            /* ── Transfer of Share — Stock Certificate toggle ──────────────────── */
            const transferChkAB = document.getElementById('transferChkAB');
            const transferCertBlockAB = document.getElementById('transferCertBlockAB');
            const transferChkC = document.getElementById('transferChkC');
            const transferCertBlockC = document.getElementById('transferCertBlockC');

            function bindTransferToggle(radios, block, certInput) {
                radios.forEach(r => {
                    r.addEventListener('change', function() {
                        const show = this.value === 'Transfer of Share' && this.checked;
                        block.style.display = show ? 'block' : 'none';
                        if (!show && certInput) certInput.value = '';
                    });
                });
            }

            // AB block
            bindTransferToggle(
                document.querySelectorAll('#typeBlockAB input[name="membership_type"]'),
                transferCertBlockAB,
                document.getElementById('certInputAB')
            );
            // C block
            bindTransferToggle(
                document.querySelectorAll('#typeBlockC input[name="membership_type"]'),
                transferCertBlockC,
                document.getElementById('certInputC')
            );

            // Restore on old() if validation failed
            @if (old('membership_type') == 'Transfer of Share')
                if (transferChkAB) {
                    transferChkAB.checked = true;
                    if (transferCertBlockAB) transferCertBlockAB.style.display = 'block';
                }
                if (transferChkC) {
                    transferChkC.checked = true;
                    if (transferCertBlockC) transferCertBlockC.style.display = 'block';
                }
            @endif

            /* ── Children Dynamic Table ────────────────────────────────────────── */
            let childIdx = {{ count(old('children', [['']])) }};
            document.getElementById('childrenBody').addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-add-child')) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td><input type="text" name="children[${childIdx}][name]" class="app-input app-input-sm" placeholder="Child's name"></td>
                <td><input type="date" name="children[${childIdx}][dob]" class="app-input app-input-sm"></td>
                <td><div class="radio-group" style="gap:10px;">
                    <label class="radio-label"><input type="radio" name="children[${childIdx}][sex]" value="Male"> M</label>
                    <label class="radio-label"><input type="radio" name="children[${childIdx}][sex]" value="Female"> F</label>
                </div></td>
                <td><div class="radio-group" style="gap:10px;">
                    <label class="radio-label"><input type="radio" name="children[${childIdx}][membership_card]" value="Yes"> Y</label>
                    <label class="radio-label"><input type="radio" name="children[${childIdx}][membership_card]" value="No"> N</label>
                </div></td>
                <td><button type="button" class="btn-table-action btn-delete-row">Delete</button></td>`;
                    document.getElementById('childrenBody').appendChild(row);
                    childIdx++;
                }
                if (e.target.classList.contains('btn-delete-row')) e.target.closest('tr').remove();
            });

            /* ── Golf Clubs Dynamic Table ──────────────────────────────────────── */
            let golfIdx = {{ count(old('other_golf_clubs', [['']])) }};
            document.getElementById('golfBody').addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-add-golf')) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td><input type="text" name="other_golf_clubs[${golfIdx}][club]" class="app-input app-input-sm" placeholder="Club name"></td>
                <td><input type="text" name="other_golf_clubs[${golfIdx}][handicap]" class="app-input app-input-sm" placeholder="Handicap"></td>
                <td><button type="button" class="btn-table-action btn-delete-row">Delete</button></td>`;
                    document.getElementById('golfBody').appendChild(row);
                    golfIdx++;
                }
                if (e.target.classList.contains('btn-delete-row')) e.target.closest('tr').remove();
            });

            /* ── Carousel ──────────────────────────────────────────────────────── */
            const carousel = document.getElementById('membershipCarousel');
            if (carousel) {
                const track = carousel.querySelector('.carousel-track');
                const viewport = carousel.querySelector('.carousel-viewport');
                const items = Array.from(track.children);
                const btnPrev = carousel.querySelector('[data-action="prev"]');
                const btnNext = carousel.querySelector('[data-action="next"]');
                let index = 0,
                    cardWidth = 0,
                    step = 0;

                function recalc() {
                    const rs = getComputedStyle(document.documentElement);
                    const vis = parseInt(rs.getPropertyValue('--visible')) || 1;
                    const gap = parseFloat((rs.getPropertyValue('--gap') || '18px').replace('px', '')) || 18;
                    cardWidth = (viewport.clientWidth - gap * (vis - 1)) / vis;
                    step = cardWidth + gap;
                    items.forEach(it => {
                        it.style.flex = `0 0 ${cardWidth}px`;
                        it.style.width = `${cardWidth}px`;
                    });
                    index = Math.min(index, Math.max(0, items.length - vis));
                    applyTransform();
                    updateBtns();
                }

                function applyTransform() {
                    track.style.transform = `translateX(-${Math.round(index * step)}px)`;
                }

                function updateBtns() {
                    const vis = parseInt(getComputedStyle(document.documentElement).getPropertyValue(
                        '--visible')) || 1;
                    btnPrev.disabled = index <= 0;
                    btnNext.disabled = index >= Math.max(0, items.length - vis);
                }
                btnPrev.addEventListener('click', () => {
                    index = Math.max(0, index - 1);
                    applyTransform();
                    updateBtns();
                });
                btnNext.addEventListener('click', () => {
                    const vis = parseInt(getComputedStyle(document.documentElement).getPropertyValue(
                        '--visible')) || 1;
                    index = Math.min(items.length - vis, index + 1);
                    applyTransform();
                    updateBtns();
                });
                let rTimer;
                window.addEventListener('resize', () => {
                    clearTimeout(rTimer);
                    rTimer = setTimeout(recalc, 120);
                });
                recalc();
            }

            /* ── Lightbox ──────────────────────────────────────────────────────── */
            const lbModal = document.getElementById('membershipLightboxModal');
            const lbImg = document.getElementById('membershipLightboxImage');
            if (lbModal) {
                document.querySelectorAll('.membership-thumb').forEach(img => {
                    img.addEventListener('click', () => {
                        lbImg.src = img.dataset.src;
                    });
                });
                lbModal.addEventListener('hidden.bs.modal', () => {
                    lbImg.src = '';
                });
            }
        });

        /* ── Step Navigation ───────────────────────────────────────────────────── */
        function goToStep(step) {
            document.querySelectorAll('.form-step').forEach(s => s.classList.add('d-none'));
            document.getElementById('step' + step).classList.remove('d-none');
            document.querySelectorAll('.step-item').forEach(item => {
                const s = parseInt(item.dataset.step);
                item.classList.remove('active', 'completed');
                if (s === step) item.classList.add('active');
                if (s < step) item.classList.add('completed');
            });
            document.getElementById('applicationAccordion').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function showSubmitConfirm() {
            new bootstrap.Modal(document.getElementById('submitConfirmModal')).show();
        }

        function submitApplication() {
            const btn = document.querySelector(
                '#submitConfirmModal .btn-success, #submitConfirmModal [onclick="submitApplication()"]');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Submitting...';
            }

            // Fix: two inputs share the same name transfer_of_share_cert (one for AB, one for C)
            // Disable the hidden one so only the visible/filled one gets submitted
            const certAB = document.getElementById('certInputAB');
            const certC = document.getElementById('certInputC');
            const blockAB = document.getElementById('transferCertBlockAB');
            const blockC = document.getElementById('transferCertBlockC');

            if (certAB && blockAB && blockAB.style.display === 'none') certAB.disabled = true;
            if (certC && blockC && blockC.style.display === 'none') certC.disabled = true;

            document.getElementById('membershipAppForm').submit();
        }

        @if ($errors->any())
            // Safety net — runs after everything including DOMContentLoaded
            window.addEventListener('load', function() {
                const panel = document.getElementById('accordionPanel');
                const icon = document.getElementById('accordionIcon');
                const toggleBtn = document.getElementById('accordionToggleBtn');
                if (!panel) return;

                panel.style.display = 'block';
                icon.textContent = '−';
                toggleBtn.classList.add('open');
                toggleBtn.setAttribute('aria-expanded', 'true');

                const errKeys = @json($errors->keys());
                const step1Fields = ['family_name', 'given_name', 'middle_name', 'address', 'billing_address',
                    'cell_no', 'email', 'tel_no', 'date_of_birth', 'place_of_birth', 'nationality',
                    'civil_status', 'sex', 'passport_id_no', 'tin', 'college_university', 'degree_obtained',
                    'photo_2x2'
                ];
                const step2Fields = ['company_name', 'job_title', 'company_address', 'type_of_business',
                    'business_tel_no', 'business_fax_no'
                ];
                const step3Fields = ['class_of_membership', 'preferred_billing_address'];

                let targetStep = 1;
                if (errKeys.some(k => step3Fields.includes(k))) targetStep = 3;
                else if (errKeys.some(k => step2Fields.includes(k))) targetStep = 2;
                else if (errKeys.some(k => step1Fields.includes(k))) targetStep = 1;

                goToStep(targetStep);

                setTimeout(() => {
                    for (const key of errKeys) {
                        const field = document.querySelector('[name="' + key + '"]');
                        if (field) {
                            field.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                            field.focus();
                            break;
                        }
                    }
                }, 300);
            });
        @endif
    </script>
@endpush

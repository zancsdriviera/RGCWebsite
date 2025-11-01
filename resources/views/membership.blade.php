@extends('layouts.app')

@section('title', 'Membership')

@push('styles')
    <link href="{{ asset('css/membership.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">MEMBERSHIP</h1>
    </div>

    <!-- Top caption -->
    <div class="top_caption my-0 text-center">
        <h2 class="top-title">CLICK TO DOWNLOAD THE PDF</h2>
    </div>

    <!-- Downloads section -->
    <div class="bullet_container my-4">
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-5">
            @php
                $downloads = \App\Models\MembershipContent::where('type', 'download')->get();
                $chunkedDownloads = $downloads->chunk(ceil($downloads->count() / 2));
            @endphp

            @foreach ($chunkedDownloads as $group)
                <ul class="list-unstyled text-start m-0">
                    @foreach ($group as $item)
                        <li>
                            <i class="bi bi-download me-2"></i>
                            <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">
                                {{ $item->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>

    <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center gx-2">
            <!-- Column 1 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <h2 class="bot-title">MEMBERSHIP APPLICANTS</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Applicants section -->
    <div class="carousel-wrapper">
        <div class="carousel-container">
            <button class="carousel-btn prev" aria-label="Previous">&#10094;</button>
            <div class="carousel-viewport">
                <div class="carousel-track">
                    @php
                        $applicants = \App\Models\MembershipContent::where('type', 'applicant')->get();
                        $chunks = $applicants->chunk(10); // 10 applicants per slide
                    @endphp

                    @foreach ($chunks as $group)
                        <!-- Single slide -->
                        <section class="members-page">
                            <header class="members-header">
                                <img class="header-wave" src="{{ asset('images/wavy.png') }}" alt=""
                                    aria-hidden="true">
                                <div class="club-logo">
                                    <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Club Logo">
                                </div>
                            </header>

                            <div class="title-block">
                                <h1 class="page-title">MEMBERSHIP APPLICANTS</h1>
                                <div class="title-underline"></div>
                            </div>

                            <div class="cards-grid">
                                @foreach ($group as $applicant)
                                    <article class="app-card">
                                        <div class="avatar-wrap">
                                            <img src="{{ $applicant->avatar ? asset('storage/' . $applicant->avatar) : asset('images/user.png') }}"
                                                alt="{{ $applicant->name ?? 'Applicant' }}">
                                        </div>
                                        <div class="info">
                                            <p class="label">
                                                <span class="key">NAME:</span>
                                                <span class="val">{{ $applicant->name ?? 'N/A' }}</span>
                                            </p>
                                            <p class="meta"><span class="key">COMPANY:</span>
                                                {{ $applicant->company ?? 'N/A' }}</p>
                                            <p class="meta"><span class="key">POSITION:</span>
                                                {{ $applicant->position ?? 'N/A' }}</p>
                                            <p class="meta"><span class="key">AGE:</span>
                                                {{ $applicant->age ?? 'N/A' }}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>

                            <div class="page-footer"></div>
                        </section>
                    @endforeach
                </div>
            </div>
            <button class="carousel-btn next" aria-label="Next">&#10095;</button>
        </div>
    </div>


    <!-- Banks / QR Codes -->
    <div class="container-fluid my-0 banks_container">
        <div class="row justify-content-center text-center gx-2">
            @foreach ($banks as $bank)
                <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                    <div class="bank-column w-100">
                        {{-- Top image (same class as your original) --}}
                        @if ($bank->top_image)
                            <img src="{{ asset('storage/' . $bank->top_image) }}"
                                alt="{{ $bank->title ?? 'Bank Top Image' }}" class="card-img custom-card-img-top mb-3">
                        @else
                            {{-- optional fallback to original local asset if you want --}}
                            {{-- <img src="{{ asset('images/MEMBERSHIP/default-top.png') }}" class="card-img custom-card-img-top mb-3"> --}}
                        @endif

                        {{-- Title text (keeps your original classes and wording) --}}
                        <p class="mb-3 bank-title {{ strtolower(str_replace(' ', '-', $bank->title ?? 'bank')) }}">
                            {{ $bank->title ?? 'PAY BILLS PROCEDURE' }}
                        </p>

                        {{-- QR image (correct field name: qr_image) --}}
                        @if ($bank->qr_image)
                            <img src="{{ asset('storage/' . $bank->qr_image) }}" alt="{{ $bank->title ?? 'Bank QR' }}"
                                class="card-img custom-card-img">
                        @else
                            {{-- optional fallback --}}
                            {{-- <img src="{{ asset('images/MEMBERSHIP/default-qr.png') }}" class="card-img custom-card-img"> --}}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('title', 'Corporate Governance')

@push('styles')
    <link href="{{ asset('css/corpgovernance.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CORPORATE GOVERNANCE</h1>
    </div>

    <div class="profile_container container my-5">
        <div class="row align-items-center">
            <!-- Left side: caption + description -->
            <div class="col-md-6">
                <h2 class="mb-2">RGC CORPORATE</h2>
                <h2 class="mb-3">GOVERNANCE</h2>
                <p>
                    Riviera Golf Club Inc. is an exciting concept unparalleled in the Philippines for its vision to be among
                    Asia’s most outstanding golf courses.This golf club is destined to be a golf Mecca and at the same time
                    providing the ultimate in comfort and elegance.
                </p>
            </div>
            <!-- Right side: image -->
            <div class="col-md-6 text-center">
                <img src="/images/ABOUT_US/ClubProfileImage.png" class="img-fluid rounded shadow" alt="About Golf">
            </div>
        </div>
    </div>
    <div class="green-bar"></div>
    <!-- Group 1 -->
    <div class="py-5" style="background-color: #f8f9f4;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">DEFINITIVE INFORMATION STATEMENT-2024.</h5>
                            <p class="text-muted small mb-2">SEPTEMBER 1, 2025</p>
                        </div>
                        <img src="{{ asset('images/SPAM/img1.png') }}" class="card-img-bottom" alt="Office Image">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">BOARD CHARTER</h5>
                            <p class="text-muted small mb-2">SEPTEMBER 2, 2025</p>
                        </div>
                        <img src="{{ asset('images/SPAM/img2.png') }}" class="card-img-bottom" alt="Skyscraper Image">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">MANUAL ON CORPORATE GOVERNANCE 2021</h5>
                            <p class="text-muted small mb-2">SEPTEMBER 3, 2025</p>
                        </div>
                        <img src="{{ asset('images/SPAM/img3.png') }}" class="card-img-bottom" alt="Office Desk Image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Group 2 -->
    <div class="py-5" style="background-color: #9EBDB5;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">ASM MINUTES 2023</h5>
                            <p class="text-muted small mb-2">SEPTEMBER 4, 2025</p>
                        </div>
                        <img src="{{ asset('images/SPAM/img4.png') }}" class="card-img-bottom" alt="Meeting Room Image">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">RGCI AGCR 2023</h5>
                            <p class="text-muted small mb-2">SEPTEMBER 5, 2025</p>
                        </div>
                        <img src="{{ asset('images/SPAM/img5.png') }}" class="card-img-bottom" alt="Buildings Image">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">MINUTES OF THE PREVIOUS ASM 2022</h5>
                            <p class="text-muted small mb-2">SEPTEMBER 6, 2025</p>
                        </div>
                        <img src="{{ asset('images/SPAM/img6.png') }}" class="card-img-bottom" alt="Laptop Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5" style="background-color: #f8f9f4;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">DEFINITIVE INFORMATION STATEMENT-2024.</h5>
                            <p class="text-muted small mb-2">SEPTEMBER 1, 2025</p>
                        </div>
                        <img src="{{ asset('images/SPAM/img1.png') }}" class="card-img-bottom" alt="Office Image">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">BOARD CHARTER</h5>
                            <p class="text-muted small mb-2">SEPTEMBER 2, 2025</p>
                        </div>
                        <img src="{{ asset('images/SPAM/img2.png') }}" class="card-img-bottom" alt="Skyscraper Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

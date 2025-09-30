@extends('layouts.app')

@section('title', 'FAQ\'s')

@push('styles')
    <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FAQ</h1>
    </div>

    <div class="top_caption my-0 text-center">
        <h2 class="top-title">SHARE YOUR EXPERIENCE WITH US!</h2>
        <h3 class="scan_here">Scan the QR codes below</h3>
    </div>

    <div class="container my-5 text-center">
        <!-- Cards Row -->
        <div class="row g-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <img src="{{ asset('images/FAQ/QR_FORM.png') }}" class="card-img-top" alt="Our Courses">
                    <div class="card-body text-center">
                        <i class="bi bi-rss-fill fs-1 custom_icon"></i>
                        <h5 class="mt-3 fw-bold custom_text">FEEDBACK</h5>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <img src="{{ asset('images/FAQ/QR_FB.png') }}" class="card-img-top" alt="The Club">
                    <div class="card-body text-center">
                        <i class="bi bi-facebook fs-1 custom_icon"></i>
                        <h5 class="mt-3 fw-bold custom_text">FACEBOOK</h5>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <img src="{{ asset('images/FAQ/QR_VIBER.png') }}" class="card-img-top" alt="Events">
                    <div class="card-body text-center">
                        <i class="bi bi-telephone-inbound-fill fs-1 custom_icon"></i>
                        <h5 class="mt-3 fw-bold custom_text">VIBER</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5 text-center">
        <!-- Cards Row -->
        <div class="row g-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <img src="{{ asset('images/FAQ/QR_IG.png') }}" class="card-img-top" alt="Our Courses">
                    <div class="card-body text-center">
                        <i class="bi bi-instagram fs-1 custom_icon"></i>
                        <h5 class="mt-3 fw-bold custom_text">INSTAGRAM</h5>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <img src="{{ asset('images/FAQ/QR_YT.png') }}" class="card-img-top" alt="The Club">
                    <div class="card-body text-center">
                        <i class="bi bi-youtube fs-1 custom_icon"></i>
                        <h5 class="mt-3 fw-bold custom_text">YOUTUBE</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

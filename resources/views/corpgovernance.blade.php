@extends('layouts.app')

@section('title', 'Corporate Governance')

@push('styles')
    <link href="{{ asset('css/corpgovernance.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CORPORATE GOVERNANCE</h1>
    </div>


    <div class="green-bar"></div>
    <!-- Group 1 -->
    <div class="py-5" style="background-color: #f8f9f4;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <a href="{{ route('definitiveArchive') }}" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">DEFINITIVE INFORMATION STATEMENT</h5>
                        </div>
                        <img src="{{ asset('images/SPAM/img1.png') }}" class="card-img-bottom" alt="Office Image">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('asmMinutes') }}" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">ASM MINUTES</h5>
                        </div>
                        <img src="{{ asset('images/SPAM/img2.png') }}" class="card-img-bottom" alt="Skyscraper Image">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('ACGR') }}" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">ACGR</h5>
                        </div>
                        <img src="{{ asset('images/SPAM/img3.png') }}" class="card-img-bottom" alt="Office Desk Image">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Group 2 -->
    <div class="py-5" style="background-color: #9EBDB5;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <a href="{{ route('cbce') }}" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">CODE OF BUSINESS CONDUCT AND ETHICS</h5>
                        </div>
                        <img src="{{ asset('images/SPAM/img5.png') }}" class="card-img-bottom" alt="Office Image">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('boardCharter') }}" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">BOARD CHARTER</h5>
                        </div>
                        <img src="{{ asset('images/SPAM/img4.png') }}" class="card-img-bottom" alt="Meeting Room Image">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('corpGovManual') }}" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">MANUAL ON CORPORATE GOVERNANCE</h5>
                        </div>
                        <img src="{{ asset('images/SPAM/img4.png') }}" class="card-img-bottom" alt="Meeting Room Image">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

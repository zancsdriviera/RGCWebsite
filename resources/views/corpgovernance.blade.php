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
                    <a href="{{ route('definitive.frontend') }}" class="card h-100 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="{{ asset('images/DefinitiveCard.png') }}" class="img-fluid"
                                alt="Definitive Card Image">
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('asm_minutes.frontend') }}" class="card h-100 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="{{ asset('images/MinutesCard.png') }}" class="img-fluid" alt="Minutes Card Image">
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('acgr.frontend') }}" class="card h-100 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="{{ asset('images/AnnualCard.png') }}" class="img-fluid" alt="Annual Card Image">
                        </div>
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
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="{{ asset('images/CodeCard.png') }}" class="img-fluid"
                                alt="Code of Business Conduct and Ethics Card Image">
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('boardCharter') }}" class="card h-100 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="{{ asset('images/BoardCard.png') }}" class="img-fluid"
                                alt="Board Charter Card Image">
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('corpGovManual') }}" class="card h-100 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="{{ asset('images/ManualCard.png') }}" class="img-fluid"
                                alt="Manual on Corporate Governance Image">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

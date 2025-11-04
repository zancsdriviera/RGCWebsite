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
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <h2 class="bot-title">MEMBERSHIP APPLICANTS</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="carousel-wrapper">
        <div class="carousel-container">
            <button class="carousel-btn prev" aria-label="Previous">&#10094;</button>
            <div class="carousel-viewport">
                <div class="carousel-track">
                    @php
                        $membersDataCards = \App\Models\MembershipContent::where('type', 'members_data')->get();
                    @endphp

                    @foreach ($membersDataCards as $card)
                        <div class="members-page">
                            <div class="app-card text-center">
                                <img src="{{ asset('storage/' . $card->file_path) }}" alt="Member" class="img-fluid">
                            </div>
                        </div>
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
                        @if ($bank->top_image)
                            <img src="{{ asset('storage/' . $bank->top_image) }}"
                                alt="{{ $bank->title ?? 'Bank Top Image' }}" class="card-img custom-card-img-top mb-3">
                        @endif

                        <p class="mb-3 bank-title {{ strtolower(str_replace(' ', '-', $bank->title ?? 'bank')) }}">
                            {{ $bank->title ?? 'PAY BILLS PROCEDURE' }}
                        </p>

                        @if ($bank->qr_image)
                            <img src="{{ asset('storage/' . $bank->qr_image) }}" alt="{{ $bank->title ?? 'Bank QR' }}"
                                class="card-img custom-card-img">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

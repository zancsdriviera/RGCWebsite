@extends('layouts.app')

@section('title', 'Facilities - Driving Range')

@push('styles')
    <link href="{{ asset('css/drivingrange.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES</h1>
    </div>

    <!-- HTML -->
    @php
        $desc = \App\Models\DrivingrangeContent::whereNotNull('description')->first();
        $images = \App\Models\DrivingrangeContent::whereNotNull('image_path')->get();
    @endphp

    <div class="container">
        <div class="info-box">
            <h1>DRIVING RANGE</h1>
            <hr class="dotted">
            <p class="desc">{{ $desc->description ?? '' }}</p>

            <!-- RATES -->
            {{-- <div class="rates-box" aria-labelledby="rates-label">
                <div class="rates-title" id="rates-label">RATES</div>

                <div class="rates-rows">
                    <div class="rate-row">
                        <span class="rate-label">MEMBER'S RATE (per hour)</span>
                        <span class="rate-price">₱ 999.99</span>
                    </div>

                    <div class="rate-row">
                        <span class="rate-label">Warm Up</span>
                        <span class="rate-price">₱ 500.00</span>
                    </div>
                </div>
            </div>

            <div class="info-footer">
                <div class="bays">20 BAYS</div>
                <div class="hours"><strong>OPERATING HOURS:</strong> 5:00 AM to 7:00 PM</div>
                <hr class="solid">
                <hr class="solid">

                <div class="hr-lines">
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </div> --}}
            <div class="green-bar" aria-hidden="true"></div>
        </div>

        <div class="photo-grid">
            @foreach ($images as $img)
                <div class="photo main">
                    <img src="{{ $img->image_path }}" alt="Driving Range">
                </div>
            @endforeach
        </div>
    </div>

    <!-- replace your old lightbox markup with this -->
    <div id="lightbox" class="lightbox" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="lightbox-inner" role="document">
            <button class="lightbox-close" aria-label="Close image">&times;</button>
            <img id="lightbox-img" class="lightbox-img" alt="">
        </div>
        <!-- arrows OUTSIDE inner -->
        <button class="lightbox-prev" aria-label="Previous image">&#10094;</button>
        <button class="lightbox-next" aria-label="Next image">&#10095;</button>
    </div>
@endsection

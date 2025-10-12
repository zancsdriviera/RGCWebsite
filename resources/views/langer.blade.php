@extends('layouts.app')

@section('title', 'Courses - Langer')

@push('styles')
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <link href="{{ asset('css/langer.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">LANGER COURSE</h1>
    </div>

    <!-- HTML (drop into your page; replace src values) -->
    <br>
    <div class="course-gallery">
        <h2 class="cg-title">The Bernhard Langer Course</h2>
        <div class="cg-rule"></div>
        <p class="cg-desc">
            Known For Being One Of The Toughest Courses In The Philippines, This 7,057 Yard Par 71
            Bernhard Langer Signature Course Will Put All Your Golf Skills To The Test. Built On The
            Hills Of Silang Cavite, This Course Excellent Drainage Making It One Of The Best All Weather
            Courses In The Country.
        </p>

        <div class="cg-frame">
            <div class="cg-main-wrap">
                <button class="cg-side prev" aria-label="Previous">&#10094;</button>
                <img class="cg-main" src="{{ asset('images/COURSES/Langer/Langer1.jpg') }}" alt="Main hole image">
                <button class="cg-side next" aria-label="Next">&#10095;</button>

                <!-- <div class="cg-label">HOLE #</div> -->
            </div>
            ~
            <!-- thumbnails live INSIDE the same frame and span almost full width -->
            <div class="cg-thumbs-row">
                <!-- <button class="thumb-nav left" aria-label="Thumb Prev">&#10094;</button> -->

                <div class="cg-thumbs">
                    <img src="{{ asset('images/COURSES/Langer/Langer1.jpg') }}" alt="thumb">
                    <img src="{{ asset('images/COURSES/Langer/Langer2.jpg') }}" alt="thumb">
                    <img src="{{ asset('images/COURSES/Langer/Langer3.jpg') }}" alt="thumb">
                    <img src="{{ asset('images/COURSES/Langer/Langer4.jpg') }}" alt="thumb">
                    <img src="{{ asset('images/COURSES/Langer/Langer5.jpg') }}" alt="thumb">
                    <img src="{{ asset('images/COURSES/Langer/Langer6.jpg') }}" alt="thumb">
                </div>

                <!-- <button class="thumb-nav right" aria-label="Thumb Next">&#10095;</button> -->
            </div>
        </div>
        <br>
    </div>
@endsection

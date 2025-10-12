@extends('layouts.app')


@section('title', 'Courses - Couples')

@push('styles')
    <link href="{{ asset('css/couples.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">COUPLES COURSE</h1>
    </div>

    <!-- HTML (drop into your page; replace src values) -->
    <br>
    <div class="course-gallery">
        <h2 class="cg-title">The Fred Couples Course</h2>
        <div class="cg-rule"></div>
        <p class="cg-desc">
            Designed by everybody’s favorite golfer Freddie Couples, The Riviera Couples Course is a challenging yet
            enjoying to play. This 7,102 yard par 72 course is situated amongst small valleys and ravines making this Silang
            Cavite layout pleasing to the eye, yet dangerous if you lose focus on your game.
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

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

    <br>
    <div class="course-gallery">
        <h2 class="cg-title">{{ $couples->couples_title ?? $couples->couples_Mtitle }}</h2>
        <div class="cg-rule"></div>
        <p class="cg-desc">{{ $couples->couples_description ?? '' }}</p>

        <div class="cg-frame">
            <div class="cg-main-wrap position-relative">
                <button class="cg-side prev" aria-label="Previous">&#10094;</button>

                <!-- Main image container -->
                <div class="cg-main-container position-relative w-100">
                    <img class="cg-main w-100"
                        src="{{ $couples->couples_images && count($couples->couples_images) > 0 ? asset('storage/' . $couples->couples_images[0]) : ($couples->couples_Mimage ? asset('storage/' . $couples->couples_Mimage) : asset('images/placeholder.png')) }}"
                        alt="Main hole image">

                    <!-- Hole Number Label -->
                    <span class="hole-number-label position-absolute">Hole 1</span>
                </div>

                <button class="cg-side next" aria-label="Next">&#10095;</button>
            </div>


            <div class="cg-thumbs-row">
                <div class="cg-thumbs">
                    @if ($couples->couples_images && count($couples->couples_images) > 0)
                        @foreach ($couples->couples_images as $img)
                            <img src="{{ asset('storage/' . $img) }}" alt="thumb">
                        @endforeach
                    @else
                        <img src="{{ $couples->couples_Mimage ? asset('storage/' . $couples->couples_Mimage) : asset('images/placeholder.png') }}"
                            alt="thumb">
                    @endif
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection

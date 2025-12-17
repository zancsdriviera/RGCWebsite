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

    <br>
    <div class="course-gallery">
        <h2 class="cg-title">{{ $langer->langer_title ?? $langer->langer_Mtitle }}</h2>
        <div class="cg-rule"></div>
        <p class="cg-desc">{{ $langer->langer_description ?? '' }}</p>

        <div class="cg-frame">
            <div class="cg-main-wrap position-relative">
                <button class="cg-side prev" aria-label="Previous">&#10094;</button>

                <!-- Main image container -->
                <div class="cg-main-container position-relative w-100">
                    <img class="cg-main w-100"
                        src="{{ $langer->langer_images && count($langer->langer_images) > 0 ? asset('storage/' . $langer->langer_images[0]) : ($langer->langer_Mimage ? asset('storage/' . $langer->langer_Mimage) : asset('images/placeholder.png')) }}"
                        alt="Main hole image">

                    <!-- Hole Number Label -->
                    <span class="hole-number-label position-absolute">Hole 1</span>
                </div>

                <button class="cg-side next" aria-label="Next">&#10095;</button>
            </div>


            <div class="cg-thumbs-row">
                <div class="cg-thumbs">
                    @if ($langer->langer_images && count($langer->langer_images) > 0)
                        @foreach ($langer->langer_images as $img)
                            <img src="{{ asset('storage/' . $img) }}" alt="thumb">
                        @endforeach
                    @else
                        <img src="{{ $langer->langer_Mimage ? asset('storage/' . $langer->langer_Mimage) : asset('images/placeholder.png') }}"
                            alt="thumb">
                    @endif
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection

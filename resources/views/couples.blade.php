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
        <h2 class="cg-title">{{ $couples->title ?? 'The Fred Couples Course' }}</h2>
        <div class="cg-rule"></div>
        <p class="cg-desc">
            {{ $couples->description ?? 'Designed by everybody’s favorite golfer Freddie Couples, this 7,102 yard par 72 course is challenging yet enjoyable.' }}
        </p>

        <div class="cg-frame">
            <div class="cg-main-wrap">
                <button class="cg-side prev" aria-label="Previous">&#10094;</button>
                <img class="cg-main"
                    src="{{ $couples->image1 ? asset('storage/' . $couples->image1) : asset('images/placeholder.png') }}"
                    alt="Main hole image">
                <button class="cg-side next" aria-label="Next">&#10095;</button>
            </div>

            <div class="cg-thumbs-row">
                <div class="cg-thumbs">
                    @for ($i = 1; $i <= 6; $i++)
                        <img src="{{ $couples->{'image' . $i} ? asset('storage/' . $couples->{'image' . $i}) : asset('images/placeholder.png') }}"
                            alt="thumb">
                    @endfor
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection

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
        <h2 class="cg-title">{{ $langer->title }}</h2>
        <div class="cg-rule"></div>
        <p class="cg-desc">{{ $langer->description }}</p>

        <div class="cg-frame">
            <div class="cg-main-wrap">
                <button class="cg-side prev" aria-label="Previous">&#10094;</button>
                <img class="cg-main"
                    src="{{ $langer->image1 ? asset('storage/' . $langer->image1) : asset('images/placeholder.png') }}"
                    alt="Main hole image">
                <button class="cg-side next" aria-label="Next">&#10095;</button>
            </div>

            <div class="cg-thumbs-row">
                <div class="cg-thumbs">
                    @for ($i = 1; $i <= 6; $i++)
                        @php $img = $langer->{'image'.$i}; @endphp
                        <img src="{{ $img ? asset('storage/' . $img) : asset('images/placeholder.png') }}" alt="thumb">
                    @endfor
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Facilities - Locker Room')

@push('styles')
    <link href="{{ asset('css/locker.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES</h1>
    </div>

    <!-- HTML -->
    <div class="container">
        <div class="info-box">
            <h1>MEN'S AND LADIES LOCKER ROOM</h1>
            <hr class="dotted">
            <p class="desc">

            </p>
            <div class="green-bar" aria-hidden="true"></div>
        </div>

        <div class="photo-grid">
            <div class="photo main"><img src="{{ asset('images/locker.jpg') }}" alt="Lobby"></div>
            <div class="photo main"><img src="{{ asset('images/DrivingRange.jpg') }}" alt="Lobby"></div>
            <div class="photo main"><img src="{{ asset('images/locker.jpg') }}" alt="Lobby"></div>
            <div class="photo main"><img src="{{ asset('images/locker.jpg') }}" alt="Lobby"></div>
            <div class="photo main"><img src="{{ asset('images/locker.jpg') }}" alt="Lobby"></div>
            <div class="photo main"><img src="{{ asset('images/locker.jpg') }}" alt="Lobby"></div>
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

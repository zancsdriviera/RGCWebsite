@extends('layouts.app')

@section('title', 'Facilities - Clubhouse')

@push('styles')
    <link href="{{ asset('css/clubhouse.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES</h1>
    </div>

    <!-- HTML -->
    <div class="container">
        <div class="info-box">
            <h1>GOLF CLUB HOUSE</h1>
            <hr class="dotted">
            <p class="desc">
                Step into the perfect blend of sport and leisure at our Golf Clubhouse—where every round ends with
                comfort, camaraderie, and class. Whether you’re here to unwind after a game, enjoy fine dining, or
                connect with fellow enthusiasts, our clubhouse offers the ideal retreat designed to elevate your golfing
                experience.
            </p>
            <div class="green-bar" aria-hidden="true"></div>
        </div>

        <div class="photo-grid">
            <div class="photo main"><img src="{{ asset('images/Lobby.png') }}" alt="Lobby"></div>
            <div class="photo main"><img src="{{ asset('images/DrivingRange.jpg') }}" alt="Lobby"></div>
            <div class="photo main"><img src="{{ asset('images/Lobby.png') }}" alt="Lobby"></div>
            <div class="photo main"><img src="{{ asset('images/Lobby.png') }}" alt="Lobby"></div>
            <div class="photo main"><img src="{{ asset('images/Lobby.png') }}" alt="Lobby"></div>
            <div class="photo main"><img src="{{ asset('images/Lobby.png') }}" alt="Lobby"></div>
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

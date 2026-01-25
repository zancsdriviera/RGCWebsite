@extends('layouts.app')

@section('title', 'Facilities - Lobby')

@push('styles')
    <link href="{{ asset('css/lobby.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES</h1>
    </div>

    <!-- HTML -->
    @php
        $desc = \App\Models\LobbyContent::whereNotNull('description')->first();
        $images = \App\Models\LobbyContent::whereNotNull('image_path')->get();
    @endphp

    <div class="container">
        <div class="info-box">
            <h1>LOBBY</h1>
            <hr class="dotted">
            <p class="desc">{{ $desc->description ?? '' }}</p>
            <div class="green-bar" aria-hidden="true"></div>
        </div>

        <div class="photo-grid">
            @foreach ($images as $img)
                <div class="photo main">
                    <img src="{{ asset($img->image_path) }}" alt="Clubhouse Image">
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

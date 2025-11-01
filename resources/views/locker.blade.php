@extends('layouts.app')

@section('title', 'Facilities - Locker Room')

@push('styles')
    <link href="{{ asset('css/locker.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
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
                A premium facility within a golf club designed to provide members and guests with secure storage, comfort,
                and convenience. It typically features personal lockers, showers, grooming areas, and lounges — offering a
                private space for players to prepare before or unwind after a round.
            </p>
            <div class="green-bar" aria-hidden="true"></div>
        </div>

        <div class="photo-grid">
            <div class="photo main"><img src="https://ik.imagekit.io/w87y1vfrm/FACILITIES/LOCKER/Locker1.JPG"
                    alt="Locker"></div>
            <div class="photo main"><img src="https://ik.imagekit.io/w87y1vfrm/FACILITIES/LOCKER/Locker2.JPG"
                    alt="Locker"></div>
            <div class="photo main"><img src="https://ik.imagekit.io/w87y1vfrm/FACILITIES/LOCKER/Locker3.JPG"
                    alt="Locker"></div>
            <div class="photo main"><img src="https://ik.imagekit.io/w87y1vfrm/FACILITIES/LOCKER/Locker4.JPG"
                    alt="Locker"></div>
            <div class="photo main"><img src="https://ik.imagekit.io/w87y1vfrm/FACILITIES/LOCKER/Locker5.JPG"
                    alt="Locker"></div>
            <div class="photo main"><img src="https://ik.imagekit.io/w87y1vfrm/FACILITIES/LOCKER/Locker6.JPG"
                    alt="Locker"></div>
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

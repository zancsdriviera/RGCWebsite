@extends('layouts.app')

@section('title', 'Tournament Gallery')

@push('styles')
    <link href="{{ asset('css/tournamentgal.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">TOURNAMENT GALLERY</h1>
    </div>

    <section class="news-grid">
        <div class="grid" id="newsGrid">
            <!-- Each card-link points to /event-gallery?gallery=<group-id>&open=<index> -->
            <!-- Example: clicking this card opens the 'tournament-list' gallery and auto-opens image 0 -->
            <article class="news-card">
                <a class="card-link" href="{{ route('event.gallery', [], false) }}?gallery=tournament-list&open=0"
                    aria-label="Open Tournament: Pradera Verde">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples1.jpg') }}" alt="Pradera Verde">
                    </div>
                    <div class="content">
                        <h3 class="title">2025 ICTSI PRADERA VERDE CHAMPIONSHIP</h3>
                        <time class="date">May 04, 2025</time>
                    </div>
                </a>
            </article>

            <!-- Another card linking to the same gallery but opening the 2nd image -->
            <article class="news-card">
                <a class="card-link" href="{{ route('event.gallery', [], false) }}?gallery=tournament-list&open=1"
                    aria-label="Open Tournament: Riviera Qualifying School">
                    <div class="media">
                        <img src="{{ asset('images/COURSES/Couples/Couples2.jpg') }}" alt="Riviera Qualifying">
                    </div>
                    <div class="content">
                        <h3 class="title">2025 RIVIERA QUALIFYING SCHOOL</h3>
                        <time class="date">June 04, 2025</time>
                    </div>
                </a>
            </article>

            <!-- Card that opens a different gallery group (veranda) -->
            <article class="news-card">
                <a class="card-link" href="{{ route('event.gallery', [], false) }}?gallery=veranda&open=0"
                    aria-label="Open Facility Veranda">
                    <div class="media">
                        <img src="https://ik.imagekit.io/w87y1vfrm/HOME/Carousel/Home_Image_1.webp" alt="Veranda">
                    </div>
                    <div class="content">
                        <h3 class="title">VERANDA FACILITY</h3>
                        <time class="date">Facility Gallery</time>
                    </div>
                </a>
            </article>
            <!-- Add more cards; change gallery param to group them appropriately -->
        </div>
    </section>
@endsection

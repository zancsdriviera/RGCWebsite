@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@section('content')
    @if ($homepage)
        <div class="main-carousel-wrapper">
            <div id="mainCarousel" class="carousel slide" data-bs-ride="false">
                <div class="carousel-inner">
                    {{-- Carousel 1–3 (cloud effect preserved) --}}
                    @for ($i = 1; $i <= 3; $i++)
                        @php
                            $img = $homepage->{'carousel' . $i};
                            $caption = $homepage->{'carousel' . $i . 'Caption'};
                        @endphp

                        <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                            @if ($i == 1)
                                <!-- Clouds moving left -->
                                <div class="cloud-layer cloud-left layer-1">
                                    <img src="{{ asset('images/HOME/Carousel/Clouds.png') }}" alt="cloud">
                                </div>
                                <div class="cloud-layer cloud-left layer-2">
                                    <img src="{{ asset('images/HOME/Carousel/Clouds.png') }}" alt="cloud">
                                </div>

                                <!-- Clouds moving right -->
                                <div class="cloud-layer cloud-right layer-3">
                                    <img src="{{ asset('images/HOME/Carousel/Clouds.png') }}" alt="cloud">
                                </div>
                                <div class="cloud-layer cloud-right layer-4">
                                    <img src="{{ asset('images/HOME/Carousel/Clouds.png') }}" alt="cloud">
                                </div>
                            @endif

                            <img src="{{ $img ? asset('storage/' . $img) : asset('images/HOME/Carousel/Home_Image_' . $i . '.jpg') }}"
                                class="d-block w-100 carousel-img" alt="Carousel {{ $i }}">

                            @if ($caption)
                                <div class="carousel-caption">
                                    <h3>{{ $caption }}</h3>
                                </div>
                            @endif
                        </div>
                    @endfor

                    @php
                        $dynamicCarousels = json_decode($homepage->dynamic_carousels ?? '[]', true);
                    @endphp

                    @foreach ($dynamicCarousels as $carousel)
                        <div class="carousel-item">
                            <img src="{{ asset('storage/' . $carousel['image']) }}" class="d-block w-100"
                                alt="{{ $carousel['caption'] }}">
                            @if (!empty($carousel['caption']))
                                <div class="carousel-caption">
                                    <h3>{{ $carousel['caption'] }}</h3>
                                </div>
                            @endif
                        </div>
                    @endforeach


                    {{-- Fixed last two carousels (Langer & Couples) --}}
                    @for ($i = 4; $i <= 5; $i++)
                        @php
                            $img = $homepage->{'carousel' . $i};
                            $caption = $homepage->{'carousel' . $i . 'Caption'};
                        @endphp

                        <div class="carousel-item">
                            <div class="carousel-img-wrapper">
                                <img src="{{ $img ? asset('storage/' . $img) : asset('images/HOME/Carousel/Home_Image_' . $i . '.jpg') }}"
                                    class="carousel-img" alt="{{ $i == 4 ? 'Langer' : 'Couples' }}">
                            </div>
                            <div class="carousel-left-caption-wrapper">
                                <h3 class="caption-style text-white">
                                    {{ $i == 4 ? 'Langer Course' : 'Couples Course' }}
                                </h3>
                                <div class="carousel-left-caption">
                                    <p class="caption_description text-white">
                                        {{ $caption ??
                                            ($i == 4
                                                ? 'Known for being one of the toughest courses in the Philippines, this 7,057 yard Par 71 Bernhard Langer signature course will put all the golf skills to test. Built on the hills of Silang Cavite, this course\'s excellent drainage makes it one of the best all-weather courses in the country.'
                                                : 'Designed by everybody\'s favorite golfer Freddie Couples, The Riviera Couples Course is a challenging yet enjoyable layout. This 7,102 yard par 72 course is situated amongst small valleys and ravines making this Silang Cavite course pleasing to the eye, yet dangerous if you lose focus on your game.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        {{-- Cards, headline, subheadline, map, contact info (all untouched) --}}
        <div class="container my-5 text-center">
            @if ($homepage->headline)
                <h2 class="fw-bold text-success">{{ $homepage->headline }}</h2>
            @endif
            @if ($homepage->subheadline)
                <p class="text-muted mb-5">{{ $homepage->subheadline }}</p>
            @endif

            <div class="row g-4 justify-content-center">
                @php
                    $cardIcons = ['bi-flag', 'bi-building', 'bi-calendar-event'];
                    $cardLinks = ['/courses', '/about_us', '/tournamentgal'];
                @endphp

                @for ($i = 1; $i <= 3; $i++)
                    @php
                        $cardImg = $homepage->{'card' . $i . '_image'} ?? "images/HOME/CardImages/Card-image_{$i}.jpg";
                        $cardTitle =
                            $homepage->{'card' . $i . '_title'} ?? ['OUR COURSES', 'CLUB HISTORY', 'EVENTS'][$i - 1];
                        $cardIcon = $cardIcons[$i - 1];
                        $cardLink = $cardLinks[$i - 1];
                    @endphp

                    <div class="col-md-4">
                        <a href="{{ url($cardLink) }}" class="text-decoration-none">
                            <div class="card shadow h-100">
                                <img src="{{ asset('storage/' . $cardImg) }}" class="card-img-top"
                                    alt="{{ $cardTitle }}">
                                <div class="card-body text-center">
                                    <i class="bi {{ $cardIcon }} fs-1 text-success"></i>
                                    <h5 class="mt-3 fw-bold text-dark">{{ $cardTitle }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>

        <div class="container-fluid solid-bg text-center py-4">
            <i class="bi bi-telephone-outbound-fill" style="font-size:17px;"></i>
            <span class="ms-1 d-inline-block">
                For more information, please contact us at (046) 409-1077
            </span>
        </div>

        <!-- Full-width Google Map -->
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3867.3227935694363!2d120.95206706259182!3d14.234382647037595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sRiviera%20Golf%20Club!5e0!3m2!1sen!2sph!4v1756190894108!5m2!1sen!2sph"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        {{-- Map embed from CMS (optional) --}}
        {{-- @if ($homepage->map_embed)
            <div class="map-container">
                {!! $homepage->map_embed !!}
            </div>
        @endif --}}
    @endif
@endsection

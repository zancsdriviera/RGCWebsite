@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Content section -->
    <div class="main-carousel-wrapper">
        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/HOME/Carousel/Home_Image_1.png') }}" class="carousel-img"
                            alt="Golf Course 1">
                    </div>
                    <div class="carousel-caption" id="carousel-title1">
                        <h3>Welcome To Riviera Golf Club</h3>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/HOME/Carousel/Home_Image_2.png') }}" class="d-block w-100 carousel-img"
                            alt="Golf Course 2">
                    </div>
                    <div class="carousel-caption">
                        <h3>Providing Asia's Finest Experience</h3>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/HOME/Carousel/Home_Image_3.jpg') }}" class="d-block w-100 carousel-img"
                            alt="Golf Course 3">
                    </div>
                    <div class="carousel-caption">
                        <h3>Venue of Prestigious Events</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/HOME/Carousel/Home_Image_4.png') }}" class="carousel-img" alt="Langer">
                    </div>
                    <div class="carousel-left-caption-wrapper">
                        <h3 class="caption-style text-white">Langer Course</h3>
                        <div class="carousel-left-caption">
                            <p class="caption_description text-white">
                                Known for being one of the toughest courses in the Philippines, this 7,057 yard Par 71
                                Bernhard Langer signature course will put all the golf skills to test. Built on the
                                hills of Silang Cavite, this course's excellent drainage makes it one of the best
                                all-weather courses in the country.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/HOME/Carousel/Home_Image_5.jpg') }}" class="carousel-img" alt="Couples">
                    </div>
                    <div class="carousel-left-caption-wrapper">
                        <h3 class="caption-style text-white">Couples Course</h3>
                        <div class="carousel-left-caption">
                            <p class="caption_description text-white">
                                Designed by everybody's favorite golfer Freddie Couples, The Riviera Couples Course is a
                                challenging yet enjoyable layout. This 7,102 yard par 72 course is situated amongst
                                small valleys and ravines making this Silang Cavite course pleasing to the eye, yet
                                dangerous if you lose focus on your game.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container my-5 text-center">
        <!-- Section Heading -->
        <h2 class="fw-bold text-success">Riviera Golf Club – Asia’s Best Golf Club</h2>
        <p class="text-muted mb-5">
            Riviera Golf Club is an exciting concept unparalleled in the Philippines for its vision to be among Asia’s
            most outstanding golf courses. This golf club is destined to be a golf Mecca and at the same time providing
            the ultimate in comfort and elegance.
        </p>

        <div class="row g-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-4">
                <a href="{{ url('/courses') }}" class="text-decoration-none">
                    <div class="card shadow h-100">
                        <img src="{{ asset('images/HOME/CardImages/Card-image_1.jpg') }}" class="card-img-top"
                            alt="Our Courses">
                        <div class="card-body text-center">
                            <i class="bi bi-flag fs-1 text-success"></i>
                            <h5 class="mt-3 fw-bold text-dark">OUR COURSES</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <a href="{{ url('/about_us') }}" class="text-decoration-none">
                    <div class="card shadow h-100">
                        <img src="{{ asset('images/HOME/CardImages/Card-image_2.png') }}" class="card-img-top"
                            alt="The Club">
                        <div class="card-body text-center">
                            <i class="bi bi-building fs-1 text-success"></i>
                            <h5 class="mt-3 fw-bold text-dark">CLUB HISTORY</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <a href="{{ url('/tournamentgal') }}" class="text-decoration-none">
                    <div class="card shadow h-100">
                        <img src="{{ asset('images/HOME/CardImages/Card-image_3.png') }}" class="card-img-top"
                            alt="Events">
                        <div class="card-body text-center">
                            <i class="bi bi-calendar-event fs-1 text-success"></i>
                            <h5 class="mt-3 fw-bold text-dark">EVENTS</h5>
                        </div>
                    </div>
                </a>
            </div>
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
@endsection

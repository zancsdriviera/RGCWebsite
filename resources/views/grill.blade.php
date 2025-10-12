@extends('layouts.app')

@section('title', 'Facilities - Grill Room')

@push('styles')
    <link href="{{ asset('css/grill.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush
@section('content')
    <div id="grillroomCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators (bullets) -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#grillroomCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#grillroomCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#grillroomCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#grillroomCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#grillroomCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>

        <!-- Carousel items -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/FACILITIES/GRILLROOM/Slide1.png" class="d-block w-100" alt="Grillroom Slide 1">
            </div>
            <div class="carousel-item">
                <img src="images/FACILITIES/GRILLROOM/Slide2.jpg" class="d-block w-100" alt="Grillroom Slide 2">
            </div>
            <div class="carousel-item">
                <img src="images/FACILITIES/GRILLROOM/Slide3.jpg" class="d-block w-100" alt="Grillroom Slide 3">
            </div>
            <div class="carousel-item">
                <img src="images/FACILITIES/GRILLROOM/Slide4.jpg" class="d-block w-100" alt="Grillroom Slide 4">
            </div>
            <div class="carousel-item">
                <img src="images/FACILITIES/GRILLROOM/Slide5.jpg" class="d-block w-100" alt="Grillroom Slide 5">
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#grillroomCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#grillroomCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <section class="menu-section py-5">
        <div class="container">
            <!-- header with horizontal rules -->
            <div class="menu-header d-flex align-items-center justify-content-center mb-4">
                <div class="header-line"></div>
                <h2 class="mx-3">MENU</h2>
                <div class="header-line"></div>
            </div>

            <!-- grid -->
            <div class="row g-4">
                <!-- item 1 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <figure class="menu-card text-center">
                        <div class="menu-img-wrap mx-auto">
                            <img src="images/FACILITIES/GRILLROOM/Card1.png" alt="Seafood Ala Pobre" class="menu-img">
                        </div>
                        <figcaption class="mt-3">
                            <h3 class="menu-title">Seafood Ala Pobre</h3>
                            <div class="menu-price">₱380.00</div>
                        </figcaption>
                    </figure>
                </div>

                <!-- item 2 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <figure class="menu-card text-center">
                        <div class="menu-img-wrap mx-auto">
                            <img src="images/FACILITIES/GRILLROOM/Card2.png" alt="Riviera Fried Chicken" class="menu-img">
                        </div>
                        <figcaption class="mt-3">
                            <h3 class="menu-title">Riviera Fried Chicken</h3>
                            <div class="menu-price">₱470.00</div>
                        </figcaption>
                    </figure>
                </div>

                <!-- item 3 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <figure class="menu-card text-center">
                        <div class="menu-img-wrap mx-auto">
                            <img src="images/FACILITIES/GRILLROOM/Card3.png" alt="Garlic Rice" class="menu-img">
                        </div>
                        <figcaption class="mt-3">
                            <h3 class="menu-title">Garlic Rice (Medium)</h3>
                            <div class="menu-price">₱105.00</div>
                        </figcaption>
                    </figure>
                </div>

                <!-- item 4 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <figure class="menu-card text-center">
                        <div class="menu-img-wrap mx-auto">
                            <img src="images/FACILITIES/GRILLROOM/Card4.png" alt="Nilagang Tadyang ng Baka"
                                class="menu-img">
                        </div>
                        <figcaption class="mt-3">
                            <h3 class="menu-title">Nilagang Tadyang Ng Baka</h3>
                            <div class="menu-price">₱500.00</div>
                        </figcaption>
                    </figure>
                </div>

                <!-- item 5 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <figure class="menu-card text-center">
                        <div class="menu-img-wrap mx-auto">
                            <img src="images/FACILITIES/GRILLROOM/Card5.png" alt="Crispy Pata" class="menu-img">
                        </div>
                        <figcaption class="mt-3">
                            <h3 class="menu-title">Crispy Pata</h3>
                            <div class="menu-price">₱1,060.00</div>
                        </figcaption>
                    </figure>
                </div>

                <!-- item 6 -->
                <div class="col-12 col-sm-6 col-md-4">
                    <figure class="menu-card text-center">
                        <div class="menu-img-wrap mx-auto">
                            <img src="images/FACILITIES/GRILLROOM/Card6.png" alt="Japanese Fried Rice" class="menu-img">
                        </div>
                        <figcaption class="mt-3">
                            <h3 class="menu-title">Japanese Fried Rice</h3>
                            <div class="menu-price">₱1,060.00</div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
@endsection

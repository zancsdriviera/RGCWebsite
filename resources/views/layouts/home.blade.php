<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Link to your external CSS file -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

</head>

<body>
    <!-- Top contact bar -->
    <div class="top-contact-bar d-flex justify-content-end align-items-center py-1 px-3" style="background:#256335;">
        <div>
            <i class="bi bi-telephone-fill"></i>
            <span class="ms-1">(046) 409-1077</span>
            <a href="https://www.facebook.com/RivieraGolfPH" class="text-white social-icon"><i
                    class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/rivieragolfph/" class="text-white social-icon"><i
                    class="bi bi-instagram"></i></a>
            <a href="https://www.youtube.com/@RivieraGolfClubInc." class="text-white social-icon"><i
                    class="bi bi-youtube"></i></a>
        </div>
    </div>

    <!-- Main navbar -->
    <nav class="navbar navbar-expand-lg navbar-light main-navbar px-3">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera Golf Club" height="100" class="me-2">
            <span class="brand-text">RIVIERA GOLF CLUB</span>
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>


        <!-- Menu links with proper spacing -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ url('/home') }}">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/about_us') }}">ABOUT US</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/courses') }}">COURSES</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/membership') }}">MEMBERSHIP</a></li>
                <!-- Change this line in your navbar -->
                <li class="nav-item dropdown position-relative">
                    <!-- Add data-bs-toggle="dropdown" and change href to # -->
                    <a class="nav-link" href="#" id="facilitiesDropdown">
                        FACILITIES
                    </a>

                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="facilitiesDropdown">
                        <div class="d-flex">
                            <!-- Premium column -->
                            <div class="me-4">
                                <h6 class="dropdown-header facilities_header">CLUB FACILITIES</h6>
                                <a class="dropdown-item" href="#" data-facility="premium-1">GOLF CLUB
                                    HOUSE</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-2">DRIVING
                                    RANGE
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-3">PROSHOP
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-3">MEN'S AND
                                    LADIES LOCKER ROOMS
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-3">MEMBERS
                                    LOUNGE
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-3">LOBBY
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-3">VERANDA
                                </a>
                            </div>

                            <!-- Deluxe column -->
                            <div>
                                <h6 class="dropdown-header facilities_header">RESTAURANT</h6>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="deluxe-1">GRILLROOM
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="deluxe-2">TEEHOUSE
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown position-relative">
                    <!-- Add data-bs-toggle="dropdown" and change href to # -->
                    <a class="nav-link" href="{{ url('/announcement') }}" id="announcementDropdown"
                        data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        ANNOUNCEMENT
                    </a>

                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="announcementDropdown">
                        <div class="d-flex">
                            <!-- Premium column -->
                            <div class="me-4">
                                <a class="dropdown-item" href="{{ url('/announcement') }}"
                                    data-facility="premium-1">TOURNAMENTS AND EVENTS
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-2">COUSE
                                    SCHEDULE
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-3">LIVE
                                    SCORE
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown position-relative">
                    <!-- Add data-bs-toggle="dropdown" and change href to # -->
                    <a class="nav-link" href="{{ url('/rates') }}" id="ratesDropdown" data-bs-toggle="dropdown"
                        role="button" aria-expanded="false">
                        RATES
                    </a>
                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="ratesDropdown">
                        <div class="d-flex">
                            <!-- Premium column -->
                            <div class="me-4">
                                <a class="dropdown-item" href="{{ url('/rates') }}" data-facility="premium-1">LEAN
                                    SEASON
                                </a>
                                <a class="dropdown-item" href="{{ url('/rates2') }}" data-facility="premium-2">PEAK
                                    SEASON
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
                <li class="nav-item dropdown position-relative">
                    <!-- Add data-bs-toggle="dropdown" and change href to # -->
                    <a class="nav-link" href="{{ url('/contact_us') }}" id="contactsDropdown"
                        data-bs-toggle="dropdown" role="button" aria-expanded="false">
                        CONTACT US
                    </a>
                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="contactsDropdown">
                        <div class="d-flex">
                            <!-- Premium column -->
                            <div class="me-4">
                                <a class="dropdown-item" href="{{ url('/contact_us') }}"
                                    data-facility="premium-1">CONTACT DETAILS
                                </a>
                                <a class="dropdown-item" href="{{ url('/contact_us_2') }}"
                                    data-facility="premium-1">CAREERS
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content section -->
    <div class="main-carousel-wrapper">
        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/HOME/Carousel/Home_Image_1.png') }}" class="carousel-img"
                            alt="Golf Course 1">
                    </div>
                    <div class="carousel-caption">
                        <h3>Welcome To Riviera Golf Club</h3>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/HOME/Carousel/Home_Image_2.png') }}"
                            class="d-block w-100 carousel-img" alt="Golf Course 2">
                    </div>
                    <div class="carousel-caption">
                        <h3>Providing Asia's Finest Experience</h3>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/HOME/Carousel/Home_Image_3.jpg') }}"
                            class="d-block w-100 carousel-img" alt="Golf Course 3">
                    </div>
                    <div class="carousel-caption">
                        <h3>Venue of Prestigious Events</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img-wrapper">
                        <img src="{{ asset('images/HOME/Carousel/Home_Image_4.png') }}" class="carousel-img"
                            alt="Langer">
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
                        <img src="{{ asset('images/HOME/Carousel/Home_Image_5.jpg') }}" class="carousel-img"
                            alt="Couples">
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
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel"
                data-bs-slide="next">
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

        <!-- Cards Row -->
        <div class="row g-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <img src="{{ asset('images/HOME/CardImages/Card-image_1.jpg') }}" class="card-img-top"
                        alt="Our Courses">
                    <div class="card-body text-center">
                        <i class="bi bi-flag fs-1 text-success"></i>
                        <h5 class="mt-3 fw-bold">OUR COURSES</h5>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <img src="{{ asset('images/HOME/CardImages/Card-image_2.png') }}" class="card-img-top"
                        alt="The Club">
                    <div class="card-body text-center">
                        <i class="bi bi-building fs-1 text-success"></i>
                        <h5 class="mt-3 fw-bold">THE CLUB</h5>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <img src="{{ asset('images/HOME/CardImages/Card-image_3.png') }}" class="card-img-top"
                        alt="Events">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-event fs-1 text-success"></i>
                        <h5 class="mt-3 fw-bold">EVENTS</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid custom-bg text-center py-2">
        <i class="bi bi-telephone-outbound-fill" style="font-size: 24px;"></i>
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
    <!-- Footer -->
    <footer class="bg-dark text-white pt-4 pb-2">
        <div class="container">
            <!-- Title -->
            <div class="text-center mb-4">
                <h1 style="font-family: Lato, sans-serif; font-weight: 700;">Riviera Golf Club</h1>
            </div>

            <!-- Main Row -->
            <div class="d-flex justify-content-center align-items-center flex-wrap gap-5 text-center text-md-start">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <!-- Logo -->
                    <div class="me-3">
                        <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera Logo"
                            style="max-width:120px;">
                    </div>
                    <!-- Contact Info -->
                    <div>
                        <p><i class="bi bi-telephone"></i> (046) 409-1077</p>
                        <p><i class="bi bi-geo-alt"></i> RIVIERA GOLF CLUB<br>
                            By pass Road Aguinaldo Highway<br>
                            Silang, Cavite, Philippines, 4118
                        </p>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="d-flex align-items-center d-none d-md-flex">
                    <div>
                        <p>
                            <i class="bi bi-facebook"></i>
                            <a href="https://facebook.com/rivieragolfph" target="_blank"
                                class="text-white text-decoration-none">
                                facebook.com/rivieragolfph
                            </a>
                        </p>
                        <p>
                            <i class="bi bi-instagram"></i>
                            <a href="https://instagram.com/rivieragolfph" target="_blank"
                                class="text-white text-decoration-none">
                                instagram.com/rivieragolfph
                            </a>
                        </p>
                        <p>
                            <i class="bi bi-youtube"></i>
                            <a href="https://youtube.com/rivieragolfph" target="_blank"
                                class="text-white text-decoration-none">
                                youtube.com/rivieragolfph
                            </a>
                        </p>
                    </div>
                </div>
            </div> <!-- ✅ CLOSE flex container here -->

            <!-- Divider -->
            <hr class="border-light my-3">

            <!-- Copyright -->
            <div class="text-center">
                <p class="mb-0"><i class="bi bi-c-circle"></i> Copyright Riviera Golf Club</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

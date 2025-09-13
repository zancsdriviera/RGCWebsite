<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <!-- Link to your external CSS file -->
    <link href="{{ asset('css/about_us.css') }}" rel="stylesheet">
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu links with proper spacing -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">HOME</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ url('/about_us') }}">ABOUT US</a></li>
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
                    <a class="nav-link" href="#" id="announcementDropdown">
                        ANNOUNCEMENT
                    </a>
                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="announcementDropdown">
                        <div class="d-flex">
                            <!-- Premium column -->
                            <div class="me-4">
                                <a class="dropdown-item" href="{{ url('/tournamentgal') }}"
                                    data-facility="premium-1">TOURNAMENTS AND EVENTS
                                </a>
                                <a class="dropdown-item" href="{{ url('/coursesched') }}"
                                    data-facility="premium-2">COUSE
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
                    <a class="nav-link" href="#" id="ratesDropdown">
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
                                <a class="dropdown-item" href="{{ url('/tournament_rates') }}"
                                    data-facility="premium-2">TOURNAMENT RATES
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/faq') }}">FAQ</a></li>
                <li class="nav-item dropdown position-relative">
                    <!-- Add data-bs-toggle="dropdown" and change href to # -->
                    <a class="nav-link" href="#" id="contactsDropdown" data-bs-toggle="dropdown"
                        role="button" aria-expanded="false">
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
    <div class="container-fluid custom-bg text-center d-flex align-items-center justify-content-center">
        <h1 class="text-white">ABOUT US</h1>
    </div>

    <div class="profile_container container my-5">
        <div class="row align-items-center">
            <!-- Left side: caption + description -->
            <div class="col-md-6">
                <h2 class="mb-3">Club Profile</h2>
                <p>
                    Our Club is an exciting concept unparalleled in the Philippines for its vision to be among Asia’s
                    most outstanding golf courses. The Riviera is destined to be a golf Mecca, while providing at the
                    same time the ultimate in comfort and elegance. Situated amidst the breathtaking landscape of cool
                    Silang, Cavite, The Riviera is the ideal golf course for all ages and skills. At 1,000 feet above
                    sea level, Riviera Golf Club is both nature’s beauty and a golfer’s dream course. Just about an
                    hour-drive from Makati, it is the nearest coolest golf haven accessible to major population centers
                    in Metropolitan Manila.
                </p>
            </div>
            <!-- Right side: image -->
            <div class="col-md-6 text-center">
                <img src="/images/ABOUT_US/ClubProfileImage.png" class="img-fluid rounded shadow" alt="About Golf">
            </div>
        </div>
    </div>

    <div class="container-fluid my-0 mission_container">
        <div class="row align-items-stretch">
            <!-- Left side: image -->
            <div class="col-md-6 p-0">
                <img src="/images/ABOUT_US/DrivingRange.png" class="img-fluid w-100 h-100" style="object-fit: cover;"
                    alt="Clubhouse">
            </div>

            <!-- Right side: solid color with text -->
            <div class="MV_caption col-md-6 text-center text-white p-5 d-flex flex-column justify-content-center"
                style="background-color: #256335;">
                <h2 class="mb-3">Our Mission</h2>
                <p>
                    With uniquely designed Championship Golf Courses, we provide world-class facilities & services:
                </p>
                <p class="text-start">We are committed to ensure premium year-round playing conditions while protecting
                    our environment.
                </p>
                <ul class="text-start">
                    <li>We provide friendly, efficient and personalized service to Members, guests and their families.
                    </li>
                    <li>We promote business, social and leisure opportunities through tournaments and special events.
                    </li>
                    <li>We serve quality food and beverage to the delight of our Members, visitors and guests.</li>
                    <li>We are committed to sustain our corporate social responsibility.</li>
                </ul>
                <p>Together we create an atmosphere and experience that is distinctly THE RIVIERA.</p>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-5 vision_container">
        <div class="row">
            <!-- Left side: solid color with text -->
            <div class="MV_caption col-md-6 text-center text-white p-5 d-flex flex-column justify-content-center"
                style="background-color: #256335;">
                <h2 class="mb-3">Our Vision</h2>
                <p>
                    A world-class Golf Club and a preferred venue of prestigious Events providing Asia’s finest golfing
                    experience.
                </p>
            </div>
            <!-- Right side: image -->
            <div class="col-md-6 p-0">
                <img src="/images/ABOUT_US/RivieraStoneImage.png" class="img-fluid w-100 h-100"
                    style="object-fit: cover;" alt="Clubhouse">
            </div>
        </div>
    </div>

    <div class="board_caption my-0 text-center">
        <!-- Section Header -->
        <h2 class="board-title">BOARD OF DIRECTORS</h2>
        <p class="text-muted mb-4">2024-2025</p>

        <!-- Cards Row  First-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Legaspi.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">LEGASPI, NORMAN C.</h5>
                        <p class="card-text" style="color: white">CHAIRMAN</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Kawamura.png" class="card-img-top rounded-0" alt="Director 2">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">KAWAMURA, TAKUYA</h5>
                        <p class="card-text" style="color: white">VICE CHAIRMAN</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Escalona.png" class="card-img-top rounded-0" alt="Director 3">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">ESCALONA, ALEX L.</h5>
                        <p class="card-text" style="color: white">PRESIDENT</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Second-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Crisostomo.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">CRISOSTOMO, JOSE M.</h5>
                        <p class="card-text" style="color: white">VICE PRESIDENT</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Balboa.png" class="card-img-top rounded-0" alt="Director 2">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">BALBOA, JAY SEBASTIAN L.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Carranza.png" class="card-img-top rounded-0" alt="Director 3">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">CARRANZA, EDWARD E.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Third-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Conception.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">CONCEPCION, FLORIAN O.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Hwang.png" class="card-img-top rounded-0" alt="Director 2">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">HWANG, JEONG SOON</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Mateo.png" class="card-img-top rounded-0" alt="Director 3">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">MATEO, ORLANDO M.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Fourth-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Rapadas.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">RAPADAS, ROBERTO R.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Valencia.png" class="card-img-top rounded-0" alt="Director 2">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">VALENCIA, RAFAEL C.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Fernandez.png" class="card-img-top rounded-0" alt="Director 3">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">ATTY. FERNANDEZ, CHRISTOPHER REY L.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Row  Fifth-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BOD/Ilagan.png" class="card-img-top rounded-0" alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">ATTY. ILAGAN JR., ANGEL SEVERINO RAUL B.</h5>
                        <p class="card-text" style="color: white">MEMBER</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom facility container -->
    <div class="container-fluid bot_container py-5">
        <div class="container">
            <p class="caption_txt text-center mb-5 ">WITH UNIQUELY DESIGNED CHAMPIONSHIP GOLF COURSES, WE PROVIDE WORLD
                CLASS
                FACILITIES AND SERVICES</p>
            <div class="row align-items-center">
                <!-- Left side - Bullet points -->
                <div class="col-md-6">
                    <ul>
                        <li>We are committed to ensure premium year-round playing conditions while protecting our
                            environment.</li>
                        <li>We provide friendly, efficient and personalized service to members, guests and their
                            families.</li>
                        <li>We promote business, social and leisure opportunities through tournaments and special
                            events.</li>
                        <li>We serve quality food and beverage to the delight of our members, visitors and guests.</li>
                        <li>We are committed to sustain our corporate social responsibility.</li>
                        <li>Together, we create an atmosphere and experience that is distinctly RIVIERA.</li>
                    </ul>
                </div>

                <!-- Right side - Image -->
                <div class="col-md-6 text-center">
                    <img src="/images/ABOUT_US/bottomImage.png" class="img-fluid" alt="Mission Image">
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center bottom_card">
        <!-- Cards Row  First-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/Lobby.png" class="card-img-top rounded-0"
                        alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">RIVIERA VISION</h5>
                        <p class="card-text">A world-class golf club and a preferred venue of
                            prestigious events, providing Asia’s finest golfing experience.</p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/Team1.png" class="card-img-top rounded-0"
                        alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">CORE VALUES</h5>
                        <p class="card-text">In undertaking our mission, we uphold the following values:</p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/Team2.png" class="card-img-top rounded-0"
                        alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">MORAL UPRIGHTNESS</h5>
                        <p class="card-text">We are guided by a high sense of integrity and fairness.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cards Row  Second-->
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/Team3.png" class="card-img-top rounded-0"
                        alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">EXCELLENCE</h5>
                        <p class="card-text">We provide quality and value in our products and services, consistent with
                            the expectation of our members.</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/Team4.png" class="card-img-top rounded-0"
                        alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">TEAMWORK</h5>
                        <p class="card-text">We are highly motivated and well-organized, working for a common goal.</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-0">
                    <img src="/images/ABOUT_US/BottomCards/GrillRoom.png" class="card-img-top rounded-0"
                        alt="Director 1">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white">SOCIAL RESPONSIBILITY
                        </h5>
                        <p class="card-text">We are a responsible corporate member of society.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="board_caption my-0 text-center">
        <!-- Section Header -->
        <h2 class="gallery-title">GALLERY</h2>
    </div>

    <div class="gallery_container px-3 "> <!-- gap on left and right -->
        <div class="row g-0"> <!-- no gap between images -->
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal1.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal2.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal3.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal4.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <div class="gallery_container px-3 "> <!-- gap on left and right -->
        <div class="row g-0"> <!-- no gap between images -->
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal5.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal6.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal7.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal8.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    <div class="gallery_container px-3 "> <!-- gap on left and right -->
        <div class="row g-0"> <!-- no gap between images -->
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal9.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal10.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal11.png" class="img-fluid" alt="">
            </div>
            <div class="col-6 col-lg-3">
                <img src="images/ABOUT_US/Gallery/Gal12.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>

    <!-- Footer snippet -->
    <footer class="rgc-footer">
        <div class="rgc-wrap">
            <h1 class="rgc-title">Riviera Golf Club</h1>
            <div class="rgc-grid">
                <!-- 1) Logo -->
                <div class="rgc-col logo-col">
                    <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera logo" class="rgc-logo">
                </div>
                <!-- 2) Contact -->
                <div class="rgc-col">
                    <div>
                        <p><i class="bi bi-telephone"></i> (046) 409-1077</p>
                        <p><i class="bi bi-geo-alt"></i> RIVIERA GOLF CLUB<br>
                            By pass Road Aguinaldo Highway<br>
                            Silang, Cavite, Philippines, 4118
                        </p>
                    </div>
                </div>
                <!-- 3) Social -->
                <div class="rgc-col">
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
                <!-- 4) Corporate Governance -->
                <div class="rgc-col">
                    <p class="col-line governance">
                        <i class="bi bi-bank"></i>
                        <a href="your-link-here" class="nowrap">Corporate Governance</a>
                    </p>
                </div>
            </div>
            <hr class="rgc-divider">
            <div class="rgc-copy">
                <span class="copy-badge">©</span>
                <span>Copyright Riviera Golf Club</span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

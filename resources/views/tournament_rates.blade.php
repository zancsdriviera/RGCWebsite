<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Rates</title>

    <!-- Link to your external CSS file -->
    <link href="{{ asset('css/tournament_rates.css') }}" rel="stylesheet">
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
                <li class="nav-item"><a class="nav-link " href="{{ url('/about_us') }}">ABOUT US</a></li>
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
                                <a class="dropdown-item" href="{{ url('/drivingrange') }}"
                                    data-facility="premium-2">DRIVING
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
                                <a class="dropdown-item" href="{{ url('/facilities') }}" data-facility="premium-3">LOBBY
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
                    <a class="nav-link active" href="#" id="ratesDropdown">
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
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">RATES</h1>
    </div>

    <div class="top_caption my-0 text-center">
        <h2 class="top-title">TOURNAMENT RATES</h2>
    </div>

    <div class="pricing-container">
        <!-- Peak Season -->
        <div class="pricing-box">
            <div class="pricing-header">
                <h2>PEAK SEASON</h2>
                <p>(NOV–MAR)</p>
            </div>
            <ul class="pricing-list">
                <li>
                    <span class="label">GREEN FEE
                        <span class="desc">
                            (min. gtd guest)
                        </span>
                    </span>
                    <span class="price">
                        PHP 3,500.00 – 20 pax<br>
                        PHP 3,350.00 – 40 pax<br>
                        PHP 3,200.00 – 60 pax<br>
                        PHP 3,050.00 – 80 pax<br>
                        PHP 2,900.00 – 100 pax
                    </span>
                </li>
                <li>
                    <span class="label">SCORING FEE
                        <span class="desc">
                            (Optional)
                        </span>
                    </span>
                    <span class="price">PHP 3,000.00</span>
                </li>
                <li>
                    <span class="label">CADDIE FEE / MARKERS FEE
                        <span class="desc">
                            (Must be paid in CASH on functional day)
                        </span>
                    </span>
                    <span class="price">PHP 600.00</span>
                </li>
                <li>
                    <span class="label">GOLF CART RENTAL<br>(18-HOLES)
                        <span class="desc">
                            Note: 2 carts per flight for shotgun<br>
                            tournament charged to organizer
                        </span></span>
                    <span class="price">PHP 1,000.00</span>
                </li>
                <li>
                    <span class="label">HOLE-IN-ONE FUND</span>
                    <span class="price">PHP 100.00</span>
                </li>
                <li>
                    <span class="label">SPORTS DEVELOPMENT FUND</span>
                    <span class="price">PHP 100.00</span>
                </li>
                <li>
                    <span class="label">ENVIRONMENTAL FUND</span>
                    <span class="price">PHP 20.00</span>
                </li>
                <li>
                    <span class="label">
                        FOOD & BEVERAGE
                        <span class="desc">
                            Set Lunch<br>
                            Buffet Menu (min. 50 pax)<br>
                            F&B Consumables per player if<br>
                            NO F&B Arrangement
                        </span>
                    </span>

                    <span class="price">
                        {{-- PHP 400.00 – 550.00<br>
                        PHP 700.00 – 1,000.00<br> --}}
                    </span>
                </li>
            </ul>
        </div>
        <!-- Non-Peak Season -->
        <div class="pricing-box">
            <div class="pricing-header">
                <h2>NON-PEAK SEASON</h2>
                <p>(APR–OCT)</p>
            </div>
            <ul class="pricing-list">
                <li>
                    <span class="label">GREEN FEE
                        <span class="desc">
                            (min. gtd guest)
                        </span>
                    </span>
                    <span class="price">
                        PHP 2,500.00 – 20 pax<br>
                        PHP 2,400.00 – 40 pax<br>
                        PHP 2,300.00 – 60 pax<br>
                        PHP 2,200.00 – 80 pax<br>
                        PHP 2,100.00 – 100 pax
                    </span>
                </li>
                <li>
                    <span class="label">SCORING FEE
                        <span class="desc">
                            (Optional)
                        </span>
                    </span>
                    <span class="price">PHP 3,000.00</span>
                </li>
                <li>
                    <span class="label">CADDIE FEE / MARKERS FEE
                        <span class="desc">
                            (Must be paid in CASH on functional day)
                        </span>
                    </span>
                    <span class="price">PHP 600.00</span>
                </li>
                <li>
                    <span class="label">GOLF CART RENTAL<br>(18-HOLES)
                        <span class="desc">
                            Note: 2 carts per flight for shotgun<br>
                            tournament charged to organizer
                        </span></span>
                    <span class="price">PHP 1,000.00</span>
                </li>
                <li>
                    <span class="label">HOLE-IN-ONE FUND</span>
                    <span class="price">PHP 100.00</span>
                </li>
                <li>
                    <span class="label">SPORTS DEVELOPMENT FUND</span>
                    <span class="price">PHP 100.00</span>
                </li>
                <li>
                    <span class="label">ENVIRONMENTAL FUND</span>
                    <span class="price">PHP 20.00</span>
                </li>
                <li>
                    <span class="label">
                        FOOD & BEVERAGE
                        <span class="desc">
                            Set Lunch<br>
                            Buffet Menu (min. 50 pax)<br>
                            F&B Consumables per player if<br>
                            NO F&B Arrangement
                        </span>
                    </span>

                    <span class="price">
                        {{-- PHP 400.00 – 550.00<br>
                        PHP 700.00 – 1,000.00<br> --}}
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center gx-2">
            <!-- Column 1 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <h2 class="bot-title">CLICK TO DOWNLOAD THE PDF</h2>
                    <div>
                        <i class="bi bi-download me-2"></i>
                        <a href="/downloads/endorsement-letter.pdf" target="_blank">TOURNAMENT BOOKING FORM 2025
                            PAGE1</a>
                    </div>
                    <div>
                        <i class="bi bi-download me-2"></i>
                        <a href="/downloads/endorsement-letter.pdf" target="_blank">TOURNAMENT BOOKING FORM 2025
                            PAGE2</a>
                    </div>
                    <div>
                        <i class="bi bi-download me-2"></i>
                        <a href="/downloads/endorsement-letter.pdf" target="_blank">TOURNAMENT BOOKING FORM 2025
                            PAGE3</a>
                    </div>
                </div>
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

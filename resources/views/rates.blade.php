<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <!-- Link to your external CSS file -->
    <link href="{{ asset('css/rates.css') }}" rel="stylesheet">
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
                    <a class="nav-link" href="{{ url('/announcement') }}" id="announcementDropdown">
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
                    <a class="nav-link" href="#" id="ratesDropdown">
                        RATES
                    </a>
                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="ratesDropdown">
                        <div class="d-flex">
                            <!-- Premium column -->
                            <div class="me-4">
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-1">LEAN
                                    SEASON
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-2">PEAK
                                    SEASON
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
                <li class="nav-item dropdown position-relative">
                    <!-- Add data-bs-toggle="dropdown" and change href to # -->
                    <a class="nav-link active" href="{{ url('/contact_us') }}" id="contactsDropdown">
                        CONTACT US
                    </a>
                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="contactsDropdown">
                        <div class="d-flex">
                            <!-- Premium column -->
                            <div class="me-4">
                                <a class="dropdown-item active" href="{{ url('/contact_us') }}"
                                    data-facility="premium-2">CONTACT
                                    DETAILS
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" data-facility="premium-3">CAREERS
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

    <!-- Golf Rates Section -->
    <section class="rates-section my-5">
        <div class="container">
            <div class="text-center mb-4">
                <h3 class="rates-title">RIVIERA GOLF CLUB INC.</h3>
                <h2 class="rates-heading">GOLF RATES</h2>
                <p class="rates-sub">LEAN SEASON (APRIL - OCTOBER 2025)</p>
            </div>

            <div class="row gx-4 justify-content-center ">
                <!-- Card A -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="rate-card">
                        <div class="rate-badge">REGULAR<br>WEEKDAY</div>

                        <div class="price-bar">
                            <div class="price">₱3,070.00</div>
                        </div>

                        <div class="rate-body">
                            <ul class="fee-list">
                                <li><span class="fee-label">Green Fee</span><span class="fee-amount">₱ 2,500.00</span>
                                </li>
                                <li><span class="fee-label">F&B Consumable</span><span class="fee-amount">₱
                                        350.00</span></li>
                                <li><span class="fee-label">Hole-In-One Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Sports Devt Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Golfer's Environmental Fee</span><span
                                        class="fee-amount">₱ 20.00</span></li>
                            </ul>

                            <div class="rate-cta">
                                <button class="btn-ghost">BEFORE 9AM</button>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Card B -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="rate-card">
                        <div class="rate-badge">REGULAR<br>WEEKDAY</div>

                        <div class="price-bar">
                            <div class="price">₱2,420.00</div>
                        </div>

                        <div class="rate-body">
                            <ul class="fee-list">
                                <li><span class="fee-label">Green Fee</span><span class="fee-amount">₱ 1,850.00</span>
                                </li>
                                <li><span class="fee-label">F&B Consumable</span><span class="fee-amount">₱
                                        350.00</span></li>
                                <li><span class="fee-label">Hole-In-One Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Sports Devt Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Golfer's Environmental Fee</span><span
                                        class="fee-amount">₱ 20.00</span></li>
                            </ul>

                            <div class="rate-cta">
                                <button class="btn-ghost">AFTER 9AM</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="text-center mb-4">
                <h3 class="rates-title">SENIOR DISCOUNT</h3>
                <p class="rates-sub1">50% SENIOR DISCOUNT ON GREEN FEES APPLICABLE ON WEEKDAYS ONLY FOR GUESTS WITH
                    SENIOR CARE ID/FPASGI ACCOMPANIED BY MEMBER ONLY.</p>
            </div>

            <div class="row gx-4 justify-content-center ">
                <!-- Card A -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="rate-card">
                        <div class="rate-badge">REGULAR<br>WEEKDAY</div>

                        <div class="price-bar">
                            <div class="price">₱3,070.00</div>
                        </div>

                        <div class="rate-body">
                            <ul class="fee-list">
                                <li><span class="fee-label">Green Fee</span><span class="fee-amount">₱ 2,500.00</span>
                                </li>
                                <li><span class="fee-label">F&B Consumable</span><span class="fee-amount">₱
                                        350.00</span></li>
                                <li><span class="fee-label">Hole-In-One Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Sports Devt Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Golfer's Environmental Fee</span><span
                                        class="fee-amount">₱ 20.00</span></li>
                            </ul>

                            <div class="rate-cta">
                                <button class="btn-ghost">BEFORE 9AM</button>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Card B -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="rate-card">
                        <div class="rate-badge">REGULAR<br>WEEKDAY</div>

                        <div class="price-bar">
                            <div class="price">₱2,420.00</div>
                        </div>

                        <div class="rate-body">
                            <ul class="fee-list">
                                <li><span class="fee-label">Green Fee</span><span class="fee-amount">₱ 1,850.00</span>
                                </li>
                                <li><span class="fee-label">F&B Consumable</span><span class="fee-amount">₱
                                        350.00</span></li>
                                <li><span class="fee-label">Hole-In-One Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Sports Devt Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Golfer's Environmental Fee</span><span
                                        class="fee-amount">₱ 20.00</span></li>
                            </ul>

                            <div class="rate-cta">
                                <button class="btn-ghost">AFTER 9AM</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

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

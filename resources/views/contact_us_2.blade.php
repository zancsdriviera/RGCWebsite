<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers</title>

    <!-- Link to your external CSS file -->
    <link href="{{ asset('css/contact_us_2.css') }}" rel="stylesheet">
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
                    <a class="nav-link" href="{{ url('/rates') }}" id="ratesDropdown">
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
                    <a class="nav-link active" href="{{ url('/contact_us') }}" id="contactsDropdown">
                        CONTACT US
                    </a>
                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="contactsDropdown">
                        <div class="d-flex">
                            <!-- Premium column -->
                            <div class="me-4">
                                <a class="dropdown-item" href="{{ url('/contact_us') }}"
                                    data-facility="premium-2">CONTACT
                                    DETAILS
                                </a>
                                <a class="dropdown-item active" href="{{ url('/contact_us_2') }}"
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
        <h1 class="text-white custom-title m-0">CONTACT US</h1>
    </div>

    <!-- Title section (unchanged) -->
    <div class="top_caption my-0 text-center">
        <h2 class="top-title">WE ARE HIRING</h2>
    </div>

    <div class="carousel-wrapper">
        <div class="carousel-container">
            <button class="carousel-btn prev" aria-label="Previous">&#10094;</button>

            <div class="carousel-viewport">
                <div class="carousel-track">
                    <!-- Duplicate this article as many times as you need -->
                    <article class="job-card">
                        <header class="jc-header">
                            <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera logo" class="jc-logo">
                            <div class="jc-title">
                                <h1>WE ARE HIRING</h1>
                                <p>We're looking for someone to join our company as a</p>
                                <div class="position-pill">
                                    <svg viewBox="0 0 24 24" class="mag" aria-hidden="true">
                                        <path
                                            d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 1 0 14 15.5l.27.28v.79L20 21.49 21.49 20 15.5 14z" />
                                    </svg>
                                    <span>INTERNAL AUDIT MANAGER</span>
                                </div>
                            </div>
                        </header>

                        <section class="qualifications">
                            <h2>Qualifications:</h2>
                            <div class="qual-grid">
                                <ul>
                                    <li>Graduate of Bachelor's Degree in Accountancy</li>
                                    <li>Must be a Certified Public Accountant (CPA) with an updated PRC license</li>
                                    <li>Proven work experience as an Internal Audit Manager</li>
                                    <li>Excellent written and communication skills</li>
                                </ul>
                                <ul>
                                    <li>Flexibility to work on weekends</li>
                                    <li>Strong leadership skills</li>
                                    <li>Must be able to multitask and can adapt to fast paced environment</li>
                                    <li>Computer literate</li>
                                    <li>Can start ASAP</li>
                                </ul>
                            </div>
                        </section>

                        <section class="apply">
                            <p class="call">If you have the skills and experience required, we want to hear from you!
                            </p>
                            <p class="email">recruitment@rivieragolfclub.ph</p>
                            <div class="apply-now">
                                <a href="mailto:recruitment@rivieragolfclub.ph">APPLY NOW!</a>
                            </div>

                        </section>
                    </article>
                    <article class="job-card">
                        <header class="jc-header">
                            <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera logo" class="jc-logo">
                            <div class="jc-title">
                                <h1>WE ARE HIRING</h1>
                                <p>We're looking for someone to join our company as a</p>
                                <div class="position-pill">
                                    <svg viewBox="0 0 24 24" class="mag" aria-hidden="true">
                                        <path
                                            d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 1 0 14 15.5l.27.28v.79L20 21.49 21.49 20 15.5 14z" />
                                    </svg>
                                    <span>ACCOUNTANT</span>
                                </div>
                            </div>
                        </header>

                        <section class="qualifications">
                            <h2>Qualifications:</h2>
                            <div class="qual-grid">
                                <ul>
                                    <li>Graduate of Bachelor's Degree in Accountancy</li>
                                    <li>Must be a Certified Public Accountant (CPA) with an updated PRC license</li>
                                    <li>Prior work experience as an Chief Accountant or in a related capacity.</li>
                                    <li>Excellent written and communication skills</li>
                                </ul>
                                <ul>
                                    <li>Flexibility to work on weekends</li>
                                    <li>Strong leadership skills</li>
                                    <li>Must be able to multitask and can adapt to fast paced environment</li>
                                    <li>Computer literate</li>
                                    <li>Can start ASAP</li>
                                </ul>
                            </div>
                        </section>
                        <section class="apply">
                            <p class="call">If you have the skills and experience required, we want to hear from you!
                            </p>
                            <p class="email">recruitment@rivieragolfclub.ph</p>
                            <div class="apply-now">
                                <a href="mailto:recruitment@rivieragolfclub.ph">APPLY NOW!</a>
                            </div>
                        </section>
                    </article>
                    <article class="job-card">
                        <header class="jc-header">
                            <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera logo" class="jc-logo">
                            <div class="jc-title">
                                <h1>WE ARE HIRING</h1>
                                <p>We're looking for someone to join our company as a</p>
                                <div class="position-pill">
                                    <svg viewBox="0 0 24 24" class="mag" aria-hidden="true">
                                        <path
                                            d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 1 0 14 15.5l.27.28v.79L20 21.49 21.49 20 15.5 14z" />
                                    </svg>
                                    <span>IT PROGRAMMER</span>
                                </div>
                            </div>
                        </header>

                        <section class="qualifications">
                            <h2>Qualifications:</h2>
                            <div class="qual-grid">
                                <ul>
                                    <li>Graduate of Bachelor's Degree in Information Technology, Computer Science,
                                        Computer Engineering, or any IT-related course.</li>
                                    <li>Can install maintain configure hardware or software systems according to
                                        policies standards;</li>
                                    <li>.NET developer with experience in API's Front End and Back End development.</li>
                                    <li>Have knowledge in Crystal Report, MySQL or SQL Server.</li>
                                    <li>With at least 2 years programming experience.</li>
                                </ul>
                                <ul>
                                    <li>Excellent knowledge of hardware, software, and network systems.</li>
                                    <li>Highly analytical and detail-oriented.</li>
                                    <li>Strong leadership and communication skills.</li>
                                    <li>Willing to work on weekends, holidays and shifting schedules.</li>
                                    <li>Can start ASAP and willing to work in Silang, Cavite.</li>
                                </ul>
                            </div>
                        </section>

                        <section class="apply">
                            <p class="call">If you have the skills and experience required, we want to hear from you!
                            </p>
                            <p class="email">recruitment@rivieragolfclub.ph</p>
                            <div class="apply-now">
                                <a href="mailto:recruitment@rivieragolfclub.ph">APPLY NOW!</a>
                            </div>

                        </section>
                    </article>
                    <article class="job-card">
                        <header class="jc-header">
                            <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera logo" class="jc-logo">
                            <div class="jc-title">
                                <h1>WE ARE HIRING</h1>
                                <p>We're looking for someone to join our company as a</p>
                                <div class="position-pill">
                                    <svg viewBox="0 0 24 24" class="mag" aria-hidden="true">
                                        <path
                                            d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 1 0 14 15.5l.27.28v.79L20 21.49 21.49 20 15.5 14z" />
                                    </svg>
                                    <span>INTERNAL AUDIT MANAGER</span>
                                </div>
                            </div>
                        </header>

                        <section class="qualifications">
                            <h2>Qualifications:</h2>
                            <div class="qual-grid">
                                <ul>
                                    <li>Graduate of Bachelor's Degree in Accountancy</li>
                                    <li>Certified Public Accountant (CPA)</li>
                                    <li>Proven work experience</li>
                                    <li>Excellent communication skills</li>
                                </ul>
                                <ul>
                                    <li>Flexibility to work weekends</li>
                                    <li>Strong leadership skills</li>
                                    <li>Can multitask & adapt</li>
                                    <li>Can start ASAP</li>
                                </ul>
                            </div>
                        </section>

                        <section class="apply">
                            <p class="call">If you have the skills and experience required, we want to hear from you!
                            </p>
                            <p class="email">recruitment@rivieragolfclub.ph</p>
                            <div class="apply-now">
                                <a href="mailto:recruitment@rivieragolfclub.ph">APPLY NOW!</a>
                            </div>

                        </section>
                    </article>
                </div>
            </div>

            <button class="carousel-btn next" aria-label="Next">&#10095;</button>
        </div>
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

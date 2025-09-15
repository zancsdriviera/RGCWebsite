<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership</title>

    <!-- Link to your external CSS file -->
    <link href="{{ asset('css/membership.css') }}" rel="stylesheet">
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
                <li class="nav-item"><a class="nav-link active" href="{{ url('/membership') }}">MEMBERSHIP</a></li>
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
                                <a class="dropdown-item" href="{{ url('/clubhouse') }}" data-facility="premium-1">GOLF
                                    CLUB
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
                                <a class="dropdown-item" href="{{ url('/lobby') }}" data-facility="premium-3">LOBBY
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
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">MEMBERSHIP</h1>
    </div>

    <div class="top_caption my-0 text-center">
        <h2 class="top-title">CLICK TO DOWNLOAD THE PDF</h2>
    </div>

    <div class="bullet_container my-4">
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-5">
            <!-- First group -->
            <ul class="list-unstyled text-start m-0">
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/endorsement-letter.pdf" target="_blank">Endorsement Letter</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/undertaking-update.pdf" target="_blank">Letter Of Undertaking Information
                        Update</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/membership-info.pdf" target="_blank">Membership Information Form</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/corporate-nominee.pdf" target="_blank">Change Of Corporate Nominee</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/lost-stock-cert.pdf" target="_blank">Lost Stock Certificate Requirements</a>
                </li>
            </ul>

            <!-- Second group -->
            <ul class="list-unstyled text-start m-0">
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/playing-rights-filipino.pdf" target="_blank">Playing Rights (Filipino)</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/playing-rights-foreign.pdf" target="_blank">Playing Rights (Foreign)</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/lateral-transfer.pdf" target="_blank">Lateral Transfer</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/transfer-of-share.pdf" target="_blank">Transfer Of Share</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center gx-2">
            <!-- Column 1 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <h2 class="bot-title">MEMBERSHIP APPLICANTS</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel-wrapper">
        <div class="carousel-container">
            <button class="carousel-btn prev" aria-label="Previous">&#10094;</button>
            <div class="carousel-viewport">
                <div class="carousel-track">
                    <!-- header + title -->
                    <section class="members-page">
                        <header class="members-header">
                            <!-- replace SVG with a single image (SVG/PNG) -->
                            <img class="header-wave" src="{{ asset('images/wavy.png') }}" alt=""
                                aria-hidden="true">
                            <!-- logo badge top-right -->
                            <div class="club-logo">
                                <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Club Logo">
                            </div>
                        </header>
                        <!-- title block -->
                        <div class="title-block">
                            <h1 class="page-title">MEMBERSHIP APPLICANTS</h1>
                            <div class="title-underline"></div>
                        </div>

                        <!-- two-column grid of cards (duplicate .app-card) -->
                        <div class="cards-grid">
                            <!-- single card -->
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                        </div>
                        <!-- bottom footer stripe -->
                        <div class="page-footer"></div>
                    </section>
                    <section class="members-page">
                        <header class="members-header">
                            <!-- replace SVG with a single image (SVG/PNG) -->
                            <img class="header-wave" src="{{ asset('images/wavy.png') }}" alt=""
                                aria-hidden="true">
                            <!-- logo badge top-right -->
                            <div class="club-logo">
                                <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Club Logo">
                            </div>
                        </header>
                        <!-- title block -->
                        <div class="title-block">
                            <h1 class="page-title">MEMBERSHIP APPLICANTS</h1>
                            <div class="title-underline"></div>
                        </div>

                        <!-- two-column grid of cards (duplicate .app-card) -->
                        <div class="cards-grid">
                            <!-- single card -->
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                        </div>
                        <!-- bottom footer stripe -->
                        <div class="page-footer"></div>
                    </section>
                    <section class="members-page">
                        <header class="members-header">
                            <!-- replace SVG with a single image (SVG/PNG) -->
                            <img class="header-wave" src="{{ asset('images/wavy.png') }}" alt=""
                                aria-hidden="true">
                            <!-- logo badge top-right -->
                            <div class="club-logo">
                                <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Club Logo">
                            </div>
                        </header>
                        <!-- title block -->
                        <div class="title-block">
                            <h1 class="page-title">MEMBERSHIP APPLICANTS</h1>
                            <div class="title-underline"></div>
                        </div>

                        <!-- two-column grid of cards (duplicate .app-card) -->
                        <div class="cards-grid">
                            <!-- single card -->
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                        </div>
                        <!-- bottom footer stripe -->
                        <div class="page-footer"></div>
                    </section>
                    <section class="members-page">
                        <header class="members-header">
                            <!-- replace SVG with a single image (SVG/PNG) -->
                            <img class="header-wave" src="{{ asset('images/wavy.png') }}" alt=""
                                aria-hidden="true">
                            <!-- logo badge top-right -->
                            <div class="club-logo">
                                <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Club Logo">
                            </div>
                        </header>
                        <!-- title block -->
                        <div class="title-block">
                            <h1 class="page-title">MEMBERSHIP APPLICANTS</h1>
                            <div class="title-underline"></div>
                        </div>

                        <!-- two-column grid of cards (duplicate .app-card) -->
                        <div class="cards-grid">
                            <!-- single card -->
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                        </div>
                        <!-- bottom footer stripe -->
                        <div class="page-footer"></div>
                    </section>
                </div>
            </div>
            <button class="carousel-btn next" aria-label="Next">&#10095;</button>
        </div>
    </div>
    <div class="container-fluid my-0 banks_container">
        <div class="row justify-content-center text-center gx-2">
            <!-- Column 1 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="bank-column w-100">
                    <img src="{{ asset('images/MEMBERSHIP/BPI.png') }}" alt="Top Image 1"
                        class="card-img custom-card-img-top mb-3">
                    <p class="mb-3 bank-title bpi">BPI PAY BILLS PROCEDURE</p>
                    <img src="{{ asset('images/MEMBERSHIP/QR.png') }}" alt="Bottom Image 1"
                        class="card-img custom-card-img">
                </div>
            </div>

            <!-- Column 2 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="bank-column w-100">
                    <img src="{{ asset('images/MEMBERSHIP/BDO.png') }}" alt="Top Image 2"
                        class="card-img custom-card-img-top mb-3">
                    <p class="mb-3 bank-title bdo">BDO PAY BILLS PROCEDURE</p>
                    <img src="{{ asset('images/MEMBERSHIP/QR.png') }}" alt="Bottom Image 2"
                        class="card-img custom-card-img">
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

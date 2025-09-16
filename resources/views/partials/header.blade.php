<!-- Top contact bar -->
<div class="top-contact-bar d-flex justify-content-end align-items-center py-1 px-3" style="background:#256335;">
    <div>
        <i class="bi bi-telephone-fill"></i>
        <span class="ms-1">(046) 409-1077</span>
        <a href="https://www.facebook.com/RivieraGolfPH" class="text-white social-icon"><i class="bi bi-facebook"></i></a>
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
            <li class="nav-item">
                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ url('home') }}">HOME</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('about_us') ? 'active' : '' }}" href="{{ url('about_us') }}">ABOUT
                    US</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('courses') ? 'active' : '' }}"
                    href="{{ url('courses') }}">COURSES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('membership') ? 'active' : '' }}"
                    href="{{ url('membership') }}">MEMBERSHIP</a>
            </li>

            <!-- Change this line in your navbar -->
            <li class="nav-item dropdown position-relative">
                <a class="nav-link {{ request()->is('clubhouse') || request()->is('drivingrange') || request()->is('lobby') ? 'active' : '' }}"
                    href="#" id="facilitiesDropdown">
                    FACILITIES
                </a>

                <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="facilitiesDropdown">
                    <div class="d-flex">
                        <!-- Club Facilities column -->
                        <div class="me-4">
                            <h6 class="dropdown-header facilities_header">CLUB FACILITIES</h6>

                            <a class="dropdown-item {{ request()->is('clubhouse') ? 'active' : '' }}"
                                href="{{ url('/clubhouse') }}">
                                GOLF CLUB HOUSE
                            </a>

                            <a class="dropdown-item {{ request()->is('drivingrange') ? 'active' : '' }}"
                                href="{{ url('/drivingrange') }}">
                                DRIVING RANGE
                            </a>

                            <a class="dropdown-item" href="javascript:void(0)">PROSHOP</a>
                            <a class="dropdown-item" href="javascript:void(0)">MEN'S AND LADIES LOCKER ROOMS</a>
                            <a class="dropdown-item" href="javascript:void(0)">MEMBERS LOUNGE</a>

                            <a class="dropdown-item {{ request()->is('lobby') ? 'active' : '' }}"
                                href="{{ url('/lobby') }}">
                                LOBBY
                            </a>

                            <a class="dropdown-item" href="javascript:void(0)">VERANDA</a>
                        </div>

                        <!-- Restaurant column -->
                        <div>
                            <h6 class="dropdown-header facilities_header">RESTAURANT</h6>
                            <a class="dropdown-item" href="javascript:void(0)">GRILLROOM</a>
                            <a class="dropdown-item" href="javascript:void(0)">TEEHOUSE</a>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown position-relative">
                <a class="nav-link {{ request()->is('coursesched') || request()->is('tournamentgal') ? 'active' : '' }}"
                    href="#" id="announcementDropdown">
                    ANNOUNCEMENT
                </a>
                <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="announcementDropdown">
                    <div class="d-flex">
                        <div class="me-4">
                            <a class="dropdown-item" href="#">TOURNAMENTS AND EVENTS</a>

                            <a class="dropdown-item {{ request()->is('coursesched') ? 'active' : '' }}"
                                href="{{ url('/coursesched') }}">
                                COURSE SCHEDULE
                            </a>

                            <a class="dropdown-item {{ request()->is('tournamentgal') ? 'active' : '' }}"
                                href="{{ url('/tournamentgal') }}">
                                TOURNAMENT GALLERY
                            </a>

                            <a class="dropdown-item" href="#">HOLE IN ONE</a>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown position-relative">
                <a class="nav-link {{ request()->is('rates*') || request()->is('tournament_rates') ? 'active' : '' }}"
                    href="#" id="ratesDropdown">
                    RATES
                </a>
                <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="ratesDropdown">
                    <div class="d-flex">
                        <!-- Premium column -->
                        <div class="me-4">
                            <a class="dropdown-item {{ request()->is('rates') ? 'active' : '' }}"
                                href="{{ url('/rates') }}">LEAN SEASON</a>

                            <a class="dropdown-item {{ request()->is('rates2') ? 'active' : '' }}"
                                href="{{ url('/rates2') }}">PEAK SEASON</a>

                            <a class="dropdown-item {{ request()->is('tournament_rates') ? 'active' : '' }}"
                                href="{{ url('/tournament_rates') }}">TOURNAMENT RATES</a>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ url('/faq') }}">FAQ</a>
            </li>
            <li class="nav-item dropdown position-relative">
                <a class="nav-link {{ request()->is('contact_us*') ? 'active' : '' }}" href="#"
                    id="contactsDropdown" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                    CONTACT US
                </a>
                <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="contactsDropdown">
                    <div class="d-flex">
                        <div class="me-4">
                            <a class="dropdown-item {{ request()->is('contact_us') ? 'active' : '' }}"
                                href="{{ url('/contact_us') }}">
                                CONTACT DETAILS
                            </a>

                            <a class="dropdown-item {{ request()->is('contact_us_2') ? 'active' : '' }}"
                                href="{{ url('/contact_us_2') }}">
                                CAREERS
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

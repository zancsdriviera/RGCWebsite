<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/home.css')
</head>

<body>

    @section('main-navbar')
        <nav class="navbar navbar-expand-lg navbar-light main-navbar px-3">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera Golf Club" height="100" class="me-2">
                <span class="brand-text">RIVIERA GOLF CLUB</span>
            </a>

            <!-- Mobile toggle button -->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu links -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/home') }}">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/about_us') }}">ABOUT US</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/courses') }}">COURSES</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/membership') }}">MEMBERSHIP</a></li>

                    <!-- Facilities Dropdown -->
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="#" id="facilitiesDropdown" data-bs-toggle="dropdown"
                            role="button" aria-expanded="false">
                            FACILITIES
                        </a>
                        <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="facilitiesDropdown">
                            <div class="d-flex">
                                <div class="me-4">
                                    <h6 class="dropdown-header facilities_header">CLUB FACILITIES</h6>
                                    <a class="dropdown-item" href="{{ url('/clubhouse') }}">GOLF CLUB HOUSE</a>
                                    <a class="dropdown-item" href="{{ url('/drivingrange') }}">DRIVING RANGE</a>
                                    <a class="dropdown-item" href="javascript:void(0)">PROSHOP</a>
                                    <a class="dropdown-item" href="javascript:void(0)">MEN'S AND LADIES LOCKER ROOMS</a>
                                    <a class="dropdown-item" href="javascript:void(0)">MEMBERS LOUNGE</a>
                                    <a class="dropdown-item" href="{{ url('/lobby') }}">LOBBY</a>
                                    <a class="dropdown-item" href="javascript:void(0)">VERANDA</a>
                                </div>
                                <div>
                                    <h6 class="dropdown-header facilities_header">RESTAURANT</h6>
                                    <a class="dropdown-item" href="javascript:void(0)">GRILLROOM</a>
                                    <a class="dropdown-item" href="javascript:void(0)">TEEHOUSE</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Announcement Dropdown -->
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="#" id="announcementDropdown"
                            data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            ANNOUNCEMENT
                        </a>
                        <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="announcementDropdown">
                            <a class="dropdown-item" href="{{ url('/tournamentgal') }}">TOURNAMENTS AND EVENTS</a>
                            <a class="dropdown-item" href="{{ url('/coursesched') }}">COURSE SCHEDULE</a>
                            <a class="dropdown-item" href="javascript:void(0)">LIVE SCORE</a>
                        </div>
                    </li>

                    <!-- Rates Dropdown -->
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="#" id="ratesDropdown" data-bs-toggle="dropdown"
                            role="button" aria-expanded="false">
                            RATES
                        </a>
                        <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="ratesDropdown">
                            <a class="dropdown-item" href="{{ url('/rates') }}">LEAN SEASON</a>
                            <a class="dropdown-item" href="{{ url('/rates2') }}">PEAK SEASON</a>
                            <a class="dropdown-item" href="{{ url('/tournament_rates') }}">TOURNAMENT RATES</a>
                        </div>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ url('/faq') }}">FAQ</a></li>

                    <!-- Contact Dropdown -->
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="#" id="contactsDropdown"
                            data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            CONTACT US
                        </a>
                        <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="contactsDropdown">
                            <a class="dropdown-item" href="{{ url('/contact_us') }}">CONTACT DETAILS</a>
                            <a class="dropdown-item" href="{{ url('/contact_us_2') }}">CAREERS</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    @endsection

</body>

</html>

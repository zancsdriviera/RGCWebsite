<div class="M1_navbar">
    <!-- Top contact bar -->
    <div class="top-contact-bar d-flex justify-content-end align-items-center py-1 px-3">
        <div>
            <i class="bi bi-telephone-fill"></i>
            <a href="tel:+63464091077" class="ms-1 phone-link">(046) 409-1077</a>

            <a href="https://www.facebook.com/RivieraGolfPH" target="_blank" class="text-white social-icon"><i
                    class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/rivieragolfph/" target="_blank" class="text-white social-icon"><i
                    class="bi bi-instagram"></i></a>
            <a href="https://www.youtube.com/@RivieraGolfClubInc." target="_blank" class="text-white social-icon"><i
                    class="bi bi-youtube"></i></a>
        </div>
    </div>

    <!-- Main navbar -->
    <nav class="navbar navbar-expand-lg navbar-light main-navbar px-3">
        <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('home.frontend')); ?>">
            <img src="<?php echo e(asset('images/RivieraHeaderLogo.png')); ?>" alt="Riviera Golf Club" height="80">
            <span class="brand-text ms-2">RIVIERA GOLF CLUB</span>
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu links with proper spacing -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('/') || request()->routeIs('home.frontend') ? 'active' : ''); ?>"
                        href="<?php echo e(route('home.frontend')); ?>">HOME</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('aboutus.frontend') ? 'active' : ''); ?>"
                        href="<?php echo e(route('aboutus.frontend')); ?>">ABOUT
                        US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('courses') || request()->is('langer') || request()->is('couples') ? 'active' : ''); ?>"
                        href="<?php echo e(url('courses')); ?>">COURSES</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('membership.frontend') ? 'active' : ''); ?>"
                        href="<?php echo e(route('membership.frontend')); ?>">
                        MEMBERSHIP
                    </a>
                </li>


                <!-- Change this line in your navbar -->
                <li class="nav-item dropdown position-relative">
                    <a class="nav-link <?php echo e(request()->routeIs('clubhouse.frontend') || request()->routeIs('drivingrange.frontend') || request()->routeIs('lobby.frontend') || request()->routeIs('locker.frontend') || request()->routeIs('membersLounge.frontend') || request()->routeIs('veranda.frontend') || request()->routeIs('grill.frontend') || request()->routeIs('teehouse.frontend') || request()->routeIs('proshop.frontend') ? 'active' : ''); ?>"
                        href="#" id="facilitiesDropdown">
                        FACILITIES
                    </a>

                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="facilitiesDropdown">
                        <div class="d-flex">
                            <!-- Club Facilities column -->
                            <div class="me-4">
                                <h6 class="dropdown-header facilities_header">CLUB FACILITIES</h6>

                                <a class="dropdown-item <?php echo e(request()->routeIs('clubhouse.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('clubhouse.frontend')); ?>">
                                    GOLF CLUB HOUSE
                                </a>

                                <a class="dropdown-item <?php echo e(request()->routeIs('drivingrange.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('drivingrange.frontend')); ?>">
                                    DRIVING RANGE
                                </a>
                                <a class="dropdown-item <?php echo e(request()->routeIs('proshop.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('proshop.frontend')); ?>">
                                    PROSHOP
                                </a>
                                <a class="dropdown-item <?php echo e(request()->routeIs('locker.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('locker.frontend')); ?>">
                                    MEN'S AND LADIES LOCKER ROOMS
                                </a>
                                <a class="dropdown-item <?php echo e(request()->routeIs('membersLounge.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('membersLounge.frontend')); ?>">
                                    MEMBERS LOUNGE
                                </a>

                                <a class="dropdown-item <?php echo e(request()->routeIs('lobby.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('lobby.frontend')); ?>">
                                    LOBBY
                                </a>

                                <a class="dropdown-item <?php echo e(request()->routeIs('veranda.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('veranda.frontend')); ?>">
                                    VERANDA
                                </a>
                            </div>

                            <!-- Restaurant column -->
                            <div class="me-4">
                                <h6 class="dropdown-header facilities_header">RESTAURANT</h6>

                                <a class="dropdown-item <?php echo e(request()->routeIs('grill.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('grill.frontend')); ?>">
                                    GRILL
                                </a>

                                <a class="dropdown-item <?php echo e(request()->routeIs('teehouse.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('teehouse.frontend')); ?>">
                                    TEEHOUSE
                                </a>
                            </div>
                        </div>
                    </div>
                </li>


                <li class="nav-item dropdown position-relative">
                    <a class="nav-link <?php echo e(request()->routeIs('client.tournaments') || request()->is('coursesched') || request()->is('tournament_gallery') || request()->is('hole-in-one') ? 'active' : ''); ?>"
                        href="#" id="announcementDropdown">
                        ANNOUNCEMENT
                    </a>
                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="announcementDropdown">
                        <div class="d-flex">
                            <div class="me-4">
                                <a class="dropdown-item <?php echo e(request()->routeIs('client.tournaments') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('client.tournaments')); ?>">
                                    TOURNAMENTS & EVENTS
                                </a>

                                <a class="dropdown-item <?php echo e(request()->is('coursesched') ? 'active' : ''); ?>"
                                    href="<?php echo e(url('/coursesched')); ?>">
                                    COURSE SCHEDULE
                                </a>

                                <a class="dropdown-item <?php echo e(request()->is('tournament_gallery') ? 'active' : ''); ?>"
                                    href="<?php echo e(url('/tournament_gallery')); ?>">
                                    TOURNAMENT GALLERY
                                </a>

                                <a class="dropdown-item <?php echo e(request()->is('hole-in-one') ? 'active' : ''); ?>"
                                    href="<?php echo e(url('/hole-in-one')); ?>">
                                    HOLE-IN-ONE
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown position-relative">
                    <a class="nav-link <?php echo e(request()->routeIs('rates*') || request()->is('tournament_rates') ? 'active' : ''); ?>"
                        href="#" id="ratesDropdown">
                        RATES
                    </a>
                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="ratesDropdown">
                        <div class="d-flex">
                            <!-- Premium column -->
                            <div class="me-4">
                                <a class="dropdown-item <?php echo e(request()->routeIs('rates.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('rates.frontend')); ?>">LEAN SEASON</a>

                                <a class="dropdown-item <?php echo e(request()->routeIs('rates2.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('rates2.frontend')); ?>">PEAK SEASON</a>

                                <a class="dropdown-item <?php echo e(request()->routeIs('tournament.rates.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('tournament.rates.frontend')); ?>">TOURNAMENT RATES</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('faq') ? 'active' : ''); ?>"
                        href="<?php echo e(url('/faq')); ?>">FAQ</a>
                </li>
                <li class="nav-item dropdown position-relative">
                    <a class="nav-link <?php echo e(request()->routeIs('contact.frontend') || request()->routeIs('careers.frontend') ? 'active' : ''); ?>"
                        href="#" id="contactsDropdown" data-bs-toggle="dropdown" role="button"
                        aria-expanded="false">
                        CONTACT US
                    </a>
                    <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="contactsDropdown">
                        <div class="d-flex">
                            <div class="me-4">
                                <a class="dropdown-item <?php echo e(request()->routeIs('contact.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('contact.frontend')); ?>">
                                    CONTACT DETAILS
                                </a>

                                <a class="dropdown-item <?php echo e(request()->routeIs('careers.frontend') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('careers.frontend')); ?>">
                                    CAREERS
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<?php /**PATH C:\xampp\htdocs\app\resources\views/partials/header.blade.php ENDPATH**/ ?>
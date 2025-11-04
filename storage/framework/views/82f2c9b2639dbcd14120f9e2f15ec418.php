 <div class="M1_navbar">
     <!-- Top contact bar -->
     <div class="top-contact-bar d-flex justify-content-end align-items-center py-1 px-3" style="background:#256335;">
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
         <a class="navbar-brand d-flex align-items-center" href="#">
             <img src="<?php echo e(asset('images/RivieraHeaderLogo.png')); ?>" alt="Riviera Golf Club" height="100"
                 class="me-2">
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
                     <a class="nav-link <?php echo e(request()->is('/') || request()->is('home') ? 'active' : ''); ?>"
                         href="<?php echo e(url('home')); ?>">HOME</a>
                 </li>

                 <li class="nav-item">
                     <a class="nav-link <?php echo e(request()->is('about_us') ? 'active' : ''); ?>"
                         href="<?php echo e(url('about_us')); ?>">ABOUT
                         US</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link <?php echo e(request()->is('courses') || request()->is('langer') || request()->is('couples') ? 'active' : ''); ?>"
                         href="<?php echo e(url('courses')); ?>">COURSES</a>
                 </li>

                 <li class="nav-item">
                     <a class="nav-link <?php echo e(request()->is('membership') ? 'active' : ''); ?>"
                         href="<?php echo e(url('membership')); ?>">MEMBERSHIP</a>
                 </li>

                 <!-- Change this line in your navbar -->
                 <li class="nav-item dropdown position-relative">
                     <a class="nav-link <?php echo e(request()->is('clubhouse') || request()->is('drivingrange') || request()->is('lobby') || request()->is('locker') || request()->is('membersLounge') || request()->is('veranda') || request()->is('grill') || request()->is('teehouse') || request()->is('proshop') ? 'active' : ''); ?>"
                         href="#" id="facilitiesDropdown">
                         FACILITIES
                     </a>

                     <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="facilitiesDropdown">
                         <div class="d-flex">
                             <!-- Club Facilities column -->
                             <div class="me-4">
                                 <h6 class="dropdown-header facilities_header">CLUB FACILITIES</h6>

                                 <a class="dropdown-item <?php echo e(request()->is('clubhouse') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/clubhouse')); ?>">
                                     GOLF CLUB HOUSE
                                 </a>

                                 <a class="dropdown-item <?php echo e(request()->is('drivingrange') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/drivingrange')); ?>">
                                     DRIVING RANGE
                                 </a>
                                 <a class="dropdown-item <?php echo e(request()->is('proshop') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/proshop')); ?>">
                                     PROSHOP
                                 </a>
                                 <a class="dropdown-item <?php echo e(request()->is('locker') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/locker')); ?>">
                                     MEN'S AND LADIES LOCKER ROOMS
                                 </a>
                                 <a class="dropdown-item <?php echo e(request()->is('membersLounge') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/membersLounge')); ?>">
                                     MEMBERS LOUNGE
                                 </a>

                                 <a class="dropdown-item <?php echo e(request()->is('lobby') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/lobby')); ?>">
                                     LOBBY
                                 </a>

                                 <a class="dropdown-item <?php echo e(request()->is('veranda') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/veranda')); ?>">
                                     VERANDA
                                 </a>
                             </div>

                             <!-- Restaurant column -->
                             <div class="me-4">
                                 <h6 class="dropdown-header facilities_header">RESTAURANT</h6>

                                 <a class="dropdown-item <?php echo e(request()->is('grill') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/grill')); ?>">
                                     GRILL
                                 </a>

                                 <a class="dropdown-item <?php echo e(request()->is('teehouse') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('teehouse')); ?>">
                                     TEEHOUSE
                                 </a>
                             </div>
                         </div>
                     </div>
                 </li>


                 <li class="nav-item dropdown position-relative">
                     <a class="nav-link <?php echo e(request()->is('tourna_and_events') || request()->is('coursesched') || request()->is('tournaments') || request()->is('holeinone') ? 'active' : ''); ?>"
                         href="#" id="announcementDropdown">
                         ANNOUNCEMENT
                     </a>
                     <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="announcementDropdown">
                         <div class="d-flex">
                             <div class="me-4">
                                 <a class="dropdown-item <?php echo e(request()->is('tourna_and_events') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/tourna_and_events')); ?>">
                                     TOURNAMENTS & EVENTS
                                 </a>

                                 <a class="dropdown-item <?php echo e(request()->is('coursesched') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/coursesched')); ?>">
                                     COURSE SCHEDULE
                                 </a>

                                 <a class="dropdown-item <?php echo e(request()->is('tournaments') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/tournaments')); ?>">
                                     TOURNAMENT GALLERY
                                 </a>

                                 <a class="dropdown-item <?php echo e(request()->is('holeinone') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/holeinone')); ?>">
                                     HOLE-IN-ONE
                                 </a>
                             </div>
                         </div>
                     </div>
                 </li>

                 <li class="nav-item dropdown position-relative">
                     <a class="nav-link <?php echo e(request()->is('rates*') || request()->is('tournament_rates') ? 'active' : ''); ?>"
                         href="#" id="ratesDropdown">
                         RATES
                     </a>
                     <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="ratesDropdown">
                         <div class="d-flex">
                             <!-- Premium column -->
                             <div class="me-4">
                                 <a class="dropdown-item <?php echo e(request()->is('rates') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/rates')); ?>">LEAN SEASON</a>

                                 <a class="dropdown-item <?php echo e(request()->is('rates2') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/rates2')); ?>">PEAK SEASON</a>

                                 <a class="dropdown-item <?php echo e(request()->is('tournament_rates') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/tournament_rates')); ?>">TOURNAMENT RATES</a>
                             </div>
                         </div>
                     </div>
                 </li>

                 <li class="nav-item">
                     <a class="nav-link <?php echo e(request()->is('faq') ? 'active' : ''); ?>"
                         href="<?php echo e(url('/faq')); ?>">FAQ</a>
                 </li>
                 <li class="nav-item dropdown position-relative">
                     <a class="nav-link <?php echo e(request()->is('contact_us*') ? 'active' : ''); ?>" href="#"
                         id="contactsDropdown" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                         CONTACT US
                     </a>
                     <div class="dropdown-menu p-3 custom-dropdown" aria-labelledby="contactsDropdown">
                         <div class="d-flex">
                             <div class="me-4">
                                 <a class="dropdown-item <?php echo e(request()->is('contact_us') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/contact_us')); ?>">
                                     CONTACT DETAILS
                                 </a>

                                 <a class="dropdown-item <?php echo e(request()->is('careers') ? 'active' : ''); ?>"
                                     href="<?php echo e(url('/careers')); ?>">
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
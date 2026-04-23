<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>RGC ADMIN - <?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />

    <!-- Custom admin CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">

    <style>
        /* =============================================
           BASE LAYOUT
        ============================================= */
        body {
            overflow-x: hidden;
        }

        .topbar {
            height: 70px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid #e6e6e6;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* =============================================
           SIDEBAR
        ============================================= */
        .sidebar {
            width: 260px;
            min-width: 260px;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            flex-shrink: 0;
            z-index: 200;
            transition: transform 0.3s ease, width 0.3s ease;
        }

        .sidebar-footer {
            flex-shrink: 0;
        }

        /* Scrollable nav area */
        .sidebar .flex-grow-1 {
            overflow-y: auto;
            max-height: calc(100vh - 70px - 70px);
        }

        /* =============================================
           MAIN CONTENT
        ============================================= */
        .flex-fill {
            flex: 1 1 0%;
            min-width: 0;
            overflow-x: hidden;
            height: 100vh;
            overflow-y: auto;
        }

        /* =============================================
           NAV LINKS & SUBMENUS
        ============================================= */
        .nav-link {
            color: #f0f7f3 !important;
        }

        .nav-link.active {
            color: #f0f7f3 !important;
            background-color: #f0f7f3;
        }

        .nav-link:hover {
            background: linear-gradient(to right, #2a5e2d, #1c7020, #03660a) !important;
            color: #f0f7f3 !important;
        }

        .submenu {
            background: transparent;
            padding-left: 0;
        }

        .submenu .nav-link {
            color: #ffffff !important;
            padding-left: 2.2rem;
            font-size: .95rem;
        }

        .submenu .nav-link:hover {
            background: linear-gradient(to right, #2a5e2d, #1c7020, #03660a);
            color: #f0f7f3 !important;
        }

        /* Chevron */
        .has-submenu .chev {
            transition: transform .25s ease;
            font-size: 0.9rem;
        }

        .has-submenu.open .chev {
            transform: rotate(180deg);
        }

        /* =============================================
           HIDE SCROLLBARS
        ============================================= */
        .sidebar,
        .flex-grow-1,
        .submenu,
        .collapse.submenu {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .sidebar::-webkit-scrollbar,
        .flex-grow-1::-webkit-scrollbar,
        .submenu::-webkit-scrollbar,
        .collapse.submenu::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }

        .sidebar::-webkit-scrollbar-thumb,
        .flex-grow-1::-webkit-scrollbar-thumb,
        .submenu::-webkit-scrollbar-thumb,
        .collapse.submenu::-webkit-scrollbar-thumb {
            background: transparent;
        }

        .sidebar {
            -webkit-overflow-scrolling: touch;
        }

        /* =============================================
           OVERLAY (mobile)
        ============================================= */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 199;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* =============================================
           RESPONSIVE — MOBILE (< 992px)
        ============================================= */
        @media (max-width: 991.98px) {

            /* Sidebar slides off-screen by default */
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                transform: translateX(-100%);
                width: 260px;
                min-width: 260px;
            }

            /* When toggled open */
            .sidebar.show {
                transform: translateX(0);
            }

            /* Main fills full width */
            .flex-fill {
                width: 100%;
                height: 100vh;
            }

            /* Topbar toggle button visible on mobile */
            #sidebarToggle {
                display: inline-flex !important;
            }

            /* Show brand inside sidebar on mobile */
            .sidebar .brand {
                display: flex !important;
            }
        }

        /* =============================================
           RESPONSIVE — TABLET (992px–1199px)
        ============================================= */
        @media (min-width: 992px) and (max-width: 1199.98px) {
            .sidebar {
                width: 220px;
                min-width: 220px;
            }

            .brand strong {
                font-size: 16px !important;
            }
        }

        /* =============================================
           RESPONSIVE — DESKTOP (≥ 1200px)
        ============================================= */
        @media (min-width: 1200px) {
            #sidebarToggle {
                display: none !important;
            }
        }

        /* =============================================
           TOPBAR RESPONSIVE TWEAKS
        ============================================= */
        @media (max-width: 575.98px) {
            .topbar {
                padding: 0 12px;
            }

            .topbar h4 {
                font-size: 1rem;
            }

            .topbar .csd-label {
                font-size: 18px !important;
            }

            .topbar img {
                height: 36px !important;
                margin-right: 12px !important;
            }
        }

        /* =============================================
           MAIN CONTENT PADDING RESPONSIVE
        ============================================= */
        @media (max-width: 575.98px) {
            main.p-4 {
                padding: 1rem !important;
            }
        }

        /* =============================================
           DARK MODE TOGGLE BUTTON STYLES
        ============================================= */
        .dark-mode-toggle {
            background: transparent;
            border: none;
            color: #333;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 15px;
            font-size: 1.3rem;
        }

        .dark-mode-toggle:hover {
            background: rgba(0, 0, 0, 0.1);
            transform: scale(1.05);
        }

        /* Dark mode body class */
        body.dark-mode {
            background-color: #1a1a1a;
        }

        body.dark-mode .topbar {
            background: #2d2d2d;
            border-bottom-color: #404040;
        }

        body.dark-mode .topbar h4,
        body.dark-mode .topbar .csd-label {
            color: #ffffff !important;
        }

        body.dark-mode .sidebar {
            background: #1a1a1a;
        }

        body.dark-mode .sidebar .brand strong {
            color: #ffffff;
        }

        body.dark-mode .nav-link {
            color: #e0e0e0 !important;
        }

        body.dark-mode .nav-link.active {
            background: linear-gradient(to right, #2d8a32, #1c6e20, #0a7a11) !important;
            color: #ffffff !important;
        }

        body.dark-mode .nav-link:hover {
            background: linear-gradient(to right, #1c6e20, #2d8a32, #3d9e42) !important;
            color: #ffffff !important;
        }

        body.dark-mode .submenu .nav-link {
            color: #d0d0d0 !important;
        }

        body.dark-mode .submenu .nav-link:hover {
            color: #ffffff !important;
        }

        body.dark-mode .dark-mode-toggle {
            color: #ffffff;
        }

        body.dark-mode .dark-mode-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Exclude strong from dark mode - keep it dark/black */
        body.dark-mode strong {
            color: #212529 !important;
            font-weight: 700;
        }

        /* Include b in dark mode - turn it light/white */
        body.dark-mode b {
            color: #e0e0e0 !important;
        }

        /* But if strong is inside sidebar or topbar, keep them light */
        body.dark-mode .sidebar strong,
        body.dark-mode .topbar strong {
            color: #ffffff !important;
        }

        /* If strong is inside tables, keep them dark */
        body.dark-mode .table strong {
            color: #212529 !important;
        }

        /* If strong is inside table headers, keep them white */
        body.dark-mode .table thead th strong {
            color: #ffffff !important;
        }

        /* For b tags inside sidebar/topbar, keep them light too */
        body.dark-mode .sidebar b,
        body.dark-mode .topbar b {
            color: #ffffff !important;
        }

        /* But if strong is inside sidebar or topbar, keep it light */
        body.dark-mode .sidebar strong,
        body.dark-mode .topbar strong,
        body.dark-mode .sidebar b,
        body.dark-mode .topbar b {
            color: #ffffff !important;
        }

        /* If strong is inside tables, keep it dark (already dark) */
        body.dark-mode .table strong,
        body.dark-mode .table b {
            color: #212529 !important;
        }

        /* List styles - UL and LI bullet points and text */
        body.dark-mode ul,
        body.dark-mode ol {
            color: #e0e0e0;
        }

        body.dark-mode li {
            color: #e0e0e0;
        }

        /* For unordered list bullets */
        body.dark-mode ul:not(.nav):not(.dropdown-menu) {
            color: #e0e0e0;
        }

        body.dark-mode ul:not(.nav):not(.dropdown-menu) li {
            color: #e0e0e0;
        }

        /* Change bullet color for unordered lists */
        body.dark-mode ul:not(.nav):not(.dropdown-menu) li::marker {
            color: #ffffff;
        }

        /* For ordered list numbers */
        body.dark-mode ol:not(.nav):not(.dropdown-menu) li::marker {
            color: #ffffff;
        }

        /* Specific styling for list items in main content */
        body.dark-mode main ul li,
        body.dark-mode main ol li {
            color: #e0e0e0;
        }

        body.dark-mode main ul li::marker,
        body.dark-mode main ol li::marker {
            color: #ffffff;
        }

        /* Main content text colors - only for non-table elements */
        body.dark-mode main p,
        body.dark-mode main h1,
        body.dark-mode main h2,
        body.dark-mode main h3,
        body.dark-mode main h4,
        body.dark-mode main h5,
        body.dark-mode main h6,
        body.dark-mode main label,
        body.dark-mode main .form-label,
        body.dark-mode main .card-title,
        body.dark-mode main .card-text,
        body.dark-mode main span:not(.badge):not(.csd-label),
        body.dark-mode main div:not(.table):not(.card):not(.modal-content) {
            color: #e0e0e0;
        }

        /* Card styles */
        body.dark-mode .card {
            background-color: #2d2d2d;
            border-color: #404040;
        }

        body.dark-mode .card-header,
        body.dark-mode .card-footer {
            background-color: #2d2d2d;
            border-color: #404040;
        }

        /* Table styles - Keep table data text dark for readability */
        body.dark-mode .table {
            background-color: #ffffff;
        }

        body.dark-mode .table thead th {
            color: #ffffff;
            background-color: #2d8a32;
        }

        body.dark-mode .table thead th strong,
        body.dark-mode .table thead th b {
            color: #ffffff !important;
        }

        body.dark-mode .table tbody td,
        body.dark-mode .table tbody th {
            color: #212529 !important;
            background-color: #ffffff;
        }

        body.dark-mode .table tbody tr:hover td,
        body.dark-mode .table tbody tr:hover th {
            background-color: #f5f5f5;
            color: #212529 !important;
        }

        body.dark-mode .table-striped tbody tr:nth-of-type(odd) td,
        body.dark-mode .table-striped tbody tr:nth-of-type(odd) th {
            background-color: #f8f9fa;
        }

        /* Form styles */
        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background-color: #ffffff;
            border-color: #ced4da;
            color: #212529;
        }

        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            background-color: #ffffff;
            color: #212529;
            border-color: #4da22f;
        }

        body.dark-mode .form-control::placeholder {
            color: #6c757d;
        }

        /* Modal styles */
        body.dark-mode .modal-content {
            background-color: #ffffff;
            color: #212529;
        }

        body.dark-mode .modal-header,
        body.dark-mode .modal-footer {
            border-color: #dee2e6;
        }

        body.dark-mode .modal-title {
            color: #212529;
        }

        body.dark-mode .btn-close {
            filter: none;
        }

        /* Dropdown styles */
        body.dark-mode .dropdown-menu {
            background-color: #ffffff;
            border-color: #dee2e6;
        }

        body.dark-mode .dropdown-item {
            color: #212529;
        }

        body.dark-mode .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #212529;
        }

        /* Alert styles - keep original colors but adjust text */
        body.dark-mode .alert {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #212529;
        }

        body.dark-mode .alert-info {
            background-color: #cff4fc;
            border-color: #b6effb;
            color: #055160;
        }

        body.dark-mode .alert-success {
            background-color: #d1e7dd;
            border-color: #badbcc;
            color: #0f5132;
        }

        body.dark-mode .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #664d03;
        }

        body.dark-mode .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c2c7;
            color: #842029;
        }

        /* Button styles */
        body.dark-mode .btn-light {
            background-color: #f8f9fa;
            border-color: #f8f9fa;
            color: #212529;
        }

        body.dark-mode .btn-light:hover {
            background-color: #e9ecef;
            color: #212529;
        }

        body.dark-mode .text-muted {
            color: #6c757d !important;
        }

        /* Border colors */
        body.dark-mode .border-bottom,
        body.dark-mode .border-top,
        body.dark-mode .border-start,
        body.dark-mode .border-end {
            border-color: #dee2e6 !important;
        }

        /* Pagination styles */
        body.dark-mode .pagination .page-link {
            background-color: #ffffff;
            border-color: #dee2e6;
            color: #0d6efd;
        }

        body.dark-mode .pagination .page-link:hover {
            background-color: #e9ecef;
            color: #0a58ca;
        }

        body.dark-mode .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #ffffff;
        }

        body.dark-mode .pagination .page-item.disabled .page-link {
            background-color: #ffffff;
            color: #6c757d;
        }

        /* Badge styles */
        body.dark-mode .badge.bg-secondary {
            background-color: #6c757d !important;
            color: #ffffff;
        }

        body.dark-mode .badge.bg-light {
            background-color: #f8f9fa !important;
            color: #212529;
        }

        /* Progress bar styles */
        body.dark-mode .progress {
            background-color: #e9ecef;
        }

        /* List group styles */
        body.dark-mode .list-group-item {
            background-color: #ffffff;
            color: #212529;
            border-color: #dee2e6;
        }

        body.dark-mode .list-group-item-action:hover {
            background-color: #f8f9fa;
            color: #212529;
        }
    </style>
</head>

<body>

    <!-- Overlay for mobile sidebar -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="d-flex">
        <!-- =============================================
             SIDEBAR
        ============================================= -->
        <aside class="sidebar d-flex flex-column">
            <!-- Brand / Logo -->
            <div class="brand p-3 d-flex align-items-center">
                <img src="<?php echo e(asset('images/RivieraFooterLogo.png')); ?>" alt="logo"
                    style="height:54px; margin-right:10px;">
                <strong
                    style="font-size: 20px; font-family: Arial, sans-serif; font-weight:bold; line-height:1.2; transform:scaleY(1.3)">
                    RGC ADMIN
                </strong>
            </div>

            <!-- Scrollable Menu Container -->
            <div class="flex-grow-1 overflow-auto">
                <nav class="nav flex-column">
                    <a class="nav-link <?php echo e(request()->routeIs('admin.home') ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.home')); ?>">
                        <i class="bi bi-house-door-fill"></i> Home
                    </a>

                    <a class="nav-link <?php echo e(request()->routeIs('admin.about_us.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.about_us.index')); ?>">
                        <i class="bi bi-info-circle"></i> About Us
                    </a>

                    <a class="nav-link <?php echo e(request()->routeIs('admin.courses') ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.courses')); ?>">
                        <i class="bi bi-flag"></i> Courses
                    </a>

                    <a class="nav-link <?php echo e(request()->routeIs('admin.membership.index') ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.membership.index')); ?>">
                        <i class="bi bi-person-plus-fill"></i> Membership
                    </a>

                    <!-- Live Scoring -->
                    <a class="nav-link <?php echo e(request()->routeIs('admin.live-scores.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin.live-scores.index')); ?>">
                        <i class="bi bi-trophy"></i> Live Scoring
                    </a>

                    <!-- Facilities -->
                    <a class="nav-link has-submenu 
                        <?php echo e(request()->routeIs('admin.clubhouse') || request()->routeIs('admin.drivingrange') || request()->routeIs('admin.proshop') || request()->routeIs('admin.locker') || request()->routeIs('admin.membersLounge') || request()->routeIs('admin.lobby') || request()->routeIs('admin.veranda') || request()->routeIs('admin.grill') || request()->routeIs('admin.teehouse') ? 'open' : ''); ?>"
                        data-bs-toggle="collapse" href="#facilitiesMenu" role="button"
                        aria-expanded="<?php echo e(request()->routeIs('admin.clubhouse') || request()->routeIs('admin.drivingrange') || request()->routeIs('admin.proshop') || request()->routeIs('admin.locker') || request()->routeIs('admin.membersLounge') || request()->routeIs('admin.lobby') || request()->routeIs('admin.veranda') || request()->routeIs('admin.grill') || request()->routeIs('admin.teehouse') ? 'true' : 'false'); ?>"
                        aria-controls="facilitiesMenu">
                        <i class="bi bi-house-check-fill"></i> Facilities
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>
                    <div class="collapse submenu bg-dark <?php echo e(request()->routeIs('admin.clubhouse') || request()->routeIs('admin.drivingrange') || request()->routeIs('admin.proshop') || request()->routeIs('admin.locker') || request()->routeIs('admin.membersLounge') || request()->routeIs('admin.lobby') || request()->routeIs('admin.veranda') || request()->routeIs('admin.grill') || request()->routeIs('admin.teehouse') ? 'show' : ''); ?>"
                        id="facilitiesMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.clubhouse') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.clubhouse')); ?>">Golf Club House</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.drivingrange') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.drivingrange')); ?>">Driving Range</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.proshop') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.proshop')); ?>">Proshop</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.locker') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.locker')); ?>">Locker Room</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.lobby') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.lobby')); ?>">Lobby</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.veranda') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.veranda')); ?>">Veranda</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.grill') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.grill')); ?>">Grill</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.teehouse') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.teehouse')); ?>">Teehouse</a>
                    </div>

                    <!-- Tournament & Events -->
                    <a class="nav-link has-submenu 
                        <?php echo e(request()->routeIs('admin.holeinone.index') || request()->routeIs('admin.tournament_gallery.index') || request()->routeIs('admin.coursesched.index') || request()->routeIs('admin.tournaments.index') ? 'open' : ''); ?>"
                        data-bs-toggle="collapse" href="#announcementMenu" role="button"
                        aria-expanded="<?php echo e(request()->routeIs('admin.holeinone.index') || request()->routeIs('admin.tournament_gallery.index') || request()->routeIs('admin.coursesched.index') || request()->routeIs('admin.tournaments.index') ? 'true' : 'false'); ?>"
                        aria-controls="announcementMenu">
                        <i class="bi bi-megaphone-fill"></i> Tournament & Events
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>
                    <div class="collapse submenu bg-dark <?php echo e(request()->routeIs('admin.holeinone.index') || request()->routeIs('admin.tournament_gallery.index') || request()->routeIs('admin.coursesched.index') || request()->routeIs('admin.tournaments.index') ? 'show' : ''); ?>"
                        id="announcementMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.tournaments.index') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.tournaments.index')); ?>">Upcoming Events</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.coursesched.index') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.coursesched.index')); ?>">Course Schedule</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.tournament_gallery.index') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.tournament_gallery.index')); ?>">Tournament Gallery</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.holeinone.index') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.holeinone.index')); ?>">Hole-In-One</a>
                    </div>

                    <!-- Rates -->
                    <a class="nav-link has-submenu collapsed <?php echo e(request()->routeIs('admin.tournament_rates.index') || request()->routeIs('admin.glean.index') || request()->routeIs('admin.gpeak.index') ? 'open' : ''); ?>"
                        data-bs-toggle="collapse" href="#ratesMenu" role="button"
                        aria-expanded="<?php echo e(request()->routeIs('admin.tournament_rates.index') || request()->routeIs('admin.glean.index') || request()->routeIs('admin.gpeak.index') ? 'true' : 'false'); ?>"
                        aria-controls="ratesMenu">
                        <i class="bi bi-cash-coin"></i> Rates
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>
                    <div class="collapse submenu bg-dark <?php echo e(request()->routeIs('admin.tournament_rates.index') || request()->routeIs('admin.glean.index') || request()->routeIs('admin.gpeak.index') ? 'show' : ''); ?>"
                        id="ratesMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.gpeak.index') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.gpeak.index')); ?>">Golf Rates</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.tournament_rates.index') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.tournament_rates.index')); ?>">Tournament Rates</a>
                    </div>

                    <!-- Contact Us -->
                    <a class="nav-link has-submenu 
                        <?php echo e(request()->routeIs('admin.contact.index') || request()->routeIs('admin.careers.index') ? 'open' : ''); ?>"
                        data-bs-toggle="collapse" href="#contactUsMenu" role="button"
                        aria-expanded="<?php echo e(request()->routeIs('admin.contact.index') || request()->routeIs('admin.careers.index') ? 'true' : 'false'); ?>"
                        aria-controls="contactUsMenu">
                        <i class="bi bi-people-fill"></i> Contact Us
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>
                    <div class="collapse submenu bg-dark <?php echo e(request()->routeIs('admin.contact.index') || request()->routeIs('admin.careers.index') ? 'show' : ''); ?>"
                        id="contactUsMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.contact.index') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.contact.index')); ?>">Contact Details</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.careers.index') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.careers.index')); ?>">Careers</a>
                    </div>

                    <!-- Corporate Governance -->
                    <a class="nav-link has-submenu 
                        <?php echo e(request()->routeIs('admin.definitive') || request()->routeIs('admin.asm_minutes') || request()->routeIs('admin.acgr') ? 'open' : ''); ?>"
                        data-bs-toggle="collapse" href="#corpgovMenu" role="button"
                        aria-expanded="<?php echo e(request()->routeIs('admin.definitive') || request()->routeIs('admin.asm_minutes') || request()->routeIs('admin.acgr') ? 'true' : 'false'); ?>"
                        aria-controls="corpgovMenu">
                        <i class="bi bi-person-vcard-fill"></i> Corporate Governance
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>
                    <div class="collapse submenu bg-dark <?php echo e(request()->routeIs('admin.definitive') || request()->routeIs('admin.asm_minutes') || request()->routeIs('admin.acgr') ? 'show' : ''); ?>"
                        id="corpgovMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.definitive') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.definitive')); ?>">Definitive Information Statement</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.asm_minutes') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.asm_minutes')); ?>">ASM Minutes</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.acgr') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.acgr')); ?>">Annual Corporate Governance Report</a>
                    </div>

                    <!-- Settings -->
                    <a class="nav-link has-submenu 
                        <?php echo e(request()->routeIs('admin.menu-settings') || request()->routeIs('admin.footer-settings') ? 'open' : ''); ?>"
                        data-bs-toggle="collapse" href="#settingsMenu" role="button"
                        aria-expanded="<?php echo e(request()->routeIs('admin.menu-settings') || request()->routeIs('admin.footer-settings') ? 'true' : 'false'); ?>"
                        aria-controls="settingsMenu">
                        <i class="bi bi-gear-fill"></i> Settings
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>
                    <div class="collapse submenu bg-dark <?php echo e(request()->routeIs('admin.menu-settings') || request()->routeIs('admin.footer-settings') ? 'show' : ''); ?>"
                        id="settingsMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.menu-settings') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.menu-settings')); ?>">Header</a>
                        <a class="nav-link text-white ps-5 py-2 d-block <?php echo e(request()->routeIs('admin.footer-settings') ? 'active' : ''); ?>"
                            href="<?php echo e(route('admin.footer-settings')); ?>">Footer</a>
                    </div>

                </nav>
            </div>

            <!-- Sidebar Footer / Logout -->
            <div class="sidebar-footer p-3">
                <a href="<?php echo e(route('admin.logout')); ?>" class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </aside>

        <!-- =============================================
             MAIN CONTENT
        ============================================= -->
        <div class="flex-fill">
            <header class="topbar">
                <div class="d-flex align-items-center">
                    <!-- Hamburger: always rendered, shown via CSS on mobile -->
                    <button class="btn btn-light me-2" id="sidebarToggle" style="display:none;">
                        <i class="bi bi-list"></i>
                    </button>
                    <h4 class="m-0 ms-2"><?php echo $__env->yieldContent('page-title', ''); ?></h4>
                </div>

                <div class="d-flex align-items-center">
                    <!-- Dark Mode Toggle Button -->
                    <button class="dark-mode-toggle" id="darkModeToggle">
                        <i class="bi bi-moon-fill"></i>
                    </button>

                    <span class="csd-label me-3"
                        style="font-size: 24px; font-family: Arial, sans-serif; font-weight:bolder; transform:scaleY(1.3);">
                        CSD
                    </span>
                    <img src="<?php echo e(asset('images/CSDLogo.png')); ?>" alt="user"
                        style="height:46px; margin-right:30px;">
                </div>
            </header>

            <main class="p-4">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <div id="google_translate_element"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ── Dark Mode Functionality ──────────────────────────────
        function initDarkMode() {
            const toggleBtn = document.getElementById('darkModeToggle');
            const icon = toggleBtn.querySelector('i');

            // Check for saved preference
            const isDarkMode = localStorage.getItem('darkMode') === 'true';

            // Apply initial mode
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
                icon.classList.remove('bi-moon-fill');
                icon.classList.add('bi-sun-fill');
            }

            // Toggle function
            function toggleDarkMode() {
                document.body.classList.toggle('dark-mode');
                const isDark = document.body.classList.contains('dark-mode');
                localStorage.setItem('darkMode', isDark);

                if (isDark) {
                    icon.classList.remove('bi-moon-fill');
                    icon.classList.add('bi-sun-fill');
                } else {
                    icon.classList.remove('bi-sun-fill');
                    icon.classList.add('bi-moon-fill');
                }
            }

            // Add click event
            toggleBtn.addEventListener('click', toggleDarkMode);
        }

        // Initialize dark mode when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initDarkMode);
        } else {
            initDarkMode();
        }

        // ── Sidebar toggle (mobile) ──────────────────────────────
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.add('show');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('show');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.contains('show') ? closeSidebar() : openSidebar();
        });

        overlay?.addEventListener('click', closeSidebar);

        // Close sidebar on nav-link click (mobile — non-submenu links)
        sidebar?.querySelectorAll('.nav-link:not(.has-submenu)').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992) closeSidebar();
            });
        });

        // ── Only one submenu open at a time ─────────────────────
        const allCollapses = document.querySelectorAll('.collapse');

        allCollapses.forEach(collapseEl => {
            collapseEl.addEventListener('show.bs.collapse', function() {
                allCollapses.forEach(other => {
                    if (other !== collapseEl) {
                        const bsCollapse = bootstrap.Collapse.getInstance(other);
                        if (bsCollapse && other.classList.contains('show')) {
                            bsCollapse.hide();
                        }
                    }
                });
            });
        });

        // ── Chevron rotation ────────────────────────────────────
        document.querySelectorAll('.has-submenu').forEach(parentLink => {
            const targetId = parentLink.getAttribute('href')?.replace('#', '');
            const collapseEl = document.getElementById(targetId);
            if (!collapseEl) return;

            collapseEl.addEventListener('shown.bs.collapse', () => parentLink.classList.add('open'));
            collapseEl.addEventListener('hidden.bs.collapse', () => parentLink.classList.remove('open'));

            if (collapseEl.classList.contains('show')) {
                parentLink.classList.add('open');
            }
        });
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\app\resources\views/admin/layout.blade.php ENDPATH**/ ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RGC ADMIN - @yield('title', 'Dashboard')</title>


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />

    <!-- Custom admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        .topbar {
            height: 70px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid #e6e6e6;
        }

        .sidebar {
            height: 100vh;
            overflow-y: auto;
            flex-shrink: 0;
        }

        .sidebar-footer {
            flex-shrink: 0;
        }

        .flex-fill {
            overflow-y: auto;
            height: 100vh;
        }

        /* Submenu style: match parent color (dark green) and keep background neutral */
        .submenu {
            background: transparent;
            padding-left: 0;
        }

        .submenu .nav-link {
            color: #ffffff !important;
            /* same dark green used across site */
            padding-left: 2.2rem;
            font-size: .95rem;
        }

        .submenu .nav-link:hover {
            background: linear-gradient(to right, #2a5e2d, #1c7020, #03660a);
            /* subtle hover like parent */
            color: #f0f7f3 !important;
        }

        .nav-link:hover {
            background: linear-gradient(to right, #2a5e2d, #1c7020, #03660a) !important;
            /* subtle hover like parent */
            color: #f0f7f3 !important;
        }

        /* Facilities chevron (only for .has-submenu) */
        .has-submenu .chev {
            transition: transform .25s ease;
            font-size: 0.9rem;
        }

        /* rotate when submenu is open */
        .has-submenu.open .chev {
            transform: rotate(180deg);
        }

        /* keep other nav-link styles intact */
        .nav-link {
            color: #f0f7f3 !important;
        }

        .nav-link.active {
            color: #f0f7f3 !important;
            background-color: #f0f7f3;
        }

        /* ---------- Hide scrollbars but keep scrolling ----------
        /* Apply to sidebar and the inner scrollable container used in layout */
        .sidebar,
        .flex-grow-1,
        .submenu,
        .collapse.submenu {
            -ms-overflow-style: none;
            /* IE/Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* Chrome, Safari, Edge (WebKit/Blink) */
        .sidebar::-webkit-scrollbar,
        .flex-grow-1::-webkit-scrollbar,
        .submenu::-webkit-scrollbar,
        .collapse.submenu::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }

        /* Fallback: make scrollbars transparent (in case width:0 is ignored) */
        .sidebar::-webkit-scrollbar-thumb,
        .flex-grow-1::-webkit-scrollbar-thumb,
        .submenu::-webkit-scrollbar-thumb,
        .collapse.submenu::-webkit-scrollbar-thumb {
            background: transparent;
        }

        /* Keep same layout (no shift when scrollbar hidden) */
        .sidebar {
            -webkit-overflow-scrolling: touch;
        }

        */
        /* smooth scrolling on mobile */
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar d-flex flex-column">
            <!-- Brand / Logo -->
            <div class="brand p-3 d-flex align-items-center">
                <img src="{{ asset('images/RivieraFooterLogo.png') }}" alt="logo"
                    style="height:54px; margin-right:10px;">
                <strong
                    style="font-size: 20px; font-family: Arial, sans-serif; font-weight:bold; line-height:1.2; transform:scaleY(1.3)">
                    RGC ADMIN
                </strong>
            </div>

            <!-- Scrollable Menu Container -->
            <div class="flex-grow-1 overflow-auto" style="max-height: calc(100vh - 70px - 70px);">
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}"
                        href="{{ route('admin.home') }}">
                        <i class="bi bi-house-door-fill"></i> Home
                    </a>

                    <a class="nav-link {{ request()->routeIs('admin.about_us.*') ? 'active' : '' }}"
                        href="{{ route('admin.about_us.index') }}">
                        <i class="bi bi-info-circle"></i> About Us
                    </a>

                    <a class="nav-link {{ request()->routeIs('admin.courses') ? 'active' : '' }}"
                        href="{{ route('admin.courses') }}">
                        <i class="bi bi-flag"></i> Courses
                    </a>

                    <a class="nav-link {{ request()->routeIs('admin.membership.index') ? 'active' : '' }}"
                        href="{{ route('admin.membership.index') }}">
                        <i class="bi bi-person-plus-fill"></i> Membership
                    </a>

                    <!-- Facilities -->
                    <a class="nav-link has-submenu 
    {{ request()->routeIs('admin.clubhouse') || request()->routeIs('admin.drivingrange') || request()->routeIs('admin.proshop') || request()->routeIs('admin.locker') || request()->routeIs('admin.membersLounge') || request()->routeIs('admin.lobby') || request()->routeIs('admin.veranda') || request()->routeIs('admin.grill') || request()->routeIs('admin.teehouse') ? 'open' : '' }}"
                        data-bs-toggle="collapse" href="#facilitiesMenu" role="button"
                        aria-expanded="{{ request()->routeIs('admin.clubhouse') || request()->routeIs('admin.drivingrange') || request()->routeIs('admin.proshop') || request()->routeIs('admin.locker') || request()->routeIs('admin.membersLounge') || request()->routeIs('admin.lobby') || request()->routeIs('admin.veranda') || request()->routeIs('admin.grill') || request()->routeIs('admin.teehouse') ? 'true' : 'false' }}"
                        aria-controls="facilitiesMenu">
                        <i class="bi bi-house-check-fill"></i> Facilities
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>

                    <div class="collapse submenu bg-dark {{ request()->routeIs('admin.clubhouse') || request()->routeIs('admin.drivingrange') || request()->routeIs('admin.proshop') || request()->routeIs('admin.locker') || request()->routeIs('admin.membersLounge') || request()->routeIs('admin.lobby') || request()->routeIs('admin.veranda') || request()->routeIs('admin.grill') || request()->routeIs('admin.teehouse') ? 'show' : '' }}"
                        id="facilitiesMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.clubhouse') ? 'active' : '' }}"
                            href="{{ route('admin.clubhouse') }}">Golf Club House</a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.drivingrange') ? 'active' : '' }}"
                            href="{{ route('admin.drivingrange') }}">Driving Range</a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.proshop') ? 'active' : '' }}"
                            href="{{ route('admin.proshop') }}">Proshop</a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.locker') ? 'active' : '' }}"
                            href="{{ route('admin.locker') }}">Locker Room</a>
                        {{-- <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.membersLounge') ? 'active' : '' }}"
                            href="{{ route('admin.membersLounge') }}">Member's Lounge</a> --}}
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.lobby') ? 'active' : '' }}"
                            href="{{ route('admin.lobby') }}">Lobby</a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.veranda') ? 'active' : '' }}"
                            href="{{ route('admin.veranda') }}">Veranda</a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.grill') ? 'active' : '' }}"
                            href="{{ route('admin.grill') }}">Grill</a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.teehouse') ? 'active' : '' }}"
                            href="{{ route('admin.teehouse') }}">Teehouse</a>
                    </div>


                    <!-- Announcement -->
                    <a class="nav-link has-submenu 
                        {{ request()->routeIs('admin.holeinone.index') || request()->routeIs('admin.tournament_gallery.index') || request()->routeIs('admin.coursesched.index') || request()->routeIs('admin.tournaments.index') ? 'open' : '' }}"
                        data-bs-toggle="collapse" href="#announcementMenu" role="button"
                        aria-expanded="{{ request()->routeIs('admin.holeinone.index') || request()->routeIs('admin.tournament_gallery.index') || request()->routeIs('admin.coursesched.index') || request()->routeIs('admin.tournaments.index') ? 'true' : 'false' }}"
                        aria-controls="announcementMenu">
                        <i class="bi bi-megaphone-fill"></i> Announcement
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>

                    <div class="collapse submenu bg-dark {{ request()->routeIs('admin.holeinone.index') || request()->routeIs('admin.tournament_gallery.index') || request()->routeIs('admin.coursesched.index') || request()->routeIs('admin.tournaments.index') ? 'show' : '' }}"
                        id="announcementMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.tournaments.index') ? 'active' : '' }}"
                            href="{{ route('admin.tournaments.index') }}">
                            Tournament & Events
                        </a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.coursesched.index') ? 'active' : '' }}"
                            href="{{ route('admin.coursesched.index') }}">
                            Course Schedule
                        </a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.tournament_gallery.index') ? 'active' : '' }}"
                            href="{{ route('admin.tournament_gallery.index') }}">
                            Tournament Gallery
                        </a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.holeinone.index') ? 'active' : '' }}"
                            href="{{ route('admin.holeinone.index') }}">
                            Hole-In-One
                        </a>
                    </div>

                    <!-- Rates -->
                    <a class="nav-link has-submenu collapsed {{ request()->routeIs('admin.tournament_rates.index') || request()->routeIs('admin.glean.index') || request()->routeIs('admin.gpeak.index') ? 'open' : '' }}"
                        data-bs-toggle="collapse" href="#ratesMenu" role="button"
                        aria-expanded="{{ request()->routeIs('admin.tournament_rates.index') || request()->routeIs('admin.glean.index') || request()->routeIs('admin.gpeak.index') ? 'true' : 'false' }}"
                        aria-controls="ratesMenu">
                        <i class="bi bi-cash-coin"></i> Rates
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>
                    <div class="collapse submenu bg-dark {{ request()->routeIs('admin.tournament_rates.index') || request()->routeIs('admin.glean.index') || request()->routeIs('admin.gpeak.index') ? 'show' : '' }}"
                        id="ratesMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.glean.index') ? 'active' : '' }}"
                            href="{{ route('admin.glean.index') }}">
                            Lean Season
                        </a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.gpeak.index') ? 'active' : '' }}"
                            href="{{ route('admin.gpeak.index') }}">
                            Peak Season
                        </a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.tournament_rates.index') ? 'active' : '' }}"
                            href="{{ route('admin.tournament_rates.index') }}">
                            Tournament Rates
                        </a>
                    </div>
                    {{-- <a class="nav-link {{ request()->routeIs('admin.faq') ? 'active' : '' }}"
                        href="{{ route('admin.faq') }}">
                        <i class="bi bi-question-circle-fill"></i> FAQ
                    </a> --}}

                    <!-- Contact Us -->
                    <a class="nav-link has-submenu 
                        {{ request()->routeIs('admin.contact.index') || request()->routeIs('admin.careers.index') ? 'open' : '' }}"
                        data-bs-toggle="collapse" href="#contactUsMenu" role="button"
                        aria-expanded="{{ request()->routeIs('admin.contact.index') || request()->routeIs('admin.careers.index') ? 'true' : 'false' }}"
                        aria-controls="contactUsMenu">
                        <i class="bi bi-people-fill"></i> Contact Us
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>
                    <div class="collapse submenu bg-dark {{ request()->routeIs('admin.contact.index') || request()->routeIs('admin.careers.index') ? 'show' : '' }}"
                        id="contactUsMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.contact.index') ? 'active' : '' }}"
                            href="{{ route('admin.contact.index') }}">Contact Details</a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.careers.index') ? 'active' : '' }}"
                            href="{{ route('admin.careers.index') }}">Careers</a>
                    </div>

                    <!-- Corporate Governance -->
                    <a class="nav-link has-submenu 
                        {{ request()->routeIs('admin.definitive') || request()->routeIs('admin.asm_minutes') || request()->routeIs('admin.acgr') ? 'open' : '' }}"
                        data-bs-toggle="collapse" href="#corpgovMenu" role="button"
                        aria-expanded="{{ request()->routeIs('admin.definitive') || request()->routeIs('admin.asm_minutes') || request()->routeIs('admin.acgr') ? 'true' : 'false' }}"
                        aria-controls="corpgovMenu">
                        <i class="bi bi-person-vcard-fill"></i> Corporate Governance
                        <i class="bi bi-chevron-down float-end chev"></i>
                    </a>
                    <div class="collapse submenu bg-dark {{ request()->routeIs('admin.definitive') || request()->routeIs('admin.asm_minutes') || request()->routeIs('admin.acgr') ? 'show' : '' }}"
                        id="corpgovMenu">
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.definitive') ? 'active' : '' }}"
                            href="{{ route('admin.definitive') }}">Definitive Information Statement</a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.asm_minutes') ? 'active' : '' }}"
                            href="{{ route('admin.asm_minutes') }}">ASM Minutes</a>
                        <a class="nav-link text-white ps-5 py-2 d-block {{ request()->routeIs('admin.acgr') ? 'active' : '' }}"
                            href="{{ route('admin.acgr') }}">Annual Corporate Governance Report</a>
                    </div>
                </nav>
            </div>

            <!-- Sidebar footer -->
            <div class="sidebar-footer p-3">
                <a href="{{ route('admin.logout') }}" class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex-fill">
            <header class="topbar">
                <div class="d-flex align-items-center">
                    <button class="btn btn-light d-lg-none me-2" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <h4 class="m-0 ms-2">@yield('page-title', '')</h4>
                </div>

                <div class="d-flex align-items-center">
                    <span class="me-3"
                        style="font-size: 24px; font-family: Arial, sans-serif; font-weight:bolder; transform:scaleY(1.3);">
                        CSD
                    </span>
                    <img src="{{ asset('images/CSDLogo.png') }}" alt="user"
                        style="height:46px; margin-right:30px;">
                </div>
            </header>

            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
    <div id="google_translate_element"></div>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // sidebar toggle (for small screens)
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar')?.classList.toggle('collapsed');
        });

        // Only allow one submenu open at a time
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

        // Chevron rotation logic
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

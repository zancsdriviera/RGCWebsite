<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RGC ADMIN - @yield('title', 'Dashboard')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional icons (for sidebar icons) -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />

    <!-- Custom admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        /* small helper to keep header consistent */
        .topbar {
            height: 70px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid #e6e6e6;
        }

        /* Sidebar footer (logout button) */
        .sidebar {
            height: 100vh;
            /* full viewport height */
            overflow-y: auto;
            /* scroll if sidebar content overflows */
            flex-shrink: 0;
            /* prevent shrinking when main content grows */
        }

        .sidebar-footer {
            flex-shrink: 0;
            /* keep logout button at the bottom */
        }

        .flex-fill {
            overflow-y: auto;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar d-flex flex-column">
            <div class="brand p-3 d-flex align-items-center">
                <img src="{{ asset('images/RivieraFooterLogo.png') }}" alt="logo"
                    style="height:54px; margin-right:10px;">
                <strong
                    style="font-size: 22px; font-family: Arial, sans-serif; font-stretch:condensed; font-weight:bold; line-height:1.2; transform:scaleY(1.3)">RGC
                    ADMIN</strong>
            </div>

            <nav class="nav flex-column flex-grow-1">
                <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}"
                    href="{{ route('admin.home') }}">
                    <i class="bi bi-house-door-fill"></i> Home
                </a>

                <a class="nav-link {{ request()->is('#') ? 'active' : '' }}" href="{{ url('#') }}">
                    <i class="bi bi-info-circle"></i> About Us
                </a>

                <a class="nav-link {{ request()->routeIs('admin.courses') ? 'active' : '' }}"
                    href="{{ route('admin.courses') }}">
                    <i class="bi bi-flag"></i> Courses
                </a>

                <a class="nav-link {{ request()->is('#
                                                
                                                ')
                    ? 'active'
                    : '' }}"
                    href="{{ url('#') }}">
                    <i class="bi bi-people-fill"></i> Membership
                </a>
            </nav>

            <!-- Sidebar footer: Logout button -->
            <div class="sidebar-footer">
                <a href="{{ route('admin.logout') }}" class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex-fill">
            <header class="topbar">
                <div class="d-flex align-items-center">
                    <button class="btn btn-light d-lg-none me-2" id="sidebarToggle"><i class="bi bi-list"></i></button>
                    <h4 class="m-0 ms-2">@yield('page-title', '')</h4>
                </div>

                <div class="d-flex align-items-center">
                    <span class="me-3"
                        style="font-size: 24px; font-family: Arial, sans-serif; font-stretch:normal; font-weight:bolder; line-height:1.2; transform:scaleY(1.3);">CSD</span>
                    <img src="{{ asset('images/CSDLogo.png') }}" alt="user"
                        style="height:46px; margin-right:30px;">
                </div>
            </header>

            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // simple sidebar toggle for small screens
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar')?.classList.toggle('collapsed');
        });
    </script>
</body>

</html>

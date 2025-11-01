<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CMS Admin - @yield('title', 'Dashboard')</title>

    <!-- Local Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        body>.d-flex {
            height: 100%;
        }

        #sidebar {
            flex: 0 0 260px !important;
            width: 260px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* ensures top menu + footer spacing */
            height: 100vh;
        }

        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        main {
            height: 100vh;
            overflow-y: auto;
        }

        #sidebar-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 998;
        }

        #sidebar-backdrop.show {
            display: block;
        }

        #sidebar.show {
            transform: translateX(0);
            position: fixed;
            z-index: 999;
            height: 100vh;
            top: 0;
            left: 0;
        }

        @media (max-width: 991px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            main {
                overflow-y: auto;
            }
        }
    </style>

    @stack('head')
</head>

<body class="bg-light">

    <div class="d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark text-white p-3">
            <div class="d-flex align-items-center mb-4">
                <div class="me-2">
                    <img src="{{ asset('images/RivieraHeaderLogo3.png') }}" alt="Logo"
                        style="width:44px;height:44px;border-radius:6px;">
                </div>
                <div>
                    <h5 class="mb-0">CMS Panel</h5>
                    <small class="text-muted">Content Manager</small>
                </div>
            </div>

            <div class="mb-3">
                <input id="sidebarSearch" class="form-control form-control-sm" placeholder="Search pages...">
            </div>

            <div class="list-group list-group-flush" id="pagesList" role="navigation" aria-label="Pages list">
                @foreach ($pagesList as $p)
                    <a href="{{ route('admin.admin_courses', $p) }}"
                        class="list-group-item list-group-item-action bg-transparent text-white d-flex justify-content-between align-items-center {{ ($page ?? '') === $p ? 'active' : '' }}">
                        <span class="text-capitalize">{{ str_replace('-', ' ', $p) }}</span>
                        @if (isset($page) && $page === $p)
                            <span class="badge bg-light text-dark">editing</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.admin_aus', $p) }}"
                        class="list-group-item list-group-item-action bg-transparent text-white d-flex justify-content-between align-items-center {{ ($page ?? '') === $p ? 'active' : '' }}">
                        <span class="text-capitalize">{{ str_replace('-', ' ', $p) }}</span>
                        @if (isset($page) && $page === $p)
                            <span class="badge bg-light text-dark">editing</span>
                        @endif
                    </a>
                @endforeach
            </div>

            <div class="mt-auto pt-3">
                <hr class="border-secondary">
                <div class="d-flex flex-column gap-2">
                    <small class="text-muted">
                        <span style="color: white; text-transform: uppercase; font-weight: bold">
                            Logged in as <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                        </span>
                    </small>

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm w-100">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Backdrop for mobile -->
        <div id="sidebar-backdrop" onclick="toggleSidebar(false)"></div>

        <!-- Content Area -->
        <main class="flex-grow-1 p-4">
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <button id="sidebarToggle" class="btn btn-outline-secondary btn-sm d-md-none"
                        aria-label="Toggle sidebar">☰</button>
                    <h3 class="m-0 text-capitalize">@yield('title', $page ?? 'Editor')</h3>
                </div>

                <a href="{{ url('/') }}" class="btn btn-light btn-sm" target="blank">View Site</a>
            </div>


            @yield('content')
        </main>
    </div>

    <!-- Local Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom Admin JS -->
    <script>
        // Sidebar search
        document.getElementById('sidebarSearch')?.addEventListener('input', function(e) {
            const q = e.target.value.toLowerCase();
            document.querySelectorAll('#pagesList a').forEach(a => {
                const txt = a.textContent.trim().toLowerCase();
                a.style.display = txt.includes(q) ? 'block' : 'none';
            });
        });

        // Sidebar toggle
        function toggleSidebar(forceShow) {
            const sb = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            const shouldShow = (typeof forceShow === 'boolean') ? forceShow : !sb.classList.contains('show');

            if (shouldShow) {
                sb.classList.add('show');
                backdrop.classList.add('show');
                document.body.style.overflow = 'hidden';
            } else {
                sb.classList.remove('show');
                backdrop.classList.remove('show');
                document.body.style.overflow = '';
            }
        }

        document.getElementById('sidebarToggle')?.addEventListener('click', e => {
            e.preventDefault();
            toggleSidebar();
        });

        // Close sidebar on mobile link click
        document.querySelectorAll('#pagesList a').forEach(a => {
            a.addEventListener('click', function() {
                if (window.matchMedia('(max-width: 991px)').matches) toggleSidebar(false);
            });
        });

        // Image preview
        document.addEventListener('change', e => {
            if (e.target.matches('input[type="file"].img-input')) {
                const preview = e.target.closest('form').querySelector('.img-preview');
                const file = e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = ev => preview && (preview.src = ev.target.result);
                reader.readAsDataURL(file);
            }
        });

        // Close sidebar on Escape key
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                const sb = document.getElementById('sidebar');
                if (sb.classList.contains('show')) toggleSidebar(false);
            }
        });
    </script>

    @stack('scripts')
</body>

</html>

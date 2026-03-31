@php
    // Fetch only main menus (excluding 'config' type)
    $mainMenus = \App\Models\MenuSetting::where('menu_type', 'main')->where('is_active', true)->orderBy('order')->get();

    $dropdownParents = \App\Models\MenuSetting::where('menu_type', 'dropdown_parent')
        ->where('is_active', true)
        ->orderBy('order')
        ->get();

    $headerSettings = \App\Models\MenuSetting::getHeaderSettings();
@endphp

<div class="M1_navbar">
    <!-- Top contact bar -->
    <div class="top-contact-bar d-flex justify-content-end align-items-center py-1 px-3">
        <div>
            @if ($headerSettings && $headerSettings->phone_number)
                <i class="bi bi-telephone-fill"></i>
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $headerSettings->phone_number) }}" class="ms-1 phone-link">
                    {{ $headerSettings->phone_number }}
                </a>
            @endif

            @if ($headerSettings && $headerSettings->facebook_url)
                <a href="{{ $headerSettings->facebook_url }}" target="blank" class="text-white social-icon">
                    <i class="bi bi-facebook"></i>
                </a>
            @endif

            @if ($headerSettings && $headerSettings->instagram_url)
                <a href="{{ $headerSettings->instagram_url }}" target="blank" class="text-white social-icon">
                    <i class="bi bi-instagram"></i>
                </a>
            @endif

            @if ($headerSettings && $headerSettings->youtube_url)
                <a href="{{ $headerSettings->youtube_url }}" target="_blank" class="text-white social-icon">
                    <i class="bi bi-youtube"></i>
                </a>
            @endif
        </div>
    </div>

    <!-- Main navbar -->
    <nav class="navbar navbar-expand-lg navbar-light main-navbar px-3">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home.frontend') }}">
            @if ($headerSettings && $headerSettings->header_logo_path)
                <img src="{{ asset('storage/' . $headerSettings->header_logo_path) }}" alt="Riviera Golf Club"
                    height="80">
            @else
                <img src="{{ asset('images/RivieraHeaderLogo.png') }}" alt="Riviera Golf Club" height="80">
            @endif
            <span class="brand-text ms-2">{{ $headerSettings->brand_text ?? 'RIVIERA GOLF CLUB' }}</span>
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu links with proper spacing -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto">
                @foreach ($mainMenus as $menu)
                    @php
                        $url = $menu->route_name ? route($menu->route_name) : $menu->url ?? '#';
                        $isActive =
                            request()->is(trim(parse_url($url, PHP_URL_PATH), '/')) ||
                            ($menu->route_name && request()->routeIs($menu->route_name));
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link {{ $isActive ? 'active' : '' }}" href="{{ $url }}">
                            {{ $menu->menu_label }}
                        </a>
                    </li>
                @endforeach

                @foreach ($dropdownParents as $parent)
                    @php
                        $childrenByCategory = \App\Models\MenuSetting::where('parent_key', $parent->menu_key)
                            ->where('is_active', true)
                            ->orderBy('order')
                            ->get()
                            ->groupBy('category');

                        // Check if any child is active
                        $isParentActive = false;
                        foreach ($childrenByCategory as $category => $categoryChildren) {
                            foreach ($categoryChildren as $child) {
                                $childUrl = $child->route_name ? route($child->route_name) : $child->url ?? '#';
                                if (
                                    request()->is(trim(parse_url($childUrl, PHP_URL_PATH), '/')) ||
                                    ($child->route_name && request()->routeIs($child->route_name))
                                ) {
                                    $isParentActive = true;
                                    break 2;
                                }
                            }
                        }
                    @endphp

                    @if ($childrenByCategory->count() > 0)
                        <li class="nav-item dropdown position-relative">
                            <a class="nav-link {{ $isParentActive ? 'active' : '' }}" href="#"
                                id="{{ $parent->menu_key }}Dropdown">
                                {{ $parent->menu_label }}
                            </a>

                            <div class="dropdown-menu p-3 custom-dropdown"
                                aria-labelledby="{{ $parent->menu_key }}Dropdown">
                                <div class="d-flex">
                                    @foreach ($childrenByCategory as $category => $categoryChildren)
                                        @if ($category)
                                            <!-- Categories with headers -->
                                            <div class="me-4">
                                                <h6 class="dropdown-header facilities_header">{{ $category }}</h6>
                                                @foreach ($categoryChildren as $child)
                                                    @php
                                                        $childUrl = $child->route_name
                                                            ? route($child->route_name)
                                                            : $child->url ?? '#';
                                                        $isChildActive =
                                                            request()->is(
                                                                trim(parse_url($childUrl, PHP_URL_PATH), '/'),
                                                            ) ||
                                                            ($child->route_name &&
                                                                request()->routeIs($child->route_name));
                                                    @endphp
                                                    <a class="dropdown-item {{ $isChildActive ? 'active' : '' }}"
                                                        href="{{ $childUrl }}">
                                                        {{ $child->menu_label }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach

                                    @foreach ($childrenByCategory as $category => $categoryChildren)
                                        @if (!$category)
                                            <!-- Uncategorized items - stack vertically -->
                                            <div class="me-4">
                                                @foreach ($categoryChildren as $child)
                                                    @php
                                                        $childUrl = $child->route_name
                                                            ? route($child->route_name)
                                                            : $child->url ?? '#';
                                                        $isChildActive =
                                                            request()->is(
                                                                trim(parse_url($childUrl, PHP_URL_PATH), '/'),
                                                            ) ||
                                                            ($child->route_name &&
                                                                request()->routeIs($child->route_name));
                                                    @endphp
                                                    <a class="dropdown-item {{ $isChildActive ? 'active' : '' }}"
                                                        href="{{ $childUrl }}">
                                                        {{ $child->menu_label }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach

                @php
                    $liveHeader = \App\Models\LiveScoreHeader::where('status', 1)->first();
                @endphp

                @if ($liveHeader)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('live-scores') ? 'active' : '' }}"
                            href="{{ route('live-scores') }}">
                            LIVE SCORING
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>

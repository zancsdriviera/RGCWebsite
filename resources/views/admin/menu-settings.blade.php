@extends('admin.layout')

@section('content')
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0">Menu Settings</h1>
                <p class="text-muted mt-1">Customize your navigation menu labels and visibility</p>
            </div>
            <div>
                <a href="{{ route('admin.menu-settings.reset') }}" class="btn btn-outline-warning"
                    onclick="return confirm('Are you sure? This will reset all menus to default.')">
                    <i class="bi bi-arrow-repeat me-1"></i>Reset to Default
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            $headerSettings = \App\Models\MenuSetting::getHeaderSettings();
        @endphp

        <!-- Header Settings Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-image-fill me-2"></i>Header Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.menu-settings.update-header') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Header Logo</label>
                                    @if ($headerSettings && $headerSettings->header_logo_path)
                                        <div class="mb-2 p-3 bg-light rounded text-center">
                                            <img src="{{ asset('storage/' . $headerSettings->header_logo_path) }}"
                                                alt="Current Logo" style="height: 80px; object-fit: contain;">
                                            <p class="text-muted small mt-2 mb-0">Current Logo</p>
                                        </div>
                                    @else
                                        <div class="mb-2 p-3 bg-light rounded text-center">
                                            <p class="text-muted mb-0">No logo uploaded</p>
                                        </div>
                                    @endif
                                    <input type="file" name="header_logo" class="form-control"
                                        accept="image/jpeg,image/png,image/jpg,image/svg">
                                    <div class="form-text">Recommended size: 200x80px. Max 10MB. Supported: JPG, PNG, SVG
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Brand Text</label>
                                    <input type="text" name="brand_text" class="form-control"
                                        value="{{ old('brand_text', $headerSettings->brand_text ?? 'RIVIERA GOLF CLUB') }}">
                                    <div class="form-text">The text that appears next to the logo in the header</div>
                                </div>
                            </div>

                            <div class="border-top pt-3 mt-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i>Update Header Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu Configuration Section -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-list-ul me-2"></i>Navigation Menu Configuration
                        </h5>
                    </div>
                    <div class="card-body pb-5">
                        <form action="{{ route('admin.menu-settings.update-menus') }}" method="POST" id="menuForm">
                            @csrf
                            @method('PUT')

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50">Order</th>
                                            <th width="200">Menu Type</th>
                                            <th width="250">Menu Label</th>
                                            <th width="200">Parent Menu</th>
                                            <th width="200">Category</th>
                                            <th width="250">Route/URL</th>
                                            <th width="80">Status</th>
                                            <th width="80">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $groupedMenus = [
                                                'main' => $menus->where('menu_type', 'main'),
                                                'dropdown_parent' => $menus->where('menu_type', 'dropdown_parent'),
                                                'dropdown_child' => $menus->where('menu_type', 'dropdown_child'),
                                            ];
                                        @endphp

                                        @foreach ($groupedMenus as $type => $menusGroup)
                                            @if ($menusGroup->count() > 0)
                                                <tr class="table-secondary">
                                                    <td colspan="7" class="fw-bold">
                                                        @if ($type == 'main')
                                                            <i class="bi bi-star-fill me-2"></i>Main Menus
                                                        @elseif($type == 'dropdown_parent')
                                                            <i class="bi bi-chevron-down me-2"></i>Dropdown Parent Menus
                                                        @else
                                                            <i class="bi bi-diagram-3 me-2"></i>Dropdown Child Menus
                                                        @endif
                                                    </td>
                                                </tr>

                                                @foreach ($menusGroup as $menu)
                                                    <tr>
                                                        <td>
                                                            <input type="number" name="menus[{{ $menu->id }}][order]"
                                                                class="form-control form-control-sm"
                                                                value="{{ $menu->order }}" style="width: 70px;">
                                                        </td>
                                                        <td>
                                                            @if ($menu->menu_type == 'main')
                                                                <span class="badge bg-primary">Main Menu</span>
                                                            @elseif($menu->menu_type == 'dropdown_parent')
                                                                <span class="badge bg-info">Dropdown Parent</span>
                                                            @else
                                                                <span class="badge bg-secondary">Dropdown Child</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                name="menus[{{ $menu->id }}][menu_label]"
                                                                class="form-control form-control-sm"
                                                                value="{{ $menu->menu_label }}" required>
                                                            <small class="text-muted">Key: {{ $menu->menu_key }}</small>
                                                        </td>
                                                        <td>
                                                            @if ($menu->parent_key)
                                                                @php
                                                                    $parent = $menus
                                                                        ->where('menu_key', $menu->parent_key)
                                                                        ->first();
                                                                @endphp
                                                                <span
                                                                    class="badge bg-light text-dark">{{ $parent->menu_label ?? $menu->parent_key }}</span>
                                                            @else
                                                                <span class="text-muted">—</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($menu->menu_type == 'dropdown_child')
                                                                <input type="text"
                                                                    name="menus[{{ $menu->id }}][category]"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $menu->category }}"
                                                                    placeholder="e.g., CLUB FACILITIES">
                                                            @else
                                                                <span class="text-muted">—</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($menu->route_name)
                                                                <input type="text"
                                                                    name="menus[{{ $menu->id }}][route_name]"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $menu->route_name }}"
                                                                    placeholder="route.name" disabled readonly
                                                                    style="background-color: #e9ecef; cursor: not-allowed;">
                                                                <input type="hidden"
                                                                    name="menus[{{ $menu->id }}][route_name]"
                                                                    value="{{ $menu->route_name }}">
                                                            @elseif($menu->url)
                                                                <input type="text"
                                                                    name="menus[{{ $menu->id }}][url]"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $menu->url }}" placeholder="/custom-url"
                                                                    disabled readonly
                                                                    style="background-color: #e9ecef; cursor: not-allowed;">
                                                                <input type="hidden"
                                                                    name="menus[{{ $menu->id }}][url]"
                                                                    value="{{ $menu->url }}">
                                                            @else
                                                                <span class="text-muted">No link</span>
                                                                <input type="hidden"
                                                                    name="menus[{{ $menu->id }}][route_name]"
                                                                    value="">
                                                                <input type="hidden"
                                                                    name="menus[{{ $menu->id }}][url]"
                                                                    value="">
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="form-check form-switch">
                                                                <input type="hidden"
                                                                    name="menus[{{ $menu->id }}][is_active]"
                                                                    value="0">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="menus[{{ $menu->id }}][is_active]"
                                                                    value="1" {{ $menu->is_active ? 'checked' : '' }}
                                                                    style="cursor: pointer;">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <small class="text-muted">#{{ $menu->id }}</small>
                                                            <input type="hidden" name="menus[{{ $menu->id }}][id]"
                                                                value="{{ $menu->id }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- How to Use Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-info-circle me-2"></i>How to Use
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <li><strong>Order:</strong> Controls the display order of menus. Lower numbers appear first.
                            </li>
                            <li><strong>Menu Label:</strong> The text that appears on the navigation bar. You can change
                                "HOME" to anything like "Module 1".</li>
                            <li><strong>Category:</strong> For dropdown child menus, you can group them under headers like
                                "CLUB FACILITIES" or "RESTAURANT". Leave blank for no header.</li>
                            <li><strong>Route/URL:</strong> You can't change anything here, but you can see the route name
                                or URL for reference when
                                creating new pages or custom links.
                            </li>
                            <li><strong>Status:</strong> Toggle to show/hide menu items.</li>
                            <li><strong>Reset Button:</strong> Click to restore all menus to their default settings.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Save Button -->
    <div class="floating-save-btn">
        <button type="submit" form="menuForm" class="btn btn-primary shadow-lg position-fixed"
            style="bottom: 30px; right: 30px; z-index: 1050; border-radius: 50px; padding: 12px 24px; font-weight: 600;">
            <i class="bi bi-check-square me-2"></i>Save Changes
        </button>
    </div>

    <style>
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .floating-save-btn {
                bottom: 20px;
                right: 20px;
            }

            .floating-save-btn .btn {
                padding: 6px 16px;
                font-size: 13px;
            }

            .container-fluid {
                padding-bottom: 70px;
            }
        }
    </style>
@endsection

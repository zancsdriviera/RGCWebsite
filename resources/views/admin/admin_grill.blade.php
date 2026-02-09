@extends('admin.layout')
@section('title', 'Grill')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Grill</h3>

        @php
            $content = $content ?? null;
            $carousel = $content->carousel_images ?? [];
            $menu = $content->menu_items ?? [];

            // Helper function to normalize carousel item format
            function normalizeCarouselItem($item, $index)
            {
                if (is_array($item) && isset($item['type'])) {
                    // Already in new format
                    return [
                        'path' => $item['path'] ?? '',
                        'type' => $item['type'] ?? 'image',
                        'original_name' => $item['original_name'] ?? basename($item['path'] ?? ''),
                        'is_old_format' => false,
                    ];
                } else {
                    // Old format (simple string path)
                    return [
                        'path' => $item,
                        'type' => 'image',
                        'original_name' => basename($item),
                        'is_old_format' => true,
                    ];
                }
            }
        @endphp

        {{-- Carousel --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-images me-1"></i>Carousel Items (Images & Videos)</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.grill.carousel.upload') }}" method="POST" enctype="multipart/form-data"
                    id="carouselUploadForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Upload Carousel Items</label>
                        <input type="file" name="carousel_images[]" multiple class="form-control" required
                            accept="image/*,video/mp4">
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            You can select multiple images (JPG, PNG, WebP) or videos (MP4).
                            Maximum file size: 5MB for images, 50MB for videos.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-file-earmark-arrow-up me-1"></i>Upload Carousel Items
                    </button>
                </form>

                <hr class="my-4">

                @if (count($carousel) > 0)
                    @php
                        $imageCount = 0;
                        $videoCount = 0;
                        foreach ($carousel as $item) {
                            $normalized = normalizeCarouselItem($item, 0);
                            if ($normalized['type'] === 'video') {
                                $videoCount++;
                            } else {
                                $imageCount++;
                            }
                        }
                    @endphp
                    <h6 class="mb-3">
                        Current Carousel Items ({{ count($carousel) }} total:
                        {{ $imageCount }} image{{ $imageCount != 1 ? 's' : '' }},
                        {{ $videoCount }} video{{ $videoCount != 1 ? 's' : '' }})
                    </h6>
                    <div class="row g-3">
                        @foreach ($carousel as $i => $rawItem)
                            @php
                                $item = normalizeCarouselItem($rawItem, $i);
                            @endphp
                            <div class="col-md-3 col-sm-6" id="carouselCard{{ $i }}">
                                <div class="card h-100">
                                    <div class="card-img-top" style="height: 140px; overflow: hidden;">
                                        @if ($item['type'] === 'video')
                                            <video class="w-100 h-100 object-fit-cover" style="object-fit: cover;" muted>
                                                <source src="{{ asset($item['path']) }}" type="video/mp4">
                                            </video>
                                            <div class="position-absolute top-0 start-0 bg-dark text-white px-2 py-1 small">
                                                <i class="bi bi-play-circle me-1"></i>Video
                                            </div>
                                        @else
                                            <img src="{{ asset($item['path']) }}" class="w-100 h-100 object-fit-cover"
                                                alt="Carousel Image" style="object-fit: cover;">
                                        @endif
                                        @if ($item['is_old_format'])
                                            <div class="position-absolute top-0 end-0 bg-info text-white px-2 py-1 small">
                                                <i class="bi bi-arrow-clockwise me-1"></i>Old Format
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <p class="small text-muted mb-2">
                                            <strong>Type:</strong> {{ ucfirst($item['type']) }}<br>
                                            <strong>File:</strong> {{ $item['original_name'] }}
                                        </p>
                                        <div class="btn-group w-100" role="group">
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#updateCarouselModal{{ $i }}">
                                                <i class="bi bi-arrow-repeat me-1"></i> Update
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                                data-action="{{ route('admin.grill.carousel.remove', $i) }}"
                                                data-card-id="carouselCard{{ $i }}" data-type="carousel"
                                                data-name="{{ ucfirst($item['type']) }} Item {{ $i + 1 }}"
                                                data-preview="{{ asset($item['path']) }}"
                                                data-media-type="{{ $item['type'] }}">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Update Carousel Modal --}}
                            <div class="modal fade" id="updateCarouselModal{{ $i }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.grill.carousel.update', $i) }}" method="POST"
                                            enctype="multipart/form-data" class="update-carousel-form">
                                            @csrf
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Update Carousel Item</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-3">
                                                    <p class="text-muted small">Current {{ $item['type'] }}:</p>
                                                    @if ($item['type'] === 'video')
                                                        <video class="img-fluid rounded" style="max-height: 180px;" controls
                                                            muted>
                                                            <source src="{{ asset($item['path']) }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @else
                                                        <img src="{{ asset($item['path']) }}" class="img-fluid rounded"
                                                            style="max-height: 180px; object-fit: contain;">
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Replace with new file</label>
                                                    <input type="file" name="image" class="form-control" required
                                                        accept="image/*,video/mp4">
                                                    <div class="form-text">
                                                        <i class="bi bi-info-circle me-1"></i>
                                                        JPG, PNG, WebP images (max 5MB) or MP4 videos (max 50MB)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-check2-square me-1"></i>Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        No carousel items uploaded yet. Upload images or videos to showcase the grill area.
                    </div>
                @endif
            </div>
        </div>

        {{-- Menu Categories Management --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-tags me-1"></i>Menu Categories</h5>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="bi bi-plus-circle me-1"></i>Add Category
                </button>
            </div>
            <div class="card-body">
                @php
                    $categories = $content->menu_categories ?? [];
                    $menuItems = $content->menu_items ?? [];

                    // Count items per category
                    $categoryCounts = [];
                    foreach ($menuItems as $item) {
                        $catId = $item['category_id'] ?? null;
                        if ($catId) {
                            $categoryCounts[$catId] = ($categoryCounts[$catId] ?? 0) + 1;
                        }
                    }
                @endphp

                @if (count($categories) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Items</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    @php
                                        $itemCount = $categoryCounts[$category['id']] ?? 0;
                                    @endphp
                                    <tr id="categoryRow{{ $category['id'] }}">
                                        <td><span class="badge bg-secondary">{{ $category['id'] }}</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if (!empty($category['image']))
                                                    <img src="{{ asset('storage/' . str_replace('/storage/', '', $category['image'])) }}"
                                                        class="rounded me-2"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="rounded bg-light me-2 d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <strong>{{ $category['name'] }}</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="small text-muted">
                                            {{ $category['description'] ? Str::limit($category['description'], 60) : 'No description' }}
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $itemCount }}
                                                item{{ $itemCount != 1 ? 's' : '' }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#updateCategoryModal{{ $category['id'] }}">
                                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                                </button>
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                                    data-action="{{ route('admin.grill.category.remove', $category['id']) }}"
                                                    data-row-id="categoryRow{{ $category['id'] }}" data-type="category"
                                                    data-name="{{ $category['name'] }}"
                                                    data-preview="{{ !empty($category['image']) ? asset('storage/' . str_replace('/storage/', '', $category['image'])) : '' }}"
                                                    data-media-type="image">
                                                    <i class="bi bi-trash me-1"></i>Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Update Category Modal --}}
                                    <div class="modal fade" id="updateCategoryModal{{ $category['id'] }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.grill.category.update', $category['id']) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Edit Category: {{ $category['name'] }}
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (!empty($category['image']))
                                                            <div class="text-center mb-3">
                                                                <p class="text-muted small">Current Image:</p>
                                                                <img src="{{ asset('storage/' . str_replace('/storage/', '', $category['image'])) }}"
                                                                    class="img-fluid rounded mb-2"
                                                                    style="max-height: 150px; object-fit: contain;">
                                                                <div class="form-text">
                                                                    <i class="bi bi-info-circle me-1"></i>
                                                                    Upload new image to replace current one
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="mb-3">
                                                            <label class="form-label">Category Name</label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ $category['name'] }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="description" class="form-control" rows="3">{{ $category['description'] }}</textarea>
                                                            <div class="form-text">
                                                                Optional: Brief description displayed in lightbox
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Category Image</label>
                                                            <input type="file" name="image" class="form-control"
                                                                accept="image/*">
                                                            <div class="form-text">
                                                                <i class="bi bi-info-circle me-1"></i>
                                                                JPG, PNG, or WebP format. Maximum size: 5MB
                                                                @if (!empty($category['image']))
                                                                    <br><span class="text-warning"><i
                                                                            class="bi bi-exclamation-triangle me-1"></i>Leave
                                                                        empty to keep current image</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="bi bi-check2-square me-1"></i>Update Category
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        No categories created yet. Create categories to organize your menu items.
                    </div>
                @endif
            </div>
        </div>

        {{-- Add Category Modal --}}
        <div class="modal fade" id="addCategoryModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.grill.category.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Add New Category</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                                <div class="form-text">
                                    Optional: Brief description displayed in lightbox
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Optional: JPG, PNG, or WebP format. Maximum size: 5MB
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-plus-circle me-1"></i>Add Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Menu Items --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-egg-fried me-1"></i>Menu Items</h5>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                    <i class="bi bi-plus-circle me-1"></i>Add Menu Item
                </button>
            </div>
            <div class="card-body">
                @if (count($menu) > 0)
                    <div class="row g-3">
                        @foreach ($menu as $i => $item)
                            @php
                                $categoryName = 'Uncategorized';
                                if (isset($item['category_id']) && $item['category_id']) {
                                    $foundCategory = collect($categories)->firstWhere('id', $item['category_id']);
                                    $categoryName = $foundCategory['name'] ?? 'Uncategorized';
                                }
                            @endphp
                            <div class="col-md-3 col-sm-6" id="menuCard{{ $i }}">
                                <div class="card h-100">
                                    <div class="card-img-top"
                                        style="height: 140px; overflow: hidden; background-color: #f8f9fa;">
                                        @if (!empty($item['image']) && $item['image'] !== '')
                                            <img src="{{ asset('storage/' . str_replace('/storage/', '', $item['image'])) }}"
                                                class="w-100 h-100 object-fit-cover"
                                                alt="{{ $item['name'] ?? 'Menu Item' }}" style="object-fit: cover;">
                                        @else
                                            <div
                                                class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                <i class="bi bi-image fs-1"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="card-title fw-bold mb-0">{{ $item['name'] ?? 'Unnamed Item' }}</h6>
                                            <span class="badge bg-secondary">{{ $categoryName }}</span>
                                        </div>
                                        <p class="card-text text-muted mb-2">{{ $item['price'] ?? '₱0.00' }}</p>
                                        <div class="btn-group w-100" role="group">
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#updateMenuModal{{ $i }}">
                                                <i class="bi bi-arrow-repeat me-1"></i> Update
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                                data-action="{{ route('admin.grill.menu.remove', $i) }}"
                                                data-card-id="menuCard{{ $i }}" data-type="menu"
                                                data-name="{{ $item['name'] ?? 'Unnamed Item' }}"
                                                @if (!empty($item['image']) && $item['image'] !== '') data-preview="{{ asset('storage/' . str_replace('/storage/', '', $item['image'])) }}" @endif
                                                data-media-type="image">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Update Menu Modal with Category Selection --}}
                            <div class="modal fade" id="updateMenuModal{{ $i }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.grill.menu.update', $i) }}" method="POST"
                                            enctype="multipart/form-data" class="update-menu-form">
                                            @csrf
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Update Menu Item</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Item Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $item['name'] ?? '' }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Price</label>
                                                    <input type="text" name="price" class="form-control price-input"
                                                        placeholder="Enter amount (e.g., 300 for ₱300.00)" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select name="category_id" class="form-select">
                                                        <option value="">-- Uncategorized --</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category['id'] }}"
                                                                {{ ($item['category_id'] ?? null) == $category['id'] ? 'selected' : '' }}>
                                                                {{ $category['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Item Image</label>
                                                    @if (!empty($item['image']) && $item['image'] !== '')
                                                        <div class="text-center mb-2">
                                                            <p class="text-muted small">Current Image:</p>
                                                            <img src="{{ asset('storage/' . str_replace('/storage/', '', $item['image'])) }}"
                                                                class="img-fluid rounded"
                                                                style="max-height: 150px; object-fit: contain;">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="image" class="form-control"
                                                        accept="image/*">
                                                    <div class="form-text">
                                                        <i class="bi bi-info-circle me-1"></i>
                                                        Optional: JPG, PNG, or WebP format. Maximum size: 5MB
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-check2-square me-1"></i>Update Menu Item
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        No menu items yet. Click <strong>Add Menu Item</strong> to create one.
                    </div>
                @endif
            </div>
        </div>

        {{-- Update Add Menu Modal with Category Selection --}}
        <div class="modal fade" id="addMenuModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.grill.menu.add') }}" method="POST" enctype="multipart/form-data"
                        id="addMenuForm">
                        @csrf
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Add Menu Item</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Item Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" name="price" class="form-control price-input"
                                    placeholder="Enter amount (e.g., 300 for ₱300.00)" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select">
                                    <option value="">-- Uncategorized --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Item Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Optional: JPG, PNG, or WebP format. Maximum size: 5MB
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-plus-circle me-1"></i>Add Menu Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Add Menu Modal --}}
        <div class="modal fade" id="addMenuModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.grill.menu.add') }}" method="POST" enctype="multipart/form-data"
                        id="addMenuForm">
                        @csrf
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Add Menu Item</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Item Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" name="price" class="form-control price-input" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Item Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Optional: JPG, PNG, or WebP format. Maximum size: 5MB
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-plus-circle me-1"></i>Add Menu Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Shared Delete Modal --}}
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-trash me-1"></i>Confirm Delete
                        </h5>
                    </div>
                    <div class="modal-body text-center">
                        <div id="deletePreviewWrap" class="mb-3"></div>
                        <div id="deleteConfirmText"></div>
                        <p class="text-muted small mt-2">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Success Modal --}}
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-check-circle me-1"></i>Success
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <span id="successModalMessage">{{ session('modal_message') ?? '' }}</span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Warning Modal for File Size Limit --}}
        <div class="modal fade" id="warningModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>File Too Large
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p id="warningMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4-Grid Gallery Section -->
        <hr>
        <h4>4 Grid Pictures</h4>

        <div class="gallery-grid">

            {{-- EXISTING IMAGES --}}
            @foreach ($content->gallery_images ?? [] as $index => $img)
                <div class="gallery-card">
                    @php
                        // Handle both string and array formats
                        if (is_array($img)) {
                            // If it's an array, extract the path
    $imagePath = $img['path'] ?? ($img['image'] ?? ($img[0] ?? ''));
} else {
    // If it's already a string
                            $imagePath = $img;
                        }
                    @endphp

                    <img src="{{ asset('storage/' . $imagePath) }}">

                    <div class="gallery-actions">

                        {{-- EDIT / UPDATE --}}
                        <form method="POST" action="{{ route('admin.grill.gallery.update', $index) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" hidden onchange="this.form.submit()">
                            <button type="button" onclick="this.previousElementSibling.click()">
                                Edit
                            </button>
                        </form>

                        {{-- DELETE --}}
                        <form method="POST" action="{{ route('admin.grill.gallery.delete', $index) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>

                    </div>
                </div>
            @endforeach

            {{-- ADD NEW IMAGE (only if < 4) --}}
            @if (count($content->gallery_images ?? []) < 4)
                <form method="POST" action="{{ route('admin.grill.gallery.add') }}" enctype="multipart/form-data">
                    @csrf
                    <label class="gallery-add">
                        + Add Image
                        <input type="file" name="image" hidden onchange="this.form.submit()">
                    </label>
                </form>
            @endif

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize modals
                const warningModal = new bootstrap.Modal(document.getElementById('warningModal'));
                const warningMessage = document.getElementById('warningMessage');
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));

                // Show success modal if exists
                @if (session('modal_message'))
                    document.getElementById('successModalMessage').textContent = "{{ session('modal_message') }}";
                    successModal.show();
                    setTimeout(() => successModal.hide(), 3000);
                @endif

                // Function to check file size based on file type
                function checkFileSize(file, maxSizeMB, fileType = 'image') {
                    const maxSize = maxSizeMB * 1024 * 1024; // Convert MB to bytes
                    const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

                    if (file.size > maxSize) {
                        return {
                            valid: false,
                            message: `The <strong>${fileType}</strong> file "<strong>${file.name}</strong>" is ${fileSizeMB}MB, which exceeds the ${maxSizeMB}MB limit.`
                        };
                    }
                    return {
                        valid: true
                    };
                }

                // Function to determine file type and max size
                function getFileInfo(file) {
                    const mimeType = file.type;
                    if (mimeType.startsWith('video/')) {
                        return {
                            type: 'video',
                            maxSize: 50,
                            label: 'video'
                        };
                    } else if (mimeType.startsWith('image/')) {
                        return {
                            type: 'image',
                            maxSize: 5,
                            label: 'image'
                        };
                    }
                    return {
                        type: 'unknown',
                        maxSize: 5,
                        label: 'file'
                    };
                }

                // Function to show warning and close other modals
                function showFileSizeWarning(message) {
                    // Close any open edit/delete modals first
                    const openModals = document.querySelectorAll('.modal.show');
                    openModals.forEach(modal => {
                        if (modal.id !== 'warningModal') {
                            const bsModal = bootstrap.Modal.getInstance(modal);
                            if (bsModal) bsModal.hide();
                        }
                    });

                    // Show warning modal
                    warningMessage.innerHTML = message;
                    warningModal.show();
                }

                // Function to validate file input immediately on change
                function setupFileValidation(input, fileType = 'mixed') {
                    if (!input) return;

                    // Clone input to remove any existing event listeners
                    const newInput = input.cloneNode(true);
                    input.parentNode.replaceChild(newInput, input);

                    newInput.addEventListener('change', function(e) {
                        if (this.files && this.files.length > 0) {
                            for (let file of this.files) {
                                const fileInfo = getFileInfo(file);
                                const result = checkFileSize(file, fileInfo.maxSize, fileInfo.label);

                                if (!result.valid) {
                                    // Clear the file input
                                    this.value = '';
                                    // Show warning immediately
                                    showFileSizeWarning(result.message);
                                    break; // Stop checking other files
                                }
                            }
                        }
                    });

                    return newInput;
                }

                // Setup validation for carousel upload form
                const carouselUploadForm = document.getElementById('carouselUploadForm');
                if (carouselUploadForm) {
                    const carouselFileInput = carouselUploadForm.querySelector('input[type="file"]');
                    setupFileValidation(carouselFileInput, 'mixed');

                    // Also validate on form submission
                    carouselUploadForm.addEventListener('submit', function(e) {
                        if (carouselFileInput.files.length > 0) {
                            const oversizedFiles = [];

                            for (let file of carouselFileInput.files) {
                                const fileInfo = getFileInfo(file);
                                const maxSize = fileInfo.maxSize * 1024 * 1024;

                                if (file.size > maxSize) {
                                    oversizedFiles.push({
                                        name: file.name,
                                        size: (file.size / (1024 * 1024)).toFixed(2),
                                        type: fileInfo.label,
                                        maxSize: fileInfo.maxSize
                                    });
                                }
                            }

                            if (oversizedFiles.length > 0) {
                                e.preventDefault();

                                let message = '';
                                if (oversizedFiles.length === 1) {
                                    const file = oversizedFiles[0];
                                    message =
                                        `The ${file.type} file "<strong>${file.name}</strong>" is ${file.size}MB, which exceeds the ${file.maxSize}MB limit for ${file.type}s.`;
                                } else {
                                    message =
                                        `<strong>${oversizedFiles.length} files</strong> exceed their size limits:<br>`;
                                    oversizedFiles.forEach(file => {
                                        message +=
                                            `• ${file.name} (${file.type}, ${file.size}MB, max ${file.maxSize}MB)<br>`;
                                    });
                                    message += 'Please select smaller files.';
                                }

                                showFileSizeWarning(message);
                            }
                        }
                    });
                }

                // Setup validation for all update carousel forms
                document.querySelectorAll('.update-carousel-form').forEach(form => {
                    const fileInput = form.querySelector('input[type="file"]');
                    if (fileInput) {
                        setupFileValidation(fileInput, 'mixed');

                        // Also validate on form submission
                        form.addEventListener('submit', function(e) {
                            if (fileInput.files.length > 0) {
                                const file = fileInput.files[0];
                                const fileInfo = getFileInfo(file);
                                const result = checkFileSize(file, fileInfo.maxSize, fileInfo.label);

                                if (!result.valid) {
                                    e.preventDefault();
                                    showFileSizeWarning(result.message);
                                }
                            }
                        });
                    }
                });

                // Setup validation for add menu form
                const addMenuForm = document.getElementById('addMenuForm');
                if (addMenuForm) {
                    const menuFileInput = addMenuForm.querySelector('input[type="file"]');
                    if (menuFileInput) {
                        setupFileValidation(menuFileInput, 'image');

                        addMenuForm.addEventListener('submit', function(e) {
                            if (menuFileInput.files.length > 0) {
                                const file = menuFileInput.files[0];
                                const result = checkFileSize(file, 5, 'menu item image');

                                if (!result.valid) {
                                    e.preventDefault();
                                    showFileSizeWarning(result.message);
                                }
                            }
                        });
                    }
                }

                // Setup validation for all update menu forms
                document.querySelectorAll('.update-menu-form').forEach(form => {
                    const fileInput = form.querySelector('input[type="file"]');
                    if (fileInput) {
                        setupFileValidation(fileInput, 'image');

                        // Also validate on form submission
                        form.addEventListener('submit', function(e) {
                            if (fileInput.files.length > 0) {
                                const file = fileInput.files[0];
                                const result = checkFileSize(file, 5, 'menu item image');

                                if (!result.valid) {
                                    e.preventDefault();
                                    showFileSizeWarning(result.message);
                                }
                            }
                        });
                    }
                });

                // Setup validation for modals when they're shown
                document.addEventListener('show.bs.modal', function(event) {
                    const modal = event.target;
                    const form = modal.querySelector('form');

                    if (form) {
                        setTimeout(() => {
                            const fileInput = form.querySelector('input[type="file"]');
                            if (fileInput) {
                                setupFileValidation(fileInput, 'mixed');
                            }
                        }, 100);
                    }
                });

                // Delete modal functionality
                const deleteConfirmModal = document.getElementById('deleteConfirmModal');
                const deletePreviewWrap = document.getElementById('deletePreviewWrap');
                const deleteConfirmText = document.getElementById('deleteConfirmText');
                const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
                let deleteUrl = null;
                let deleteCardId = null;
                let deleteType = null;
                let deleteName = '';
                let mediaType = 'image';

                // Dynamic delete modal
                document.querySelectorAll('[data-bs-target="#deleteConfirmModal"]').forEach(btn => {
                    btn.addEventListener('click', function() {
                        deleteUrl = this.dataset.action;
                        deleteCardId = this.dataset.cardId;
                        deleteType = this.dataset.type || 'item';
                        deleteName = this.dataset.name || '';
                        const preview = this.dataset.preview || '';
                        mediaType = this.dataset.mediaType || 'image';

                        if (preview) {
                            if (mediaType === 'video') {
                                deletePreviewWrap.innerHTML = `
                                <video class="img-fluid rounded" style="max-height:180px;" controls muted>
                                    <source src="${preview}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <p class="small text-muted mt-1">Video Preview</p>
                            `;
                            } else {
                                deletePreviewWrap.innerHTML =
                                    `<img src="${preview}" class="img-fluid rounded" style="max-height:180px; object-fit:contain;">`;
                            }
                        } else {
                            deletePreviewWrap.innerHTML = '';
                        }

                        if (deleteType === 'carousel') {
                            deleteConfirmText.innerHTML =
                                `Are you sure you want to delete <strong>${deleteName}</strong> from the carousel?`;
                        } else if (deleteType === 'menu') {
                            deleteConfirmText.innerHTML =
                                `Are you sure you want to delete <strong>${deleteName}</strong> from the menu?`;
                        } else {
                            deleteConfirmText.innerHTML =
                                `Are you sure you want to delete this item?`;
                        }
                    });
                });

                confirmDeleteBtn.addEventListener('click', async function() {
                    if (!deleteUrl) return;
                    try {
                        const resp = await fetch(deleteUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Accept': 'application/json'
                            }
                        });
                        const json = await resp.json();

                        document.getElementById('successModalMessage').textContent = json.message ||
                            'Action completed.';
                        successModal.show();
                        setTimeout(() => successModal.hide(), 3000);

                        if (json.success && deleteCardId) {
                            const card = document.getElementById(deleteCardId);
                            if (card) card.remove();
                        }

                    } catch (err) {
                        console.error(err);
                        document.getElementById('successModalMessage').textContent = 'Delete error';
                        successModal.show();
                    }

                    // Reset
                    deleteUrl = deleteCardId = deleteType = deleteName = null;
                    mediaType = 'image';
                    deletePreviewWrap.innerHTML = '';
                    deleteConfirmText.textContent = '';
                    const modalInstance = bootstrap.Modal.getInstance(deleteConfirmModal);
                    if (modalInstance) modalInstance.hide();
                });

                deleteConfirmModal.addEventListener('hidden.bs.modal', function() {
                    deleteUrl = deleteCardId = deleteType = deleteName = null;
                    mediaType = 'image';
                    deletePreviewWrap.innerHTML = '';
                    deleteConfirmText.textContent = '';
                });

                // Simple Peso Formatter
                function formatPesoSimple(input) {
                    let value = input.value.replace(/[^\d]/g, '');

                    if (!value) {
                        input.value = '';
                        return;
                    }

                    // Convert to number and add peso sign with 2 decimal places
                    const numberValue = parseFloat(value);
                    if (!isNaN(numberValue)) {
                        // Format as currency WITHOUT dividing by 100
                        input.value = numberValue.toLocaleString('en-PH', {
                            style: 'currency',
                            currency: 'PHP',
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                }

                // Setup for all price inputs
                document.querySelectorAll('.price-input').forEach(input => {
                    // When user leaves the field
                    input.addEventListener('blur', function() {
                        formatPesoSimple(this);
                    });

                    // When user types, allow only numbers
                    input.addEventListener('input', function() {
                        // Remove any non-numeric characters
                        this.value = this.value.replace(/[^\d]/g, '');
                    });

                    // When user focuses, show raw number for editing
                    input.addEventListener('focus', function() {
                        const numericValue = this.value.replace(/[^\d.]/g, '').replace(/\.\d{2}$/, '');
                        this.value = numericValue;
                    });

                    // Format initial value if it exists
                    if (input.value) {
                        // If value doesn't have peso sign, format it
                        if (!input.value.includes('₱')) {
                            formatPesoSimple(input);
                        }
                    }
                });
            });
            // Setup validation for add category form
            const addCategoryForm = document.querySelector('#addCategoryModal form');
            if (addCategoryForm) {
                const categoryImageInput = addCategoryForm.querySelector('input[type="file"]');
                if (categoryImageInput) {
                    setupFileValidation(categoryImageInput, 'image');

                    addCategoryForm.addEventListener('submit', function(e) {
                        if (categoryImageInput.files.length > 0) {
                            const file = categoryImageInput.files[0];
                            const result = checkFileSize(file, 5, 'category image');

                            if (!result.valid) {
                                e.preventDefault();
                                showFileSizeWarning(result.message);
                            }
                        }
                    });
                }
            }

            // Setup validation for all update category forms
            document.querySelectorAll('[id^="updateCategoryModal"] form').forEach(form => {
                const fileInput = form.querySelector('input[type="file"]');
                if (fileInput) {
                    setupFileValidation(fileInput, 'image');

                    form.addEventListener('submit', function(e) {
                        if (fileInput.files.length > 0) {
                            const file = fileInput.files[0];
                            const result = checkFileSize(file, 5, 'category image');

                            if (!result.valid) {
                                e.preventDefault();
                                showFileSizeWarning(result.message);
                            }
                        }
                    });
                }
            });
        </script>

        <style>
            .object-fit-cover {
                object-fit: cover;
            }

            .card-img-top {
                background-color: #f8f9fa;
                position: relative;
            }

            video {
                background-color: #000;
            }

            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 0;
                margin-top: 15px;
            }

            .gallery-card {
                position: relative;
                height: 220px;
                border: 1px solid #e5e7eb;
                overflow: hidden;
                background: #fff;
            }

            .gallery-card img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .gallery-actions {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                display: flex;
                background: rgba(0, 0, 0, 0.6);
            }

            .gallery-actions button {
                flex: 1;
                border: none;
                background: transparent;
                color: #fff;
                font-size: 12px;
                padding: 6px;
                cursor: pointer;
            }

            .gallery-actions button:hover {
                background: rgba(255, 255, 255, 0.15);
            }

            .gallery-add {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 220px;
                border: 2px dashed #cbd5e1;
                cursor: pointer;
                font-size: 14px;
                color: #64748b;
            }

            @media (max-width: 768px) {
                .gallery-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
        </style>
    @endsection

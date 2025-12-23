@extends('admin.layout')
@section('title', 'Grill')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Grill</h3>

        @php
            $content = $content ?? null;
            $carousel = $content->carousel_images ?? [];
            $menu = $content->menu_items ?? [];
        @endphp

        {{-- Carousel --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-images me-2"></i>Carousel Images</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.grill.carousel.upload') }}" method="POST" enctype="multipart/form-data"
                    id="carouselUploadForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Upload Carousel Images</label>
                        <input type="file" name="carousel_images[]" multiple class="form-control" required
                            accept="image/*">
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            You can select multiple images (JPG, PNG, WebP). Maximum file size: 5MB per image
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-file-earmark-arrow-up me-2"></i>Upload Carousel Images
                    </button>
                </form>

                <hr class="my-4">

                @if (count($carousel) > 0)
                    <h6 class="mb-3">Current Carousel Images ({{ count($carousel) }})</h6>
                    <div class="row g-3">
                        @foreach ($carousel as $i => $img)
                            <div class="col-md-3 col-sm-6" id="carouselCard{{ $i }}">
                                <div class="card h-100">
                                    <div class="card-img-top" style="height: 140px; overflow: hidden;">
                                        <img src="{{ asset('storage/' . str_replace('/storage/', '', $img)) }}"
                                            class="w-100 h-100 object-fit-cover" alt="Carousel Image"
                                            style="object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <div class="btn-group w-100" role="group">
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#updateCarouselModal{{ $i }}">
                                                <i class="bi bi-arrow-repeat me-1"></i> Update
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                                data-action="{{ route('admin.grill.carousel.remove', $i) }}"
                                                data-card-id="carouselCard{{ $i }}" data-type="carousel"
                                                data-name="Carousel Image {{ $i + 1 }}"
                                                data-preview="{{ asset('storage/' . str_replace('/storage/', '', $img)) }}">
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
                                                <h5 class="modal-title">Update Carousel Image</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-3">
                                                    <p class="text-muted small">Current Image:</p>
                                                    <img src="{{ asset('storage/' . str_replace('/storage/', '', $img)) }}"
                                                        class="img-fluid rounded"
                                                        style="max-height: 180px; object-fit: contain;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Replace with new image</label>
                                                    <input type="file" name="image" class="form-control" required
                                                        accept="image/*">
                                                    <div class="form-text">
                                                        <i class="bi bi-info-circle me-1"></i>
                                                        JPG, PNG, or WebP format. Maximum size: 5MB
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-check2-square me-2"></i>Save Changes
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
                        <i class="bi bi-info-circle me-2"></i>
                        No carousel images uploaded yet. Upload some images to showcase the grill area.
                    </div>
                @endif
            </div>
        </div>

        {{-- Menu Items --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-egg-fried me-2"></i>Menu Items</h5>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                    <i class="bi bi-plus-circle me-2"></i>Add Menu Item
                </button>
            </div>
            <div class="card-body">
                @if (count($menu) > 0)
                    <div class="row g-3">
                        @foreach ($menu as $i => $item)
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
                                        <h6 class="card-title fw-bold">{{ $item['name'] ?? 'Unnamed Item' }}</h6>
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
                                                @if (!empty($item['image']) && $item['image'] !== '') data-preview="{{ asset('storage/' . str_replace('/storage/', '', $item['image'])) }}" @endif>
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Update Menu Modal --}}
                            <div class="modal fade" id="updateMenuModal{{ $i }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.grill.menu.update', $i) }}" method="POST"
                                            enctype="multipart/form-data" class="update-menu-form">
                                            @csrf
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Update Menu Item</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
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
                                                        value="{{ $item['price'] ?? '' }}" required>
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
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-check2-square me-2"></i>Update Menu Item
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
                        <i class="bi bi-info-circle me-2"></i>
                        No menu items yet. Click <strong>Add Menu Item</strong> to create one.
                    </div>
                @endif
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
                                <i class="bi bi-plus-circle me-2"></i>Add Menu Item
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
                            <i class="bi bi-trash me-2"></i>Confirm Delete
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
                            <i class="bi bi-trash me-2"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Success Modal --}}
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-check-circle me-2"></i>Success
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
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>File Too Large
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

            // Function to check file size
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
            function setupFileValidation(input, maxSizeMB, fileType = 'image') {
                if (!input) return;

                // Clone input to remove any existing event listeners
                const newInput = input.cloneNode(true);
                input.parentNode.replaceChild(newInput, input);

                newInput.addEventListener('change', function(e) {
                    if (this.files && this.files.length > 0) {
                        for (let file of this.files) {
                            const result = checkFileSize(file, maxSizeMB, fileType);

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
                setupFileValidation(carouselFileInput, 5, 'carousel image');

                // Also validate on form submission
                carouselUploadForm.addEventListener('submit', function(e) {
                    const maxSize = 5 * 1024 * 1024;
                    const oversizedFiles = [];

                    if (carouselFileInput.files.length > 0) {
                        for (let file of carouselFileInput.files) {
                            if (file.size > maxSize) {
                                oversizedFiles.push({
                                    name: file.name,
                                    size: (file.size / (1024 * 1024)).toFixed(2)
                                });
                            }
                        }

                        if (oversizedFiles.length > 0) {
                            e.preventDefault();

                            let message = '';
                            if (oversizedFiles.length === 1) {
                                message =
                                    `The carousel image "<strong>${oversizedFiles[0].name}</strong>" is ${oversizedFiles[0].size}MB, which exceeds the 5MB limit.`;
                            } else {
                                message =
                                    `<strong>${oversizedFiles.length} carousel images</strong> exceed the 5MB limit:<br>`;
                                oversizedFiles.forEach(file => {
                                    message += `• ${file.name} (${file.size}MB)<br>`;
                                });
                                message += 'Please select smaller images.';
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
                    setupFileValidation(fileInput, 5, 'carousel image');

                    // Also validate on form submission
                    form.addEventListener('submit', function(e) {
                        if (fileInput.files.length > 0) {
                            const file = fileInput.files[0];
                            const result = checkFileSize(file, 5, 'carousel image');

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
                    setupFileValidation(menuFileInput, 5, 'menu item image');

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
                    setupFileValidation(fileInput, 5, 'menu item image');

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
                            setupFileValidation(fileInput, 5, 'image');
                        }
                    }, 100);
                }
            });

            // Delete modal functionality (keep your existing code)
            const deleteConfirmModal = document.getElementById('deleteConfirmModal');
            const deletePreviewWrap = document.getElementById('deletePreviewWrap');
            const deleteConfirmText = document.getElementById('deleteConfirmText');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            let deleteUrl = null;
            let deleteCardId = null;
            let deleteType = null;
            let deleteName = '';

            // Dynamic delete modal
            document.querySelectorAll('[data-bs-target="#deleteConfirmModal"]').forEach(btn => {
                btn.addEventListener('click', function() {
                    deleteUrl = this.dataset.action;
                    deleteCardId = this.dataset.cardId;
                    deleteType = this.dataset.type || 'item';
                    deleteName = this.dataset.name || '';
                    const preview = this.dataset.preview || '';

                    deletePreviewWrap.innerHTML = preview ?
                        `<img src="${preview}" class="img-fluid rounded" style="max-height:180px; object-fit:contain;">` :
                        '';

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
                deletePreviewWrap.innerHTML = '';
                deleteConfirmText.textContent = '';
                const modalInstance = bootstrap.Modal.getInstance(deleteConfirmModal);
                if (modalInstance) modalInstance.hide();
            });

            deleteConfirmModal.addEventListener('hidden.bs.modal', function() {
                deleteUrl = deleteCardId = deleteType = deleteName = null;
                deletePreviewWrap.innerHTML = '';
                deleteConfirmText.textContent = '';
            });

            // Format Peso
            function formatPeso(input) {
                let value = input.value.replace(/[^\d]/g, '');
                if (!value) {
                    input.value = '';
                    return;
                }
                input.value = new Intl.NumberFormat('en-PH', {
                    style: 'currency',
                    currency: 'PHP'
                }).format(parseFloat(value));
            }

            // Price formatting
            document.querySelectorAll('.price-input').forEach(input => {
                input.addEventListener('blur', () => formatPeso(input));
                input.addEventListener('focus', () => {
                    input.value = input.value.replace(/[^0-9]/g, '');
                });

                // Format on load if value exists
                if (input.value) {
                    formatPeso(input);
                }
            });
        });
    </script>

    <style>
        .object-fit-cover {
            object-fit: cover;
        }

        .card-img-top {
            background-color: #f8f9fa;
        }
    </style>
@endsection

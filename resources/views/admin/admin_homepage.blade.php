@extends('admin.layout')
@section('title', 'Home')

@section('content')
    <style>
        .btn-primary:hover {
            transform: scale(1.05);
            transition: 0.2s;
        }

        .file-size-info {
            font-size: 12px;
            color: #6c757d;
            margin-top: 4px;
        }
    </style>

    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Homepage</h3>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data" id="homepageForm">
            @csrf
            <div class="row gy-4">

                {{-- CAROUSEL 1–3 --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 1–3 (Main Banners)</h5>
                            <div class="file-size-info mb-3">Maximum file size for carousel images: 20MB</div>
                            <div class="row g-4">
                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Image {{ $i }}</label>
                                            <img id="carousel{{ $i }}Preview"
                                                src="{{ $homepage->{'carousel' . $i} ? asset('storage/' . $homepage->{'carousel' . $i}) : '' }}"
                                                class="img-fluid rounded mb-3 shadow-sm" alt="Carousel {{ $i }}"
                                                style="max-height:180px; object-fit:cover; {{ $homepage->{'carousel' . $i} ? '' : 'display:none;' }}">
                                            <input type="file" name="carousel{{ $i }}"
                                                class="form-control mb-3" data-preview="carousel{{ $i }}Preview"
                                                data-max-size="20480" accept="image/*"
                                                {{ $homepage->{'carousel' . $i} ? '' : 'required' }}>
                                            <div class="file-size-info">Max: 20MB</div>
                                            <label class="fw-semibold">Caption</label>
                                            <input type="text" name="carousel{{ $i }}Caption"
                                                class="form-control" value="{{ $homepage->{'carousel' . $i . 'Caption'} }}"
                                                required>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DYNAMIC CAROUSELS --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Additional Carousel Images</h5>
                            <div class="file-size-info mb-3">Maximum file size for carousel images: 20MB</div>

                            <div id="dynamicCarouselContainer" class="row g-4">
                                @if (!empty($homepage->dynamic_carousels))
                                    @foreach ($homepage->dynamic_carousels as $index => $carousel)
                                        <div class="col-md-6 col-lg-4 dynamic-carousel-item"
                                            data-id="{{ $carousel['id'] ?? $index }}">
                                            <div class="border rounded p-3 h-100 position-relative">
                                                <label class="fw-semibold d-block mb-2">Image</label>
                                                <img id="dynamicPreview{{ $index }}"
                                                    src="{{ $carousel['image'] ? asset('storage/' . $carousel['image']) : '' }}"
                                                    class="img-fluid rounded mb-3 shadow-sm"
                                                    style="max-height:180px; object-fit:cover; {{ $carousel['image'] ? '' : 'display:none;' }}">
                                                <input type="file" name="dynamic_image"
                                                    class="form-control mb-3 dynamic-image-input"
                                                    data-preview="dynamicPreview{{ $index }}" data-max-size="20480"
                                                    accept="image/*">
                                                <div class="file-size-info">Max: 20MB</div>

                                                <input type="hidden" class="existing-image-path"
                                                    value="{{ $carousel['image'] ?? '' }}">

                                                <label class="fw-semibold">Caption</label>
                                                <input type="text" class="form-control dynamic-caption"
                                                    value="{{ $carousel['caption'] ?? '' }}" placeholder="Enter caption">

                                                {{-- Action Buttons for EXISTING carousel --}}
                                                <div class="d-flex gap-2 mt-3">
                                                    <button type="button" class="btn btn-success btn-sm save-dynamic"
                                                        data-id="{{ $carousel['id'] ?? $index }}" data-mode="update">
                                                        <i class="bi bi-check-circle me-1"></i>Save
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm remove-dynamic"
                                                        data-id="{{ $carousel['id'] ?? $index }}">
                                                        <i class="bi bi-trash me-1"></i>Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            {{-- "Add Carousel" button (creates NEW unsaved carousel) --}}
                            <button type="button" id="addDynamicCarousel" class="btn btn-outline-success mt-3">
                                <i class="bi bi-plus-circle me-2"></i>Add Carousel Image
                            </button>

                            {{-- Hidden template for NEW dynamic carousel --}}
                            <template id="newCarouselTemplate">
                                <div class="col-md-6 col-lg-4 dynamic-carousel-item" data-id="new">
                                    <div class="border rounded p-3 h-100 position-relative">
                                        <label class="fw-semibold d-block mb-2">Image</label>
                                        <img class="img-fluid rounded mb-3 shadow-sm dynamic-preview"
                                            style="max-height:180px; object-fit:cover; display:none;">
                                        <input type="file" class="form-control mb-3 dynamic-image-input"
                                            data-max-size="20480" accept="image/*">
                                        <div class="file-size-info">Max: 20MB</div>

                                        <input type="hidden" class="existing-image-path" value="">

                                        <label class="fw-semibold">Caption</label>
                                        <input type="text" class="form-control dynamic-caption"
                                            placeholder="Enter caption">

                                        {{-- Action Buttons for NEW carousel --}}
                                        <div class="d-flex gap-2 mt-3">
                                            <button type="button" class="btn btn-success btn-sm save-dynamic"
                                                data-id="new" data-mode="create">
                                                <i class="bi bi-check-circle me-1"></i>Save
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-sm cancel-dynamic">
                                                <i class="bi bi-x-circle me-1"></i>Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- CAROUSEL 4–5 (Langer & Couples) --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 4–5 (Course Descriptions)</h5>
                            <div class="file-size-info mb-3">Maximum file size for carousel images: 20MB</div>
                            <div class="row g-4">
                                @for ($i = 4; $i <= 5; $i++)
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Image {{ $i }}</label>
                                            <img id="carousel{{ $i }}Preview"
                                                src="{{ $homepage->{'carousel' . $i} ? asset('storage/' . $homepage->{'carousel' . $i}) : '' }}"
                                                class="img-fluid rounded shadow-sm" alt="Carousel {{ $i }}"
                                                style="max-height:180px; object-fit:cover; {{ $homepage->{'carousel' . $i} ? '' : 'display:none;' }}">
                                            <input type="file" name="carousel{{ $i }}"
                                                class="form-control mb-3"
                                                data-preview="carousel{{ $i }}Preview" data-max-size="20480"
                                                accept="image/*" {{ $homepage->{'carousel' . $i} ? '' : 'required' }}>
                                            <div class="file-size-info">Max: 20MB</div>
                                            <label class="fw-semibold">Description</label>
                                            <textarea name="carousel{{ $i }}Caption" class="form-control" rows="4" required
                                                placeholder="Enter description for Carousel {{ $i }}">{{ $homepage->{'carousel' . $i . 'Caption'} ?? '' }}</textarea>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- HEADLINE SECTION --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Headline & Subheadline</h5>
                            <label class="fw-semibold">Headline</label>
                            <input type="text" name="headline" class="form-control mb-3" required
                                value="{{ $homepage->headline }}">
                            <label class="fw-semibold">Subheadline</label>
                            <textarea name="subheadline" class="form-control" rows="2" required>{{ $homepage->subheadline }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- HOMEPAGE CARDS --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Homepage Cards</h5>
                            <div class="file-size-info mb-3">Maximum file size for card images: 10MB</div>
                            <div class="row g-4">
                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="col-md-4">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Card {{ $i }}</label>
                                            <img id="card{{ $i }}Preview"
                                                src="{{ $homepage->{'card' . $i . '_image'} ? asset('storage/' . $homepage->{'card' . $i . '_image'}) : '' }}"
                                                class="img-fluid rounded mb-3 shadow-sm" alt="Card {{ $i }}"
                                                style="max-height:160px; object-fit:cover; {{ $homepage->{'card' . $i . '_image'} ? '' : 'display:none;' }}">
                                            <input type="file" name="card{{ $i }}_image"
                                                class="form-control mb-3" data-preview="card{{ $i }}Preview"
                                                data-max-size="10240" accept="image/*"
                                                {{ $homepage->{'card' . $i . '_image'} ? '' : 'required' }}>
                                            <div class="file-size-info">Max: 10MB</div>
                                            <label class="fw-semibold">Title</label>
                                            <input type="text" name="card{{ $i }}_title"
                                                class="form-control" value="{{ $homepage->{'card' . $i . '_title'} }}"
                                                required>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SAVE BUTTON --}}
                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary shadow-lg position-fixed"
                        style="bottom: 30px; right: 30px; z-index: 1050; border-radius: 50px; padding: 12px 24px; font-weight: 600;">
                        <i class="bi bi-check-square me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Remove Carousel Modal --}}
    <div class="modal fade" id="removeCarouselModal" tabindex="-1" aria-labelledby="removeCarouselModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="removeCarouselModalLabel">Confirm Removal</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove this carousel?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmRemoveCarousel">Remove</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header btn-success text-white">
                    <h5 class="modal-title">Success</h5>
                </div>
                <div class="modal-body text-black">
                    {{ session('modal_message') }}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal for file size validation -->
    <div class="modal fade" id="errorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>File Too Large
                    </h5>
                </div>
                <div class="modal-body text-black" id="errorModalMessage">
                    <!-- Error message will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Preview Handler & Dynamic Carousel Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                const modalEl = document.getElementById('successModal');
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.textContent = "{{ session('success') }}";
                modalBody.style.color = 'green';

                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // Auto-close after 5s
                setTimeout(() => modal.hide(), 5000);
            @endif
        });

        document.addEventListener('DOMContentLoaded', () => {
            // File preview for MAIN FORM (excluding dynamic carousels)
            document.querySelectorAll('input[type="file"]:not(.dynamic-image-input)').forEach(input => {
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (!file) return;

                    // Check file size before preview
                    const maxSizeKB = parseInt(e.target.getAttribute('data-max-size'));
                    if (file.size / 1024 > maxSizeKB) {
                        const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);
                        const maxSizeMB = (maxSizeKB / 1024).toFixed(1);
                        const type = maxSizeKB === 20480 ? 'carousel' : 'card';

                        showErrorModal(
                            `File "${file.name}" is ${fileSizeMB}MB. Maximum allowed size for ${type} images is ${maxSizeMB}MB.`
                        );
                        e.target.value = '';
                        return;
                    }

                    const previewId = e.target.getAttribute('data-preview');
                    if (!previewId) return;
                    const preview = document.getElementById(previewId);
                    if (!preview) return;
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                    preview.onload = () => URL.revokeObjectURL(preview.src);
                });
            });

            // Form submission validation (MAIN FORM ONLY - excludes dynamic carousels)
            document.getElementById('homepageForm').addEventListener('submit', function(e) {
                const fileInputs = this.querySelectorAll(
                    'input[type="file"]:not(.dynamic-image-input)[data-max-size]');
                let errorMessage = null;

                fileInputs.forEach(input => {
                    if (input.files && input.files.length > 0) {
                        const maxSizeKB = parseInt(input.getAttribute('data-max-size'));

                        for (let i = 0; i < input.files.length; i++) {
                            const file = input.files[i];
                            const fileSizeKB = file.size / 1024;

                            if (fileSizeKB > maxSizeKB) {
                                const fileSizeMB = (fileSizeKB / 1024).toFixed(2);
                                const maxSizeMB = (maxSizeKB / 1024).toFixed(1);
                                const type = maxSizeKB === 20480 ? 'carousel' : 'card';

                                errorMessage =
                                    `File "${file.name}" is ${fileSizeMB}MB. Maximum allowed size for ${type} images is ${maxSizeMB}MB.`;
                                break;
                            }
                        }
                    }
                });

                if (errorMessage) {
                    e.preventDefault();
                    showErrorModal(errorMessage);
                }
            });

            // Function to show error modal
            function showErrorModal(message) {
                document.getElementById('errorModalMessage').innerHTML = message;
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
                return false;
            }
        });
    </script>

    {{-- NEW AJAX Script for Dynamic Carousels Only --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('dynamicCarouselContainer');
            const template = document.getElementById('newCarouselTemplate');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Helper function to show success modal
            function showSuccessModal(message) {
                // You can reuse your existing success modal or create a new one
                const modalEl = document.getElementById('successModal');
                if (modalEl) {
                    const modalBody = modalEl.querySelector('.modal-body');
                    modalBody.textContent = message;
                    modalBody.style.color = 'green';

                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modal.show();

                    // Auto-close after 3s
                    setTimeout(() => modal.hide(), 3000);
                } else {
                    // Fallback alert
                    alert('Success: ' + message);
                }
            }

            // Helper function to show error modal
            function showAjaxErrorModal(message) {
                const errorModalEl = document.getElementById('errorModal');
                if (errorModalEl) {
                    document.getElementById('errorModalMessage').innerHTML = message;
                    const errorModal = new bootstrap.Modal(errorModalEl);
                    errorModal.show();
                } else {
                    alert('Error: ' + message);
                }
            }

            // Add new empty carousel block
            document.getElementById('addDynamicCarousel').addEventListener('click', function() {
                const clone = template.content.cloneNode(true);
                const item = clone.querySelector('.dynamic-carousel-item');
                const preview = item.querySelector('.dynamic-preview');
                const fileInput = item.querySelector('.dynamic-image-input');

                // File preview logic for new carousel
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    // Size validation
                    const maxSizeKB = parseInt(this.getAttribute('data-max-size'));
                    if (file.size / 1024 > maxSizeKB) {
                        showAjaxErrorModal(`File too large. Max ${maxSizeKB/1024}MB allowed.`);
                        this.value = '';
                        return;
                    }

                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                    preview.onload = () => URL.revokeObjectURL(preview.src);
                });

                container.appendChild(clone);
            });

            // Save dynamic carousel (Create or Update)
            container.addEventListener('click', async function(e) {
                if (e.target.classList.contains('save-dynamic')) {
                    const button = e.target;
                    const item = button.closest('.dynamic-carousel-item');
                    const id = button.getAttribute('data-id');
                    const mode = button.getAttribute('data-mode');
                    const imageInput = item.querySelector('.dynamic-image-input');
                    const existingImage = item.querySelector('.existing-image-path').value;
                    const caption = item.querySelector('.dynamic-caption').value;

                    // Validate required fields
                    if (!imageInput.files[0] && !existingImage) {
                        showValidationError('Please select an image.');
                        return;
                    }
                    if (!caption.trim()) {
                        showValidationError('Please enter a caption.');
                        return;
                    }

                    // Add this function near your other modal functions
                    function showValidationError(message) {
                        // Create a simple alert or use a different modal
                        const modalEl = document.getElementById('errorModal');
                        if (modalEl) {
                            // Change the modal title for validation errors
                            const modalTitle = modalEl.querySelector('.modal-title');
                            if (modalTitle) {
                                modalTitle.innerHTML =
                                    '<i class="bi bi-exclamation-circle-fill me-2"></i>Error';
                            }

                            document.getElementById('errorModalMessage').innerHTML = message;
                            const errorModal = new bootstrap.Modal(modalEl);
                            errorModal.show();

                            // Reset title after modal closes
                            modalEl.addEventListener('hidden.bs.modal', function() {
                                if (modalTitle) {
                                    modalTitle.innerHTML =
                                        '<i class="bi bi-exclamation-triangle-fill me-2"></i>File Too Large';
                                }
                            }, {
                                once: true
                            });
                        } else {
                            alert('Error: ' + message);
                        }
                    }

                    // Prepare form data
                    const formData = new FormData();
                    formData.append('_token', csrfToken);
                    formData.append('caption', caption);
                    formData.append('mode', mode);

                    if (mode === 'update') {
                        formData.append('id', id);
                        formData.append('existing_image', existingImage);
                    }

                    if (imageInput.files[0]) {
                        formData.append('image', imageInput.files[0]);
                    }

                    button.disabled = true;
                    button.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Saving...';

                    try {
                        const response = await fetch('{{ route('admin.dynamic.carousel.save') }}', {
                            method: 'POST',
                            body: formData
                        });

                        const result = await response.json();

                        if (result.success) {
                            // Update UI for existing item
                            item.setAttribute('data-id', result.data.id);
                            item.querySelector('.existing-image-path').value = result.data.image;

                            // Change button to "Update" mode
                            button.setAttribute('data-mode', 'update');
                            button.setAttribute('data-id', result.data.id);

                            // Change "Cancel" to "Remove" if it exists
                            const cancelBtn = item.querySelector('.cancel-dynamic');
                            if (cancelBtn) {
                                cancelBtn.classList.replace('btn-secondary', 'btn-danger');
                                cancelBtn.classList.replace('cancel-dynamic', 'remove-dynamic');
                                cancelBtn.innerHTML = '<i class="bi bi-trash me-1"></i>Remove';
                            }

                            showSuccessModal(result.message || 'Carousel saved successfully!');
                        } else {
                            showAjaxErrorModal(result.message || 'Failed to save carousel.');
                        }
                    } catch (error) {
                        showAjaxErrorModal('Network error. Please try again.');
                    } finally {
                        button.disabled = false;
                        button.innerHTML = '<i class="bi bi-check-circle me-1"></i>Save';
                    }
                }
            });

            // Simpler version - reuse existing modal for confirmations
            container.addEventListener('click', async function(e) {
                if (e.target.classList.contains('remove-dynamic')) {
                    const button = e.target;
                    const item = button.closest('.dynamic-carousel-item');
                    const id = item.getAttribute('data-id');

                    if (id === 'new') {
                        item.remove();
                        return;
                    }

                    // Use existing error modal for confirmation
                    showConfirmationModalSimple(
                        'Are you sure you want to remove this carousel?',
                        async () => {
                            // User confirmed
                            button.disabled = true;
                            button.innerHTML =
                                '<i class="bi bi-hourglass-split me-1"></i>Removing...';

                            try {
                                const formData = new FormData();
                                formData.append('_token', csrfToken);
                                formData.append('id', id);

                                const response = await fetch(
                                    '{{ route('admin.dynamic.carousel.remove') }}', {
                                        method: 'POST',
                                        body: formData
                                    });

                                const result = await response.json();

                                if (result.success) {
                                    item.style.transition = 'opacity 0.3s';
                                    item.style.opacity = '0';
                                    setTimeout(() => {
                                        item.remove();
                                        showSuccessModal(
                                            'Carousel removed successfully!');
                                    }, 300);
                                } else {
                                    throw new Error(result.message ||
                                        'Failed to remove carousel');
                                }
                            } catch (error) {
                                button.disabled = false;
                                button.innerHTML = '<i class="bi bi-trash me-1"></i>Remove';
                                showErrorModal('Error: ' + error.message);
                            }
                        }
                    );
                }
            });

            function showConfirmationModalSimple(message, onConfirm) {
                const modalEl = document.getElementById('errorModal');
                if (!modalEl) {
                    // Fallback to browser confirm
                    if (confirm(message)) onConfirm();
                    return;
                }

                // Change modal to confirmation style
                const modalTitle = modalEl.querySelector('.modal-title');
                const modalHeader = modalEl.querySelector('.modal-header');
                const modalBody = document.getElementById('errorModalMessage');
                const modalFooter = modalEl.querySelector('.modal-footer');

                // Save original state
                const originalTitle = modalTitle.innerHTML;
                const originalHeaderClass = modalHeader.className;
                const originalBody = modalBody.innerHTML;
                const originalFooter = modalFooter ? modalFooter.innerHTML : '';

                // Change to confirmation style
                modalTitle.innerHTML = '<i class="bi bi-question-circle-fill me-2"></i>Confirm Removal';
                modalHeader.className = 'modal-header bg-warning text-dark';
                modalBody.innerHTML = message;

                // Add confirmation buttons
                if (modalFooter) {
                    modalFooter.innerHTML = `
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmBtn">Remove</button>
        `;
                }

                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // Handle confirmation
                modalEl.addEventListener('shown.bs.modal', function onShown() {
                    const confirmBtn = document.getElementById('confirmBtn');
                    if (confirmBtn) {
                        confirmBtn.addEventListener('click', function onClick() {
                            modal.hide();
                            onConfirm();
                        }, {
                            once: true
                        });
                    }
                }, {
                    once: true
                });

                // Restore original state when modal closes
                modalEl.addEventListener('hidden.bs.modal', function onHidden() {
                    modalTitle.innerHTML = originalTitle;
                    modalHeader.className = originalHeaderClass;
                    modalBody.innerHTML = originalBody;
                    if (modalFooter) {
                        modalFooter.innerHTML = originalFooter;
                    }
                    modalEl.removeEventListener('shown.bs.modal', onShown);
                    modalEl.removeEventListener('hidden.bs.modal', onHidden);
                }, {
                    once: true
                });
            }

            // Cancel new carousel
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('cancel-dynamic')) {
                    const item = e.target.closest('.dynamic-carousel-item');
                    item.remove();
                }
            });

            // File preview for existing dynamic carousel inputs (loaded from database)
            document.querySelectorAll('.dynamic-image-input[data-preview]').forEach(input => {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    const maxSizeKB = parseInt(this.getAttribute('data-max-size'));
                    if (file.size / 1024 > maxSizeKB) {
                        showAjaxErrorModal(`File too large. Max ${maxSizeKB/1024}MB allowed.`);
                        this.value = '';
                        return;
                    }

                    const previewId = this.getAttribute('data-preview');
                    if (previewId) {
                        const preview = document.getElementById(previewId);
                        if (preview) {
                            preview.src = URL.createObjectURL(file);
                            preview.style.display = 'block';
                            preview.onload = () => URL.revokeObjectURL(preview.src);
                        }
                    }
                });
            });
        });
    </script>
@endsection

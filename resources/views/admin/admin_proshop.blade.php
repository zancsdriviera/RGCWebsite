@extends('admin.layout')
@section('title', 'Proshop')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Proshop</h3>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Description Card --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-shop me-2"></i>Description</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.proshop.updateDescription') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Proshop Description</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ $description->description ?? '' }}</textarea>
                        <small class="text-muted">Enter a description for the proshop facilities and products</small>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-square me-2"></i>Save Description
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Upload Images Card --}}
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-images me-2"></i>Upload Images</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.proshop.uploadImages') }}" method="POST" enctype="multipart/form-data"
                    id="uploadForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Images</label>
                        <input type="file" name="images[]" multiple class="form-control" required accept="image/*">
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            You can select multiple images (JPG, PNG, WebP). Maximum file size: 5MB per image
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-file-earmark-arrow-up me-2"></i>Upload Images
                    </button>
                </form>
            </div>
        </div>

        {{-- Display Images --}}
        @if ($images->count() > 0)
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="bi bi-collection me-2"></i>Gallery ({{ $images->count() }} images)</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach ($images as $img)
                            <div class="col-md-3 col-sm-6">
                                <div class="card h-100">
                                    <div class="card-img-top" style="height: 180px; overflow: hidden;">
                                        <img src="{{ $img->image_path }}" class="w-100 h-100 object-fit-cover"
                                            alt="Proshop Image" style="object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <div class="btn-group w-100" role="group">
                                            {{-- Edit Button --}}
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $img->id }}">
                                                <i class="bi bi-arrow-repeat me-1"></i> Update
                                            </button>

                                            {{-- Delete Button --}}
                                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $img->id }}">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editModal{{ $img->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $img->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form action="{{ route('admin.proshop.updateImage', $img->id) }}" method="POST"
                                        enctype="multipart/form-data" class="modal-content">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="editModalLabel{{ $img->id }}">
                                                <i class="bi bi-arrow-repeat me-2"></i>Update Image
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center mb-3">
                                                <p class="text-muted small">Current Image:</p>
                                                <img src="{{ $img->image_path }}" class="img-fluid rounded"
                                                    style="max-height: 200px; object-fit: contain;">
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
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-check2-square me-1"></i>Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Delete Modal --}}
                            <div class="modal fade" id="deleteModal{{ $img->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $img->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form action="{{ route('admin.proshop.deleteImage', $img->id) }}" method="POST"
                                        class="modal-content">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $img->id }}">
                                                <i class="bi bi-trash me-2"></i>Delete Image
                                            </h5>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p>Are you sure you want to delete this image?</p>
                                            <div class="my-3">
                                                <img src="{{ $img->image_path }}" class="img-fluid rounded"
                                                    style="max-height: 200px; object-fit: contain;">
                                            </div>
                                            <p class="text-muted small">This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash me-1"></i>Delete Image
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-images fs-1 text-muted mb-3 d-block"></i>
                    <h5 class="text-muted">No images uploaded yet</h5>
                    <p class="text-muted">Upload some images to showcase the proshop</p>
                </div>
            </div>
        @endif

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
                        {{ session('success') }}
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
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize modals
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            const warningModal = new bootstrap.Modal(document.getElementById('warningModal'));
            const warningMessage = document.getElementById('warningMessage');

            // Show success modal if there's a success message
            @if (session('success'))
                const modalBody = document.querySelector('#successModal .modal-body');
                modalBody.textContent = "{{ session('success') }}";
                successModal.show();

                // Auto-close after 3 seconds
                setTimeout(() => successModal.hide(), 3000);
            @endif

            // Global function to check file size
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

                input.addEventListener('change', function(e) {
                    if (this.files && this.files.length > 0) {
                        const file = this.files[0];
                        const result = checkFileSize(file, maxSizeMB, fileType);

                        if (!result.valid) {
                            // Clear the file input
                            this.value = '';
                            // Show warning immediately
                            showFileSizeWarning(result.message);
                        }
                    }
                });
            }

            // Setup validation for main upload form
            const uploadForm = document.getElementById('uploadForm');
            if (uploadForm) {
                const fileInput = uploadForm.querySelector('input[type="file"]');
                setupFileValidation(fileInput, 5, 'image');

                // Also validate on form submission as backup
                uploadForm.addEventListener('submit', (e) => {
                    const maxSize = 5 * 1024 * 1024;
                    const oversizedFiles = [];

                    if (fileInput.files.length > 0) {
                        for (let file of fileInput.files) {
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
                                    `The image file "<strong>${oversizedFiles[0].name}</strong>" is ${oversizedFiles[0].size}MB, which exceeds the 5MB limit.`;
                            } else {
                                message =
                                    `<strong>${oversizedFiles.length} image files</strong> exceed the 5MB limit:<br>`;
                                oversizedFiles.forEach(file => {
                                    message += `• ${file.name} (${file.size}MB)<br>`;
                                });
                            }

                            showFileSizeWarning(message);
                        }
                    }
                });
            }

            // Setup validation for ALL edit modals dynamically
            function setupEditModalValidation() {
                document.querySelectorAll('[id^="editModal"]').forEach(modalElement => {
                    const modalId = modalElement.id;
                    const form = modalElement.querySelector('form');
                    const fileInput = form ? form.querySelector('input[type="file"]') : null;

                    if (fileInput) {
                        setupFileValidation(fileInput, 5, 'image');

                        // Also validate on form submission
                        form.addEventListener('submit', (e) => {
                            if (fileInput.files.length > 0) {
                                const file = fileInput.files[0];
                                const result = checkFileSize(file, 5, 'image');

                                if (!result.valid) {
                                    e.preventDefault();
                                    showFileSizeWarning(result.message);
                                }
                            }
                        });
                    }
                });
            }

            // Setup validation for modals when they're shown
            document.addEventListener('show.bs.modal', function(event) {
                const modal = event.target;
                if (modal.id.startsWith('editModal')) {
                    // Small delay to ensure modal is fully loaded
                    setTimeout(() => {
                        const form = modal.querySelector('form');
                        const fileInput = form ? form.querySelector('input[type="file"]') : null;

                        if (fileInput) {
                            setupFileValidation(fileInput, 5, 'image');
                        }
                    }, 100);
                }
            });

            // Initialize edit modal validation
            setupEditModalValidation();
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

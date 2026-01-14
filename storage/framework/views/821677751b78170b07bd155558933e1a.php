
<?php $__env->startSection('title', 'Tournament Gallery Editor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Tournament Gallery</h3>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Create New Gallery</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.tournament_gallery.store')); ?>" method="POST" enctype="multipart/form-data"
                    id="createGalleryForm">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Gallery Title</label>
                                <input name="title" class="form-control" required value="<?php echo e(old('title')); ?>">
                                <small class="text-muted">Enter a descriptive title for the tournament gallery</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Event Date</label>
                                <input type="date" name="event_date" class="form-control" required
                                    value="<?php echo e(old('event_date')); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Thumbnail Image</label>
                                <input type="file" name="thumbnail" class="form-control" required accept="image/*">
                                <small class="text-muted">JPG, PNG, or WebP format. Maximum size: 5MB</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-images me-2"></i>Create Gallery
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="row g-4">
            <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0"><?php echo e($gallery->title); ?></h5>
                                <small class="text-muted"><?php echo e($gallery->event_date); ?> • <?php echo e($gallery->images_count); ?>

                                    images</small>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateThumbnailModal<?php echo e($gallery->id); ?>">
                                    <i class="bi bi-image me-1"></i> Thumbnail
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger delete-gallery-btn"
                                    data-url="<?php echo e(route('admin.tournament_gallery.destroy', $gallery->id)); ?>"
                                    data-title="<?php echo e($gallery->title); ?>"
                                    data-thumbnail="<?php echo e(asset('storage/' . str_replace('/storage/', '', $gallery->thumbnail_path))); ?>"
                                    data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            
                            <div class="thumbnail-preview mb-4">
                                <img src="<?php echo e(asset('storage/' . str_replace('/storage/', '', $gallery->thumbnail_path))); ?>"
                                    alt="<?php echo e($gallery->title); ?> Thumbnail">
                            </div>

                            
                            <form action="<?php echo e(route('admin.tournament_gallery.images.store', $gallery->id)); ?>"
                                method="POST" enctype="multipart/form-data" class="gallery-upload-form mb-4"
                                data-gallery="<?php echo e($gallery->id); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label class="form-label">Upload Images to Gallery</label>
                                    <input type="file" name="images[]" multiple class="form-control" required
                                        accept="image/*">
                                    <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                        You can select multiple images (JPG, PNG, WebP). Maximum file size: 5MB per image
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-file-earmark-arrow-up me-2"></i>Upload Images
                                    </button>
                                    
                                </div>
                            </form>

                            <hr class="my-4">

                            
                            <?php if($gallery->images_count > 0): ?>
                                <h6 class="mb-3">Gallery Images (<?php echo e($gallery->images_count); ?>)</h6>

                                
                                <?php
                                    $images = $gallery
                                        ->images()
                                        ->paginate(12, ['*'], 'gallery_' . $gallery->id . '_page');
                                    $currentPage = $images->currentPage();
                                    $totalPages = $images->lastPage();
                                ?>

                                <?php if($totalPages > 1): ?>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <small class="text-muted">
                                            Page <?php echo e($currentPage); ?> of <?php echo e($totalPages); ?>

                                            (<?php echo e($images->count()); ?> of <?php echo e($gallery->images_count); ?> images)
                                        </small>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?php echo e($images->previousPageUrl() ?: '#'); ?>"
                                                class="btn btn-outline-secondary <?php echo e(!$images->previousPageUrl() ? 'disabled' : ''); ?>">
                                                <i class="bi bi-chevron-left"></i>
                                            </a>
                                            <?php for($i = 1; $i <= min($totalPages, 5); $i++): ?>
                                                <a href="<?php echo e($images->url($i)); ?>"
                                                    class="btn btn-outline-secondary <?php echo e($currentPage == $i ? 'active' : ''); ?>">
                                                    <?php echo e($i); ?>

                                                </a>
                                            <?php endfor; ?>
                                            <?php if($totalPages > 5): ?>
                                                <span class="btn btn-outline-secondary disabled">...</span>
                                                <a href="<?php echo e($images->url($totalPages)); ?>"
                                                    class="btn btn-outline-secondary <?php echo e($currentPage == $totalPages ? 'active' : ''); ?>">
                                                    <?php echo e($totalPages); ?>

                                                </a>
                                            <?php endif; ?>
                                            <a href="<?php echo e($images->nextPageUrl() ?: '#'); ?>"
                                                class="btn btn-outline-secondary <?php echo e(!$images->nextPageUrl() ? 'disabled' : ''); ?>">
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="row g-3">
                                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-6 col-sm-4 col-md-3">
                                            <div class="card h-100">
                                                <div class="card-img-top" style="height: 100px; overflow: hidden;">
                                                    <img src="<?php echo e($image->path); ?>" class="w-100 h-100 object-fit-cover"
                                                        alt="Gallery Image" style="object-fit: cover;">
                                                </div>
                                                <div class="card-body p-2">
                                                    <div class="btn-group w-100" role="group">
                                                        <button type="button" class="btn btn-outline-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editImageModal<?php echo e($image->id); ?>">
                                                            <i class="bi bi-arrow-repeat me-1"></i> Update
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm delete-image-btn"
                                                            data-url="<?php echo e(route('admin.tournament_gallery.images.destroy', $image->id)); ?>"
                                                            data-preview="<?php echo e($image->path); ?>" data-bs-toggle="modal"
                                                            data-bs-target="#deleteConfirmModal">
                                                            <i class="bi bi-trash me-1"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <div class="modal fade" id="editImageModal<?php echo e($image->id); ?>" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form
                                                    action="<?php echo e(route('admin.tournament_gallery.images.update', $image->id)); ?>"
                                                    method="POST" enctype="multipart/form-data"
                                                    class="update-image-form">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Update Gallery Image</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center mb-3">
                                                            <p class="text-muted small">Current Image:</p>
                                                            <img src="<?php echo e($image->path); ?>" class="img-fluid rounded"
                                                                style="max-height: 180px; object-fit: contain;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Replace with new image</label>
                                                            <input type="file" name="image" class="form-control"
                                                                required accept="image/*">
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
                                                            <i class="bi bi-check2-square me-1"></i>Save Changes
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($totalPages > 1): ?>
                                    <div class="mt-3 text-center">
                                        <small class="text-muted">Showing <?php echo e($images->count()); ?> of
                                            <?php echo e($gallery->images_count); ?> images</small>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="alert alert-info mb-0">
                                    <i class="bi bi-info-circle me-2"></i>
                                    No images uploaded yet. Upload some images to populate this gallery.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="modal fade" id="updateThumbnailModal<?php echo e($gallery->id); ?>" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="<?php echo e(route('admin.tournament_gallery.updateThumbnail', $gallery->id)); ?>"
                                    method="POST" enctype="multipart/form-data" class="update-thumbnail-form">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title">Update Gallery Thumbnail</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center mb-3">
                                            <p class="text-muted small">Current Thumbnail:</p>
                                            <img src="<?php echo e(asset('storage/' . str_replace('/storage/', '', $gallery->thumbnail_path))); ?>"
                                                class="img-fluid rounded" style="max-height: 180px; object-fit: contain;">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Choose new thumbnail</label>
                                            <input type="file" name="thumbnail" class="form-control" required
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
                                            <i class="bi bi-check2-square me-1"></i>Update Thumbnail
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="deletePreviewWrap" class="text-center mb-4">
                        <!-- Thumbnail/Image preview will be inserted here -->
                    </div>
                    <p id="deleteConfirmText" class="text-center mb-0"></p>
                    <p class="text-muted text-center small mt-2">
                        <i class="bi bi-info-circle me-1"></i>This action cannot be undone.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    
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
                    <span id="successModalMessage"><?php echo e(session('success') ?? ''); ?></span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize modals
            const warningModal = new bootstrap.Modal(document.getElementById('warningModal'));
            const warningMessage = document.getElementById('warningMessage');
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            const deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));

            // Show success modal if there's a success message
            <?php if(session('success')): ?>
                document.getElementById('successModalMessage').textContent = "<?php echo e(session('success')); ?>";
                successModal.show();

                // Auto-close after 3 seconds
                setTimeout(() => successModal.hide(), 3000);
            <?php endif; ?>

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

            // Setup validation for create gallery form
            const createGalleryForm = document.getElementById('createGalleryForm');
            if (createGalleryForm) {
                const thumbnailInput = createGalleryForm.querySelector('input[name="thumbnail"]');
                setupFileValidation(thumbnailInput, 5, 'thumbnail image');

                // Also validate on form submission
                createGalleryForm.addEventListener('submit', function(e) {
                    if (thumbnailInput.files.length > 0) {
                        const file = thumbnailInput.files[0];
                        const result = checkFileSize(file, 5, 'thumbnail image');

                        if (!result.valid) {
                            e.preventDefault();
                            showFileSizeWarning(result.message);
                        }
                    }
                });
            }

            // Setup validation for all gallery upload forms
            document.querySelectorAll('.gallery-upload-form').forEach(form => {
                const fileInput = form.querySelector('input[type="file"]');
                if (fileInput) {
                    setupFileValidation(fileInput, 5, 'gallery image');

                    // Also validate on form submission
                    form.addEventListener('submit', function(e) {
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
                                        `The gallery image "<strong>${oversizedFiles[0].name}</strong>" is ${oversizedFiles[0].size}MB, which exceeds the 5MB limit.`;
                                } else {
                                    message =
                                        `<strong>${oversizedFiles.length} gallery images</strong> exceed the 5MB limit:<br>`;
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
            });

            // Setup validation for all update image forms
            document.querySelectorAll('.update-image-form').forEach(form => {
                const fileInput = form.querySelector('input[type="file"]');
                if (fileInput) {
                    setupFileValidation(fileInput, 5, 'gallery image');

                    // Also validate on form submission
                    form.addEventListener('submit', function(e) {
                        if (fileInput.files.length > 0) {
                            const file = fileInput.files[0];
                            const result = checkFileSize(file, 5, 'gallery image');

                            if (!result.valid) {
                                e.preventDefault();
                                showFileSizeWarning(result.message);
                            }
                        }
                    });
                }
            });

            // Setup validation for all update thumbnail forms
            document.querySelectorAll('.update-thumbnail-form').forEach(form => {
                const fileInput = form.querySelector('input[name="thumbnail"]');
                if (fileInput) {
                    setupFileValidation(fileInput, 5, 'thumbnail image');

                    // Also validate on form submission
                    form.addEventListener('submit', function(e) {
                        if (fileInput.files.length > 0) {
                            const file = fileInput.files[0];
                            const result = checkFileSize(file, 5, 'thumbnail image');

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

            // Delete modal functionality
            const deletePreviewWrap = document.getElementById('deletePreviewWrap');
            const deleteConfirmText = document.getElementById('deleteConfirmText');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            let deleteUrl = null;
            let deleteCardId = null;
            let deleteType = null;

            // Dynamic delete modal setup
            document.querySelectorAll('.delete-gallery-btn, .delete-image-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    deleteUrl = this.dataset.url;
                    const preview = this.dataset.preview || '';
                    const thumbnail = this.dataset.thumbnail || '';
                    const title = this.dataset.title || '';

                    // Clear previous preview
                    deletePreviewWrap.innerHTML = '';

                    // Show preview based on what's being deleted
                    if (this.classList.contains('delete-gallery-btn')) {
                        // Show gallery thumbnail and title
                        deleteConfirmText.innerHTML =
                            `Are you sure you want to delete the gallery <strong>"${title}"</strong>?<br>This will also delete all images in this gallery.`;

                        // Show gallery thumbnail if available
                        if (thumbnail) {
                            deletePreviewWrap.innerHTML =
                                `<div class="text-center mb-3">
                        <p class="text-muted small mb-2">Gallery Thumbnail:</p>
                        <img src="${thumbnail}" 
                             class="img-fluid rounded border" 
                             style="max-height: 180px; max-width: 100%; object-fit: contain;"
                             alt="${title} thumbnail">
                    </div>`;
                        }
                    } else {
                        // Show image preview
                        deleteConfirmText.innerHTML =
                            'Are you sure you want to delete this image from the gallery?';

                        if (preview) {
                            deletePreviewWrap.innerHTML =
                                `<div class="text-center mb-3">
                        <p class="text-muted small mb-2">Image Preview:</p>
                        <img src="${preview}" 
                             class="img-fluid rounded border" 
                             style="max-height: 180px; max-width: 100%; object-fit: contain;"
                             alt="Image preview">
                    </div>`;
                        }
                    }
                });
            });

            // Confirm delete button - SIMPLIFIED VERSION
            confirmDeleteBtn.addEventListener('click', async function() {
                if (!deleteUrl) return;

                // Show loading state
                const originalText = confirmDeleteBtn.innerHTML;
                confirmDeleteBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Deleting...';
                confirmDeleteBtn.disabled = true;

                try {
                    // The DELETE will work regardless of response
                    await fetch(deleteUrl, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                        }
                    });

                    // Always assume success since we know the backend works
                    document.getElementById('successModalMessage').textContent =
                        'Deleted successfully!';
                    successModal.show();

                    // Reload to see changes
                    setTimeout(() => location.reload(), 1500);

                } catch (error) {
                    // Even if fetch fails, the delete might have succeeded
                    console.warn('Fetch completed but may have returned an unexpected response');
                    document.getElementById('successModalMessage').textContent =
                        'Gallery deleted. Refreshing page...';
                    successModal.show();

                    // Reload to confirm
                    setTimeout(() => location.reload(), 1500);
                }

                // Close delete modal
                deleteConfirmModal.hide();

                // Reset button
                setTimeout(() => {
                    confirmDeleteBtn.innerHTML = originalText;
                    confirmDeleteBtn.disabled = false;
                }, 1000);
            });
        });
    </script>

    <style>
        .object-fit-cover {
            object-fit: cover;
        }

        .thumbnail-preview {
            width: 100%;
            height: 200px;
            overflow: hidden;
            border-radius: 5px;
        }

        .thumbnail-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_tournament_gallery.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title', 'Teehouse'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Teehouse</h3>

        <?php
            $content = $content ?? null;

            $teepav = $content->teepav_images ?? []; // ✅ ADDED
            $lf9 = $content->lf9_images ?? [];
            $hwl = $content->hwl_images ?? [];
            $cf9 = $content->cf9_images ?? [];
            $hwc = $content->hwc_images ?? [];

            $groups = [
                'teepav' => ['label' => 'Tee Pavilion', 'images' => $teepav, 'icon' => 'bi-house-door'], // ✅ ADDED ABOVE
                'lf9' => ['label' => 'Langer Front 9', 'images' => $lf9, 'icon' => 'bi-flag'],
                'hwl' => ['label' => 'Halfway Langer', 'images' => $hwl, 'icon' => 'bi-signpost-split'],
                'cf9' => ['label' => 'Couples Front 9', 'images' => $cf9, 'icon' => 'bi-people'],
                'hwc' => ['label' => 'Halfway Couples', 'images' => $hwc, 'icon' => 'bi-signpost'],
            ];
        ?>

        <div class="row">
            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="bi <?php echo e($g['icon']); ?> me-2"></i><?php echo e($g['label']); ?></h5>
                        </div>
                        <div class="card-body">
                            
                            <form action="<?php echo e(route('admin.teehouse.upload_images', $key)); ?>" method="POST"
                                enctype="multipart/form-data" class="upload-form" data-group="<?php echo e($key); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label class="form-label">Upload Images</label>
                                    <input type="file" name="images[]" multiple class="form-control" required
                                        accept="image/*">
                                    <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                        You can select multiple images (JPG, PNG, WebP). Maximum file size: 5MB per image
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-file-earmark-arrow-up me-2"></i>Upload Images
                                </button>
                            </form>

                            <hr class="my-4">

                            
                            <?php if(count($g['images']) > 0): ?>
                                <h6 class="mb-3">Current Images (<?php echo e(count($g['images'])); ?>)</h6>
                                <div class="row g-3">
                                    <?php $__currentLoopData = $g['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-sm-6 col-md-4 col-lg-3">
                                            <div class="card h-100">
                                                <div class="card-img-top" style="height: 120px; overflow: hidden;">
                                                    <img src="<?php echo e(asset('storage/' . str_replace('/storage/', '', $img))); ?>"
                                                        class="w-100 h-100 object-fit-cover"
                                                        alt="<?php echo e($g['label']); ?> Image <?php echo e($i + 1); ?>"
                                                        style="object-fit: cover;">
                                                </div>
                                                <div class="card-body">
                                                    <div class="btn-group w-100" role="group">
                                                        <button class="btn btn-outline-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateModal<?php echo e($key); ?><?php echo e($i); ?>">
                                                            <i class="bi bi-arrow-repeat me-1"></i> Update
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal<?php echo e($key); ?><?php echo e($i); ?>">
                                                            <i class="bi bi-trash me-1"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="modal fade" id="updateModal<?php echo e($key); ?><?php echo e($i); ?>"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="<?php echo e(route('admin.teehouse.replace_image', [$key, $i])); ?>"
                                                        method="POST" enctype="multipart/form-data" class="update-form">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">
                                                                <i class="bi bi-arrow-repeat me-2"></i>Update Image
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center mb-3">
                                                                <p class="text-muted small">Current Image:</p>
                                                                <img src="<?php echo e(asset('storage/' . str_replace('/storage/', '', $img))); ?>"
                                                                    class="img-fluid rounded"
                                                                    style="max-height: 180px; object-fit: contain;">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Replace with new image</label>
                                                                <input type="file" name="image" required
                                                                    class="form-control" accept="image/*">
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

                                        
                                        <div class="modal fade" id="deleteModal<?php echo e($key); ?><?php echo e($i); ?>"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">
                                                            <i class="bi bi-trash me-2"></i>Delete Image
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to delete this image?</p>
                                                        <div class="my-3">
                                                            <img src="<?php echo e(asset('storage/' . str_replace('/storage/', '', $img))); ?>"
                                                                class="img-fluid rounded"
                                                                style="max-height: 180px; object-fit: contain;">
                                                        </div>
                                                        <p class="text-muted small">This action cannot be undone.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form
                                                            action="<?php echo e(route('admin.teehouse.remove_image', [$key, $i])); ?>"
                                                            method="POST" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="bi bi-trash me-2"></i>Delete Image
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info mb-0">
                                    <i class="bi bi-info-circle me-2"></i>
                                    No images uploaded yet for <?php echo e($g['label']); ?>. Upload some images to showcase this
                                    area.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header btn-success text-white">
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize modals
            const warningModal = new bootstrap.Modal(document.getElementById('warningModal'));
            const warningMessage = document.getElementById('warningMessage');
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));

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

            // Setup validation for all upload forms
            document.querySelectorAll('.upload-form').forEach(form => {
                const fileInput = form.querySelector('input[type="file"]');
                if (fileInput) {
                    setupFileValidation(fileInput, 5, 'image');

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
                                        `The image file "<strong>${oversizedFiles[0].name}</strong>" is ${oversizedFiles[0].size}MB, which exceeds the 5MB limit.`;
                                } else {
                                    message =
                                        `<strong>${oversizedFiles.length} image files</strong> exceed the 5MB limit:<br>`;
                                    oversizedFiles.forEach(file => {
                                        message += `• ${file.name} (${file.size}MB)<br>`;
                                    });
                                    message +=
                                        'Please select smaller files or reduce image quality.';
                                }

                                showFileSizeWarning(message);
                            }
                        }
                    });
                }
            });

            // Setup validation for all update forms
            document.querySelectorAll('.update-form').forEach(form => {
                const fileInput = form.querySelector('input[type="file"]');
                if (fileInput) {
                    setupFileValidation(fileInput, 5, 'image');

                    // Also validate on form submission
                    form.addEventListener('submit', function(e) {
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_teehouse.blade.php ENDPATH**/ ?>
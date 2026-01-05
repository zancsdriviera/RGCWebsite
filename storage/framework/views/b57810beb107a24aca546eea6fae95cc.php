
<?php $__env->startSection('title', 'Grill'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Grill</h3>

        <?php
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
        ?>

        
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="bi bi-images me-1"></i>Carousel Items (Images & Videos)</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.grill.carousel.upload')); ?>" method="POST" enctype="multipart/form-data"
                    id="carouselUploadForm">
                    <?php echo csrf_field(); ?>
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

                <?php if(count($carousel) > 0): ?>
                    <?php
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
                    ?>
                    <h6 class="mb-3">
                        Current Carousel Items (<?php echo e(count($carousel)); ?> total:
                        <?php echo e($imageCount); ?> image<?php echo e($imageCount != 1 ? 's' : ''); ?>,
                        <?php echo e($videoCount); ?> video<?php echo e($videoCount != 1 ? 's' : ''); ?>)
                    </h6>
                    <div class="row g-3">
                        <?php $__currentLoopData = $carousel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $rawItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $item = normalizeCarouselItem($rawItem, $i);
                            ?>
                            <div class="col-md-3 col-sm-6" id="carouselCard<?php echo e($i); ?>">
                                <div class="card h-100">
                                    <div class="card-img-top" style="height: 140px; overflow: hidden;">
                                        <?php if($item['type'] === 'video'): ?>
                                            <video class="w-100 h-100 object-fit-cover" style="object-fit: cover;" muted>
                                                <source src="<?php echo e(asset($item['path'])); ?>" type="video/mp4">
                                            </video>
                                            <div class="position-absolute top-0 start-0 bg-dark text-white px-2 py-1 small">
                                                <i class="bi bi-play-circle me-1"></i>Video
                                            </div>
                                        <?php else: ?>
                                            <img src="<?php echo e(asset($item['path'])); ?>" class="w-100 h-100 object-fit-cover"
                                                alt="Carousel Image" style="object-fit: cover;">
                                        <?php endif; ?>
                                        <?php if($item['is_old_format']): ?>
                                            <div class="position-absolute top-0 end-0 bg-info text-white px-2 py-1 small">
                                                <i class="bi bi-arrow-clockwise me-1"></i>Old Format
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <p class="small text-muted mb-2">
                                            <strong>Type:</strong> <?php echo e(ucfirst($item['type'])); ?><br>
                                            <strong>File:</strong> <?php echo e($item['original_name']); ?>

                                        </p>
                                        <div class="btn-group w-100" role="group">
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#updateCarouselModal<?php echo e($i); ?>">
                                                <i class="bi bi-arrow-repeat me-1"></i> Update
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                                data-action="<?php echo e(route('admin.grill.carousel.remove', $i)); ?>"
                                                data-card-id="carouselCard<?php echo e($i); ?>" data-type="carousel"
                                                data-name="<?php echo e(ucfirst($item['type'])); ?> Item <?php echo e($i + 1); ?>"
                                                data-preview="<?php echo e(asset($item['path'])); ?>"
                                                data-media-type="<?php echo e($item['type']); ?>">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="modal fade" id="updateCarouselModal<?php echo e($i); ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="<?php echo e(route('admin.grill.carousel.update', $i)); ?>" method="POST"
                                            enctype="multipart/form-data" class="update-carousel-form">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Update Carousel Item</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-3">
                                                    <p class="text-muted small">Current <?php echo e($item['type']); ?>:</p>
                                                    <?php if($item['type'] === 'video'): ?>
                                                        <video class="img-fluid rounded" style="max-height: 180px;" controls
                                                            muted>
                                                            <source src="<?php echo e(asset($item['path'])); ?>" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset($item['path'])); ?>" class="img-fluid rounded"
                                                            style="max-height: 180px; object-fit: contain;">
                                                    <?php endif; ?>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        No carousel items uploaded yet. Upload images or videos to showcase the grill area.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="card mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-egg-fried me-1"></i>Menu Items</h5>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                    <i class="bi bi-plus-circle me-1"></i>Add Menu Item
                </button>
            </div>
            <div class="card-body">
                <?php if(count($menu) > 0): ?>
                    <div class="row g-3">
                        <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3 col-sm-6" id="menuCard<?php echo e($i); ?>">
                                <div class="card h-100">
                                    <div class="card-img-top"
                                        style="height: 140px; overflow: hidden; background-color: #f8f9fa;">
                                        <?php if(!empty($item['image']) && $item['image'] !== ''): ?>
                                            <img src="<?php echo e(asset('storage/' . str_replace('/storage/', '', $item['image']))); ?>"
                                                class="w-100 h-100 object-fit-cover"
                                                alt="<?php echo e($item['name'] ?? 'Menu Item'); ?>" style="object-fit: cover;">
                                        <?php else: ?>
                                            <div
                                                class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                <i class="bi bi-image fs-1"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold"><?php echo e($item['name'] ?? 'Unnamed Item'); ?></h6>
                                        <p class="card-text text-muted mb-2"><?php echo e($item['price'] ?? '₱0.00'); ?></p>
                                        <div class="btn-group w-100" role="group">
                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#updateMenuModal<?php echo e($i); ?>">
                                                <i class="bi bi-arrow-repeat me-1"></i> Update
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                                data-action="<?php echo e(route('admin.grill.menu.remove', $i)); ?>"
                                                data-card-id="menuCard<?php echo e($i); ?>" data-type="menu"
                                                data-name="<?php echo e($item['name'] ?? 'Unnamed Item'); ?>"
                                                <?php if(!empty($item['image']) && $item['image'] !== ''): ?> data-preview="<?php echo e(asset('storage/' . str_replace('/storage/', '', $item['image']))); ?>" <?php endif; ?>
                                                data-media-type="image">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="modal fade" id="updateMenuModal<?php echo e($i); ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="<?php echo e(route('admin.grill.menu.update', $i)); ?>" method="POST"
                                            enctype="multipart/form-data" class="update-menu-form">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Update Menu Item</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Item Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="<?php echo e($item['name'] ?? ''); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Price</label>
                                                    <input type="text" name="price" class="form-control price-input"
                                                        value="<?php echo e($item['price'] ?? ''); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Item Image</label>
                                                    <?php if(!empty($item['image']) && $item['image'] !== ''): ?>
                                                        <div class="text-center mb-2">
                                                            <p class="text-muted small">Current Image:</p>
                                                            <img src="<?php echo e(asset('storage/' . str_replace('/storage/', '', $item['image']))); ?>"
                                                                class="img-fluid rounded"
                                                                style="max-height: 150px; object-fit: contain;">
                                                        </div>
                                                    <?php endif; ?>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        No menu items yet. Click <strong>Add Menu Item</strong> to create one.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="modal fade" id="addMenuModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="<?php echo e(route('admin.grill.menu.add')); ?>" method="POST" enctype="multipart/form-data"
                        id="addMenuForm">
                        <?php echo csrf_field(); ?>
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
                        <span id="successModalMessage"><?php echo e(session('modal_message') ?? ''); ?></span>
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modals
            const warningModal = new bootstrap.Modal(document.getElementById('warningModal'));
            const warningMessage = document.getElementById('warningMessage');
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));

            // Show success modal if exists
            <?php if(session('modal_message')): ?>
                document.getElementById('successModalMessage').textContent = "<?php echo e(session('modal_message')); ?>";
                successModal.show();
                setTimeout(() => successModal.hide(), 3000);
            <?php endif; ?>

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
            position: relative;
        }

        video {
            background-color: #000;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_grill.blade.php ENDPATH**/ ?>
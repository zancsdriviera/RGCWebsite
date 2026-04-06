
<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
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

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.homepage.update')); ?>" method="POST" enctype="multipart/form-data" id="homepageForm">
            <?php echo csrf_field(); ?>
            <div class="row gy-4">

                
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 1–3 (Main Banners)</h5>
                            <div class="file-size-info mb-3">Maximum file size for carousel images: 20MB</div>
                            <div class="row g-4">
                                <?php for($i = 1; $i <= 3; $i++): ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Image <?php echo e($i); ?></label>
                                            <img id="carousel<?php echo e($i); ?>Preview"
                                                src="<?php echo e($homepage->{'carousel' . $i} ? asset('storage/' . $homepage->{'carousel' . $i}) : ''); ?>"
                                                class="img-fluid rounded mb-3 shadow-sm" alt="Carousel <?php echo e($i); ?>"
                                                style="max-height:180px; object-fit:cover; <?php echo e($homepage->{'carousel' . $i} ? '' : 'display:none;'); ?>">
                                            <input type="file" name="carousel<?php echo e($i); ?>"
                                                class="form-control mb-3" data-preview="carousel<?php echo e($i); ?>Preview"
                                                data-max-size="20480" accept="image/*"
                                                <?php echo e($homepage->{'carousel' . $i} ? '' : 'required'); ?>>
                                            <div class="file-size-info">Max: 20MB</div>
                                            <label class="fw-semibold">Caption</label>
                                            <input type="text" name="carousel<?php echo e($i); ?>Caption"
                                                class="form-control" value="<?php echo e($homepage->{'carousel' . $i . 'Caption'}); ?>"
                                                required>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Additional Carousel Images</h5>
                            <div class="file-size-info mb-3">Maximum file size: Images 20MB &bull; Videos 300MB</div>

                            <div id="dynamicCarouselContainer" class="row g-4">
                                <?php if(!empty($homepage->dynamic_carousels)): ?>
                                    <?php $__currentLoopData = $homepage->dynamic_carousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $ext = strtolower(pathinfo($carousel['image'] ?? '', PATHINFO_EXTENSION));
                                            $isVideo = in_array($ext, ['mp4', 'mov', 'avi', 'webm']);
                                        ?>
                                        <div class="col-md-6 col-lg-4 dynamic-carousel-item"
                                            data-id="<?php echo e($carousel['id'] ?? $index); ?>">
                                            <div class="border rounded p-3 h-100 position-relative">
                                                <label class="fw-semibold d-block mb-2">Image / Video</label>

                                                <?php if($isVideo): ?>
                                                    <video id="dynamicPreview<?php echo e($index); ?>"
                                                        src="<?php echo e(asset('storage/' . $carousel['image'])); ?>"
                                                        class="img-fluid rounded mb-3 shadow-sm"
                                                        style="max-height:180px; width:100%; object-fit:cover;" muted
                                                        playsinline controls></video>
                                                <?php else: ?>
                                                    <img id="dynamicPreview<?php echo e($index); ?>"
                                                        src="<?php echo e($carousel['image'] ? asset('storage/' . $carousel['image']) : ''); ?>"
                                                        class="img-fluid rounded mb-3 shadow-sm"
                                                        style="max-height:180px; object-fit:cover; <?php echo e($carousel['image'] ? '' : 'display:none;'); ?>">
                                                <?php endif; ?>

                                                <input type="file" class="form-control mb-3 dynamic-image-input"
                                                    data-preview="dynamicPreview<?php echo e($index); ?>" data-max-image="20480"
                                                    data-max-video="307200"
                                                    accept="image/*,video/mp4,video/quicktime,video/webm,video/avi">
                                                <div class="file-size-info">Images: max 20MB &bull; Videos: max 300MB</div>

                                                <input type="hidden" class="existing-image-path"
                                                    value="<?php echo e($carousel['image'] ?? ''); ?>">

                                                <label class="fw-semibold mt-2">Caption <span
                                                        class="text-muted fw-normal">(optional)</span></label>
                                                <input type="text" class="form-control dynamic-caption"
                                                    value="<?php echo e($carousel['caption'] ?? ''); ?>"
                                                    placeholder="Enter caption (optional)">

                                                <div class="d-flex gap-2 mt-3">
                                                    <button type="button" class="btn btn-success btn-sm save-dynamic"
                                                        data-id="<?php echo e($carousel['id'] ?? $index); ?>" data-mode="update">
                                                        <i class="bi bi-check-circle me-1"></i>Save
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm remove-dynamic"
                                                        data-id="<?php echo e($carousel['id'] ?? $index); ?>">
                                                        <i class="bi bi-trash me-1"></i>Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>

                            <button type="button" id="addDynamicCarousel" class="btn btn-outline-success mt-3">
                                <i class="bi bi-plus-circle me-2"></i>Add Carousel Image / Video
                            </button>

                            <template id="newCarouselTemplate">
                                <div class="col-md-6 col-lg-4 dynamic-carousel-item" data-id="new">
                                    <div class="border rounded p-3 h-100 position-relative">
                                        <label class="fw-semibold d-block mb-2">Image / Video</label>
                                        <img class="img-fluid rounded mb-3 shadow-sm dynamic-preview"
                                            style="max-height:180px; object-fit:cover; display:none;">
                                        <video class="img-fluid rounded mb-3 shadow-sm dynamic-video-preview"
                                            style="max-height:180px; width:100%; object-fit:cover; display:none;" muted
                                            playsinline></video>
                                        <input type="file" class="form-control mb-3 dynamic-image-input"
                                            data-max-image="20480" data-max-video="307200"
                                            accept="image/*,video/mp4,video/quicktime,video/webm,video/avi">
                                        <div class="file-size-info">Images: max 20MB &bull; Videos: max 300MB</div>

                                        <input type="hidden" class="existing-image-path" value="">

                                        <label class="fw-semibold mt-2">Caption <span
                                                class="text-muted fw-normal">(optional)</span></label>
                                        <input type="text" class="form-control dynamic-caption"
                                            placeholder="Enter caption (optional)">

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

                
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 4–5 (Course Descriptions)</h5>
                            <div class="file-size-info mb-3">Maximum file size for carousel images: 20MB</div>
                            <div class="row g-4">
                                <?php for($i = 4; $i <= 5; $i++): ?>
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Image <?php echo e($i); ?></label>
                                            <img id="carousel<?php echo e($i); ?>Preview"
                                                src="<?php echo e($homepage->{'carousel' . $i} ? asset('storage/' . $homepage->{'carousel' . $i}) : ''); ?>"
                                                class="img-fluid rounded shadow-sm" alt="Carousel <?php echo e($i); ?>"
                                                style="max-height:180px; object-fit:cover; <?php echo e($homepage->{'carousel' . $i} ? '' : 'display:none;'); ?>">
                                            <input type="file" name="carousel<?php echo e($i); ?>"
                                                class="form-control mb-3"
                                                data-preview="carousel<?php echo e($i); ?>Preview" data-max-size="20480"
                                                accept="image/*" <?php echo e($homepage->{'carousel' . $i} ? '' : 'required'); ?>>
                                            <div class="file-size-info">Max: 20MB</div>
                                            <label class="fw-semibold">Description</label>
                                            <textarea name="carousel<?php echo e($i); ?>Caption" class="form-control" rows="4" required
                                                placeholder="Enter description for Carousel <?php echo e($i); ?>"><?php echo e($homepage->{'carousel' . $i . 'Caption'} ?? ''); ?></textarea>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Headline & Subheadline</h5>
                            <label class="fw-semibold">Headline</label>
                            <input type="text" name="headline" class="form-control mb-3" required
                                value="<?php echo e($homepage->headline); ?>">
                            <label class="fw-semibold">Subheadline</label>
                            <textarea name="subheadline" class="form-control" rows="2" required><?php echo e($homepage->subheadline); ?></textarea>
                        </div>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Homepage Cards</h5>
                            <div class="file-size-info mb-3">Maximum file size for card images: 10MB</div>
                            <div class="row g-4">
                                <?php for($i = 1; $i <= 3; $i++): ?>
                                    <div class="col-md-4">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Card <?php echo e($i); ?></label>
                                            <img id="card<?php echo e($i); ?>Preview"
                                                src="<?php echo e($homepage->{'card' . $i . '_image'} ? asset('storage/' . $homepage->{'card' . $i . '_image'}) : ''); ?>"
                                                class="img-fluid rounded mb-3 shadow-sm" alt="Card <?php echo e($i); ?>"
                                                style="max-height:160px; object-fit:cover; <?php echo e($homepage->{'card' . $i . '_image'} ? '' : 'display:none;'); ?>">
                                            <input type="file" name="card<?php echo e($i); ?>_image"
                                                class="form-control mb-3" data-preview="card<?php echo e($i); ?>Preview"
                                                data-max-size="10240" accept="image/*"
                                                <?php echo e($homepage->{'card' . $i . '_image'} ? '' : 'required'); ?>>
                                            <div class="file-size-info">Max: 10MB</div>
                                            <label class="fw-semibold">Title</label>
                                            <input type="text" name="card<?php echo e($i); ?>_title"
                                                class="form-control" value="<?php echo e($homepage->{'card' . $i . '_title'}); ?>"
                                                required>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary shadow-lg position-fixed"
                        style="bottom: 30px; right: 30px; z-index: 1050; border-radius: 50px; padding: 12px 24px; font-weight: 600;">
                        <i class="bi bi-check-square me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>

    
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
                    <?php echo e(session('modal_message')); ?>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>File Too Large
                    </h5>
                </div>
                <div class="modal-body text-black" id="errorModalMessage"></div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            <?php if(session('success')): ?>
                const modalEl = document.getElementById('successModal');
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.textContent = "<?php echo e(session('success')); ?>";
                modalBody.style.color = 'green';
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
                setTimeout(() => modal.hide(), 5000);
            <?php endif; ?>
        });

        document.addEventListener('DOMContentLoaded', () => {
            // File preview for main form (excluding dynamic carousels)
            document.querySelectorAll('input[type="file"]:not(.dynamic-image-input)').forEach(input => {
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (!file) return;

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

            // Main form submit validation
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

            function showErrorModal(message) {
                document.getElementById('errorModalMessage').innerHTML = message;
                new bootstrap.Modal(document.getElementById('errorModal')).show();
            }
        });
    </script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('dynamicCarouselContainer');
            const template = document.getElementById('newCarouselTemplate');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // ── Helpers ──────────────────────────────────────────────────────────────
            function showSuccessModal(message) {
                const modalEl = document.getElementById('successModal');
                if (modalEl) {
                    const modalBody = modalEl.querySelector('.modal-body');
                    modalBody.textContent = message;
                    modalBody.style.color = 'green';
                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modal.show();
                    setTimeout(() => modal.hide(), 3000);
                } else {
                    alert('Success: ' + message);
                }
            }

            function showAjaxErrorModal(message) {
                const errorModalEl = document.getElementById('errorModal');
                if (errorModalEl) {
                    document.getElementById('errorModalMessage').innerHTML = message;
                    new bootstrap.Modal(errorModalEl).show();
                } else {
                    alert('Error: ' + message);
                }
            }

            function validateFileSize(file, imageMaxKB, videoMaxKB) {
                const isVideo = file.type.startsWith('video/');
                const maxKB = isVideo ? videoMaxKB : imageMaxKB;
                const maxMB = (maxKB / 1024).toFixed(0);
                const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);

                if (file.size / 1024 > maxKB) {
                    const type = isVideo ? 'video' : 'image';
                    showAjaxErrorModal(
                        `File "${file.name}" is ${fileSizeMB}MB. Maximum allowed size for ${type} files is ${maxMB}MB.`
                    );
                    return false;
                }
                return true;
            }

            function handlePreview(file, item) {
                const imgPreview = item.querySelector('img.dynamic-preview, img[id^="dynamicPreview"]');
                const videoPreview = item.querySelector('video.dynamic-video-preview, video[id^="dynamicPreview"]');

                if (file.type.startsWith('video/')) {
                    if (imgPreview) imgPreview.style.display = 'none';
                    if (videoPreview) {
                        videoPreview.src = URL.createObjectURL(file);
                        videoPreview.style.display = 'block';
                        videoPreview.onloadeddata = () => URL.revokeObjectURL(videoPreview.src);
                    }
                } else {
                    if (videoPreview) videoPreview.style.display = 'none';
                    if (imgPreview) {
                        imgPreview.src = URL.createObjectURL(file);
                        imgPreview.style.display = 'block';
                        imgPreview.onload = () => URL.revokeObjectURL(imgPreview.src);
                    }
                }
            }

            // ── File preview for existing DB items ───────────────────────────────────
            document.querySelectorAll('.dynamic-image-input').forEach(input => {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    const imageMaxKB = parseInt(this.getAttribute('data-max-image') || 20480);
                    const videoMaxKB = parseInt(this.getAttribute('data-max-video') || 307200);

                    if (!validateFileSize(file, imageMaxKB, videoMaxKB)) {
                        this.value = '';
                        return;
                    }

                    handlePreview(file, this.closest('.dynamic-carousel-item'));
                });
            });

            // ── Add new carousel block ────────────────────────────────────────────────
            document.getElementById('addDynamicCarousel').addEventListener('click', function() {
                const clone = template.content.cloneNode(true);
                const item = clone.querySelector('.dynamic-carousel-item');

                item.querySelector('.dynamic-image-input').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    const imageMaxKB = parseInt(this.getAttribute('data-max-image') || 20480);
                    const videoMaxKB = parseInt(this.getAttribute('data-max-video') || 307200);

                    if (!validateFileSize(file, imageMaxKB, videoMaxKB)) {
                        this.value = '';
                        return;
                    }

                    handlePreview(file, item);
                });

                container.appendChild(clone);
            });

            // ── Save (create or update) ───────────────────────────────────────────────
            container.addEventListener('click', async function(e) {
                const button = e.target.closest('.save-dynamic');
                if (!button) return;

                const item = button.closest('.dynamic-carousel-item');
                const id = button.getAttribute('data-id');
                const mode = button.getAttribute('data-mode');
                const imageInput = item.querySelector('.dynamic-image-input');
                const existingImage = item.querySelector('.existing-image-path').value;
                const caption = item.querySelector('.dynamic-caption').value;

                if (!imageInput.files[0] && !existingImage) {
                    showAjaxErrorModal('Please select an image or video.');
                    return;
                }

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
                    const response = await fetch('<?php echo e(route('admin.dynamic.carousel.save')); ?>', {
                        method: 'POST',
                        body: formData,
                    });

                    const result = await response.json();

                    if (result.success) {
                        item.setAttribute('data-id', result.data.id);
                        item.setAttribute('data-dirty', '0');
                        item.querySelector('.existing-image-path').value = result.data.image;

                        button.setAttribute('data-mode', 'update');
                        button.setAttribute('data-id', result.data.id);

                        const cancelBtn = item.querySelector('.cancel-dynamic');
                        if (cancelBtn) {
                            cancelBtn.classList.replace('btn-secondary', 'btn-danger');
                            cancelBtn.classList.replace('cancel-dynamic', 'remove-dynamic');
                            cancelBtn.setAttribute('data-id', result.data.id);
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
            });

            // ── Remove ────────────────────────────────────────────────────────────────
            container.addEventListener('click', async function(e) {
                const button = e.target.closest('.remove-dynamic');
                if (!button) return;

                const item = button.closest('.dynamic-carousel-item');
                const id = item.getAttribute('data-id');

                if (id === 'new') {
                    item.remove();
                    return;
                }

                showConfirmationModal('Are you sure you want to remove this carousel?', async () => {
                    button.disabled = true;
                    button.innerHTML =
                        '<i class="bi bi-hourglass-split me-1"></i>Removing...';

                    try {
                        const formData = new FormData();
                        formData.append('_token', csrfToken);
                        formData.append('id', id);

                        const response = await fetch(
                            '<?php echo e(route('admin.dynamic.carousel.remove')); ?>', {
                                method: 'POST',
                                body: formData,
                            });

                        const result = await response.json();

                        if (result.success) {
                            item.style.transition = 'opacity 0.3s';
                            item.style.opacity = '0';
                            setTimeout(() => {
                                item.remove();
                                showSuccessModal('Carousel removed successfully!');
                            }, 300);
                        } else {
                            throw new Error(result.message || 'Failed to remove carousel');
                        }
                    } catch (error) {
                        button.disabled = false;
                        button.innerHTML = '<i class="bi bi-trash me-1"></i>Remove';
                        showAjaxErrorModal('Error: ' + error.message);
                    }
                });
            });

            // ── Dirty state tracking on dynamic carousel items ────────────────────────
            container.addEventListener('change', function(e) {
                const item = e.target.closest('.dynamic-carousel-item');
                if (item) item.setAttribute('data-dirty', '1');
            });
            container.addEventListener('input', function(e) {
                const item = e.target.closest('.dynamic-carousel-item');
                if (item) item.setAttribute('data-dirty', '1');
            });

            // ── Save Changes — auto-save ALL dirty dynamic items first via AJAX ────────
            document.getElementById('homepageForm').addEventListener('submit', async function(e) {
                const dirtyItems = container.querySelectorAll('.dynamic-carousel-item[data-dirty="1"]');
                if (dirtyItems.length === 0) return; // nothing dirty, submit normally

                e.preventDefault();

                // Save each dirty item sequentially
                let allSaved = true;
                for (const item of dirtyItems) {
                    const id = item.getAttribute('data-id');
                    const mode = id === 'new' ? 'create' : 'update';
                    const imageInput = item.querySelector('.dynamic-image-input');
                    const existingImage = item.querySelector('.existing-image-path').value;
                    const caption = item.querySelector('.dynamic-caption').value;

                    // Skip if no image at all
                    if (!imageInput.files[0] && !existingImage) continue;

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

                    try {
                        const response = await fetch('<?php echo e(route('admin.dynamic.carousel.save')); ?>', {
                            method: 'POST',
                            body: formData,
                        });
                        const result = await response.json();

                        if (result.success) {
                            item.setAttribute('data-dirty', '0');
                            item.setAttribute('data-id', result.data.id);
                            item.querySelector('.existing-image-path').value = result.data.image;

                            // Switch Cancel → Remove for newly saved items
                            const cancelBtn = item.querySelector('.cancel-dynamic');
                            if (cancelBtn) {
                                cancelBtn.classList.replace('btn-secondary', 'btn-danger');
                                cancelBtn.classList.replace('cancel-dynamic', 'remove-dynamic');
                                cancelBtn.setAttribute('data-id', result.data.id);
                                cancelBtn.innerHTML = '<i class="bi bi-trash me-1"></i>Remove';
                            }

                            // Update save button to update mode
                            const saveBtn = item.querySelector('.save-dynamic');
                            if (saveBtn) {
                                saveBtn.setAttribute('data-mode', 'update');
                                saveBtn.setAttribute('data-id', result.data.id);
                            }
                        } else {
                            allSaved = false;
                            showAjaxErrorModal('Failed to auto-save a carousel: ' + result.message);
                        }
                    } catch (err) {
                        allSaved = false;
                        showAjaxErrorModal('Network error while saving a carousel. Please try again.');
                    }
                }

                // Only submit main form if all dynamic saves succeeded
                if (allSaved) {
                    document.getElementById('homepageForm').submit();
                }
            });

            // ── Cancel new item ───────────────────────────────────────────────────────
            container.addEventListener('click', function(e) {
                const button = e.target.closest('.cancel-dynamic');
                if (!button) return;
                button.closest('.dynamic-carousel-item').remove();
            });

            // ── Confirmation modal (uses existing removeCarouselModal) ────────────────
            function showConfirmationModal(message, onConfirm) {
                const modalEl = document.getElementById('removeCarouselModal');
                if (!modalEl) {
                    if (confirm(message)) onConfirm();
                    return;
                }

                const modal = new bootstrap.Modal(modalEl);
                const confirmBtn = document.getElementById('confirmRemoveCarousel');

                modal.show();

                const handler = function() {
                    modal.hide();
                    onConfirm();
                    confirmBtn.removeEventListener('click', handler);
                };
                confirmBtn.addEventListener('click', handler);
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_homepage.blade.php ENDPATH**/ ?>
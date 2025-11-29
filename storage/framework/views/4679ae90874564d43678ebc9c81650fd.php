
<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .btn-primary:hover {
            transform: scale(1.05);
            transition: 0.2s;
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

        <form action="<?php echo e(route('admin.homepage.update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row gy-4">

                
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 1–3 (Main Banners)</h5>
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
                                                <?php echo e($homepage->{'carousel' . $i} ? '' : 'required'); ?>>
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
                            <div id="dynamicCarouselContainer" class="row g-4">
                                <?php if(!empty($homepage->dynamic_carousels)): ?>
                                    <?php $__currentLoopData = $homepage->dynamic_carousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6 col-lg-4 dynamic-carousel-item">
                                            <div class="border rounded p-3 h-100">
                                                <label class="fw-semibold d-block mb-2">Image</label>
                                                <img id="dynamicPreview<?php echo e($index); ?>"
                                                    src="<?php echo e($carousel['image'] ? asset('storage/' . $carousel['image']) : ''); ?>"
                                                    class="img-fluid rounded mb-3 shadow-sm"
                                                    style="max-height:180px; object-fit:cover; <?php echo e($carousel['image'] ? '' : 'display:none;'); ?>">
                                                <input type="file" name="dynamicCarousels[<?php echo e($index); ?>][image]"
                                                    class="form-control mb-3"
                                                    data-preview="dynamicPreview<?php echo e($index); ?>">
                                                <label class="fw-semibold">Caption</label>
                                                <input type="text" name="dynamicCarousels[<?php echo e($index); ?>][caption]"
                                                    class="form-control" value="<?php echo e($carousel['caption'] ?? ''); ?>">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm mt-2 removeDynamic">Remove</button>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <button type="button" id="addDynamicCarousel" class="btn btn-success mt-3">
                                <i class="bi bi-plus-circle me-2"></i>Add Carousel Image
                            </button>
                        </div>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 4–5 (Course Descriptions)</h5>
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
                                                class="form-control mb-3" data-preview="carousel<?php echo e($i); ?>Preview"
                                                <?php echo e($homepage->{'carousel' . $i} ? '' : 'required'); ?>>
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
                                                <?php echo e($homepage->{'card' . $i . '_image'} ? '' : 'required'); ?>>
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
                <div class="modal-header bg-success text-white">
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

    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            <?php if(session('success')): ?>
                const modalEl = document.getElementById('successModal');
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.textContent = "<?php echo e(session('success')); ?>";
                modalBody.style.color = 'green'; // optional: color

                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // Auto-close after 1.5s
                setTimeout(() => modal.hide(), 3000);
            <?php endif; ?>
        });
        document.addEventListener('DOMContentLoaded', () => {
            // File preview
            document.querySelectorAll('input[type="file"]').forEach(input => {
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (!file) return;
                    const previewId = e.target.getAttribute('data-preview');
                    if (!previewId) return;
                    const preview = document.getElementById(previewId);
                    if (!preview) return;
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                    preview.onload = () => URL.revokeObjectURL(preview.src);
                });
            });

            // Dynamic Carousel Add/Remove
            let dynamicIndex =
                <?php echo e(!empty($homepage->dynamic_carousels) ? count($homepage->dynamic_carousels) : 0); ?>;
            const container = document.getElementById('dynamicCarouselContainer');
            let itemToRemove = null;

            // Add new carousel
            document.getElementById('addDynamicCarousel').addEventListener('click', () => {
                const html = `
        <div class="col-md-6 col-lg-4 dynamic-carousel-item">
            <div class="border rounded p-3 h-100">
                <label class="fw-semibold d-block mb-2">Image</label>
                <img id="dynamicPreview${dynamicIndex}" class="img-fluid rounded mb-3 shadow-sm" style="max-height:180px; object-fit:cover; display:none;">
                <input type="file" name="dynamicCarousels[${dynamicIndex}][image]" class="form-control mb-3" data-preview="dynamicPreview${dynamicIndex}">
                <label class="fw-semibold">Caption</label>
                <input type="text" name="dynamicCarousels[${dynamicIndex}][caption]" class="form-control">
                <button type="button" class="btn btn-danger btn-sm mt-2 removeDynamic">Remove</button>
            </div>
        </div>`;
                container.insertAdjacentHTML('beforeend', html);
                dynamicIndex++;
            });

            // Remove carousel with modal
            container.addEventListener('click', (e) => {
                if (e.target.classList.contains('removeDynamic')) {
                    itemToRemove = e.target.closest('.dynamic-carousel-item');
                    const removeModal = new bootstrap.Modal(document.getElementById('removeCarouselModal'));
                    removeModal.show();
                }
            });

            document.getElementById('confirmRemoveCarousel').addEventListener('click', () => {
                if (!itemToRemove) return;
                itemToRemove.style.transition = 'opacity 0.3s';
                itemToRemove.style.opacity = 0;
                setTimeout(() => {
                    itemToRemove.remove();
                    itemToRemove = null;
                }, 300);

                // Hide modal
                const removeModalEl = document.getElementById('removeCarouselModal');
                const modal = bootstrap.Modal.getInstance(removeModalEl);
                modal.hide();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_homepage.blade.php ENDPATH**/ ?>
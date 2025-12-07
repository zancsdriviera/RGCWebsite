
<?php $__env->startSection('title', 'Grill'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Grill</h3>

        <?php
            $content = $content ?? null;
            $carousel = $content->carousel_images ?? [];
            $menu = $content->menu_items ?? [];
        ?>

        
        <div class="card mb-4">
            <div class="card-header fw-bold" style="font-size:1.2em">Carousel Images</div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.grill.carousel.upload')); ?>" method="POST" enctype="multipart/form-data"
                    class="mb-3">
                    <?php echo csrf_field(); ?>
                    <label>Upload images</label>
                    <input type="file" name="carousel_images[]" multiple class="form-control mb-2" required>
                    <button class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-arrow-up me-2"></i>Upload</button>
                </form>

                <div class="row g-2">
                    <?php $__currentLoopData = $carousel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3" id="carouselCard<?php echo e($i); ?>">
                            <div class="card p-2">
                                <div style="width:100%;height:140px; overflow:hidden; border-radius:6px;">
                                    <img src="<?php echo e(asset('storage/' . $img)); ?>" class="img-fluid"
                                        style="width:100%;height:100%;object-fit:cover;">
                                </div>
                                <div class="d-flex gap-1 mt-2">
                                    <button class="btn btn-warning btn-sm w-50" data-bs-toggle="modal"
                                        data-bs-target="#updateCarouselModal<?php echo e($i); ?>"><i
                                            class="bi bi-arrow-repeat me-2"></i>Update</button>
                                    <button type="button" class="btn btn-danger btn-sm w-50" data-bs-toggle="modal"
                                        data-bs-target="#deleteConfirmModal"
                                        data-action="<?php echo e(route('admin.grill.carousel.remove', $i)); ?>"
                                        data-card-id="carouselCard<?php echo e($i); ?>" data-type="carousel"
                                        data-preview="<?php echo e(asset('storage/' . $img)); ?>"><i class="bi bi-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>

                        
                        <div class="modal fade" id="updateCarouselModal<?php echo e($i); ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('admin.grill.carousel.update', $i)); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Update Carousel Image</h5>
                                            <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?php echo e(asset('storage/' . $img)); ?>" class="img-fluid mb-2"
                                                style="width:100%;object-fit:cover;">
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success"><i
                                                    class="bi bi-check2-square me-2"></i>Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center fw-bold" style="font-size:1.2em">
                <span>Menu Items</span>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuModal"><i
                        class="bi bi-plus-circle me-2"></i>Add Menu
                    Item</button>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <?php $__empty_1 = true; $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-3" id="menuCard<?php echo e($i); ?>">
                            <div class="card p-2">
                                <div style="width:100%;height:140px; overflow:hidden; border-radius:6px;">
                                    <?php if(!empty($item['image'])): ?>
                                        <img src="<?php echo e(asset('storage/' . $item['image'])); ?>" class="img-fluid"
                                            style="width:100%;height:100%;object-fit:cover;">
                                    <?php else: ?>
                                        <div
                                            style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f3f3f3;color:#777;">
                                            No image
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-2">
                                    <div class="fw-bold"><?php echo e($item['name'] ?? 'Unnamed'); ?></div>
                                    <div class="text-muted"><?php echo e($item['price'] ?? '₱0.00'); ?></div>
                                </div>
                                <div class="d-flex gap-1 mt-2">
                                    <button class="btn btn-sm btn-warning w-50" data-bs-toggle="modal"
                                        data-bs-target="#updateMenuModal<?php echo e($i); ?>"><i
                                            class="bi bi-arrow-repeat me-2"></i>Update</button>
                                    <button type="button" class="btn btn-sm btn-danger w-50" data-bs-toggle="modal"
                                        data-bs-target="#deleteConfirmModal"
                                        data-action="<?php echo e(route('admin.grill.menu.remove', $i)); ?>"
                                        data-card-id="menuCard<?php echo e($i); ?>" data-type="menu"
                                        data-name="<?php echo e($item['name'] ?? 'Unnamed'); ?>"
                                        <?php if(!empty($item['image'])): ?> data-preview="<?php echo e(asset('storage/' . $item['image'])); ?>" <?php endif; ?>>
                                        <i class="bi bi-trash me-2"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </div>

                        
                        <div class="modal fade" id="updateMenuModal<?php echo e($i); ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('admin.grill.menu.update', $i)); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Update Menu Item</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="<?php echo e($item['name'] ?? ''); ?>">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Price</label>
                                                <input type="text" name="price" class="form-control"
                                                    value="<?php echo e($item['price'] ?? ''); ?>">
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Image</label>
                                                <?php if(!empty($item['image'])): ?>
                                                    <img src="<?php echo e(asset('storage/' . $item['image'])); ?>"
                                                        class="img-fluid mb-2"
                                                        style="max-width:300px;max-height:180px;object-fit:cover;display:block;margin:0 auto;">
                                                <?php endif; ?>
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bi bi-check2-square me-2"></i>Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12 text-muted">No menu items yet. Click <strong>Add Menu Item</strong> to create
                            one.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="addMenuModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="<?php echo e(route('admin.grill.menu.add')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Add Menu Item</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div id="deletePreviewWrap" class="mb-3"></div>
                        <div id="deleteConfirmText"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirmDeleteBtn" class="btn btn-success"><i
                                class="bi bi-check2-square me-2"></i>Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title">Success</h5>
                    </div>
                    <div class="modal-body text-black">
                        <span id="successModalMessage"><?php echo e(session('modal_message') ?? ''); ?></span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteConfirmModal = document.getElementById('deleteConfirmModal');
            const deletePreviewWrap = document.getElementById('deletePreviewWrap');
            const deleteConfirmText = document.getElementById('deleteConfirmText');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            let deleteUrl = null;
            let deleteCardId = null;
            let deleteType = null;
            let deleteName = '';

            // Show success modal if exists
            <?php if(session('modal_message')): ?>
                const successModalEl = document.getElementById('successModal');
                const successModal = new bootstrap.Modal(successModalEl);
                successModal.show();
                successModalEl.addEventListener('shown.bs.modal', function handler() {
                    setTimeout(() => successModal.hide(), 5000);
                    successModalEl.removeEventListener('shown.bs.modal', handler);
                });
            <?php endif; ?>

            // Dynamic delete modal
            document.querySelectorAll('[data-bs-target="#deleteConfirmModal"]').forEach(btn => {
                btn.addEventListener('click', function() {
                    deleteUrl = this.dataset.action;
                    deleteCardId = this.dataset.cardId;
                    deleteType = this.dataset.type || 'item';
                    deleteName = this.dataset.name || '';
                    const preview = this.dataset.preview || '';

                    deletePreviewWrap.innerHTML = preview ?
                        `<img src="${preview}" class="img-fluid" style="max-height:180px; object-fit:cover;">` :
                        '';

                    if (deleteType === 'carousel') {
                        deleteConfirmText.textContent =
                            'Are you sure you want to delete this carousel image?';
                    } else if (deleteType === 'menu') {
                        deleteConfirmText.innerHTML =
                            `Are you sure you want to delete <strong>${deleteName}</strong> from the list?`;

                    } else {
                        deleteConfirmText.textContent =
                            'Are you sure you want to delete this item?';
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

                    const successModalEl = document.getElementById('successModal');
                    successModalEl.querySelector('#successModalMessage').textContent = json.message ||
                        'Action completed.';
                    const successModal = new bootstrap.Modal(successModalEl);
                    successModal.show();
                    successModalEl.addEventListener('shown.bs.modal', function handler() {
                        setTimeout(() => successModal.hide(), 5000);
                        successModalEl.removeEventListener('shown.bs.modal', handler);
                    });

                    if (json.success && deleteCardId) {
                        const card = document.getElementById(deleteCardId);
                        if (card) card.remove();
                    }

                } catch (err) {
                    console.error(err);
                    const successModalEl = document.getElementById('successModal');
                    successModalEl.querySelector('#successModalMessage').textContent = 'Delete error';
                    const successModal = new bootstrap.Modal(successModalEl);
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

            document.querySelectorAll('input[name="price"]').forEach(input => {
                input.addEventListener('blur', () => formatPeso(input));
                input.addEventListener('focus', () => {
                    input.value = input.value.replace(/[^0-9]/g, '');
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_grill.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title', 'Locker Room'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Locker Room</h3>

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

        
        <div class="card mb-4 p-3 dark-bg">
            <h5>🏠 Description</h5>
            <form action="<?php echo e(route('admin.locker.updateDescription')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <textarea name="description" class="form-control" rows="5" required><?php echo e($description->description ?? ''); ?></textarea>
                <div class="mt-2">
                    <button class="btn btn-primary"><i class="bi bi-check-square me-2"></i>Save Description</button>
                </div>
            </form>
        </div>

        
        <div class="card mb-4 p-3">
            <h5>🖼 Upload Images</h5>
            <form action="<?php echo e(route('admin.locker.uploadImages')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="file" name="images[]" multiple class="form-control mb-2" required>
                <button class="btn btn-success"><i class="bi bi-file-earmark-arrow-up me-2"></i>Upload</button>
            </form>
        </div>

        
        <div class="row g-3">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="card p-3">
                        
                        <div style="width:100%;height:180px;overflow:hidden;">
                            <img src="<?php echo e($img->image_path); ?>" style="width:100%;height:100%;object-fit:cover;"
                                alt="Clubhouse Image">
                        </div>

                        
                        <button class="btn btn-warning btn-sm w-100 mt-2" data-bs-toggle="modal"
                            data-bs-target="#editModal<?php echo e($img->id); ?>">
                            <i class="bi bi-arrow-repeat"></i> Update
                        </button>

                        
                        <button class="btn btn-danger btn-sm w-100 mt-1" data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?php echo e($img->id); ?>">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </div>

                
                <div class="modal fade" id="editModal<?php echo e($img->id); ?>" tabindex="-1"
                    aria-labelledby="editModalLabel<?php echo e($img->id); ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="<?php echo e(route('admin.locker.updateImage', $img->id)); ?>" method="POST"
                            enctype="multipart/form-data" class="modal-content">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="editModalLabel<?php echo e($img->id); ?>">Update Image</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <img src="<?php echo e(asset($img->image_path)); ?>" class="img-fluid mt-2"
                                    style="width:100%; object-fit:cover;">
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"><i class="bi bi-check2-square me-2"></i>Save
                                    Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                
                <div class="modal fade" id="deleteModal<?php echo e($img->id); ?>" tabindex="-1"
                    aria-labelledby="deleteModalLabel<?php echo e($img->id); ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="<?php echo e(route('admin.locker.deleteImage', $img->id)); ?>" method="POST"
                            class="modal-content">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteModalLabel<?php echo e($img->id); ?>">Delete Image
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                Are you sure you want to delete this image?
                                <img src="<?php echo e(asset($img->image_path)); ?>" class="img-fluid mt-2"
                                    style="width:100%; object-fit:cover;">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"><i
                                        class="bi bi-check2-square me-2"></i>Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                setTimeout(() => modal.hide(), 5000);
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_locker.blade.php ENDPATH**/ ?>
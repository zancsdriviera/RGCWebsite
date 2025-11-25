
<?php $__env->startSection('title', 'Driving Range'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Driving Range</h3>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

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
            <form action="<?php echo e(route('admin.drivingrange.updateDescription')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <textarea name="description" class="form-control" rows="5" required><?php echo e($description->description ?? ''); ?></textarea>
                <div class="mt-2">
                    <button class="btn btn-primary"><i class="bi bi-check-square me-2"></i>Save Description</button>
                </div>
            </form>
        </div>

        
        <div class="card mb-4 p-3">
            <h5>🖼 Upload Images</h5>
            <form action="<?php echo e(route('admin.drivingrange.uploadImages')); ?>" method="POST" enctype="multipart/form-data">
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
                    <div class="modal-dialog">
                        <form action="<?php echo e(route('admin.drivingrange.updateImage', $img->id)); ?>" method="POST"
                            enctype="multipart/form-data" class="modal-content">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="editModalLabel<?php echo e($img->id); ?>">Update Image</h5>
                            </div>
                            <div class="modal-body">
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                
                <div class="modal fade" id="deleteModal<?php echo e($img->id); ?>" tabindex="-1"
                    aria-labelledby="deleteModalLabel<?php echo e($img->id); ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="<?php echo e(route('admin.drivingrange.deleteImage', $img->id)); ?>" method="POST"
                            class="modal-content">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteModalLabel<?php echo e($img->id); ?>">Delete Image
                                </h5>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this image? This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_drivingrange.blade.php ENDPATH**/ ?>
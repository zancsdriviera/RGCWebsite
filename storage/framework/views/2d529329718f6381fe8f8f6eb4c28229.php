
<?php $__env->startSection('title', 'Lobby'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Lobby</h3>

        
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

        
        <div class="card mb-4 p-3">
            <h5>🏠 Description</h5>
            <form action="<?php echo e(route('admin.lobby.updateDescription')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <textarea name="description" class="form-control" rows="5" required><?php echo e($description->description ?? ''); ?></textarea>
                <div class="mt-2">
                    <button class="btn btn-primary"><i class="bi bi-check-square me-2"></i>Save Description</button>
                </div>
            </form>
        </div>

        
        <div class="card mb-4 p-3">
            <h5>🖼 Upload Images</h5>
            <form action="<?php echo e(route('admin.lobby.uploadImages')); ?>" method="POST" enctype="multipart/form-data">
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
                                alt="Lobby Image">
                        </div>

                        
                        <form action="<?php echo e(route('admin.lobby.updateImage', $img->id)); ?>" method="POST"
                            enctype="multipart/form-data" class="mt-2">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="file" name="image" class="form-control form-control-sm mb-1" required>
                            <button class="btn btn-warning btn-sm w-100"><i class="bi bi-arrow-repeat"></i> Update</button>
                        </form>

                        
                        <form action="<?php echo e(route('admin.lobby.deleteImage', $img->id)); ?>" method="POST" class="mt-1"
                            onsubmit="return confirm('Are you sure you want to delete this image? This action cannot be undone.');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm w-100"><i class="bi bi-trash"></i> Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_lobby.blade.php ENDPATH**/ ?>
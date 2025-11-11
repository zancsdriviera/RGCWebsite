
<?php $__env->startSection('title', 'Careers'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <h4 class="fw-bold mb-4">Manage Careers</h4>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <!-- Add Career Image -->
        <form action="<?php echo e(route('admin.careers.store')); ?>" method="POST" enctype="multipart/form-data" class="card p-4 mb-4">
            <?php echo csrf_field(); ?>
            <h5>Add New Job Opening</h5>
            <div class="mb-3">
                <label class="form-label">Upload Image</label>
                <input type="file" name="career_image" class="form-control" accept="image/*" required>
            </div>
            <button class="btn btn-primary">Upload</button>
        </form>

        <!-- Display Uploaded Images -->
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <img src="<?php echo e(asset('storage/' . $career->career_image)); ?>" class="card-img-top" alt="Career Image">
                        <div class="card-body text-center">
                            <!-- Edit Form -->
                            <form action="<?php echo e(route('admin.careers.update', $career->id)); ?>" method="POST"
                                enctype="multipart/form-data" class="mb-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="file" name="career_image" class="form-control mb-2" accept="image/*"
                                    required>
                                <button class="btn btn-warning w-100">Update</button>
                            </form>

                            <!-- Delete Form -->
                            <form action="<?php echo e(route('admin.careers.destroy', $career->id)); ?>" method="POST"
                                onsubmit="return confirm('Delete this image?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger w-100">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-muted">No career images uploaded yet.</p>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_careers.blade.php ENDPATH**/ ?>
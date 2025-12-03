
<?php $__env->startSection('title', 'Teehouse Editor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Teehouse</h3>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <?php
            $content = $content ?? null;
            $lf9 = $content->lf9_images ?? [];
            $hwl = $content->hwl_images ?? [];
            $cf9 = $content->cf9_images ?? [];
            $hwc = $content->hwc_images ?? [];
        ?>

        <?php
            $groups = [
                'lf9' => ['label' => 'Langer Front 9', 'images' => $lf9],
                'hwl' => ['label' => 'Halfway Langer', 'images' => $hwl],
                'cf9' => ['label' => 'Couples Front 9', 'images' => $cf9],
                'hwc' => ['label' => 'Halfway Couples', 'images' => $hwc],
            ];
        ?>

        <div class="row">
            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header" style="font-weight: bold; font-size:1.2em"><?php echo e($g['label']); ?></div>
                        <div class="card-body">
                            
                            <form action="<?php echo e(route('admin.teehouse.upload_images', $key)); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <label>Upload images (multiple allowed)</label>
                                <input type="file" name="images[]" multiple class="form-control mb-2">
                                <button class="btn btn-primary btn-sm">Upload</button>
                            </form>

                            <hr>

                            
                            <div class="d-flex flex-wrap gap-2">
                                <?php $__currentLoopData = $g['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div style="width:140px; text-align:center;">
                                        
                                        <div
                                            style="width:140px; height:140px; overflow:hidden; border-radius:6px; margin-bottom:6px;">
                                            <img src="<?php echo e(asset('storage/' . $img)); ?>" class="img-fluid"
                                                style="width:100%; height:100%; object-fit:cover;">
                                        </div>

                                        
                                        <div class="d-flex flex-column gap-1">
                                            <button class="btn btn-warning btn-sm w-100 mt-2" data-bs-toggle="modal"
                                                data-bs-target="#updateModal<?php echo e($key); ?><?php echo e($i); ?>"><i
                                                    class="bi bi-arrow-repeat"></i>
                                                Update
                                            </button>

                                            <form action="<?php echo e(route('admin.teehouse.remove_image', [$key, $i])); ?>"
                                                method="POST" onsubmit="return confirm('Remove image?')">
                                                <?php echo csrf_field(); ?>
                                                <button class="btn btn-danger btn-sm w-100 mt-1"><i
                                                        class="bi bi-trash me-1"></i>Delete</button>
                                            </form>
                                        </div>
                                    </div>

                                    
                                    <div class="modal fade" id="updateModal<?php echo e($key); ?><?php echo e($i); ?>"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="<?php echo e(route('admin.teehouse.replace_image', [$key, $i])); ?>"
                                                    method="POST" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update image</h5>
                                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="<?php echo e(asset('storage/' . $img)); ?>" class="img-fluid mb-2"
                                                            style="width:100%; object-fit:cover;">
                                                        <input type="file" name="image" required class="form-control">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_teehouse.blade.php ENDPATH**/ ?>
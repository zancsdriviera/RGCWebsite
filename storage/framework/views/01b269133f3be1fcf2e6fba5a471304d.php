
<?php $__env->startSection('title', 'Teehouse'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Teehouse</h3>


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
                                <button class="btn btn-success btn-sm"><i
                                        class="bi bi-file-earmark-arrow-up me-2"></i>Upload</button>
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
                                                data-bs-target="#updateModal<?php echo e($key); ?><?php echo e($i); ?>">
                                                <i class="bi bi-arrow-repeat"></i> Update
                                            </button>

                                            
                                            <button class="btn btn-danger btn-sm w-100 mt-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal<?php echo e($key); ?><?php echo e($i); ?>">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </div>
                                    </div>

                                    
                                    <div class="modal fade" id="updateModal<?php echo e($key); ?><?php echo e($i); ?>"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="<?php echo e(route('admin.teehouse.replace_image', [$key, $i])); ?>"
                                                    method="POST" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Update image</h5>
                                                        <button class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="<?php echo e(asset('storage/' . $img)); ?>" class="img-fluid mb-2"
                                                            style="width:100%; object-fit:cover;">
                                                        <input type="file" name="image" required class="form-control">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success">Save Changes</button>
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
                                                    <h5 class="modal-title">Delete Image</h5>
                                                    <button class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Are you sure you want to delete this image?
                                                    <img src="<?php echo e(asset('storage/' . $img)); ?>" class="img-fluid mt-2"
                                                        style="width:100%; object-fit:cover;">
                                                </div>
                                                <div class="modal-footer">

                                                    
                                                    <button class="btn btn-success"
                                                        onclick="document.getElementById('deleteForm<?php echo e($key); ?><?php echo e($i); ?>').submit();">Confirm</button>
                                                </div>
                                                
                                                <form id="deleteForm<?php echo e($key); ?><?php echo e($i); ?>"
                                                    action="<?php echo e(route('admin.teehouse.remove_image', [$key, $i])); ?>"
                                                    method="POST" style="display:none;">
                                                    <?php echo csrf_field(); ?>
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
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_teehouse.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', isset($page) ? $page : 'Page Editor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3 text-capitalize"><?php echo e($page); ?> Page Elements</h5>

                        <div class="row">
                            <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6 mb-3">
                                    <form method="POST" action="<?php echo e(route('admin.update', $key)); ?>"
                                        enctype="multipart/form-data" class="p-2 border rounded bg-white">
                                        <?php echo csrf_field(); ?>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <strong class="text-muted"><?php echo e($key); ?></strong>
                                            <small class="text-muted"><?php echo e($content->type); ?></small>
                                        </div>

                                        <?php if($content->type === 'image'): ?>
                                            <div class="mb-2 text-center">
                                                <img src="<?php echo e($content->value ? asset('storage/' . $content->value) : asset('images/placeholder.png')); ?>"
                                                    class="img-fluid img-preview rounded"
                                                    style="max-height:160px; object-fit:cover;">
                                            </div>
                                            <div class="mb-2">
                                                <input type="file" name="value">
                                            </div>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-primary btn-sm">Upload</button>
                                                <a href="<?php echo e(url()->current()); ?>"
                                                    class="btn btn-outline-secondary btn-sm">Reset</a>
                                            </div>
                                        <?php else: ?>
                                            <div class="mb-2">
                                                <textarea name="value" rows="4" class="form-control"><?php echo e(old('value', $content->value)); ?></textarea>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-success btn-sm">Save</button>
                                                <a href="<?php echo e(url()->current()); ?>"
                                                    class="btn btn-outline-secondary btn-sm">Reset</a>
                                            </div>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views\admin1\page.blade.php ENDPATH**/ ?>
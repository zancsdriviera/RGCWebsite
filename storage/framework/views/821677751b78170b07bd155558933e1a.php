
<?php $__env->startSection('title', 'Tournament Gallery Editor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Tournament Gallery</h3>

        
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
            <h5>Create new gallery</h5>
            <form action="<?php echo e(route('admin.tournament_gallery.store')); ?>" method="POST" enctype="multipart/form-data"
                class="row g-3">
                <?php echo csrf_field(); ?>
                <div class="col-md-6">
                    <label class="form-label">Title</label>
                    <input name="title" class="form-control" required value="<?php echo e(old('title')); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Event date</label>
                    <input type="date" name="event_date" class="form-control" required value="<?php echo e(old('event_date')); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-images me-2"></i>Create
                        Gallery</button>
                </div>
            </form>
        </div>

        
        <div class="row g-3">
            <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6">
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5><?php echo e($g->title); ?></h5>
                                <small class="text-muted"><?php echo e($g->event_date); ?></small>
                            </div>
                            <form method="POST" action="<?php echo e(route('admin.tournament_gallery.destroy', $g->id)); ?>"
                                onsubmit="return confirm('Delete this entire gallery?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>

                        <hr>

                        
                        <form action="<?php echo e(route('admin.tournament_gallery.images.store', $g->id)); ?>" method="POST"
                            enctype="multipart/form-data" class="mb-3">
                            <?php echo csrf_field(); ?>
                            <label class="form-label">Upload images</label>
                            <input type="file" name="images[]" multiple class="form-control mb-2" required>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success btn-sm"><i
                                        class="bi bi-file-earmark-arrow-up me-2"></i>Upload</button>
                                
                            </div>
                        </form>
                        <hr>

                        
                        <div class="d-flex flex-wrap gap-2">
                            <?php $__currentLoopData = $g->images()->limit(6)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="text-center border rounded p-1" style="width:100px;">
                                    <img src="<?php echo e($img->path); ?>" style="width:100%;height:80px;object-fit:cover"
                                        alt="">

                                    
                                    <form action="<?php echo e(route('admin.tournament_gallery.images.destroy', $img->id)); ?>"
                                        method="POST" class="mt-1"
                                        onsubmit="return confirm('Are you sure you want to delete this image?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm w-100">Delete</button>
                                    </form>


                                    
                                    <button type="button" class="btn btn-warning btn-sm w-100 mt-1" data-bs-toggle="modal"
                                        data-bs-target="#editImageModal<?php echo e($img->id); ?>">
                                        Update
                                    </button>
                                </div>

                                
                                <div class="modal fade" id="editImageModal<?php echo e($img->id); ?>" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="<?php echo e(route('admin.tournament_gallery.images.update', $img->id)); ?>"
                                                method="POST" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Image</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="<?php echo e($img->path); ?>" class="img-fluid mb-3 rounded"
                                                        alt="">
                                                    <div class="mb-3">
                                                        <label class="form-label">Change Image</label>
                                                        <input type="file" name="image" class="form-control"
                                                            accept="image/*">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_tournament_gallery.blade.php ENDPATH**/ ?>
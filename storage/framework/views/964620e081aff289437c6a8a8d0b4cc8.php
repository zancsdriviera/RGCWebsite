
<?php $__env->startSection('title', 'Courses'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 fw-bold">Courses Management</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add New Course</button>
        </div>

        <!-- Success Message -->
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <!-- Courses List -->
        <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card mb-4 shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><?php echo e($course->langer_Mtitle); ?> / <?php echo e($course->couples_Mtitle); ?></h5>
                    <form action="<?php echo e(route('courses.destroy', $course->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this course?')">Delete
                            Course</button>
                    </form>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('courses.update', $course->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row">
                            <!-- Langer Column -->
                            <div class="col-md-6 border-end">
                                <h5 class="fw-bold">Langer Course</h5>

                                <label class="fw-semibold">Parent Title</label>
                                <input type="text" name="langer_Mtitle" class="form-control mb-2"
                                    value="<?php echo e($course->langer_Mtitle); ?>" required>

                                <label>Parent Main Image</label>
                                <?php if($course->langer_Mimage): ?>
                                    <img src="<?php echo e(asset('storage/' . $course->langer_Mimage)); ?>" width="120"
                                        class="mb-2 d-block">
                                <?php endif; ?>
                                <input type="file" name="langer_Mimage" class="form-control mb-3">

                                <label class="fw-semibold">Child Title</label>
                                <input type="text" name="langer_title" class="form-control mb-2"
                                    value="<?php echo e($course->langer_title); ?>">

                                <label>Description</label>
                                <textarea name="langer_description" class="form-control mb-2" rows="3"><?php echo e($course->langer_description); ?></textarea>

                                <label>Gallery Images</label>
                                <div class="d-flex flex-wrap mb-2">
                                    <?php if($course->langer_images): ?>
                                        <?php $__currentLoopData = $course->langer_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="position-relative m-1 text-center">
                                                <img src="<?php echo e(asset('storage/' . $img)); ?>" width="80"
                                                    class="img-thumbnail mb-1">
                                                <div>
                                                    <input type="checkbox" name="delete_langer_images[]"
                                                        value="<?php echo e($index); ?>"> Delete
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="langer_images[]" class="form-control" multiple>
                            </div>

                            <!-- Couples Column -->
                            <div class="col-md-6 ps-4">
                                <h5 class="fw-bold">Couples Course</h5>

                                <label class="fw-semibold">Parent Title</label>
                                <input type="text" name="couples_Mtitle" class="form-control mb-2"
                                    value="<?php echo e($course->couples_Mtitle); ?>" required>

                                <label>Parent Main Image</label>
                                <?php if($course->couples_Mimage): ?>
                                    <img src="<?php echo e(asset('storage/' . $course->couples_Mimage)); ?>" width="120"
                                        class="mb-2 d-block">
                                <?php endif; ?>
                                <input type="file" name="couples_Mimage" class="form-control mb-3">

                                <label class="fw-semibold">Child Title</label>
                                <input type="text" name="couples_title" class="form-control mb-2"
                                    value="<?php echo e($course->couples_title); ?>">

                                <label>Description</label>
                                <textarea name="couples_description" class="form-control mb-2" rows="3"><?php echo e($course->couples_description); ?></textarea>

                                <label>Gallery Images</label>
                                <div class="d-flex flex-wrap mb-2">
                                    <?php if($course->couples_images): ?>
                                        <?php $__currentLoopData = $course->couples_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="position-relative m-1 text-center">
                                                <img src="<?php echo e(asset('storage/' . $img)); ?>" width="80"
                                                    class="img-thumbnail mb-1">
                                                <div>
                                                    <input type="checkbox" name="delete_couples_images[]"
                                                        value="<?php echo e($index); ?>"> Delete
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="couples_images[]" class="form-control" multiple>
                            </div>
                        </div>

                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="alert alert-info">No courses found. Please add a course.</div>
        <?php endif; ?>
    </div>

    <!-- Add New Course Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form action="<?php echo e(route('courses.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Langer Column -->
                            <div class="col-md-6 border-end">
                                <h5 class="fw-bold">Langer Course</h5>
                                <label class="fw-semibold">Parent Title</label>
                                <input type="text" name="langer_Mtitle" class="form-control mb-2"
                                    placeholder="Parent Title" required>
                                <label>Parent Main Image</label>
                                <input type="file" name="langer_Mimage" class="form-control mb-3">
                                <label class="fw-semibold">Child Title</label>
                                <input type="text" name="langer_title" class="form-control mb-2"
                                    placeholder="Child Title">
                                <label>Description</label>
                                <textarea name="langer_description" class="form-control mb-2" rows="3" placeholder="Description"></textarea>
                                <label>Gallery Images</label>
                                <input type="file" name="langer_images[]" class="form-control" multiple>
                            </div>

                            <!-- Couples Column -->
                            <div class="col-md-6 ps-4">
                                <h5 class="fw-bold">Couples Course</h5>
                                <label class="fw-semibold">Parent Title</label>
                                <input type="text" name="couples_Mtitle" class="form-control mb-2"
                                    placeholder="Parent Title" required>
                                <label>Parent Main Image</label>
                                <input type="file" name="couples_Mimage" class="form-control mb-3">
                                <label class="fw-semibold">Child Title</label>
                                <input type="text" name="couples_title" class="form-control mb-2"
                                    placeholder="Child Title">
                                <label>Description</label>
                                <textarea name="couples_description" class="form-control mb-2" rows="3" placeholder="Description"></textarea>
                                <label>Gallery Images</label>
                                <input type="file" name="couples_images[]" class="form-control" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_courses.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title', 'Courses'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 fw-bold">Courses</h3>
        </div>

        <!-- Add Course Button -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Add Course</button>

        <!-- Success Message -->
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <!-- Courses Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Langer Title</th>
                        <th>Langer Image</th>
                        <th>Couples Title</th>
                        <th>Couples Image</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($course->langer_Mtitle); ?></td>
                            <td>
                                <?php if($course->langer_Mimage): ?>
                                    <img src="<?php echo e(asset('storage/' . $course->langer_Mimage)); ?>" width="80"
                                        class="img-thumbnail">
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($course->couples_Mtitle); ?></td>
                            <td>
                                <?php if($course->couples_Mimage): ?>
                                    <img src="<?php echo e(asset('storage/' . $course->couples_Mimage)); ?>" width="80"
                                        class="img-thumbnail">
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal<?php echo e($course->id); ?>">Edit</button>
                                <form action="<?php echo e(route('courses.destroy', $course->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this course?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?php echo e($course->id); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('courses.update', $course->id)); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Course</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="fw-semibold">Langer Title</label>
                                            <input type="text" name="langer_Mtitle" class="form-control mb-2"
                                                value="<?php echo e($course->langer_Mtitle); ?>" required>
                                            <label>Current Image</label>
                                            <?php if($course->langer_Mimage): ?>
                                                <img src="<?php echo e(asset('storage/' . $course->langer_Mimage)); ?>" width="100"
                                                    class="mb-2 d-block">
                                            <?php endif; ?>
                                            <input type="file" name="langer_Mimage" class="form-control mb-3">

                                            <label class="fw-semibold">Couples Title</label>
                                            <input type="text" name="couples_Mtitle" class="form-control mb-2"
                                                value="<?php echo e($course->couples_Mtitle); ?>" required>
                                            <label>Current Image</label>
                                            <?php if($course->couples_Mimage): ?>
                                                <img src="<?php echo e(asset('storage/' . $course->couples_Mimage)); ?>" width="100"
                                                    class="mb-2 d-block">
                                            <?php endif; ?>
                                            <input type="file" name="couples_Mimage" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">No courses found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?php echo e(route('courses.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Add Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label class="fw-semibold">Langer Title</label>
                        <input type="text" name="langer_Mtitle" class="form-control mb-2" placeholder="Title" required>
                        <label>Langer Image</label>
                        <input type="file" name="langer_Mimage" class="form-control mb-3">
                        <label class="fw-semibold">Couples Title</label>
                        <input type="text" name="couples_Mtitle" class="form-control mb-2" placeholder="Title" required>
                        <label>Couples Image</label>
                        <input type="file" name="couples_Mimage" class="form-control">
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
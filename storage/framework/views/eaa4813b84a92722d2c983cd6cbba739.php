<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h2>Courses</h2>
            <a href="<?php echo e(route('admin.logout')); ?>" class="btn btn-danger">Logout</a>
        </div>

        <!-- Add Course Button -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Add Course</button>

        <!-- Success Message -->
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <!-- Courses Table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Langer Title</th>
                    <th>Langer Image</th>
                    <th>Couples Title</th>
                    <th>Couples Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <!-- Edit Button -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal<?php echo e($course->id); ?>">Edit</button>

                            <!-- Delete Form -->
                            <form action="<?php echo e(route('courses.destroy', $course->id)); ?>" method="POST"
                                style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this course?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?php echo e($course->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
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
                                        <label>Langer Title</label>
                                        <input type="text" name="langer_Mtitle" class="form-control mb-2"
                                            value="<?php echo e($course->langer_Mtitle); ?>" required>
                                        <label>Current Image</label>
                                        <?php if($course->langer_Mimage): ?>
                                            <img src="<?php echo e(asset('storage/' . $course->langer_Mimage)); ?>" width="100"
                                                class="mb-2">
                                        <?php endif; ?>
                                        <input type="file" name="langer_Mimage" class="form-control">
                                    </div>

                                    <div class="modal-body">
                                        <label>Couples Title</label>
                                        <input type="text" name="couples_Mtitle" class="form-control mb-2"
                                            value="<?php echo e($course->couples_Mtitle); ?>" required>
                                        <label>Current Image</label>
                                        <?php if($course->couples_Mimage): ?>
                                            <img src="<?php echo e(asset('storage/' . $course->couples_Mimage)); ?>" width="100"
                                                class="mb-2">
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('courses.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Add Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Langer Title</label>
                        <input type="text" name="langer_Mtitle" class="form-control mb-2" placeholder="Title"
                            required>
                        <label>Langer Image</label>
                        <input type="file" name="langer_Mimage" class="form-control">
                    </div>
                    <div class="modal-body">
                        <label>Couples Title</label>
                        <input type="text" name="couples_Mtitle" class="form-control mb-2" placeholder="Title"
                            required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\app\resources\views\admin\courses.blade.php ENDPATH**/ ?>
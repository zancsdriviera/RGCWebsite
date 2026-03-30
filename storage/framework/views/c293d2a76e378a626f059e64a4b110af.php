

<?php $__env->startSection('title', 'Courses'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('css/courses.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">COURSES</h1>
    </div>

    <div class="container my-5 style='min-height: 100%;'">
        <div class="row">
            <!-- Card 1 -->
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6">
                    <div class="card pb-3 shadow-lg border-0 h-100 text-center d-flex flex-column align-items-center">
                        <?php if($course->langer_Mimage): ?>
                            <img src="<?php echo e(asset('storage/' . $course->langer_Mimage)); ?>" class="card-img-top"
                                alt="Course Image">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column align-items-center">
                            <h5 class="card-title"><?php echo e($course->langer_Mtitle); ?></h5>
                            <a href="<?php echo e(route('langer')); ?>" class="btn btn-success mt-auto custom-btn">Learn More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6">
                    <div class="card pb-3 shadow-lg border-0 h-100 text-center d-flex flex-column align-items-center">
                        <?php if($course->couples_Mimage): ?>
                            <img src="<?php echo e(asset('storage/' . $course->couples_Mimage)); ?>" class="card-img-top"
                                alt="Course Image">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column align-items-center">
                            <h5 class="card-title"><?php echo e($course->couples_Mtitle); ?></h5>
                            <a href="<?php echo e(route('couples')); ?>" class="btn btn-success mt-auto custom-btn">Learn More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/courses.blade.php ENDPATH**/ ?>
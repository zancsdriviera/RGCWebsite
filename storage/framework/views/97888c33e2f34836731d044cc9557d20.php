

<?php $__env->startSection('title', 'Courses - Couples'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/couples.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">COUPLES COURSE</h1>
    </div>

    <br>
    <div class="course-gallery">
        <h2 class="cg-title"><?php echo e($couples->couples_title ?? $couples->couples_Mtitle); ?></h2>
        <div class="cg-rule"></div>
        <p class="cg-desc"><?php echo e($couples->couples_description ?? ''); ?></p>

        <div class="cg-frame">
            <div class="cg-main-wrap position-relative">
                <button class="cg-side prev" aria-label="Previous">&#10094;</button>

                <!-- Main image container -->
                <div class="cg-main-container position-relative w-100">
                    <img class="cg-main w-100"
                        src="<?php echo e($couples->couples_images && count($couples->couples_images) > 0 ? asset('storage/' . $couples->couples_images[0]) : ($couples->couples_Mimage ? asset('storage/' . $couples->couples_Mimage) : asset('images/placeholder.png'))); ?>"
                        alt="Main hole image">

                    <!-- Hole Number Label -->
                    <span class="hole-number-label position-absolute">Hole 1</span>
                </div>

                <button class="cg-side next" aria-label="Next">&#10095;</button>
            </div>


            <div class="cg-thumbs-row">
                <div class="cg-thumbs">
                    <?php if($couples->couples_images && count($couples->couples_images) > 0): ?>
                        <?php $__currentLoopData = $couples->couples_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="thumb">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <img src="<?php echo e($couples->couples_Mimage ? asset('storage/' . $couples->couples_Mimage) : asset('images/placeholder.png')); ?>"
                            alt="thumb">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <br>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/couples.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'Courses - Langer'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('css/langer.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">LANGER COURSE</h1>
    </div>

    <br>
    <div class="course-gallery">
        <h2 class="cg-title"><?php echo e($langer->title); ?></h2>
        <div class="cg-rule"></div>
        <p class="cg-desc"><?php echo e($langer->description); ?></p>

        <div class="cg-frame">
            <div class="cg-main-wrap">
                <button class="cg-side prev" aria-label="Previous">&#10094;</button>
                <img class="cg-main"
                    src="<?php echo e($langer->image1 ? asset('storage/' . $langer->image1) : asset('images/placeholder.png')); ?>"
                    alt="Main hole image">
                <button class="cg-side next" aria-label="Next">&#10095;</button>
            </div>

            <div class="cg-thumbs-row">
                <div class="cg-thumbs">
                    <?php for($i = 1; $i <= 6; $i++): ?>
                        <?php $img = $langer->{'image'.$i}; ?>
                        <img src="<?php echo e($img ? asset('storage/' . $img) : asset('images/placeholder.png')); ?>" alt="thumb">
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <br>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/langer.blade.php ENDPATH**/ ?>
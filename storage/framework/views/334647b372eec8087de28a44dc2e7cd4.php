

<?php $__env->startSection('title', 'Facilities - Members Lounge'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/locker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES</h1>
    </div>

    <!-- HTML -->
    <?php
        $desc = \App\Models\MembersLoungeContent::whereNotNull('description')->first();
        $images = \App\Models\MembersLoungeContent::whereNotNull('image_path')->get();
    ?>

    <div class="container">
        <div class="info-box">
            <h1>MEMBER'S LOUNGE</h1>
            <hr class="dotted">
            <p class="desc"><?php echo e($desc->description ?? ''); ?></p>
            <div class="green-bar" aria-hidden="true"></div>
        </div>

        <div class="photo-grid">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="photo main">
                    <img src="<?php echo e($img->image_path); ?>" alt="Clubhouse Image">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- replace your old lightbox markup with this -->
    <div id="lightbox" class="lightbox" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="lightbox-inner" role="document">
            <button class="lightbox-close" aria-label="Close image">&times;</button>
            <img id="lightbox-img" class="lightbox-img" alt="">
        </div>
        <!-- arrows OUTSIDE inner -->
        <button class="lightbox-prev" aria-label="Previous image">&#10094;</button>
        <button class="lightbox-next" aria-label="Next image">&#10095;</button>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/membersLounge.blade.php ENDPATH**/ ?>
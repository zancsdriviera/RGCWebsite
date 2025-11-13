

<?php $__env->startSection('title', 'Facilities - Driving Range'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/drivingrange.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES</h1>
    </div>


    <div class="container">
        <!-- LEFT PANEL (replace rates part with this) -->
        <aside class="info-box driving-range">
            <h1>DRIVING RANGE</h1>
            <hr class="dotted">

            <p class="desc">
                Rain or shine, our covered driving range lets you practice your swing in comfort,
                offering the perfect space to sharpen your skills any day of the week.
            </p>

            <!-- RATES -->
            
            <div class="green-bar" aria-hidden="true"></div>
        </aside>


        <!-- keep your photo grid unchanged -->
        <div class="photo-grid">
            <div class="photo main"><img src="<?php echo e(asset('images/DrivingRange.jpg')); ?>" alt="Lobby"></div>
            <div class="photo main"><img src="<?php echo e(asset('images/LobbyImage.jpg')); ?>" alt="Lobby"></div>
            <div class="photo main"><img src="<?php echo e(asset('images/DrivingRange.jpg')); ?>" alt="Lobby"></div>
            <div class="photo main"><img src="<?php echo e(asset('images/DrivingRange.jpg')); ?>" alt="Lobby"></div>
            <div class="photo main"><img src="<?php echo e(asset('images/DrivingRange.jpg')); ?>" alt="Lobby"></div>
            <div class="photo main"><img src="<?php echo e(asset('images/DrivingRange.jpg')); ?>" alt="Lobby"></div>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/drivingrange.blade.php ENDPATH**/ ?>
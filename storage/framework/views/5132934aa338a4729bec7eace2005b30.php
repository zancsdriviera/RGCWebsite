

<?php $__env->startSection('title', 'Tournament Gallery'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/tournamentgal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">TOURNAMENT GALLERY</h1>
    </div>

    <section class="news-grid">
        <div class="grid" id="newsGrid">
            <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="news-card">
                    
                    <a class="card-link"
                        href="<?php echo e(route('event.gallery', [], false)); ?>?gallery=<?php echo e(urlencode($gallery->slug)); ?>&open=0"
                        aria-label="Open Tournament: <?php echo e($gallery->title); ?>">
                        <div class="media">
                            
                            <img src="<?php echo e($gallery->thumbnail_url ?? asset('images/COURSES/default-thumb.jpg')); ?>"
                                alt="<?php echo e($gallery->title); ?>">
                        </div>
                        <div class="content">
                            <h3 class="title"><?php echo e(strtoupper($gallery->title)); ?></h3>
                            <time class="date"><?php echo e(\Carbon\Carbon::parse($gallery->event_date)->format('F d, Y')); ?></time>
                        </div>
                    </a>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/tournamentgal.blade.php ENDPATH**/ ?>
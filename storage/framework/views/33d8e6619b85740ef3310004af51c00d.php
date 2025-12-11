

<?php $__env->startSection('title', 'Grill Room'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/grill.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-0">
        
        <div id="grillCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <?php $__empty_1 = true; $__currentLoopData = $carousel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="carousel-item <?php echo e($i === 0 ? 'active' : ''); ?>">
                        <img src="<?php echo e(asset('storage/' . $img)); ?>" class="d-block w-100" alt="Slide <?php echo e($i + 1); ?>">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="carousel-item active">
                        <img src="<?php echo e(asset('images/COURSES/default-thumb.jpg')); ?>" class="d-block w-100" alt="No images">
                    </div>
                <?php endif; ?>
            </div>
            <?php if(count($carousel) > 1): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#grillCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#grillCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            <?php endif; ?>
        </div>

        
        <section class="menu-section py-5">
            <div class="container">
                <!-- header with horizontal rules -->
                <div class="menu-header d-flex align-items-center justify-content-center mb-4">
                    <div class="header-line"></div>
                    <h2 class="mx-3">MENU</h2>
                    <div class="header-line"></div>
                </div>

                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-12 col-sm-6 col-md-4">
                            <figure class="menu-card text-center">
                                <div class="menu-img-wrap mx-auto" style="width:220px;height:160px;overflow:hidden;">
                                    <?php if(!empty($item['image'])): ?>
                                        <img src="<?php echo e(asset('storage/' . $item['image'])); ?>" alt="<?php echo e($item['name']); ?>"
                                            class="menu-img" style="width:100%;height:100%;object-fit:cover;">
                                    <?php else: ?>
                                        <div
                                            style="width:100%;height:100%;background:#f2f2f2;display:flex;align-items:center;justify-content:center;">
                                            <small>No image</small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <figcaption class="mt-3">
                                    <h3 class="menu-title"><?php echo e($item['name'] ?? 'Unnamed'); ?></h3>
                                    <div class="menu-price"><?php echo e($item['price'] ?? ''); ?></div>
                                </figcaption>
                            </figure>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center text-muted">No menu items found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/grill.blade.php ENDPATH**/ ?>
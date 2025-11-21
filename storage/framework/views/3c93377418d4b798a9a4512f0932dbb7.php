    

    <?php $__env->startSection('title', "FAQ's"); ?>

    <?php $__env->startPush('styles'); ?>
        <link href="<?php echo e(asset('css/faq.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
    <?php $__env->stopPush(); ?>

    <?php $__env->startSection('content'); ?>
        <div class="container-fluid custom-bg d-flex align-items-center p-0">
            <h1 class="text-white custom-title m-0">FAQ</h1>
        </div>

        <div class="top_caption my-0 text-center">
            <h2 class="top-title">SHARE YOUR EXPERIENCE WITH US!</h2>
            <h3 class="scan_here">Scan the QR codes below</h3>
        </div>

        <div class="container my-5 text-center">
            <div class="row g-4 justify-content-center">
                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                        <div class="card shadow h-100">
                            <?php if($faq->faq_image): ?>
                                <img src="<?php echo e(asset('images/FAQ/' . $faq->faq_image)); ?>" class="card-img-top"
                                    alt="<?php echo e($faq->faq_title); ?>" style="height: 300px;">
                            <?php endif; ?>
                            <div class="card-body text-center">
                                <?php if($faq->faq_icon_class): ?>
                                    <i class="<?php echo e($faq->faq_icon_class); ?> fs-1 custom_icon"></i>
                                <?php endif; ?>
                                <h5 class="mt-3 fw-bold custom_text" style="text-transform: uppercase;">
                                    <?php echo e($faq->faq_title); ?>

                                </h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/faq.blade.php ENDPATH**/ ?>
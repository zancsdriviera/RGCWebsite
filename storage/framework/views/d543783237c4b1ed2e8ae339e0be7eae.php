

<?php $__env->startSection('title', 'Corporate Governance'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/corpgovernance.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CORPORATE GOVERNANCE</h1>
    </div>


    <div class="green-bar"></div>
    <!-- Group 1 -->
    <div class="py-5" style="background-color: #f8f9f4;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <a href="<?php echo e(route('definitive.frontend')); ?>" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">DEFINITIVE INFORMATION STATEMENT</h5>
                        </div>
                        <img src="<?php echo e(asset('images/SPAM/img1.png')); ?>" class="card-img-bottom" alt="Office Image">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo e(route('asm_minutes.frontend')); ?>" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">ASM MINUTES</h5>
                        </div>
                        <img src="<?php echo e(asset('images/SPAM/img2.png')); ?>" class="card-img-bottom" alt="Skyscraper Image">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo e(route('acgr.frontend')); ?>" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">ACGR</h5>
                        </div>
                        <img src="<?php echo e(asset('images/SPAM/img3.png')); ?>" class="card-img-bottom" alt="Office Desk Image">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Group 2 -->
    <div class="py-5" style="background-color: #9EBDB5;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <a href="<?php echo e(route('cbce')); ?>" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">CODE OF BUSINESS CONDUCT AND ETHICS</h5>
                        </div>
                        <img src="<?php echo e(asset('images/SPAM/img5.png')); ?>" class="card-img-bottom" alt="Office Image">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo e(route('boardCharter')); ?>" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">BOARD CHARTER</h5>
                        </div>
                        <img src="<?php echo e(asset('images/SPAM/img4.png')); ?>" class="card-img-bottom" alt="Meeting Room Image">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo e(route('corpGovManual')); ?>" class="card h-100 border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success fw-bold">MANUAL ON CORPORATE GOVERNANCE</h5>
                        </div>
                        <img src="<?php echo e(asset('images/SPAM/img4.png')); ?>" class="card-img-bottom" alt="Meeting Room Image">
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/corpgovernance.blade.php ENDPATH**/ ?>
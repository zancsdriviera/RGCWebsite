

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
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="<?php echo e(asset('images/DefinitiveCard.png')); ?>" class="img-fluid"
                                alt="Definitive Card Image">
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo e(route('asm_minutes.frontend')); ?>" class="card h-100 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="<?php echo e(asset('images/MinutesCard.png')); ?>" class="img-fluid" alt="Minutes Card Image">
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo e(route('acgr.frontend')); ?>" class="card h-100 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="<?php echo e(asset('images/AnnualCard.png')); ?>" class="img-fluid" alt="Annual Card Image">
                        </div>
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
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="<?php echo e(asset('images/CodeCard.png')); ?>" class="img-fluid"
                                alt="Code of Business Conduct and Ethics Card Image">
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo e(route('boardCharter')); ?>" class="card h-100 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="<?php echo e(asset('images/BoardCard.png')); ?>" class="img-fluid"
                                alt="Board Charter Card Image">
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo e(route('corpGovManual')); ?>" class="card h-100 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title text-success fw-bold"></h5>
                            <img src="<?php echo e(asset('images/ManualCard.png')); ?>" class="img-fluid"
                                alt="Manual on Corporate Governance Image">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/corpgovernance.blade.php ENDPATH**/ ?>
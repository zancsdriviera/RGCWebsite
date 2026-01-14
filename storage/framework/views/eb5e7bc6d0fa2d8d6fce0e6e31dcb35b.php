

<?php $__env->startSection('title', 'Facilities - Teehouse'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/teehouse.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES</h1>
    </div>

    <div class="div1">
        <div class="container-fluid px-0">

            <div class="div1-header d-flex align-items-center justify-content-center mb-4">
                <div class="header-line"></div>
                <h2 class="topCaption mx-3">TEEHOUSE</h2>
                <div class="header-line"></div>
            </div>

            <div class="row gx-2">
                
                <div class="col-12 col-sm-6">
                    <div class="row gx-0">
                        <div class="col-12">
                            <div class="box white" style="padding:20px;">
                                <h4 style="color: #107039; font-weight: bold;">LANGER FRONT 9</h4>
                                <hr class="dotted-line">
                                <span style="font-weight: 500;">LF9</span>
                            </div>
                        </div>
                        <?php $__currentLoopData = $lf9; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-12 col-sm-6">
                                <div class="box">
                                    <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="LF9">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <div class="col-12 col-sm-6">
                    <div class="row gx-0">
                        <div class="col-12">
                            <div class="box white" style="padding:20px;">
                                <h4 style="color: #107039; font-weight: bold;">HALFWAY LANGER</h4>
                                <hr class="dotted-line">
                                <span style="font-weight: 500;">HWL</span>
                            </div>
                        </div>
                        <?php $__currentLoopData = $hwl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-12 col-sm-6">
                                <div class="box">
                                    <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="HWL">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <br>

            <div class="row gx-2">
                
                <div class="col-12 col-sm-6">
                    <div class="row gx-0">
                        <div class="col-12">
                            <div class="box white" style="padding:20px;">
                                <h4 style="color: #107039; font-weight: bold;">COUPLES FRONT 9</h4>
                                <hr class="dotted-line">
                                <span style="font-weight: 500;">CF9</span>
                            </div>
                        </div>
                        <?php $__currentLoopData = $cf9; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-12 col-sm-6">
                                <div class="box">
                                    <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="CF9">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <div class="col-12 col-sm-6">
                    <div class="row gx-0">
                        <div class="col-12">
                            <div class="box white" style="padding:20px;">
                                <h4 style="color: #107039; font-weight: bold;">HALFWAY COUPLES</h4>
                                <hr class="dotted-line">
                                <span style="font-weight: 500;">HWC</span>
                            </div>
                        </div>
                        <?php $__currentLoopData = $hwc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-12 col-sm-6">
                                <div class="box">
                                    <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="HWC">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/teehouse.blade.php ENDPATH**/ ?>
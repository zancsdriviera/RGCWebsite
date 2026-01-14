

<?php $__env->startSection('title', 'Rates - Peak Season'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('css/rates.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">RATES</h1>
    </div>

    <section class="rates-section my-5">
        <div class="container">
            <!-- First Content -->
            <div class="text-center mb-4">
                <h3 class="rates-title">RIVIERA GOLF CLUB INC.</h3>
                <h2 class="rates-heading">GOLF RATES</h2>
                <p class="rates-sub">PEAK SEASON (NOVEMBER - MARCH 2025)</p>
            </div>

            <div class="row gx-4 justify-content-center">
                <?php $__currentLoopData = $firstGpeaks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gpeak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-md-6 col-lg-5 mb-4">
                        <article class="rate-card">
                            <div class="rate-badge" style="text-transform: uppercase;"><strong><?php echo e($gpeak->title1); ?></strong>
                            </div>
                            <div class="price-bar">
                                <div class="price">₱<?php echo e(number_format($gpeak->total1, 2)); ?></div>
                            </div>
                            <div class="rate-body">
                                <ul class="mb-2" style="padding-left: 0px; list-style-type: disc;">
                                    <?php
                                        $bodies = preg_split('/\r\n|\r|\n/', $gpeak->body1 ?? '');
                                        $prices = preg_split('/\r\n|\r|\n/', $gpeak->price1 ?? '');
                                    ?>
                                    <?php $__currentLoopData = $bodies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $body): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(trim($body) != ''): ?>
                                            <li style="display:flex; justify-content:space-between; align-items:center;">
                                                <span><?php echo e(trim($body)); ?></span>
                                                <span>₱<?php echo e(number_format((float) ($prices[$index] ?? 0), 2)); ?></span>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <div class="rate-cta">
                                    <button class="btn-ghost"
                                        style="text-transform: uppercase;"><?php echo e($gpeak->sched1); ?></button>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Second Content -->
            <div class="container mt-5">
                <div class="text-center mb-4">
                    <h3 class="rates-title">SENIOR DISCOUNT</h3>
                    <p class="rates-sub1">50% SENIOR DISCOUNT ON GREEN FEES APPLICABLE ON WEEKDAYS ONLY FOR GUESTS WITH
                        SENIOR CARE ID/FPASGI ACCOMPANIED BY MEMBER ONLY.</p>
                </div>
                <br>

                <div class="row gx-4 justify-content-center">
                    <?php $__currentLoopData = $secondGpeaks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gpeak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-md-6 col-lg-5 mb-5">
                            <article class="rate-card">
                                <div class="rate-badge2"><?php echo e($gpeak->title2); ?><br><?php echo e($gpeak->paragraph2); ?></div>
                                <div class="price-bar">
                                    <div class="price">₱ <?php echo e(number_format($gpeak->total2, 2)); ?></div>
                                </div>
                                <div class="rate-body">
                                    <ul class="mb-2" style="padding-left: 0px; list-style-type: disc;">
                                        <?php
                                            $bodies = preg_split('/\r\n|\r|\n/', $gpeak->body2 ?? '');
                                            $prices = preg_split('/\r\n|\r|\n/', $gpeak->price2 ?? '');
                                        ?>
                                        <?php $__currentLoopData = $bodies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $body): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(trim($body) != ''): ?>
                                                <li
                                                    style="display:flex; justify-content:space-between; align-items:center;">
                                                    <span><?php echo e(trim($body)); ?></span>
                                                    <span>₱<?php echo e(number_format((float) ($prices[$index] ?? 0), 2)); ?></span>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <div class="rate-cta">
                                        <button class="btn-ghost"><?php echo e($gpeak->sched2); ?></button>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Third Content -->
            <div class="container mt-5">
                <div class="row gx-4 justify-content-center">
                    <?php $__currentLoopData = $thirdGpeaks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gpeak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-md-6 col-lg-5 mb-5">
                            <article class="rate-card" style="max-height: 0%;">
                                <div class="rate-badge2" style="text-transform: uppercase;"><?php echo e($gpeak->title3); ?></div>
                                <br>
                                <div class="rate-body">
                                    <ul class="mb-2" style="padding-left: 0px; list-style-type: disc;">
                                        <?php
                                            $bodies = preg_split('/\r\n|\r|\n/', $gpeak->body3 ?? '');
                                            $prices = preg_split('/\r\n|\r|\n/', $gpeak->price3 ?? '');
                                        ?>
                                        <?php $__currentLoopData = $bodies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $body): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(trim($body) != ''): ?>
                                                <li
                                                    style="display:flex; justify-content:space-between; align-items:center;">
                                                    <span><?php echo e(trim($body)); ?></span>
                                                    <span>₱<?php echo e(number_format((float) ($prices[$index] ?? 0), 2)); ?></span>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <p class="rate-sub" style="text-transform: uppercase; text-align: center;">
                                        <?php echo e($gpeak->paragraph3); ?></p>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/rates2.blade.php ENDPATH**/ ?>
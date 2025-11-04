

<?php $__env->startSection('title', 'Membership'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/membership.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">MEMBERSHIP</h1>
    </div>

    <!-- Top caption -->
    <div class="top_caption my-0 text-center">
        <h2 class="top-title">CLICK TO DOWNLOAD THE PDF</h2>
    </div>

    <!-- Downloads section -->
    <div class="bullet_container my-4">
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-5">
            <?php
                $downloads = \App\Models\MembershipContent::where('type', 'download')->get();
                $chunkedDownloads = $downloads->chunk(ceil($downloads->count() / 2));
            ?>

            <?php $__currentLoopData = $chunkedDownloads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul class="list-unstyled text-start m-0">
                    <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <i class="bi bi-download me-2"></i>
                            <a href="<?php echo e(asset('storage/' . $item->file_path)); ?>" target="_blank">
                                <?php echo e($item->title); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center gx-2">
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <h2 class="bot-title">MEMBERSHIP APPLICANTS</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="carousel-wrapper">
        <div class="carousel-container">
            <button class="carousel-btn prev" aria-label="Previous">&#10094;</button>
            <div class="carousel-viewport">
                <div class="carousel-track">
                    <?php
                        $membersDataCards = \App\Models\MembershipContent::where('type', 'members_data')->get();
                    ?>

                    <?php $__currentLoopData = $membersDataCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="members-page">
                            <div class="app-card text-center">
                                <img src="<?php echo e(asset('storage/' . $card->file_path)); ?>" alt="Member" class="img-fluid">
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
            <button class="carousel-btn next" aria-label="Next">&#10095;</button>
        </div>
    </div>



    <!-- Banks / QR Codes -->
    <div class="container-fluid my-0 banks_container">
        <div class="row justify-content-center text-center gx-2">
            <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                    <div class="bank-column w-100">
                        <?php if($bank->top_image): ?>
                            <img src="<?php echo e(asset('storage/' . $bank->top_image)); ?>"
                                alt="<?php echo e($bank->title ?? 'Bank Top Image'); ?>" class="card-img custom-card-img-top mb-3">
                        <?php endif; ?>

                        <p class="mb-3 bank-title <?php echo e(strtolower(str_replace(' ', '-', $bank->title ?? 'bank'))); ?>">
                            <?php echo e($bank->title ?? 'PAY BILLS PROCEDURE'); ?>

                        </p>

                        <?php if($bank->qr_image): ?>
                            <img src="<?php echo e(asset('storage/' . $bank->qr_image)); ?>" alt="<?php echo e($bank->title ?? 'Bank QR'); ?>"
                                class="card-img custom-card-img">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/membership.blade.php ENDPATH**/ ?>
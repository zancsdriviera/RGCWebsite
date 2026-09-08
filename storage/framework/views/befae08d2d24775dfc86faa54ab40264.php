

<?php $__env->startSection('title', 'Contact Us'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/contact_us.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php
        // Fallbacks: if controller didn't pass variables, load them here so the view never errors.
$mainInfo = $mainInfo ?? \App\Models\ContactUs::where('type', 'main')->first();
$departments = $departments ?? \App\Models\ContactUs::where('type', 'department')->orderBy('id')->get();
    ?>

    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CONTACT US</h1>
    </div>

    <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center gx-2">
            <!-- Column 1 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <img src="<?php echo e(asset('images/CONTACT_US/location.png')); ?>" alt="Bottom Image 1"
                        class="card-img custom-card-img">
                    <p class="contacts-title">ADDRESS</p>
                    <p class="contact-describe">
                        <?php echo e(optional($mainInfo)->address ?? 'Address not available yet.'); ?>

                    </p>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <img src="<?php echo e(asset('images/CONTACT_US/phone.png')); ?>" alt="Bottom Image 2"
                        class="card-img custom-card-img">
                    <p class="contacts-title">CONTACT NUMBER</p>
                    <p class="phoneNumber">
                        <?php echo e(optional($mainInfo)->main_phone ?? '(No contact number yet)'); ?>

                    </p>

                </div>
            </div>
        </div>
    </div>

    <div class="top_caption my-0 text-center">
        <h2 class="top-title">OTHER CONTACT DETAILS</h2>
    </div>

    <div class="container my-4">
        <?php if($departments->isEmpty()): ?>
            <div class="text-center text-muted py-4">
                <p>No department contact details available yet.</p>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-md-6 mb-4">
                        <div class="contact-card shadow-sm">
                            <div class="card-header text-center text-uppercase">
                                <?php echo e($department->department_name ?? ($department->title ?? 'Department')); ?>

                            </div>
                            <div class="card-body">
                                <p class="d-flex align-items-center mb-2">
                                    <span class="icon-circle me-2">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <span><?php echo e($department->phone ?? '(No phone yet)'); ?></span>
                                </p>
                                <p class="d-flex align-items-center mb-0">
                                    <span class="icon-circle me-2">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <span><?php echo e($department->email ?? '(No email yet)'); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="map-container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3867.3227935694363!2d120.95206706259182!3d14.234382647037595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sRiviera%20Golf%20Club!5e0!3m2!1sen!2sph!4v1756190894108!5m2!1sen!2sph"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/contact_us.blade.php ENDPATH**/ ?>
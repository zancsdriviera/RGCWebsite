

<?php $__env->startSection('title', 'Courses Schedule'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/coursesched.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">COURSE SCHEDULE</h1>
    </div>

    <!-- Calendar Container -->
    <div class="container my-5">
        <h3 class="mb-3">Event Calendar</h3>
        <div class="calendar-grid" id="calendarHeader"></div>
        <div class="calendar-grid" id="eventCalendar"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <h4 id="eventDate" class="text-center"></h4>
                <div id="eventDetails"></div>
            </div>
        </div>
    </div>
    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('js/announcement.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/coursesched.blade.php ENDPATH**/ ?>
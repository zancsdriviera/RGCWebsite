

<?php $__env->startSection('title', 'Hole-In-One'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/holeinone.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">HOLE-IN-ONE</h1>
    </div>

    <?php
        use Illuminate\Support\Facades\DB;
        $couples = DB::table('hole_in_one_contents')->where('type', 'couples')->orderBy('date', 'desc')->get();
        $langer = DB::table('hole_in_one_contents')->where('type', 'langer')->orderBy('date', 'desc')->get();
    ?>

    <div class="container my-5">
        <div class="row g-4">

            <!-- Couples Table -->
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center fw-bold fs-5">
                        <i class="bi bi-flag-fill me-2"></i> Couples
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle text-center sortable-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>First Name <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Last Name <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Hole # <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Date <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $couples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td data-label="First Name"><?php echo e($player->first_name); ?></td>
                                            <td data-label="Last Name"><?php echo e($player->last_name); ?></td>
                                            <td data-label="Hole #"><?php echo e($player->hole_number); ?></td>
                                            <td data-label="Date"><?php echo e($player->date); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Langer Table -->
            <div class="col-md-6">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white text-center fw-bold fs-5">
                        <i class="bi bi-flag-fill me-2"></i> Langer
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle text-center sortable-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>First Name <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Last Name <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Hole # <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                        <th>Date <i class="bi bi-arrow-down-up sort-icon"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $langer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td data-label="First Name"><?php echo e($player->first_name); ?></td>
                                            <td data-label="Last Name"><?php echo e($player->last_name); ?></td>
                                            <td data-label="Hole #"><?php echo e($player->hole_number); ?></td>
                                            <td data-label="Date"><?php echo e($player->date); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/holeinone.blade.php ENDPATH**/ ?>
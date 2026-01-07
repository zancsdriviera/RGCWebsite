

<?php $__env->startSection('title', 'Minutes of the Annual Stock Holding Meeting'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/repetitiveDocs.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CORPORATE GOVERNANCE</h1>
    </div>

    <!-- Background wrapper only outside container -->
    <div class="custom-bg-wrapper py-5">
        <div class="container">
            <h2 class="custom-label text-center">MINUTES OF THE ANNUAL STOCK HOLDING MEETING</h2>

            <div class="d-flex justify-content-center">
                <div class="year-container shadow bg-white rounded p-3">
                    <div class="table-wrapper">
                        <table class="table table-bordered table-hover text-center mb-0 align-middle">
                            <thead class="table-header">
                                <tr>
                                    <th scope="col">📄 Meeting Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(asset('storage/' . $doc->file_path)); ?>" target="_blank"
                                                class="year-link">
                                                <?php echo e($doc->formatted_date); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($documents->isEmpty()): ?>
                                    <tr>
                                        <td class="text-muted">No available documents.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/asm_minutes.blade.php ENDPATH**/ ?>
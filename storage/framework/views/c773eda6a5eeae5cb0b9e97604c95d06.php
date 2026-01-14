

<?php $__env->startSection('title', 'Tournament & Events'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/tourna_and_events.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <main class="m_body"> 
        <div class="container-fluid p-0">
            
            <?php if($mainEvent): ?>
                <div class="header-title marquee">
                    <span>UPCOMING EVENT <?php echo e($mainEvent->title ?? ''); ?> |
                        <?php echo e($mainEvent->event_date ? \Carbon\Carbon::parse($mainEvent->event_date)->format('F d, Y') : ''); ?></span>
                </div>

                <div class="position-relative">
                    <img src="<?php echo e(asset('storage/' . $mainEvent->main_image)); ?>" class="main-image">
                    <button
                        class="btn border border-white btn-dark position-absolute bottom-0 start-50 translate-middle-x mb-3 view-details-btn"
                        data-bs-toggle="modal" data-bs-target="#mainModal">
                        View Details
                    </button>
                </div>

                
                <div class="modal fade" id="mainModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header main-modal-header" style="background-color: #5E6D48;">
                                <h5 class="modal-title fw-bold text-white"><?php echo e(strtoupper($mainEvent->title)); ?> - TOURNAMENT
                                    DETAILS</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body main-modal-body">
                                <?php if($mainEvent->secondary_image): ?>
                                    <div class="text-center mb-3">
                                        <img src="<?php echo e(asset('storage/' . $mainEvent->secondary_image)); ?>"
                                            class="secondary-image" style=" border:4px solid #333333;">
                                        <h4 class="scan-qr-title" style="font-weight:bold; margin-top:10px;">SCAN QR TO
                                            REGISTER
                                        </h4>
                                    </div>
                                <?php endif; ?>
                                <hr class="dotted-divider">

                                <?php
                                    $rows = is_array(json_decode($mainEvent->subtitles_texts, true))
                                        ? json_decode($mainEvent->subtitles_texts, true)
                                        : [];
                                ?>
                                <?php $__currentLoopData = array_chunk($rows, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row mb-2 mx-0">
                                        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6 mb-2 px-1">
                                                <div class="text-block">
                                                    <div class="subtitle"><?php echo e($item['subtitle']); ?></div>
                                                    <div class="text-content"><?php echo e($item['text']); ?></div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="row mb-1">
                                    <div class="col-md-6 ml-10" style="font-weight:bold; font-size: 20px;">Click here to
                                        view
                                    </div>
                                </div>
                                <?php if($mainEvent->file1): ?>
                                    <div class="row mb-1">
                                        <div class="col-md-6 ml-10">
                                            <a href="<?php echo e(asset('storage/' . $mainEvent->file1)); ?>" target="_blank"
                                                class="text-success file-link" style="text-decoration:none;"><i
                                                    class="bi bi-eye"></i> Terms of Competition</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($mainEvent->file2): ?>
                                    <div class="row mb-1">
                                        <div class="col-md-6 ml-10">
                                            <a href="<?php echo e(asset('storage/' . $mainEvent->file2)); ?>" target="_blank"
                                                class="text-success file-link" style="text-decoration:none;"><i
                                                    class="bi bi-eye"></i> Club Advisory</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="header-title none">UPCOMING EVENT NONE</div>
            <?php endif; ?>

            
            <?php if($previousEvents && $previousEvents->count() > 0): ?>
                <h3 class="prev-title">Previous Tournament</h3>
                <div class="row mt-3 px-2 mx-0">
                    <?php $__currentLoopData = $previousEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 mb-3 px-1">
                            <div class="prev-box" data-bs-toggle="modal" data-bs-target="#prevModal<?php echo e($event->id); ?>">
                                <img src="<?php echo e(asset('storage/' . $event->main_image)); ?>" class="image-thumb">
                                <div class="prev-box-txt p-3">
                                    <h5 class="mt-2 fw-bold"><?php echo e($event->title); ?></h5>
                                    <?php if($event->paragraph): ?>
                                        <p><?php echo e($event->paragraph); ?></p>
                                    <?php endif; ?>
                                    <small><?php echo e(\Carbon\Carbon::parse($event->event_date)->format('F d, Y')); ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="prevModal<?php echo e($event->id); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body text-center fw-bold p-5">
                                        <h4 class="fw-bold"><?php echo e(strtoupper($event->title)); ?> END</h4>
                                        <button type="button" class="btn btn-success"
                                            data-bs-dismiss="modal">CLOSE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if($previousEvents->hasPages()): ?>
                    <div class="d-flex justify-content-center mt-4">
                        <ul class="pagination mb-4">
                            <?php if($previousEvents->onFirstPage()): ?>
                                <li class="page-item disabled"><span class="page-link">&lt;</span></li>
                            <?php else: ?>
                                <li class="page-item"><a class="page-link"
                                        href="<?php echo e($previousEvents->previousPageUrl()); ?>">&lt;</a></li>
                            <?php endif; ?>
                            <?php if($previousEvents->hasMorePages()): ?>
                                <li class="page-item"><a class="page-link"
                                        href="<?php echo e($previousEvents->nextPageUrl()); ?>">&gt;</a>
                                </li>
                            <?php else: ?>
                                <li class="page-item disabled"><span class="page-link">&gt;</span></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endif; ?> 
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/tourna_and_events.blade.php ENDPATH**/ ?>
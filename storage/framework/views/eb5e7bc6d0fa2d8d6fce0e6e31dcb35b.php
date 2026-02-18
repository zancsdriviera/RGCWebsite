

<?php $__env->startSection('title', 'Facilities - Teehouse'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/Teehouse.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES</h1>
    </div>

    <br>
    <div class="container-fluid my-0 hr_container">
        <div class="row justify-content-center text-center gx-2">
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="hr_column w-100">
                    <h2 class="bot-title"> TEEPAVILION </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="div1">
        <div class="container-fluid px-0">
            
            <?php if(count($teepav ?? []) > 0): ?>
                <div class="wrapper">

                    <div class="wrapper_teepav">
                        <div class="gallery">
                            
                            <div class="gallery-left big-image">
                                <div class="img-box" onclick="openTeehouseModal(0, 'teepav')">
                                    <img src="<?php echo e(asset('storage/' . $teepav[0])); ?>" alt="TEEPAV">
                                </div>
                            </div>

                            
                            <div class="gallery-right">
                                <?php $__currentLoopData = $teepav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($index > 0): ?>
                                        <div class="img-box" onclick="openTeehouseModal(<?php echo e($index); ?>, 'teepav')">
                                            <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="TEEPAV">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="container-fluid my-0 hr_container">
                <div class="row justify-content-center text-center gx-2">
                    <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                        <div class="hr_column w-100">
                            <h2 class="bot-title"> TEEHOUSE </h2>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            
            <?php if(count($lf9) > 0): ?>
                <div class="wrapper">
                    <div class="section-title section-title-left">
                        <h2>LANGER FRONT 9</h2>
                    </div>
                    <div class="wrapper_lf9">

                        <div class="gallery">
                            <div class="gallery-left big-image">
                                <div class="img-box" onclick="openTeehouseModal(0, 'lf9')">
                                    <img src="<?php echo e(asset('storage/' . $lf9[0])); ?>" alt="LF9">
                                </div>
                            </div>
                            <div class="gallery-right">
                                <?php $__currentLoopData = $lf9; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($index > 0): ?>
                                        <div class="img-box" onclick="openTeehouseModal(<?php echo e($index); ?>, 'lf9')">
                                            <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="LF9">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            <?php endif; ?>

            
            <?php if(count($hwl) > 0): ?>
                <div class="wrapper wrapper-green">
                    <div class="section-title section-title-right">
                        <h2>HALF WAY LANGER</h2>
                    </div>

                    <div class="wrapper_hwl">

                        <div class="gallery">

                            <div class="gallery-right">
                                <?php $__currentLoopData = $hwl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($index > 0): ?>
                                        <div class="img-box" onclick="openTeehouseModal(<?php echo e($index); ?>, 'hwl')">
                                            <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="HWL">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="gallery-left big-image">
                                <div class="img-box" onclick="openTeehouseModal(0, 'hwl')">
                                    <img src="<?php echo e(asset('storage/' . $hwl[0])); ?>" alt="HWL">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
            <?php endif; ?>

            
            <?php if(count($cf9) > 0): ?>
                <div class="wrapper">
                    <div class="section-title section-title-left">
                        <h2>COUPLES FRONT 9</h2>
                    </div>
                    <div class="wrapper_cf9">
                        <div class="gallery">
                            <div class="gallery-left big-image">
                                <div class="img-box" onclick="openTeehouseModal(0, 'cf9')">
                                    <img src="<?php echo e(asset('storage/' . $cf9[0])); ?>" alt="CF9">
                                </div>
                            </div>
                            <div class="gallery-right">
                                <?php $__currentLoopData = $cf9; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($index > 0): ?>
                                        <div class="img-box" onclick="openTeehouseModal(<?php echo e($index); ?>, 'cf9')">
                                            <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="CF9">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            <?php endif; ?>

            
            <?php if(count($hwc) > 0): ?>
                <div class="wrapper wrapper-green">
                    <div class="section-title section-title-right">
                        <h2>HALF WAY COUPLES</h2>
                    </div>

                    <div class="wrapper_hwc">

                        <div class="gallery">

                            <div class="gallery-right">
                                <?php $__currentLoopData = $hwc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($index > 0): ?>
                                        <div class="img-box" onclick="openTeehouseModal(<?php echo e($index); ?>, 'hwc')">
                                            <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="HWC">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="gallery-left big-image">
                                <div class="img-box" onclick="openTeehouseModal(0, 'hwc')">
                                    <img src="<?php echo e(asset('storage/' . $hwc[0])); ?>" alt="HWC">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
            <?php endif; ?>

        </div>
    </div>

    
    <div class="modal fade" id="teehouseModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 bg-transparent p-0">
                <div class="modal-body d-flex flex-column align-items-center p-0">
                    <div class="position-relative modal-img-wrapper">
                        <button type="button" class="modal-btn-close" data-bs-dismiss="modal">&times;</button>
                        <img id="teehouseModalImage" src="" alt="Teehouse" class="modal-img">
                        <button class="modal-btn modal-btn-prev" onclick="prevTeehouseImage()">&lt;</button>
                        <button class="modal-btn modal-btn-next" onclick="nextTeehouseImage()">&gt;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        let teehouseImages = {
            teepav: <?php echo json_encode($teepav ?? [], 15, 512) ?>,
            lf9: <?php echo json_encode($lf9 ?? [], 15, 512) ?>,
            hwl: <?php echo json_encode($hwl ?? [], 15, 512) ?>,
            cf9: <?php echo json_encode($cf9 ?? [], 15, 512) ?>,
            hwc: <?php echo json_encode($hwc ?? [], 15, 512) ?>
        };

        let currentGallery = '';
        let currentIndex = 0;

        function openTeehouseModal(index, galleryKey) {
            currentGallery = galleryKey;
            currentIndex = index;
            updateTeehouseImage();
            const modal = new bootstrap.Modal(document.getElementById('teehouseModal'));
            modal.show();
        }

        function updateTeehouseImage() {
            const images = teehouseImages[currentGallery];
            if (!images || images.length === 0) return;
            document.getElementById('teehouseModalImage').src =
                "<?php echo e(asset('storage')); ?>/" + images[currentIndex];
        }

        function prevTeehouseImage() {
            const images = teehouseImages[currentGallery];
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateTeehouseImage();
        }

        function nextTeehouseImage() {
            const images = teehouseImages[currentGallery];
            currentIndex = (currentIndex + 1) % images.length;
            updateTeehouseImage();
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/teehouse.blade.php ENDPATH**/ ?>
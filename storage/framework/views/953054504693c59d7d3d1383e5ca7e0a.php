

<?php $__env->startSection('title', 'Courses - Langer'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('css/langer.css')); ?>" rel="stylesheet">
    <style>
        .hole-number-label {
            bottom: 10px;
            left: 10px;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 3px 6px;
            border-radius: 4px;
            position: absolute;
            font-weight: bold;
        }

        .cg-thumbs img {
            cursor: pointer;
        }

        .cg-thumbs img.active-thumb {
            border: 2px solid #0d6efd;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">LANGER COURSE</h1>
    </div>

    <br>
    <div class="course-gallery">
        <h2 class="cg-title"><?php echo e($langer->langer_title ?? $langer->langer_Mtitle); ?></h2>
        <div class="cg-rule"></div>
        <p class="cg-desc"><?php echo e($langer->langer_description ?? ''); ?></p>

        <div class="cg-frame">
            <div class="cg-main-wrap position-relative">
                <button class="cg-side prev" aria-label="Previous" id="prevBtn">&#10094;</button>

                <div class="cg-main-container position-relative w-100">
                    <?php
                        $mainImage = $langer->langer_images[0] ?? [
                            'image' => $langer->langer_Mimage ?? asset('images/placeholder.png'),
                            'hole' => 1,
                        ];
                    ?>
                    <img id="mainImage" class="cg-main w-100" src="<?php echo e(asset('storage/' . $mainImage['image'])); ?>"
                        alt="Main hole image">
                    <span id="holeLabel" class="hole-number-label">Hole <?php echo e($mainImage['hole'] ?? 1); ?></span>
                </div>

                <button class="cg-side next" aria-label="Next" id="nextBtn">&#10095;</button>
            </div>

            <div class="cg-thumbs-row">
                <div class="cg-thumbs d-flex flex-wrap">
                    <?php $__currentLoopData = $langer->langer_images ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img class="thumb-img <?php echo e($index === 0 ? 'active-thumb' : ''); ?>"
                            src="<?php echo e(asset('storage/' . $img['image'])); ?>" data-hole="<?php echo e($img['hole'] ?? 1); ?>"
                            data-src="<?php echo e(asset('storage/' . $img['image'])); ?>" data-index="<?php echo e($index); ?>"
                            alt="thumb" width="80">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(empty($langer->langer_images) && $langer->langer_Mimage): ?>
                        <img class="thumb-img active-thumb" src="<?php echo e(asset('storage/' . $langer->langer_Mimage)); ?>"
                            data-hole="1" data-src="<?php echo e(asset('storage/' . $langer->langer_Mimage)); ?>" data-index="0"
                            alt="thumb" width="80">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <br>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            const mainImage = document.getElementById('mainImage');
            const holeLabel = document.getElementById('holeLabel');
            const thumbs = document.querySelectorAll('.cg-thumbs img');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            // Get current active image index
            function getCurrentIndex() {
                const activeThumb = document.querySelector('.thumb-img.active-thumb');
                return activeThumb ? parseInt(activeThumb.dataset.index) : 0;
            }

            // Update main image and hole number
            function updateMainImage(index) {
                if (index >= 0 && index < thumbs.length) {
                    const thumb = thumbs[index];
                    mainImage.src = thumb.dataset.src;
                    holeLabel.textContent = 'Hole ' + thumb.dataset.hole;

                    // Update active class
                    thumbs.forEach(t => t.classList.remove('active-thumb'));
                    thumb.classList.add('active-thumb');
                }
            }

            // Previous button click event
            prevBtn.addEventListener('click', () => {
                let currentIndex = getCurrentIndex();
                let newIndex = currentIndex - 1;

                // Loop to last if at first
                if (newIndex < 0) {
                    newIndex = thumbs.length - 1;
                }

                updateMainImage(newIndex);
            });

            // Next button click event
            nextBtn.addEventListener('click', () => {
                let currentIndex = getCurrentIndex();
                let newIndex = currentIndex + 1;

                // Loop to first if at last
                if (newIndex >= thumbs.length) {
                    newIndex = 0;
                }

                updateMainImage(newIndex);
            });

            // Thumbnail click event
            thumbs.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    const index = parseInt(thumb.dataset.index);
                    updateMainImage(index);
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/langer.blade.php ENDPATH**/ ?>
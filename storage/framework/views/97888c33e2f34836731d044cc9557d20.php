

<?php $__env->startSection('title', 'Courses - Couples'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/couples.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
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
        <h1 class="text-white custom-title m-0">COUPLES COURSE</h1>
    </div>

    <br>
    <div class="course-gallery">
        <h2 class="cg-title"><?php echo e($couples->couples_title ?? $couples->couples_Mtitle); ?></h2>
        <div class="cg-rule"></div>
        <p class="cg-desc"><?php echo e($couples->couples_description ?? ''); ?></p>

        <div class="cg-frame">
            <div class="cg-main-wrap position-relative">
                <button class="cg-side prev" aria-label="Previous">&#10094;</button>

                <div class="cg-main-container position-relative w-100">
                    <?php
                        $mainImage = $couples->couples_images[0] ?? [
                            'image' => $couples->couples_Mimage ?? asset('images/placeholder.png'),
                            'hole' => 1,
                        ];
                    ?>
                    <img id="mainImage" class="cg-main w-100" src="<?php echo e(asset('storage/' . $mainImage['image'])); ?>"
                        alt="Main hole image">
                    <span id="holeLabel" class="hole-number-label">Hole <?php echo e($mainImage['hole'] ?? 1); ?></span>
                </div>

                <button class="cg-side next" aria-label="Next">&#10095;</button>
            </div>

            <div class="cg-thumbs-row">
                <div class="cg-thumbs d-flex flex-wrap">
                    <?php $__currentLoopData = $couples->couples_images ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img class="thumb-img <?php echo e($index === 0 ? 'active-thumb' : ''); ?>"
                            src="<?php echo e(asset('storage/' . $img['image'])); ?>" data-hole="<?php echo e($img['hole'] ?? 1); ?>"
                            data-src="<?php echo e(asset('storage/' . $img['image'])); ?>" alt="thumb" width="80">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(empty($couples->couples_images) && $couples->couples_Mimage): ?>
                        <img class="thumb-img active-thumb" src="<?php echo e(asset('storage/' . $couples->couples_Mimage)); ?>"
                            data-hole="1" data-src="<?php echo e(asset('storage/' . $couples->couples_Mimage)); ?>" alt="thumb"
                            width="80">
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

            thumbs.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    mainImage.src = thumb.dataset.src;
                    holeLabel.textContent = 'Hole ' + thumb.dataset.hole;

                    thumbs.forEach(t => t.classList.remove('active-thumb'));
                    thumb.classList.add('active-thumb');
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/couples.blade.php ENDPATH**/ ?>
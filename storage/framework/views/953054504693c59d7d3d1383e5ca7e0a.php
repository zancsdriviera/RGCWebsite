

<?php $__env->startSection('title', 'Courses - Langer'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('css/langer.css')); ?>" rel="stylesheet">
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
                            'par' => 4,
                            'gold' => 0,
                            'blue' => 0,
                            'white' => 0,
                            'red' => 0,
                        ];
                    ?>
                    <img id="mainImage" class="cg-main w-100" src="<?php echo e(asset('storage/' . $mainImage['image'])); ?>"
                        alt="Main hole image">

                    <!-- Hole Details Overlay -->
                    <div class="hole-details-container" id="holeDetails">
                        <div class="hole-number" id="holeNumber">Hole <?php echo e($mainImage['hole'] ?? 1); ?></div>
                        <div class="par-info" id="parInfo">PAR <?php echo e($mainImage['par'] ?? 4); ?></div>
                        <div class="marker-row">
                            <span class="marker-bullet gold-bullet">●</span>
                            <span class="marker-distance" id="goldDistance"><?php echo e($mainImage['gold'] ?? 0); ?></span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet blue-bullet">●</span>
                            <span class="marker-distance" id="blueDistance"><?php echo e($mainImage['blue'] ?? 0); ?></span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet white-bullet">●</span>
                            <span class="marker-distance" id="whiteDistance"><?php echo e($mainImage['white'] ?? 0); ?></span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet red-bullet">●</span>
                            <span class="marker-distance" id="redDistance"><?php echo e($mainImage['red'] ?? 0); ?></span>
                        </div>
                    </div>
                </div>

                <button class="cg-side next" aria-label="Next" id="nextBtn">&#10095;</button>
            </div>

            
            <div class="cg-thumbs-row">
                <button class="cg-thumbs-nav prev-thumbs" aria-label="Previous thumbnails" id="prevThumbsBtn">‹</button>
                <div class="cg-thumbs" id="thumbnailsContainer">
                    <?php $__currentLoopData = $langer->langer_images ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img class="thumb-img <?php echo e($index === 0 ? 'active-thumb' : ''); ?>"
                            src="<?php echo e(asset('storage/' . $img['image'])); ?>" data-hole="<?php echo e($img['hole'] ?? 1); ?>"
                            data-par="<?php echo e($img['par'] ?? 4); ?>" data-gold="<?php echo e($img['gold'] ?? 0); ?>"
                            data-blue="<?php echo e($img['blue'] ?? 0); ?>" data-white="<?php echo e($img['white'] ?? 0); ?>"
                            data-red="<?php echo e($img['red'] ?? 0); ?>" data-src="<?php echo e(asset('storage/' . $img['image'])); ?>"
                            data-index="<?php echo e($index); ?>" alt="Thumbnail for hole <?php echo e($img['hole'] ?? 1); ?>"
                            width="80">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(empty($langer->langer_images) && $langer->langer_Mimage): ?>
                        <img class="thumb-img active-thumb" src="<?php echo e(asset('storage/' . $langer->langer_Mimage)); ?>"
                            data-hole="1" data-par="4" data-gold="0" data-blue="0" data-white="0" data-red="0"
                            data-src="<?php echo e(asset('storage/' . $langer->langer_Mimage)); ?>" data-index="0"
                            alt="Course thumbnail" width="80">
                    <?php endif; ?>
                </div>
                <button class="cg-thumbs-nav next-thumbs" aria-label="Next thumbnails" id="nextThumbsBtn">›</button>
            </div>
        </div>
        <br>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            const mainImage = document.getElementById('mainImage');
            const holeNumber = document.getElementById('holeNumber');
            const parInfo = document.getElementById('parInfo');
            const goldDistance = document.getElementById('goldDistance');
            const blueDistance = document.getElementById('blueDistance');
            const whiteDistance = document.getElementById('whiteDistance');
            const redDistance = document.getElementById('redDistance');
            const thumbs = document.querySelectorAll('.cg-thumbs img');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            // Get current active image index
            function getCurrentIndex() {
                const activeThumb = document.querySelector('.thumb-img.active-thumb');
                return activeThumb ? parseInt(activeThumb.dataset.index) : 0;
            }

            // Update main image and hole details
            function updateMainImage(index) {
                if (index >= 0 && index < thumbs.length) {
                    const thumb = thumbs[index];
                    mainImage.src = thumb.dataset.src;
                    holeNumber.textContent = 'Hole ' + thumb.dataset.hole;
                    parInfo.textContent = 'PAR ' + thumb.dataset.par;
                    goldDistance.textContent = thumb.dataset.gold;
                    blueDistance.textContent = thumb.dataset.blue;
                    whiteDistance.textContent = thumb.dataset.white;
                    redDistance.textContent = thumb.dataset.red;

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

            // Thumbnail navigation functionality
            const thumbnailsContainer = document.getElementById('thumbnailsContainer');
            const prevThumbsBtn = document.getElementById('prevThumbsBtn');
            const nextThumbsBtn = document.getElementById('nextThumbsBtn');
            const thumbScrollAmount = 200;

            // Function to update thumbnail navigation buttons visibility
            function updateThumbNavButtons() {
                const scrollLeft = thumbnailsContainer.scrollLeft;
                const maxScroll = thumbnailsContainer.scrollWidth - thumbnailsContainer.clientWidth;

                // Show/hide previous button
                if (scrollLeft <= 10) {
                    prevThumbsBtn.classList.add('disabled');
                } else {
                    prevThumbsBtn.classList.remove('disabled');
                }

                // Show/hide next button
                if (scrollLeft >= maxScroll - 10) {
                    nextThumbsBtn.classList.add('disabled');
                } else {
                    nextThumbsBtn.classList.remove('disabled');
                }
            }

            // Previous thumbnails button
            prevThumbsBtn.addEventListener('click', () => {
                if (!prevThumbsBtn.classList.contains('disabled')) {
                    thumbnailsContainer.scrollBy({
                        left: -thumbScrollAmount,
                        behavior: 'smooth'
                    });
                }
            });

            // Next thumbnails button
            nextThumbsBtn.addEventListener('click', () => {
                if (!nextThumbsBtn.classList.contains('disabled')) {
                    thumbnailsContainer.scrollBy({
                        left: thumbScrollAmount,
                        behavior: 'smooth'
                    });
                }
            });

            // Update main image and center the active thumbnail
            function updateMainImage(index) {
                if (index >= 0 && index < thumbs.length) {
                    const thumb = thumbs[index];
                    mainImage.src = thumb.dataset.src;
                    holeNumber.textContent = 'Hole ' + thumb.dataset.hole;
                    parInfo.textContent = 'PAR ' + thumb.dataset.par;
                    goldDistance.textContent = thumb.dataset.gold;
                    blueDistance.textContent = thumb.dataset.blue;
                    whiteDistance.textContent = thumb.dataset.white;
                    redDistance.textContent = thumb.dataset.red;

                    // Update active class
                    thumbs.forEach(t => t.classList.remove('active-thumb'));
                    thumb.classList.add('active-thumb');

                    // Scroll to center the active thumbnail
                    const container = thumbnailsContainer;
                    const thumbElement = thumb;
                    const containerWidth = container.clientWidth;
                    const thumbLeft = thumbElement.offsetLeft;
                    const thumbWidth = thumbElement.offsetWidth;

                    container.scrollTo({
                        left: thumbLeft - (containerWidth / 2) + (thumbWidth / 2),
                        behavior: 'smooth'
                    });
                }
            }

            // Update navigation buttons on scroll
            thumbnailsContainer.addEventListener('scroll', updateThumbNavButtons);

            // Initialize button states on page load
            window.addEventListener('load', updateThumbNavButtons);

            // Also call updateThumbNavButtons when window is resized
            window.addEventListener('resize', updateThumbNavButtons);
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/langer.blade.php ENDPATH**/ ?>
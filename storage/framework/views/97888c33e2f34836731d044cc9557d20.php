

<?php $__env->startSection('title', 'Courses - Couples'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/couples.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
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
                <button class="cg-side prev" aria-label="Previous" id="prevBtn">&#10094;</button>

                <div class="cg-main-container position-relative w-100">
                    <?php
                        $mainImage = $couples->couples_images[0] ?? [
                            'image' => $couples->couples_Mimage ?? asset('images/placeholder.png'),
                            'hole' => 1,
                            'par' => 4,
                            'gold' => 0,
                            'blue' => 0,
                            'white' => 0,
                            'silver' => 0,
                            'red' => 0,
                            'men_handicap' => 0,
                            'ladies_handicap' => 0,
                        ];
                    ?>

                    
                    <img id="mainImage" class="cg-main w-100 cg-main-clickable"
                        src="<?php echo e(asset('storage/' . $mainImage['image'])); ?>" alt="Main hole image" title="Click to enlarge">

                    
                    <div class="hole-details-container" id="holeDetails">
                        <div class="hole-number" id="holeNumber">Hole <?php echo e($mainImage['hole'] ?? 1); ?></div>
                        <div class="par-info" id="parInfo">PAR <?php echo e($mainImage['par'] ?? 4); ?></div>
                        <div class="marker-row">
                            <span class="marker-bullet gold-bullet">●</span>
                            <span class="marker-label">Gold:</span>
                            <span class="marker-distance" id="goldDistance"><?php echo e($mainImage['gold'] ?? 0); ?></span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet blue-bullet">●</span>
                            <span class="marker-label">Blue:</span>
                            <span class="marker-distance" id="blueDistance"><?php echo e($mainImage['blue'] ?? 0); ?></span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet silver-bullet">●</span>
                            <span class="marker-label">Silver:</span>
                            <span class="marker-distance" id="silverDistance"><?php echo e($mainImage['silver'] ?? 0); ?></span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet white-bullet">●</span>
                            <span class="marker-label">White:</span>
                            <span class="marker-distance" id="whiteDistance"><?php echo e($mainImage['white'] ?? 0); ?></span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet red-bullet">●</span>
                            <span class="marker-label">Red:</span>
                            <span class="marker-distance" id="redDistance"><?php echo e($mainImage['red'] ?? 0); ?></span>
                        </div>
                        <div class="handicap-info mt-2 pt-1" style="border-top: 1px solid rgba(255,255,255,0.2);">
                            <div class="marker-row">
                                <i class="bi bi-gender-male me-1" style="color: #4a90e2;"></i>
                                <span class="marker-label">Men's Handicap:</span>
                                <span class="marker-distance" id="menHandicap"><?php echo e($mainImage['men_handicap'] ?? 0); ?></span>
                            </div>
                            <div class="marker-row">
                                <i class="bi bi-gender-female me-1" style="color: #e24a8b;"></i>
                                <span class="marker-label">Ladies' Handicap:</span>
                                <span class="marker-distance"
                                    id="ladiesHandicap"><?php echo e($mainImage['ladies_handicap'] ?? 0); ?></span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="enlarge-hint">
                        <i class="bi bi-arrows-fullscreen"></i>
                    </div>
                </div>

                <button class="cg-side next" aria-label="Next" id="nextBtn">&#10095;</button>
            </div>

            
            <div class="cg-thumbs-row">
                <div class="cg-thumbs" id="thumbnailsContainer">
                    <?php $__currentLoopData = $couples->couples_images ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img class="thumb-img <?php echo e($index === 0 ? 'active-thumb' : ''); ?>"
                            src="<?php echo e(asset('storage/' . $img['image'])); ?>" data-hole="<?php echo e($img['hole'] ?? 1); ?>"
                            data-par="<?php echo e($img['par'] ?? 4); ?>" data-gold="<?php echo e($img['gold'] ?? 0); ?>"
                            data-blue="<?php echo e($img['blue'] ?? 0); ?>" data-white="<?php echo e($img['white'] ?? 0); ?>"
                            data-silver="<?php echo e($img['silver'] ?? 0); ?>" data-red="<?php echo e($img['red'] ?? 0); ?>"
                            data-men-handicap="<?php echo e($img['men_handicap'] ?? 0); ?>"
                            data-ladies-handicap="<?php echo e($img['ladies_handicap'] ?? 0); ?>"
                            data-src="<?php echo e(asset('storage/' . $img['image'])); ?>" data-index="<?php echo e($index); ?>"
                            alt="Hole <?php echo e($img['hole'] ?? $index + 1); ?>">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(empty($couples->couples_images) && $couples->couples_Mimage): ?>
                        <img class="thumb-img active-thumb" src="<?php echo e(asset('storage/' . $couples->couples_Mimage)); ?>"
                            data-hole="1" data-par="4" data-gold="0" data-blue="0" data-white="0" data-silver="0"
                            data-red="0" data-men-handicap="0" data-ladies-handicap="0"
                            data-src="<?php echo e(asset('storage/' . $couples->couples_Mimage)); ?>" data-index="0"
                            alt="Course thumbnail">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <br>
    </div>

    
    <div id="lightbox" class="lightbox-overlay" role="dialog" aria-label="Image lightbox" aria-hidden="true">
        <button class="lightbox-close" id="lightboxClose" aria-label="Close">&times;</button>
        <button class="lightbox-nav lightbox-prev" id="lightboxPrev">&#10094;</button>
        <div class="lightbox-img-wrap">
            <img id="lightboxImg" src="" alt="Full size hole image">
            <div class="lightbox-caption" id="lightboxCaption"></div>
        </div>
        <button class="lightbox-nav lightbox-next" id="lightboxNext">&#10095;</button>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            const mainImageEl = document.getElementById('mainImage');
            const holeNumber = document.getElementById('holeNumber');
            const parInfo = document.getElementById('parInfo');
            const goldDistance = document.getElementById('goldDistance');
            const blueDistance = document.getElementById('blueDistance');
            const whiteDistance = document.getElementById('whiteDistance');
            const silverDistance = document.getElementById('silverDistance');
            const redDistance = document.getElementById('redDistance');
            const menHandicap = document.getElementById('menHandicap');
            const ladiesHandicap = document.getElementById('ladiesHandicap');
            const thumbs = document.querySelectorAll('.cg-thumbs img');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const thumbnailsContainer = document.getElementById('thumbnailsContainer');

            function getCurrentIndex() {
                const a = document.querySelector('.thumb-img.active-thumb');
                return a ? parseInt(a.dataset.index) : 0;
            }

            function updateMainImage(index) {
                if (index < 0 || index >= thumbs.length) return;
                const thumb = thumbs[index];
                mainImageEl.src = thumb.dataset.src;
                holeNumber.textContent = 'Hole ' + thumb.dataset.hole;
                parInfo.textContent = 'PAR ' + thumb.dataset.par;
                goldDistance.textContent = thumb.dataset.gold;
                blueDistance.textContent = thumb.dataset.blue;
                whiteDistance.textContent = thumb.dataset.white;
                silverDistance.textContent = thumb.dataset.silver || '0';
                redDistance.textContent = thumb.dataset.red;
                menHandicap.textContent = thumb.dataset.menHandicap || '0';
                ladiesHandicap.textContent = thumb.dataset.ladiesHandicap || '0';

                thumbs.forEach(t => t.classList.remove('active-thumb'));
                thumb.classList.add('active-thumb');

                thumbnailsContainer.scrollTo({
                    left: thumb.offsetLeft - thumbnailsContainer.clientWidth / 2 + thumb.offsetWidth / 2,
                    behavior: 'smooth'
                });
            }

            prevBtn.addEventListener('click', () => {
                let i = getCurrentIndex() - 1;
                if (i < 0) i = thumbs.length - 1;
                updateMainImage(i);
            });

            nextBtn.addEventListener('click', () => {
                let i = getCurrentIndex() + 1;
                if (i >= thumbs.length) i = 0;
                updateMainImage(i);
            });

            thumbs.forEach(thumb => {
                thumb.addEventListener('click', () => updateMainImage(parseInt(thumb.dataset.index)));
            });

            // ===== DRAG-TO-SCROLL on thumbnail strip =====
            let isDragging = false,
                dragStartX, dragScrollLeft;

            thumbnailsContainer.addEventListener('mousedown', e => {
                isDragging = true;
                dragStartX = e.pageX - thumbnailsContainer.offsetLeft;
                dragScrollLeft = thumbnailsContainer.scrollLeft;
                thumbnailsContainer.classList.add('dragging');
            });
            document.addEventListener('mouseup', () => {
                isDragging = false;
                thumbnailsContainer.classList.remove('dragging');
            });
            thumbnailsContainer.addEventListener('mousemove', e => {
                if (!isDragging) return;
                e.preventDefault();
                const x = e.pageX - thumbnailsContainer.offsetLeft;
                const walk = (x - dragStartX) * 1.6;
                thumbnailsContainer.scrollLeft = dragScrollLeft - walk;
            });

            // ===== LIGHTBOX =====
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightboxImg');
            const lightboxCap = document.getElementById('lightboxCaption');
            const lightboxClose = document.getElementById('lightboxClose');
            const lightboxPrev = document.getElementById('lightboxPrev');
            const lightboxNext = document.getElementById('lightboxNext');

            function openLightbox(index) {
                if (index < 0 || index >= thumbs.length) return;
                const thumb = thumbs[index];
                lightboxImg.src = thumb.dataset.src;
                lightboxCap.textContent = 'Hole ' + thumb.dataset.hole + '  •  PAR ' + thumb.dataset.par;
                thumbs.forEach(t => t.classList.remove('active-thumb'));
                thumb.classList.add('active-thumb');
                lightbox.classList.add('active');
                lightbox.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function closeLightbox() {
                lightbox.classList.remove('active');
                lightbox.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            mainImageEl.addEventListener('click', () => openLightbox(getCurrentIndex()));
            lightboxClose.addEventListener('click', closeLightbox);
            lightbox.addEventListener('click', e => {
                if (e.target === lightbox) closeLightbox();
            });

            lightboxPrev.addEventListener('click', e => {
                e.stopPropagation();
                let i = getCurrentIndex() - 1;
                if (i < 0) i = thumbs.length - 1;
                updateMainImage(i);
                openLightbox(i);
            });
            lightboxNext.addEventListener('click', e => {
                e.stopPropagation();
                let i = getCurrentIndex() + 1;
                if (i >= thumbs.length) i = 0;
                updateMainImage(i);
                openLightbox(i);
            });

            document.addEventListener('keydown', e => {
                if (!lightbox.classList.contains('active')) return;
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowLeft') lightboxPrev.click();
                if (e.key === 'ArrowRight') lightboxNext.click();
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/couples.blade.php ENDPATH**/ ?>
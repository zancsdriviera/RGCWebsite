

<?php $__env->startSection('title', 'Event Gallery'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/eventGal.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">TOURNAMENT GALLERY</h1>
    </div>

    <div class="container">
        <div class="info-box">
            <h1 style="font-family:Lato Arial Sans Serif; color: #107039; padding-top:20px;">
                <?php echo e(strtoupper($gallery->title ?? ($galleryId ?? 'Gallery'))); ?></h1>
            <time class="date" style="font-size:18px; font-weight:600; color:#555;">
                <?php echo e(\Carbon\Carbon::parse($gallery->event_date)->format('F d, Y')); ?>

            </time>

            <hr class="dotted">
            <div class="green-bar" aria-hidden="true"></div>
        </div>

        <!-- Render gallery items server-side from $images -->
        <section class="gallery" data-gallery-id="<?php echo e($galleryId); ?>">
            <?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="gallery-item" data-index="<?php echo e($idx); ?>">
                    <img src="<?php echo e($img->path); ?>" alt="<?php echo e($img->label ?? 'Image ' . ($idx + 1)); ?>">

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>No images found on this gallery.</p>
            <?php endif; ?>
        </section>

        <!-- Modal -->
        <div id="imageModal" class="modal" role="dialog" aria-modal="true" aria-hidden="true">
            <div class="modal-content" role="document">
                <div class="modal-image-wrapper">
                    <img id="modalImg" src="" alt="Expanded Image" />
                    <button class="close" aria-label="Close image">&times;</button>
                    <button class="prev" aria-label="Previous image">&#10094;</button>
                    <button class="next" aria-label="Next image">&#10095;</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImg');
            const closeBtn = modal.querySelector('.close');
            const prevBtn = modal.querySelector('.prev');
            const nextBtn = modal.querySelector('.next');

            const gallerySection = document.querySelector('.gallery[data-gallery-id="<?php echo e($galleryId); ?>"]');
            const images = gallerySection ? Array.from(gallerySection.querySelectorAll('img')) : [];
            let currentIndex = 0;

            function openModal(index) {
                if (!images.length) return;
                currentIndex = (index + images.length) % images.length;
                modalImg.src = images[currentIndex].src;
                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                closeBtn.focus();
            }

            function closeModal() {
                modal.classList.remove('active');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            function showNext() {
                if (!images.length) return;
                currentIndex = (currentIndex + 1) % images.length;
                modalImg.src = images[currentIndex].src;
            }

            function showPrev() {
                if (!images.length) return;
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                modalImg.src = images[currentIndex].src;
            }

            images.forEach((img, i) => {
                img.style.cursor = 'pointer';
                img.addEventListener('click', (e) => {
                    e.preventDefault();
                    openModal(i);
                });
                img.setAttribute('tabindex', '0');
                img.addEventListener('keydown', (ev) => {
                    if (ev.key === 'Enter' || ev.key === ' ') openModal(i);
                });
            });

            closeBtn.addEventListener('click', closeModal);
            nextBtn.addEventListener('click', showNext);
            prevBtn.addEventListener('click', showPrev);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            // keyboard
            document.addEventListener('keydown', (e) => {
                if (!modal.classList.contains('active')) return;
                if (e.key === 'Escape') closeModal();
                if (e.key === 'ArrowRight') showNext();
                if (e.key === 'ArrowLeft') showPrev();
            });

            // // Auto-open if controller passed an open index
            // const openIndexFromServer = <?php echo e(isset($openIndex) ? intval($openIndex) : -1); ?>;
            // if (openIndexFromServer >= 0 && images.length) {
            //     setTimeout(() => openModal(openIndexFromServer), 120);
            // }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/eventGal.blade.php ENDPATH**/ ?>
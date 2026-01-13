

<?php $__env->startSection('title', 'Careers'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/careers.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CAREERS</h1>
    </div>

    <!-- Title section -->
    <div class="top_caption my-0 text-center">
        <h2 class="top-title">WE ARE HIRING</h2>
    </div>

    <div class="carousel-wrapper">
        <div class="carousel-container">
            <button class="carousel-btn prev" aria-label="Previous">&#10094;</button>

            <div class="carousel-viewport">
                <div class="carousel-track">
                    <?php $__empty_1 = true; $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="members-page">
                            <div class="app-card text-center">
                                <img src="<?php echo e(asset('storage/' . $career->career_image)); ?>" alt="Career Image"
                                    class="img-fluid career-thumb" style="cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#lightboxModal"
                                    data-src="<?php echo e(asset('storage/' . $career->career_image)); ?>">
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center text-muted">No career images available at the moment.</p>
                    <?php endif; ?>
                </div>
            </div>

            <button class="carousel-btn next" aria-label="Next">&#10095;</button>
        </div>
    </div>
    <!-- Lightbox Modal -->
    <div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 p-0">

                <!-- Image wrapper -->
                <div class="position-relative d-inline-block">

                    <!-- Full Image -->
                    <img id="lightboxImage" src="" alt="Full Image" class="lightbox-img">

                    <!-- Close Button INSIDE image -->
                    <button type="button" class="lightbox-close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slider = document.querySelector('.custom-slider');
            const track = document.querySelector('.custom-track');
            const cards = document.querySelectorAll('.custom-card');

            let index = 0;

            function updateSliderPosition() {
                const cardWidth = cards[0].offsetWidth; // ← Always get actual width
                track.style.transform = `translateX(-${index * cardWidth}px)`;
            }

            document.querySelector('.custom-next').addEventListener('click', () => {
                if (index < cards.length - 1) {
                    index++;
                    updateSliderPosition();
                }
            });

            document.querySelector('.custom-prev').addEventListener('click', () => {
                if (index > 0) {
                    index--;
                    updateSliderPosition();
                }
            });

            window.addEventListener('resize', updateSliderPosition);

        });

        document.addEventListener('DOMContentLoaded', () => {
            const lightboxModal = document.getElementById('lightboxModal');
            const lightboxImage = document.getElementById('lightboxImage');

            document.querySelectorAll('.career-thumb').forEach(img => {
                img.addEventListener('click', () => {
                    lightboxImage.src = img.getAttribute('data-src');
                });
            });

            lightboxModal.addEventListener('hidden.bs.modal', () => {
                lightboxImage.src = '';
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views\careers.blade.php ENDPATH**/ ?>
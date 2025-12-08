

<?php $__env->startSection('title', 'Membership'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/membership.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">MEMBERSHIP</h1>
    </div>

    <!-- Top caption -->
    <div class="top_caption my-0 text-center">
        <h2 class="top-title">CLICK TO DOWNLOAD THE PDF</h2>
    </div>

    <!-- Downloads section -->
    <div class="bullet_container my-4">
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-5">
            <?php
                $downloads = \App\Models\MembershipContent::where('type', 'download')->get();
                $chunkedDownloads = $downloads->chunk(ceil($downloads->count() / 2));
            ?>

            <?php $__currentLoopData = $chunkedDownloads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul class="list-unstyled text-start m-0">
                    <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <i class="bi bi-download me-2"></i>
                            <a href="<?php echo e(asset('storage/' . $item->file_path)); ?>" target="_blank">
                                <?php echo e($item->title); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center gx-2">
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <h2 class="bot-title">MEMBERSHIP APPLICANTS</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel -->
    <div class="carousel-wrapper">
        <div class="carousel-container" id="membershipCarousel">
            <button class="carousel-btn prev" aria-label="Previous" data-action="prev">&#10094;</button>

            <div class="carousel-viewport">
                <div class="carousel-track" role="list" aria-live="polite">
                    <?php
                        $membersDataCards = \App\Models\MembershipContent::where('type', 'members_data')->get();
                    ?>

                    <?php $__currentLoopData = $membersDataCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="members-page" role="listitem">
                            <div class="app-card text-center">
                                <img src="<?php echo e(asset('storage/' . $card->file_path)); ?>" alt="Member" class="img-fluid">
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>

            <button class="carousel-btn next" aria-label="Next" data-action="next">&#10095;</button>
        </div>
    </div>

    <!-- Banks / QR Codes -->
    <div class="container-fluid my-0 banks_container">
        <div class="row justify-content-center text-center gx-2">
            <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                    <div class="bank-column w-100">
                        <?php if($bank->top_image): ?>
                            <img src="<?php echo e(asset('storage/' . $bank->top_image)); ?>"
                                alt="<?php echo e($bank->title ?? 'Bank Top Image'); ?>" class="card-img custom-card-img-top mb-3">
                        <?php endif; ?>

                        <p class="mb-3 bank-title <?php echo e(strtolower(str_replace(' ', '-', $bank->title ?? 'bank'))); ?>">
                            <?php echo e($bank->title ?? 'PAY BILLS PROCEDURE'); ?>

                        </p>

                        <?php if($bank->qr_image): ?>
                            <img src="<?php echo e(asset('storage/' . $bank->qr_image)); ?>" alt="<?php echo e($bank->title ?? 'Bank QR'); ?>"
                                class="card-img custom-card-img">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('membershipCarousel');
            if (!carousel) return;

            const track = carousel.querySelector('.carousel-track');
            const viewport = carousel.querySelector('.carousel-viewport');
            const items = Array.from(track.children);
            const btnPrev = carousel.querySelector('[data-action="prev"]');
            const btnNext = carousel.querySelector('[data-action="next"]');

            let visible = getComputedStyle(document.documentElement).getPropertyValue('--visible') || 3;
            visible = parseInt(visible, 10);
            let gap = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--gap')) || 18;
            // convert gap to pixels if needed (assume px)
            const pxGap = (String(gap).includes('px')) ? parseFloat(gap) :
                (isNaN(gap) ? 18 : gap);

            let index = 0;
            let cardWidth = 0;
            let step = 0;

            function recalc() {
                const rootStyles = getComputedStyle(document.documentElement);
                visible = parseInt(rootStyles.getPropertyValue('--visible')) || 1;
                // read --gap as px (we defined px in CSS)
                const rawGap = rootStyles.getPropertyValue('--gap').trim();
                const gapPx = rawGap.endsWith('px') ? parseFloat(rawGap) : parseFloat(rawGap) || 18;

                // compute card width according to CSS: (100% - totalGaps) / visible
                const viewportWidth = viewport.clientWidth;
                const totalGaps = gapPx * (visible - 1);
                cardWidth = (viewportWidth - totalGaps) / visible;
                step = cardWidth + gapPx;

                // apply exact width to every card to avoid fractional cropping
                items.forEach((it) => {
                    it.style.flex = `0 0 ${cardWidth}px`;
                    it.style.width = `${cardWidth}px`;
                });

                // clamp index so we don't translate beyond available items
                index = Math.min(index, Math.max(0, items.length - visible));
                updateButtons();
                applyTransform();
            }

            function applyTransform() {
                const x = Math.round(index * step); // round to pixel to avoid fractional transforms
                track.style.transform = `translateX(-${x}px)`;
            }

            function updateButtons() {
                btnPrev.disabled = (index <= 0);
                btnNext.disabled = (index >= Math.max(0, items.length - visible));
            }

            btnPrev.addEventListener('click', () => {
                index = Math.max(0, index - 1);
                applyTransform();
                updateButtons();
            });

            btnNext.addEventListener('click', () => {
                index = Math.min(items.length - visible, index + 1);
                applyTransform();
                updateButtons();
            });

            // keyboard support
            carousel.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') btnPrev.click();
                if (e.key === 'ArrowRight') btnNext.click();
            });

            // debounce resize
            let rTimer = null;
            window.addEventListener('resize', () => {
                clearTimeout(rTimer);
                rTimer = setTimeout(recalc, 120);
            });

            // init
            recalc();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/membership.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'Tournament & Events'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/tourna_and_events.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php
    use Carbon\Carbon;
?>

<?php $__env->startSection('content'); ?>
    <main class="m_body">
        <div class="container-fluid p-0">

            
            <?php if($mainEventsGrouped && $mainEventsGrouped->count()): ?>
                <?php
                    $lines = [];
                    $allEvents = collect(); // initialize collection

                    foreach ($mainEventsGrouped as $date => $events) {
                        $dateFormatted = Carbon::parse($date)->format('F d, Y');
                        $titles = $events->pluck('title')->join(' & ');
                        $lines[] = $titles . ' - ' . $dateFormatted;

                        $allEvents = $allEvents->concat($events); // collect all events for carousel
                    }
                ?>

                <div class="header-title marquee">
                    <span>
                        UPCOMING EVENT <?php echo e($lines[0] ?? ''); ?>

                        <?php if(count($lines) > 1): ?>
                            <?php $__currentLoopData = array_slice($lines, 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                &nbsp;| <?php echo e($line); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </span>
                </div>

                <div class="carousel-container">
                    <button class="carousel-prev">&#10094;</button>
                    <div class="carousel-wrapper">
                        <?php $__currentLoopData = $allEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-card">
                                <img src="<?php echo e(asset('storage/' . $event->main_image)); ?>" class="carousel-card-img"
                                    alt="<?php echo e($event->title); ?>">
                                <div class="carousel-card-body text-center mt-2">
                                    <button class="btn btn-dark view-details-btn" data-bs-toggle="modal"
                                        data-bs-target="#mainModal<?php echo e($event->id); ?>">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button class="carousel-next">&#10095;</button>
                </div>

                
                <?php $__currentLoopData = $allEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="modal fade" id="mainModal<?php echo e($event->id); ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header main-modal-header" style="background-color: #5E6D48;">
                                    <h5 class="modal-title fw-bold text-white">
                                        <?php echo e(strtoupper($event->title)); ?> - TOURNAMENT DETAILS
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body main-modal-body">

                                    <?php if($event->secondary_image): ?>
                                        <div class="text-center mb-3">
                                            <img src="<?php echo e(asset('storage/' . $event->secondary_image)); ?>"
                                                class="secondary-image qr-fit" style="max-width:150px;">
                                            <h4 class="scan-qr-title" style="margin-top:10px;">
                                                SCAN QR TO REGISTER
                                            </h4>
                                        </div>
                                    <?php endif; ?>

                                    <hr class="dotted-divider">

                                    <?php
                                        $rows = json_decode($event->subtitles_texts, true) ?? [];
                                        $chunks = array_chunk($rows, 2);
                                    ?>

                                    <?php $__currentLoopData = $chunks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row mb-2 mx-0 modal-grid">
                                            <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6 mb-2 px-3">
                                                    <div class="text-block">
                                                        <div class="subtitle"><?php echo e(strtoupper($item['subtitle'])); ?></div>
                                                        <div class="text-content"><?php echo nl2br(e($item['text'])); ?></div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($event->file1): ?>
                                        <div class="mb-1">
                                            <a href="<?php echo e(asset('storage/' . $event->file1)); ?>" target="_blank"
                                                class="text-success file-link">
                                                <i class="bi bi-eye"></i> Terms of Competition
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($event->file2): ?>
                                        <div class="mb-1">
                                            <a href="<?php echo e(asset('storage/' . $event->file2)); ?>" target="_blank"
                                                class="text-success file-link">
                                                <i class="bi bi-eye"></i> Club Advisory
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="header-title none">NO TOURNAMENT SCHEDULED</div>
            <?php endif; ?>

            
            <?php if($previousEvents && $previousEvents->count()): ?>
                <h3 class="prev-title">PREVIOUS TOURNAMENTS</h3>
                <div class="prev-carousel-container">
                    <div class="prev-carousel-wrapper">
                        <?php $__currentLoopData = $previousEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="prev-carousel-card" data-bs-toggle="modal"
                                data-bs-target="#prevModal<?php echo e($event->id); ?>">
                                <img src="<?php echo e(asset('storage/' . $event->main_image)); ?>" class="prev-event-thumb"
                                    alt="<?php echo e($event->title); ?>">
                                <div class="prev-card-body text-center mt-2">
                                    <h6 class="card-title mb-0"><?php echo e($event->title); ?></h6>
                                    <span class="badge bg-danger mt-1">Ended</span>
                                </div>
                            </div>

                            <!-- Previous Tournament Modal -->
                            <div class="modal fade" id="prevModal<?php echo e($event->id); ?>" tabindex="-1">
                                <div class="modal-dialog modal-xl modal-dialog-centered"> <!-- increased modal size -->
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title"><?php echo e($event->title); ?></h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <?php if($event->winners_image): ?>
                                                <img src="<?php echo e(asset('storage/' . $event->winners_image)); ?>"
                                                    class="img-fluid rounded shadow" style="max-height:700px;">
                                                <!-- bigger image -->
                                            <?php else: ?>
                                                <p>No winners image available.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <?php if($previousEvents->count() > 4): ?>
                        <div class="prev-pagination">
                            <button class="prev-prev-btn">&#10094; Previous</button>
                            <button class="prev-next-btn">Next &#10095;</button>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // MAIN EVENT CAROUSEL
            document.querySelectorAll('.carousel-container').forEach(container => {
                const wrapper = container.querySelector('.carousel-wrapper');
                const cards = container.querySelectorAll('.carousel-card');
                const prevBtn = container.querySelector('.carousel-prev');
                const nextBtn = container.querySelector('.carousel-next');
                let index = 0;

                function update() {
                    wrapper.style.transform = `translateX(${-index * 100}%)`;
                }

                prevBtn.addEventListener('click', () => {
                    if (index > 0) {
                        index--;
                        update();
                    }
                });
                nextBtn.addEventListener('click', () => {
                    if (index < cards.length - 1) {
                        index++;
                        update();
                    }
                });
            });

            // PREVIOUS TOURNAMENT PAGINATION
            const prevContainer = document.querySelector('.prev-carousel-container');
            if (prevContainer) {
                const cards = prevContainer.querySelectorAll('.prev-carousel-card');
                const prevBtn = prevContainer.querySelector('.prev-prev-btn');
                const nextBtn = prevContainer.querySelector('.prev-next-btn');
                const perPage = 4;
                let pageIndex = 0;

                function showPage() {
                    cards.forEach((card, i) => card.style.display = (i >= pageIndex && i < pageIndex + perPage) ?
                        'block' : 'none');
                    prevBtn.disabled = pageIndex <= 0;
                    nextBtn.disabled = pageIndex + perPage >= cards.length;
                }

                prevBtn.addEventListener('click', () => {
                    if (pageIndex > 0) {
                        pageIndex -= perPage;
                        showPage();
                    }
                });
                nextBtn.addEventListener('click', () => {
                    if (pageIndex + perPage < cards.length) {
                        pageIndex += perPage;
                        showPage();
                    }
                });

                showPage();
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/tourna_and_events.blade.php ENDPATH**/ ?>
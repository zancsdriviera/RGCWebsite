

<?php $__env->startSection('title', 'Grill Room'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/grill.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-0">
        
        <div id="grillCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <?php
                    // Helper function to get the path from either old or new format
                    function getCarouselPath($item)
                    {
                        if (is_array($item) && isset($item['path'])) {
                            return $item['path'];
                        }
                        // Old format: just a string path
                        return $item;
                    }

                    // Helper function to get the type from either old or new format
                    function getCarouselType($item)
                    {
                        if (is_array($item) && isset($item['type'])) {
                            return $item['type'];
                        }
                        // Old format: assume it's an image
    return 'image';
                    }
                ?>

                <?php $__empty_1 = true; $__currentLoopData = $carousel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $path = getCarouselPath($item);
                        $type = getCarouselType($item);
                    ?>
                    <div class="carousel-item <?php echo e($i === 0 ? 'active' : ''); ?>">
                        <div class="carousel-media">
                            <?php if($type === 'video'): ?>
                                <div class="video-container">
                                    <video class="d-block w-100" autoplay muted loop playsinline preload="metadata">
                                        <source src="<?php echo e(asset($path)); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="video-overlay">
                                        <div class="play-icon">
                                            <i class="bi bi-play-circle-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <img src="<?php echo e(asset($path)); ?>" class="d-block w-100"
                                    alt="Grill Room Slide <?php echo e($i + 1); ?>" loading="lazy">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="carousel-item active">
                        <div class="carousel-media">
                            <img src="<?php echo e(asset('images/COURSES/default-thumb.jpg')); ?>" class="d-block w-100"
                                alt="No images available">
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if(count($carousel) > 1): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#grillCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#grillCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                
                <div class="carousel-indicators">
                    <?php $__currentLoopData = $carousel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" data-bs-target="#grillCarousel" data-bs-slide-to="<?php echo e($i); ?>"
                            class="<?php echo e($i === 0 ? 'active' : ''); ?>" aria-label="Slide <?php echo e($i + 1); ?>"></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>

        
        <section class="menu-section py-5">
            <div class="container">
                <!-- header with horizontal rules -->
                <div class="menu-header d-flex align-items-center justify-content-center mb-4">
                    <div class="header-line"></div>
                    <h2 class="mx-3">MENU</h2>
                    <div class="header-line"></div>
                </div>

                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-12 col-sm-6 col-md-4">
                            <figure class="menu-card text-center">
                                <div class="menu-img-wrap mx-auto">
                                    <?php if(!empty($item['image'])): ?>
                                        <?php
                                            // Remove '/storage/' prefix if present
                                            $imagePath = str_replace('/storage/', '', $item['image']);
                                        ?>
                                        <img src="<?php echo e(asset('storage/' . $imagePath)); ?>" alt="<?php echo e($item['name']); ?>"
                                            class="menu-img" loading="lazy">
                                    <?php else: ?>
                                        <div class="no-image-placeholder d-flex align-items-center justify-content-center">
                                            <small class="text-muted">No image</small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <figcaption class="mt-3">
                                    <h3 class="menu-title"><?php echo e($item['name'] ?? 'Unnamed Item'); ?></h3>
                                    <div class="menu-price"><?php echo e($item['price'] ?? 'Price not set'); ?></div>
                                </figcaption>
                            </figure>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <p class="text-center text-muted py-5">No menu items available at the moment.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('grillCarousel');
            if (!carousel) return;

            // Initialize carousel
            const bsCarousel = new bootstrap.Carousel(carousel, {
                interval: 5000,
                wrap: true,
                touch: true
            });

            // Handle video play/pause on carousel slide change
            carousel.addEventListener('slid.bs.carousel', function(event) {
                // Pause all videos
                document.querySelectorAll('#grillCarousel video').forEach(video => {
                    video.pause();
                });

                // Play video in the active slide if it exists
                const activeSlide = event.relatedTarget;
                const activeVideo = activeSlide.querySelector('video');
                if (activeVideo) {
                    // Use promise to handle autoplay restrictions
                    const playPromise = activeVideo.play();
                    if (playPromise !== undefined) {
                        playPromise.catch(error => {
                            console.log('Video autoplay prevented:', error);
                            // Show play button if autoplay fails
                            const overlay = activeSlide.querySelector('.video-overlay');
                            if (overlay) {
                                overlay.style.pointerEvents = 'auto';
                                overlay.style.opacity = '1';
                            }
                        });
                    }
                }
            });

            // Play video in active slide on load
            const activeSlide = document.querySelector('#grillCarousel .carousel-item.active');
            if (activeSlide) {
                const activeVideo = activeSlide.querySelector('video');
                if (activeVideo) {
                    activeVideo.play().catch(error => {
                        console.log('Initial video autoplay prevented:', error);
                    });
                }
            }

            // Add click to play/pause functionality for videos
            document.querySelectorAll('#grillCarousel .video-container').forEach(container => {
                const video = container.querySelector('video');
                const overlay = container.querySelector('.video-overlay');

                if (video && overlay) {
                    // Make overlay clickable
                    overlay.style.pointerEvents = 'auto';

                    overlay.addEventListener('click', function() {
                        if (video.paused) {
                            video.play();
                            overlay.style.opacity = '0';
                        } else {
                            video.pause();
                            overlay.style.opacity = '1';
                        }
                    });

                    // Show overlay when video is paused
                    video.addEventListener('pause', function() {
                        overlay.style.opacity = '1';
                    });

                    // Hide overlay when video is playing
                    video.addEventListener('play', function() {
                        overlay.style.opacity = '0';
                    });
                }
            });

            // Handle window resize for better mobile experience
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    // Force carousel to recalculate dimensions
                    bsCarousel.pause();
                    bsCarousel.cycle();
                }, 250);
            });

            // Pause carousel when hovering over interactive elements
            const interactiveElements = document.querySelectorAll(
                'video, .video-overlay, .carousel-control-prev, .carousel-control-next');
            interactiveElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    bsCarousel.pause();
                });

                element.addEventListener('mouseleave', function() {
                    bsCarousel.cycle();
                });
            });
        });
    </script>

    <style>
        .no-image-placeholder {
            width: 100%;
            height: 100%;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Ensure carousel indicators are visible on top of videos */
        .carousel-indicators {
            z-index: 10;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/grill.blade.php ENDPATH**/ ?>
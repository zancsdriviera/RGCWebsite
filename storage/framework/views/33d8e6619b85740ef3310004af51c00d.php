

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
                        // Remove '/storage/' prefix if present for asset() function
                        $displayPath = str_replace('/storage/', '', $path);
                    ?>
                    <div class="carousel-item <?php echo e($i === 0 ? 'active' : ''); ?>">
                        <?php if($type === 'video'): ?>
                            <div class="video-container">
                                <video class="d-block w-100" autoplay muted loop playsinline
                                    style="max-height: 70vh; object-fit: cover;">
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
                            <img src="<?php echo e(asset($path)); ?>" class="d-block w-100" alt="Slide <?php echo e($i + 1); ?>"
                                style="max-height: 70vh; object-fit: cover;">
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="carousel-item active">
                        <img src="<?php echo e(asset('images/COURSES/default-thumb.jpg')); ?>" class="d-block w-100" alt="No images"
                            style="max-height: 70vh; object-fit: cover;">
                    </div>
                <?php endif; ?>
            </div>
            <?php if(count($carousel) > 1): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#grillCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#grillCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
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
                                <div class="menu-img-wrap mx-auto" style="width:220px;height:160px;overflow:hidden;">
                                    <?php if(!empty($item['image'])): ?>
                                        <?php
                                            // Remove '/storage/' prefix if present for asset() function
                                            $imagePath = str_replace('/storage/', '', $item['image']);
                                        ?>
                                        <img src="<?php echo e(asset('storage/' . $imagePath)); ?>" alt="<?php echo e($item['name']); ?>"
                                            class="menu-img" style="width:100%;height:100%;object-fit:cover;">
                                    <?php else: ?>
                                        <div
                                            style="width:100%;height:100%;background:#f2f2f2;display:flex;align-items:center;justify-content:center;">
                                            <small>No image</small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <figcaption class="mt-3">
                                    <h3 class="menu-title"><?php echo e($item['name'] ?? 'Unnamed'); ?></h3>
                                    <div class="menu-price"><?php echo e($item['price'] ?? ''); ?></div>
                                </figcaption>
                            </figure>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center text-muted">No menu items found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle video play/pause on carousel slide change
            const carousel = document.getElementById('grillCarousel');
            if (carousel) {
                carousel.addEventListener('slide.bs.carousel', function(event) {
                    // Pause all videos when sliding
                    const videos = document.querySelectorAll('#grillCarousel video');
                    videos.forEach(video => {
                        video.pause();
                    });

                    // Play video in the next slide if it's a video
                    const nextSlide = event.relatedTarget;
                    const nextVideo = nextSlide.querySelector('video');
                    if (nextVideo) {
                        // Small delay to ensure slide transition is complete
                        setTimeout(() => {
                            nextVideo.play().catch(e => console.log('Video autoplay prevented:',
                            e));
                        }, 500);
                    }
                });

                // Play video in active slide on load
                const activeSlide = document.querySelector('#grillCarousel .carousel-item.active');
                if (activeSlide) {
                    const activeVideo = activeSlide.querySelector('video');
                    if (activeVideo) {
                        activeVideo.play().catch(e => console.log('Video autoplay prevented:', e));
                    }
                }
            }

            // Add click to play/pause functionality for videos
            document.querySelectorAll('#grillCarousel video').forEach(video => {
                video.addEventListener('click', function() {
                    if (this.paused) {
                        this.play();
                    } else {
                        this.pause();
                    }
                });
            });
        });
    </script>

    <style>
        .video-container {
            position: relative;
            width: 100%;
            max-height: 70vh;
            overflow: hidden;
            background-color: #000;
        }

        .video-container video {
            width: 100%;
            height: auto;
            max-height: 70vh;
            object-fit: cover;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            transition: opacity 0.3s;
        }

        .video-overlay .play-icon {
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.7);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .video-container:hover .video-overlay .play-icon {
            opacity: 1;
        }

        .carousel-control-prev,
        .carousel-control-next {
            z-index: 10;
        }

        .carousel-item img,
        .video-container {
            max-height: 70vh;
            object-fit: cover;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/grill.blade.php ENDPATH**/ ?>
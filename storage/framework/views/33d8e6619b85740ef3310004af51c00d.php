

<?php $__env->startSection('title', 'Grill Room'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/grill.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-0">
        
        <div id="grillCarousel" class="carousel slide" data-bs-ride="false">
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

        
        <section class="menu-section py-5 bg-light">
            <div class="container">
                <!-- header with horizontal rules -->
                <div class="menu-header d-flex align-items-center justify-content-center mb-5">
                    <div class="header-line"></div>
                    <h1 class="mx-3 display-5 fw-bold text-dark">OUR MENU</h1>
                    <div class="header-line"></div>
                </div>

                <p class="text-center text-muted mb-5 lead">Browse our delicious categories</p>

                <div class="row g-4 justify-content-center">
                    <?php $__empty_1 = true; $__currentLoopData = $organizedMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryId => $categoryData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $category = $categoryData['category'];
                            $items = $categoryData['items'];
                            $itemCount = count($items);
                        ?>

                        <?php if($itemCount > 0): ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="category-card-wrapper position-relative">
                                    <div class="category-card card border-0 shadow-lg h-100 hover-lift overflow-hidden"
                                        data-category-id="<?php echo e($categoryId); ?>" data-category-name="<?php echo e($category['name']); ?>"
                                        data-category-description="<?php echo e($category['description']); ?>"
                                        onclick="openCategoryModal(this)">

                                        <!-- Category Image Background -->
                                        <div class="category-image-overlay position-relative" style="height: 220px;">
                                            <?php if(!empty($category['image'])): ?>
                                                <?php
                                                    $imagePath = str_replace('/storage/', '', $category['image']);
                                                ?>
                                                <img src="<?php echo e(asset('storage/' . $imagePath)); ?>"
                                                    class="category-background-img w-100 h-100 object-fit-cover"
                                                    alt="<?php echo e($category['name']); ?>" loading="lazy">
                                                <div class="category-image-overlay-dark"></div>
                                            <?php else: ?>
                                                <div
                                                    class="category-placeholder-bg w-100 h-100 d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-egg-fried display-4 text-white opacity-75"></i>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Category Info Overlay -->
                                            <div
                                                class="category-info-overlay position-absolute bottom-0 start-0 end-0 p-4 text-white">
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        <h3 class="category-title fw-bold mb-1 fs-3 text-white">
                                                            <?php echo e($category['name']); ?></h3>
                                                        <?php if(!empty($category['description'])): ?>
                                                            <p class="category-desc mb-0 opacity-90">
                                                                <?php echo e(Str::limit($category['description'], 50)); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="category-badge bg-white text-dark rounded-pill px-3 py-2">
                                                        <span class="fw-semibold"><?php echo e($itemCount); ?></span>
                                                        <small class="ms-1"><?php echo e(Str::plural('item', $itemCount)); ?></small>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hover View Button -->
                                            <div
                                                class="category-hover-btn position-absolute top-50 start-50 translate-middle">
                                                <span
                                                    class="btn btn-light btn-lg rounded-pill shadow px-4 py-2 d-flex align-items-center">
                                                    <span class="fw-semibold me-2">View Menu</span>
                                                    <i class="bi bi-arrow-right"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Quick Preview Items -->
                                        <div class="card-body p-0">
                                            <div class="quick-preview p-4">
                                                <h6 class="text-muted mb-3 small fw-semibold">FEATURED ITEMS</h6>
                                                <div class="row g-2">
                                                    <?php $__currentLoopData = $items->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $previewItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center bg-light rounded p-2">
                                                                <?php if(!empty($previewItem['image'])): ?>
                                                                    <?php
                                                                        $previewImagePath = str_replace(
                                                                            '/storage/',
                                                                            '',
                                                                            $previewItem['image'],
                                                                        );
                                                                    ?>
                                                                    <img src="<?php echo e(asset('storage/' . $previewImagePath)); ?>"
                                                                        class="rounded me-2"
                                                                        style="width: 40px; height: 40px; object-fit: cover;"
                                                                        alt="<?php echo e($previewItem['name']); ?>">
                                                                <?php else: ?>
                                                                    <div class="rounded bg-white me-2 d-flex align-items-center justify-content-center"
                                                                        style="width: 40px; height: 40px;">
                                                                        <i class="bi bi-egg-fried text-muted"></i>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="flex-grow-1">
                                                                    <div class="small fw-medium text-truncate">
                                                                        <?php echo e($previewItem['name']); ?></div>
                                                                    <div class="text-primary small fw-bold">
                                                                        <?php echo e($previewItem['price'] ?? ''); ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="bi bi-egg-fried display-1 text-muted mb-3"></i>
                                <h3 class="text-muted">No Menu Categories Available</h3>
                                <p class="text-muted">Check back soon for our delicious offerings!</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>

    
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-gradient-primary text-white py-3 px-4 border-0">
                    <div class="flex-grow-1">
                        <h3 class="modal-title fw-semibold mb-1 fs-4" id="categoryModalTitle"></h3>
                        <p class="mb-0 small opacity-75" id="categoryModalDesc"></p>
                    </div>
                    <button type="button" class="btn-close btn-close-white ms-3 p-2" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3" id="categoryItemsContainer">
                        <!-- Items will be loaded here via JavaScript -->
                    </div>
                </div>
                <div class="modal-footer bg-light py-3 px-4 border-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 GRID PICTURES SECTION -->
    <div class="container-fluid px-0 py-0"> <!-- changed from container to container-fluid px-0 -->

        <div class="gallery-grid">
            <?php $__empty_1 = true; $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="gallery-item" onclick="openGalleryModal(<?php echo e($index); ?>)">
                    <img src="<?php echo e(asset('storage/' . str_replace('/storage/', '', $image))); ?>"
                        alt="Gallery Image <?php echo e($index + 1); ?>">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">No gallery images uploaded yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 bg-transparent">

            <!-- Close Button -->
            <div class="d-flex justify-content-end p-2">
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Gallery Image -->
            <div class="modal-body p-0">
                <img id="galleryModalImage" src="" alt="Gallery Image"
                    class="w-100 h-100 object-fit-cover d-block mx-auto">
            </div>

            <!-- Optional Prev/Next Buttons -->
            <button type="button" class="btn btn-dark position-absolute top-50 start-0 translate-middle-y"
                style="opacity:0.7;" onclick="prevImage()">&lt;</button>
            <button type="button" class="btn btn-dark position-absolute top-50 end-0 translate-middle-y"
                style="opacity:0.7;" onclick="nextImage()">&gt;</button>

        </div>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
    <script>
        let galleryImages = <?php echo json_encode($gallery ?? [], 15, 512) ?>;
        let currentIndex = 0;

        function openGalleryModal(index) {
            if (!galleryImages || galleryImages.length === 0) return;
            currentIndex = index;

            const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
            const modalImg = document.getElementById('galleryModalImage');

            const imgPath = galleryImages[currentIndex].replace('/storage/', '');
            modalImg.src = '<?php echo e(asset('storage/')); ?>/' + imgPath;

            modal.show();
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
            const modalImg = document.getElementById('galleryModalImage');
            const imgPath = galleryImages[currentIndex].replace('/storage/', '');
            modalImg.src = '<?php echo e(asset('storage/')); ?>/' + imgPath;
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % galleryImages.length;
            const modalImg = document.getElementById('galleryModalImage');
            const imgPath = galleryImages[currentIndex].replace('/storage/', '');
            modalImg.src = '<?php echo e(asset('storage/')); ?>/' + imgPath;
        }
    </script>

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

            // Function to handle video aspect ratio
            function handleVideoAspectRatio() {
                document.querySelectorAll('#grillCarousel .video-container').forEach(container => {
                    const video = container.querySelector('video');
                    if (!video) return;

                    // Remove existing classes
                    container.classList.remove('portrait');

                    // Check if video is loaded
                    if (video.videoWidth && video.videoHeight) {
                        if (video.videoHeight > video.videoWidth) {
                            container.classList.add('portrait');
                        }
                    } else {
                        // Wait for metadata to load
                        video.addEventListener('loadedmetadata', function() {
                            if (this.videoHeight > this.videoWidth) {
                                container.classList.add('portrait');
                            }
                        }, {
                            once: true
                        });
                    }
                });
            }

            // Initial call
            handleVideoAspectRatio();

            // Handle when carousel slides
            carousel.addEventListener('slid.bs.carousel', function(event) {
                // Small delay to ensure video is loaded
                setTimeout(handleVideoAspectRatio, 100);
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                handleVideoAspectRatio();
            });
        });

        // Category Modal Functions
        const categoryModal = new bootstrap.Modal(document.getElementById('categoryModal'));
        const categoryModalTitle = document.getElementById('categoryModalTitle');
        const categoryModalDesc = document.getElementById('categoryModalDesc');
        const categoryItemsContainer = document.getElementById('categoryItemsContainer');

        // Store menu data from PHP in JavaScript
        const menuData = <?php echo json_encode($organizedMenu, 15, 512) ?>;

        function openCategoryModal(element) {
            const categoryId = element.dataset.categoryId;
            const categoryName = element.dataset.categoryName;
            const categoryDescription = element.dataset.categoryDescription;

            // Update modal title and description
            categoryModalTitle.textContent = categoryName;
            categoryModalDesc.textContent = categoryDescription || '';

            // Clear previous items
            categoryItemsContainer.innerHTML = '';

            // Get items for this category
            const categoryData = menuData[categoryId];
            if (categoryData && categoryData.items && categoryData.items.length > 0) {
                // Add items to modal
                categoryData.items.forEach((item, index) => {
                    const imagePath = item.image ? item.image.replace('/storage/', '') : '';
                    const imageUrl = item.image ? `<?php echo e(asset('storage/')); ?>/${imagePath}` : '';

                    const itemHtml = `
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="menu-item-card card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                            <div class="card-img-top" style="height: 160px; overflow: hidden; background-color: #f8f9fa;">
                                ${imageUrl ? `
                                                                                        <img src="${imageUrl}" 
                                                                                             class="w-100 h-100 object-fit-cover transition-scale"
                                                                                             alt="${item.name}"
                                                                                             loading="lazy">
                                                                                    ` : `
                                                                                        <div class="w-100 h-100 bg-gradient-light d-flex align-items-center justify-content-center">
                                                                                            <i class="bi bi-egg-fried fs-2 text-muted"></i>
                                                                                        </div>
                                                                                    `}
                            </div>
                            <div class="card-body text-center p-3">
                                <h6 class="card-title fw-semibold mb-2 fs-6 text-dark">${item.name}</h6>
                                <div class="price-tag d-inline-block bg-primary text-white rounded-pill px-3 py-1 fw-medium">
                                    ${item.price || 'Price upon request'}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                    categoryItemsContainer.innerHTML += itemHtml;
                });
            } else {
                categoryItemsContainer.innerHTML = `
                <div class="col-12">
                    <div class="text-center py-4">
                        <i class="bi bi-egg-fried display-4 text-muted mb-3 opacity-50"></i>
                        <h5 class="text-muted fw-normal mb-2">No items in this category</h5>
                        <p class="text-muted small">Check back soon for updates!</p>
                    </div>
                </div>
            `;
            }

            // Show the modal
            categoryModal.show();
        }
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

        /* Enhanced Category Card Styling - UPDATED */
        .category-card-wrapper {
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out forwards;
            animation-delay: calc(var(--item-index, 0) * 0.1s);
        }

        .category-card {
            border-radius: 20px !important;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .category-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        .category-image-overlay {
            height: 220px;
            overflow: hidden;
            border-radius: 20px 20px 0 0;
            position: relative;
        }

        .category-background-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .category-card:hover .category-background-img {
            transform: scale(1.1);
        }

        .category-image-overlay-dark {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.7));
            z-index: 1;
        }

        .category-info-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            z-index: 2;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            color: white;
        }

        .category-title {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            font-size: 1.5rem !important;
            line-height: 1.2;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: white;
        }

        .category-desc {
            font-size: 0.95rem;
            line-height: 1.4;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            opacity: 0.9;
            margin-bottom: 0;
        }

        .category-badge {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            font-size: 0.9rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            color: #2c3e50;
            font-weight: 600;
        }

        .category-hover-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 3;
            opacity: 0;
            transform: translate(-50%, -30%);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .category-card:hover .category-hover-btn {
            opacity: 1;
            transform: translate(-50%, -50%);
        }

        .category-hover-btn .btn {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .category-hover-btn .btn:hover {
            background: white;
            transform: translateX(5px);
        }

        .category-placeholder-bg {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #45af45 0%, #275e2e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quick-preview {
            background: #f8f9fa;
            border-radius: 0 0 20px 20px;
            padding: 1.5rem !important;
        }

        .quick-preview h6 {
            letter-spacing: 0.5px;
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        /* Enhanced Lightbox Styling */
        #categoryModal .modal-content {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        #categoryModal .modal-header {
            background: linear-gradient(135deg, #45af45 0%, #275e2e 100%);
            padding: 1.5rem 2rem;
        }

        #categoryModal .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
        }

        #categoryModal .modal-desc {
            font-size: 1rem;
            opacity: 0.9;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
        }

        #categoryModal .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
            transition: opacity 0.2s ease;
            background-size: 1rem;
            width: 2rem;
            height: 2rem;
        }

        #categoryModal .btn-close:hover {
            opacity: 1;
        }

        #categoryModal .modal-body {
            padding: 2rem;
            max-height: 65vh;
            overflow-y: auto;
        }

        #categoryModal .modal-footer {
            padding: 1.25rem 2rem;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        /* Enhanced Menu Item Cards */
        .menu-item-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.08);
            height: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .menu-item-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12) !important;
            border-color: rgba(69, 175, 69, 0.2);
        }

        .menu-item-card .card-img-top {
            height: 200px;
            border-radius: 16px 16px 0 0;
            object-fit: cover;
        }

        .menu-item-card .card-body {
            padding: 1.5rem;
        }

        .menu-item-card .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.75rem;
            min-height: 2.6rem;
            line-height: 1.3;
        }

        .price-tag {
            font-size: 1.1rem;
            padding: 0.5rem 1.25rem;
            background: linear-gradient(135deg, #45af45 0%, #275e2e 100%);
            border-radius: 12px;
            display: inline-block;
            font-weight: 600;
            color: white;
            border: none;
        }

        .transition-scale {
            transition: transform 0.3s ease;
        }

        .menu-item-card:hover .transition-scale {
            transform: scale(1.05);
        }

        .bg-gradient-light {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .grid-wrapper {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            width: 100%;
        }

        .grid-card {
            position: relative;
            width: 100%;
            height: 240px;
            overflow: hidden;
        }

        .grid-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* 4-Grid Gallery Full Width */
        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            margin: 0;
            /* remove container margin */
            padding: 0;
            /* remove container padding */
        }

        .gallery-item {
            flex: 0 0 25%;
            /* 4 columns */
            margin: 0;
            /* remove spacing between items */
            padding: 0;
            /* remove padding */
            cursor: pointer;
            position: relative;
            aspect-ratio: 1 / 1;
            /* make it square */
            overflow: hidden;
            /* crop overflow */
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* cover the square */
            display: block;
            transition: transform 0.5s ease;
            /* smooth zoom */
        }

        .gallery-item:hover img {
            transform: scale(1.1);
            /* zoom in */
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .gallery-item {
                flex: 0 0 33.3333%;
            }

            /* 3 columns on tablet */
        }

        @media (max-width: 768px) {
            .gallery-item {
                flex: 0 0 50%;
            }

            /* 2 columns on mobile */
        }

        @media (max-width: 576px) {
            .gallery-item {
                flex: 0 0 100%;
            }

            /* 1 column on small screens */
        }

        #galleryModal .modal-dialog {
            max-width: 900px;
        }

        #galleryModal .modal-body {
            padding: 0;
            height: 80vh;
            /* image fills most of modal */
        }

        #galleryModalImage {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .grid-wrapper {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .category-title {
                font-size: 1.3rem !important;
            }

            .category-image-overlay {
                height: 200px;
            }
        }

        @media (max-width: 992px) {
            .category-title {
                font-size: 1.2rem !important;
            }

            .category-image-overlay {
                height: 180px;
            }

            .menu-item-card .card-img-top {
                height: 180px;
            }

            #categoryModal .modal-body {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .category-card-wrapper {
                margin-bottom: 1.5rem;
            }

            .category-title {
                font-size: 1.1rem !important;
            }

            .category-image-overlay {
                height: 160px;
            }

            .category-info-overlay {
                padding: 1.25rem;
            }

            .category-hover-btn .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .menu-item-card .card-img-top {
                height: 160px;
            }

            #categoryModal .modal-header {
                padding: 1rem 1.5rem;
            }

            #categoryModal .modal-title {
                font-size: 1.3rem;
            }

            #categoryModal .modal-body {
                padding: 1.25rem;
                max-height: 60vh;
            }

            #categoryModal .modal-footer {
                padding: 1rem 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .category-card {
                border-radius: 16px !important;
            }

            .category-image-overlay {
                height: 150px;
                border-radius: 16px 16px 0 0;
            }

            .category-title {
                font-size: 1rem !important;
            }

            .category-badge {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }

            .category-info-overlay {
                padding: 1rem;
            }

            .quick-preview {
                padding: 1.25rem !important;
            }

            .menu-item-card .card-img-top {
                height: 140px;
            }

            .menu-item-card .card-body {
                padding: 1.25rem;
            }

            #categoryModal .modal-dialog {
                margin: 0.5rem;
            }

            #categoryModal .modal-header {
                padding: 0.75rem 1.25rem;
            }

            #categoryModal .modal-title {
                font-size: 1.2rem;
            }

            #categoryModal .modal-body {
                padding: 1rem;
            }
        }

        @media (max-width: 400px) {
            .category-image-overlay {
                height: 140px;
            }

            .category-title {
                font-size: 0.9rem !important;
            }

            .menu-item-card .card-img-top {
                height: 120px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/grill.blade.php ENDPATH**/ ?>
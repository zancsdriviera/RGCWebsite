@extends('layouts.app')

@section('title', 'Grill Room')

@push('styles')
    <link href="{{ asset('css/grill.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid px-0">
        {{-- Carousel --}}
        <div id="grillCarousel" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                @php
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
                @endphp

                @forelse($carousel as $i => $item)
                    @php
                        $path = getCarouselPath($item);
                        $type = getCarouselType($item);
                    @endphp
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        <div class="carousel-media">
                            @if ($type === 'video')
                                <div class="video-container">
                                    <video class="d-block w-100" autoplay muted loop playsinline preload="metadata">
                                        <source src="{{ asset($path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="video-overlay">
                                        <div class="play-icon">
                                            <i class="bi bi-play-circle-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <img src="{{ asset($path) }}" class="d-block w-100"
                                    alt="Grill Room Slide {{ $i + 1 }}" loading="lazy">
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="carousel-media">
                            <img src="{{ asset('images/COURSES/default-thumb.jpg') }}" class="d-block w-100"
                                alt="No images available">
                        </div>
                    </div>
                @endforelse
            </div>

            @if (count($carousel) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#grillCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#grillCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                {{-- Carousel Indicators --}}
                <div class="carousel-indicators">
                    @foreach ($carousel as $i => $item)
                        <button type="button" data-bs-target="#grillCarousel" data-bs-slide-to="{{ $i }}"
                            class="{{ $i === 0 ? 'active' : '' }}" aria-label="Slide {{ $i + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Menu Categories Grid --}}
        <section class="menu-section py-5 bg-light">
            <div class="container">
                <!-- header with horizontal rules -->
                <div class="menu-header d-flex align-items-center justify-content-center mb-5">
                    <div class="header-line"></div>
                    <h1 class="mx-3 display-5 fw-bold text-dark">OUR MENU</h1>
                    <div class="header-line"></div>
                </div>

                <p class="text-center text-muted mb-5 lead">Click on any category to view all items</p>

                <div class="row g-4 justify-content-center">
                    @forelse($organizedMenu as $categoryId => $categoryData)
                        @php
                            $category = $categoryData['category'];
                            $items = $categoryData['items'];
                            $itemCount = count($items);
                        @endphp

                        @if ($itemCount > 0)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="category-card card border-0 shadow-sm h-100 hover-lift"
                                    data-category-id="{{ $categoryId }}" data-category-name="{{ $category['name'] }}"
                                    data-category-description="{{ $category['description'] }}"
                                    onclick="openCategoryModal(this)">
                                    <div class="card-body text-center p-4">
                                        <div class="category-icon mb-3">
                                            @if ($items[0]['image'] ?? false)
                                                @php
                                                    $imagePath = str_replace('/storage/', '', $items[0]['image']);
                                                @endphp
                                                <img src="{{ asset('storage/' . $imagePath) }}"
                                                    class="rounded-circle category-preview-img"
                                                    alt="{{ $category['name'] }}" loading="lazy">
                                            @else
                                                <div
                                                    class="category-placeholder rounded-circle mx-auto d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-egg-fried fs-1"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <h3 class="category-title fw-bold mb-2">{{ $category['name'] }}</h3>
                                        @if (!empty($category['description']))
                                            <p class="category-desc text-muted small mb-3">
                                                {{ Str::limit($category['description'], 80) }}</p>
                                        @endif
                                        <div class="category-meta d-flex justify-content-center">
                                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                                <i class="bi bi-utensils me-1"></i>
                                                {{ $itemCount }} {{ Str::plural('item', $itemCount) }}
                                            </span>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-outline-dark btn-sm view-category-btn">
                                                View All <i class="bi bi-arrow-right ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="bi bi-egg-fried display-1 text-muted mb-3"></i>
                                <h3 class="text-muted">No Menu Categories Available</h3>
                                <p class="text-muted">Check back soon for our delicious offerings!</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    {{-- Category Modal Lightbox --}}
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <div>
                        <h2 class="modal-title fw-bold" id="categoryModalTitle"></h2>
                        <p class="mb-0 small text-light" id="categoryModalDesc"></p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4" id="categoryItemsContainer">
                        <!-- Items will be loaded here via JavaScript -->
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
        const menuData = @json($organizedMenu);

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
                categoryData.items.forEach(item => {
                    const imagePath = item.image ? item.image.replace('/storage/', '') : '';
                    const imageUrl = item.image ? `{{ asset('storage/') }}/${imagePath}` : '';

                    const itemHtml = `
                        <div class="col-md-4 col-sm-6">
                            <div class="menu-item-card card h-100 border-0 shadow-sm">
                                <div class="card-img-top" style="height: 200px; overflow: hidden;">
                                    ${imageUrl ? `
                                                                <img src="${imageUrl}" 
                                                                     class="w-100 h-100 object-fit-cover"
                                                                     alt="${item.name}"
                                                                     loading="lazy">
                                                            ` : `
                                                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                                                    <i class="bi bi-egg-fried fs-1 text-muted"></i>
                                                                </div>
                                                            `}
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold mb-2">${item.name}</h5>
                                    <div class="price-tag badge bg-primary fs-5 px-3 py-2 mb-3">
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
                        <div class="text-center py-5">
                            <i class="bi bi-egg-fried display-1 text-muted mb-3"></i>
                            <h4 class="text-muted">No items in this category</h4>
                            <p class="text-muted">Check back soon for updates!</p>
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

        /* Category Card Styling */
        .category-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 15px;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .category-preview-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .category-placeholder {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #6c757d;
        }

        .category-title {
            color: #333;
            font-size: 1.25rem;
        }

        .category-desc {
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .view-category-btn {
            transition: all 0.3s ease;
        }

        .category-card:hover .view-category-btn {
            background-color: #333;
            color: white;
        }

        /* Modal Lightbox Styling */
        #categoryModal .modal-content {
            border-radius: 20px;
            overflow: hidden;
        }

        #categoryModal .modal-header {
            background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%);
        }

        .menu-item-card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .menu-item-card:hover {
            transform: scale(1.03);
        }

        .menu-item-card .card-img-top {
            border-radius: 15px 15px 0 0;
        }

        .price-tag {
            border-radius: 10px;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .category-card {
                margin-bottom: 1.5rem;
            }

            #categoryModal .modal-dialog {
                margin: 10px;
            }
        }
    </style>
@endpush

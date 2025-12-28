@extends('layouts.app')

@section('title', 'Grill Room')

@push('styles')
    <link href="{{ asset('css/grill.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid px-0">
        {{-- Carousel --}}
        <div id="grillCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
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

        {{-- Menu --}}
        <section class="menu-section py-5">
            <div class="container">
                <!-- header with horizontal rules -->
                <div class="menu-header d-flex align-items-center justify-content-center mb-4">
                    <div class="header-line"></div>
                    <h2 class="mx-3">MENU</h2>
                    <div class="header-line"></div>
                </div>

                <div class="row g-4">
                    @forelse($menu as $item)
                        <div class="col-12 col-sm-6 col-md-4">
                            <figure class="menu-card text-center">
                                <div class="menu-img-wrap mx-auto">
                                    @if (!empty($item['image']))
                                        @php
                                            // Remove '/storage/' prefix if present
                                            $imagePath = str_replace('/storage/', '', $item['image']);
                                        @endphp
                                        <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $item['name'] }}"
                                            class="menu-img" loading="lazy">
                                    @else
                                        <div class="no-image-placeholder d-flex align-items-center justify-content-center">
                                            <small class="text-muted">No image</small>
                                        </div>
                                    @endif
                                </div>
                                <figcaption class="mt-3">
                                    <h3 class="menu-title">{{ $item['name'] ?? 'Unnamed Item' }}</h3>
                                    <div class="menu-price">{{ $item['price'] ?? 'Price not set' }}</div>
                                </figcaption>
                            </figure>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center text-muted py-5">No menu items available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
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
@endpush

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
                        // Remove '/storage/' prefix if present for asset() function
                        $displayPath = str_replace('/storage/', '', $path);
                    @endphp
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        @if ($type === 'video')
                            <div class="video-container">
                                <video class="d-block w-100" autoplay muted loop playsinline
                                    style="max-height: 70vh; object-fit: cover;">
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
                            <img src="{{ asset($path) }}" class="d-block w-100" alt="Slide {{ $i + 1 }}"
                                style="max-height: 70vh; object-fit: cover;">
                        @endif
                    </div>
                @empty
                    <div class="carousel-item active">
                        <img src="{{ asset('images/COURSES/default-thumb.jpg') }}" class="d-block w-100" alt="No images"
                            style="max-height: 70vh; object-fit: cover;">
                    </div>
                @endforelse
            </div>
            @if (count($carousel) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#grillCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#grillCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
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
                                <div class="menu-img-wrap mx-auto" style="width:220px;height:160px;overflow:hidden;">
                                    @if (!empty($item['image']))
                                        @php
                                            // Remove '/storage/' prefix if present for asset() function
                                            $imagePath = str_replace('/storage/', '', $item['image']);
                                        @endphp
                                        <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $item['name'] }}"
                                            class="menu-img" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <div
                                            style="width:100%;height:100%;background:#f2f2f2;display:flex;align-items:center;justify-content:center;">
                                            <small>No image</small>
                                        </div>
                                    @endif
                                </div>
                                <figcaption class="mt-3">
                                    <h3 class="menu-title">{{ $item['name'] ?? 'Unnamed' }}</h3>
                                    <div class="menu-price">{{ $item['price'] ?? '' }}</div>
                                </figcaption>
                            </figure>
                        </div>
                    @empty
                        <p class="text-center text-muted">No menu items found.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
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
@endpush

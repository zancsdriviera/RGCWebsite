@extends('layouts.app')

@section('title', 'Courses - Couples')

@push('styles')
    <link href="{{ asset('css/couples.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">COUPLES COURSE</h1>
    </div>

    <br>
    <div class="course-gallery">
        <h2 class="cg-title">{{ $couples->couples_title ?? $couples->couples_Mtitle }}</h2>
        <div class="cg-rule"></div>
        <p class="cg-desc">{{ $couples->couples_description ?? '' }}</p>

        <div class="cg-frame">
            <div class="cg-main-wrap position-relative">
                <button class="cg-side prev" aria-label="Previous" id="prevBtn">&#10094;</button>

                <div class="cg-main-container position-relative w-100">
                    @php
                        $mainImage = $couples->couples_images[0] ?? [
                            'image' => $couples->couples_Mimage ?? asset('images/placeholder.png'),
                            'hole' => 1,
                            'par' => 4,
                            'gold' => 0,
                            'blue' => 0,
                            'white' => 0,
                            'red' => 0,
                        ];
                    @endphp
                    <img id="mainImage" class="cg-main w-100" src="{{ asset('storage/' . $mainImage['image']) }}"
                        alt="Main hole image">

                    <!-- Hole Details Overlay -->
                    <div class="hole-details-container" id="holeDetails">
                        <div class="hole-number" id="holeNumber">Hole {{ $mainImage['hole'] ?? 1 }}</div>
                        <div class="par-info" id="parInfo">PAR {{ $mainImage['par'] ?? 4 }}</div>
                        <div class="marker-row">
                            <span class="marker-bullet gold-bullet">●</span>
                            <span class="marker-distance" id="goldDistance">{{ $mainImage['gold'] ?? 0 }}</span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet blue-bullet">●</span>
                            <span class="marker-distance" id="blueDistance">{{ $mainImage['blue'] ?? 0 }}</span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet white-bullet">●</span>
                            <span class="marker-distance" id="whiteDistance">{{ $mainImage['white'] ?? 0 }}</span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet red-bullet">●</span>
                            <span class="marker-distance" id="redDistance">{{ $mainImage['red'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>

                <button class="cg-side next" aria-label="Next" id="nextBtn">&#10095;</button>
            </div>

            {{-- Updated thumbnail section with navigation buttons --}}
            <div class="cg-thumbs-row">
                <button class="cg-thumbs-nav prev-thumbs" aria-label="Previous thumbnails" id="prevThumbsBtn">‹</button>
                <div class="cg-thumbs" id="thumbnailsContainer">
                    @foreach ($couples->couples_images ?? [] as $index => $img)
                        <img class="thumb-img {{ $index === 0 ? 'active-thumb' : '' }}"
                            src="{{ asset('storage/' . $img['image']) }}" data-hole="{{ $img['hole'] ?? 1 }}"
                            data-par="{{ $img['par'] ?? 4 }}" data-gold="{{ $img['gold'] ?? 0 }}"
                            data-blue="{{ $img['blue'] ?? 0 }}" data-white="{{ $img['white'] ?? 0 }}"
                            data-red="{{ $img['red'] ?? 0 }}" data-src="{{ asset('storage/' . $img['image']) }}"
                            data-index="{{ $index }}" alt="Thumbnail for hole {{ $img['hole'] ?? 1 }}">
                    @endforeach
                    @if (empty($couples->couples_images) && $couples->couples_Mimage)
                        <img class="thumb-img active-thumb" src="{{ asset('storage/' . $couples->couples_Mimage) }}"
                            data-hole="1" data-par="4" data-gold="0" data-blue="0" data-white="0" data-red="0"
                            data-src="{{ asset('storage/' . $couples->couples_Mimage) }}" data-index="0"
                            alt="Course thumbnail">
                    @endif
                </div>
                <button class="cg-thumbs-nav next-thumbs" aria-label="Next thumbnails" id="nextThumbsBtn">›</button>
            </div>
        </div>
        <br>
    </div>

    @push('scripts')
        <script>
            const mainImage = document.getElementById('mainImage');
            const holeNumber = document.getElementById('holeNumber');
            const parInfo = document.getElementById('parInfo');
            const goldDistance = document.getElementById('goldDistance');
            const blueDistance = document.getElementById('blueDistance');
            const whiteDistance = document.getElementById('whiteDistance');
            const redDistance = document.getElementById('redDistance');
            const thumbs = document.querySelectorAll('.cg-thumbs img');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            // Get current active image index
            function getCurrentIndex() {
                const activeThumb = document.querySelector('.thumb-img.active-thumb');
                return activeThumb ? parseInt(activeThumb.dataset.index) : 0;
            }

            // Update main image and hole details
            function updateMainImage(index) {
                if (index >= 0 && index < thumbs.length) {
                    const thumb = thumbs[index];
                    mainImage.src = thumb.dataset.src;
                    holeNumber.textContent = 'Hole ' + thumb.dataset.hole;
                    parInfo.textContent = 'PAR ' + thumb.dataset.par;
                    goldDistance.textContent = thumb.dataset.gold;
                    blueDistance.textContent = thumb.dataset.blue;
                    whiteDistance.textContent = thumb.dataset.white;
                    redDistance.textContent = thumb.dataset.red;

                    // Update active class
                    thumbs.forEach(t => t.classList.remove('active-thumb'));
                    thumb.classList.add('active-thumb');
                }
            }

            // Previous button click event
            prevBtn.addEventListener('click', () => {
                let currentIndex = getCurrentIndex();
                let newIndex = currentIndex - 1;

                // Loop to last if at first
                if (newIndex < 0) {
                    newIndex = thumbs.length - 1;
                }

                updateMainImage(newIndex);
            });

            // Next button click event
            nextBtn.addEventListener('click', () => {
                let currentIndex = getCurrentIndex();
                let newIndex = currentIndex + 1;

                // Loop to first if at last
                if (newIndex >= thumbs.length) {
                    newIndex = 0;
                }

                updateMainImage(newIndex);
            });

            // Thumbnail click event
            thumbs.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    const index = parseInt(thumb.dataset.index);
                    updateMainImage(index);
                });
            });

            // Thumbnail navigation functionality
            const thumbnailsContainer = document.getElementById('thumbnailsContainer');
            const prevThumbsBtn = document.getElementById('prevThumbsBtn');
            const nextThumbsBtn = document.getElementById('nextThumbsBtn');
            const thumbScrollAmount = 200;

            // Function to update thumbnail navigation buttons visibility
            function updateThumbNavButtons() {
                const scrollLeft = thumbnailsContainer.scrollLeft;
                const maxScroll = thumbnailsContainer.scrollWidth - thumbnailsContainer.clientWidth;

                // Show/hide previous button
                if (scrollLeft <= 10) {
                    prevThumbsBtn.classList.add('disabled');
                } else {
                    prevThumbsBtn.classList.remove('disabled');
                }

                // Show/hide next button
                if (scrollLeft >= maxScroll - 10) {
                    nextThumbsBtn.classList.add('disabled');
                } else {
                    nextThumbsBtn.classList.remove('disabled');
                }
            }

            // Previous thumbnails button
            prevThumbsBtn.addEventListener('click', () => {
                if (!prevThumbsBtn.classList.contains('disabled')) {
                    thumbnailsContainer.scrollBy({
                        left: -thumbScrollAmount,
                        behavior: 'smooth'
                    });
                }
            });

            // Next thumbnails button
            nextThumbsBtn.addEventListener('click', () => {
                if (!nextThumbsBtn.classList.contains('disabled')) {
                    thumbnailsContainer.scrollBy({
                        left: thumbScrollAmount,
                        behavior: 'smooth'
                    });
                }
            });

            // Update main image and center the active thumbnail
            function updateMainImage(index) {
                if (index >= 0 && index < thumbs.length) {
                    const thumb = thumbs[index];
                    mainImage.src = thumb.dataset.src;
                    holeNumber.textContent = 'Hole ' + thumb.dataset.hole;
                    parInfo.textContent = 'PAR ' + thumb.dataset.par;
                    goldDistance.textContent = thumb.dataset.gold;
                    blueDistance.textContent = thumb.dataset.blue;
                    whiteDistance.textContent = thumb.dataset.white;
                    redDistance.textContent = thumb.dataset.red;

                    // Update active class
                    thumbs.forEach(t => t.classList.remove('active-thumb'));
                    thumb.classList.add('active-thumb');

                    // Scroll to center the active thumbnail
                    const container = thumbnailsContainer;
                    const thumbElement = thumb;
                    const containerWidth = container.clientWidth;
                    const thumbLeft = thumbElement.offsetLeft;
                    const thumbWidth = thumbElement.offsetWidth;

                    container.scrollTo({
                        left: thumbLeft - (containerWidth / 2) + (thumbWidth / 2),
                        behavior: 'smooth'
                    });
                }
            }

            // Update navigation buttons on scroll
            thumbnailsContainer.addEventListener('scroll', updateThumbNavButtons);

            // Initialize button states on page load
            window.addEventListener('load', updateThumbNavButtons);

            // Also call updateThumbNavButtons when window is resized
            window.addEventListener('resize', updateThumbNavButtons);
        </script>
    @endpush
@endsection

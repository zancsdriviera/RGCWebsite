@extends('layouts.app')

@section('title', 'Courses - Couples')

@push('styles')
    <link href="{{ asset('css/couples.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <style>
        .hole-number-label {
            bottom: 10px;
            left: 10px;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 3px 6px;
            border-radius: 4px;
            position: absolute;
            font-weight: bold;
        }

        .cg-thumbs img {
            cursor: pointer;
        }

        .cg-thumbs img.active-thumb {
            border: 2px solid #0d6efd;
        }
    </style>
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
                        ];
                    @endphp
                    <img id="mainImage" class="cg-main w-100" src="{{ asset('storage/' . $mainImage['image']) }}"
                        alt="Main hole image">
                    <span id="holeLabel" class="hole-number-label">Hole {{ $mainImage['hole'] ?? 1 }}</span>
                </div>

                <button class="cg-side next" aria-label="Next" id="nextBtn">&#10095;</button>
            </div>

            <div class="cg-thumbs-row">
                <div class="cg-thumbs d-flex flex-wrap">
                    @foreach ($couples->couples_images ?? [] as $index => $img)
                        <img class="thumb-img {{ $index === 0 ? 'active-thumb' : '' }}"
                            src="{{ asset('storage/' . $img['image']) }}" data-hole="{{ $img['hole'] ?? 1 }}"
                            data-src="{{ asset('storage/' . $img['image']) }}" data-index="{{ $index }}"
                            alt="thumb" width="80">
                    @endforeach
                    @if (empty($couples->couples_images) && $couples->couples_Mimage)
                        <img class="thumb-img active-thumb" src="{{ asset('storage/' . $couples->couples_Mimage) }}"
                            data-hole="1" data-src="{{ asset('storage/' . $couples->couples_Mimage) }}" data-index="0"
                            alt="thumb" width="80">
                    @endif
                </div>
            </div>
        </div>
        <br>
    </div>

    @push('scripts')
        <script>
            const mainImage = document.getElementById('mainImage');
            const holeLabel = document.getElementById('holeLabel');
            const thumbs = document.querySelectorAll('.cg-thumbs img');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            // Get current active image index
            function getCurrentIndex() {
                const activeThumb = document.querySelector('.thumb-img.active-thumb');
                return activeThumb ? parseInt(activeThumb.dataset.index) : 0;
            }

            // Update main image and hole number
            function updateMainImage(index) {
                if (index >= 0 && index < thumbs.length) {
                    const thumb = thumbs[index];
                    mainImage.src = thumb.dataset.src;
                    holeLabel.textContent = 'Hole ' + thumb.dataset.hole;

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
        </script>
    @endpush
@endsection

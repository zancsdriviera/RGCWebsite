@extends('layouts.app')

@section('title', 'Courses - Langer')

@push('styles')
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <link href="{{ asset('css/langer.css') }}" rel="stylesheet">
@endpush

@section('content')

    {{-- ===== ORIGINAL HERO (unchanged) ===== --}}
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">LANGER COURSE</h1>
    </div>

    <br>
    <div class="course-gallery">
        <h2 class="cg-title">{{ $langer->langer_title ?? $langer->langer_Mtitle }}</h2>
        <div class="cg-rule"></div>
        <p class="cg-desc">{{ $langer->langer_description ?? '' }}</p>

        <div class="cg-frame">
            <div class="cg-main-wrap position-relative">
                <button class="cg-side prev" aria-label="Previous" id="prevBtn">&#10094;</button>

                <div class="cg-main-container position-relative w-100">
                    @php
                        $mainImage = $langer->langer_images[0] ?? [
                            'image' => $langer->langer_Mimage ?? asset('images/placeholder.png'),
                            'hole' => 1,
                            'par' => 4,
                            'gold' => 0,
                            'blue' => 0,
                            'white' => 0,
                            'silver' => 0,
                            'red' => 0,
                            'men_handicap' => 0,
                            'ladies_handicap' => 0,
                        ];
                    @endphp

                    {{-- Clickable main image --}}
                    <img id="mainImage" class="cg-main w-100 cg-main-clickable"
                        src="{{ asset('storage/' . $mainImage['image']) }}" alt="Main hole image" title="Click to enlarge">

                    {{-- Hole details overlay --}}
                    <div class="hole-details-container" id="holeDetails">
                        <div class="hole-number" id="holeNumber">Hole {{ $mainImage['hole'] ?? 1 }}</div>
                        <div class="par-info" id="parInfo">PAR {{ $mainImage['par'] ?? 4 }}</div>
                        <div class="marker-row">
                            <span class="marker-bullet gold-bullet">●</span>
                            <span class="marker-label">Gold:</span>
                            <span class="marker-distance" id="goldDistance">{{ $mainImage['gold'] ?? 0 }}</span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet blue-bullet">●</span>
                            <span class="marker-label">Blue:</span>
                            <span class="marker-distance" id="blueDistance">{{ $mainImage['blue'] ?? 0 }}</span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet silver-bullet">●</span>
                            <span class="marker-label">Silver:</span>
                            <span class="marker-distance" id="silverDistance">{{ $mainImage['silver'] ?? 0 }}</span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet white-bullet">●</span>
                            <span class="marker-label">White:</span>
                            <span class="marker-distance" id="whiteDistance">{{ $mainImage['white'] ?? 0 }}</span>
                        </div>
                        <div class="marker-row">
                            <span class="marker-bullet red-bullet">●</span>
                            <span class="marker-label">Red:</span>
                            <span class="marker-distance" id="redDistance">{{ $mainImage['red'] ?? 0 }}</span>
                        </div>
                        <div class="handicap-info mt-2 pt-1" style="border-top: 1px solid rgba(255,255,255,0.2);">
                            <div class="marker-row">
                                <i class="bi bi-gender-male me-1" style="color: #4a90e2;"></i>
                                <span class="marker-label">Men's Handicap:</span>
                                <span class="marker-distance" id="menHandicap">{{ $mainImage['men_handicap'] ?? 0 }}</span>
                            </div>
                            <div class="marker-row">
                                <i class="bi bi-gender-female me-1" style="color: #e24a8b;"></i>
                                <span class="marker-label">Ladies' Handicap:</span>
                                <span class="marker-distance"
                                    id="ladiesHandicap">{{ $mainImage['ladies_handicap'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Enlarge hint --}}
                    <div class="enlarge-hint">
                        <i class="bi bi-arrows-fullscreen"></i>
                    </div>
                </div>

                <button class="cg-side next" aria-label="Next" id="nextBtn">&#10095;</button>
            </div>

            {{-- ===== THUMBNAIL STRIP — no nav buttons, drag to scroll ===== --}}
            <div class="cg-thumbs-row">
                <div class="cg-thumbs" id="thumbnailsContainer">
                    @foreach ($langer->langer_images ?? [] as $index => $img)
                        <img class="thumb-img {{ $index === 0 ? 'active-thumb' : '' }}"
                            src="{{ asset('storage/' . $img['image']) }}" data-hole="{{ $img['hole'] ?? 1 }}"
                            data-par="{{ $img['par'] ?? 4 }}" data-gold="{{ $img['gold'] ?? 0 }}"
                            data-blue="{{ $img['blue'] ?? 0 }}" data-white="{{ $img['white'] ?? 0 }}"
                            data-silver="{{ $img['silver'] ?? 0 }}" data-red="{{ $img['red'] ?? 0 }}"
                            data-men-handicap="{{ $img['men_handicap'] ?? 0 }}"
                            data-ladies-handicap="{{ $img['ladies_handicap'] ?? 0 }}"
                            data-src="{{ asset('storage/' . $img['image']) }}" data-index="{{ $index }}"
                            alt="Hole {{ $img['hole'] ?? $index + 1 }}">
                    @endforeach
                    @if (empty($langer->langer_images) && $langer->langer_Mimage)
                        <img class="thumb-img active-thumb" src="{{ asset('storage/' . $langer->langer_Mimage) }}"
                            data-hole="1" data-par="4" data-gold="0" data-blue="0" data-white="0" data-silver="0"
                            data-red="0" data-men-handicap="0" data-ladies-handicap="0"
                            data-src="{{ asset('storage/' . $langer->langer_Mimage) }}" data-index="0"
                            alt="Course thumbnail">
                    @endif
                </div>
            </div>
        </div>
        <br>
    </div>

    {{-- Lightbox Overlay --}}
    <div id="lightbox" class="lightbox-overlay" role="dialog" aria-label="Image lightbox" aria-hidden="true">
        <button class="lightbox-close" id="lightboxClose" aria-label="Close">&times;</button>
        <button class="lightbox-nav lightbox-prev" id="lightboxPrev">&#10094;</button>
        <div class="lightbox-img-wrap">
            <img id="lightboxImg" src="" alt="Full size hole image">
            <div class="lightbox-caption" id="lightboxCaption"></div>
        </div>
        <button class="lightbox-nav lightbox-next" id="lightboxNext">&#10095;</button>
    </div>

    @push('scripts')
        <script>
            const mainImageEl = document.getElementById('mainImage');
            const holeNumber = document.getElementById('holeNumber');
            const parInfo = document.getElementById('parInfo');
            const goldDistance = document.getElementById('goldDistance');
            const blueDistance = document.getElementById('blueDistance');
            const whiteDistance = document.getElementById('whiteDistance');
            const silverDistance = document.getElementById('silverDistance');
            const redDistance = document.getElementById('redDistance');
            const menHandicap = document.getElementById('menHandicap');
            const ladiesHandicap = document.getElementById('ladiesHandicap');
            const thumbs = document.querySelectorAll('.cg-thumbs img');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const thumbnailsContainer = document.getElementById('thumbnailsContainer');

            function getCurrentIndex() {
                const a = document.querySelector('.thumb-img.active-thumb');
                return a ? parseInt(a.dataset.index) : 0;
            }

            function updateMainImage(index) {
                if (index < 0 || index >= thumbs.length) return;
                const thumb = thumbs[index];
                mainImageEl.src = thumb.dataset.src;
                holeNumber.textContent = 'Hole ' + thumb.dataset.hole;
                parInfo.textContent = 'PAR ' + thumb.dataset.par;
                goldDistance.textContent = thumb.dataset.gold;
                blueDistance.textContent = thumb.dataset.blue;
                whiteDistance.textContent = thumb.dataset.white;
                silverDistance.textContent = thumb.dataset.silver || '0';
                redDistance.textContent = thumb.dataset.red;
                menHandicap.textContent = thumb.dataset.menHandicap || '0';
                ladiesHandicap.textContent = thumb.dataset.ladiesHandicap || '0';

                thumbs.forEach(t => t.classList.remove('active-thumb'));
                thumb.classList.add('active-thumb');

                thumbnailsContainer.scrollTo({
                    left: thumb.offsetLeft - thumbnailsContainer.clientWidth / 2 + thumb.offsetWidth / 2,
                    behavior: 'smooth'
                });
            }

            prevBtn.addEventListener('click', () => {
                let i = getCurrentIndex() - 1;
                if (i < 0) i = thumbs.length - 1;
                updateMainImage(i);
            });

            nextBtn.addEventListener('click', () => {
                let i = getCurrentIndex() + 1;
                if (i >= thumbs.length) i = 0;
                updateMainImage(i);
            });

            thumbs.forEach(thumb => {
                thumb.addEventListener('click', () => updateMainImage(parseInt(thumb.dataset.index)));
            });

            // ===== DRAG-TO-SCROLL on thumbnail strip =====
            let isDragging = false,
                dragStartX, dragScrollLeft;

            thumbnailsContainer.addEventListener('mousedown', e => {
                isDragging = true;
                dragStartX = e.pageX - thumbnailsContainer.offsetLeft;
                dragScrollLeft = thumbnailsContainer.scrollLeft;
                thumbnailsContainer.classList.add('dragging');
            });
            document.addEventListener('mouseup', () => {
                isDragging = false;
                thumbnailsContainer.classList.remove('dragging');
            });
            thumbnailsContainer.addEventListener('mousemove', e => {
                if (!isDragging) return;
                e.preventDefault();
                const x = e.pageX - thumbnailsContainer.offsetLeft;
                const walk = (x - dragStartX) * 1.6;
                thumbnailsContainer.scrollLeft = dragScrollLeft - walk;
            });

            // ===== LIGHTBOX =====
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightboxImg');
            const lightboxCap = document.getElementById('lightboxCaption');
            const lightboxClose = document.getElementById('lightboxClose');
            const lightboxPrev = document.getElementById('lightboxPrev');
            const lightboxNext = document.getElementById('lightboxNext');

            function openLightbox(index) {
                if (index < 0 || index >= thumbs.length) return;
                const thumb = thumbs[index];
                lightboxImg.src = thumb.dataset.src;
                lightboxCap.textContent = 'Hole ' + thumb.dataset.hole + '  •  PAR ' + thumb.dataset.par;
                thumbs.forEach(t => t.classList.remove('active-thumb'));
                thumb.classList.add('active-thumb');
                lightbox.classList.add('active');
                lightbox.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function closeLightbox() {
                lightbox.classList.remove('active');
                lightbox.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            mainImageEl.addEventListener('click', () => openLightbox(getCurrentIndex()));
            lightboxClose.addEventListener('click', closeLightbox);
            lightbox.addEventListener('click', e => {
                if (e.target === lightbox) closeLightbox();
            });

            lightboxPrev.addEventListener('click', e => {
                e.stopPropagation();
                let i = getCurrentIndex() - 1;
                if (i < 0) i = thumbs.length - 1;
                updateMainImage(i);
                openLightbox(i);
            });
            lightboxNext.addEventListener('click', e => {
                e.stopPropagation();
                let i = getCurrentIndex() + 1;
                if (i >= thumbs.length) i = 0;
                updateMainImage(i);
                openLightbox(i);
            });

            document.addEventListener('keydown', e => {
                if (!lightbox.classList.contains('active')) return;
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowLeft') lightboxPrev.click();
                if (e.key === 'ArrowRight') lightboxNext.click();
            });
        </script>
    @endpush
@endsection

@extends('layouts.app')

@section('title', 'Membership')

@push('styles')
    <link href="{{ asset('css/membership.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">MEMBERSHIP</h1>
    </div>

    <!-- Top caption -->
    <div class="top_caption my-0 text-center">
        <h2 class="top-title">CLICK TO DOWNLOAD THE PDF</h2>
    </div>

    <!-- Downloads section - Updated for mobile responsiveness -->
    <div class="bullet_container my-4">
        <div
            class="d-flex flex-column flex-md-row justify-content-center align-items-md-center align-items-start gap-4 gap-md-5">
            @php
                $downloads = \App\Models\MembershipContent::where('type', 'download')->get();
                $chunkCount = 3; // Default for desktop/large screens

                // Adjust chunk count based on screen size using responsive classes
                $downloadsCount = $downloads->count();
                if ($downloadsCount <= 4) {
                    $chunkCount = 1; // For few items, show in single column on mobile
                }
            @endphp

            <!-- Desktop/Large Screen Layout (2 columns) -->
            <div class="d-none d-md-flex flex-md-row justify-content-center align-items-center gap-5 w-100">
                @php
                    $chunkedDownloads = $downloads->chunk(ceil($downloadsCount / 2));
                @endphp

                @foreach ($chunkedDownloads as $group)
                    <ul class="list-unstyled text-start m-0 download-column">
                        @foreach ($group as $item)
                            <li class="download-item">
                                <i class="bi bi-download me-2"></i>
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">
                                    {{ $item->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>

            <!-- Mobile Layout (3-4 columns depending on item count) -->
            <div class="d-flex d-md-none flex-row flex-wrap justify-content-center align-items-start gap-3 w-100">
                @php
                    // For mobile, create more columns to utilize space better
                    $mobileChunkCount = min(4, max(2, ceil($downloadsCount / 4)));
                    $mobileChunks = $downloads->chunk(ceil($downloadsCount / $mobileChunkCount));
                @endphp

                @foreach ($mobileChunks as $group)
                    <ul class="list-unstyled text-start m-0 download-column-mobile">
                        @foreach ($group as $item)
                            <li class="download-item-mobile">
                                <i class="bi bi-download me-2"></i>
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">
                                    {{ $item->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center gx-2">
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <h2 class="bot-title">MEMBERSHIP APPLICANTS</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel -->
    <div class="carousel-wrapper">
        <div class="carousel-container" id="membershipCarousel">
            <button class="carousel-btn prev" aria-label="Previous" data-action="prev">&#10094;</button>

            <div class="carousel-viewport">
                <div class="carousel-track" role="list" aria-live="polite">
                    @php
                        $membersDataCards = \App\Models\MembershipContent::where('type', 'members_data')->get();
                    @endphp

                    @foreach ($membersDataCards as $card)
                        <div class="members-page" role="listitem">
                            <div class="app-card text-center">
                                <img src="{{ asset('storage/' . $card->file_path) }}" alt="Member"
                                    class="img-fluid membership-thumb" style="cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#membershipLightboxModal"
                                    data-src="{{ asset('storage/' . $card->file_path) }}">

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <button class="carousel-btn next" aria-label="Next" data-action="next">&#10095;</button>
        </div>
    </div>

    <!-- Banks / QR Codes -->
    <div class="container-fluid my-0 banks_container">
        <div class="row justify-content-center text-center gx-2">
            @foreach ($banks as $bank)
                <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                    <div class="bank-column w-100">
                        @if ($bank->top_image)
                            <img src="{{ asset('storage/' . $bank->top_image) }}"
                                alt="{{ $bank->title ?? 'Bank Top Image' }}" class="card-img custom-card-img-top mb-3">
                        @endif

                        <p class="mb-3 bank-title {{ strtolower(str_replace(' ', '-', $bank->title ?? 'bank')) }}">
                            {{ $bank->title ?? 'PAY BILLS PROCEDURE' }}
                        </p>

                        @if ($bank->qr_image)
                            <img src="{{ asset('storage/' . $bank->qr_image) }}" alt="{{ $bank->title ?? 'Bank QR' }}"
                                class="card-img custom-card-img">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Lightbox Modal -->
    <div class="modal fade" id="membershipLightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 p-0">

                <div class="position-relative d-inline-block">
                    <!-- Full Image -->
                    <img id="membershipLightboxImage" src="" alt="Member Full Image" class="lightbox-img">

                    <!-- Close Button -->
                    <button type="button" class="lightbox-close" data-bs-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('membershipCarousel');
            if (!carousel) return;

            const track = carousel.querySelector('.carousel-track');
            const viewport = carousel.querySelector('.carousel-viewport');
            const items = Array.from(track.children);
            const btnPrev = carousel.querySelector('[data-action="prev"]');
            const btnNext = carousel.querySelector('[data-action="next"]');

            let visible = getComputedStyle(document.documentElement).getPropertyValue('--visible') || 3;
            visible = parseInt(visible, 10);
            let gap = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--gap')) || 18;
            // convert gap to pixels if needed (assume px)
            const pxGap = (String(gap).includes('px')) ? parseFloat(gap) :
                (isNaN(gap) ? 18 : gap);

            let index = 0;
            let cardWidth = 0;
            let step = 0;

            function recalc() {
                const rootStyles = getComputedStyle(document.documentElement);
                visible = parseInt(rootStyles.getPropertyValue('--visible')) || 1;
                // read --gap as px (we defined px in CSS)
                const rawGap = rootStyles.getPropertyValue('--gap').trim();
                const gapPx = rawGap.endsWith('px') ? parseFloat(rawGap) : parseFloat(rawGap) || 18;

                // compute card width according to CSS: (100% - totalGaps) / visible
                const viewportWidth = viewport.clientWidth;
                const totalGaps = gapPx * (visible - 1);
                cardWidth = (viewportWidth - totalGaps) / visible;
                step = cardWidth + gapPx;

                // apply exact width to every card to avoid fractional cropping
                items.forEach((it) => {
                    it.style.flex = `0 0 ${cardWidth}px`;
                    it.style.width = `${cardWidth}px`;
                });

                // clamp index so we don't translate beyond available items
                index = Math.min(index, Math.max(0, items.length - visible));
                updateButtons();
                applyTransform();
            }

            function applyTransform() {
                const x = Math.round(index * step); // round to pixel to avoid fractional transforms
                track.style.transform = `translateX(-${x}px)`;
            }

            function updateButtons() {
                btnPrev.disabled = (index <= 0);
                btnNext.disabled = (index >= Math.max(0, items.length - visible));
            }

            btnPrev.addEventListener('click', () => {
                index = Math.max(0, index - 1);
                applyTransform();
                updateButtons();
            });

            btnNext.addEventListener('click', () => {
                index = Math.min(items.length - visible, index + 1);
                applyTransform();
                updateButtons();
            });

            // keyboard support
            carousel.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') btnPrev.click();
                if (e.key === 'ArrowRight') btnNext.click();
            });

            // debounce resize
            let rTimer = null;
            window.addEventListener('resize', () => {
                clearTimeout(rTimer);
                rTimer = setTimeout(recalc, 120);
            });

            // init
            recalc();
        });
        document.addEventListener('DOMContentLoaded', () => {
            const lightboxModal = document.getElementById('membershipLightboxModal');
            const lightboxImage = document.getElementById('membershipLightboxImage');

            document.querySelectorAll('.membership-thumb').forEach(img => {
                img.addEventListener('click', () => {
                    lightboxImage.src = img.getAttribute('data-src');
                });
            });

            lightboxModal.addEventListener('hidden.bs.modal', () => {
                lightboxImage.src = '';
            });
        });
    </script>
@endpush

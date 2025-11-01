@extends('layouts.app')

@section('title', 'Event Gallery')

@push('styles')
    <link href="{{ asset('css/eventGal.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">FACILITIES / EVENT GALLERY</h1>
    </div>

    <div class="container">
        <div class="info-box">
            <h1>{{ strtoupper($galleryId ?? 'Gallery') }}</h1>
            <hr class="dotted">
            <div class="green-bar" aria-hidden="true"></div>
        </div>

        <!-- Render gallery items server-side from $images -->
        <section class="gallery" data-gallery-id="{{ $galleryId }}">
            @forelse ($images as $idx => $img)
                <div class="gallery-item" data-index="{{ $idx }}">
                    <img src="{{ $img }}" alt="Image {{ $idx + 1 }}">
                </div>
            @empty
                <p>No images found for gallery <strong>{{ $galleryId }}</strong>.</p>
            @endforelse
        </section>

        <!-- ===== REPLACEMENT: Modal HTML ===== -->
        <div id="imageModal" class="modal" role="dialog" aria-modal="true" aria-hidden="true">
            <div class="modal-content" role="document">
                <div class="modal-image-wrapper">
                    <img id="modalImg" src="" alt="Expanded Image" />
                    <button class="close" aria-label="Close image">&times;</button>
                    <button class="prev" aria-label="Previous image">&#10094;</button>
                    <button class="next" aria-label="Next image">&#10095;</button>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImg');
            const closeBtn = modal.querySelector('.close');
            const prevBtn = modal.querySelector('.prev');
            const nextBtn = modal.querySelector('.next');

            // All images within the rendered gallery section
            const gallerySection = document.querySelector('.gallery[data-gallery-id="{{ $galleryId }}"]');
            const images = gallerySection ? Array.from(gallerySection.querySelectorAll('img')) : [];
            let currentIndex = 0;

            function openModal(index) {
                if (!images.length) return;
                currentIndex = (index + images.length) % images.length;
                modalImg.src = images[currentIndex].src;
                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                closeBtn.focus();
            }

            function closeModal() {
                modal.classList.remove('active');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            function showNext() {
                if (!images.length) return;
                currentIndex = (currentIndex + 1) % images.length;
                modalImg.src = images[currentIndex].src;
            }

            function showPrev() {
                if (!images.length) return;
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                modalImg.src = images[currentIndex].src;
            }

            // Attach click handlers to gallery thumbnails
            images.forEach((img, i) => {
                img.style.cursor = 'pointer';
                img.addEventListener('click', (e) => {
                    e.preventDefault();
                    openModal(i);
                });
                img.setAttribute('tabindex', '0');
                img.addEventListener('keydown', (ev) => {
                    if (ev.key === 'Enter' || ev.key === ' ') openModal(i);
                });
            });

            // modal controls
            closeBtn.addEventListener('click', closeModal);
            nextBtn.addEventListener('click', showNext);
            prevBtn.addEventListener('click', showPrev);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            // keyboard
            document.addEventListener('keydown', (e) => {
                if (!modal.classList.contains('active')) return;
                if (e.key === 'Escape') closeModal();
                if (e.key === 'ArrowRight') showNext();
                if (e.key === 'ArrowLeft') showPrev();
                if (e.key === 'Tab') {
                    const focusable = Array.from(modal.querySelectorAll('button, [tabindex]')).filter(
                        Boolean);
                    if (!focusable.length) return;
                    const first = focusable[0],
                        last = focusable[focusable.length - 1];
                    if (e.shiftKey && document.activeElement === first) {
                        last.focus();
                        e.preventDefault();
                    } else if (!e.shiftKey && document.activeElement === last) {
                        first.focus();
                        e.preventDefault();
                    }
                }
            });

            // Auto-open if controller passed an open index
            const openIndexFromServer = {{ isset($openIndex) ? intval($openIndex) : -1 }};
            if (openIndexFromServer >= 0 && images.length) {
                // delay slightly so images can be laid out
                setTimeout(() => openModal(openIndexFromServer), 120);
            }
        });
    </script>
@endpush

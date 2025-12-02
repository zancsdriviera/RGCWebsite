@extends('layouts.app')

@section('title', 'Careers')

@push('styles')
    <link href="{{ asset('css/careers.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CAREERS</h1>
    </div>

    <!-- Title section -->
    <div class="top_caption my-0 text-center">
        <h2 class="top-title">WE ARE HIRING</h2>
    </div>

    <div class="carousel-wrapper">
        <div class="carousel-container">
            <button class="carousel-btn prev" aria-label="Previous">&#10094;</button>

            <div class="carousel-viewport">
                <div class="carousel-track">
                    @forelse ($careers as $career)
                        <div class="members-page">
                            <div class="app-card text-center">
                                <img src="{{ asset('storage/' . $career->career_image) }}" alt="Career Image"
                                    class="img-fluid career-thumb" style="cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#lightboxModal"
                                    data-src="{{ asset('storage/' . $career->career_image) }}">
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted">No career images available at the moment.</p>
                    @endforelse
                </div>
            </div>

            <button class="carousel-btn next" aria-label="Next">&#10095;</button>
        </div>
    </div>
    <!-- Lightbox Modal -->
    <div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 p-0">

                <!-- Image wrapper -->
                <div class="position-relative d-inline-block">

                    <!-- Full Image -->
                    <img id="lightboxImage" src="" alt="Full Image" class="lightbox-img">

                    <!-- Close Button INSIDE image -->
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
        document.addEventListener('DOMContentLoaded', () => {
            const slider = document.querySelector('.custom-slider');
            const track = document.querySelector('.custom-track');
            const cards = document.querySelectorAll('.custom-card');

            let index = 0;

            function updateSliderPosition() {
                const cardWidth = cards[0].offsetWidth; // ← Always get actual width
                track.style.transform = `translateX(-${index * cardWidth}px)`;
            }

            document.querySelector('.custom-next').addEventListener('click', () => {
                if (index < cards.length - 1) {
                    index++;
                    updateSliderPosition();
                }
            });

            document.querySelector('.custom-prev').addEventListener('click', () => {
                if (index > 0) {
                    index--;
                    updateSliderPosition();
                }
            });

            window.addEventListener('resize', updateSliderPosition);

        });

        document.addEventListener('DOMContentLoaded', () => {
            const lightboxModal = document.getElementById('lightboxModal');
            const lightboxImage = document.getElementById('lightboxImage');

            document.querySelectorAll('.career-thumb').forEach(img => {
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

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
                                    class="img-fluid">
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
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('.carousel-container');
            const track = container.querySelector('.carousel-track');
            const slides = Array.from(track.children);
            const prevBtn = container.querySelector('.carousel-btn.prev');
            const nextBtn = container.querySelector('.carousel-btn.next');

            const root = document.documentElement;
            let visible = parseInt(getComputedStyle(root).getPropertyValue('--visible'));
            let cardWidth = parseInt(getComputedStyle(root).getPropertyValue('--card-w'));
            let gap = parseInt(getComputedStyle(root).getPropertyValue('--gap'));

            let currentIndex = 0;

            function updateButtons() {
                prevBtn.disabled = currentIndex === 0;
                nextBtn.disabled = currentIndex >= slides.length - visible;
            }

            function slideTo(index) {
                const offset = (cardWidth + gap) * index;
                track.style.transform = `translateX(-${offset}px)`;
                currentIndex = index;
                updateButtons();
            }

            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) slideTo(currentIndex - 1);
            });

            nextBtn.addEventListener('click', () => {
                if (currentIndex < slides.length - visible) slideTo(currentIndex + 1);
            });

            // Initial button state
            updateButtons();
        });
    </script>
@endpush

@extends('layouts.app')

@section('title', "FAQ's")

@push('styles')
    <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ accordion functionality
            document.querySelectorAll('.faq-toggle').forEach(button => {
                button.addEventListener('click', () => {
                    const answer = button.nextElementSibling;
                    const icon = button.querySelector('i');

                    if (answer.style.maxHeight === '0px' || !answer.style.maxHeight) {
                        answer.style.display = 'block';
                        icon.classList.remove('fa-plus');
                        icon.classList.add('fa-minus');
                        setTimeout(() => {
                            answer.style.maxHeight = answer.scrollHeight + 'px';
                            answer.style.opacity = '1';
                        }, 10);
                    } else {
                        icon.classList.remove('fa-minus');
                        icon.classList.add('fa-plus');
                        answer.style.maxHeight = '0';
                        answer.style.opacity = '0';
                        setTimeout(() => {
                            answer.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    </script>
@endpush

@section('content')
    <!-- Hero Banner -->
    <div class="container-fluid custom-bg d-flex align-items-center p-0 position-relative">
        <div class="overlay-green"></div>
        <h1 class="text-white custom-title m-0 position-relative">FAQ</h1>
    </div>

    <!-- Dynamic FAQ Section -->
    <div class="container my-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 text-center">
                <h2 class="section-title mb-4">Common Questions</h2>
                <p class="lead text-muted">Get answers to frequently asked questions about our golf club.</p>
            </div>
        </div>

        <!-- Dynamic FAQ Content -->
        <div class="row g-4 justify-content-center">
            @foreach ($faqCategories as $categoryName => $faqs)
                @if ($faqs->count() > 0)
                    @php
                        $firstFaq = $faqs->first();
                    @endphp
                    <div class="col-lg-6 mb-4">
                        <div class="faq-card shadow-sm rounded-4 overflow-hidden h-100">
                            <div class="faq-header p-4 d-flex align-items-center">
                                @if ($firstFaq->icon)
                                    <img src="{{ $firstFaq->getIconUrl() }}" alt="{{ $categoryName }} icon"
                                        class="faq-icon me-3"
                                        style="width: 32px; height: 32px; filter: brightness(0) invert(1);">
                                @else
                                    <!-- Fallback to default icon or nothing -->
                                    <div class="icon-placeholder me-3" style="width: 32px; height: 32px;"></div>
                                @endif
                                <h4 class="m-0 fw-bold text-white" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                                    {{ $categoryName }}</h4>
                            </div>
                            <div class="p-4">
                                @foreach ($faqs as $faq)
                                    <div class="faq-item mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                        <button
                                            class="faq-toggle w-100 text-start d-flex justify-content-between align-items-center p-0 bg-transparent border-0">
                                            <span class="fw-semibold text-dark">{{ $faq->question }}</span>
                                            <i class="fas fa-plus text-grass"></i>
                                        </button>
                                        <div class="faq-answer mt-2"
                                            style="display: none; max-height: 0; opacity: 0; transition: all 0.3s ease;">
                                            <p class="text-muted mb-0">{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- QR Feedback Section (Keep existing) -->
        <div class="top_caption my-5 text-center">
            <h2 class="top-title mb-3">SHARE YOUR EXPERIENCE WITH US!</h2>
            <h3 class="scan_here mb-4">Scan the QR codes below at various locations</h3>
        </div>

        @if (isset($qrFaqs) && count($qrFaqs) > 0)
            <!-- QR Cards -->
            <div class="container mb-5 text-center">
                <div class="row g-4 justify-content-center">
                    @foreach ($qrFaqs as $faq)
                        <!-- Changed from $faqs to $qrFaqs -->
                        <div class="col-md-3 col-sm-6">
                            <div class="qr-card shadow h-100 rounded-4 p-4">
                                @if ($faq->faq_image)
                                    <img src="{{ asset('images/FAQ/' . $faq->faq_image) }}" class="img-fluid rounded-3 mb-3"
                                        alt="{{ $faq->faq_title }}" style="height: 180px; object-fit: cover;">
                                @endif
                                <div class="card-body text-center p-0">
                                    @if ($faq->faq_icon_class)
                                        <i class="{{ $faq->faq_icon_class }} fs-1 text-grass mb-3 d-block"></i>
                                    @endif
                                    <h5 class="fw-bold mb-2" style="text-transform: uppercase; color: #107039;">
                                        {{ $faq->faq_title }}
                                    </h5>
                                    <p class="small text-muted">Scan to provide feedback</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Contact Info -->
        <div class="row mt-5 pt-5">
            <div class="col-lg-8 mx-auto text-center">
                <div class="contact-cta p-5 rounded-4 shadow-sm border">
                    <h3 class="mb-3" style="color: #107039;">Need More Information?</h3>
                    <p class="mb-4 text-muted">Visit the Club Office or call us during business hours.</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <div class="contact-item p-3 rounded-3 bg-light">
                            <i class="fas fa-phone-alt fa-2x text-grass mb-2"></i>
                            <h5 class="mb-1">Phone</h5>
                            <p class="mb-0 text-muted">(123) 456-7890</p>
                        </div>
                        <div class="contact-item p-3 rounded-3 bg-light">
                            <i class="fas fa-clock fa-2x text-grass mb-2"></i>
                            <h5 class="mb-1">Hours</h5>
                            <p class="mb-0 text-muted">Mon-Sun: 6AM-10PM</p>
                        </div>
                        <div class="contact-item p-3 rounded-3 bg-light">
                            <i class="fas fa-map-marker-alt fa-2x text-grass mb-2"></i>
                            <h5 class="mb-1">Location</h5>
                            <p class="mb-0 text-muted">1 Golf Club Drive</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

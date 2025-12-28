@extends('layouts.app')

@section('title', "FAQ's")

@push('styles')
    <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .faq-document-item {
            transition: all 0.2s ease;
            border-radius: 8px;
        }

        .faq-document-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .document-icon {
            width: 40px;
            height: 40px;
            background: #f0f7ff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .document-link {
            color: #107039;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .document-link:hover {
            background: #e9f7ef;
            color: #0a4d23;
        }

        .download-badge {
            background: #107039;
            color: white;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            margin-left: 10px;
        }

        .faq-header {
            background: linear-gradient(135deg, #107039 0%, #1b5e20 100%);
            padding: 20px;
        }

        .faq-card {
            border: 1px solid #e0e0e0;
            transition: transform 0.3s ease;
        }

        .faq-card:hover {
            transform: translateY(-5px);
        }

        .category-title {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            margin: 0;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Banner -->
    <div class="container-fluid custom-bg d-flex align-items-center p-0 position-relative">
        <div class="overlay-green"></div>
        <h1 class="text-white custom-title m-0 position-relative">FAQ</h1>
    </div>

    <!-- Dynamic FAQ Documents Section -->
    <div class="container my-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 text-center">
                <h2 class="section-title mb-4">Frequently Asked Questions</h2>
                <p class="lead text-muted">Download documents for frequently asked questions about our golf club.</p>
            </div>
        </div>

        <!-- Dynamic FAQ Documents Content -->
        <div class="row g-4 justify-content-center">
            @foreach ($faqCategories as $categoryName => $documents)
                @if ($documents->count() > 0)
                    <div class="col-lg-6 mb-4">
                        <div class="faq-card shadow-sm rounded-4 overflow-hidden h-100">
                            <div class="faq-header p-4">
                                <h4 class="category-title m-0">
                                    {{ $categoryName }}
                                </h4>
                            </div>
                            <div class="p-4">
                                @foreach ($documents as $document)
                                    <div class="faq-document-item mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                        <a href="{{ $document->getDocumentUrl() }}" target="_blank" class="document-link"
                                            title="Download {{ $document->document_title }}">
                                            <div class="document-icon">
                                                <i class="fas fa-file-pdf text-danger"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <span>{{ $document->document_title }}</span>
                                                    <span class="download-badge">
                                                        <i class="fas fa-download me-1"></i>
                                                        {{ strtoupper(pathinfo($document->document_file, PATHINFO_EXTENSION)) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- QR Feedback Section (Keep existing) -->
        <div class="top_caption my-5 text-center"
            style="background: linear-gradient(to right, #1b5e20, #2e7d32, #388e3c); padding: 25px 0; width: 100vw; position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw;">
            <h2 class="top-title mb-3" style="color: white;">SHARE YOUR EXPERIENCE WITH US!</h2>
            <h3 class="scan_here mb-4" style="color: white;">Scan the QR codes below at various locations</h3>
        </div>

        @if (isset($qrFaqs) && count($qrFaqs) > 0)
            <!-- QR Cards -->
            <div class="container mb-5 text-center">
                <div class="row g-4 justify-content-center">
                    @foreach ($qrFaqs as $faq)
                        <div class="col-md-3 col-sm-6">
                            <div class="qr-card shadow h-100 rounded-4 p-4">
                                @if ($faq->faq_image)
                                    <img src="{{ $faq->getFaqImageUrl() }}" class="img-fluid rounded-3 mb-3"
                                        alt="{{ $faq->faq_title }}" style="height: 180px; object-fit: cover;">
                                @endif
                                <div class="card-body text-center p-0">
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
                            <i class="fa-solid fa-phone fa-2x text-grass mb-2"></i>
                            <h5 class="mb-1">Phone</h5>
                            <p class="mb-0 text-muted">(046) 409-1077</p>
                        </div>
                        <div class="contact-item p-3 rounded-3 bg-light">
                            <i class="fas fa-clock fa-2x text-grass mb-2"></i>
                            <h5 class="mb-1">Hours</h5>
                            <p class="mb-0 text-muted">Mon-Sun: 4:30AM-7:00PM</p>
                        </div>
                        <div class="contact-item p-3 rounded-3 bg-light">
                            <i class="fas fa-map-marker-alt fa-2x text-grass mb-2"></i>
                            <h5 class="mb-1">Location</h5>
                            <p class="mb-0 text-muted">Silang Cavite</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

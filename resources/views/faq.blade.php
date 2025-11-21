    @extends('layouts.app')

    @section('title', "FAQ's")

    @push('styles')
        <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
        <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    @endpush

    @section('content')
        <div class="container-fluid custom-bg d-flex align-items-center p-0">
            <h1 class="text-white custom-title m-0">FAQ</h1>
        </div>

        <div class="top_caption my-0 text-center">
            <h2 class="top-title">SHARE YOUR EXPERIENCE WITH US!</h2>
            <h3 class="scan_here">Scan the QR codes below</h3>
        </div>

        <div class="container my-5 text-center">
            <div class="row g-4 justify-content-center">
                @foreach ($faqs as $faq)
                    <div class="col-md-3">
                        <div class="card shadow h-100">
                            @if ($faq->faq_image)
                                <img src="{{ asset('images/FAQ/' . $faq->faq_image) }}" class="card-img-top"
                                    alt="{{ $faq->faq_title }}" style="height: 300px;">
                            @endif
                            <div class="card-body text-center">
                                @if ($faq->faq_icon_class)
                                    <i class="{{ $faq->faq_icon_class }} fs-1 custom_icon"></i>
                                @endif
                                <h5 class="mt-3 fw-bold custom_text" style="text-transform: uppercase;">
                                    {{ $faq->faq_title }}
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection

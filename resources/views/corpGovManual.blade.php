@extends('layouts.app')

@section('title', 'Manual On Corporate Governance')

@push('styles')
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <link href="{{ asset('css/repetitiveDocs.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CORPORATE GOVERNANCE</h1>
    </div>

    <div class="custom-bg-wrapper py-5">
        <div class="container">
            <h2 class="custom-label text-center text-white">MANUAL ON CORPORATE GOVERNANCE</h2>
            <div class="viewer-page">
                <div class="pdf-card">
                    <div class="pdf-wrapper">
                        <!-- Embed PDF.js viewer -->
                        <iframe
                            src="{{ asset('pdfjs/web/viewer.html') }}?file={{ asset('documents/RGCI-ManualOnCorporateGovernance_2021.pdf') }}"
                            width="100%" height="1000" style="border:none;">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        /* CSS */
        .custom-label {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            display: block;
            color: #107039;
            font-family: "Anton", Arial, sans-serif;
            font-size: 3rem !important
        }

        .viewer-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            background: #f5f7fa;
            box-sizing: border-box;
        }

        .pdf-card {
            width: 100%;
            max-width: 1000px;
            height: auto;
            max-height: 1500px;
            /* prevents it from getting taller than screen */
            /* pick a fixed size */
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .pdf-wrapper {
            flex: 1;
            height: 80vh;
            /* controls visible doc height */
        }

        .pdf-frame {
            width: 100%;
            height: 100%;
            border: none;
        }

        @media (max-width: 479px) {
            body .custom-label {
                font-size: 2rem !important;
            }
        }
    </style>
@endsection

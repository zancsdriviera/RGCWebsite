@extends('layouts.app')

@section('title', 'Rates - Peak Season')

@push('styles')
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <link href="{{ asset('css/rates.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">RATES</h1>
    </div>

    <section class="rates-section my-5">
        <div class="container">
            <!-- First Content -->
            <div class="text-center mb-4">
                <h3 class="rates-title">RIVIERA GOLF CLUB INC.</h3>
                <h2 class="rates-heading">GOLF RATES</h2>
                <p class="rates-sub">PEAK SEASON (NOVEMBER - MARCH 2025)</p>
            </div>

            <div class="row gx-4 justify-content-center">
                @foreach ($firstGpeaks as $gpeak)
                    <div class="col-12 col-md-6 col-lg-5 mb-4">
                        <article class="rate-card">
                            <div class="rate-badge" style="text-transform: uppercase;"><strong>{{ $gpeak->title1 }}</strong>
                            </div>
                            <div class="price-bar">
                                <div class="price">₱{{ number_format($gpeak->total1, 2) }}</div>
                            </div>
                            <div class="rate-body">
                                <ul class="mb-2" style="padding-left: 0px; list-style-type: disc;">
                                    @php
                                        $bodies = preg_split('/\r\n|\r|\n/', $gpeak->body1 ?? '');
                                        $prices = preg_split('/\r\n|\r|\n/', $gpeak->price1 ?? '');
                                    @endphp
                                    @foreach ($bodies as $index => $body)
                                        @if (trim($body) != '')
                                            <li style="display:flex; justify-content:space-between; align-items:center;">
                                                <span>{{ trim($body) }}</span>
                                                <span>₱{{ number_format((float) ($prices[$index] ?? 0), 2) }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="rate-cta">
                                    <button class="btn-ghost"
                                        style="text-transform: uppercase;">{{ $gpeak->sched1 }}</button>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <!-- Second Content -->
            <div class="container mt-5">
                <div class="text-center mb-4">
                    <h3 class="rates-title">SENIOR DISCOUNT</h3>
                    <p class="rates-sub1">50% SENIOR DISCOUNT ON GREEN FEES APPLICABLE ON WEEKDAYS ONLY FOR GUESTS WITH
                        SENIOR CARE ID/FPASGI ACCOMPANIED BY MEMBER ONLY.</p>
                </div>
                <br>

                <div class="row gx-4 justify-content-center">
                    @foreach ($secondGpeaks as $gpeak)
                        <div class="col-12 col-md-6 col-lg-5 mb-5">
                            <article class="rate-card">
                                <div class="rate-badge2">{{ $gpeak->title2 }}<br>{{ $gpeak->paragraph2 }}</div>
                                <div class="price-bar">
                                    <div class="price">₱ {{ number_format($gpeak->total2, 2) }}</div>
                                </div>
                                <div class="rate-body">
                                    <ul class="mb-2" style="padding-left: 0px; list-style-type: disc;">
                                        @php
                                            $bodies = preg_split('/\r\n|\r|\n/', $gpeak->body2 ?? '');
                                            $prices = preg_split('/\r\n|\r|\n/', $gpeak->price2 ?? '');
                                        @endphp
                                        @foreach ($bodies as $index => $body)
                                            @if (trim($body) != '')
                                                <li
                                                    style="display:flex; justify-content:space-between; align-items:center;">
                                                    <span>{{ trim($body) }}</span>
                                                    <span>₱{{ number_format((float) ($prices[$index] ?? 0), 2) }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div class="rate-cta">
                                        <button class="btn-ghost">{{ $gpeak->sched2 }}</button>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Third Content -->
            <div class="container mt-5">
                <div class="row gx-4 justify-content-center">
                    @foreach ($thirdGpeaks as $gpeak)
                        <div class="col-12 col-md-6 col-lg-5 mb-5">
                            <article class="rate-card" style="max-height: 90%;">
                                <div class="rate-badge2" style="text-transform: uppercase;">{{ $gpeak->title3 }}</div>
                                <br>
                                <div class="rate-body">
                                    <ul class="mb-2" style="padding-left: 0px; list-style-type: disc;">
                                        @php
                                            $bodies = preg_split('/\r\n|\r|\n/', $gpeak->body3 ?? '');
                                            $prices = preg_split('/\r\n|\r|\n/', $gpeak->price3 ?? '');
                                        @endphp
                                        @foreach ($bodies as $index => $body)
                                            @if (trim($body) != '')
                                                <li
                                                    style="display:flex; justify-content:space-between; align-items:center;">
                                                    <span>{{ trim($body) }}</span>
                                                    <span>₱{{ number_format((float) ($prices[$index] ?? 0), 2) }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <p class="rate-sub" style="text-transform: uppercase; text-align: center;">
                                        {{ $gpeak->paragraph3 }}</p>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

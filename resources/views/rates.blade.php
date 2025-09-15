@extends('layouts.app')

@section('title', 'Rates -Lean Season')

@push('styles')
    <link href="{{ asset('css/rates.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">RATES</h1>
    </div>

    <!-- Golf Rates Section -->
    <section class="rates-section my-5">
        <div class="container">
            <div class="text-center mb-4">
                <h3 class="rates-title">RIVIERA GOLF CLUB INC.</h3>
                <h2 class="rates-heading">GOLF RATES</h2>
                <p class="rates-sub">LEAN SEASON (APRIL - OCTOBER 2025)</p>
            </div>

            <div class="row gx-4 justify-content-center ">
                <!-- Card A -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="rate-card">
                        <div class="rate-badge">REGULAR<br>WEEKDAY</div>

                        <div class="price-bar">
                            <div class="price">₱3,070.00</div>
                        </div>

                        <div class="rate-body">
                            <ul class="fee-list">
                                <li><span class="fee-label">Green Fee</span><span class="fee-amount">₱ 2,500.00</span>
                                </li>
                                <li><span class="fee-label">F&B Consumable</span><span class="fee-amount">₱
                                        350.00</span></li>
                                <li><span class="fee-label">Hole-In-One Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Sports Devt Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Golfer's Environmental Fee</span><span class="fee-amount">₱
                                        20.00</span></li>
                            </ul>

                            <div class="rate-cta">
                                <button class="btn-ghost">BEFORE 9AM</button>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Card B -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="rate-card">
                        <div class="rate-badge">REGULAR<br>WEEKDAY</div>

                        <div class="price-bar">
                            <div class="price">₱2,420.00</div>
                        </div>

                        <div class="rate-body">
                            <ul class="fee-list">
                                <li><span class="fee-label">Green Fee</span><span class="fee-amount">₱ 1,850.00</span>
                                </li>
                                <li><span class="fee-label">F&B Consumable</span><span class="fee-amount">₱
                                        350.00</span></li>
                                <li><span class="fee-label">Hole-In-One Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Sports Devt Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Golfer's Environmental Fee</span><span class="fee-amount">₱
                                        20.00</span></li>
                            </ul>

                            <div class="rate-cta">
                                <button class="btn-ghost">AFTER 9AM</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="text-center mb-4">
                <h3 class="rates-title">SENIOR DISCOUNT</h3>
                <p class="rates-sub1">50% SENIOR DISCOUNT ON GREEN FEES APPLICABLE ON WEEKDAYS ONLY FOR GUESTS WITH
                    SENIOR CARE ID/FPASGI ACCOMPANIED BY MEMBER ONLY.</p>
            </div>

            <div class="row gx-4 justify-content-center ">
                <!-- Card A -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="rate-card">
                        <div class="rate-badge2">REGULAR WEEKDAY<br>WITH SENIOR CARE/FPASGI ID</div>

                        <div class="price-bar">
                            <div class="price">₱1,820.00</div>
                        </div>

                        <div class="rate-body">
                            <ul class="fee-list">
                                <li><span class="fee-label">Green Fee</span><span class="fee-amount">₱ 1,250.00</span>
                                </li>
                                <li><span class="fee-label">F&B Consumable</span><span class="fee-amount">₱
                                        350.00</span></li>
                                <li><span class="fee-label">Hole-In-One Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Sports Devt Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Golfer's Environmental Fee</span><span class="fee-amount">₱
                                        20.00</span></li>
                            </ul>

                            <div class="rate-cta">
                                <button class="btn-ghost">BEFORE 9AM</button>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Card B -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="rate-card">
                        <div class="rate-badge2">REGULAR WEEKDAY<br>WITH SENIOR CARE/FPASGI ID</div>

                        <div class="price-bar">
                            <div class="price">₱1,495.00</div>
                        </div>

                        <div class="rate-body">
                            <ul class="fee-list">
                                <li><span class="fee-label">Green Fee</span><span class="fee-amount">₱ 925.00</span>
                                </li>
                                <li><span class="fee-label">F&B Consumable</span><span class="fee-amount">₱
                                        350.00</span></li>
                                <li><span class="fee-label">Hole-In-One Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Sports Devt Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Golfer's Environmental Fee</span><span class="fee-amount">₱
                                        20.00</span></li>
                            </ul>

                            <div class="rate-cta">
                                <button class="btn-ghost">AFTER 9AM</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row gx-4 justify-content-center ">
                <!-- Card A -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="rate-card">
                        <div class="rate-badge">WEEKEND/<br>HOLIDAY</div>

                        <div class="price-bar">
                            <div class="price">₱4,570.00</div>
                        </div>

                        <div class="rate-body">
                            <ul class="fee-list">
                                <li><span class="fee-label">Green Fee</span><span class="fee-amount">₱ 4,000.00</span>
                                </li>
                                <li><span class="fee-label">F&B Consumable</span><span class="fee-amount">₱
                                        350.00</span></li>
                                <li><span class="fee-label">Hole-In-One Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Sports Devt Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Golfer's Environmental Fee</span><span class="fee-amount">₱
                                        20.00</span></li>
                            </ul>

                            <div class="rate-cta">
                                <button class="btn-ghost">BEFORE 9AM</button>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Card B -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="rate-card">
                        <div class="rate-badge">WEEKEND/<br>HOLIDAY</div>

                        <div class="price-bar">
                            <div class="price">₱3,620.00</div>
                        </div>

                        <div class="rate-body">
                            <ul class="fee-list">
                                <li><span class="fee-label">Green Fee</span><span class="fee-amount">₱3,050.00</span>
                                </li>
                                <li><span class="fee-label">F&B Consumable</span><span class="fee-amount">₱
                                        350.00</span></li>
                                <li><span class="fee-label">Hole-In-One Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Sports Devt Fund</span><span class="fee-amount">₱
                                        100.00</span></li>
                                <li><span class="fee-label">Golfer's Environmental Fee</span><span class="fee-amount">₱
                                        20.00</span></li>
                            </ul>

                            <div class="rate-cta">
                                <button class="btn-ghost">AFTER 9AM</button>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Cart A -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="cart-card">
                        <div class="cart-badge">GOLF CART RENTAL<br>(MEMBER)</div>

                        <div class="cart-rate-body">
                            <ul class="cart-fee-list">
                                <li><span class="cart-fee-label">Cart 18H</span><span
                                        class="cart-fee-amount">₱800.00</span>
                                </li>
                                <li><span class="cart-fee-label">Cart - Senior 18H</span><span class="cart-fee-amount">₱
                                        600.00</span></li>
                                <li><span class="cart-fee-label">Cart Regular 9H</span><span class="cart-fee-amount">₱
                                        450.00</span></li>
                                <li><span class="cart-fee-label">Cart - Senior 9H</span><span class="cart-fee-amount">₱
                                        350.00</span></li>
                            </ul>
                            <p class="cart-sub">SENIOR DISCOUNT ON GOLF CARTS APPLICABLE ON REGULAR WEEKDAYS ONLY</p>
                        </div>

                    </article>
                </div>
                <!-- Cart B -->
                <div class="col-12 col-md-6 col-lg-5 mb-4">
                    <article class="cart-card">
                        <div class="cart-badge">GOLF CART RENTAL<br>(GUEST)</div>

                        <div class="cart-rate-body">
                            <ul class="cart-fee-list">
                                <li><span class="cart-fee-label">Cart 18H</span><span class="cart-fee-amount">₱
                                        1000.00</span>
                                </li>
                                <li><span class="cart-fee-label">Cart - Senior 18H</span><span class="cart-fee-amount">₱
                                        800.00</span></li>
                                <li><span class="cart-fee-label">Cart Regular 9H</span><span class="cart-fee-amount">₱
                                        550.00</span></li>
                                <li><span class="cart-fee-label">Cart - Senior 9H</span><span class="cart-fee-amount">₱
                                        450.00</span></li>
                            </ul>
                            <p class="cart-sub">SENIOR DISCOUNT ON GOLF CARTS APPLICABLE ON REGULAR WEEKDAYS ONLY FOR
                                GUEST WITH SENIOR CARE OR FPASGI ID</p>
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection

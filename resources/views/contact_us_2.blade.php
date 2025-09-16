@extends('layouts.app')

@section('title', 'Careers')

@push('styles')
    <link href="{{ asset('css/contact_us_2.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CONTACT US</h1>
    </div>

    <!-- Title section (unchanged) -->
    <div class="top_caption my-0 text-center">
        <h2 class="top-title">WE ARE HIRING</h2>
    </div>

    <div class="carousel-wrapper">
        <div class="carousel-container">
            <button class="carousel-btn prev" aria-label="Previous">&#10094;</button>

            <div class="carousel-viewport">
                <div class="carousel-track">
                    <!-- Duplicate this article as many times as you need -->
                    <article class="job-card">
                        <header class="jc-header">
                            <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera logo" class="jc-logo">
                            <div class="jc-title">
                                <h1>WE ARE HIRING</h1>
                                <p>We're looking for someone to join our company as a</p>
                                <div class="position-pill">
                                    <svg viewBox="0 0 24 24" class="mag" aria-hidden="true">
                                        <path
                                            d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 1 0 14 15.5l.27.28v.79L20 21.49 21.49 20 15.5 14z" />
                                    </svg>
                                    <span>INTERNAL AUDIT MANAGER</span>
                                </div>
                            </div>
                        </header>

                        <section class="qualifications">
                            <h2>Qualifications:</h2>
                            <div class="qual-grid">
                                <ul>
                                    <li>Graduate of Bachelor's Degree in Accountancy</li>
                                    <li>Must be a Certified Public Accountant (CPA) with an updated PRC license</li>
                                    <li>Proven work experience as an Internal Audit Manager</li>
                                    <li>Excellent written and communication skills</li>
                                </ul>
                                <ul>
                                    <li>Flexibility to work on weekends</li>
                                    <li>Strong leadership skills</li>
                                    <li>Must be able to multitask and can adapt to fast paced environment</li>
                                    <li>Computer literate</li>
                                    <li>Can start ASAP</li>
                                </ul>
                            </div>
                        </section>

                        <section class="apply">
                            <p class="call">If you have the skills and experience required, we want to hear from you!
                            </p>
                            <p class="email">recruitment@rivieragolfclub.ph</p>
                            <div class="apply-now">
                                <a href="mailto:recruitment@rivieragolfclub.ph">APPLY NOW!</a>
                            </div>

                        </section>
                    </article>
                    <article class="job-card">
                        <header class="jc-header">
                            <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera logo" class="jc-logo">
                            <div class="jc-title">
                                <h1>WE ARE HIRING</h1>
                                <p>We're looking for someone to join our company as a</p>
                                <div class="position-pill">
                                    <svg viewBox="0 0 24 24" class="mag" aria-hidden="true">
                                        <path
                                            d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 1 0 14 15.5l.27.28v.79L20 21.49 21.49 20 15.5 14z" />
                                    </svg>
                                    <span>ACCOUNTANT</span>
                                </div>
                            </div>
                        </header>

                        <section class="qualifications">
                            <h2>Qualifications:</h2>
                            <div class="qual-grid">
                                <ul>
                                    <li>Graduate of Bachelor's Degree in Accountancy</li>
                                    <li>Must be a Certified Public Accountant (CPA) with an updated PRC license</li>
                                    <li>Prior work experience as an Chief Accountant or in a related capacity.</li>
                                    <li>Excellent written and communication skills</li>
                                </ul>
                                <ul>
                                    <li>Flexibility to work on weekends</li>
                                    <li>Strong leadership skills</li>
                                    <li>Must be able to multitask and can adapt to fast paced environment</li>
                                    <li>Computer literate</li>
                                    <li>Can start ASAP</li>
                                </ul>
                            </div>
                        </section>
                        <section class="apply">
                            <p class="call">If you have the skills and experience required, we want to hear from you!
                            </p>
                            <p class="email">recruitment@rivieragolfclub.ph</p>
                            <div class="apply-now">
                                <a href="mailto:recruitment@rivieragolfclub.ph">APPLY NOW!</a>
                            </div>
                        </section>
                    </article>
                    <article class="job-card">
                        <header class="jc-header">
                            <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera logo" class="jc-logo">
                            <div class="jc-title">
                                <h1>WE ARE HIRING</h1>
                                <p>We're looking for someone to join our company as a</p>
                                <div class="position-pill">
                                    <svg viewBox="0 0 24 24" class="mag" aria-hidden="true">
                                        <path
                                            d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 1 0 14 15.5l.27.28v.79L20 21.49 21.49 20 15.5 14z" />
                                    </svg>
                                    <span>IT PROGRAMMER</span>
                                </div>
                            </div>
                        </header>

                        <section class="qualifications">
                            <h2>Qualifications:</h2>
                            <div class="qual-grid">
                                <ul>
                                    <li>Graduate of Bachelor's Degree in Information Technology, Computer Science,
                                        Computer Engineering, or any IT-related course.</li>
                                    <li>Can install maintain configure hardware or software systems according to
                                        policies standards;</li>
                                    <li>.NET developer with experience in API's Front End and Back End development.</li>
                                    <li>Have knowledge in Crystal Report, MySQL or SQL Server.</li>
                                    <li>With at least 2 years programming experience.</li>
                                </ul>
                                <ul>
                                    <li>Excellent knowledge of hardware, software, and network systems.</li>
                                    <li>Highly analytical and detail-oriented.</li>
                                    <li>Strong leadership and communication skills.</li>
                                    <li>Willing to work on weekends, holidays and shifting schedules.</li>
                                    <li>Can start ASAP and willing to work in Silang, Cavite.</li>
                                </ul>
                            </div>
                        </section>

                        <section class="apply">
                            <p class="call">If you have the skills and experience required, we want to hear from you!
                            </p>
                            <p class="email">recruitment@rivieragolfclub.ph</p>
                            <div class="apply-now">
                                <a href="mailto:recruitment@rivieragolfclub.ph">APPLY NOW!</a>
                            </div>

                        </section>
                    </article>
                    <article class="job-card">
                        <header class="jc-header">
                            <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Riviera logo" class="jc-logo">
                            <div class="jc-title">
                                <h1>WE ARE HIRING</h1>
                                <p>We're looking for someone to join our company as a</p>
                                <div class="position-pill">
                                    <svg viewBox="0 0 24 24" class="mag" aria-hidden="true">
                                        <path
                                            d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 1 0 14 15.5l.27.28v.79L20 21.49 21.49 20 15.5 14z" />
                                    </svg>
                                    <span>INTERNAL AUDIT MANAGER</span>
                                </div>
                            </div>
                        </header>

                        <section class="qualifications">
                            <h2>Qualifications:</h2>
                            <div class="qual-grid">
                                <ul>
                                    <li>Graduate of Bachelor's Degree in Accountancy</li>
                                    <li>Certified Public Accountant (CPA)</li>
                                    <li>Proven work experience</li>
                                    <li>Excellent communication skills</li>
                                </ul>
                                <ul>
                                    <li>Flexibility to work weekends</li>
                                    <li>Strong leadership skills</li>
                                    <li>Can multitask & adapt</li>
                                    <li>Can start ASAP</li>
                                </ul>
                            </div>
                        </section>

                        <section class="apply">
                            <p class="call">If you have the skills and experience required, we want to hear from you!
                            </p>
                            <p class="email">recruitment@rivieragolfclub.ph</p>
                            <div class="apply-now">
                                <a href="mailto:recruitment@rivieragolfclub.ph">APPLY NOW!</a>
                            </div>

                        </section>
                    </article>
                </div>
            </div>

            <button class="carousel-btn next" aria-label="Next">&#10095;</button>
        </div>
    </div>
@endsection

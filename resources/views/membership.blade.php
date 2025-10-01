@extends('layouts.app')

@section('title', 'Membership')

@push('styles')
    <link href="{{ asset('css/membership.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">MEMBERSHIP</h1>
    </div>

    <div class="top_caption my-0 text-center">
        <h2 class="top-title">CLICK TO DOWNLOAD THE PDF</h2>
    </div>

    <div class="bullet_container my-4">
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-5">
            <!-- First group -->
            <ul class="list-unstyled text-start m-0">
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/endorsement-letter.pdf" target="_blank">Endorsement Letter</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/undertaking-update.pdf" target="_blank">Letter Of Undertaking Information
                        Update</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/membership-info.pdf" target="_blank">Membership Information Form</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/corporate-nominee.pdf" target="_blank">Change Of Corporate Nominee</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/lost-stock-cert.pdf" target="_blank">Lost Stock Certificate Requirements</a>
                </li>
            </ul>

            <!-- Second group -->
            <ul class="list-unstyled text-start m-0">
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/playing-rights-filipino.pdf" target="_blank">Playing Rights (Filipino)</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/playing-rights-foreign.pdf" target="_blank">Playing Rights (Foreign)</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/lateral-transfer.pdf" target="_blank">Lateral Transfer</a>
                </li>
                <li>
                    <i class="bi bi-download me-2"></i>
                    <a href="/downloads/transfer-of-share.pdf" target="_blank">Transfer Of Share</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center gx-2">
            <!-- Column 1 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <h2 class="bot-title">MEMBERSHIP APPLICANTS</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel-wrapper">
        <div class="carousel-container">
            <button class="carousel-btn prev" aria-label="Previous">&#10094;</button>
            <div class="carousel-viewport">
                <div class="carousel-track">
                    <!-- header + title -->
                    <section class="members-page">
                        <header class="members-header">
                            <!-- replace SVG with a single image (SVG/PNG) -->
                            <img class="header-wave" src="{{ asset('images/wavy.png') }}" alt="" aria-hidden="true">
                            <!-- logo badge top-right -->
                            <div class="club-logo">
                                <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Club Logo">
                            </div>
                        </header>
                        <!-- title block -->
                        <div class="title-block">
                            <h1 class="page-title">MEMBERSHIP APPLICANTS</h1>
                            <div class="title-underline"></div>
                        </div>

                        <!-- two-column grid of cards (duplicate .app-card) -->
                        <div class="cards-grid">
                            <!-- single card -->
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                        </div>
                        <!-- bottom footer stripe -->
                        <div class="page-footer"></div>
                    </section>
                    <section class="members-page">
                        <header class="members-header">
                            <!-- replace SVG with a single image (SVG/PNG) -->
                            <img class="header-wave" src="{{ asset('images/wavy.png') }}" alt=""
                                aria-hidden="true">
                            <!-- logo badge top-right -->
                            <div class="club-logo">
                                <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Club Logo">
                            </div>
                        </header>
                        <!-- title block -->
                        <div class="title-block">
                            <h1 class="page-title">MEMBERSHIP APPLICANTS</h1>
                            <div class="title-underline"></div>
                        </div>

                        <!-- two-column grid of cards (duplicate .app-card) -->
                        <div class="cards-grid">
                            <!-- single card -->
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                        </div>
                        <!-- bottom footer stripe -->
                        <div class="page-footer"></div>
                    </section>
                    <section class="members-page">
                        <header class="members-header">
                            <!-- replace SVG with a single image (SVG/PNG) -->
                            <img class="header-wave" src="{{ asset('images/wavy.png') }}" alt=""
                                aria-hidden="true">
                            <!-- logo badge top-right -->
                            <div class="club-logo">
                                <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Club Logo">
                            </div>
                        </header>
                        <!-- title block -->
                        <div class="title-block">
                            <h1 class="page-title">MEMBERSHIP APPLICANTS</h1>
                            <div class="title-underline"></div>
                        </div>

                        <!-- two-column grid of cards (duplicate .app-card) -->
                        <div class="cards-grid">
                            <!-- single card -->
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                        </div>
                        <!-- bottom footer stripe -->
                        <div class="page-footer"></div>
                    </section>
                    <section class="members-page">
                        <header class="members-header">
                            <!-- replace SVG with a single image (SVG/PNG) -->
                            <img class="header-wave" src="{{ asset('images/wavy.png') }}" alt=""
                                aria-hidden="true">
                            <!-- logo badge top-right -->
                            <div class="club-logo">
                                <img src="{{ asset('images/REVISED LOGO.png') }}" alt="Club Logo">
                            </div>
                        </header>
                        <!-- title block -->
                        <div class="title-block">
                            <h1 class="page-title">MEMBERSHIP APPLICANTS</h1>
                            <div class="title-underline"></div>
                        </div>

                        <!-- two-column grid of cards (duplicate .app-card) -->
                        <div class="cards-grid">
                            <!-- single card -->
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                            <article class="app-card">
                                <div class="avatar-wrap">
                                    <img src="{{ asset('images//user.png') }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <p class="label"><span class="key">NAME:</span> <span class="val">LOREM
                                            IPSUM</span></p>
                                    <p class="meta"><span class="key">COMPANY:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">POSITION:</span> LOREM IPSUM</p>
                                    <p class="meta"><span class="key">AGE:</span> 0</p>
                                </div>
                            </article>
                        </div>
                        <!-- bottom footer stripe -->
                        <div class="page-footer"></div>
                    </section>
                </div>
            </div>
            <button class="carousel-btn next" aria-label="Next">&#10095;</button>
        </div>
    </div>
    <div class="container-fluid my-0 banks_container">
        <div class="row justify-content-center text-center gx-2">
            <!-- Column 1 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="bank-column w-100">
                    <img src="{{ asset('images/MEMBERSHIP/BPI.png') }}" alt="Top Image 1"
                        class="card-img custom-card-img-top mb-3">
                    <p class="mb-3 bank-title bpi">BPI PAY BILLS PROCEDURE</p>
                    <img src="{{ asset('images/MEMBERSHIP/BPI_QR.png') }}" alt="Bottom Image 1"
                        class="card-img custom-card-img">
                </div>
            </div>

            <!-- Column 2 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="bank-column w-100">
                    <img src="{{ asset('images/MEMBERSHIP/BDO.png') }}" alt="Top Image 2"
                        class="card-img custom-card-img-top mb-3">
                    <p class="mb-3 bank-title bdo">BDO PAY BILLS PROCEDURE</p>
                    <img src="{{ asset('images/MEMBERSHIP/BDO_QR.png') }}" alt="Bottom Image 2"
                        class="card-img custom-card-img">
                </div>
            </div>
        </div>
    </div>
@endsection

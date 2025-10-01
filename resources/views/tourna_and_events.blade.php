@extends('layouts.app')

@section('title', 'Tournament & Events')

@push('styles')
    <link href="{{ asset('css/tourna_and_events.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">TOURNAMENT AND EVENTS</h1>
    </div>

    <!-- Carousel + right-side placeholder -->
    <div class="carousel-row g-0">
        <!-- LEFT: carousel (75% width) -->
        <div class="carousel-left">
            <div id="leftCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <!-- Item 1 -->
                    <div class="carousel-item active">
                        <img src="{{ asset('images/IMG1.jpg') }}" class="d-block w-100 carousel-img" alt="Langer Course"
                            data-bs-toggle="modal" data-bs-target="#tournamentModal1">
                    </div>

                    <!-- Item 2 -->
                    <div class="carousel-item">
                        <img src="{{ asset('images/IMG2.jpg') }}" class="d-block w-100 carousel-img" alt="Couples Course"
                            data-bs-toggle="modal" data-bs-target="#tournamentModal2">
                    </div>

                    <!-- Item 3 -->
                    <div class="carousel-item">
                        <img src="{{ asset('images/IMG1.jpg') }}" class="d-block w-100 carousel-img" alt="Another Event"
                            data-bs-toggle="modal" data-bs-target="#tournamentModal3">
                    </div>
                </div>

                <!-- Prev / Next buttons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#leftCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#leftCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- RIGHT: Previous Events (25% width) -->
        <div class="col-md-3 d-flex flex-column" style="height: 700px;">
            <!-- Normal Label -->
            <h4 class="text-center mb-3 right_part_txt">PREVIOUS EVENTS</h4>

            <!-- Images stacked and filling height -->
            <div class="d-flex flex-column flex-grow-1 previous-events">
                <img src="{{ asset('images/IMG1.jpg') }}" alt="Event 1" class="img-fluid flex-fill mb-3">
                <img src="{{ asset('images/IMG2.jpg') }}" alt="Event 2" class="img-fluid flex-fill">
            </div>
        </div>
    </div>


    <!-- -------------------------
                                                                                                                             Modal 1 (unique content)
                                                                                                                             ------------------------- -->
    <div class="modal fade" id="tournamentModal1" tabindex="-1" aria-labelledby="tournamentModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content tournament-modal">

                <!-- custom close (top-right) -->
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">✕</button>

                <div class="modal-body p-4">
                    <h2 class="modal-title">TOURNAMENT DETAILS</h2>

                    <div class="modal-divider"></div>

                    <div class="row mt-4 align-items-start gx-4">
                        <!-- left details -->
                        <div class="col-lg-8">
                            <div class="info-block mb-3">
                                <h6 class="info-heading">Fee:</h6>
                                <p class="info-text">₱ 1,500.00<br><small>(Inclusive of Giveaways and Teahouse
                                        Snacks)</small></p>
                            </div>

                            <div class="info-block mb-3">
                                <h6 class="info-heading">Divisions:</h6>
                                <p class="info-text">
                                    Championship<br>
                                    Men’s A, B1, B2, C1 &amp; C2<br>
                                    Seniors 1 &amp; Seniors 2<br>
                                    S. Seniors 1 &amp; S. Seniors 2<br>
                                    Ladies 1 &amp; Ladies 2
                                </p>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <div class="info-block mb-3">
                                        <h6 class="info-heading">Each Participants May Choose to Play On:</h6>
                                        <p class="info-text">
                                            Friday (Aug. 15) And Saturday (Aug. 16)<br>
                                            Friday (Aug. 16) And Sunday (Aug. 17)<br>
                                            Saturday (Aug. 16) And Sunday (Aug. 17)
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-block short mb-3">
                                        <h6 class="info-heading">Format:</h6>
                                        <p class="info-text">36-Hole Individual Stroke Playing</p>
                                    </div>
                                    <div class="info-block short">
                                        <h6 class="info-heading">Tee-Off:</h6>
                                        <p class="info-text">6:00 AM Sequential</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="{{ asset('documents/RGCI-Definitive_2025.pdf') }}" target="_blank"
                                    class="terms-link">
                                    <i class="bi bi-eye"></i>
                                    <span>Click here to view the Terms of Competition</span>
                                </a>
                            </div>

                        </div>

                        <!-- right QR -->
                        <div class="col-lg-4 text-center">
                            <div class="qr-wrap">
                                <img src="{{ asset('images/QR_FORM.png') }}" alt="QR Code" class="qr-img img-fluid">
                            </div>
                            <p class="qr-label mt-2">SCAN QR TO REGISTER</p>
                        </div>
                    </div>
                </div>

                <!-- green bottom bar -->
                <div class="modal-bottom-bar"></div>
            </div>
        </div>
    </div>


    <!-- -------------------------
                                                                                                                             Modal 2
                                                                                                                             ------------------------- -->
    <div class="modal fade" id="tournamentModal2" tabindex="-1" aria-labelledby="tournamentModal2Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content tournament-modal">
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">✕</button>

                <div class="modal-body p-4">
                    <h2 class="modal-title">TOURNAMENT DETAILS</h2>
                    <div class="modal-divider"></div>

                    <div class="row mt-4 gx-4">
                        <div class="col-lg-8">
                            <div class="info-block mb-3">
                                <h6 class="info-heading">Fee:</h6>
                                <p class="info-text">₱ 2,000.00<br><small>(Includes giveaways)</small></p>
                            </div>

                            <div class="info-block mb-3">
                                <h6 class="info-heading">Divisions:</h6>
                                <p class="info-text">Open Category<br>Juniors<br>Seniors</p>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <div class="info-block mb-3">
                                        <h6 class="info-heading">Each Participants May Choose to Play On:</h6>
                                        <p class="info-text">Friday (Aug. 15) &amp; Saturday (Aug. 16)</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-block short mb-3">
                                        <h6 class="info-heading">Format:</h6>
                                        <p class="info-text">18-Hole Best Ball</p>
                                    </div>
                                    <div class="info-block short">
                                        <h6 class="info-heading">Tee-Off:</h6>
                                        <p class="info-text">7:00 AM Shotgun</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="#" class="terms-link">
                                    <i class="bi bi-eye"></i>
                                    <span>Click here to view the Terms of Competition</span>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 text-center">
                            <div class="qr-wrap">
                                <img src="{{ asset('images/qr2.png') }}" alt="QR Code" class="qr-img img-fluid">
                            </div>
                            <p class="qr-label mt-2">SCAN QR TO REGISTER</p>
                        </div>
                    </div>
                </div>

                <div class="modal-bottom-bar"></div>
            </div>
        </div>
    </div>


    <!-- -------------------------
                                                                                                                             Modal 3
                                                                                                                             ------------------------- -->
    <div class="modal fade" id="tournamentModal3" tabindex="-1" aria-labelledby="tournamentModal3Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content tournament-modal">
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">✕</button>

                <div class="modal-body p-4">
                    <h2 class="modal-title">TOURNAMENT DETAILS</h2>
                    <div class="modal-divider"></div>

                    <div class="row mt-4 gx-4">
                        <div class="col-lg-8">
                            <div class="info-block mb-3">
                                <h6 class="info-heading">Fee:</h6>
                                <p class="info-text">₱ 1,800.00<br><small>(Includes snacks)</small></p>
                            </div>

                            <div class="info-block mb-3">
                                <h6 class="info-heading">Divisions:</h6>
                                <p class="info-text">Men’s B1, B2, C1, C2</p>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <div class="info-block mb-3">
                                        <h6 class="info-heading">Each Participants May Choose to Play On:</h6>
                                        <p class="info-text">Saturday (Aug. 16) &amp; Sunday (Aug. 17)</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-block short mb-3">
                                        <h6 class="info-heading">Format:</h6>
                                        <p class="info-text">36-Hole Match Play</p>
                                    </div>
                                    <div class="info-block short">
                                        <h6 class="info-heading">Tee-Off:</h6>
                                        <p class="info-text">5:30 AM Sequential</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="#" class="terms-link">
                                    <i class="bi bi-eye"></i>
                                    <span>Click here to view the Terms of Competition</span>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 text-center">
                            <div class="qr-wrap">
                                <img src="{{ asset('images/qr3.png') }}" alt="QR Code" class="qr-img img-fluid">
                            </div>
                            <p class="qr-label mt-2">SCAN QR TO REGISTER</p>
                        </div>
                    </div>
                </div>

                <div class="modal-bottom-bar"></div>
            </div>
        </div>
    </div>

    <!-- Divider bar -->
    <div class="section-divider"></div>

    <div class="container my-5">
        <div class="d-flex justify-content-center">
            <div class="card shadow-lg border-0" style="max-width: 600px; border-radius: 0; background: transparent;">
                <img src="{{ asset('images/AdvisoryCard.png') }}" class="card-img" alt="Club Advisory"
                    style="border-radius: 0;">
            </div>
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('title', 'Contact Us')

@push('styles')
    <link href="{{ asset('css/contact_us.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">CONTACT US</h1>
    </div>

    <div class="container-fluid my-0 contacts_container">
        <div class="row justify-content-center text-center gx-2">
            <!-- Column 1 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">

                    <img src="{{ asset('images/CONTACT_US/location.png') }}" alt="Bottom Image 1"
                        class="card-img custom-card-img">
                    <p class="contacts-title">ADDRESS</p>
                    <p class="contact-describe">RIVIERA GOLF CLUB INC.
                        BY PASS ROAD AGUINALDO HIGHWAY SILANG, CAVITE, PHILIPPINES, 4118</p>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                <div class="contacts_column w-100">
                    <img src="{{ asset('images/CONTACT_US/phone.png') }}" alt="Bottom Image 2"
                        class="card-img custom-card-img">
                    <p class="contacts-title">CONTACT NUMBER</p>
                    <p class="phoneNumber">(046) 409-1077</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Title section (unchanged) -->
    <div class="top_caption my-0 text-center">
        <h2 class="top-title">OTHER CONTACT DETAILS</h2>
    </div>

    <!-- Card container -->
    <div class="container my-4">
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-12 col-md-6 mb-4">
                <div class="contact-card shadow-sm">
                    <div class="card-header text-center">
                        MEMBERSHIP
                    </div>
                    <div class="card-body">
                        <p class="d-flex align-items-center mb-2">
                            <span class="icon-circle me-2">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <span>(0917) 188 0373</span>
                        </p>
                        <p class="d-flex align-items-center mb-0">
                            <span class="icon-circle me-2">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <span>membership@rivieragolfclub.ph</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-12 col-md-6 mb-4">
                <div class="contact-card shadow-sm">
                    <div class="card-header text-center">
                        SALES & MARKETING
                    </div>
                    <div class="card-body">
                        <p class="d-flex align-items-center mb-2">
                            <span class="icon-circle me-2">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <span>(0917) 188 0482</span>
                        </p>
                        <p class="d-flex align-items-center mb-0">
                            <span class="icon-circle me-2">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <span>marketing@rivieragolfclub.ph</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-12 col-md-6 mb-4">
                <div class="contact-card shadow-sm">
                    <div class="card-header text-center">
                        ACCOUNTING
                    </div>
                    <div class="card-body">
                        <p class="d-flex align-items-center mb-2">
                            <span class="icon-circle me-2">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <span>(0917) 188 0264</span>
                        </p>
                        <p class="d-flex align-items-center mb-0">
                            <span class="icon-circle me-2">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <span>accounting@rivieragolfclub.ph</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-12 col-md-6 mb-4">
                <div class="contact-card shadow-sm">
                    <div class="card-header text-center">
                        GOLF OPERATION
                    </div>
                    <div class="card-body">
                        <p class="d-flex align-items-center mb-2">
                            <span class="icon-circle me-2">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <span>(0917) 188 0723</span>
                        </p>
                        <p class="d-flex align-items-center mb-0">
                            <span class="icon-circle me-2">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <span>golfoperations@rivieragolfclub.ph</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-12 col-md-6 mb-4">
                <div class="contact-card shadow-sm">
                    <div class="card-header text-center">
                        HUMAN RESOURCES
                    </div>
                    <div class="card-body">
                        <p class="d-flex align-items-center mb-2">
                            <span class="icon-circle me-2">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <span>(0917) 188 0842</span>
                        </p>
                        <p class="d-flex align-items-center mb-0">
                            <span class="icon-circle me-2">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <span>recruitment@rivieragolfclub.ph</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Full-width Google Map -->
    <div class="map-container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3867.3227935694363!2d120.95206706259182!3d14.234382647037595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sRiviera%20Golf%20Club!5e0!3m2!1sen!2sph!4v1756190894108!5m2!1sen!2sph"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection

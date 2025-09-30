@extends('layouts.app')

@section('title', 'Courses')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">COURSES</h1>
    </div>

    <div class="container my-5">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-6">
                <div class="card shadow-lg border-0 h-100 text-center d-flex flex-column align-items-center">
                    <img src="{{ asset('images/COURSES/Langer.jpg') }}" class="card-img-top" alt="Card 2 Image">
                    <div class="card-body d-flex flex-column align-items-center">
                        <h5 class="card-title">Langer Course</h5>
                        <p class="card-text">This is a short description for the first card.</p>
                        <a href="{{ route('langer') }}" class="btn btn-success mt-auto custom-btn">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6">
                <div class="card shadow-lg border-0 h-100 text-center d-flex flex-column align-items-center">
                    <img src="{{ asset('images/COURSES/Couples.jpg') }}" class="card-img-top" alt="Card 1 Image">
                    <div class="card-body d-flex flex-column align-items-center">
                        <h5 class="card-title">Couples Course</h5>
                        <p class="card-text">This is a short description for the second card.</p>
                        <a href="#" class="btn btn-success mt-auto custom-btn">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

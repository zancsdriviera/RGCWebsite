@extends('layouts.app')

@section('title', 'Courses')

@push('styles')
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">COURSES</h1>
    </div>

    <div class="container my-5 style='min-height: 100%;'">
        <div class="row">
            <!-- Card 1 -->
            @foreach ($courses as $course)
                <div class="col-md-6">
                    <div class="card pb-3 shadow-lg border-0 h-100 text-center d-flex flex-column align-items-center">
                        @if ($course->langer_Mimage)
                            <img src="{{ asset('storage/' . $course->langer_Mimage) }}" class="card-img-top"
                                alt="Course Image">
                        @endif
                        <div class="card-body d-flex flex-column align-items-center">
                            <h5 class="card-title">{{ $course->langer_Mtitle }}</h5>
                            <a href="{{ route('langer') }}" class="btn btn-success mt-auto custom-btn">Learn More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6">
                    <div class="card pb-3 shadow-lg border-0 h-100 text-center d-flex flex-column align-items-center">
                        @if ($course->couples_Mimage)
                            <img src="{{ asset('storage/' . $course->couples_Mimage) }}" class="card-img-top"
                                alt="Course Image">
                        @endif
                        <div class="card-body d-flex flex-column align-items-center">
                            <h5 class="card-title">{{ $course->couples_Mtitle }}</h5>
                            <a href="{{ route('couples') }}" class="btn btn-success mt-auto custom-btn">Learn More</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Course Schedule')

@push('styles')
    <link href="{{ asset('css/coursesched.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">COURSE SCHEDULE</h1>
    </div>

    <!-- Calendar Container -->
    <div class="container my-5">
        <h3 class="mb-3">Event Calendar</h3>
        <div class="calendar-grid" id="calendarHeader"></div>
        <div class="calendar-grid" id="eventCalendar"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <h4 id="eventDate" class="text-center"></h4>
                <div id="eventDetails"></div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/announcement.js') }}"></script>
    @endpush
@endsection

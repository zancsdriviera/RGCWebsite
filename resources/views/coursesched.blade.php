@extends('layouts.app')

@section('title', 'Courses Schedule')

@push('styles')
    <link href="{{ asset('css/coursesched.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')

    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">COURSE SCHEDULE</h1>
    </div>

    <div class="container mt-4">

        @php
            $monthName = \Carbon\Carbon::createFromDate($year, $month, 1)->format('F');
            $prevMonth = $month - 1;
            $nextMonth = $month + 1;
            $prevYear = $year;
            $nextYear = $year;

            if ($prevMonth < 1) {
                $prevMonth = 12;
                $prevYear--;
            }
            if ($nextMonth > 12) {
                $nextMonth = 1;
                $nextYear++;
            }

            $totalDays = $startOfMonth->daysInMonth;
            $startDayOfWeek = $startOfMonth->dayOfWeek;
            $weeks = ceil(($totalDays + $startDayOfWeek) / 7);
        @endphp

        <h1 class="text-center mb-3 fw-bold text-uppercase" style="color:#107039;">{{ $monthName }} {{ $year }}
        </h1>

        <table class="calendar-table bg-white">
            <thead>
                <tr>
                    @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
                        <th>{{ $dayName }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @php $day = 1; @endphp
                @for ($w = 0; $w < $weeks; $w++)
                    <tr>
                        @for ($d = 0; $d < 7; $d++)
                            @if ($w == 0 && $d < $startDayOfWeek)
                                <td class="empty"></td>
                            @elseif($day <= $totalDays)
                                @php
                                    $date = \Carbon\Carbon::createFromDate($year, $month, $day)->toDateString();
                                    $langer = $events[$date]['Langer'] ?? 'TBA';
                                    $couples = $events[$date]['Couples'] ?? 'TBA';
                                    $isToday = $date === date('Y-m-d');
                                @endphp

                                <td class="{{ $isToday ? 'today' : '' }}"
                                    onclick="openEventModal('{{ $date }}', '{{ addslashes($langer) }}', '{{ addslashes($couples) }}')">

                                    <div class="day-number">{{ $day }}</div>
                                    <div><strong>Couples:</strong> {{ $couples }}</div>
                                    <div><strong>Langer:</strong> {{ $langer }}</div>
                                </td>

                                @php $day++; @endphp
                            @else
                                <td class="empty"></td>
                            @endif
                        @endfor
                    </tr>
                @endfor
            </tbody>
        </table>

        <div class="calendar-mobile">
            @for ($d = 1; $d <= $totalDays; $d++)
                @php
                    $date = \Carbon\Carbon::createFromDate($year, $month, $d)->toDateString();
                    $langer = $events[$date]['Langer'] ?? 'TBA';
                    $couples = $events[$date]['Couples'] ?? 'TBA';
                    $isToday = $date === date('Y-m-d');
                @endphp

                <div class="mobile-day {{ $isToday ? 'today' : '' }}"
                    onclick="openEventModal('{{ $date }}', '{{ addslashes($langer) }}', '{{ addslashes($couples) }}')">
                    <div class="day-number">{{ $d }}</div>
                    <div><strong>Couples:</strong> {{ $couples }}</div>
                    <div><strong>Langer:</strong> {{ $langer }}</div>
                </div>
            @endfor
        </div>

        <div class="nav-btn-wrapper">
            <a href="{{ route('coursesched', ['month' => $prevMonth, 'year' => $prevYear]) }}">
                <button class="nav-btn">&lt;</button>
            </a>

            <a href="{{ route('coursesched', ['month' => date('m'), 'year' => date('Y')]) }}">
                <button class="today-btn">Today</button>
            </a>

            <a href="{{ route('coursesched', ['month' => $nextMonth, 'year' => $nextYear]) }}">
                <button class="nav-btn">&gt;</button>
            </a>
        </div>
        <br>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <h4 class="modal-title fw-bold" id="modalTitle"></h4>
                    <br>
                    <p><strong>Couples:</strong> <span id="modalCouples"></span></p>
                    <p><strong>Langer:</strong> <span id="modalLanger"></span></p>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">CLOSE</button>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function openEventModal(date, langer, couples) {
                const dt = new Date(date + 'T00:00:00');
                const formatted = dt.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                document.getElementById('modalTitle').innerText = 'Event On ' + formatted;
                document.getElementById('modalCouples').innerText = couples;
                document.getElementById('modalLanger').innerText = langer;

                new bootstrap.Modal(document.getElementById('eventModal')).show();
            }
        </script>
    @endpush

@endsection

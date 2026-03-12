@extends('layouts.app')

@section('title', 'Tournament & Events')

@push('styles')
    <link href="{{ asset('css/tourna_and_events.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <main class="m_body">
        <div class="container-fluid p-0">

            {{-- MAIN EVENTS --}}
            @if ($mainEventsGrouped && $mainEventsGrouped->count())
                @php
                    $lines = [];
                    $allEvents = collect();

                    foreach ($mainEventsGrouped as $date => $events) {
                        $dateFormatted = Carbon::parse($date)->format('F d, Y');
                        $titles = $events->pluck('title')->join(' & ');
                        $lines[] = $titles . ' - ' . $dateFormatted;
                        $allEvents = $allEvents->concat($events);
                    }
                @endphp

                <div class="header-title marquee">
                    <span>
                        UPCOMING EVENT: {{ $lines[0] ?? '' }}
                        @if (count($lines) > 1)
                            @foreach (array_slice($lines, 1) as $line)
                                &nbsp;&nbsp;|&nbsp;&nbsp; {{ $line }}
                            @endforeach
                        @endif
                    </span>
                </div>

                <div class="carousel-container">
                    <button class="carousel-prev">&#10094;</button>
                    <div class="carousel-wrapper">
                        @foreach ($allEvents as $event)
                            <div class="carousel-card">
                                <img src="{{ asset('storage/' . $event->main_image) }}" class="carousel-card-img"
                                    alt="{{ $event->title }}">
                                <div class="carousel-card-body text-center">
                                    <button class="btn view-details-btn" data-bs-toggle="modal"
                                        data-bs-target="#mainModal{{ $event->id }}">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-next">&#10095;</button>
                </div>

                {{-- MAIN EVENT MODALS --}}
                @foreach ($allEvents as $event)
                    <div class="modal fade" id="mainModal{{ $event->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                {{-- Removed inline style so CSS class takes over --}}
                                <div class="modal-header main-modal-header">
                                    <h5 class="modal-title fw-bold text-white">
                                        {{ strtoupper($event->title) }} — TOURNAMENT DETAILS
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body main-modal-body">

                                    @if ($event->secondary_image)
                                        <div class="text-center mb-3">
                                            <img src="{{ asset('storage/' . $event->secondary_image) }}"
                                                class="secondary-image qr-fit" style="max-width:150px;">
                                            <h4 class="scan-qr-title" style="margin-top:10px;">
                                                SCAN QR TO REGISTER
                                            </h4>
                                        </div>
                                    @endif

                                    <hr class="dotted-divider">

                                    @php
                                        $rows = json_decode($event->subtitles_texts, true) ?? [];
                                        $chunks = array_chunk($rows, 2);
                                    @endphp

                                    @foreach ($chunks as $chunk)
                                        <div class="row mb-2 mx-0 modal-grid">
                                            @foreach ($chunk as $item)
                                                <div class="col-md-6 mb-2 px-2">
                                                    <div class="text-block">
                                                        <div class="subtitle">{{ strtoupper($item['subtitle']) }}</div>
                                                        <div class="text-content">{!! nl2br(e($item['text'])) !!}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach

                                    @if ($event->file1 || $event->file2)
                                        <div class="file-links-wrap mt-3">
                                            @if ($event->file1)
                                                <a href="{{ asset('storage/' . $event->file1) }}" target="_blank"
                                                    class="file-link">
                                                    <i class="bi bi-eye"></i> Terms of Competition
                                                </a>
                                            @endif
                                            @if ($event->file2)
                                                <a href="{{ asset('storage/' . $event->file2) }}" target="_blank"
                                                    class="file-link">
                                                    <i class="bi bi-eye"></i> Club Advisory
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="header-title none">⛳ NO TOURNAMENT SCHEDULED</div>
            @endif

            {{-- PREVIOUS TOURNAMENTS --}}
            @if ($previousEvents && $previousEvents->count())
                <h3 class="prev-title">Previous Tournaments</h3>
                <div class="prev-carousel-container">
                    <div class="prev-carousel-wrapper">
                        @foreach ($previousEvents as $event)
                            <div class="prev-carousel-card" data-bs-toggle="modal"
                                data-bs-target="#prevModal{{ $event->id }}">
                                <img src="{{ asset('storage/' . $event->main_image) }}" class="prev-event-thumb"
                                    alt="{{ $event->title }}">
                                <div class="prev-card-body text-center">
                                    <h5 class="card-title mb-1">{{ $event->title }}</h>
                                        <p class="card-title mb-2 mt-2" style="color:gray">
                                            {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</p>
                                        <span class="badge mt-1">Ended</span>
                                </div>
                            </div>

                            {{-- Previous Tournament Modal --}}
                            <div class="modal fade" id="prevModal{{ $event->id }}" tabindex="-1">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header prev-modal-header">
                                            <h5 class="modal-title text-white">{{ $event->title }}</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center p-3">
                                            @if ($event->winners_image)
                                                <img src="{{ asset('storage/' . $event->winners_image) }}"
                                                    class="img-fluid rounded shadow" style="max-height:700px;">
                                            @else
                                                <p class="text-muted py-4">No winners image available.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($previousEvents->count() > 4)
                        <div class="prev-pagination">
                            <button class="prev-prev-btn">&#10094; Previous</button>
                            <button class="prev-next-btn">Next &#10095;</button>
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── MAIN EVENT CAROUSEL ──────────────────────
            document.querySelectorAll('.carousel-container').forEach(container => {
                const wrapper = container.querySelector('.carousel-wrapper');
                const cards = container.querySelectorAll('.carousel-card');
                const prevBtn = container.querySelector('.carousel-prev');
                const nextBtn = container.querySelector('.carousel-next');
                let index = 0;

                function update() {
                    wrapper.style.transform = `translateX(${-index * 100}%)`;
                    prevBtn.style.opacity = index === 0 ? '0.4' : '1';
                    nextBtn.style.opacity = index === cards.length - 1 ? '0.4' : '1';
                }

                prevBtn.addEventListener('click', () => {
                    if (index > 0) {
                        index--;
                        update();
                    }
                });
                nextBtn.addEventListener('click', () => {
                    if (index < cards.length - 1) {
                        index++;
                        update();
                    }
                });

                update(); // set initial arrow opacity
            });

            // ── PREVIOUS TOURNAMENT PAGINATION ──────────
            const prevContainer = document.querySelector('.prev-carousel-container');
            if (prevContainer) {
                const cards = prevContainer.querySelectorAll('.prev-carousel-card');
                const prevBtn = prevContainer.querySelector('.prev-prev-btn');
                const nextBtn = prevContainer.querySelector('.prev-next-btn');
                const perPage = 4;
                let pageIndex = 0;

                function showPage() {
                    cards.forEach((card, i) => {
                        card.style.display = (i >= pageIndex && i < pageIndex + perPage) ? '' : 'none';
                    });
                    prevBtn.disabled = pageIndex <= 0;
                    nextBtn.disabled = pageIndex + perPage >= cards.length;
                }

                prevBtn.addEventListener('click', () => {
                    if (pageIndex > 0) {
                        pageIndex -= perPage;
                        showPage();
                    }
                });
                nextBtn.addEventListener('click', () => {
                    if (pageIndex + perPage < cards.length) {
                        pageIndex += perPage;
                        showPage();
                    }
                });

                showPage();
            }
        });
    </script>
@endsection

@extends('layouts.app')

@section('title', 'Tournament & Events')

@push('styles')
    <link href="{{ asset('css/tourna_and_events.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <main class="m_body"> {{-- ADD THIS WRAPPER --}}
        <div class="container-fluid p-0">
            {{-- Main Event --}}
            @if ($mainEvent)
                <div class="header-title marquee">
                    <span>UPCOMING EVENT {{ $mainEvent->title ?? '' }} |
                        {{ $mainEvent->event_date ? \Carbon\Carbon::parse($mainEvent->event_date)->format('F d, Y') : '' }}</span>
                </div>

                <div class="position-relative">
                    <img src="{{ asset('storage/' . $mainEvent->main_image) }}" class="main-image">
                    <button
                        class="btn border border-white btn-dark position-absolute bottom-0 start-50 translate-middle-x mb-3 view-details-btn"
                        data-bs-toggle="modal" data-bs-target="#mainModal">
                        View Details
                    </button>
                </div>

                {{-- Main Event Modal --}}
                <div class="modal fade" id="mainModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header main-modal-header" style="background-color: #5E6D48;">
                                <h5 class="modal-title fw-bold text-white">{{ strtoupper($mainEvent->title) }} - TOURNAMENT
                                    DETAILS</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body main-modal-body">
                                @if ($mainEvent->secondary_image)
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('storage/' . $mainEvent->secondary_image) }}"
                                            class="secondary-image" style=" border:4px solid #333333;">
                                        <h4 class="scan-qr-title" style="font-weight:bold; margin-top:10px;">SCAN QR TO
                                            REGISTER
                                        </h4>
                                    </div>
                                @endif
                                <hr class="dotted-divider">

                                @php
                                    $rows = is_array(json_decode($mainEvent->subtitles_texts, true))
                                        ? json_decode($mainEvent->subtitles_texts, true)
                                        : [];
                                @endphp
                                @foreach (array_chunk($rows, 2) as $chunk)
                                    <div class="row mb-2 mx-0">
                                        @foreach ($chunk as $item)
                                            <div class="col-md-6 mb-2 px-1">
                                                <div class="text-block">
                                                    <div class="subtitle">{{ $item['subtitle'] }}</div>
                                                    <div class="text-content">{{ $item['text'] }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach

                                <div class="row mb-1">
                                    <div class="col-md-6 ml-10" style="font-weight:bold; font-size: 20px;">Click here to
                                        view
                                    </div>
                                </div>
                                @if ($mainEvent->file1)
                                    <div class="row mb-1">
                                        <div class="col-md-6 ml-10">
                                            <a href="{{ asset('storage/' . $mainEvent->file1) }}" target="_blank"
                                                class="text-success file-link" style="text-decoration:none;"><i
                                                    class="bi bi-eye"></i> Terms of Competition</a>
                                        </div>
                                    </div>
                                @endif
                                @if ($mainEvent->file2)
                                    <div class="row mb-1">
                                        <div class="col-md-6 ml-10">
                                            <a href="{{ asset('storage/' . $mainEvent->file2) }}" target="_blank"
                                                class="text-success file-link" style="text-decoration:none;"><i
                                                    class="bi bi-eye"></i> Club Advisory</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="header-title none">UPCOMING EVENT NONE</div>
            @endif

            {{-- Previous Tournaments --}}
            @if ($previousEvents && $previousEvents->count() > 0)
                <h3 class="prev-title">Previous Tournament</h3>
                <div class="row mt-3 px-2 mx-0">
                    @foreach ($previousEvents as $event)
                        <div class="col-md-3 mb-3 px-1">
                            <div class="prev-box" data-bs-toggle="modal" data-bs-target="#prevModal{{ $event->id }}">
                                <img src="{{ asset('storage/' . $event->main_image) }}" class="image-thumb">
                                <div class="prev-box-txt p-3">
                                    <h5 class="mt-2 fw-bold">{{ $event->title }}</h5>
                                    @if ($event->paragraph)
                                        <p>{{ $event->paragraph }}</p>
                                    @endif
                                    <small>{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="prevModal{{ $event->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body text-center fw-bold p-5">
                                        <h4 class="fw-bold">{{ strtoupper($event->title) }} END</h4>
                                        <button type="button" class="btn btn-success"
                                            data-bs-dismiss="modal">CLOSE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($previousEvents->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <ul class="pagination mb-4">
                            @if ($previousEvents->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">&lt;</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $previousEvents->previousPageUrl() }}">&lt;</a></li>
                            @endif
                            @if ($previousEvents->hasMorePages())
                                <li class="page-item"><a class="page-link"
                                        href="{{ $previousEvents->nextPageUrl() }}">&gt;</a>
                                </li>
                            @else
                                <li class="page-item disabled"><span class="page-link">&gt;</span></li>
                            @endif
                        </ul>
                    </div>
                @endif
            @endif {{-- End Previous Events --}}
        </div>
    </main>
@endsection

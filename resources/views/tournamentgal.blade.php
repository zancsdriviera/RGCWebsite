@extends('layouts.app')

@section('title', 'Tournament Gallery')

@push('styles')
    <link href="{{ asset('css/tournamentgal.css') }}" rel="stylesheet">
    <link href="{{ asset('images/RivieraHeaderLogo3.png') }}" rel="icon">
@endpush

@section('content')
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">TOURNAMENT GALLERY</h1>
    </div>

    <section class="news-grid">
        <div class="grid" id="newsGrid">
            @foreach ($galleries as $gallery)
                <article class="news-card">
                    {{-- route event.gallery: ?gallery=<slug>&open=0 (open optional) --}}
                    <a class="card-link"
                        href="{{ route('event.gallery', [], false) }}?gallery={{ urlencode($gallery->slug) }}&open=0"
                        aria-label="Open Tournament: {{ $gallery->title }}">
                        <div class="media">
                            {{-- thumbnail stored path or fallback image --}}
                            <img src="{{ $gallery->thumbnail_url ?? asset('images/COURSES/default-thumb.jpg') }}"
                                alt="{{ $gallery->title }}">
                        </div>
                        <div class="content">
                            <h3 class="title">{{ strtoupper($gallery->title) }}</h3>
                            <time class="date">{{ \Carbon\Carbon::parse($gallery->event_date)->format('F d, Y') }}</time>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </section>
@endsection

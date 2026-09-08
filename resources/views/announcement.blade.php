@extends('layouts.app')

@section('title', isset($announcement) ? $announcement->title : 'Announcements')
<style>
    .top-title {
        font-family: "Anton", Arial, sans-serif;
        font-size: 38px;
        color: #107039;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        letter-spacing: 3px;
    }

    .top-title::before,
    .top-title::after {
        content: "";
        width: 200px;
        border-bottom: 2px solid #b5ccbf;
        margin: 0 50px;
    }

    .top-title::after {
        content: "";
    }
</style>

@section('content')
    <div class="container py-5">
        @if (isset($announcement))
            <!-- Detail View -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('announcement.index') }}">Announcements</a></li>
                            <li class="breadcrumb-item active">{{ $announcement->title }}</li>
                        </ol>
                    </nav>

                    <h1 class="mb-3">{{ $announcement->title }}</h1>

                    @if ($announcement->published_date)
                        <p class="text-muted mb-4">
                            <i class="bi bi-calendar"></i>
                            {{ $announcement->published_date->format('F d, Y') }}
                        </p>
                    @endif

                    @if ($announcement->featured_image)
                        <img src="{{ asset('storage/' . $announcement->featured_image) }}" class="img-fluid rounded mb-4"
                            alt="{{ $announcement->title }}">
                    @endif

                    <div class="content">
                        {!! nl2br(e($announcement->content)) !!}
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('announcement.index') }}" class="btn btn-secondary">
                            ← Back to Announcements
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Listing View -->
            <h1 class="top-title">ANNOUNCEMENT</h1>

            @if ($announcements->count() > 0)
                <div class="row">
                    @foreach ($announcements as $item)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                @if ($item->featured_image)
                                    <img src="{{ asset('storage/' . $item->featured_image) }}" class="card-img-top"
                                        alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->title }}</h5>
                                    @if ($item->published_date)
                                        <p class="text-muted small">
                                            <i class="bi bi-calendar"></i>
                                            {{ $item->published_date->format('F d, Y') }}
                                        </p>
                                    @endif
                                    <p class="card-text">{{ Str::limit($item->content, 150) }}</p>
                                    <a href="{{ route('announcement.show', $item->slug) }}" class="btn btn-primary">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    No announcements available at this time. Please check back later.
                </div>
            @endif
        @endif
    </div>
@endsection

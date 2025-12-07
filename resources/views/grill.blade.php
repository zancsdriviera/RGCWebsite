@extends('layouts.app')

@section('title', 'Grill Room')

@push('styles')
    <link href="{{ asset('css/grill.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid px-0">
        {{-- Carousel --}}
        <div id="grillCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @forelse($carousel as $i => $img)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $img) }}" class="d-block w-100" alt="Slide {{ $i + 1 }}">
                    </div>
                @empty
                    <div class="carousel-item active">
                        <img src="{{ asset('images/COURSES/default-thumb.jpg') }}" class="d-block w-100" alt="No images">
                    </div>
                @endforelse
            </div>
            @if (count($carousel) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#grillCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#grillCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            @endif
        </div>

        {{-- Menu --}}
        <section class="menu-section py-5">
            <div class="container">
                <!-- header with horizontal rules -->
                <div class="menu-header d-flex align-items-center justify-content-center mb-4">
                    <div class="header-line"></div>
                    <h2 class="mx-3">MENU</h2>
                    <div class="header-line"></div>
                </div>

                <div class="row g-4">
                    @forelse($menu as $item)
                        <div class="col-12 col-sm-6 col-md-4">
                            <figure class="menu-card text-center">
                                <div class="menu-img-wrap mx-auto" style="width:220px;height:160px;overflow:hidden;">
                                    @if (!empty($item['image']))
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                            class="menu-img" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <div
                                            style="width:100%;height:100%;background:#f2f2f2;display:flex;align-items:center;justify-content:center;">
                                            <small>No image</small>
                                        </div>
                                    @endif
                                </div>
                                <figcaption class="mt-3">
                                    <h3 class="menu-title">{{ $item['name'] ?? 'Unnamed' }}</h3>
                                    <div class="menu-price">{{ $item['price'] ?? '' }}</div>
                                </figcaption>
                            </figure>
                        </div>
                    @empty
                        <p class="text-center text-muted">No menu items found.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection

@extends('admin.layout')
@section('title', 'Home')

@section('content')
    <style>
        .btn-primary:hover {
            transform: scale(1.05);
            transition: 0.2s;
        }
    </style>

    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Homepage</h3>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row gy-4">

                {{-- CAROUSEL 1–3 --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 1–3 (Main Banners)</h5>
                            <div class="row g-4">
                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Image {{ $i }}</label>
                                            <img id="carousel{{ $i }}Preview"
                                                src="{{ $homepage->{'carousel' . $i} ? asset('storage/' . $homepage->{'carousel' . $i}) : '' }}"
                                                class="img-fluid rounded mb-3 shadow-sm" alt="Carousel {{ $i }}"
                                                style="max-height:180px; object-fit:cover; {{ $homepage->{'carousel' . $i} ? '' : 'display:none;' }}">
                                            <input type="file" name="carousel{{ $i }}"
                                                class="form-control mb-3" data-preview="carousel{{ $i }}Preview"
                                                {{ $homepage->{'carousel' . $i} ? '' : 'required' }}>
                                            <label class="fw-semibold">Caption</label>
                                            <input type="text" name="carousel{{ $i }}Caption"
                                                class="form-control" value="{{ $homepage->{'carousel' . $i . 'Caption'} }}"
                                                required>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DYNAMIC CAROUSELS (after 3, before Langer & Couples) --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Additional Carousel Images</h5>
                            <div id="dynamicCarouselContainer" class="row g-4">
                                @if (!empty($homepage->dynamic_carousels))
                                    @foreach ($homepage->dynamic_carousels as $index => $carousel)
                                        <div class="col-md-6 col-lg-4 dynamic-carousel-item">
                                            <div class="border rounded p-3 h-100">
                                                <label class="fw-semibold d-block mb-2">Image</label>
                                                <img id="dynamicPreview{{ $index }}"
                                                    src="{{ $carousel['image'] ? asset('storage/' . $carousel['image']) : '' }}"
                                                    class="img-fluid rounded mb-3 shadow-sm"
                                                    style="max-height:180px; object-fit:cover; {{ $carousel['image'] ? '' : 'display:none;' }}">
                                                <input type="file" name="dynamicCarousels[{{ $index }}][image]"
                                                    class="form-control mb-3"
                                                    data-preview="dynamicPreview{{ $index }}">
                                                <label class="fw-semibold">Caption</label>
                                                <input type="text" name="dynamicCarousels[{{ $index }}][caption]"
                                                    class="form-control" value="{{ $carousel['caption'] ?? '' }}">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm mt-2 removeDynamic">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" id="addDynamicCarousel" class="btn btn-success mt-3">
                                <i class="bi bi-plus-circle me-2"></i>Add Carousel Image
                            </button>
                        </div>
                    </div>
                </div>

                {{-- CAROUSEL 4–5 (Langer & Couples) --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 4–5 (Course Descriptions)</h5>
                            <div class="row g-4">
                                @for ($i = 4; $i <= 5; $i++)
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Image {{ $i }}</label>
                                            <img id="carousel{{ $i }}Preview"
                                                src="{{ $homepage->{'carousel' . $i} ? asset('storage/' . $homepage->{'carousel' . $i}) : '' }}"
                                                class="img-fluid rounded shadow-sm" alt="Carousel {{ $i }}"
                                                style="max-height:180px; object-fit:cover; {{ $homepage->{'carousel' . $i} ? '' : 'display:none;' }}">
                                            <input type="file" name="carousel{{ $i }}"
                                                class="form-control mb-3" data-preview="carousel{{ $i }}Preview"
                                                {{ $homepage->{'carousel' . $i} ? '' : 'required' }}>
                                            <label class="fw-semibold">Description</label>
                                            <textarea name="carousel{{ $i }}Caption" class="form-control" rows="4" required
                                                placeholder="Enter description for Carousel {{ $i }}">{{ $homepage->{'carousel' . $i . 'Caption'} ?? '' }}</textarea>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- HEADLINE SECTION --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Headline & Subheadline</h5>
                            <label class="fw-semibold">Headline</label>
                            <input type="text" name="headline" class="form-control mb-3" required
                                value="{{ $homepage->headline }}">
                            <label class="fw-semibold">Subheadline</label>
                            <textarea name="subheadline" class="form-control" rows="2" required>{{ $homepage->subheadline }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- HOMEPAGE CARDS --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Homepage Cards</h5>
                            <div class="row g-4">
                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="col-md-4">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Card {{ $i }}</label>
                                            <img id="card{{ $i }}Preview"
                                                src="{{ $homepage->{'card' . $i . '_image'} ? asset('storage/' . $homepage->{'card' . $i . '_image'}) : '' }}"
                                                class="img-fluid rounded mb-3 shadow-sm" alt="Card {{ $i }}"
                                                style="max-height:160px; object-fit:cover; {{ $homepage->{'card' . $i . '_image'} ? '' : 'display:none;' }}">
                                            <input type="file" name="card{{ $i }}_image"
                                                class="form-control mb-3" data-preview="card{{ $i }}Preview"
                                                {{ $homepage->{'card' . $i . '_image'} ? '' : 'required' }}>
                                            <label class="fw-semibold">Title</label>
                                            <input type="text" name="card{{ $i }}_title"
                                                class="form-control" value="{{ $homepage->{'card' . $i . '_title'} }}"
                                                required>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SAVE BUTTON --}}
                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary shadow-lg position-fixed"
                        style="bottom: 30px; right: 30px; z-index: 1050; border-radius: 50px; padding: 12px 24px; font-weight: 600;">
                        <i class="bi bi-check-square me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- JS Preview Handler & Dynamic Carousel Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // File preview
            document.querySelectorAll('input[type="file"]').forEach(input => {
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (!file) return;
                    const previewId = e.target.getAttribute('data-preview');
                    if (!previewId) return;
                    const preview = document.getElementById(previewId);
                    if (!preview) return;
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                    preview.onload = () => URL.revokeObjectURL(preview.src);
                });
            });

            // Dynamic Carousel Add/Remove
            let dynamicIndex =
                {{ !empty($homepage->dynamic_carousels) ? count($homepage->dynamic_carousels) : 0 }};
            const container = document.getElementById('dynamicCarouselContainer');
            document.getElementById('addDynamicCarousel').addEventListener('click', () => {
                const html = `
        <div class="col-md-6 col-lg-4 dynamic-carousel-item">
            <div class="border rounded p-3 h-100">
                <label class="fw-semibold d-block mb-2">Image</label>
                <img id="dynamicPreview${dynamicIndex}" class="img-fluid rounded mb-3 shadow-sm" style="max-height:180px; object-fit:cover; display:none;">
                <input type="file" name="dynamicCarousels[${dynamicIndex}][image]" class="form-control mb-3" data-preview="dynamicPreview${dynamicIndex}">
                <label class="fw-semibold">Caption</label>
                <input type="text" name="dynamicCarousels[${dynamicIndex}][caption]" class="form-control">
                <button type="button" class="btn btn-danger btn-sm mt-2 removeDynamic">Remove</button>
            </div>
        </div>`;
                container.insertAdjacentHTML('beforeend', html);
                dynamicIndex++;
            });

            container.addEventListener('click', (e) => {
                if (e.target.classList.contains('removeDynamic')) {
                    e.target.closest('.dynamic-carousel-item').remove();
                }
            });
        });
    </script>
@endsection

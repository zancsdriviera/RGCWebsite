@extends('admin.layout')
@section('title', 'Home')

@section('content')

    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Homepage</h3>
        {{-- Success / Error Alerts --}}
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
                                            <label class="fw-semibold d-block mb-2">Image
                                                {{ $i }}</label>
                                            @if ($homepage->{'carousel' . $i})
                                                <img src="{{ asset('storage/' . $homepage->{'carousel' . $i}) }}"
                                                    class="img-fluid rounded mb-3 shadow-sm"
                                                    alt="Carousel {{ $i }}"
                                                    style="max-height: 180px; object-fit: cover;">
                                            @endif
                                            <input type="file" name="carousel{{ $i }}"
                                                class="form-control mb-3">
                                            <label class="fw-semibold">Caption {{ $i }}</label>
                                            <input type="text" name="carousel{{ $i }}Caption"
                                                class="form-control" value="{{ $homepage->{'carousel' . $i . 'Caption'} }}">
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CAROUSEL 4–5 --}}
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 4–5 (Course Descriptions)</h5>
                            <div class="row g-4">
                                @for ($i = 4; $i <= 5; $i++)
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            {{-- Image Preview --}}
                                            <label class="fw-semibold d-block mb-2">Image {{ $i }}</label>
                                            <div class="mb-3">
                                                <img id="carousel{{ $i }}Preview"
                                                    src="{{ $homepage->{'carousel' . $i} ? asset('storage/' . $homepage->{'carousel' . $i}) : '' }}"
                                                    class="img-fluid rounded shadow-sm" alt="Carousel {{ $i }}"
                                                    style="max-height:180px; object-fit:cover; {{ $homepage->{'carousel' . $i} ? '' : 'display:none;' }}">
                                            </div>
                                            <input type="file" name="carousel{{ $i }}"
                                                class="form-control mb-3"
                                                onchange="document.getElementById('carousel{{ $i }}Preview').src = window.URL.createObjectURL(this.files[0]); document.getElementById('carousel{{ $i }}Preview').style.display='block';">

                                            {{-- Description --}}
                                            <label class="fw-semibold">Description (Paragraph {{ $i }})</label>
                                            <textarea name="carousel{{ $i }}Caption" class="form-control" rows="4"
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
                            <input type="text" name="headline" class="form-control mb-3"
                                value="{{ $homepage->headline }}">

                            <label class="fw-semibold">Subheadline</label>
                            <textarea name="subheadline" class="form-control" rows="2">{{ $homepage->subheadline }}</textarea>
                        </div>
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
                                        @if ($homepage->{'card' . $i . '_image'})
                                            <img src="{{ asset('storage/' . $homepage->{'card' . $i . '_image'}) }}"
                                                class="img-fluid rounded mb-3 shadow-sm" alt="Card {{ $i }}"
                                                style="max-height: 160px; object-fit: cover;">
                                        @endif
                                        <input type="file" name="card{{ $i }}_image"
                                            class="form-control mb-3">
                                        <label class="fw-semibold">Card {{ $i }} Title</label>
                                        <input type="text" name="card{{ $i }}_title" class="form-control"
                                            value="{{ $homepage->{'card' . $i . '_title'} }}">
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            {{-- MAP SECTION --}}
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Map Embed</h5>
                        <label class="fw-semibold">Google Map Embed Code (iframe)</label>
                        <textarea name="map_embed" class="form-control" rows="3">{{ $homepage->map_embed }}</textarea>
                    </div>
                </div>
            </div>

            {{-- SAVE BUTTON --}}
            <div class="col-12 text-end mt-3">
                <button type="submit" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-save me-2"></i>Save Changes
                </button>
            </div>
    </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // For all file inputs
            document.querySelectorAll('input[type="file"]').forEach(input => {
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (!file) return;

                    // Find or create an <img> preview element
                    let preview = e.target.previousElementSibling;
                    if (!preview || preview.tagName !== 'IMG') {
                        preview = document.createElement('img');
                        preview.classList.add('img-fluid', 'rounded', 'mb-3', 'shadow-sm');
                        preview.style.maxHeight = '180px';
                        e.target.parentNode.insertBefore(preview, e.target);
                    }

                    // Show selected image
                    preview.src = URL.createObjectURL(file);
                });
            });
        });
    </script>
</div> @endsection

@extends('admin.layout')
@section('title', 'Home')

@section('content')
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
                                            {{-- Pre-create preview image --}}
                                            <img id="carousel{{ $i }}Preview"
                                                src="{{ $homepage->{'carousel' . $i} ? asset('storage/' . $homepage->{'carousel' . $i}) : '' }}"
                                                class="img-fluid rounded mb-3 shadow-sm" alt="Carousel {{ $i }}"
                                                style="max-height:180px; object-fit:cover; {{ $homepage->{'carousel' . $i} ? '' : 'display:none;' }}">
                                            <input type="file" name="carousel{{ $i }}"
                                                class="form-control mb-3" data-preview="carousel{{ $i }}Preview"
                                                {{ $homepage->{'carousel' . $i} ? '' : 'required' }}>
                                            <label class="fw-semibold">Caption {{ $i }}</label>
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

                {{-- CAROUSEL 4–5 --}}
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
                                            <label class="fw-semibold">Description (Paragraph {{ $i }})</label>
                                            <textarea name="carousel{{ $i }}Caption" class="form-control" rows="4" required
                                                placeholder="Enter description for Carousel {{ $i }}">{{ $homepage->{'carousel' . $i . 'Caption'} ?? '' }}</textarea>
                                        </div>
                                    </div>
                                @endfor
                            </div>
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
                                        <label class="fw-semibold">Card {{ $i }} Title</label>
                                        <input type="text" name="card{{ $i }}_title" class="form-control"
                                            value="{{ $homepage->{'card' . $i . '_title'} }}" required>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            {{-- SAVE BUTTON --}}
            <div class="col-12 text-end mt-3">
                <button type="submit" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-check-square me-2"></i>Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- JS Preview Handler --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
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
        });
    </script>
@endsection

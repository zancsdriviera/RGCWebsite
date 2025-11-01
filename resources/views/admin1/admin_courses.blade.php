@extends('admin.layout')
@section('title', 'Courses Page Editor')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Courses Page Elements</h5>

                <style>
                    .course-card {
                        background: #fff;
                        border: 1px solid #e9ecef;
                        border-radius: .5rem;
                        overflow: hidden;
                        transition: all .2s ease-in-out;
                    }

                    .course-image img {
                        width: 100%;
                        height: 220px;
                        object-fit: cover;
                        display: block;
                    }

                    .accordion-button:focus {
                        box-shadow: none;
                    }

                    .field-label {
                        font-weight: 600;
                        font-size: .9rem;
                        margin-bottom: .3rem;
                        color: #495057;
                    }
                </style>

                <div class="row g-4">
                    {{-- LEFT: LANGER --}}
                    <div class="col-md-6">
                        <div class="course-card mb-3 shadow-sm">
                            <div class="course-image">
                                <img id="preview_langer" loading="lazy"
                                    src="{{ asset('storage/content_images' . ($contents['courses_card1_image']->value ?? 'images/placeholder.png')) }}"
                                    alt="Langer Image">
                            </div>
                            <div class="card-body">
                                <h5 class="text-center fw-bold mb-3">Langer Course</h5>
                                <form method="POST" action="{{ route('admin.update', 'courses_card1_image') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label class="field-label">Course Image</label>
                                    <input type="file" name="value" class="form-control form-control-sm"
                                        accept="image/*" onchange="previewImage(event,'preview_langer')">
                                    <button class="btn btn-primary btn-sm mt-2">Upload</button>
                                </form>

                                <form method="POST" action="{{ route('admin.update', 'courses_card1_title') }}">
                                    @csrf
                                    <label class="field-label">Course Title</label>
                                    <textarea name="value" rows="2" class="form-control">{{ $contents['courses_card1_title']->value ?? '' }}</textarea>
                                    <button class="btn btn-success btn-sm mt-2">Save</button>
                                </form>

                                <form method="POST" action="{{ route('admin.update', 'courses_card1_description') }}">
                                    @csrf
                                    <label class="field-label">Course Description</label>
                                    <textarea name="value" rows="3" class="form-control">{{ $contents['courses_card1_description']->value ?? '' }}</textarea>
                                    <button class="btn btn-success btn-sm mt-2">Save</button>
                                </form>
                            </div>
                        </div>

                        {{-- Accordion for Langer Gallery --}}
                        <div class="accordion" id="langerAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#langerGallery">
                                        Langer Gallery & Meta
                                    </button>
                                </h2>
                                <div id="langerGallery" class="accordion-collapse collapse"
                                    data-bs-parent="#langerAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('admin.langer.update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-3">
                                                @for ($i = 1; $i <= 6; $i++)
                                                    @php $col = 'image'.$i; @endphp
                                                    <div class="col-6">
                                                        <label class="field-label">Image {{ $i }}</label>
                                                        <img id="langer_preview_{{ $i }}" loading="lazy"
                                                            src="{{ $langer->$col ? asset('storage/contentcontent_images' . $langer->$col) : asset('images/placeholder.png') }}"
                                                            class="img-fluid rounded mb-1"
                                                            style="height:100px;object-fit:cover;">
                                                        <input type="file" name="image{{ $i }}"
                                                            class="form-control form-control-sm" accept="image/*"
                                                            onchange="previewImage(event,'langer_preview_{{ $i }}')">
                                                    </div>
                                                @endfor
                                            </div>
                                            <div class="mt-3">
                                                <label class="field-label">Gallery Title</label>
                                                <input type="text" name="title" value="{{ $langer->title ?? '' }}"
                                                    class="form-control mb-2">
                                                <label class="field-label">Gallery Description</label>
                                                <textarea name="description" rows="3" class="form-control">{{ $langer->description ?? '' }}</textarea>
                                            </div>
                                            <div class="mt-3 text-end">
                                                <button class="btn btn-success btn-sm">Save All</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT: COUPLES --}}
                    <div class="col-md-6">
                        <div class="course-card mb-3 shadow-sm">
                            <div class="course-image">
                                <img id="preview_couples" loading="lazy"
                                    src="{{ asset('storage/' . ($contents['courses_card2_image']->value ?? 'images/placeholder.png')) }}"
                                    alt="Couples Image">
                            </div>
                            <div class="card-body">
                                <h5 class="text-center fw-bold mb-3">Couples Course</h5>
                                <form method="POST" action="{{ route('admin.update', 'courses_card2_image') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label class="field-label">Course Image</label>
                                    <input type="file" name="value" class="form-control form-control-sm"
                                        accept="image/*" onchange="previewImage(event,'preview_couples')">
                                    <button class="btn btn-primary btn-sm mt-2">Upload</button>
                                </form>

                                <form method="POST" action="{{ route('admin.update', 'courses_card2_title') }}">
                                    @csrf
                                    <label class="field-label">Course Title</label>
                                    <textarea name="value" rows="2" class="form-control">{{ $contents['courses_card2_title']->value ?? '' }}</textarea>
                                    <button class="btn btn-success btn-sm mt-2">Save</button>
                                </form>

                                <form method="POST" action="{{ route('admin.update', 'courses_card2_description') }}">
                                    @csrf
                                    <label class="field-label">Course Description</label>
                                    <textarea name="value" rows="3" class="form-control">{{ $contents['courses_card2_description']->value ?? '' }}</textarea>
                                    <button class="btn btn-success btn-sm mt-2">Save</button>
                                </form>
                            </div>
                        </div>

                        {{-- Accordion for Couples Gallery --}}
                        <div class="accordion" id="couplesAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#couplesGallery">
                                        Couples Gallery & Meta
                                    </button>
                                </h2>
                                <div id="couplesGallery" class="accordion-collapse collapse"
                                    data-bs-parent="#couplesAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="{{ route('admin.couples.update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-3">
                                                @for ($i = 1; $i <= 6; $i++)
                                                    @php $col = 'image'.$i; @endphp
                                                    <div class="col-6">
                                                        <label class="field-label">Image {{ $i }}</label>
                                                        <img id="couples_preview_{{ $i }}" loading="lazy"
                                                            src="{{ $couples->$col ? asset('storage/' . $couples->$col) : asset('images/placeholder.png') }}"
                                                            class="img-fluid rounded mb-1"
                                                            style="height:100px;object-fit:cover;">
                                                        <input type="file" name="couples_image{{ $i }}"
                                                            class="form-control form-control-sm" accept="image/*"
                                                            onchange="previewImage(event,'couples_preview_{{ $i }}')">
                                                    </div>
                                                @endfor
                                            </div>
                                            <div class="mt-3">
                                                <label class="field-label">Gallery Title</label>
                                                <input type="text" name="title" value="{{ $couples->title ?? '' }}"
                                                    class="form-control mb-2">
                                                <label class="field-label">Gallery Description</label>
                                                <textarea name="description" rows="3" class="form-control">{{ $couples->description ?? '' }}</textarea>
                                            </div>
                                            <div class="mt-3 text-end">
                                                <button class="btn btn-success btn-sm">Save All</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Lightweight Preview Script --}}
    <script>
        function previewImage(event, previewId) {
            const input = event.target;
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(input.files[0]);
            }
        }
        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", function(e) {
                const input = form.querySelector("[name='value']");
                if (input) {
                    if (input.type === "file" && input.files.length === 0) {
                        e.preventDefault();
                        alert("Please select an image before uploading.");
                    } else if (input.tagName === "TEXTAREA" && input.value.trim() === "") {
                        e.preventDefault();
                        alert("Please fill in the text field before saving.");
                    }
                }
            });
        });
    </script>
@endsection

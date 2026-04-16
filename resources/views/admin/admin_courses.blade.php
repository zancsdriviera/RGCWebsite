@extends('admin.layout')
@section('title', 'Courses')

@section('content')
    <style>
        .fixed-image-container {
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            background-color: #f8f9fa;
            margin-bottom: 0.5rem;
        }

        .fixed-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .parent-image-container {
            width: 200px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            background-color: #f8f9fa;
            margin-bottom: 0.5rem;
        }

        .parent-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-size-info {
            font-size: 12px;
            color: #6c757d;
            margin-top: 4px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 1rem;
        }

        .gallery-card {
            width: 100% !important;
            margin: 0 !important;
            display: flex;
            flex-direction: column;
            max-width: none;
        }

        .gallery-card .fixed-image-container {
            width: 100%;
            height: 120px;
        }

        .compact-field {
            margin-bottom: 0.25rem !important;
        }

        .compact-field .form-control-sm {
            padding: 0.15rem 0.25rem;
            font-size: 0.75rem;
            height: auto;
        }

        .compact-label {
            font-size: 0.7rem;
            width: 40px !important;
        }

        .small-bullet {
            font-size: 12px;
            margin-right: 2px;
        }

        .gallery-card form {
            width: 100%;
        }

        @media (max-width: 1400px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="container-fluid px-4 py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 fw-bold">Courses</h3>
            @if ($courses->isEmpty())
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add New Course</button>
            @endif
        </div>

        @forelse($courses as $course)
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-dark text-white d-flex justify-content-end align-items-center">
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#deleteCourseModal{{ $course->id }}">
                        <i class="bi bi-trash me-1"></i>Delete Courses
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">

                        {{-- ===== LANGER COLUMN ===== --}}
                        <div class="col-md-6 border-end">
                            <h5 class="fw-bold">Langer Course</h5>
                            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST"
                                enctype="multipart/form-data" id="langerUpdateForm{{ $course->id }}">
                                @csrf
                                @method('PUT')
                                <label class="fw-semibold">Parent Title</label>
                                <input type="text" name="langer_Mtitle" class="form-control mb-2"
                                    value="{{ $course->langer_Mtitle }}" required>

                                <label>Parent Main Image</label>
                                @if ($course->langer_Mimage)
                                    <div class="parent-image-container mb-2">
                                        <img src="{{ asset('storage/' . $course->langer_Mimage) }}" alt="Parent image">
                                    </div>
                                @endif
                                <input type="file" name="langer_Mimage" class="form-control mb-3" accept="image/*"
                                    data-max-size="5120">
                                <div class="file-size-info">Maximum file size: 5MB</div>

                                <label class="fw-semibold">Child Title</label>
                                <input type="text" name="langer_title" class="form-control mb-2"
                                    value="{{ $course->langer_title }}" required>

                                <label>Description</label>
                                <textarea name="langer_description" class="form-control mb-2" rows="3" required>{{ $course->langer_description }}</textarea>
                                <button type="submit" class="btn btn-primary btn-sm mb-3">Update Langer Details</button>
                            </form>

                            {{-- Langer Gallery --}}
                            <div class="mt-4">
                                <label class="fw-bold mb-2">Gallery Images</label>
                                <div class="gallery-grid">
                                    @if ($course->langer_images)
                                        @foreach ($course->langer_images as $index => $img)
                                            <div class="gallery-card">
                                                <form
                                                    action="{{ route('admin.courses.update_image', [$course->id, 'langer', $index]) }}"
                                                    method="POST" enctype="multipart/form-data" class="card p-2">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="fixed-image-container" style="width:100%; height:120px;">
                                                        <img src="{{ asset('storage/' . $img['image']) }}"
                                                            alt="Gallery image">
                                                    </div>

                                                    <div class="row g-1 mt-1">
                                                        {{-- Hole --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label
                                                                    class="small text-muted me-1 compact-label">Hole:</label>
                                                                <input type="number" name="hole"
                                                                    value="{{ $img['hole'] ?? 1 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" required>
                                                            </div>
                                                        </div>
                                                        {{-- PAR --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label
                                                                    class="small text-muted me-1 compact-label">PAR:</label>
                                                                <input type="number" name="par"
                                                                    value="{{ $img['par'] ?? 4 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" min="3" max="6"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        {{-- Gold --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: gold;" class="small-bullet">●</span>
                                                                    Gold:
                                                                </label>
                                                                <input type="number" name="gold"
                                                                    value="{{ $img['gold'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" required>
                                                            </div>
                                                        </div>
                                                        {{-- Blue --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: blue;" class="small-bullet">●</span>
                                                                    Blue:
                                                                </label>
                                                                <input type="number" name="blue"
                                                                    value="{{ $img['blue'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" required>
                                                            </div>
                                                        </div>
                                                        {{-- Silver (NEW) --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: #C0C0C0;"
                                                                        class="small-bullet">●</span> Slvr:
                                                                </label>
                                                                <input type="number" name="silver"
                                                                    value="{{ $img['silver'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" required>
                                                            </div>
                                                        </div>
                                                        {{-- White --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: #666;"
                                                                        class="small-bullet">●</span> Wht:
                                                                </label>
                                                                <input type="number" name="white"
                                                                    value="{{ $img['white'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" required>
                                                            </div>
                                                        </div>

                                                        {{-- Red --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: red;"
                                                                        class="small-bullet">●</span> Red:
                                                                </label>
                                                                <input type="number" name="red"
                                                                    value="{{ $img['red'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" required>
                                                            </div>
                                                        </div>
                                                        {{-- Men Handicap --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <i class="bi bi-gender-male me-1"
                                                                        style="color: #4a90e2;"></i> Men H:
                                                                </label>
                                                                <input type="number" name="men_handicap"
                                                                    value="{{ $img['men_handicap'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" max="36"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        {{-- Ladies Handicap --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <i class="bi bi-gender-female me-1"
                                                                        style="color: #e24a8b;"></i> Lady H:
                                                                </label>
                                                                <input type="number" name="ladies_handicap"
                                                                    value="{{ $img['ladies_handicap'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" max="36"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-1 mt-1">
                                                        <input type="file" name="image"
                                                            class="form-control form-control-sm" accept="image/*"
                                                            data-max-size="5120"
                                                            style="font-size:0.7rem; padding:0.15rem;">
                                                        <div class="file-size-info" style="font-size:0.6rem;">Max:5MB
                                                        </div>
                                                    </div>

                                                    <div class="d-flex gap-1 mt-1">
                                                        <button type="submit"
                                                            class="btn btn-outline-primary btn-sm flex-grow-1"
                                                            style="font-size:0.7rem; padding:0.2rem;">
                                                            <i class="bi bi-arrow-repeat me-1"></i>Update
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm flex-grow-1"
                                                            style="font-size:0.7rem; padding:0.2rem;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteImageModal{{ $course->id }}_langer_{{ $index }}">
                                                            <i class="bi bi-trash me-1"></i>Delete
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                {{-- Add Langer Images --}}
                                <form action="{{ route('admin.courses.add_image', [$course->id, 'langer']) }}"
                                    method="POST" enctype="multipart/form-data" class="mt-3 p-3 border rounded"
                                    id="langerAddForm{{ $course->id }}">
                                    @csrf
                                    <h6 class="mb-3">Add New Images</h6>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label fw-semibold">Select Images:</label>
                                            <input type="file" name="images[]" class="form-control" multiple
                                                accept="image/*" data-max-size="5120" required
                                                id="langerFileInput{{ $course->id }}">
                                            <div class="file-size-info">Maximum file size per image: 5MB</div>
                                        </div>
                                    </div>
                                    <div class="row mt-2" id="langerNewFields{{ $course->id }}"></div>
                                    <button type="submit" class="btn btn-success btn-sm mt-2">Add Images</button>
                                </form>
                            </div>
                        </div>

                        {{-- ===== COUPLES COLUMN ===== --}}
                        <div class="col-md-6 ps-4">
                            <h5 class="fw-bold">Couples Course</h5>
                            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST"
                                enctype="multipart/form-data" id="couplesUpdateForm{{ $course->id }}">
                                @csrf
                                @method('PUT')
                                <label class="fw-semibold">Parent Title</label>
                                <input type="text" name="couples_Mtitle" class="form-control mb-2"
                                    value="{{ $course->couples_Mtitle }}" required>

                                <label>Parent Main Image</label>
                                @if ($course->couples_Mimage)
                                    <div class="parent-image-container mb-2">
                                        <img src="{{ asset('storage/' . $course->couples_Mimage) }}" alt="Parent image">
                                    </div>
                                @endif
                                <input type="file" name="couples_Mimage" class="form-control mb-3" accept="image/*"
                                    data-max-size="5120">
                                <div class="file-size-info">Maximum file size: 5MB</div>

                                <label class="fw-semibold">Child Title</label>
                                <input type="text" name="couples_title" class="form-control mb-2"
                                    value="{{ $course->couples_title }}" required>

                                <label>Description</label>
                                <textarea name="couples_description" class="form-control mb-2" rows="3" required>{{ $course->couples_description }}</textarea>
                                <button type="submit" class="btn btn-primary btn-sm mb-3">Update Couples Details</button>
                            </form>

                            {{-- Couples Gallery --}}
                            <div class="mt-4">
                                <label class="fw-bold mb-2">Gallery Images</label>
                                <div class="gallery-grid">
                                    @if ($course->couples_images)
                                        @foreach ($course->couples_images as $index => $img)
                                            <div class="gallery-card">
                                                <form
                                                    action="{{ route('admin.courses.update_image', [$course->id, 'couples', $index]) }}"
                                                    method="POST" enctype="multipart/form-data" class="card p-2">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="fixed-image-container" style="width:100%; height:120px;">
                                                        <img src="{{ asset('storage/' . $img['image']) }}"
                                                            alt="Gallery image">
                                                    </div>

                                                    <div class="row g-1 mt-1">
                                                        {{-- Hole --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label
                                                                    class="small text-muted me-1 compact-label">Hole:</label>
                                                                <input type="number" name="hole"
                                                                    value="{{ $img['hole'] ?? 1 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" required>
                                                            </div>
                                                        </div>
                                                        {{-- PAR --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label
                                                                    class="small text-muted me-1 compact-label">PAR:</label>
                                                                <input type="number" name="par"
                                                                    value="{{ $img['par'] ?? 4 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" min="3" max="6"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        {{-- Gold --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: gold;"
                                                                        class="small-bullet">●</span> Gold:
                                                                </label>
                                                                <input type="number" name="gold"
                                                                    value="{{ $img['gold'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" required>
                                                            </div>
                                                        </div>
                                                        {{-- Blue --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: blue;"
                                                                        class="small-bullet">●</span> Blue:
                                                                </label>
                                                                <input type="number" name="blue"
                                                                    value="{{ $img['blue'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" required>
                                                            </div>
                                                        </div>
                                                        {{-- Silver (NEW) --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: #C0C0C0;"
                                                                        class="small-bullet">●</span> Slvr:
                                                                </label>
                                                                <input type="number" name="silver"
                                                                    value="{{ $img['silver'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" required>
                                                            </div>
                                                        </div>
                                                        {{-- White --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: #666;"
                                                                        class="small-bullet">●</span> Wht:
                                                                </label>
                                                                <input type="number" name="white"
                                                                    value="{{ $img['white'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" required>
                                                            </div>
                                                        </div>
                                                        {{-- Red --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: red;"
                                                                        class="small-bullet">●</span> Red:
                                                                </label>
                                                                <input type="number" name="red"
                                                                    value="{{ $img['red'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" required>
                                                            </div>
                                                        </div>
                                                        {{-- Men Handicap --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <i class="bi bi-gender-male me-1"
                                                                        style="color: #4a90e2;"></i> Men H:
                                                                </label>
                                                                <input type="number" name="men_handicap"
                                                                    value="{{ $img['men_handicap'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" max="36"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        {{-- Ladies Handicap --}}
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <i class="bi bi-gender-female me-1"
                                                                        style="color: #e24a8b;"></i> Lady H:
                                                                </label>
                                                                <input type="number" name="ladies_handicap"
                                                                    value="{{ $img['ladies_handicap'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 45px;" min="0" max="36"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-1 mt-1">
                                                        <input type="file" name="image"
                                                            class="form-control form-control-sm" accept="image/*"
                                                            data-max-size="5120"
                                                            style="font-size:0.7rem; padding:0.15rem;">
                                                        <div class="file-size-info" style="font-size:0.6rem;">Max:5MB
                                                        </div>
                                                    </div>

                                                    <div class="d-flex gap-1 mt-1">
                                                        <button type="submit"
                                                            class="btn btn-outline-primary btn-sm flex-grow-1"
                                                            style="font-size:0.7rem; padding:0.2rem;">
                                                            <i class="bi bi-arrow-repeat me-1"></i>Update
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm flex-grow-1"
                                                            style="font-size:0.7rem; padding:0.2rem;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteImageModal{{ $course->id }}_couples_{{ $index }}">
                                                            <i class="bi bi-trash me-1"></i>Delete
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                {{-- Add Couples Images --}}
                                <form action="{{ route('admin.courses.add_image', [$course->id, 'couples']) }}"
                                    method="POST" enctype="multipart/form-data" class="mt-3 p-3 border rounded"
                                    id="couplesAddForm{{ $course->id }}">
                                    @csrf
                                    <h6 class="mb-3">Add New Images</h6>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label fw-semibold">Select Images:</label>
                                            <input type="file" name="images[]" class="form-control" multiple
                                                accept="image/*" data-max-size="5120" required
                                                id="couplesFileInput{{ $course->id }}">
                                            <div class="file-size-info">Maximum file size per image: 5MB</div>
                                        </div>
                                    </div>
                                    <div class="row mt-2" id="couplesNewFields{{ $course->id }}"></div>
                                    <button type="submit" class="btn btn-success btn-sm mt-2">Add Images</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Delete Course Modal --}}
            <div class="modal fade" id="deleteCourseModal{{ $course->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Confirm Delete</h5>
                        </div>
                        <div class="modal-body text-black">
                            Are you sure you want to delete this course? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger"><i
                                        class="bi bi-trash me-1"></i>Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Delete Image Modals – Langer --}}
            @if ($course->langer_images)
                @foreach ($course->langer_images as $index => $img)
                    <div class="modal fade" id="deleteImageModal{{ $course->id }}_langer_{{ $index }}"
                        tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                </div>
                                <div class="modal-body text-black">Are you sure you want to delete this image?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{ route('admin.courses.delete_image', [$course->id, 'langer', $index]) }}"
                                        class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- Delete Image Modals – Couples --}}
            @if ($course->couples_images)
                @foreach ($course->couples_images as $index => $img)
                    <div class="modal fade" id="deleteImageModal{{ $course->id }}_couples_{{ $index }}"
                        tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                </div>
                                <div class="modal-body text-black">Are you sure you want to delete this image?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{ route('admin.courses.delete_image', [$course->id, 'couples', $index]) }}"
                                        class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        @empty
            <div class="alert alert-info">No courses found. Please add a course.</div>
        @endforelse

        {{-- Success Modal --}}
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title">Success</h5>
                    </div>
                    <div class="modal-body text-black">{{ session('modal_message') }}</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Error Modal --}}
        <div class="modal fade" id="errorModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill me-2"></i>File Too Large</h5>
                    </div>
                    <div class="modal-body text-black" id="errorModalMessage"></div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Modal --}}
        @if ($courses->isEmpty())
            <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Course</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 border-end">
                                        <h5 class="fw-bold">Langer Course</h5>
                                        <div class="mb-3">
                                            <label class="fw-semibold">Parent Title:</label>
                                            <input type="text" name="langer_Mtitle" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Parent Main Image:</label>
                                            <input type="file" name="langer_Mimage" class="form-control"
                                                accept="image/*" data-max-size="5120">
                                            <div class="file-size-info">Maximum file size: 5MB</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fw-semibold">Child Title:</label>
                                            <input type="text" name="langer_title" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Description:</label>
                                            <textarea name="langer_description" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Gallery Images:</label>
                                            <input type="file" name="langer_images[]" class="form-control" multiple
                                                accept="image/*" data-max-size="5120">
                                            <div class="file-size-info">Maximum file size per image: 5MB</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ps-4">
                                        <h5 class="fw-bold">Couples Course</h5>
                                        <div class="mb-3">
                                            <label class="fw-semibold">Parent Title:</label>
                                            <input type="text" name="couples_Mtitle" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Parent Main Image:</label>
                                            <input type="file" name="couples_Mimage" class="form-control"
                                                accept="image/*" data-max-size="5120">
                                            <div class="file-size-info">Maximum file size: 5MB</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fw-semibold">Child Title:</label>
                                            <input type="text" name="couples_title" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Description:</label>
                                            <textarea name="couples_description" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Gallery Images:</label>
                                            <input type="file" name="couples_images[]" class="form-control" multiple
                                                accept="image/*" data-max-size="5120">
                                            <div class="file-size-info">Maximum file size per image: 5MB</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add Course</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if (session('modal_message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new bootstrap.Modal(document.getElementById('successModal')).show();
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var msg = '';
                @foreach ($errors->all() as $error)
                    msg += '{{ $error }}<br>';
                @endforeach
                document.getElementById('errorModalMessage').innerHTML = msg;
                new bootstrap.Modal(document.getElementById('errorModal')).show();
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function showErrorModal(message) {
                document.getElementById('errorModalMessage').innerHTML = message;
                new bootstrap.Modal(document.getElementById('errorModal')).show();
            }

            function checkFileSize(input, maxSizeKB) {
                if (input.files) {
                    for (let i = 0; i < input.files.length; i++) {
                        const file = input.files[i];
                        if (file.size / 1024 > maxSizeKB) {
                            const mb = (file.size / 1024 / 1024).toFixed(2);
                            return `"${file.name}" is ${mb}MB. Maximum allowed size is ${(maxSizeKB/1024).toFixed(0)}MB.`;
                        }
                    }
                }
                return null;
            }

            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    let err = null;
                    this.querySelectorAll('input[type="file"][data-max-size]').forEach(input => {
                        const error = checkFileSize(input, parseInt(input.dataset.maxSize));
                        if (error) err = error;
                    });
                    if (err) {
                        e.preventDefault();
                        showErrorModal(err);
                    }
                });
            });

            document.querySelectorAll('input[type="file"][data-max-size]').forEach(input => {
                input.addEventListener('change', function() {
                    const error = checkFileSize(this, parseInt(this.dataset.maxSize));
                    if (error) {
                        showErrorModal(error);
                        this.value = '';
                    }
                });
            });

            // Dynamic add-image fields generator (shared for both langer & couples)
            function buildAddFields(fileInput, container) {
                fileInput.addEventListener('change', function() {
                    container.innerHTML = '';
                    for (let i = 0; i < this.files.length; i++) {
                        container.insertAdjacentHTML('beforeend', `
                            <div class="col-md-6 mb-2">
                                <div class="border p-2 rounded">
                                    <small class="d-block mb-2 fw-bold">Image ${i + 1}: ${this.files[i].name}</small>
                                    <div class="row g-1">
                                        <div class="col-6"><div class="d-flex align-items-center mb-1">
                                            <label class="small text-muted me-1" style="width:45px;">Hole:</label>
                                            <input type="number" name="holes[]" class="form-control form-control-sm" style="width:60px;" value="1" required>
                                        </div></div>
                                        <div class="col-6"><div class="d-flex align-items-center mb-1">
                                            <label class="small text-muted me-1" style="width:45px;">PAR:</label>
                                            <input type="number" name="pars[]" class="form-control form-control-sm" style="width:60px;" value="4" min="3" max="6" required>
                                        </div></div>
                                        <div class="col-6"><div class="d-flex align-items-center mb-1">
                                            <label class="small text-muted me-1" style="width:45px;"><span style="color:gold;">●</span> G:</label>
                                            <input type="number" name="golds[]" class="form-control form-control-sm" style="width:60px;" value="0" min="0" required>
                                        </div></div>
                                        <div class="col-6"><div class="d-flex align-items-center mb-1">
                                            <label class="small text-muted me-1" style="width:45px;"><span style="color:blue;">●</span> B:</label>
                                            <input type="number" name="blues[]" class="form-control form-control-sm" style="width:60px;" value="0" min="0" required>
                                        </div></div>
                                        <div class="col-6"><div class="d-flex align-items-center mb-1">
                                            <label class="small text-muted me-1" style="width:45px;"><span style="color:#666;">●</span> W:</label>
                                            <input type="number" name="whites[]" class="form-control form-control-sm" style="width:60px;" value="0" min="0" required>
                                        </div></div>
                                        <div class="col-6"><div class="d-flex align-items-center mb-1">
                                            <label class="small text-muted me-1" style="width:45px;"><span style="color:#C0C0C0;">●</span> S:</label>
                                            <input type="number" name="silvers[]" class="form-control form-control-sm" style="width:60px;" value="0" min="0" required>
                                        </div></div>
                                        <div class="col-6"><div class="d-flex align-items-center mb-1">
                                            <label class="small text-muted me-1" style="width:45px;"><span style="color:red;">●</span> R:</label>
                                            <input type="number" name="reds[]" class="form-control form-control-sm" style="width:60px;" value="0" min="0" required>
                                        </div></div>
                                        <div class="col-6"><div class="d-flex align-items-center mb-1">
                                            <label class="small text-muted me-1" style="width:45px;">Men H:</label>
                                            <input type="number" name="men_handicaps[]" class="form-control form-control-sm" style="width:60px;" value="0" min="0" max="36" required>
                                        </div></div>
                                        <div class="col-6"><div class="d-flex align-items-center mb-1">
                                            <label class="small text-muted me-1" style="width:45px;">Lady H:</label>
                                            <input type="number" name="ladies_handicaps[]" class="form-control form-control-sm" style="width:60px;" value="0" min="0" max="36" required>
                                        </div></div>
                                    </div>
                                </div>
                            </div>`);
                    }
                });
            }

            // Attach dynamic fields to every add-image form
            document.querySelectorAll('[id^="langerFileInput"]').forEach(input => {
                const id = input.id.replace('langerFileInput', '');
                const container = document.getElementById('langerNewFields' + id);
                if (container) buildAddFields(input, container);
            });

            document.querySelectorAll('[id^="couplesFileInput"]').forEach(input => {
                const id = input.id.replace('couplesFileInput', '');
                const container = document.getElementById('couplesNewFields' + id);
                if (container) buildAddFields(input, container);
            });
        });
    </script>
@endsection

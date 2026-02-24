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

        /* Replace the gallery-grid with this */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* Force 3 columns */
            gap: 15px;
            margin-bottom: 1rem;
        }

        .gallery-card {
            width: 100% !important;
            margin: 0 !important;
            display: flex;
            flex-direction: column;
            max-width: none;
            /* Remove any max-width restrictions */
        }

        /* Make the image container responsive */
        .gallery-card .fixed-image-container {
            width: 100%;
            height: 120px;
        }

        /* Compact field styles */
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

        /* Ensure the form doesn't overflow */
        .gallery-card form {
            width: 100%;
        }

        /* Responsive for smaller screens */
        @media (max-width: 1400px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                /* 2 columns on smaller screens */
            }
        }

        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: 1fr;
                /* 1 column on mobile */
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
                        <!-- Langer Column -->
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

                            <!-- Langer Gallery Images Section -->
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

                                                    <!-- Image -->
                                                    <div class="fixed-image-container" style="width:100%; height:120px;">
                                                        <img src="{{ asset('storage/' . $img['image']) }}"
                                                            alt="Gallery image">
                                                    </div>

                                                    <!-- Compact Fields in 2 columns -->
                                                    <div class="row g-1 mt-1">
                                                        <!-- Hole # -->
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

                                                        <!-- PAR -->
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

                                                        <!-- Gold -->
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: gold;" class="small-bullet">●</span>
                                                                    G:
                                                                </label>
                                                                <input type="number" name="gold"
                                                                    value="{{ $img['gold'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" min="0" required>
                                                            </div>
                                                        </div>

                                                        <!-- Blue -->
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: blue;" class="small-bullet">●</span>
                                                                    B:
                                                                </label>
                                                                <input type="number" name="blue"
                                                                    value="{{ $img['blue'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" min="0" required>
                                                            </div>
                                                        </div>

                                                        <!-- White -->
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: #666;"
                                                                        class="small-bullet">●</span> W:
                                                                </label>
                                                                <input type="number" name="white"
                                                                    value="{{ $img['white'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" min="0" required>
                                                            </div>
                                                        </div>

                                                        <!-- Red -->
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: red;"
                                                                        class="small-bullet">●</span> R:
                                                                </label>
                                                                <input type="number" name="red"
                                                                    value="{{ $img['red'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" min="0" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Update Image -->
                                                    <div class="mb-1 mt-1">
                                                        <input type="file" name="image"
                                                            class="form-control form-control-sm" accept="image/*"
                                                            data-max-size="5120"
                                                            style="font-size:0.7rem; padding:0.15rem;">
                                                        <div class="file-size-info" style="font-size:0.6rem;">Max:5MB
                                                        </div>
                                                    </div>

                                                    <!-- Buttons side by side -->
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
                                <!-- New images input with all fields -->
                                <form action="{{ route('admin.courses.add_image', [$course->id, 'langer']) }}"
                                    method="POST" enctype="multipart/form-data" class="mt-3 p-3 border rounded"
                                    id="langerAddForm{{ $course->id }}">
                                    @csrf
                                    <h6 class="mb-3">Add New Images</h6>

                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label fw-semibold">Select Images:</label>
                                            <input type="file" name="images[]" class="form-control" multiple
                                                accept="image/*" data-max-size="5120" required>
                                            <div class="file-size-info">Maximum file size per image: 5MB</div>
                                        </div>
                                    </div>

                                    <div class="row mt-2" id="new-image-fields">
                                        <!-- Fields will be cloned via JavaScript for each selected file -->
                                    </div>

                                    <button type="submit" class="btn btn-success btn-sm mt-2">Add Images</button>
                                </form>
                            </div>
                        </div>

                        <!-- Couples Column -->
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

                            <!-- Couples Gallery Images Section -->
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

                                                    <!-- Image -->
                                                    <div class="fixed-image-container" style="width:100%; height:120px;">
                                                        <img src="{{ asset('storage/' . $img['image']) }}"
                                                            alt="Gallery image">
                                                    </div>

                                                    <!-- Compact Fields in 2 columns -->
                                                    <div class="row g-1 mt-1">
                                                        <!-- Hole # -->
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

                                                        <!-- PAR -->
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

                                                        <!-- Gold -->
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: gold;"
                                                                        class="small-bullet">●</span> G:
                                                                </label>
                                                                <input type="number" name="gold"
                                                                    value="{{ $img['gold'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" min="0" required>
                                                            </div>
                                                        </div>

                                                        <!-- Blue -->
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: blue;"
                                                                        class="small-bullet">●</span> B:
                                                                </label>
                                                                <input type="number" name="blue"
                                                                    value="{{ $img['blue'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" min="0" required>
                                                            </div>
                                                        </div>

                                                        <!-- White -->
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: #666;"
                                                                        class="small-bullet">●</span> W:
                                                                </label>
                                                                <input type="number" name="white"
                                                                    value="{{ $img['white'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" min="0" required>
                                                            </div>
                                                        </div>

                                                        <!-- Red -->
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center compact-field">
                                                                <label class="small text-muted me-1 compact-label">
                                                                    <span style="color: red;"
                                                                        class="small-bullet">●</span> R:
                                                                </label>
                                                                <input type="number" name="red"
                                                                    value="{{ $img['red'] ?? 0 }}"
                                                                    class="form-control form-control-sm"
                                                                    style="width: 55px;" min="0" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Update Image -->
                                                    <div class="mb-1 mt-1">
                                                        <input type="file" name="image"
                                                            class="form-control form-control-sm" accept="image/*"
                                                            data-max-size="5120"
                                                            style="font-size:0.7rem; padding:0.15rem;">
                                                        <div class="file-size-info" style="font-size:0.6rem;">Max:5MB
                                                        </div>
                                                    </div>

                                                    <!-- Buttons side by side -->
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
                                <!-- New images input with all fields -->
                                <form action="{{ route('admin.courses.add_image', [$course->id, 'couples']) }}"
                                    method="POST" enctype="multipart/form-data" class="mt-3 p-3 border rounded"
                                    id="couplesAddForm{{ $course->id }}">
                                    @csrf
                                    <h6 class="mb-3">Add New Images</h6>

                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label fw-semibold">Select Images:</label>
                                            <input type="file" name="images[]" class="form-control" multiple
                                                accept="image/*" data-max-size="5120" required>
                                            <div class="file-size-info">Maximum file size per image: 5MB</div>
                                        </div>
                                    </div>

                                    <div class="row mt-2" id="new-image-fields">
                                        <!-- Fields will be cloned via JavaScript for each selected file -->
                                    </div>

                                    <button type="submit" class="btn btn-success btn-sm mt-2">Add Images</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Course Modal for {{ $course->id }} -->
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

            <!-- Delete Image Modals for Langer Course -->
            @if ($course->langer_images)
                @foreach ($course->langer_images as $index => $img)
                    <div class="modal fade" id="deleteImageModal{{ $course->id }}_langer_{{ $index }}"
                        tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                </div>
                                <div class="modal-body text-black">
                                    Are you sure you want to delete this image? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{ route('admin.courses.delete_image', [$course->id, 'langer', $index]) }}"
                                        class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <!-- Delete Image Modals for Couples Course -->
            @if ($course->couples_images)
                @foreach ($course->couples_images as $index => $img)
                    <div class="modal fade" id="deleteImageModal{{ $course->id }}_couples_{{ $index }}"
                        tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                </div>
                                <div class="modal-body text-black">
                                    Are you sure you want to delete this image? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{ route('admin.courses.delete_image', [$course->id, 'couples', $index]) }}"
                                        class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        @empty
            <div class="alert alert-info">No courses found. Please add a course.</div>
        @endforelse

        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title">Success</h5>
                    </div>
                    <div class="modal-body text-black">
                        {{ session('modal_message') }}
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Modal for file size validation -->
        <div class="modal fade" id="errorModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>File Too Large
                        </h5>
                    </div>
                    <div class="modal-body text-black" id="errorModalMessage">
                        <!-- Error message will be inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        @if ($courses->isEmpty())
            <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data"
                            id="addCourseForm">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Course</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Langer Column -->
                                    <div class="col-md-6 border-end">
                                        <h5 class="fw-bold">Langer Course</h5>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="fw-semibold me-3" style="width: 120px;">Parent
                                                    Title:</label>
                                                <input type="text" name="langer_Mtitle" class="form-control"
                                                    placeholder="Parent Title" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="me-3" style="width: 120px;">Parent Main Image:</label>
                                                <input type="file" name="langer_Mimage" class="form-control"
                                                    accept="image/*" data-max-size="5120" required>
                                            </div>
                                            <div class="file-size-info">Maximum file size: 5MB</div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="fw-semibold me-3" style="width: 120px;">Child Title:</label>
                                                <input type="text" name="langer_title" class="form-control"
                                                    placeholder="Child Title" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="me-3 d-block mb-2" style="width: 120px;">Description:</label>
                                            <textarea name="langer_description" class="form-control" rows="3" placeholder="Description" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="me-3" style="width: 120px;">Gallery Images:</label>
                                                <input type="file" name="langer_images[]" class="form-control"
                                                    multiple accept="image/*" data-max-size="5120">
                                            </div>
                                            <div class="file-size-info">Maximum file size per image: 5MB</div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <label class="small text-muted me-3" style="width: 120px;">Hole #:</label>
                                                <input type="number" name="new_langer_holes[]" class="form-control"
                                                    placeholder="Enter hole number">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Couples Column -->
                                    <div class="col-md-6 ps-4">
                                        <h5 class="fw-bold">Couples Course</h5>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="fw-semibold me-3" style="width: 120px;">Parent
                                                    Title:</label>
                                                <input type="text" name="couples_Mtitle" class="form-control"
                                                    placeholder="Parent Title" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="me-3" style="width: 120px;">Parent Main Image:</label>
                                                <input type="file" name="couples_Mimage" class="form-control"
                                                    accept="image/*" data-max-size="5120" required>
                                            </div>
                                            <div class="file-size-info">Maximum file size: 5MB</div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="fw-semibold me-3" style="width: 120px;">Child Title:</label>
                                                <input type="text" name="couples_title" class="form-control"
                                                    placeholder="Child Title" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="me-3 d-block mb-2" style="width: 120px;">Description:</label>
                                            <textarea name="couples_description" class="form-control" rows="3" placeholder="Description" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="me-3" style="width: 120px;">Gallery Images:</label>
                                                <input type="file" name="couples_images[]" class="form-control"
                                                    multiple accept="image/*" data-max-size="5120">
                                            </div>
                                            <div class="file-size-info">Maximum file size per image: 5MB</div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <label class="small text-muted me-3" style="width: 120px;">Hole #:</label>
                                                <input type="number" name="new_couples_holes[]" class="form-control"
                                                    placeholder="Enter hole number">
                                            </div>
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
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                var errorMessage = '';

                @foreach ($errors->all() as $error)
                    errorMessage += '{{ $error }}<br>';
                @endforeach

                document.getElementById('errorModalMessage').innerHTML = errorMessage;
                errorModal.show();
            });
        </script>
    @endif

    <script>
        // File size validation before form submission
        document.addEventListener('DOMContentLoaded', function() {
            // Function to show error modal
            function showErrorModal(message) {
                document.getElementById('errorModalMessage').innerHTML = message;
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
                return false;
            }

            // Function to check file size
            function checkFileSize(fileInput, maxSizeKB) {
                if (fileInput.files) {
                    for (let i = 0; i < fileInput.files.length; i++) {
                        const file = fileInput.files[i];
                        const fileSizeKB = file.size / 1024;

                        if (fileSizeKB > maxSizeKB) {
                            const fileSizeMB = (fileSizeKB / 1024).toFixed(2);
                            const maxSizeMB = (maxSizeKB / 1024).toFixed(2);
                            return `"${file.name}" is ${fileSizeMB}MB. Maximum allowed size is ${maxSizeMB}MB.`;
                        }
                    }
                }
                return null;
            }

            // Validate all forms with file inputs
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const fileInputs = this.querySelectorAll('input[type="file"][data-max-size]');
                    let errorMessage = null;

                    fileInputs.forEach(input => {
                        const maxSizeKB = parseInt(input.getAttribute('data-max-size'));
                        const error = checkFileSize(input, maxSizeKB);
                        if (error) {
                            errorMessage = error;
                        }
                    });

                    if (errorMessage) {
                        e.preventDefault();
                        showErrorModal(errorMessage);
                    }
                });
            });

            // Also validate on file input change for immediate feedback
            const fileInputs = document.querySelectorAll('input[type="file"][data-max-size]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const maxSizeKB = parseInt(this.getAttribute('data-max-size'));
                    const error = checkFileSize(this, maxSizeKB);

                    if (error) {
                        showErrorModal(error);
                        this.value = ''; // Clear the invalid file
                    }
                });
            });
        });
    </script>
    <script>
        document.querySelector('input[name="images[]"]').addEventListener('change', function(e) {
            const container = document.getElementById('new-image-fields');
            container.innerHTML = '';

            for (let i = 0; i < this.files.length; i++) {
                const fieldHtml = `
            <div class="col-md-6 mb-2">
                <div class="border p-2 rounded">
                    <small class="d-block mb-2 fw-bold">Image ${i + 1}: ${this.files[i].name}</small>
                    <div class="d-flex align-items-center mb-1">
                        <label class="small text-muted me-2" style="width: 60px;">Hole #:</label>
                        <input type="number" name="holes[]" class="form-control form-control-sm" style="width: 80px;" value="1" required>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <label class="small text-muted me-2" style="width: 60px;">PAR:</label>
                        <input type="number" name="pars[]" class="form-control form-control-sm" style="width: 80px;" value="4" min="3" max="6" required>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <label class="small text-muted me-2" style="width: 60px;"><span style="color: gold;">●</span> Gold:</label>
                        <input type="number" name="golds[]" class="form-control form-control-sm" style="width: 80px;" value="0" min="0" required>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <label class="small text-muted me-2" style="width: 60px;"><span style="color: blue;">●</span> Blue:</label>
                        <input type="number" name="blues[]" class="form-control form-control-sm" style="width: 80px;" value="0" min="0" required>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <label class="small text-muted me-2" style="width: 60px;"><span style="color: #666;">●</span> White:</label>
                        <input type="number" name="whites[]" class="form-control form-control-sm" style="width: 80px;" value="0" min="0" required>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <label class="small text-muted me-2" style="width: 60px;"><span style="color: red;">●</span> Red:</label>
                        <input type="number" name="reds[]" class="form-control form-control-sm" style="width: 80px;" value="0" min="0" required>
                    </div>
                </div>
            </div>
        `;
                container.insertAdjacentHTML('beforeend', fieldHtml);
            }
        });
    </script>
@endsection

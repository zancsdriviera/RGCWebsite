@extends('admin.layout')
@section('title', 'Courses')

@section('content')
    <div class="container-fluid px-4 py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 fw-bold">Courses Management</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add New Course</button>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @forelse($courses as $course)
            <div class="card mb-4 shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $course->langer_Mtitle }} / {{ $course->couples_Mtitle }}</h5>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this course?')">Delete
                            Course</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Langer Column -->
                        <div class="col-md-6 border-end">
                            <h5 class="fw-bold">Langer Course</h5>
                            <form action="{{ route('courses.update', $course->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label class="fw-semibold">Parent Title</label>
                                <input type="text" name="langer_Mtitle" class="form-control mb-2"
                                    value="{{ $course->langer_Mtitle }}" required>

                                <label>Parent Main Image</label>
                                @if ($course->langer_Mimage)
                                    <img src="{{ asset('storage/' . $course->langer_Mimage) }}" width="120"
                                        class="mb-2 d-block">
                                @endif
                                <input type="file" name="langer_Mimage" class="form-control mb-3">

                                <label class="fw-semibold">Child Title</label>
                                <input type="text" name="langer_title" class="form-control mb-2"
                                    value="{{ $course->langer_title }}">

                                <label>Description</label>
                                <textarea name="langer_description" class="form-control mb-2" rows="3">{{ $course->langer_description }}</textarea>
                                <button type="submit" class="btn btn-primary btn-sm mb-3">Update Langer Details</button>
                            </form>

                            <!-- Langer Gallery Images Section -->
                            <div class="mt-4">
                                <label class="fw-bold">Gallery Images</label>
                                <div class="d-flex flex-wrap mb-2">
                                    @if ($course->langer_images)
                                        @foreach ($course->langer_images as $index => $img)
                                            <form
                                                action="{{ route('courses.update_image', [$course->id, 'langer', $index]) }}"
                                                method="POST" enctype="multipart/form-data"
                                                class="card m-1 p-2 text-center" style="width:120px;">
                                                @csrf
                                                @method('PUT')
                                                <img src="{{ asset('storage/' . $img['image']) }}" width="100"
                                                    class="mb-1">

                                                <!-- Hole # with label on left -->
                                                <div class="d-flex align-items-center mb-1">
                                                    <label class="small text-muted me-2" style="width: 50px;">Hole
                                                        #:</label>
                                                    <input type="number" name="hole" value="{{ $img['hole'] }}"
                                                        class="form-control form-control-sm" placeholder="#"
                                                        style="width: 50px;">
                                                </div>

                                                <!-- Update Image with label on left -->
                                                <div class="mb-1">
                                                    <label class="small text-muted d-block mb-1">Update Image:</label>
                                                    <input type="file" name="image"
                                                        class="form-control form-control-sm">
                                                </div>

                                                <button type="submit"
                                                    class="btn btn-primary btn-sm mb-1 w-100">Update</button>
                                                <a href="{{ route('courses.delete_image', [$course->id, 'langer', $index]) }}"
                                                    class="btn btn-danger btn-sm w-100"
                                                    onclick="return confirm('Delete this image?')">Delete</a>
                                            </form>
                                        @endforeach
                                    @endif
                                </div>
                                <!-- New images input -->
                                <form action="{{ route('courses.add_image', [$course->id, 'langer']) }}" method="POST"
                                    enctype="multipart/form-data" class="mt-2">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-center">
                                                <label class="small text-muted me-2" style="width: 120px;">Select
                                                    Images:</label>
                                                <input type="file" name="images[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <label class="small text-muted me-2" style="width: 120px;">Hole #:</label>
                                                <input type="number" name="holes[]" class="form-control" placeholder="#">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm w-100">Add Images</button>
                                </form>
                            </div>
                        </div>

                        <!-- Couples Column -->
                        <div class="col-md-6 ps-4">
                            <h5 class="fw-bold">Couples Course</h5>
                            <form action="{{ route('courses.update', $course->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label class="fw-semibold">Parent Title</label>
                                <input type="text" name="couples_Mtitle" class="form-control mb-2"
                                    value="{{ $course->couples_Mtitle }}" required>

                                <label>Parent Main Image</label>
                                @if ($course->couples_Mimage)
                                    <img src="{{ asset('storage/' . $course->couples_Mimage) }}" width="120"
                                        class="mb-2 d-block">
                                @endif
                                <input type="file" name="couples_Mimage" class="form-control mb-3">

                                <label class="fw-semibold">Child Title</label>
                                <input type="text" name="couples_title" class="form-control mb-2"
                                    value="{{ $course->couples_title }}">

                                <label>Description</label>
                                <textarea name="couples_description" class="form-control mb-2" rows="3">{{ $course->couples_description }}</textarea>
                                <button type="submit" class="btn btn-primary btn-sm mb-3">Update Couples Details</button>
                            </form>

                            <!-- Couples Gallery Images Section -->
                            <div class="mt-4">
                                <label class="fw-bold">Gallery Images</label>
                                <div class="d-flex flex-wrap mb-2">
                                    @if ($course->couples_images)
                                        @foreach ($course->couples_images as $index => $img)
                                            <form
                                                action="{{ route('courses.update_image', [$course->id, 'couples', $index]) }}"
                                                method="POST" enctype="multipart/form-data"
                                                class="card m-1 p-2 text-center" style="width:120px;">
                                                @csrf
                                                @method('PUT')
                                                <img src="{{ asset('storage/' . $img['image']) }}" width="100"
                                                    class="mb-1">

                                                <!-- Hole # with label on left -->
                                                <div class="d-flex align-items-center mb-1">
                                                    <label class="small text-muted me-2" style="width: 50px;">Hole
                                                        #:</label>
                                                    <input type="number" name="hole" value="{{ $img['hole'] }}"
                                                        class="form-control form-control-sm" placeholder="#"
                                                        style="width: 50px;">
                                                </div>

                                                <!-- Update Image with label on left -->
                                                <div class="mb-1">
                                                    <label class="small text-muted d-block mb-1">Update Image:</label>
                                                    <input type="file" name="image"
                                                        class="form-control form-control-sm">
                                                </div>

                                                <button type="submit"
                                                    class="btn btn-primary btn-sm mb-1 w-100">Update</button>
                                                <a href="{{ route('courses.delete_image', [$course->id, 'couples', $index]) }}"
                                                    class="btn btn-danger btn-sm w-100"
                                                    onclick="return confirm('Delete this image?')">Delete</a>
                                            </form>
                                        @endforeach
                                    @endif
                                </div>
                                <!-- New images input -->
                                <form action="{{ route('courses.add_image', [$course->id, 'couples']) }}" method="POST"
                                    enctype="multipart/form-data" class="mt-2">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-center">
                                                <label class="small text-muted me-2" style="width: 120px;">Select
                                                    Images:</label>
                                                <input type="file" name="images[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <label class="small text-muted me-2" style="width: 120px;">Hole #:</label>
                                                <input type="number" name="holes[]" class="form-control"
                                                    placeholder="#">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm w-100">Add Images</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">No courses found. Please add a course.</div>
        @endforelse

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <label class="fw-semibold me-3" style="width: 120px;">Parent Title:</label>
                                            <input type="text" name="langer_Mtitle" class="form-control"
                                                placeholder="Parent Title" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <label class="me-3" style="width: 120px;">Parent Main Image:</label>
                                            <input type="file" name="langer_Mimage" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <label class="fw-semibold me-3" style="width: 120px;">Child Title:</label>
                                            <input type="text" name="langer_title" class="form-control"
                                                placeholder="Child Title">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="me-3 d-block mb-2" style="width: 120px;">Description:</label>
                                        <textarea name="langer_description" class="form-control" rows="3" placeholder="Description"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <label class="me-3" style="width: 120px;">Gallery Images:</label>
                                            <input type="file" name="langer_images[]" class="form-control" multiple>
                                        </div>
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
                                            <label class="fw-semibold me-3" style="width: 120px;">Parent Title:</label>
                                            <input type="text" name="couples_Mtitle" class="form-control"
                                                placeholder="Parent Title" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <label class="me-3" style="width: 120px;">Parent Main Image:</label>
                                            <input type="file" name="couples_Mimage" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <label class="fw-semibold me-3" style="width: 120px;">Child Title:</label>
                                            <input type="text" name="couples_title" class="form-control"
                                                placeholder="Child Title">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="me-3 d-block mb-2" style="width: 120px;">Description:</label>
                                        <textarea name="couples_description" class="form-control" rows="3" placeholder="Description"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <label class="me-3" style="width: 120px;">Gallery Images:</label>
                                            <input type="file" name="couples_images[]" class="form-control" multiple>
                                        </div>
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
    </div>
@endsection

@extends('admin.layout')
@section('title', 'Courses')

@section('content')
    <div class="container-fluid px-4 py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 fw-bold">Courses</h3>
        </div>

        <!-- Add Course Button -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Add Course</button>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Courses Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Langer Title</th>
                        <th>Langer Image</th>
                        <th>Couples Title</th>
                        <th>Couples Image</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td>{{ $course->langer_Mtitle }}</td>
                            <td>
                                @if ($course->langer_Mimage)
                                    <img src="{{ asset('storage/' . $course->langer_Mimage) }}" width="80"
                                        class="img-thumbnail">
                                @endif
                            </td>
                            <td>{{ $course->couples_Mtitle }}</td>
                            <td>
                                @if ($course->couples_Mimage)
                                    <img src="{{ asset('storage/' . $course->couples_Mimage) }}" width="80"
                                        class="img-thumbnail">
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $course->id }}">Edit</button>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this course?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $course->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('courses.update', $course->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Course</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="fw-semibold">Langer Title</label>
                                            <input type="text" name="langer_Mtitle" class="form-control mb-2"
                                                value="{{ $course->langer_Mtitle }}" required>
                                            <label>Current Image</label>
                                            @if ($course->langer_Mimage)
                                                <img src="{{ asset('storage/' . $course->langer_Mimage) }}" width="100"
                                                    class="mb-2 d-block">
                                            @endif
                                            <input type="file" name="langer_Mimage" class="form-control mb-3">

                                            <label class="fw-semibold">Couples Title</label>
                                            <input type="text" name="couples_Mtitle" class="form-control mb-2"
                                                value="{{ $course->couples_Mtitle }}" required>
                                            <label>Current Image</label>
                                            @if ($course->couples_Mimage)
                                                <img src="{{ asset('storage/' . $course->couples_Mimage) }}" width="100"
                                                    class="mb-2 d-block">
                                            @endif
                                            <input type="file" name="couples_Mimage" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No courses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label class="fw-semibold">Langer Title</label>
                        <input type="text" name="langer_Mtitle" class="form-control mb-2" placeholder="Title" required>
                        <label>Langer Image</label>
                        <input type="file" name="langer_Mimage" class="form-control mb-3">
                        <label class="fw-semibold">Couples Title</label>
                        <input type="text" name="couples_Mtitle" class="form-control mb-2" placeholder="Title" required>
                        <label>Couples Image</label>
                        <input type="file" name="couples_Mimage" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

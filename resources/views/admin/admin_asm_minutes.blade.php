@extends('admin.layout')

@section('title', 'ASM Minutes')

@section('content')
    <div class="container mt-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h3 class="mb-3 fw-bold">ASM Minutes Document List</h3>

        <!-- Upload Form -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.asm_minutes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-3">
                            <input type="number" name="year" class="form-control" placeholder="Year" required>
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="file" class="form-control" accept="application/pdf" required>
                        </div>
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-success"><i class="bi bi-file-earmark-arrow-up me-2"></i>Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table List -->
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Uploaded Documents</div>

            <div class="card-body p-0">
                <table class="table table-bordered table-striped m-0 text-center">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>File</th>
                            <th style="width:150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($docs as $doc)
                            <tr>
                                <td>{{ $doc->year }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                        class="btn btn-link">
                                        View PDF
                                    </a>
                                </td>
                                <td>
                                    <div class="d-grid gap-1">
                                        <!-- Edit Button -->
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $doc->id }}"><i
                                                class="bi bi-pencil-square"></i> Edit</button>

                                        <!-- Delete Form -->
                                        <form action="{{ route('admin.asm_minutes.delete', $doc->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this document?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm w-100"><i class="bi bi-trash"></i>
                                                Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $doc->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Document </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.asm_minutes.update', $doc->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="year{{ $doc->id }}" class="form-label">Year</label>
                                                    <input type="number" name="year" id="year{{ $doc->id }}"
                                                        class="form-control" value="{{ $doc->year }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="file{{ $doc->id }}" class="form-label">Replace File
                                                        (optional)
                                                    </label>
                                                    <input type="file" name="file" id="file{{ $doc->id }}"
                                                        class="form-control" accept="application/pdf">
                                                    <small class="text-muted">Leave empty to keep current file</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if ($docs->isEmpty())
                            <tr>
                                <td colspan="3" class="text-muted">No documents uploaded yet.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush

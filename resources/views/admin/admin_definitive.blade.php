@extends('admin.layout')

@section('title', 'Definitive Statement')

@section('content')
    <style>
        /* Fix for update image modal in dark mode */
        body.dark-mode .modal-content {
            background-color: #ffffff;
        }

        body.dark-mode .modal-body {
            color: #212529 !important;
            background-color: #ffffff;
        }

        body.dark-mode .modal-body .text-muted {
            color: #6c757d !important;
        }

        body.dark-mode .modal-body p {
            color: #212529 !important;
        }

        body.dark-mode .modal-body label {
            color: #212529 !important;
        }

        body.dark-mode .modal-body .form-label {
            color: #212529 !important;
        }

        body.dark-mode .modal-body .form-control {
            background-color: #ffffff;
            border-color: #ced4da;
            color: #212529;
        }

        body.dark-mode .modal-body .form-control:focus {
            background-color: #ffffff;
            color: #212529;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        body.dark-mode .modal-body .form-text {
            color: #6c757d !important;
        }

        body.dark-mode .modal-body .img-fluid.rounded {
            background-color: #f8f9fa;
        }

        body.dark-mode .modal-footer {
            background-color: #ffffff;
            border-top-color: #dee2e6;
        }

        body.dark-mode .modal-header {
            border-bottom-color: #dee2e6;
        }

        body.dark-mode .modal-header.bg-primary.text-white h5,
        body.dark-mode .modal-header.bg-primary.text-white {
            color: #ffffff !important;
        }

        body.dark-mode .btn-secondary {
            background-color: #6c757d;
            color: #ffffff;
        }

        body.dark-mode .btn-secondary:hover {
            background-color: #5c636a;
            color: #ffffff;
        }

        body.dark-mode .btn-primary {
            background-color: #0d6efd;
            color: #ffffff;
        }

        body.dark-mode .btn-primary:hover {
            background-color: #0b5ed7;
            color: #ffffff;
        }

        /* Fix for success modal in dark mode */
        body.dark-mode .modal-content {
            background-color: #ffffff;
        }

        body.dark-mode .modal-body {
            color: #212529 !important;
            background-color: #ffffff;
        }

        body.dark-mode .modal-body span {
            color: #212529 !important;
        }

        body.dark-mode .modal-footer {
            background-color: #ffffff;
            border-top-color: #dee2e6;
        }

        body.dark-mode .modal-header {
            border-bottom-color: #dee2e6;
        }

        body.dark-mode .modal-header.btn-success.text-white h5,
        body.dark-mode .modal-header.btn-success.text-white {
            color: #ffffff !important;
            background-color: #198754 !important;
        }

        body.dark-mode .btn-primary {
            background-color: #0d6efd;
            color: #ffffff;
        }

        body.dark-mode .btn-primary:hover {
            background-color: #0b5ed7;
            color: #ffffff;
        }

        /* Prevent success alert from being affected by dark mode */
        body.dark-mode .alert.alert-success {
            background-color: #d1e7dd !important;
            border-color: #badbcc !important;
            color: #0f5132 !important;
        }
    </style>
    <div class="container mt-4">

        <h3 class="mb-3 fw-bold">Definitive Information Statement Document List</h3>

        <!-- Upload Form -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.definitive.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-3">
                            <input type="number" name="year" class="form-control" placeholder="Year" required>
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="file" class="form-control" accept="application/pdf" required>
                        </div>
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-success"><i class="bi bi-file-earmark-arrow-up me-1"></i>Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table List -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0">Uploaded Documents</h5>
            </div>
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
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $doc->id }}"><i
                                                class="bi bi-pencil-square"></i> Edit</button>

                                        <!-- Delete Form -->
                                        <button type="button"
                                            class="btn btn-outline-danger btn-sm w-100 delete-definitive-btn"
                                            data-url="{{ route('admin.definitive.delete', $doc->id) }}"
                                            data-bs-toggle="modal" data-bs-target="#deleteDefinitiveModal">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>

                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $doc->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Edit Document </h5>
                                        </div>
                                        <form action="{{ route('admin.definitive.update', $doc->id) }}" method="POST"
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
                                                    <label for="file{{ $doc->id }}" class="form-label">Replace
                                                        File
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
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="bi bi-check2-square me-1"></i>Save Changes</button>
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
    {{-- Delete Modal for Definitive Documents --}}
    <div class="modal fade" id="deleteDefinitiveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteDefinitiveForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Confirm Delete</h5>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this document?
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
    <script>
        //Delete modal setup
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForm = document.getElementById('deleteDefinitiveForm');

            document.querySelectorAll('.delete-definitive-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const url = btn.getAttribute('data-url');
                    deleteForm.setAttribute('action', url);
                });
            });
        });

        // Show success modal if session has modal_message
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                const modalEl = document.getElementById('successModal');
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.textContent = "{{ session('success') }}";
                modalBody.style.color = 'green'; // optional: color

                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // Auto-close after 1.5s
                setTimeout(() => modal.hide(), 3000);
            @endif
        });
    </script>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@extends('admin.layout')
@section('title', 'Membership')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Membership</h3>

        {{-- Success / Error Messages --}}
        {{-- @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Add New Content Form --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5>Add New Membership Content</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.membership.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Content Type</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="download">Download</option>
                            <option value="members_data">Member's Data</option>
                            <option value="bank">Bank</option>
                        </select>
                    </div>

                    <div id="dynamic-fields">
                        {{-- download --}}
                        <div class="type-download d-none">
                            <label>Download Title</label>
                            <input type="text" name="title" class="form-control mb-3" required>

                            <label>PDF File</label>
                            <input type="file" name="download_file" class="form-control" accept="application/pdf,.pdf"
                                required>
                        </div>

                        {{-- members_data --}}
                        <div class="type-members_data d-none">
                            <label>Member's Data Card Image</label>
                            <input type="file" name="members_image" class="form-control mb-2" accept="image/*" required
                                onchange="previewImage(event, '#add_applicant_preview')">
                            <img id="add_applicant_preview" src="#" class="img-thumbnail d-none mb-2" width="200">
                        </div>

                        {{-- bank --}}
                        <div class="type-bank d-none">
                            <label>Bank Logo</label>
                            <input type="file" name="bank_top_image" class="form-control mb-2" accept="image/*" required
                                onchange="previewImage(event, '#add_top_preview')">
                            <img id="add_top_preview" src="#" class="img-thumbnail d-none mb-2" width="100">

                            <label>QR Code</label>
                            <input type="file" name="bank_qr_image" class="form-control mb-2" accept="image/*" required
                                onchange="previewImage(event, '#add_qr_preview')">
                            <img id="add_qr_preview" src="#" class="img-thumbnail d-none mb-2" width="100">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-file-earmark-plus me-2"></i>Add
                        Content</button>
                </form>
            </div>
        </div>

        {{-- Existing Content Table --}}
        <div class="card">
            <div class="card-header">
                <h5>Existing Membership Content</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle text-center table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Title / Image</th>
                            <th>Preview</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contents as $content)
                            <tr class="text-center">
                                <td>{{ $content->id }}</td>
                                <td>{{ ucfirst($content->type) }}</td>
                                <td>
                                    @if ($content->type === 'download')
                                        {{ $content->title }}
                                    @elseif($content->type === 'members_data')
                                        Member's Data Card
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($content->file_path)
                                        @if (Str::endsWith($content->file_path, ['.pdf']))
                                            <a href="{{ asset('storage/' . $content->file_path) }}" target="_blank">View
                                                PDF</a>
                                        @else
                                            <img src="{{ asset('storage/' . $content->file_path) }}" width="80">
                                        @endif
                                    @elseif($content->type === 'bank')
                                        @if ($content->top_image)
                                            <img src="{{ asset('storage/' . $content->top_image) }}" width="50">
                                        @endif
                                        @if ($content->qr_image)
                                            <img src="{{ asset('storage/' . $content->qr_image) }}" width="50">
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $content->id }}"
                                        data-type="{{ $content->type }}" data-title="{{ $content->title ?? '' }}"
                                        data-file="{{ $content->file_path ?? '' }}"
                                        data-top="{{ $content->top_image ?? '' }}"
                                        data-qr="{{ $content->qr_image ?? '' }}" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>

                                    <button type="button" class="btn btn-sm btn-danger delete-btn"
                                        data-id="{{ $content->id }}"
                                        data-url="{{ route('admin.membership.destroy', $content->id) }}"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No content added yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title">Edit Membership Content</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label>Type</label>
                            <input type="text" id="edit_type" name="type" class="form-control" readonly>
                        </div>
                        <div id="edit-fields"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Delete Membership Content</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Confirm</button>
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
        //Success Modal Setup
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

        // Delete Modal Setup
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForm = document.getElementById('deleteForm');

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const url = btn.getAttribute('data-url');
                    deleteForm.setAttribute('action', url);
                });
            });
        });

        const typeSelect = document.getElementById('type');
        const downloadFields = document.querySelector('.type-download');
        const applicantFields = document.querySelector('.type-members_data');
        const bankFields = document.querySelector('.type-bank');

        function toggleRequired(fields, isRequired) {
            fields.querySelectorAll('input').forEach(el => {
                if (isRequired) el.setAttribute('required', true);
                else el.removeAttribute('required');
            });
        }

        typeSelect.addEventListener('change', () => {
            const val = typeSelect.value;
            downloadFields.classList.toggle('d-none', val !== 'download');
            applicantFields.classList.toggle('d-none', val !== 'members_data');
            bankFields.classList.toggle('d-none', val !== 'bank');
            toggleRequired(downloadFields, val === 'download');
            toggleRequired(applicantFields, val === 'members_data');
            toggleRequired(bankFields, val === 'bank');
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const type = btn.dataset.type;
                const modal = document.getElementById('edit-fields');
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_type').value = type;

                let html = '';
                if (type === 'download') {
                    html = `
                <label>Download Title</label>
                <input type="text" name="title" value="${btn.dataset.title || ''}" class="form-control mb-2" required>
                <label>Replace PDF (optional)</label>
                <input type="file" name="file_path" class="form-control" accept=".pdf">
            `;
                } else if (type === 'members_data') {
                    html = `
                <label>Replace Member's Data Image</label>
                <input type="file" name="file_path" class="form-control mb-2" accept="image/*" onchange="previewImage(event, '#edit_applicant_preview')">
                <img id="edit_applicant_preview" src="${btn.dataset.file ? '/storage/' + btn.dataset.file : '#'}" class="img-thumbnail ${btn.dataset.file ? '' : 'd-none'}" width="200">
            `;
                } else if (type === 'bank') {
                    html = `
                <label>Replace Bank Logo</label>
                <input type="file" name="top_image" class="form-control mb-2" accept="image/*" onchange="previewImage(event, '#edit_top_preview')">
                <img id="edit_top_preview" src="${btn.dataset.top ? '/storage/' + btn.dataset.top : '#'}" class="img-thumbnail ${btn.dataset.top ? '' : 'd-none'} mb-2" width="100">

                <label>Replace QR Code</label>
                <input type="file" name="qr_image" class="form-control mb-2" accept="image/*" onchange="previewImage(event, '#edit_qr_preview')">
                <img id="edit_qr_preview" src="${btn.dataset.qr ? '/storage/' + btn.dataset.qr : '#'}" class="img-thumbnail ${btn.dataset.qr ? '' : 'd-none'}" width="100">
            `;
                }

                modal.innerHTML = html;
                document.getElementById('editForm').action = `/admin/membership/${id}`;
            });
        });

        function previewImage(event, selector) {
            const img = document.querySelector(selector);
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

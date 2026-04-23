@extends('admin.layout')
@section('title', 'Golf Rates')

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
    <div class="container-fluid px-4 py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 fw-bold">Golf Rates</h3>
        </div>

        {{-- ===================== SECTION TABLE ===================== --}}
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addSectionModal">
            <i class="bi bi-plus-circle"></i> ADD SECTION
        </button>

        <div class="table-responsive mb-5">
            <table class="table table-bordered align-middle text-center table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Section</th>
                        <th style="width: 220px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $section)
                        <tr>
                            <td>Section {{ $section->order_number }}</td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editSectionModal" data-id="{{ $section->id }}"
                                    data-order="{{ $section->order_number }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm" onclick="deleteSection({{ $section->id }})">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="table-active">No sections added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ===================== GOLF RATES TABLE ===================== --}}
        @if ($sections->isEmpty())
            <div class="alert alert-warning d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>You need to <strong>add a section first</strong> before adding Title/Golf Rates.</span>
            </div>
            <button class="btn btn-success mb-3" disabled>
                <i class="bi bi-plus-circle"></i> ADD TITLE/GOLF RATES
            </button>
        @else
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle"></i> ADD TITLE/GOLF RATES
            </button>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Section</th>
                        <th style="width: 220px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gpeaks as $gpeak)
                        <tr>
                            <td>{{ $gpeak->display_title }}</td>
                            <td>{{ $gpeak->type_label }}</td>
                            <td>Section {{ $gpeak->section->order_number ?? '' }}</td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="{{ $gpeak->id }}"
                                    data-gsection_id="{{ $gpeak->gsection_id }}" data-type="{{ $gpeak->type }}"
                                    data-title="{{ $gpeak->title ?? '' }}"
                                    data-description="{{ $gpeak->description ?? '' }}"
                                    data-gr_title="{{ $gpeak->gr_title ?? '' }}"
                                    data-gr_title_description="{{ $gpeak->gr_title_description ?? '' }}"
                                    data-gr_total="{{ $gpeak->gr_total !== null ? $gpeak->gr_total + 0 : '' }}"
                                    data-gr_content="{{ $gpeak->gr_content ?? '' }}"
                                    data-gr_content_price="{{ $gpeak->gr_content_price ?? '' }}"
                                    data-gr_schedule="{{ $gpeak->gr_schedule ?? '' }}"
                                    data-gr_description="{{ $gpeak->gr_description ?? '' }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm" onclick="deleteGpeak({{ $gpeak->id }})">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="table-active">No items added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===================== ADD SECTION MODAL ===================== --}}
    <div class="modal fade" id="addSectionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.gsection.store') }}">
                    @csrf
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title">Add Section</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Section Number <span class="text-danger">*</span></label>
                            <input type="number" name="order_number" class="form-control"
                                value="{{ ($sections->max('order_number') ?? 0) + 1 }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success"><i class="bi bi-check2-square me-1"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== EDIT SECTION MODAL ===================== --}}
    <div class="modal fade" id="editSectionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="editSectionForm">
                    @csrf @method('PUT')
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Edit Section</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Section Number <span class="text-danger">*</span></label>
                            <input type="number" name="order_number" id="editSectionOrder" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary"><i class="bi bi-check2-square me-1"></i>Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== DELETE SECTION MODAL ===================== --}}
    <div class="modal fade" id="deleteSectionModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteSectionForm" method="POST" class="modal-content">
                @csrf @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete Section</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this section?</p>
                    <p class="text-danger fw-bold"><i class="bi bi-exclamation-triangle"></i> All Titles and Golf Rates
                        under this section will also be deleted.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===================== ADD GPEAK MODAL ===================== --}}
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.gpeak.store') }}">
                    @csrf
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title">Add Title / Golf Rates</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Section <span class="text-danger">*</span></label>
                            <select name="gsection_id" class="form-select" required>
                                <option value="">Select Section</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">Section {{ $section->order_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Type <span class="text-danger">*</span></label>
                            <select name="type" id="addType" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="title">Title</option>
                                <option value="golf_rate">Golf Rates</option>
                            </select>
                        </div>
                        <div id="addFields"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success"><i class="bi bi-check2-square me-2"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== EDIT GPEAK MODAL ===================== --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form method="POST" id="editForm">
                    @csrf @method('PUT')
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Edit Item</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Section <span class="text-danger">*</span></label>
                            <select name="gsection_id" id="editSectionId" class="form-select" required>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">Section {{ $section->order_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Type <span class="text-danger">*</span></label>
                            <select name="type" id="editType" class="form-select" required></select>
                        </div>
                        <div id="editFields"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary"><i class="bi bi-check2-square me-1"></i>Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== DELETE GPEAK MODAL ===================== --}}
    <div class="modal fade" id="deleteGpeakModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteGpeakForm" method="POST" class="modal-content">
                @csrf @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                </div>
                <div class="modal-body">Are you sure you want to delete this item?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===================== SUCCESS MODAL ===================== --}}
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header btn-success text-white">
                    <h5 class="modal-title">Success</h5>
                </div>
                <div class="modal-body text-success fw-bold"></div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                const modalEl = document.getElementById('successModal');
                modalEl.querySelector('.modal-body').textContent = "{{ session('success') }}";
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
                setTimeout(() => modal.hide(), 3000);
            @endif
        });

        function renderFields(type, data = {}) {
            if (type === 'title') {
                return `
                    <div class="mb-2">
                        <label class="form-label">Title <small class="text-muted">(one per line)</small></label>
                        <textarea name="title" rows="3" class="form-control" placeholder="Title (one per line)">${data.title || ''}</textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-control" placeholder="Description (not required)">${data.description || ''}</textarea>
                    </div>
                `;
            } else if (type === 'golf_rate') {
                return `
                    <div class="mb-2">
                        <label class="form-label fw-bold">Golf Rates Title <span class="text-danger">*</span> <small class="text-muted">(one per line)</small></label>
                        <textarea name="gr_title" rows="3" class="form-control" placeholder="Golf Rates Title (one per line)" required>${data.gr_title || ''}</textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Golf Rates Title Description</label>
                        <textarea name="gr_title_description" rows="2" class="form-control" placeholder="Golf Rates Title Description (not required)">${data.gr_title_description || ''}</textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Total</label>
                        <input type="number" step="0.01" name="gr_total" value="${data.gr_total !== undefined && data.gr_total !== null ? data.gr_total : ''}" class="form-control" placeholder="Total (not required)">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Content <small class="text-muted">(one item per line)</small></label>
                        <textarea name="gr_content" rows="5" class="form-control" placeholder="Content (not required)">${data.gr_content || ''}</textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Content Price <small class="text-muted">(one per line)</small></label>
                        <textarea name="gr_content_price" rows="5" class="form-control" placeholder="Content Price (not required)">${data.gr_content_price || ''}</textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Schedule</label>
                        <input type="text" name="gr_schedule" value="${data.gr_schedule || ''}" class="form-control" placeholder="Schedule (not required)">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Description</label>
                        <textarea name="gr_description" rows="3" class="form-control" placeholder="Description (not required)">${data.gr_description || ''}</textarea>
                    </div>
                `;
            }
            return '';
        }

        document.getElementById('addType').addEventListener('change', function() {
            document.getElementById('addFields').innerHTML = renderFields(this.value);
        });

        document.getElementById('editModal').addEventListener('show.bs.modal', function(event) {
            const btn = event.relatedTarget;
            const id = btn.getAttribute('data-id');
            const type = btn.getAttribute('data-type');

            document.getElementById('editSectionId').value = btn.getAttribute('data-gsection_id');
            document.getElementById('editType').innerHTML = `
                <option value="title" ${type === 'title' ? 'selected' : ''}>Title</option>
                <option value="golf_rate" ${type === 'golf_rate' ? 'selected' : ''}>Golf Rates</option>
            `;

            // ✅ FIX 1: Use !== null instead of || '' so falsy values like "0" are preserved
            // ✅ FIX 2: Strip commas from gr_total so type="number" input doesn't silently reject it
            const originalData = {};
            [
                'title', 'description', 'gr_title', 'gr_title_description', 'gr_total',
                'gr_content', 'gr_content_price', 'gr_schedule', 'gr_description'
            ].forEach(k => {
                let val = btn.getAttribute('data-' + k);
                if (k === 'gr_total' && val !== null) {
                    val = val.replace(/,/g, ''); // strip thousands separators (e.g. "4,570" → "4570")
                }
                originalData[k] = val !== null ? val : '';
            });

            // Function to get current form data
            function getCurrentFormData() {
                const currentData = {};
                const editFields = document.getElementById('editFields');
                if (editFields) {
                    const inputs = editFields.querySelectorAll('input, textarea, select');
                    inputs.forEach(input => {
                        if (input.name) {
                            currentData[input.name] = input.value;
                        }
                    });
                }
                return currentData;
            }

            // Render fields with current data or original data
            function renderEditFields(type, dataToUse = null) {
                const currentFormData = dataToUse || getCurrentFormData();
                const mergedData = {
                    ...originalData,
                    ...currentFormData
                };
                document.getElementById('editFields').innerHTML = renderFields(type, mergedData);
            }

            // Initial render
            renderEditFields(type, originalData);

            document.getElementById('editForm').action = '{{ route('admin.gpeak.update', ':id') }}'.replace(':id',
                id);

            // Remove previous event listener to avoid duplicates
            const typeSelect = document.getElementById('editType');
            const newTypeSelect = typeSelect.cloneNode(true);
            typeSelect.parentNode.replaceChild(newTypeSelect, typeSelect);

            newTypeSelect.addEventListener('change', function() {
                renderEditFields(this.value);
            });
        });

        document.getElementById('editSectionModal').addEventListener('show.bs.modal', function(event) {
            const btn = event.relatedTarget;
            document.getElementById('editSectionOrder').value = btn.getAttribute('data-order');
            document.getElementById('editSectionForm').action = '{{ route('admin.gsection.update', ':id') }}'
                .replace(':id', btn.getAttribute('data-id'));
        });

        function deleteSection(id) {
            document.getElementById('deleteSectionForm').action =
                '{{ route('admin.gsection.destroy', ':id') }}'.replace(':id', id);
            new bootstrap.Modal(document.getElementById('deleteSectionModal')).show();
        }

        function deleteGpeak(id) {
            document.getElementById('deleteGpeakForm').action =
                '{{ route('admin.gpeak.destroy', ':id') }}'.replace(':id', id);
            new bootstrap.Modal(document.getElementById('deleteGpeakModal')).show();
        }
    </script>
@endsection

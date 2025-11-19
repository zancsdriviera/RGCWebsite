@extends('admin.layout')
@section('title', 'Contact Us')

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Contact Us</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- MAIN CONTACT -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Main Contact (Address & Main Phone)</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact.updateMain') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="fw-semibold">Address</label>
                        <textarea name="address" class="form-control" rows="3" required>{{ old('address', $main->address ?? '') }}</textarea>
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Main Contact Number</label>
                        <input type="text" name="main_phone" class="form-control" required
                            value="{{ old('main_phone', $main->main_phone ?? '') }}">
                        @error('main_phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary"><i class="bi bi-check-square me-2"></i>Save Main Contact</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- DEPARTMENTS -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Departments</h5>
                <div>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                        <i class="bi bi-plus"></i> Add Department
                    </button>
                </div>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:70px;">#</th>
                            <th>Department</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th style="width:170px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departments as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->title }}</td>
                                <td>{{ $d->phone ?? '-' }}</td>
                                <td>{{ $d->email ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-dept-btn" data-id="{{ $d->id }}"
                                        data-title="{{ $d->title }}" data-phone="{{ $d->phone }}"
                                        data-email="{{ $d->email }}" data-sort="{{ $d->sort_order }}"
                                        data-update-url="{{ route('admin.contact.updateDepartment', $d->id) }}"
                                        data-bs-toggle="modal" data-bs-target="#editDepartmentModal">
                                        Edit
                                    </button>




                                    <form action="{{ route('admin.contact.destroyDepartment', $d->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this department entry?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No departments yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Department Modal -->
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('admin.contact.storeDepartment') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label class="fw-semibold">Department Name</label>
                        <input name="title" class="form-control mb-2" required>
                        <label class="fw-semibold">Phone</label>
                        <input name="phone" class="form-control mb-2">
                        <label class="fw-semibold">Email</label>
                        <input name="email" type="email" class="form-control mb-2">
                        <label class="fw-semibold">Sort Order (optional)</label>
                        <input name="sort_order" type="number" class="form-control" value="0">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                        <button class="btn btn-success" type="submit">Add Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Department Modal (smaller) -->
    <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                {{-- NOTE: We DO NOT set action server-side here. JS will set it when opening the modal. --}}
                <form id="editDeptForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Hidden ID is kept for convenience -->
                        <input type="hidden" id="edit_dept_id" name="id">

                        <div class="mb-2">
                            <label class="fw-semibold">Department Name</label>
                            <input id="edit_dept_title" name="title" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label class="fw-semibold">Phone</label>
                            <input id="edit_dept_phone" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label class="fw-semibold">Email</label>
                            <input id="edit_dept_email" name="email" type="email" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label class="fw-semibold">Sort Order</label>
                            <input id="edit_dept_sort" name="sort_order" type="number" class="form-control"
                                value="0" min="0">
                        </div>

                        {{-- place for server-side validation errors returned via session (optional) --}}
                        <div id="edit-dept-errors" class="text-danger small" style="display:none;"></div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                        <button class="btn btn-success" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.edit-dept-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const title = btn.dataset.title ?? '';
                    const phone = btn.dataset.phone ?? '';
                    const email = btn.dataset.email ?? '';
                    const sort = btn.dataset.sort ?? 0;
                    const updateUrl = btn.dataset.updateUrl || `/admin/contact/department/${id}`;

                    // Fill modal inputs
                    document.getElementById('edit_dept_id').value = id;
                    document.getElementById('edit_dept_title').value = title;
                    document.getElementById('edit_dept_phone').value = phone;
                    document.getElementById('edit_dept_email').value = email;
                    document.getElementById('edit_dept_sort').value = sort;

                    // Set the form action to the correct update route (PUT /admin/contact/department/{id})
                    const form = document.getElementById('editDeptForm');
                    form.action = updateUrl;

                    // Ensure method spoofing is in the form (blade already has @method('PUT'))
                    // Clear previous inline error box if any
                    const errBox = document.getElementById('edit-dept-errors');
                    if (errBox) {
                        errBox.style.display = 'none';
                        errBox.innerHTML = '';
                    }
                });
            });

            // Re-open modal with server validation errors if controller returned them
            @if ($errors->any() && session('edit_department_id'))
                (function() {
                    const id = "{{ session('edit_department_id') }}";
                    const btn = document.querySelector(`.edit-dept-btn[data-id="${id}"]`);
                    if (btn) btn.click();
                    const errBox = document.getElementById('edit-dept-errors');
                    if (errBox) {
                        errBox.style.display = 'block';
                        errBox.innerHTML = `{!! implode('<br>', $errors->all()) !!}`;
                    }
                })();
            @endif

        });
    </script>


@endsection

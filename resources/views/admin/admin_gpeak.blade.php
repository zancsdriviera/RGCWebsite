@extends('admin.layout')
@section('title', 'Peak Season')

@section('content')
    <div class="container-fluid px-4 py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 fw-bold">Golf Rates Peak Season</h3>
        </div>

        <!-- Add Golf Rates Button -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-circle"></i> Add Golf Rates
        </button>


        <!-- Golf Rates Table -->
        <table class="table table-bordered align-middle text-center table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Content Type</th>
                    <th>Title</th>
                    <th>Schedule</th>
                    <th style="width: 250px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gpeaks as $gpeak)
                    <tr>
                        <td>{{ ucfirst($gpeak->type) }}</td>
                        <td>{{ $gpeak->title1 ?? ($gpeak->title2 ?? $gpeak->title3) }}</td>
                        <td>{{ $gpeak->sched1 ?? $gpeak->sched2 }}</td>

                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal" data-id="{{ $gpeak->id }}" data-type="{{ $gpeak->type }}"
                                data-title1="{{ $gpeak->title1 ?? '' }}"
                                data-total1="{{ str_replace('.00', '', $gpeak->total1 ?? '') }}"
                                data-body1="{{ $gpeak->body1 ?? '' }}" data-price1="{{ $gpeak->price1 ?? '' }}"
                                data-sched1="{{ $gpeak->sched1 ?? '' }}" data-title2="{{ $gpeak->title2 ?? '' }}"
                                data-paragraph2="{{ $gpeak->paragraph2 ?? '' }}"
                                data-total2="{{ str_replace('.00', '', $gpeak->total2 ?? '') }}"
                                data-body2="{{ $gpeak->body2 ?? '' }}" data-price2="{{ $gpeak->price2 ?? '' }}"
                                data-sched2="{{ $gpeak->sched2 ?? '' }}" data-title3="{{ $gpeak->title3 ?? '' }}"
                                data-paragraph3="{{ $gpeak->paragraph3 ?? '' }}" data-body3="{{ $gpeak->body3 ?? '' }}"
                                data-price3="{{ $gpeak->price3 ?? '' }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>

                            <!-- Delete Button -->
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteGpeak({{ $gpeak->id }})">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="table-active">No Golf Rates added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.gpeak.store') }}">
                    @csrf
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title">Add Golf Rates (Peak Season)</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label fw-bold">Type</label>
                        <select name="type" id="addType" class="form-select mb-3" required>
                            <option value="">Select Content Type</option>
                            <option value="first">First Content (Regular)</option>
                            <option value="second">Second Content (Senior Discount)</option>
                            <option value="third">Third Content (Cart Rental)</option>
                        </select>
                        <div id="addFields"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success"><i class="bi bi-check2-square me-2"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form method="POST" id="editForm">
                    @csrf @method('PUT')
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Edit Golf Rates (Peak Season)</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editId">
                        <label>Type</label>
                        <select name="type" id="editType" class="form-select mb-3" required></select>
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

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteGpeakModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteGpeakForm" method="POST" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete Golf Rate (Peak Season)</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Golf Rate?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                </div>
            </form>
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
        document.addEventListener('DOMContentLoaded', function() {
            const addType = document.getElementById('addType');
            const addFields = document.getElementById('addFields');
            const editModal = document.getElementById('editModal');
            const editForm = document.getElementById('editForm');
            const editId = document.getElementById('editId');
            const editType = document.getElementById('editType');
            const editFields = document.getElementById('editFields');

            function renderFields(type, data = {}) {
                let html = '';

                // Helper function to clean totals (remove .00)
                function cleanTotal(total) {
                    if (!total) return '';
                    // If it ends with .00, remove it
                    return total.toString().replace(/\.00$/, '');
                }

                if (type === 'first') {
                    html =
                        `
            <input type="text" name="title1" value="${data.title1||''}" class="form-control mb-2" placeholder="Title" required>
            <input type="number" step="0.01" name="total1" value="${cleanTotal(data.total1)}" class="form-control mb-2" placeholder="Total" required>
            <textarea name="body1" rows="5" class="form-control mb-2" required placeholder="Content (one item per line)">${data.body1||''}</textarea>
            <textarea name="price1" rows="5" class="form-control mb-2" required placeholder="Price (one per line)">${data.price1||''}</textarea>
            <input type="text" name="sched1" value="${data.sched1||''}" class="form-control mb-2" placeholder="Schedule" required>`;
                } else if (type === 'second') {
                    html =
                        `
            <input type="text" name="title2" value="${data.title2||''}" class="form-control mb-2" placeholder="Title" required>
            <input type="text" name="paragraph2" value="${data.paragraph2||''}" class="form-control mb-2" placeholder="Paragraph (optional)">
            <input type="number" step="0.01" name="total2" value="${cleanTotal(data.total2)}" class="form-control mb-2" placeholder="Total" required>
            <textarea name="body2" rows="5" class="form-control mb-2" required placeholder="Content (one item per line)">${data.body2||''}</textarea>
            <textarea name="price2" rows="5" class="form-control mb-2" required placeholder="Price (one per line)">${data.price2||''}</textarea>
            <input type="text" name="sched2" value="${data.sched2||''}" class="form-control mb-2" placeholder="Schedule" required>`;
                } else if (type === 'third') {
                    html =
                        `
            <input type="text" name="title3" value="${data.title3||''}" class="form-control mb-2" placeholder="Title" required>
            <textarea name="body3" rows="5" class="form-control mb-2" required placeholder="Content (one item per line)">${data.body3||''}</textarea>
            <textarea name="price3" rows="5" class="form-control mb-2" required placeholder="Price (one per line)">${data.price3||''}</textarea>
            <textarea name="paragraph3" rows="2" class="form-control mb-2" placeholder="Paragraph (optional)">${data.paragraph3||''}</textarea>`;
                }
                return html;
            }

            addType.addEventListener('change', function() {
                addFields.innerHTML = renderFields(this.value);
            });

            editModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                editId.value = id;

                editType.innerHTML = `
            <option value="first" ${button.getAttribute('data-type')==='first'?'selected':''}>First Content (Regular)</option>
            <option value="second" ${button.getAttribute('data-type')==='second'?'selected':''}>Second Content (Senior Discount)</option>
            <option value="third" ${button.getAttribute('data-type')==='third'?'selected':''}>Third Content (Cart Rental)</option>
        `;

                const data = {};
                ['title1', 'total1', 'body1', 'price1', 'sched1', 'title2', 'paragraph2', 'total2', 'body2',
                    'price2', 'sched2', 'title3', 'paragraph3', 'body3', 'price3'
                ]
                .forEach(k => data[k] = button.getAttribute('data-' + k) || '');
                editFields.innerHTML = renderFields(button.getAttribute('data-type'), data);

                editForm.action = '{{ route('admin.gpeak.update', ':id') }}'.replace(':id', id);
            });
        });

        function deleteGpeak(gpeakId) {
            const deleteForm = document.getElementById('deleteGpeakForm');
            deleteForm.action = '{{ route('admin.gpeak.destroy', ':id') }}'.replace(':id', gpeakId);

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteGpeakModal'));
            deleteModal.show();
        }
    </script>
@endsection

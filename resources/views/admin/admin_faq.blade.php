@extends('admin.layout')
@section('title', 'FAQ Management')

@section('content')
    <div class="container-fluid px-4 py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 fw-bold">FAQ</h3>
        </div>

        <!-- Buttons -->
        <div class="mb-3 d-flex gap-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                <i class="bi bi-plus-circle"></i> Add FAQ
            </button>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addIconModal">
                <i class="bi bi-plus-circle"></i> Add New Icon
            </button>
        </div>

        <!-- FAQ Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle table-striped text-center">
                <thead class="table-dark text-white">
                    <tr>
                        <th>Title</th>
                        <th>Icon</th>
                        <th>QR Scanner</th>
                        <th style="width: 250px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                        <tr>
                            <td>{{ $faq->faq_title }}</td>
                            <td>
                                @if ($faq->faq_icon_class)
                                    @php $icon = App\Models\IconContent::where('class', $faq->faq_icon_class)->first(); @endphp
                                    <i class="{{ $faq->faq_icon_class }}"></i>
                                    {{ $icon ? $icon->name : $faq->faq_icon_class }}
                                @else
                                    <small class="text-muted">No icon</small>
                                @endif
                            </td>
                            <td>
                                @if ($faq->faq_image)
                                    <img src="{{ asset('images/FAQ/' . $faq->faq_image) }}" width="60" class="rounded">
                                @else
                                    <small class="text-muted">No image</small>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="editFaq({{ $faq->id }})"><i
                                        class="bi bi-pencil-square"></i> Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteFaq({{ $faq->id }})"><i
                                        class="bi bi-trash"></i> Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No FAQ added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add FAQ Modal -->
    <div class="modal fade" id="addFaqModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('admin.faq.store') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header btn-success text-white">
                    <h5 class="modal-title">Add New FAQ</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-bold">FAQ Title</label>
                        <input type="text" name="faq_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">FAQ QR Scanner Image</label>
                        <input type="file" name="faq_image" class="form-control" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">FAQ Icon (optional)</label>
                        <select name="faq_icon_class" class="form-control selectpicker" data-live-search="true">
                            <option value="">-- Select Icon --</option>
                            @foreach ($icons as $icon)
                                <option value="{{ $icon->class }}">{{ $icon->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit"><i class="bi bi-check2-square me-2"></i>Confirm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit FAQ Modal -->
    <div class="modal fade" id="editFaqModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editFaqForm" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit FAQ</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-bold">FAQ Title</label>
                        <input type="text" id="edit_faq_title" name="faq_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">FAQ QR Scanner Image (optional)</label>
                        <input type="file" id="edit_faq_image" name="faq_image" class="form-control" accept="image/*"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">FAQ Icon (optional)</label>
                        <select id="edit_faq_icon_class" name="faq_icon_class" class="form-control selectpicker"
                            data-live-search="true">
                            <option value="">-- Select Icon --</option>
                            @foreach ($icons as $icon)
                                <option value="{{ $icon->class }}">{{ $icon->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit"><i class="bi bi-check2-square me-2"></i>Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteFaqModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteFaqForm" method="POST" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Delete FAQ</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">Are you sure you want to delete this FAQ entry?</div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit"><i
                            class="bi bi-check2-square me-2"></i>Confirm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Icon Modal -->
    <div class="modal fade" id="addIconModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('icon.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header btn btn-secondary text-white">
                    <h5 class="modal-title">Add New Icon</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-bold">Icon Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Icon Class</label>
                        <input type="text" name="class" class="form-control" placeholder="bi bi-activity" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit"><i
                            class="bi bi-check2-square me-2"></i>Confirm</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show success modal if there's a message
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
        const editModal = new bootstrap.Modal(document.getElementById('editFaqModal'));
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteFaqModal'));

        // Edit FAQ
        function editFaq(id) {
            fetch(`/admin/faq/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('edit_faq_title').value = data.faq_title;
                    document.getElementById('edit_faq_icon_class').value = data.faq_icon_class;
                    document.getElementById('edit_faq_image').value = '';
                    document.getElementById('editFaqForm').action = `/admin/faq/${id}`;
                    editModal.show();
                })
                .catch(() => alert("Failed to load FAQ data."));
        }

        // Delete FAQ
        function confirmDeleteFaq(id) {
            document.getElementById('deleteFaqForm').action = `/admin/faq/${id}`;
            deleteModal.show();
        }
    </script>
@endsection

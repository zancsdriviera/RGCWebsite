@extends('layouts.app')

@section('title', 'Manage FAQs')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">FAQ Management</h1>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus me-2"></i> Add New FAQ
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                                <tr>
                                    <td>
                                        <strong>{{ $faq->question }}</strong>
                                        <p class="text-muted mb-0 small">{{ Str::limit($faq->answer, 100) }}</p>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $faq->category }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $faq->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary edit-faq"
                                                data-faq='@json($faq)'>
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success toggle-status"
                                                data-id="{{ $faq->id }}">
                                                <i class="fas {{ $faq->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                            </button>
                                            <form action="{{ route('admin.faq.delete', $faq->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Delete this FAQ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal - Add icon upload field -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.faq.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New FAQ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category *</label>
                            <input type="text" name="category" class="form-control" required list="categorySuggestions"
                                placeholder="Enter category name">
                            <datalist id="categorySuggestions">
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">
                                @endforeach
                            </datalist>
                            <small class="text-muted">Type new category or select from existing</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category Icon</label>
                            <input type="file" name="icon" class="form-control" accept="image/*">
                            <small class="text-muted">Upload PNG, JPG, SVG or GIF icon (max 2MB)</small>
                            <div class="mt-2">
                                <small>Recommended: 64x64px transparent PNG</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Question *</label>
                            <input type="text" name="question" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Answer *</label>
                            <textarea name="answer" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Create FAQ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal - Add icon preview and upload -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit FAQ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category *</label>
                            <input type="text" name="category" class="form-control" required
                                list="categorySuggestionsEdit">
                            <datalist id="categorySuggestionsEdit">
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">
                                @endforeach
                            </datalist>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category Icon</label>

                            <!-- Current Icon Preview -->
                            <div id="currentIconPreview" class="mb-2 text-center">
                                <!-- Will be populated by JavaScript -->
                            </div>

                            <input type="file" name="icon" class="form-control" accept="image/*"
                                onchange="previewIcon(this, 'newIconPreview')">

                            <!-- New Icon Preview -->
                            <div id="newIconPreview" class="mt-2 text-center" style="display: none;">
                                <p class="small mb-1">New Icon Preview:</p>
                                <img id="newIconImg" src="#" alt="New Icon Preview"
                                    style="max-width: 64px; max-height: 64px; display: none;">
                            </div>

                            <small class="text-muted">Leave empty to keep current icon</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Question *</label>
                            <input type="text" name="question" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Answer *</label>
                            <textarea name="answer" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input">
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update FAQ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit button click
            document.querySelectorAll('.edit-faq').forEach(button => {
                button.addEventListener('click', function() {
                    const faq = JSON.parse(this.dataset.faq);
                    const form = document.getElementById('editForm');
                    const modal = new bootstrap.Modal(document.getElementById('editModal'));

                    form.action = `/admin/faq/update/${faq.id}`;
                    form.querySelector('[name="category"]').value = faq.category;
                    form.querySelector('[name="question"]').value = faq.question;
                    form.querySelector('[name="answer"]').value = faq.answer;
                    form.querySelector('[name="is_active"]').checked = faq.is_active;

                    // Show current icon if exists
                    const previewDiv = document.getElementById('currentIconPreview');
                    previewDiv.innerHTML = '';

                    if (faq.icon) {
                        previewDiv.innerHTML = `
                    <p class="small mb-1">Current Icon:</p>
                    <img src="/storage/faq-icons/${faq.icon}" alt="Current Icon" 
                         style="max-width: 64px; max-height: 64px;">
                `;
                    } else {
                        previewDiv.innerHTML = '<p class="text-muted small">No icon uploaded</p>';
                    }

                    // Hide new icon preview
                    document.getElementById('newIconPreview').style.display = 'none';
                    document.getElementById('newIconImg').style.display = 'none';

                    modal.show();
                });
            });
        });

        // Preview uploaded icon
        function previewIcon(input, previewId) {
            const previewDiv = document.getElementById(previewId);
            const img = document.getElementById('newIconImg');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                    img.style.display = 'block';
                    previewDiv.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                img.style.display = 'none';
                previewDiv.style.display = 'none';
            }
        }
    </script>
@endsection

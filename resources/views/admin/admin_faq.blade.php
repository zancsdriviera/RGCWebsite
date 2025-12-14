@extends('admin.layout')

@section('title', 'FAQs')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Ensure the table can scroll horizontally if needed */
        .table-responsive {
            overflow-x: auto;
        }

        .actions-col {
            min-width: 180px;
            width: 180px;
            max-width: 240px;
            white-space: nowrap;
            vertical-align: middle;
            text-align: right;
            padding-right: 20px;
        }

        /* Action container: force inline horizontal layout and prevent wrapping */
        .action-buttons {
            display: inline-flex;
            flex-wrap: nowrap;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            justify-content: flex-end;
        }

        /* Form inside action-buttons must be inline and not break layout */
        .action-buttons form.action-form {
            display: inline-flex !important;
            align-items: center;
            margin: 0;
            padding: 0;
            flex-wrap: nowrap;
        }

        /* Buttons fixed size and cannot shrink */
        .action-btn {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 1px solid transparent;
            flex: 0 0 auto;
            box-sizing: border-box;
            font-size: 18px;
            padding: 0;
        }

        /* EDIT — Blue, Pencil Icon */
        .action-btn.edit {
            background: #e3f2fd;
            color: #1565c0;
            border: 1px solid #bbdefb;
        }

        .action-btn.edit:hover {
            transform: scale(1.06);
        }

        /* TOGGLE — Yellow, Power Button */
        .action-btn.toggle {
            background: #fff8e1;
            color: #ef6c00;
            border: 1px solid #ffe0b2;
        }

        .action-btn.toggle:hover {
            transform: scale(1.06);
        }

        /* DELETE — Red, Trash Icon */
        .action-btn.delete {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .action-btn.delete:hover {
            transform: scale(1.06);
        }

        /* keep status/category layout */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .category-badge {
            background: #f1f8e9;
            color: #33691e;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            border-left: 3px solid #8bc34a;
        }

        /* Type badge */
        .type-badge {
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .type-badge.qa {
            background: #e3f2fd;
            color: #1565c0;
        }

        .type-badge.qr {
            background: #e0f7fa;
            color: #006064;
        }

        /* optional: keep question column from pushing the actions */
        td:first-child {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 60ch;
        }

        /* make sure small screens still show the table layout but allow horizontal scroll */
        @media (max-width: 576px) {
            .actions-col {
                min-width: 140px;
                width: 140px;
            }

            td:first-child {
                max-width: 40ch;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">FAQ Management</h3>

        <div class="d-flex gap-2 mb-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus me-2"></i> Add Q&A
            </button>

            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                data-bs-target="#createQrModal">
                <i class="fas fa-qrcode me-2"></i> Add QR Feedback
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
                                <th>Type</th>
                                <th>Content</th>
                                <th width="150">Category/Title</th>
                                <th width="120">Status</th>
                                <th class="actions-col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                                <tr>
                                    <td>
                                        @if ($faq->type == 'qa')
                                            <span class="type-badge qa">Q&A</span>
                                        @else
                                            <span class="type-badge qr">QR</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($faq->type == 'qa')
                                            <strong class="d-block mb-1">{{ $faq->question }}</strong>
                                            <small class="text-muted">{{ Str::limit($faq->answer, 80) }}</small>
                                        @else
                                            <strong class="d-block mb-1">QR Feedback: {{ $faq->faq_title }}</strong>
                                            <small class="text-muted">
                                                Scan to provide feedback
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($faq->type == 'qa')
                                            <span class="category-badge">
                                                {{ $faq->category }}
                                            </span>
                                        @else
                                            <strong>{{ $faq->faq_title }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        <span
                                            class="status-badge {{ $faq->is_active ? 'bg-success text-white' : 'bg-light text-dark' }}">
                                            <i
                                                class="fas {{ $faq->is_active ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                            {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="actions-col">
                                        <div class="action-buttons">
                                            <button type="button" class="action-btn edit edit-faq"
                                                data-faq='@json($faq)' title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            <button type="button" class="action-btn toggle toggle-status"
                                                data-id="{{ $faq->id }}"
                                                title="{{ $faq->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="bi {{ $faq->is_active ? 'bi-toggle-on' : 'bi-toggle-off' }}"></i>
                                            </button>

                                            <button type="button" class="action-btn delete delete-faq"
                                                data-id="{{ $faq->id }}"
                                                data-title="{{ $faq->type == 'qa' ? $faq->question : $faq->faq_title }}"
                                                data-type="{{ $faq->type }}" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
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

    <!-- Create Q&A Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.faq.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="qa">
                <div class="modal-content">
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Create New Q&A</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-tag me-1"></i>Category *</label>
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
                            <label class="form-label"><i class="fas fa-image me-1"></i>Category Icon</label>
                            <input type="file" name="icon" class="form-control" accept="image/*">
                            <small class="text-muted">Upload PNG, JPG, SVG or GIF icon (max 2MB)</small>
                            <div class="mt-2">
                                <small><i class="fas fa-info-circle me-1"></i>Recommended: 64x64px transparent PNG</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-question-circle me-1"></i>Question *</label>
                            <input type="text" name="question" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-comment-dots me-1"></i>Answer *</label>
                            <textarea name="answer" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" checked id="createActive">
                            <label class="form-check-label" for="createActive">
                                <i class="fas fa-toggle-on me-1"></i>Active
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Confirm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Create QR Feedback Modal -->
    <div class="modal fade" id="createQrModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.faq.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="qr">
                <div class="modal-content">
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title"><i class="fas fa-qrcode me-2"></i>Create QR Feedback Item</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-heading me-1"></i>Title *</label>
                            <input type="text" name="faq_title" class="form-control" required
                                placeholder="e.g., Facebook, IG, YouTube">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-image me-1"></i>Image</label>
                            <input type="file" name="faq_image" class="form-control" accept="image/*">
                            <small class="text-muted">Upload PNG, JPG, or WEBP image (max 2MB)</small>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" checked id="qrActive">
                            <label class="form-check-label" for="qrActive">
                                <i class="fas fa-toggle-on me-1"></i>Active
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Confirm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal (Handles both Q&A and QR) -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Item</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="editModalBody">
                        <!-- Dynamic content will be loaded here by JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Confirm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title"><i class="fas fa-trash-alt me-2"></i>Delete Confirmation</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                            <h4 class="fw-bold">Are you sure?</h4>
                            <p class="text-muted" id="deleteMessage">
                                <!-- Dynamic message will be inserted here -->
                            </p>
                            <div class="alert alert-warning mt-3">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <strong>Warning:</strong> This action cannot be undone.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-trash-alt me-1"></i>Confirm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit button click - Dynamic modal based on type
            document.querySelectorAll('.edit-faq').forEach(button => {
                button.addEventListener('click', function() {
                    const faq = JSON.parse(this.dataset.faq);
                    const form = document.getElementById('editForm');
                    const modal = new bootstrap.Modal(document.getElementById('editModal'));

                    // Set form action
                    form.action = `/admin/faq/update/${faq.id}`;

                    // Generate form content based on type
                    let formContent = '';

                    if (faq.type === 'qa') {
                        formContent = `
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-tag me-1"></i>Category *</label>
                                <input type="text" name="category" class="form-control" required 
                                       value="${faq.category}" list="categorySuggestionsEdit">
                                <datalist id="categorySuggestionsEdit">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}">
                                    @endforeach
                                </datalist>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-image me-1"></i>Category Icon</label>
                                
                                <div id="currentIconPreview" class="mb-2 text-center">
                                    ${faq.icon ? 
                                        `<p class="small mb-1"><i class="fas fa-image me-1"></i>Current Icon:</p>
                                                             <img src="/storage/faqicons/${faq.icon}" alt="Current Icon"
                                                                  style="max-width: 64px; max-height: 64px; border-radius: 4px; border: 1px solid #dee2e6;">` 
                                        : 
                                        '<p class="text-muted small"><i class="fas fa-exclamation-circle me-1"></i>No icon uploaded</p>'
                                    }
                                </div>
                                
                                <input type="file" name="icon" class="form-control" accept="image/*" 
                                       onchange="previewIcon(this, 'newIconPreview')">
                                
                                <div id="newIconPreview" class="mt-2 text-center" style="display: none;">
                                    <p class="small mb-1"><i class="fas fa-eye me-1"></i>New Icon Preview:</p>
                                    <img id="newIconImg" src="#" alt="New Icon Preview"
                                        style="max-width: 64px; max-height: 64px; display: none; border-radius: 4px;">
                                </div>
                                
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Leave empty to keep current icon</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-question-circle me-1"></i>Question *</label>
                                <input type="text" name="question" class="form-control" required value="${faq.question}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-comment-dots me-1"></i>Answer *</label>
                                <textarea name="answer" class="form-control" rows="3" required>${faq.answer}</textarea>
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" id="editActive" ${faq.is_active ? 'checked' : ''}>
                                <label class="form-check-label" for="editActive">
                                    <i class="fas fa-toggle-${faq.is_active ? 'on' : 'off'} me-1"></i>Active
                                </label>
                            </div>
                        `;
                    } else {
                        formContent = `
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-heading me-1"></i>Title *</label>
                                <input type="text" name="faq_title" class="form-control" required value="${faq.faq_title}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-image me-1"></i>Image</label>
                                
                                <div id="currentQrImagePreview" class="mb-2 text-center">
                                    ${faq.faq_image ? 
                                        `<p class="small mb-1"><i class="fas fa-image me-1"></i>Current Image:</p>
                                                             <img src="/storage/FAQ/${faq.faq_image}" alt="Current Image" 
                                                                  style="max-width: 120px; max-height: 120px; border-radius: 8px; border: 1px solid #dee2e6;">` 
                                        : 
                                        '<p class="text-muted small"><i class="fas fa-exclamation-circle me-1"></i>No image uploaded</p>'
                                    }
                                </div>
                                
                                <input type="file" name="faq_image" class="form-control" accept="image/*" 
                                       onchange="previewQrImage(this, 'newQrImagePreview')">
                                
                                <div id="newQrImagePreview" class="mt-2 text-center" style="display: none;">
                                    <p class="small mb-1"><i class="fas fa-eye me-1"></i>New Image Preview:</p>
                                    <img id="newQrImageImg" src="#" alt="New Image Preview"
                                        style="max-width: 120px; max-height: 120px; display: none; border-radius: 8px;">
                                </div>
                                
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Leave empty to keep current image</small>
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" id="editActive" ${faq.is_active ? 'checked' : ''}>
                                <label class="form-check-label" for="editActive">
                                    <i class="fas fa-toggle-${faq.is_active ? 'on' : 'off'} me-1"></i>Active
                                </label>
                            </div>
                        `;
                    }

                    document.getElementById('editModalBody').innerHTML = formContent;

                    // Hide previews
                    if (document.getElementById('newIconPreview')) {
                        document.getElementById('newIconPreview').style.display = 'none';
                    }
                    if (document.getElementById('newQrImagePreview')) {
                        document.getElementById('newQrImagePreview').style.display = 'none';
                    }

                    modal.show();
                });
            });

            // Delete button click
            document.querySelectorAll('.delete-faq').forEach(button => {
                button.addEventListener('click', function() {
                    const faqId = this.dataset.id;
                    const faqTitle = this.dataset.title;
                    const faqType = this.dataset.type;

                    const form = document.getElementById('deleteForm');
                    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));

                    // Set form action
                    form.action = `/admin/faq/delete/${faqId}`;

                    // Set dynamic message
                    const typeText = faqType === 'qa' ? 'Q&A' : 'QR Feedback';
                    const message =
                        `You are about to delete the ${typeText} item: <strong>"${faqTitle}"</strong>.`;

                    document.getElementById('deleteMessage').innerHTML = message;

                    modal.show();
                });
            });

            // Toggle status with AJAX
            document.querySelectorAll('.toggle-status').forEach(button => {
                button.addEventListener('click', function() {
                    const faqId = this.dataset.id;
                    const button = this;

                    fetch(`/admin/faq/toggle/${faqId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update button icon and title
                                const icon = button.querySelector('i');
                                const statusBadge = button.closest('tr').querySelector(
                                    '.status-badge');

                                if (data.is_active) {
                                    icon.classList.remove('bi-toggle-off');
                                    icon.classList.add('bi-toggle-on');
                                    button.title = 'Deactivate';
                                    statusBadge.className =
                                        'status-badge bg-success text-white';
                                    statusBadge.innerHTML =
                                        '<i class="fas fa-check-circle me-1"></i>Active';
                                } else {
                                    icon.classList.remove('bi-toggle-on');
                                    icon.classList.add('bi-toggle-off');
                                    button.title = 'Activate';
                                    statusBadge.className = 'status-badge bg-light text-dark';
                                    statusBadge.innerHTML =
                                        '<i class="fas fa-times-circle me-1"></i>Inactive';
                                }

                                showToast(data.is_active ? 'Item activated successfully!' :
                                    'Item deactivated successfully!', 'success');
                            }
                        })
                        .catch(error => {
                            showToast('Error updating status', 'error');
                        });
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

        // Preview uploaded QR image
        function previewQrImage(input, previewId) {
            const previewDiv = document.getElementById(previewId);
            const img = document.getElementById('newQrImageImg');

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

        // Toast notification function
        function showToast(message, type = 'success') {
            let toastContainer = document.getElementById('toastContainer');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toastContainer';
                toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
                document.body.appendChild(toastContainer);
            }

            const toastId = 'toast-' + Date.now();
            const toastHtml = `
                <div id="${toastId}" class="toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;

            toastContainer.insertAdjacentHTML('beforeend', toastHtml);

            const toastEl = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastEl, {
                delay: 3000
            });
            toast.show();

            toastEl.addEventListener('hidden.bs.toast', function() {
                this.remove();
            });
        }
    </script>
@endsection

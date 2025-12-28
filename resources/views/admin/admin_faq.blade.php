@extends('admin.layout')

@section('title', 'FAQs')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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

        .action-buttons {
            display: inline-flex;
            flex-wrap: nowrap;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            justify-content: flex-end;
        }

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

        .action-btn.edit {
            background: #e3f2fd;
            color: #1565c0;
            border: 1px solid #bbdefb;
        }

        .action-btn.edit:hover {
            transform: scale(1.06);
        }

        .action-btn.toggle {
            background: #fff8e1;
            color: #ef6c00;
            border: 1px solid #ffe0b2;
        }

        .action-btn.toggle:hover {
            transform: scale(1.06);
        }

        .action-btn.delete {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .action-btn.delete:hover {
            transform: scale(1.06);
        }

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

        .type-badge {
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .type-badge.doc {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .type-badge.qr {
            background: #e0f7fa;
            color: #006064;
        }

        td:first-child {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 60ch;
        }

        @media (max-width: 576px) {
            .actions-col {
                min-width: 140px;
                width: 140px;
            }

            td:first-child {
                max-width: 40ch;
            }
        }

        .file-info {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 6px;
            margin-top: 5px;
            font-size: 12px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">FAQ Management</h3>

        <div class="d-flex gap-2 mb-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus me-2"></i> Add Document
            </button>

            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                data-bs-target="#createQrModal">
                <i class="fas fa-qrcode me-2"></i> Add QR Feedback
            </button>
        </div>

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
                                        @if ($faq->type == 'doc')
                                            <span class="type-badge doc">DOC</span>
                                        @else
                                            <span class="type-badge qr">QR</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($faq->type == 'doc')
                                            <strong class="d-block mb-1">
                                                <i class="fas fa-file-pdf text-danger me-1"></i>
                                                {{ $faq->document_title }}
                                            </strong>
                                            @if ($faq->document_file)
                                                <div class="file-info mt-1">
                                                    <i class="fas fa-file me-1"></i>
                                                    {{ strtoupper(pathinfo($faq->document_file, PATHINFO_EXTENSION)) }}
                                                    Document
                                                </div>
                                            @endif
                                        @else
                                            <strong class="d-block mb-1">QR Feedback: {{ $faq->faq_title }}</strong>
                                            <small class="text-muted">
                                                Scan to provide feedback
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($faq->type == 'doc')
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
                                                data-title="{{ $faq->type == 'doc' ? $faq->document_title : $faq->faq_title }}"
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

    <!-- Create Document Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.faq.create') }}" method="POST" enctype="multipart/form-data" id="createForm">
                @csrf
                <input type="hidden" name="type" value="doc">
                <div class="modal-content">
                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Add New Document</h5>
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
                            <label class="form-label"><i class="fas fa-heading me-1"></i>Document Title *</label>
                            <input type="text" name="document_title" class="form-control" required
                                placeholder="e.g., How to become a member">
                            <small class="text-muted">This will be shown as the clickable link text</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-file-pdf me-1"></i>PDF Document *</label>
                            <input type="file" name="document_file" class="form-control file-input"
                                accept=".pdf,.doc,.docx" data-max-size="10485760" required>
                            <small class="text-muted">Upload PDF or DOC file (max 10MB)</small>
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
                            <i class="bi bi-check2-square me-2"></i>Confirm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Create QR Feedback Modal -->
    <div class="modal fade" id="createQrModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.faq.create') }}" method="POST" enctype="multipart/form-data"
                id="createQrForm">
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
                            <input type="file" name="faq_image" class="form-control file-input" accept="image/*"
                                data-max-size="3145728">
                            <small class="text-muted">Upload PNG, JPG, or WEBP image (max 3MB)</small>
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
                            <i class="bi bi-check2-square me-2"></i>Confirm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal (Handles both Document and QR) -->
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
                            <i class="bi bi-check2-square me-2"></i>Confirm
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check2-square me-2"></i>Confirm
                        </button>
                    </div>
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
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                const modalEl = document.getElementById('successModal');
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.textContent = "{{ session('success') }}";
                modalBody.style.color = 'green';

                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // Auto-close after 5s
                setTimeout(() => modal.hide(), 5000);
            @endif

            // File size validation
            document.querySelectorAll('.file-input').forEach(input => {
                input.addEventListener('change', function(e) {
                    const maxSize = this.dataset.maxSize || 3145728;
                    if (!this.files || !this.files[0]) return true;

                    const file = this.files[0];
                    const maxSizeBytes = parseInt(maxSize);
                    if (file.size > maxSizeBytes) {
                        alert(`File size exceeds ${maxSizeBytes/1048576}MB limit.`);
                        this.value = '';
                        return false;
                    }
                    return true;
                });
            });

            // Edit button click
            document.querySelectorAll('.edit-faq').forEach(button => {
                button.addEventListener('click', function() {
                    const faq = JSON.parse(this.dataset.faq);
                    const form = document.getElementById('editForm');
                    const modal = new bootstrap.Modal(document.getElementById('editModal'));

                    form.action = `/admin/faq/update/${faq.id}`;

                    let formContent = '';

                    if (faq.type === 'doc') {
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
                                <label class="form-label"><i class="fas fa-heading me-1"></i>Document Title *</label>
                                <input type="text" name="document_title" class="form-control" required 
                                       value="${faq.document_title}">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-file-pdf me-1"></i>PDF Document</label>
                                
                                <div id="currentDocPreview" class="mb-2">
                                    ${faq.document_file ? 
                                        `<p class="small mb-1"><i class="fas fa-file me-1"></i>Current Document:</p>
                                             <div class="file-info">
                                                <i class="fas fa-file-pdf text-danger me-1"></i>
                                                ${faq.document_file}
                                             </div>` 
                                        : 
                                        '<p class="text-muted small"><i class="fas fa-exclamation-circle me-1"></i>No document uploaded</p>'
                                    }
                                </div>
                                
                                <input type="file" name="document_file" class="form-control file-input" 
                                       accept=".pdf,.doc,.docx" data-max-size="10485760">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Leave empty to keep current document (Max 10MB)</small>
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
                                
                                <input type="file" name="faq_image" class="form-control file-input" accept="image/*" 
                                       data-max-size="3145728">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Leave empty to keep current image (Max 3MB)</small>
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

                    form.action = `/admin/faq/delete/${faqId}`;

                    const typeText = faqType === 'doc' ? 'Document' : 'QR Feedback';
                    const message =
                        `Are you sure you want to delete ${typeText} item: <strong>"${faqTitle}"</strong>?`;

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

                                alert(data.is_active ? 'Item activated successfully!' :
                                    'Item deactivated successfully!');
                            }
                        })
                        .catch(error => {
                            alert('Error updating status');
                        });
                });
            });
        });
    </script>
@endsection

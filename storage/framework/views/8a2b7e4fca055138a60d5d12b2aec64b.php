
<?php $__env->startSection('title', 'Membership'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Membership</h3>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="m-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5>Add New Membership Content</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.membership.store')); ?>" method="POST" enctype="multipart/form-data"
                    id="addForm">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Content Type</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="download">Download (PDF: max 3MB)</option>
                            <option value="members_data">Member's Data (Image: max 5MB)</option>
                            <option value="bank">Bank (Images: max 5MB each)</option>
                        </select>
                    </div>

                    <div id="dynamic-fields">
                        
                        <div class="type-download d-none">
                            <div class="mb-3">
                                <label class="form-label">Document Name</label>
                                <input type="text" name="title" class="form-control" required>
                                <small class="text-muted">Enter a descriptive name for the PDF document</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Document File</label>
                                <input type="file" name="download_file" class="form-control"
                                    accept="application/pdf,.pdf" required data-file-type="pdf">
                                <small class="text-muted">PDF files only. Maximum size: 3MB</small>
                            </div>
                        </div>

                        
                        <div class="type-members_data d-none">
                            <div class="mb-3">
                                <label class="form-label">Member's Data Image</label>
                                <input type="file" name="members_image" class="form-control" accept="image/*" required
                                    data-preview="#add_applicant_preview" data-file-type="image">
                                <small class="text-muted">JPG, PNG, or WebP format. Maximum size: 5MB</small>
                                <img id="add_applicant_preview" src="#" class="img-thumbnail d-none mt-2"
                                    width="200">
                            </div>
                        </div>

                        
                        <div class="type-bank d-none">
                            <div class="mb-3">
                                <label class="form-label">Bank Logo</label>
                                <input type="file" name="bank_top_image" class="form-control" accept="image/*" required
                                    data-preview="#add_top_preview" data-file-type="image">
                                <small class="text-muted">JPG, PNG, or WebP format. Maximum size: 5MB</small>
                                <img id="add_top_preview" src="#" class="img-thumbnail d-none mt-2" width="100">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">QR Code</label>
                                <input type="file" name="bank_qr_image" class="form-control" accept="image/*" required
                                    data-preview="#add_qr_preview" data-file-type="image">
                                <small class="text-muted">JPG, PNG, or WebP format. Maximum size: 5MB</small>
                                <img id="add_qr_preview" src="#" class="img-thumbnail d-none mt-2" width="100">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-file-earmark-plus me-2"></i>Add Content
                        </button>
                    </div>
                </form>
            </div>
        </div>

        
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
                            <th>File Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="text-center">
                                <td><?php echo e($content->id); ?></td>
                                <td>
                                    <span
                                        class="badge 
                                        <?php if($content->type === 'download'): ?> bg-info
                                        <?php elseif($content->type === 'members_data'): ?> bg-warning
                                        <?php else: ?> bg-success <?php endif; ?>">
                                        <?php echo e(ucfirst($content->type)); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php if($content->type === 'download'): ?>
                                        <?php echo e($content->title); ?>

                                    <?php elseif($content->type === 'members_data'): ?>
                                        Member's Data Card
                                    <?php else: ?>
                                        Bank Details
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($content->file_path): ?>
                                        <?php if(Str::endsWith($content->file_path, ['.pdf'])): ?>
                                            <a href="<?php echo e(asset('storage/' . $content->file_path)); ?>" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-file-pdf me-1"></i>View PDF
                                            </a>
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('storage/' . $content->file_path)); ?>" class="img-thumbnail"
                                                width="80" alt="Preview">
                                        <?php endif; ?>
                                    <?php elseif($content->type === 'bank'): ?>
                                        <div class="d-flex justify-content-center gap-2">
                                            <?php if($content->top_image): ?>
                                                <img src="<?php echo e(asset('storage/' . $content->top_image)); ?>"
                                                    class="img-thumbnail" width="50" alt="Bank Logo">
                                            <?php endif; ?>
                                            <?php if($content->qr_image): ?>
                                                <img src="<?php echo e(asset('storage/' . $content->qr_image)); ?>"
                                                    class="img-thumbnail" width="50" alt="QR Code">
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                        $size = 0;
                                        if (
                                            $content->file_path &&
                                            Storage::disk('public')->exists($content->file_path)
                                        ) {
                                            $size = Storage::disk('public')->size($content->file_path);
                                        } elseif ($content->type === 'bank') {
                                            if (
                                                $content->top_image &&
                                                Storage::disk('public')->exists($content->top_image)
                                            ) {
                                                $size += Storage::disk('public')->size($content->top_image);
                                            }
                                            if (
                                                $content->qr_image &&
                                                Storage::disk('public')->exists($content->qr_image)
                                            ) {
                                                $size += Storage::disk('public')->size($content->qr_image);
                                            }
                                        }
                                    ?>
                                    <?php if($size > 0): ?>
                                        <?php echo e(number_format($size / 1024, 1)); ?> KB
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button class="btn btn-outline-primary edit-btn" data-id="<?php echo e($content->id); ?>"
                                            data-type="<?php echo e($content->type); ?>" data-title="<?php echo e($content->title ?? ''); ?>"
                                            data-file="<?php echo e($content->file_path ?? ''); ?>"
                                            data-top="<?php echo e($content->top_image ?? ''); ?>"
                                            data-qr="<?php echo e($content->qr_image ?? ''); ?>" data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>

                                        <button type="button" class="btn btn-outline-danger delete-btn"
                                            data-id="<?php echo e($content->id); ?>"
                                            data-url="<?php echo e(route('admin.membership.destroy', $content->id)); ?>"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                        No content added yet.
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Edit Membership Content</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <input type="text" id="edit_type" name="type" class="form-control" readonly>
                            <small class="text-muted" id="edit_type_hint"></small>
                        </div>
                        <div id="edit-fields"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-square me-1"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Delete Membership Content</h5>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this item?</p>
                        <p class="text-muted small">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i>Delete
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
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-check-circle me-2"></i>Success
                    </h5>
                </div>
                <div class="modal-body">
                    <?php echo e(session('success')); ?>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="warningModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>File Too Large
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="warningMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize modals
            const warningModal = new bootstrap.Modal(document.getElementById('warningModal'));
            const warningMessage = document.getElementById('warningMessage');

            // Success Modal Setup
            <?php if(session('success')): ?>
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                document.querySelector('#successModal .modal-body').textContent = "<?php echo e(session('success')); ?>";
                successModal.show();
                setTimeout(() => successModal.hide(), 3000);
            <?php endif; ?>

            // Delete Modal Setup
            const deleteForm = document.getElementById('deleteForm');
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const url = btn.getAttribute('data-url');
                    deleteForm.setAttribute('action', url);
                });
            });

            // Function to check file size
            function checkFileSize(file, maxSizeMB, fileType = 'file') {
                const maxSize = maxSizeMB * 1024 * 1024; // Convert MB to bytes
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

                if (file.size > maxSize) {
                    return {
                        valid: false,
                        message: `The ${fileType} file "<strong>${file.name}</strong>" is ${fileSizeMB}MB, which exceeds the ${maxSizeMB}MB limit.`
                    };
                }
                return {
                    valid: true
                };
            }

            // Function to show warning and close other modals
            function showFileSizeWarning(message) {
                // Close any open edit/delete modals first
                const openModals = document.querySelectorAll('.modal.show');
                openModals.forEach(modal => {
                    if (modal.id !== 'warningModal') {
                        const bsModal = bootstrap.Modal.getInstance(modal);
                        if (bsModal) bsModal.hide();
                    }
                });

                // Show warning modal
                warningMessage.innerHTML = message;
                warningModal.show();
            }

            // Function to show preview image
            function showPreviewImage(file, previewSelector) {
                const previewImg = document.querySelector(previewSelector);
                if (previewImg && file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewImg.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            }

            // Function to clear preview image
            function clearPreviewImage(previewSelector) {
                const previewImg = document.querySelector(previewSelector);
                if (previewImg) {
                    previewImg.classList.add('d-none');
                    previewImg.src = '#';
                }
            }

            // Function to setup file validation for a single input
            function setupFileInputValidation(input, maxSizeMB, fileType, previewSelector = null) {
                if (!input) return;

                // Remove any existing event listeners by cloning the input
                const newInput = input.cloneNode(true);
                input.parentNode.replaceChild(newInput, input);

                newInput.addEventListener('change', function(e) {
                    if (this.files && this.files.length > 0) {
                        const file = this.files[0];
                        const result = checkFileSize(file, maxSizeMB, fileType);

                        if (!result.valid) {
                            // Clear the file input
                            this.value = '';

                            // Clear preview if it exists
                            if (previewSelector) {
                                clearPreviewImage(previewSelector);
                            }

                            // Show warning
                            showFileSizeWarning(result.message);
                        } else {
                            // If file is valid, show preview
                            if (previewSelector) {
                                showPreviewImage(file, previewSelector);
                            }
                        }
                    }
                });

                return newInput;
            }

            // Setup validation for add form
            function setupAddFormFileValidation() {
                const typeSelect = document.getElementById('type');
                const selectedType = typeSelect.value;

                if (selectedType === 'download') {
                    const downloadFileInput = document.querySelector('input[name="download_file"]');
                    if (downloadFileInput) {
                        setupFileInputValidation(downloadFileInput, 3, 'PDF');
                    }
                } else if (selectedType === 'members_data') {
                    const membersImageInput = document.querySelector('input[name="members_image"]');
                    if (membersImageInput) {
                        setupFileInputValidation(membersImageInput, 5, 'image', '#add_applicant_preview');
                    }
                } else if (selectedType === 'bank') {
                    const bankTopInput = document.querySelector('input[name="bank_top_image"]');
                    const bankQrInput = document.querySelector('input[name="bank_qr_image"]');

                    if (bankTopInput) {
                        setupFileInputValidation(bankTopInput, 5, 'bank logo image', '#add_top_preview');
                    }

                    if (bankQrInput) {
                        setupFileInputValidation(bankQrInput, 5, 'QR code image', '#add_qr_preview');
                    }
                }
            }

            // Type switching for add form
            const typeSelect = document.getElementById('type');
            const typeFields = {
                'download': document.querySelector('.type-download'),
                'members_data': document.querySelector('.type-members_data'),
                'bank': document.querySelector('.type-bank')
            };

            typeSelect.addEventListener('change', () => {
                const selectedType = typeSelect.value;

                // Hide all fields first
                Object.values(typeFields).forEach(field => {
                    if (field) {
                        field.classList.add('d-none');
                        // Remove required attributes when hidden
                        field.querySelectorAll('[required]').forEach(input => {
                            input.removeAttribute('required');
                        });
                    }
                });

                // Show selected fields
                if (selectedType && typeFields[selectedType]) {
                    typeFields[selectedType].classList.remove('d-none');
                    // Add required attributes
                    typeFields[selectedType].querySelectorAll('input').forEach(input => {
                        if (input.type === 'file' || input.name === 'title') {
                            input.setAttribute('required', true);
                        }
                    });

                    // Setup file validation for the selected type
                    setTimeout(setupAddFormFileValidation, 50);
                }
            });

            // Initialize add form validation on page load
            setTimeout(setupAddFormFileValidation, 100);

            // Edit Modal Setup with file validation
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const type = btn.dataset.type;
                    const modal = document.getElementById('edit-fields');

                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_type').value = type;

                    // Set file size hint
                    const hint = document.getElementById('edit_type_hint');
                    if (type === 'download') {
                        hint.textContent = 'PDF files only. Maximum size: 3MB';
                    } else {
                        hint.textContent = 'Images only. Maximum size: 5MB';
                    }

                    let html = '';
                    if (type === 'download') {
                        html = `
                            <div class="mb-3">
                                <label class="form-label">Document Title</label>
                                <input type="text" name="title" value="${btn.dataset.title || ''}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Replace Document File</label>
                                <input type="file" name="file_path" class="form-control" accept=".pdf" data-file-type="pdf">
                                <small class="text-muted">Optional: Leave empty to keep current file</small>
                            </div>
                        `;
                    } else if (type === 'members_data') {
                        const currentFile = btn.dataset.file ? '/storage/' + btn.dataset.file : '#';
                        html = `
                            <div class="mb-3">
                                <label class="form-label">Replace Member's Data Image</label>
                                <input type="file" name="file_path" class="form-control" accept="image/*" data-preview="#edit_applicant_preview" data-file-type="image">
                                <small class="text-muted">Optional: Leave empty to keep current image</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Current Image:</label>
                                <img id="edit_applicant_preview" src="${currentFile}" class="img-thumbnail ${btn.dataset.file ? '' : 'd-none'}" width="200" alt="Current Image">
                            </div>
                        `;
                    } else if (type === 'bank') {
                        const currentTop = btn.dataset.top ? '/storage/' + btn.dataset.top : '#';
                        const currentQr = btn.dataset.qr ? '/storage/' + btn.dataset.qr : '#';
                        html = `
                            <div class="mb-3">
                                <label class="form-label">Replace Bank Logo</label>
                                <input type="file" name="top_image" class="form-control" accept="image/*" data-preview="#edit_top_preview" data-file-type="image">
                                <small class="text-muted">Optional: Leave empty to keep current logo</small>
                                <img id="edit_top_preview" src="${currentTop}" class="img-thumbnail ${btn.dataset.top ? '' : 'd-none'} mt-2" width="100" alt="Current Logo">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Replace QR Code</label>
                                <input type="file" name="qr_image" class="form-control" accept="image/*" data-preview="#edit_qr_preview" data-file-type="image">
                                <small class="text-muted">Optional: Leave empty to keep current QR code</small>
                                <img id="edit_qr_preview" src="${currentQr}" class="img-thumbnail ${btn.dataset.qr ? '' : 'd-none'} mt-2" width="100" alt="Current QR Code">
                            </div>
                        `;
                    }

                    modal.innerHTML = html;
                    document.getElementById('editForm').action = `/admin/membership/${id}`;

                    // Setup file validation for edit modal after HTML is inserted
                    setTimeout(() => {
                        setupEditModalFileValidation(type);
                    }, 100);
                });
            });

            // Function to setup file validation for edit modal
            function setupEditModalFileValidation(type) {
                const maxSize = type === 'download' ? 3 : 5;
                const fileType = type === 'download' ? 'PDF' : 'image';

                // Get all file inputs in the edit modal
                const fileInputs = document.querySelectorAll('#editModal input[type="file"]');

                fileInputs.forEach(input => {
                    const previewSelector = input.getAttribute('data-preview');
                    setupFileInputValidation(input, maxSize, fileType, previewSelector);
                });

                // Also validate on form submission as backup
                const editForm = document.getElementById('editForm');
                if (editForm) {
                    editForm.addEventListener('submit', function(e) {
                        const fileInputs = this.querySelectorAll('input[type="file"]');
                        let hasError = false;
                        let errorMessage = '';

                        fileInputs.forEach(input => {
                            if (input.files.length > 0 && !hasError) {
                                const fileType = input.getAttribute('data-file-type') === 'pdf' ?
                                    'PDF' : 'image';
                                const maxSize = fileType === 'PDF' ? 3 : 5;
                                const result = checkFileSize(input.files[0], maxSize, fileType);
                                if (!result.valid) {
                                    hasError = true;
                                    errorMessage = result.message;
                                }
                            }
                        });

                        if (hasError) {
                            e.preventDefault();
                            showFileSizeWarning(errorMessage);
                        }
                    });
                }
            }

            // Form submission validation for add form
            const addForm = document.querySelector('form[action="<?php echo e(route('admin.membership.store')); ?>"]');
            if (addForm) {
                addForm.addEventListener('submit', function(e) {
                    const typeSelect = document.getElementById('type');
                    const selectedType = typeSelect.value;
                    let hasError = false;
                    let errorMessage = '';

                    if (selectedType === 'download') {
                        const fileInput = addForm.querySelector('input[name="download_file"]');
                        if (fileInput && fileInput.files.length > 0) {
                            const result = checkFileSize(fileInput.files[0], 3, 'PDF');
                            if (!result.valid) {
                                hasError = true;
                                errorMessage = result.message;
                            }
                        }
                    } else if (selectedType === 'members_data') {
                        const fileInput = addForm.querySelector('input[name="members_image"]');
                        if (fileInput && fileInput.files.length > 0) {
                            const result = checkFileSize(fileInput.files[0], 5, 'image');
                            if (!result.valid) {
                                hasError = true;
                                errorMessage = result.message;
                            }
                        }
                    } else if (selectedType === 'bank') {
                        const topInput = addForm.querySelector('input[name="bank_top_image"]');
                        const qrInput = addForm.querySelector('input[name="bank_qr_image"]');

                        if (topInput && topInput.files.length > 0) {
                            const result = checkFileSize(topInput.files[0], 5, 'bank logo image');
                            if (!result.valid) {
                                hasError = true;
                                errorMessage = result.message;
                            }
                        }
                        if (qrInput && qrInput.files.length > 0 && !hasError) {
                            const result = checkFileSize(qrInput.files[0], 5, 'QR code image');
                            if (!result.valid) {
                                hasError = true;
                                errorMessage = result.message;
                            }
                        }
                    }

                    if (hasError) {
                        e.preventDefault();
                        showFileSizeWarning(errorMessage);
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views\admin\admin_membership.blade.php ENDPATH**/ ?>
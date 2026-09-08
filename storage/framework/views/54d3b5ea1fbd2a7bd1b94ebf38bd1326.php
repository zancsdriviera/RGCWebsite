

<?php $__env->startSection('content'); ?>
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

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div>
                    <strong>Please correct the following error(s):</strong>
                    <ul class="mb-0 mt-2">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <div class="container-fluid px-4 py-3">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h3 class="fw-bold mb-1">Announcement</h3>
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-plus-circle me-1"></i>New Announcement
            </button>
        </div>


        <!-- Announcements Card -->
        <div class="card mb-4">

            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">All Announcements</h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover">

                        <thead class="table-light">
                            <tr>
                                <th width="50">Order</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Published Date</th>
                                <th>Created At</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>

                                    <td>
                                        <input type="number" class="form-control form-control-sm order-input"
                                            data-id="<?php echo e($announcement->id); ?>" value="<?php echo e($announcement->order); ?>"
                                            style="width: 70px;">
                                    </td>

                                    <td>
                                        <?php echo e($announcement->title); ?>

                                    </td>

                                    <td>
                                        <?php if($announcement->is_published): ?>
                                            <span class="badge bg-success">Published</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Draft</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php echo e($announcement->published_date ? $announcement->published_date->format('Y-m-d') : '-'); ?>

                                    </td>

                                    <td>
                                        <?php echo e($announcement->created_at->format('Y-m-d')); ?>

                                    </td>

                                    <td>

                                        <button class="btn btn-sm btn-info edit-btn" data-id="<?php echo e($announcement->id); ?>"
                                            data-title="<?php echo e($announcement->title); ?>"
                                            data-content="<?php echo e($announcement->content); ?>"
                                            data-is_published="<?php echo e($announcement->is_published); ?>"
                                            data-published_date="<?php echo e($announcement->published_date ? $announcement->published_date->format('Y-m-d') : ''); ?>"
                                            data-order="<?php echo e($announcement->order); ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn btn-sm btn-danger delete-btn" data-id="<?php echo e($announcement->id); ?>"
                                            data-title="<?php echo e($announcement->title); ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-muted mb-0">
                                            No announcements yet. Click "New Announcement" to create one.
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>

                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>



    <!-- ========================================================= -->
    <!-- CREATE MODAL -->
    <!-- ========================================================= -->

    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="<?php echo e(route('admin.announcement.store')); ?>" method="POST" enctype="multipart/form-data"
                    id="createForm">

                    <?php echo csrf_field(); ?>

                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title">Create New Announcement</h5>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Title</label>

                            <input type="text" name="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Content</label>

                            <textarea name="content" class="form-control" rows="5"><?php echo e(old('content')); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Featured Image
                            </label>

                            <input type="file" name="featured_image" id="create_featured_image"
                                class="form-control image-upload" accept="image/jpeg,image/png,image/jpg">

                            <small class="text-muted">
                                Maximum file size: <strong>3 MB</strong>.
                                Allowed formats: JPG, JPEG, PNG.
                            </small>

                            <div class="invalid-feedback" id="create_image_error"></div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Published Date</label>

                                <input type="date" name="published_date" class="form-control"
                                    value="<?php echo e(old('published_date')); ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Order</label>

                                <input type="number" name="order" class="form-control" value="<?php echo e(old('order', 0)); ?>">
                            </div>

                        </div>

                        <div class="mb-3">
                            <div class="form-check">

                                <input type="checkbox" name="is_published" class="form-check-input" value="1"
                                    <?php echo e(old('is_published') ? 'checked' : ''); ?>>

                                <label class="form-check-label">
                                    Publish immediately
                                </label>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>


    <!-- ========================================================= -->
    <!-- EDIT MODAL -->
    <!-- ========================================================= -->

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form id="editForm" method="POST" enctype="multipart/form-data">

                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="modal-header bg-primary text-white">

                        <h5 class="modal-title">
                            Edit Announcement
                        </h5>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">
                                Title *
                            </label>

                            <input type="text" name="title" id="edit_title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Content
                            </label>

                            <textarea name="content" id="edit_content" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Featured Image
                            </label>

                            <input type="file" name="featured_image" id="edit_featured_image"
                                class="form-control image-upload" accept="image/jpeg,image/png,image/jpg">

                            <small class="text-muted">
                                Leave empty to keep current image.
                                Maximum file size: <strong>2 MB</strong>.
                                Allowed formats: JPG, JPEG, PNG.
                            </small>

                            <div class="invalid-feedback" id="edit_image_error"></div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Published Date
                                </label>

                                <input type="date" name="published_date" id="edit_published_date"
                                    class="form-control">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Order
                                </label>

                                <input type="number" name="order" id="edit_order" class="form-control"
                                    value="0">

                            </div>

                        </div>

                        <div class="mb-3">

                            <div class="form-check">

                                <input type="checkbox" name="is_published" id="edit_is_published"
                                    class="form-check-input" value="1">

                                <label class="form-check-label">
                                    Published
                                </label>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-square me-1"></i>
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>


    <!-- ========================================================= -->
    <!-- DELETE MODAL -->
    <!-- ========================================================= -->

    <div class="modal fade" id="deleteModal" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <form id="deleteForm" method="POST">

                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>

                    <div class="modal-header bg-danger text-white">

                        <h5 class="modal-title">
                            Delete Announcement
                        </h5>
                    </div>

                    <div class="modal-body">

                        <p>
                            Are you sure you want to delete
                            "<span id="delete_title"></span>"?
                        </p>

                        <p class="text-danger mb-0">
                            This action cannot be undone.
                        </p>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                            Delete
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <!-- ========================================================= -->
    <!-- IMAGE SIZE WARNING MODAL -->
    <!-- ========================================================= -->

    <div class="modal fade" id="imageSizeWarningModal" tabindex="-1" aria-labelledby="imageSizeWarningLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title" id="imageSizeWarningLabel">

                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Image Too Large

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <p class="mb-2">
                        The image you selected is too large.
                    </p>

                    <div class="alert alert-warning">

                        <div>
                            <strong>Selected file:</strong>
                            <span id="selectedFileName"></span>
                        </div>

                        <div>
                            <strong>File size:</strong>
                            <span id="selectedFileSize"></span>
                        </div>

                        <div>
                            <strong>Maximum allowed:</strong>
                            3 MB
                        </div>

                    </div>

                    <p class="mb-0 text-muted">
                        Please choose a smaller image and try again.
                    </p>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        OK, I'll choose another image
                    </button>

                </div>

            </div>

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /*
             * =====================================================
             * CONFIGURATION
             * =====================================================
             */

            const MAX_FILE_SIZE = 3 * 1024 * 1024; // 3 MB


            /*
             * =====================================================
             * IMAGE SIZE CHECK
             * =====================================================
             */

            function formatFileSize(bytes) {

                if (bytes < 1024) {
                    return bytes + ' B';
                }

                if (bytes < 1024 * 1024) {
                    return (bytes / 1024).toFixed(2) + ' KB';
                }

                return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
            }


            function checkImageSize(input) {

                if (!input.files || !input.files.length) {
                    return true;
                }

                const file = input.files[0];

                if (file.size > MAX_FILE_SIZE) {

                    document.getElementById('selectedFileName').textContent =
                        file.name;

                    document.getElementById('selectedFileSize').textContent =
                        formatFileSize(file.size);

                    input.value = '';

                    const modalElement =
                        document.getElementById('imageSizeWarningModal');

                    const modal =
                        bootstrap.Modal.getOrCreateInstance(modalElement);

                    modal.show();

                    return false;
                }

                return true;
            }


            /*
             * =====================================================
             * CHECK IMAGE IMMEDIATELY WHEN SELECTED
             * =====================================================
             */

            document.querySelectorAll('.image-upload').forEach(function(input) {

                input.addEventListener('change', function() {
                    checkImageSize(this);
                });

            });


            /*
             * =====================================================
             * CHECK AGAIN BEFORE FORM SUBMISSION
             * =====================================================
             */

            document.querySelectorAll('form[enctype="multipart/form-data"]')
                .forEach(function(form) {

                    form.addEventListener('submit', function(event) {

                        const imageInput =
                            form.querySelector('.image-upload');

                        if (imageInput && !checkImageSize(imageInput)) {

                            event.preventDefault();

                        }

                    });

                });


            /*
             * =====================================================
             * EDIT BUTTON
             * =====================================================
             */

            document.querySelectorAll('.edit-btn').forEach(function(btn) {

                btn.addEventListener('click', function() {

                    const id = this.dataset.id;

                    document.getElementById('edit_title').value =
                        this.dataset.title;

                    document.getElementById('edit_content').value =
                        this.dataset.content || '';

                    document.getElementById('edit_published_date').value =
                        this.dataset.published_date || '';

                    document.getElementById('edit_order').value =
                        this.dataset.order || 0;

                    document.getElementById('edit_is_published').checked =
                        this.dataset.is_published === '1' ||
                        this.dataset.is_published === 'true';

                    document.getElementById('editForm').action =
                        `/admin/announcement/${id}`;

                    bootstrap.Modal.getOrCreateInstance(
                        document.getElementById('editModal')
                    ).show();

                });

            });


            /*
             * =====================================================
             * DELETE BUTTON
             * =====================================================
             */

            document.querySelectorAll('.delete-btn').forEach(function(btn) {

                btn.addEventListener('click', function() {

                    const id = this.dataset.id;

                    const title = this.dataset.title;

                    document.getElementById('delete_title').textContent =
                        title;

                    document.getElementById('deleteForm').action =
                        `/admin/announcement/${id}`;

                    bootstrap.Modal.getOrCreateInstance(
                        document.getElementById('deleteModal')
                    ).show();

                });

            });


            /*
             * =====================================================
             * ORDER UPDATE
             * =====================================================
             */

            document.querySelectorAll('.order-input').forEach(function(input) {

                input.addEventListener('change', function() {

                    const id = this.dataset.id;

                    const order = this.value;

                    fetch(`/admin/announcement/${id}/order`, {

                            method: 'PATCH',

                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                            },

                            body: JSON.stringify({
                                order: order
                            })

                        })
                        .then(response => response.json())
                        .then(data => {

                            if (data.success) {
                                location.reload();
                            }

                        })
                        .catch(error => {
                            console.error('Order update failed:', error);
                        });

                });

            });

        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_announcement.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'ACGR'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">


        <h3 class="mb-3 fw-bold">Annual Corporate Governance Report Document List</h3>

        <!-- Upload Form -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="<?php echo e(route('admin.acgr.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <input type="number" name="year" class="form-control" placeholder="Year" required>
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="file" class="form-control" accept="application/pdf" required>
                        </div>
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-success"><i class="bi bi-file-earmark-arrow-up me-2"></i>Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table List -->
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Uploaded Documents</div>

            <div class="card-body p-0">
                <table class="table table-bordered table-striped m-0 text-center">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>File</th>
                            <th style="width:150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($doc->year); ?></td>
                                <td>
                                    <a href="<?php echo e(asset('storage/' . $doc->file_path)); ?>" target="_blank"
                                        class="btn btn-link">
                                        View PDF
                                    </a>
                                </td>
                                <td>
                                    <div class="d-grid gap-1">
                                        <!-- Edit Button -->
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal<?php echo e($doc->id); ?>"><i
                                                class="bi bi-pencil-square"></i> Edit</button>

                                        <!-- Delete Form -->
                                        <button type="button" class="btn btn-danger btn-sm w-100 delete-acgr-btn"
                                            data-url="<?php echo e(route('admin.acgr.delete', $doc->id)); ?>" data-bs-toggle="modal"
                                            data-bs-target="#deleteAcgrModal">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Success Modal -->
                            <div class="modal fade" id="successModal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title">Success</h5>
                                        </div>
                                        <div class="modal-body text-black">
                                            <?php echo e(session('modal_message')); ?>

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?php echo e($doc->id); ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Edit Document </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="<?php echo e(route('admin.acgr.update', $doc->id)); ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="year<?php echo e($doc->id); ?>" class="form-label">Year</label>
                                                    <input type="number" name="year" id="year<?php echo e($doc->id); ?>"
                                                        class="form-control" value="<?php echo e($doc->year); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="file<?php echo e($doc->id); ?>" class="form-label">Replace File
                                                        (optional)
                                                    </label>
                                                    <input type="file" name="file" id="file<?php echo e($doc->id); ?>"
                                                        class="form-control" accept="application/pdf">
                                                    <small class="text-muted">Leave empty to keep current file</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            
                            <div class="modal fade" id="deleteAcgrModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <form id="deleteAcgrForm" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                Are you sure you want to delete this document?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($docs->isEmpty()): ?>
                            <tr>
                                <td colspan="3" class="text-muted">No documents uploaded yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        //Delete modal setup
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForm = document.getElementById('deleteAcgrForm');

            document.querySelectorAll('.delete-acgr-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const url = btn.getAttribute('data-url');
                    deleteForm.setAttribute('action', url);
                });
            });
        });

        // Show success modal if session has modal_message
        document.addEventListener('DOMContentLoaded', () => {
            <?php if(session('success')): ?>
                const modalEl = document.getElementById('successModal');
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.textContent = "<?php echo e(session('success')); ?>";
                modalBody.style.color = 'green'; // optional: color

                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // Auto-close after 1.5s
                setTimeout(() => modal.hide(), 3000);
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_acgr.blade.php ENDPATH**/ ?>
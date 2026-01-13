
<?php $__env->startSection('title', 'Careers'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Careers</h3>


        <!-- Add Career Image -->
        <form action="<?php echo e(route('admin.careers.store')); ?>" method="POST" enctype="multipart/form-data" class="card p-4 mb-4">
            <?php echo csrf_field(); ?>
            <h5>Add New Job Opening</h5>
            <div class="mb-3">
                <label class="form-label">Upload Image</label>
                <input type="file" name="career_image" class="form-control" accept="image/*" required>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-bookmark-plus me-2"></i>Post Job
                    Opening</button>
            </div>

        </form>

        <!-- Display Uploaded Images -->
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <img src="<?php echo e(asset('storage/' . $career->career_image)); ?>" class="card-img-top" alt="Career Image">
                        <div class="card-body text-center">
                            <!-- Edit Form -->
                            <form action="<?php echo e(route('admin.careers.update', $career->id)); ?>" method="POST"
                                enctype="multipart/form-data" class="mb-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="file" name="career_image" class="form-control mb-2" accept="image/*"
                                    required>
                                <button class="btn btn-outline-primary w-100"><i class="bi bi-arrow-repeat"></i>
                                    Update</button>
                            </form>

                            <!-- Delete Form -->
                            <button type="button" class="btn btn-outline-danger w-100 delete-career-btn"
                                data-url="<?php echo e(route('admin.careers.destroy', $career->id)); ?>" data-bs-toggle="modal"
                                data-bs-target="#deleteCareerModal">
                                <i class="bi bi-trash"></i> Delete
                            </button>

                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-muted">No career images uploaded yet.</p>
            <?php endif; ?>
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
                    <?php echo e(session('modal_message')); ?>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="deleteCareerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteCareerForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Confirm Delete</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this job post?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
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

        // Delete Modal Script
        document.addEventListener('DOMContentLoaded', () => {
            const deleteForm = document.getElementById('deleteCareerForm');

            document.querySelectorAll('.delete-career-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const url = btn.getAttribute('data-url');
                    deleteForm.setAttribute('action', url);
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views\admin\admin_careers.blade.php ENDPATH**/ ?>
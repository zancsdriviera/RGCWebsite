
<?php $__env->startSection('title', 'Contact Us'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Contact Us</h3>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($e); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- MAIN CONTACT -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Main Contact (Address & Main Phone)</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.contact.updateMain')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="fw-semibold">Address</label>
                        <textarea name="address" class="form-control" rows="3" required><?php echo e(old('address', $main->address ?? '')); ?></textarea>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Main Contact Number</label>
                        <input type="text" name="main_phone" class="form-control" required
                            value="<?php echo e(old('main_phone', $main->main_phone ?? '')); ?>">
                        <?php $__errorArgs = ['main_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <small class="text-danger"><?php echo e($message); ?></small>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($d->id); ?></td>
                                <td><?php echo e($d->title); ?></td>
                                <td><?php echo e($d->phone ?? '-'); ?></td>
                                <td><?php echo e($d->email ?? '-'); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-dept-btn" data-id="<?php echo e($d->id); ?>"
                                        data-title="<?php echo e($d->title); ?>" data-phone="<?php echo e($d->phone); ?>"
                                        data-email="<?php echo e($d->email); ?>" data-sort="<?php echo e($d->sort_order); ?>"
                                        data-update-url="<?php echo e(route('admin.contact.updateDepartment', $d->id)); ?>"
                                        data-bs-toggle="modal" data-bs-target="#editDepartmentModal">
                                        Edit
                                    </button>




                                    <form action="<?php echo e(route('admin.contact.destroyDepartment', $d->id)); ?>" method="POST"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this department?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center">No departments yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Department Modal -->
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?php echo e(route('admin.contact.storeDepartment')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
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
                
                <form id="editDeptForm" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

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

                    // Ensure method spoofing is in the form (blade already has <?php echo method_field('PUT'); ?>)
                    // Clear previous inline error box if any
                    const errBox = document.getElementById('edit-dept-errors');
                    if (errBox) {
                        errBox.style.display = 'none';
                        errBox.innerHTML = '';
                    }
                });
            });

            // Re-open modal with server validation errors if controller returned them
            <?php if($errors->any() && session('edit_department_id')): ?>
                (function() {
                    const id = "<?php echo e(session('edit_department_id')); ?>";
                    const btn = document.querySelector(`.edit-dept-btn[data-id="${id}"]`);
                    if (btn) btn.click();
                    const errBox = document.getElementById('edit-dept-errors');
                    if (errBox) {
                        errBox.style.display = 'block';
                        errBox.innerHTML = `<?php echo implode('<br>', $errors->all()); ?>`;
                    }
                })();
            <?php endif; ?>

        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_contactUs.blade.php ENDPATH**/ ?>
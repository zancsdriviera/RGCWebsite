
<?php $__env->startSection('title', 'Hole-In-One Editor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Hole-In-One</h3>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($err); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            
            <div class="col-md-6">
                <div class="card shadow-sm p-4 mb-4">
                    <h5 class="text-primary fw-bold mb-3">
                        <i class="bi bi-flag-fill me-2"></i> Couples
                    </h5>

                    <form action="<?php echo e(route('admin.holeinone.store', 'couples')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" required
                                    value="<?php echo e(old('first_name')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required
                                    value="<?php echo e(old('last_name')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hole #</label>
                                <input type="number" name="hole_number" class="form-control" required min="1"
                                    max="18" value="<?php echo e(old('hole_number')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" required
                                    value="<?php echo e(old('date')); ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-card-checklist me-2"></i>Add
                                Record</button>
                        </div>

                    </form>

                    <hr>

                    <table class="table table-striped table-hover mt-3 text-center">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Hole #</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $couples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($player->first_name); ?></td>
                                    <td><?php echo e($player->last_name); ?></td>
                                    <td><?php echo e($player->hole_number); ?></td>
                                    <td><?php echo e($player->date); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal" data-id="<?php echo e($player->id); ?>" data-type="couples"
                                            data-first_name="<?php echo e($player->first_name); ?>"
                                            data-last_name="<?php echo e($player->last_name); ?>"
                                            data-hole_number="<?php echo e($player->hole_number); ?>"
                                            data-date="<?php echo e($player->date); ?>">Edit</button>

                                        <form
                                            action="<?php echo e(route('admin.holeinone.destroy', ['type' => 'couples', 'id' => $player->id])); ?>"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete this record?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="card shadow-sm p-4 mb-4">
                    <h5 class="text-success fw-bold mb-3">
                        <i class="bi bi-flag-fill me-2"></i> Langer
                    </h5>

                    <form action="<?php echo e(route('admin.holeinone.store', 'langer')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" required
                                    value="<?php echo e(old('first_name')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required
                                    value="<?php echo e(old('last_name')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hole #</label>
                                <input type="number" name="hole_number" class="form-control" required min="1"
                                    max="18" value="<?php echo e(old('hole_number')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" required
                                    value="<?php echo e(old('date')); ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-3"><i class="bi bi-card-checklist me-2"></i>Add
                                Record</button>
                        </div>

                    </form>

                    <hr>

                    <table class="table table-striped table-hover mt-3 text-center">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Hole #</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $langer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($player->first_name); ?></td>
                                    <td><?php echo e($player->last_name); ?></td>
                                    <td><?php echo e($player->hole_number); ?></td>
                                    <td><?php echo e($player->date); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal" data-id="<?php echo e($player->id); ?>" data-type="langer"
                                            data-first_name="<?php echo e($player->first_name); ?>"
                                            data-last_name="<?php echo e($player->last_name); ?>"
                                            data-hole_number="<?php echo e($player->hole_number); ?>"
                                            data-date="<?php echo e($player->date); ?>">Edit</button>

                                        <form
                                            action="<?php echo e(route('admin.holeinone.destroy', ['type' => 'langer', 'id' => $player->id])); ?>"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete this record?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editType" name="type">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" id="editFirstName" name="first_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" id="editLastName" name="last_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hole #</label>
                            <input type="number" id="editHoleNumber" name="hole_number" class="form-control" required
                                min="1" max="18">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" id="editDate" name="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const type = button.getAttribute('data-type');
            const firstName = button.getAttribute('data-first_name');
            const lastName = button.getAttribute('data-last_name');
            const holeNumber = button.getAttribute('data-hole_number');
            const date = button.getAttribute('data-date');

            const form = document.getElementById('editForm');
            // Use route helper with placeholders
            form.action = "<?php echo e(route('admin.holeinone.update', ['type' => '__TYPE__', 'id' => '__ID__'])); ?>"
                .replace('__TYPE__', type)
                .replace('__ID__', id);

            document.getElementById('editType').value = type;
            document.getElementById('editFirstName').value = firstName;
            document.getElementById('editLastName').value = lastName;
            document.getElementById('editHoleNumber').value = holeNumber;
            document.getElementById('editDate').value = date;
        });
    </script>
    <style>
        .form-label {
            font-weight: 600;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_holeinone.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title', 'Hole-In-One Editor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Hole-In-One</h3>

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
                    <h5 class="text-success fw-bold mb-3">
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
                            <button type="submit" class="btn btn-success mt-3 add-record-btn"><i
                                    class="bi bi-card-checklist me-2"></i>Add
                                Record</button>
                        </div>
                    </form>

                    <hr>

                    <!-- Responsive table wrapper -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mt-3 text-center responsive-table">
                            <thead class="table-dark">
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
                                        <td data-label="First Name"><?php echo e($player->first_name); ?></td>
                                        <td data-label="Last Name"><?php echo e($player->last_name); ?></td>
                                        <td data-label="Hole #"><?php echo e($player->hole_number); ?></td>
                                        <td data-label="Date"><?php echo e($player->date); ?></td>
                                        <td data-label="Action" class="table-actions-cell">
                                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                                <button class="btn btn-sm btn-outline-primary edit-btn"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="<?php echo e($player->id); ?>" data-type="couples"
                                                    data-first_name="<?php echo e($player->first_name); ?>"
                                                    data-last_name="<?php echo e($player->last_name); ?>"
                                                    data-hole_number="<?php echo e($player->hole_number); ?>"
                                                    data-date="<?php echo e($player->date); ?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>

                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger delete-holeinone-btn"
                                                    data-url="<?php echo e(route('admin.holeinone.destroy', ['type' => 'couples', 'id' => $player->id])); ?>"
                                                    data-bs-toggle="modal" data-bs-target="#deleteHoleinoneModal">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
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
                            <button type="submit" class="btn btn-success mt-3 add-record-btn"><i
                                    class="bi bi-card-checklist me-2"></i>Add
                                Record</button>
                        </div>
                    </form>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover mt-3 text-center responsive-table">
                            <thead class="table-dark">
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
                                        <td data-label="First Name"><?php echo e($player->first_name); ?></td>
                                        <td data-label="Last Name"><?php echo e($player->last_name); ?></td>
                                        <td data-label="Hole #"><?php echo e($player->hole_number); ?></td>
                                        <td data-label="Date"><?php echo e($player->date); ?></td>
                                        <td data-label="Action" class="table-actions-cell">
                                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                                <button class="btn btn-sm btn-outline-primary edit-btn"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="<?php echo e($player->id); ?>" data-type="langer"
                                                    data-first_name="<?php echo e($player->first_name); ?>"
                                                    data-last_name="<?php echo e($player->last_name); ?>"
                                                    data-hole_number="<?php echo e($player->hole_number); ?>"
                                                    data-date="<?php echo e($player->date); ?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>

                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger delete-holeinone-btn"
                                                    data-url="<?php echo e(route('admin.holeinone.destroy', ['type' => 'langer', 'id' => $player->id])); ?>"
                                                    data-bs-toggle="modal" data-bs-target="#deleteHoleinoneModal">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
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
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check2-square me-1"></i>Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="deleteHoleinoneModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteHoleinoneForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Confirm Delete</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this record?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal (unchanged) -->
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

    
    <style>
        /* General improvements */
        .form-label {
            font-weight: 600;
        }

        .add-record-btn {
            padding: 8px 18px;
            font-size: 0.9rem;
            border-radius: 6px;
        }

        /* ================================
                                                                                                                                                               SMALL LAPTOPS (≤1280px)
                                                                                                                                                               Shrink table spacing, fonts, buttons
                                                                                                                                                            ================================= */
        @media (max-width: 1280px) {

            .responsive-table th,
            .responsive-table td {
                padding: 6px 8px !important;
                font-size: 0.85rem !important;
            }

            .table-actions-cell .btn {
                padding: 3px 8px !important;
                font-size: 0.75rem !important;
            }

            h5 {
                font-size: 1.05rem;
            }

            .card {
                padding: 1rem !important;
            }

            .form-control {
                padding: 4px 8px !important;
                font-size: 0.85rem !important;
            }

            .add-record-btn {
                padding: 8px 18px;
                font-size: 0.8rem;
                border-radius: 6px;
            }
        }

        /* Small laptops */
        @media (max-width: 1024px) {
            .add-record-btn {
                padding: 7px 16px;
                font-size: 0.75rem;
            }
        }

        /* ================================
                                                                                                                                                               TABLET & BELOW (≤900px)
                                                                                                                                                               Slight compression before full stack
                                                                                                                                                            ================================= */
        @media (max-width: 900px) {

            .responsive-table th,
            .responsive-table td {
                padding: 5px !important;
                font-size: 0.80rem !important;
            }

            .table-actions-cell .btn {
                padding: 3px 6px !important;
                font-size: 0.72rem !important;
            }
        }

        /* ================================
                                                                                                                                                               MOBILE VIEW (≤768px)
                                                                                                                                                               Convert table → stacked card layout
                                                                                                                                                            ================================= */
        @media (max-width: 768px) {

            .responsive-table thead {
                display: none;
            }

            .responsive-table tbody,
            .responsive-table tr,
            .responsive-table td {
                display: block;
                width: 100%;
            }

            .responsive-table tr {
                margin-bottom: 10px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
                padding: 10px;
            }

            .responsive-table td {
                padding: 6px 8px !important;
                display: flex;
                justify-content: space-between;
                font-size: 0.9rem;
                border: none !important;
            }

            .responsive-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: #222;
                flex-basis: 40%;
                font-size: 0.9rem;
            }

            .table-actions-cell .d-flex {
                flex-direction: column;
                gap: 6px;
                width: 100%;
            }

            .table-actions-cell .btn {
                width: 100%;
                font-size: 0.82rem !important;
                padding: 6px !important;
            }

            .add-record-btn {
                padding: 6px 14px;
                font-size: 0.7rem;
            }
        }

        /* ================================
                                                                                                                                                               VERY SMALL SCREENS (≤420px)
                                                                                                                                                               Final compression
                                                                                                                                                            ================================= */
        @media (max-width: 420px) {
            .responsive-table tr {
                padding: 8px;
            }

            .responsive-table td::before {
                font-size: 0.85rem;
            }

            .responsive-table td {
                font-size: 0.85rem;
            }

            .table-actions-cell .btn {
                font-size: 0.75rem !important;
                padding: 5px !important;
            }

            .btnAdd {
                font-size: 0.75rem !important;
                padding: 5px !important;
            }

            .add-record-btn {
                padding: 5px 10px;
                font-size: 0.65rem;
            }
        }
    </style>


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

        document.addEventListener('DOMContentLoaded', () => {
            const deleteForm = document.getElementById('deleteHoleinoneForm');

            document.querySelectorAll('.delete-holeinone-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const url = btn.getAttribute('data-url');
                    deleteForm.setAttribute('action', url);
                });
            });
        });

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views\admin\admin_holeinone.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title', 'COURSE SCHEDULE'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .symbol-btn {
            font-weight: bold;
            font-size: 1.05rem;
            width: 42px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .row-flex {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }

        .row-flex input,
        .row-flex select {
            min-width: 0;
        }

        .schedule-row {
            border: 1px solid #e9ecef;
            padding: 12px;
            border-radius: 6px;
            background: #f8f9fa;
        }

        .schedule-row+.schedule-row {
            margin-top: 10px;
        }

        .other-input {
            display: none;
        }
    </style>

    <div class="container-fluid p-4">

        <h3 class="mb-3 fw-bold">Course Schedule</h3>

        <!-- Date range filter + Add button -->
        <form method="GET" class="row g-2 mb-3 align-items-end">
            <div class="col-auto">
                <label class="form-label fw-bold">Start</label>
                <input type="date" name="start_date" class="form-control" value="<?php echo e(request('start_date')); ?>">
            </div>
            <div class="col-auto">
                <label class="form-label fw-bold">End</label>
                <input type="date" name="end_date" class="form-control" value="<?php echo e(request('end_date')); ?>">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary">Filter</button>
                <a href="<?php echo e(route('admin.coursesched.index')); ?>" class="btn btn-secondary">Reset</a>
            </div>

            <div class="col-auto ms-auto">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bi bi-plus-circle"></i> Add Course Schedule
                </button>
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive bg-white p-2 rounded">
            <table class="table table-bordered align-middle text-center table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width:18%">Date</th>
                        <th>Langer Schedule</th>
                        <th>Couples Schedule</th>
                        <th style="width: 250px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e(\Carbon\Carbon::parse($e->date)->format('F d, Y')); ?></td>

                            <td>
                                <?php if($e->langer_status === 'Others'): ?>
                                    <?php echo e($e->langer_other ?? 'TBA'); ?>

                                <?php else: ?>
                                    <?php echo e($e->langer_status ?? 'TBA'); ?>

                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($e->couples_status === 'Others'): ?>
                                    <?php echo e($e->couples_other ?? 'TBA'); ?>

                                <?php else: ?>
                                    <?php echo e($e->couples_status ?? 'TBA'); ?>

                                <?php endif; ?>
                            </td>

                            <td>
                                <button type="button" class="btn bg-primary text-white btn-sm editBtn"
                                    data-id="<?php echo e($e->id); ?>" data-date="<?php echo e($e->date->toDateString()); ?>"
                                    data-langer-status="<?php echo e($e->langer_status); ?>"
                                    data-langer-other="<?php echo e($e->langer_other); ?>"
                                    data-couples-status="<?php echo e($e->couples_status); ?>"
                                    data-couples-other="<?php echo e($e->couples_other); ?>" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>

                                <button type="button" class="btn btn-danger btn-sm deleteBtn"
                                    data-id="<?php echo e($e->id); ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="table-active text-center">No events found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- pagination -->
        <div class="mt-3 d-flex justify-content-center">
            <?php echo e($events->links('pagination::bootstrap-5')); ?>

        </div>
    </div>

    <!-- ADD Modal (dynamic rows) -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="<?php echo e(route('admin.coursesched.store')); ?>" method="POST" id="addForm">
                    <?php echo csrf_field(); ?>

                    <div class="modal-header btn-success text-white">
                        <h5 class="modal-title">Add Course Schedule</h5>
                        <!-- X close on top-right -->
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div id="rows_container">
                            <!-- First row index 0 -->
                            <div class="schedule-row" id="row_0">
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Date</label>
                                        <input type="date" name="rows[0][date]" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Langer Schedule</label>
                                        <select name="rows[0][langer_status]" class="form-select"
                                            onchange="checkOther(this)">
                                            <option value="Open">Open</option>
                                            <option value="Close">Close</option>
                                            <option value="Others">Others (Tournament)</option>
                                        </select>
                                        <input type="text" name="rows[0][langer_other]"
                                            class="form-control mt-2 other-input" placeholder="Langer Tournament">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Couples Schedule</label>
                                        <select name="rows[0][couples_status]" class="form-select"
                                            onchange="checkOther(this)">
                                            <option value="Open">Open</option>
                                            <option value="Close">Close</option>
                                            <option value="Others">Others (Tournament)</option>
                                        </select>
                                        <input type="text" name="rows[0][couples_other]"
                                            class="form-control mt-2 other-input" placeholder="Couples Tournament">
                                    </div>

                                    <div class="col-md-1 text-end">
                                        <button type="button" class="btn btn-success symbol-btn"
                                            onclick="addRow()">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header btn-success text-white">
                    <h5 class="mb-0">Edit Course Schedule</h5>
                    <!-- X close on top-right -->
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form action="#" method="POST" id="editForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="modal-body p-3">
                        <input type="hidden" id="edit_id" name="id">

                        <div class="row g-2 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Date</label>
                                <input type="date" name="date" id="edit_date" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Langer Schedule</label>
                                <select name="langer_status" id="edit_langer_status" class="form-select"
                                    onchange="toggleSingleOther(this,'#edit_langer_other')">
                                    <option value="Open">Open</option>
                                    <option value="Close">Close</option>
                                    <option value="Others">Others</option>
                                </select>
                                <input type="text" name="langer_other" id="edit_langer_other"
                                    class="form-control mt-2" placeholder="Langer Tournament" style="display:none;">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Couples Schedule</label>
                                <select name="couples_status" id="edit_couples_status" class="form-select"
                                    onchange="toggleSingleOther(this,'#edit_couples_other')">
                                    <option value="Open">Open</option>
                                    <option value="Close">Close</option>
                                    <option value="Others">Others</option>
                                </select>
                                <input type="text" name="couples_other" id="edit_couples_other"
                                    class="form-control mt-2" placeholder="Couples Tournament" style="display:none;">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- DELETE Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Delete Course Schedule</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="#" method="POST" id="deleteForm">
                    <div class="modal-body ">

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <p>Are you sure you want to delete this schedule?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show success modal if session has 'success' message
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
        let nextIndex = 1;

        function addRow() {
            const container = document.getElementById('rows_container');
            const idx = nextIndex++;
            const row = document.createElement('div');
            row.className = 'schedule-row';
            row.id = 'row_' + idx;
            row.innerHTML = `
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-bold">Date</label>
                <input type="date" name="rows[${idx}][date]" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Langer Schedule</label>
                <select name="rows[${idx}][langer_status]" class="form-select" onchange="checkOther(this)">
                    <option value="Open">Open</option>
                    <option value="Close">Close</option>
                    <option value="Others">Others</option>
                </select>
                <input type="text" name="rows[${idx}][langer_other]" class="form-control mt-2 other-input" placeholder="Langer Tournament" style="display:none;">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Couples Schedule</label>
                <select name="rows[${idx}][couples_status]" class="form-select" onchange="checkOther(this)">
                    <option value="Open">Open</option>
                    <option value="Close">Close</option>
                    <option value="Others">Others</option>
                </select>
                <input type="text" name="rows[${idx}][couples_other]" class="form-control mt-2 other-input" placeholder="Couples Tournament" style="display:none;">
            </div>

            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-danger symbol-btn" onclick="document.getElementById('row_${idx}').remove()">×</button>
            </div>
        </div>
    `;
            container.appendChild(row);
        }

        function checkOther(selectEl) {
            const next = selectEl.nextElementSibling;
            if (!next) return;
            next.style.display = (selectEl.value === 'Others') ? 'block' : 'none';
        }

        function toggleSingleOther(sel, selector) {
            const input = document.querySelector(selector);
            if (!input) return;
            input.style.display = (sel.value === 'Others') ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {

            // Edit modal populate & set form action
            document.querySelectorAll('.editBtn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const date = this.dataset.date;
                    const langerStatus = this.dataset.langerStatus;
                    const langerOther = this.dataset.langerOther ?? '';
                    const couplesStatus = this.dataset.couplesStatus;
                    const couplesOther = this.dataset.couplesOther ?? '';

                    // set action to PUT URL
                    document.getElementById('editForm').action = "/admin/coursesched/" + id +
                        "/update";

                    document.getElementById('edit_date').value = date;

                    const eL = document.getElementById('edit_langer_status');
                    eL.value = langerStatus ?? 'Open';
                    toggleSingleOther(eL, '#edit_langer_other');
                    document.getElementById('edit_langer_other').value = langerOther;

                    const eC = document.getElementById('edit_couples_status');
                    eC.value = couplesStatus ?? 'Open';
                    toggleSingleOther(eC, '#edit_couples_other');
                    document.getElementById('edit_couples_other').value = couplesOther;
                });
            });

            // Delete modal action
            document.querySelectorAll('.deleteBtn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    document.getElementById('deleteForm').action = "/admin/coursesched/" + id +
                        "/delete";
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_coursesched.blade.php ENDPATH**/ ?>
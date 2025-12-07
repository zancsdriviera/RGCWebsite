    
    <?php $__env->startSection('title', 'Lean Season'); ?>

    <?php $__env->startSection('content'); ?>
        <div class="container-fluid px-4 py-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 fw-bold">Golf Rates Lean Season</h3>
            </div>

            <!-- Add Golf Rates Button -->
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle"></i> Add Golf Rates
            </button>

            <!-- Golf Rates Table -->
            <table class="table table-bordered align-middle text-center table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Content Type</th>
                        <th>Title</th>
                        <th>Schedule</th>
                        <th style="width: 250px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $gleans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $glean): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e(ucfirst($glean->type)); ?></td>
                            <td><?php echo e($glean->title1 ?? ($glean->title2 ?? $glean->title3)); ?></td>
                            <td><?php echo e($glean->sched1 ?? $glean->sched2); ?></td>

                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-id="<?php echo e($glean->id); ?>" data-type="<?php echo e($glean->type); ?>"
                                    data-title1="<?php echo e($glean->title1 ?? ''); ?>" data-total1="<?php echo e($glean->total1 ?? ''); ?>"
                                    data-body1="<?php echo e($glean->body1 ?? ''); ?>" data-price1="<?php echo e($glean->price1 ?? ''); ?>"
                                    data-sched1="<?php echo e($glean->sched1 ?? ''); ?>" data-title2="<?php echo e($glean->title2 ?? ''); ?>"
                                    data-paragraph2="<?php echo e($glean->paragraph2 ?? ''); ?>"
                                    data-total2="<?php echo e($glean->total2 ?? ''); ?>" data-body2="<?php echo e($glean->body2 ?? ''); ?>"
                                    data-price2="<?php echo e($glean->price2 ?? ''); ?>" data-sched2="<?php echo e($glean->sched2 ?? ''); ?>"
                                    data-title3="<?php echo e($glean->title3 ?? ''); ?>"
                                    data-paragraph3="<?php echo e($glean->paragraph3 ?? ''); ?>"
                                    data-body3="<?php echo e($glean->body3 ?? ''); ?>" data-price3="<?php echo e($glean->price3 ?? ''); ?>">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>

                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm" onclick="deleteGlean(<?php echo e($glean->id); ?>)">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="table-active">No Golf Rates added yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="<?php echo e(route('admin.glean.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header btn-success text-white">
                            <h5 class="modal-title">Add Golf Rates (Lean Season)</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label fw-bold">Type</label>
                            <select name="type" id="addType" class="form-select mb-3" required>
                                <option value="">Select Content Type</option>
                                <option value="first">First Content (Regular)</option>
                                <option value="second">Second Content (Senior Discount)</option>
                                <option value="third">Third Content (Cart Rental)</option>
                            </select>
                            <div id="addFields"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success"><i class="bi bi-check2-square me-2"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form method="POST" id="editForm">
                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edit Golf Rates (Lean Season)</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="editId">
                            <label>Type</label>
                            <select name="type" id="editType" class="form-select mb-3" required></select>
                            <div id="editFields"></div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success"><i class="bi bi-check2-square me-2"></i>Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteGleanModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form id="deleteGleanForm" method="POST" class="modal-content">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Confirm Delete Golf Rate (Lean Season)</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Golf Rate?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i
                                class="bi bi-check2-square me-2"></i>Confirm</button>
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
                        <?php echo e(session('modal_message')); ?>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
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

            document.addEventListener('DOMContentLoaded', function() {
                const addType = document.getElementById('addType');
                const addFields = document.getElementById('addFields');
                const editModal = document.getElementById('editModal');
                const editForm = document.getElementById('editForm');
                const editId = document.getElementById('editId');
                const editType = document.getElementById('editType');
                const editFields = document.getElementById('editFields');

                function renderFields(type, data = {}) {
                    let html = '';
                    if (type === 'first') {
                        html =
                            `
                    <input type="text" name="title1" value="${data.title1||''}" class="form-control mb-2" placeholder="Title" required>
                    <input type="number" step="0.01" name="total1" value="${data.total1||''}" class="form-control mb-2" placeholder="Total" required>
                    <textarea name="body1" rows="5" class="form-control mb-2" required placeholder="Content (one item per line)">${data.body1||''}</textarea>
                    <textarea name="price1" rows="5" class="form-control mb-2" required placeholder="Price (one per line)">${data.price1||''}</textarea>
                    <input type="text" name="sched1" value="${data.sched1||''}" class="form-control mb-2" placeholder="Schedule" required>`;
                    } else if (type === 'second') {
                        html =
                            `
                    <input type="text" name="title2" value="${data.title2||''}" class="form-control mb-2" placeholder="Title" required>
                    <input type="text" name="paragraph2" value="${data.paragraph2||''}" class="form-control mb-2" placeholder="Paragraph (optional)">
                    <input type="number" step="0.01" name="total2" value="${data.total2||''}" class="form-control mb-2" placeholder="Total" required>
                    <textarea name="body2" rows="5" class="form-control mb-2" required placeholder="Content (one item per line)">${data.body2||''}</textarea>
                    <textarea name="price2" rows="5" class="form-control mb-2" required placeholder="Price (one per line)">${data.price2||''}</textarea>
                    <input type="text" name="sched2" value="${data.sched2||''}" class="form-control mb-2" placeholder="Schedule" required>`;
                    } else if (type === 'third') {
                        html =
                            `
                    <input type="text" name="title3" value="${data.title3||''}" class="form-control mb-2" placeholder="Title" required>
                    <textarea name="body3" rows="5" class="form-control mb-2" required placeholder="Content (one item per line)">${data.body3||''}</textarea>
                    <textarea name="price3" rows="5"class="form-control mb-2" required placeholder="Price (one per line)">${data.price3||''}</textarea>
                    <textarea name="paragraph3" rows="2" class="form-control mb-2" placeholder="Paragraph (optional)">${data.paragraph3||''}</textarea>`;
                    }
                    return html;
                }

                addType.addEventListener('change', function() {
                    addFields.innerHTML = renderFields(this.value);
                });

                editModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    editId.value = id;

                    editType.innerHTML = `
                <option value="first" ${button.getAttribute('data-type')==='first'?'selected':''}>First Content (Regular)</option>
                <option value="second" ${button.getAttribute('data-type')==='second'?'selected':''}>Second Content (Senior Discount)</option>
                <option value="third" ${button.getAttribute('data-type')==='third'?'selected':''}>Third Content (Cart Rental)</option>
            `;

                    const data = {};
                    ['title1', 'total1', 'body1', 'price1', 'sched1', 'title2', 'paragraph2', 'total2', 'body2',
                        'price2', 'sched2', 'title3', 'paragraph3', 'body3', 'price3'
                    ]
                    .forEach(k => data[k] = button.getAttribute('data-' + k) || '');
                    editFields.innerHTML = renderFields(button.getAttribute('data-type'), data);

                    editForm.action = `/admin/glean/${id}/update`;
                });
            });

            function deleteGlean(gleanId) {
                const deleteForm = document.getElementById('deleteGleanForm');
                deleteForm.action = `/admin/glean/${gleanId}/delete`;

                const deleteModal = new bootstrap.Modal(document.getElementById('deleteGleanModal'));
                deleteModal.show();
            }
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_glean.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title', 'Membership'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">

        
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
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
            <div class="card-header">
                <h5>Add New Membership Content</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.membership.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Content Type</label>
                        <select name="type" id="type" class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="download">Download</option>
                            <option value="members_data">Member's Data</option>
                            <option value="bank">Bank</option>
                        </select>
                    </div>

                    <div id="dynamic-fields">
                        
                        <div class="type-download d-none">
                            <label>Download Title</label>
                            <input type="text" name="title" class="form-control mb-3" required>

                            <label>PDF File</label>
                            <input type="file" name="download_file" class="form-control" accept="application/pdf,.pdf"
                                required>
                        </div>

                        
                        <div class="type-members_data d-none">
                            <label>Member's Data Card Image</label>
                            <input type="file" name="members_image" class="form-control mb-2" accept="image/*" required
                                onchange="previewImage(event, '#add_applicant_preview')">
                            <img id="add_applicant_preview" src="#" class="img-thumbnail d-none mb-2" width="200">
                        </div>

                        
                        <div class="type-bank d-none">
                            <label>Bank Logo</label>
                            <input type="file" name="bank_top_image" class="form-control mb-2" accept="image/*" required
                                onchange="previewImage(event, '#add_top_preview')">
                            <img id="add_top_preview" src="#" class="img-thumbnail d-none mb-2" width="100">

                            <label>QR Code</label>
                            <input type="file" name="bank_qr_image" class="form-control mb-2" accept="image/*" required
                                onchange="previewImage(event, '#add_qr_preview')">
                            <img id="add_qr_preview" src="#" class="img-thumbnail d-none mb-2" width="100">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add Content</button>
                </form>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header">
                <h5>Existing Membership Content</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Title / Image</th>
                            <th>Preview</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($content->id); ?></td>
                                <td><?php echo e(ucfirst($content->type)); ?></td>
                                <td>
                                    <?php if($content->type === 'download'): ?>
                                        <?php echo e($content->title); ?>

                                    <?php elseif($content->type === 'members_data'): ?>
                                        Member's Data Card
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($content->file_path): ?>
                                        <?php if(Str::endsWith($content->file_path, ['.pdf'])): ?>
                                            <a href="<?php echo e(asset('storage/' . $content->file_path)); ?>" target="_blank">View
                                                PDF</a>
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('storage/' . $content->file_path)); ?>" width="80">
                                        <?php endif; ?>
                                    <?php elseif($content->type === 'bank'): ?>
                                        <?php if($content->top_image): ?>
                                            <img src="<?php echo e(asset('storage/' . $content->top_image)); ?>" width="50">
                                        <?php endif; ?>
                                        <?php if($content->qr_image): ?>
                                            <img src="<?php echo e(asset('storage/' . $content->qr_image)); ?>" width="50">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-btn" data-id="<?php echo e($content->id); ?>"
                                        data-type="<?php echo e($content->type); ?>" data-title="<?php echo e($content->title ?? ''); ?>"
                                        data-file="<?php echo e($content->file_path ?? ''); ?>"
                                        data-top="<?php echo e($content->top_image ?? ''); ?>"
                                        data-qr="<?php echo e($content->qr_image ?? ''); ?>" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        Edit
                                    </button>

                                    <form action="<?php echo e(route('admin.membership.destroy', $content->id)); ?>" method="POST"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center">No content added yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Content</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label>Type</label>
                            <input type="text" id="edit_type" name="type" class="form-control" readonly>
                        </div>
                        <div id="edit-fields"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const typeSelect = document.getElementById('type');
        const downloadFields = document.querySelector('.type-download');
        const applicantFields = document.querySelector('.type-members_data');
        const bankFields = document.querySelector('.type-bank');

        function toggleRequired(fields, isRequired) {
            fields.querySelectorAll('input').forEach(el => {
                if (isRequired) el.setAttribute('required', true);
                else el.removeAttribute('required');
            });
        }

        typeSelect.addEventListener('change', () => {
            const val = typeSelect.value;
            downloadFields.classList.toggle('d-none', val !== 'download');
            applicantFields.classList.toggle('d-none', val !== 'members_data');
            bankFields.classList.toggle('d-none', val !== 'bank');
            toggleRequired(downloadFields, val === 'download');
            toggleRequired(applicantFields, val === 'members_data');
            toggleRequired(bankFields, val === 'bank');
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const type = btn.dataset.type;
                const modal = document.getElementById('edit-fields');
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_type').value = type;

                let html = '';
                if (type === 'download') {
                    html = `
                <label>Download Title</label>
                <input type="text" name="title" value="${btn.dataset.title || ''}" class="form-control mb-2" required>
                <label>Replace PDF (optional)</label>
                <input type="file" name="file_path" class="form-control" accept=".pdf">
            `;
                } else if (type === 'members_data') {
                    html = `
                <label>Replace Member's Data Image</label>
                <input type="file" name="file_path" class="form-control mb-2" accept="image/*" onchange="previewImage(event, '#edit_applicant_preview')">
                <img id="edit_applicant_preview" src="${btn.dataset.file ? '/storage/' + btn.dataset.file : '#'}" class="img-thumbnail ${btn.dataset.file ? '' : 'd-none'}" width="200">
            `;
                } else if (type === 'bank') {
                    html = `
                <label>Replace Bank Logo</label>
                <input type="file" name="top_image" class="form-control mb-2" accept="image/*" onchange="previewImage(event, '#edit_top_preview')">
                <img id="edit_top_preview" src="${btn.dataset.top ? '/storage/' + btn.dataset.top : '#'}" class="img-thumbnail ${btn.dataset.top ? '' : 'd-none'} mb-2" width="100">

                <label>Replace QR Code</label>
                <input type="file" name="qr_image" class="form-control mb-2" accept="image/*" onchange="previewImage(event, '#edit_qr_preview')">
                <img id="edit_qr_preview" src="${btn.dataset.qr ? '/storage/' + btn.dataset.qr : '#'}" class="img-thumbnail ${btn.dataset.qr ? '' : 'd-none'}" width="100">
            `;
                }

                modal.innerHTML = html;
                document.getElementById('editForm').action = `/admin/membership/${id}`;
            });
        });

        function previewImage(event, selector) {
            const img = document.querySelector(selector);
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_membership.blade.php ENDPATH**/ ?>
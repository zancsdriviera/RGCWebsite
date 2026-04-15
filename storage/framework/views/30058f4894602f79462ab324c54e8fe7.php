
<?php $__env->startSection('title', 'Membership'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Membership</h3>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="m-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($e); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Add New Membership Content</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.membership.store')); ?>" method="POST" enctype="multipart/form-data"
                    id="addForm">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Content Type</label>
                        <select name="type" id="addType" class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="download">Download (PDF · max 3 MB)</option>
                            <option value="members_data">Member's Data (Image · max 5 MB)</option>
                            <option value="bank">Bank (Images · max 5 MB each)</option>
                        </select>
                    </div>

                    
                    <div class="type-fields type-download d-none">
                        <div class="mb-3">
                            <label class="form-label">Document Name</label>
                            <input type="text" name="title" class="form-control">
                            <div class="form-text">Enter a descriptive name for the PDF document</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Document File</label>
                            <input type="file" name="download_file" class="form-control" accept="application/pdf,.pdf"
                                data-file-type="pdf">
                            <div class="form-text">PDF only · max 3 MB</div>
                        </div>
                    </div>

                    
                    <div class="type-fields type-members_data d-none">
                        <div class="mb-3">
                            <label class="form-label">Member's Data Image</label>
                            <input type="file" name="members_image" class="form-control" accept="image/*"
                                data-preview="#add_members_preview" data-file-type="image">
                            <div class="form-text">JPG, PNG, WebP · max 5 MB</div>
                            <img id="add_members_preview" src="#" class="img-thumbnail d-none mt-2" width="200">
                        </div>
                    </div>

                    
                    <div class="type-fields type-bank d-none">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Bank Logo</label>
                                <input type="file" name="bank_top_image" class="form-control" accept="image/*"
                                    data-preview="#add_top_preview" data-file-type="image">
                                <div class="form-text">JPG, PNG, WebP · max 5 MB</div>
                                <img id="add_top_preview" src="#" class="img-thumbnail d-none mt-2" width="100">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">QR Code</label>
                                <input type="file" name="bank_qr_image" class="form-control" accept="image/*"
                                    data-preview="#add_qr_preview" data-file-type="image">
                                <div class="form-text">JPG, PNG, WebP · max 5 MB</div>
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

        
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0">Existing Membership Content</h5>
                <div class="d-flex align-items-center gap-2">
                    <label class="mb-0 small text-muted">Show</label>
                    <select class="form-select form-select-sm" style="width:72px;" id="contentPerPage">
                        <option value="15" selected>15</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="mb-0 small text-muted">entries</label>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped align-middle text-center mb-0" id="contentTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="px-3">ID</th>
                            <th>Type</th>
                            <th>Title / Description</th>
                            <th>Preview</th>
                            <th>File Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($c->id); ?></td>
                                <td>
                                    <span
                                        class="badge
                                    <?php if($c->type === 'download'): ?> bg-info text-dark
                                    <?php elseif($c->type === 'members_data'): ?> bg-warning text-dark
                                    <?php else: ?> bg-success <?php endif; ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $c->type))); ?>

                                    </span>
                                </td>
                                <td class="text-start">
                                    <?php if($c->type === 'download'): ?>
                                        <?php echo e($c->title); ?>

                                    <?php elseif($c->type === 'members_data'): ?>
                                        <em class="text-muted">Member's Data Card</em>
                                    <?php else: ?>
                                        <em class="text-muted">Bank Details</em>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($c->file_path): ?>
                                        <?php if(Str::endsWith($c->file_path, ['.pdf'])): ?>
                                            <a href="<?php echo e(asset('storage/' . $c->file_path)); ?>" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-file-pdf me-1"></i>View PDF
                                            </a>
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('storage/' . $c->file_path)); ?>" class="img-thumbnail"
                                                width="70" alt="Preview">
                                        <?php endif; ?>
                                    <?php elseif($c->type === 'bank'): ?>
                                        <div class="d-flex justify-content-center gap-2">
                                            <?php if($c->top_image): ?>
                                                <img src="<?php echo e(asset('storage/' . $c->top_image)); ?>" class="img-thumbnail"
                                                    width="50" alt="Logo">
                                            <?php endif; ?>
                                            <?php if($c->qr_image): ?>
                                                <img src="<?php echo e(asset('storage/' . $c->qr_image)); ?>" class="img-thumbnail"
                                                    width="50" alt="QR">
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                        $sz = 0;
                                        if ($c->file_path && Storage::disk('public')->exists($c->file_path)) {
                                            $sz = Storage::disk('public')->size($c->file_path);
                                        } elseif ($c->type === 'bank') {
                                            if ($c->top_image && Storage::disk('public')->exists($c->top_image)) {
                                                $sz += Storage::disk('public')->size($c->top_image);
                                            }
                                            if ($c->qr_image && Storage::disk('public')->exists($c->qr_image)) {
                                                $sz += Storage::disk('public')->size($c->qr_image);
                                            }
                                        }
                                    ?>
                                    <?php echo e($sz > 0 ? number_format($sz / 1024, 1) . ' KB' : '—'); ?>

                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary edit-btn" data-id="<?php echo e($c->id); ?>"
                                            data-type="<?php echo e($c->type); ?>" data-title="<?php echo e($c->title ?? ''); ?>"
                                            data-file="<?php echo e($c->file_path ?? ''); ?>" data-top="<?php echo e($c->top_image ?? ''); ?>"
                                            data-qr="<?php echo e($c->qr_image ?? ''); ?>" data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <button class="btn btn-outline-danger delete-btn"
                                            data-url="<?php echo e(route('admin.membership.destroy', $c->id)); ?>"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="py-4 text-muted">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>No content added yet.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-top-0">
                <small class="text-muted" id="contentCountInfo"></small>
            </div>
        </div>

        
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0">Membership Information</h5>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <div class="input-group input-group-sm" style="width:220px;">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" id="appSearch" class="form-control" placeholder="Search name or email...">
                    </div>
                    <label class="mb-0 small text-muted">Show</label>
                    <select class="form-select form-select-sm" style="width:72px;" id="appPerPage">
                        <option value="15" selected>15</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="mb-0 small text-muted">entries</label>
                    <button type="button" class="btn btn-danger btn-sm d-none" id="bulkDeleteBtn">
                        <i class="bi bi-trash me-1"></i>Delete Selected
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <form id="bulkDeleteForm" action="<?php echo e(route('admin.membership.applications.bulkDestroy')); ?>"
                    method="POST">
                    <?php echo csrf_field(); ?>
                    <table class="table table-bordered table-striped align-middle text-center mb-0" id="appTable">
                        <thead class="table-dark">
                            <tr>
                                <th style="width:42px;" class="px-3">
                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                </th>
                                <th>ID</th>
                                <th class="text-start">Full Name</th>
                                <th class="text-start">Email</th>
                                <th>Class</th>
                                <th>Date Submitted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="appTableBody">
                            <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="app-row"
                                    data-name="<?php echo e(strtolower($app->family_name . ' ' . $app->given_name . ' ' . ($app->middle_name ?? ''))); ?>"
                                    data-email="<?php echo e(strtolower($app->email)); ?>">
                                    <td><input type="checkbox" name="ids[]" value="<?php echo e($app->id); ?>"
                                            class="form-check-input app-checkbox"></td>
                                    <td><?php echo e($app->id); ?></td>
                                    <td class="text-start fw-semibold"><?php echo e($app->family_name); ?>,
                                        <?php echo e($app->given_name); ?><?php echo e($app->middle_name ? ' ' . $app->middle_name : ''); ?></td>
                                    <td class="text-start"><?php echo e($app->email); ?></td>
                                    <td>
                                        <span
                                            class="badge
                                        <?php if($app->class_of_membership === 'A'): ?> bg-primary
                                        <?php elseif($app->class_of_membership === 'B'): ?> bg-info text-dark
                                        <?php else: ?> bg-success <?php endif; ?>">
                                            <?php echo e($app->class_of_membership ? '"' . $app->class_of_membership . '" Share' : '—'); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($app->created_at->format('M d, Y  h:i A')); ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-outline-success view-app-btn"
                                                data-id="<?php echo e($app->id); ?>"
                                                data-url="<?php echo e(route('admin.membership.applications.view', $app->id)); ?>">
                                                <i class="bi bi-eye"></i> View
                                            </button>
                                            <button type="button" class="btn btn-outline-danger delete-app-btn"
                                                data-url="<?php echo e(route('admin.membership.applications.destroy', $app->id)); ?>"
                                                data-bs-toggle="modal" data-bs-target="#deleteAppModal">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr id="noAppRow">
                                    <td colspan="7" class="py-4 text-muted">
                                        <i class="bi bi-inbox fs-4 d-block mb-2"></i>No applications yet.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="card-footer bg-white border-top-0">
                <small class="text-muted" id="appCountInfo"></small>
            </div>
        </div>
    </div>

    

    
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Edit Membership Content</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Type</label>
                            <input type="text" id="edit_type" name="type" class="form-control bg-light" readonly>
                            <div class="form-text" id="edit_hint"></div>
                        </div>
                        <div id="editFields"></div>
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

    
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <form id="deleteForm" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Delete Content</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-1">Are you sure you want to delete this item?</p>
                        <p class="text-muted small mb-0">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm"><i
                                class="bi bi-trash me-1"></i>Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="deleteAppModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <form id="deleteAppForm" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Delete Application</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-1">Delete this membership application?</p>
                        <p class="text-muted small mb-0">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm"><i
                                class="bi bi-trash me-1"></i>Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-check-circle me-2"></i>Success</h5>
                </div>
                <div class="modal-body"><?php echo e(session('success')); ?></div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="warningModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill me-2"></i>File Too Large</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="warningMessage" class="mb-0"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="viewAppModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header py-2 px-3" style="background:linear-gradient(135deg,#1b5e20,#2e7d32);">
                    <h5 class="modal-title text-white fs-6">
                        <i class="bi bi-file-person-fill me-2"></i>Membership Application
                    </h5>
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <div class="modal-body p-0" style="background:#f0f2f0;">
                    <div id="viewAppContent" class="p-3">
                        <div class="text-center py-5">
                            <div class="spinner-border text-success" role="status"></div>
                            <p class="mt-3 text-muted">Loading application...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            /* ── Success flash ──────────────────────────────────────────────── */
            <?php if(session('success')): ?>
                const sm = new bootstrap.Modal(document.getElementById('successModal'));
                sm.show();
                setTimeout(() => sm.hide(), 3000);
            <?php endif; ?>

            /* ── File size helpers ──────────────────────────────────────────── */
            const warnModal = new bootstrap.Modal(document.getElementById('warningModal'));
            const warnMsg = document.getElementById('warningMessage');

            function checkSize(file, maxMB, label) {
                if (file.size > maxMB * 1048576) {
                    return {
                        ok: false,
                        msg: `The ${label} "<strong>${file.name}</strong>" is ${(file.size/1048576).toFixed(2)} MB — exceeds the ${maxMB} MB limit.`
                    };
                }
                return {
                    ok: true
                };
            }

            function showWarn(msg) {
                document.querySelectorAll('.modal.show').forEach(m => {
                    if (m.id !== 'warningModal') bootstrap.Modal.getInstance(m)?.hide();
                });
                warnMsg.innerHTML = msg;
                warnModal.show();
            }

            function previewImg(file, sel) {
                const img = document.querySelector(sel);
                if (!img) return;
                const r = new FileReader();
                r.onload = e => {
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                };
                r.readAsDataURL(file);
            }

            function wireFileInput(input, maxMB, label, previewSel = null) {
                if (!input) return;
                const fresh = input.cloneNode(true);
                input.replaceWith(fresh);
                fresh.addEventListener('change', function() {
                    if (!this.files?.length) return;
                    const res = checkSize(this.files[0], maxMB, label);
                    if (!res.ok) {
                        this.value = '';
                        if (previewSel) document.querySelector(previewSel)?.classList.add('d-none');
                        showWarn(res.msg);
                    } else if (previewSel) previewImg(this.files[0], previewSel);
                });
                return fresh;
            }

            /* ── Add Form — type switching ──────────────────────────────────── */
            const addTypeSelect = document.getElementById('addType');
            addTypeSelect.addEventListener('change', function() {
                document.querySelectorAll('.type-fields').forEach(f => {
                    f.classList.add('d-none');
                    f.querySelectorAll('[required]').forEach(i => i.removeAttribute('required'));
                });
                const sel = this.value;
                if (!sel) return;
                const block = document.querySelector(`.type-${sel}`);
                if (!block) return;
                block.classList.remove('d-none');
                block.querySelectorAll('input[type="file"], input[type="text"][name="title"]').forEach(i =>
                    i.setAttribute('required', ''));

                if (sel === 'download') wireFileInput(block.querySelector('[name="download_file"]'), 3,
                    'PDF');
                else if (sel === 'members_data') wireFileInput(block.querySelector(
                    '[name="members_image"]'), 5, 'image', '#add_members_preview');
                else {
                    wireFileInput(block.querySelector('[name="bank_top_image"]'), 5, 'bank logo',
                        '#add_top_preview');
                    wireFileInput(block.querySelector('[name="bank_qr_image"]'), 5, 'QR code',
                        '#add_qr_preview');
                }
            });

            /* ── Content table — show entries ───────────────────────────────── */
            const contentRows = Array.from(document.querySelectorAll('#contentTable tbody tr'));
            document.getElementById('contentPerPage').addEventListener('change', function() {
                const limit = parseInt(this.value);
                contentRows.forEach((r, i) => r.style.display = i < limit ? '' : 'none');
                document.getElementById('contentCountInfo').textContent =
                    `Showing ${Math.min(limit, contentRows.length)} of ${contentRows.length} entries`;
            });
            // init
            (function() {
                const limit = 15;
                contentRows.forEach((r, i) => r.style.display = i < limit ? '' : 'none');
                document.getElementById('contentCountInfo').textContent =
                    `Showing ${Math.min(limit, contentRows.length)} of ${contentRows.length} entries`;
            })();

            /* ── Applications table — show entries + search ─────────────────── */
            const appRows = Array.from(document.querySelectorAll('#appTable .app-row'));
            const appSearch = document.getElementById('appSearch');
            const appPerPage = document.getElementById('appPerPage');
            const appInfo = document.getElementById('appCountInfo');

            function filterApps() {
                const q = appSearch.value.toLowerCase().trim();
                const limit = parseInt(appPerPage.value);
                let shown = 0;
                appRows.forEach(r => {
                    const match = !q || r.dataset.name.includes(q) || r.dataset.email.includes(q);
                    r.style.display = (match && shown < limit) ? (shown++, '') : 'none';
                });
                appInfo.textContent = `Showing ${shown} of ${appRows.length} entries`;
            }
            appSearch.addEventListener('input', filterApps);
            appPerPage.addEventListener('change', filterApps);
            filterApps();

            /* ── Bulk select ────────────────────────────────────────────────── */
            const selectAll = document.getElementById('selectAll');
            const bulkBtn = document.getElementById('bulkDeleteBtn');

            function syncBulk() {
                bulkBtn.classList.toggle('d-none', !document.querySelectorAll('.app-checkbox:checked').length);
            }
            selectAll.addEventListener('change', function() {
                document.querySelectorAll('.app-checkbox').forEach(cb => cb.checked = this.checked);
                syncBulk();
            });
            document.getElementById('appTableBody').addEventListener('change', e => {
                if (e.target.classList.contains('app-checkbox')) syncBulk();
            });
            bulkBtn.addEventListener('click', () => {
                if (confirm('Delete all selected applications? This cannot be undone.'))
                    document.getElementById('bulkDeleteForm').submit();
            });

            /* ── Delete modals ──────────────────────────────────────────────── */
            document.querySelectorAll('.delete-btn').forEach(b =>
                b.addEventListener('click', () => document.getElementById('deleteForm').setAttribute('action', b
                    .dataset.url)));
            document.querySelectorAll('.delete-app-btn').forEach(b =>
                b.addEventListener('click', () => document.getElementById('deleteAppForm').setAttribute(
                    'action', b.dataset.url)));

            /* ── Edit modal ─────────────────────────────────────────────────── */
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const {
                        id,
                        type,
                        title,
                        file,
                        top,
                        qr
                    } = btn.dataset;
                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_type').value = type;
                    document.getElementById('edit_hint').textContent =
                        type === 'download' ? 'PDF only · max 3 MB' : 'Images only · max 5 MB';

                    let html = '';
                    if (type === 'download') {
                        html = `
                <div class="mb-3">
                    <label class="form-label">Document Title</label>
                    <input type="text" name="title" value="${title}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Replace Document File <span class="text-muted small">(optional)</span></label>
                    <input type="file" name="file_path" class="form-control" accept=".pdf" data-file-type="pdf">
                </div>`;
                    } else if (type === 'members_data') {
                        html = `
                <div class="mb-3">
                    ${file ? `<img src="<?php echo e(asset('storage')); ?>/${file}" class="img-thumbnail mb-2" width="180">` : '<p class="text-muted small">No image uploaded</p>'}
                    <label class="form-label">Replace Image <span class="text-muted small">(optional)</span></label>
                    <input type="file" name="file_path" class="form-control" accept="image/*" data-preview="#edit_members_preview" data-file-type="image">
                    <img id="edit_members_preview" src="#" class="img-thumbnail d-none mt-2" width="180">
                </div>`;
                    } else {
                        html = `
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="form-label fw-semibold small">Current Logo</label>
                        ${top ? `<img src="<?php echo e(asset('storage')); ?>/${top}" class="img-thumbnail w-100">` : '<p class="text-muted small">None</p>'}
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold small">Current QR</label>
                        ${qr ? `<img src="<?php echo e(asset('storage')); ?>/${qr}" class="img-thumbnail w-100">` : '<p class="text-muted small">None</p>'}
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">Replace Logo <span class="text-muted small">(opt.)</span></label>
                        <input type="file" name="top_image" class="form-control" accept="image/*" data-preview="#edit_top_prev" data-file-type="image">
                        <img id="edit_top_prev" src="#" class="img-thumbnail d-none mt-2" width="90">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Replace QR <span class="text-muted small">(opt.)</span></label>
                        <input type="file" name="qr_image" class="form-control" accept="image/*" data-preview="#edit_qr_prev" data-file-type="image">
                        <img id="edit_qr_prev" src="#" class="img-thumbnail d-none mt-2" width="90">
                    </div>
                </div>`;
                    }

                    document.getElementById('editFields').innerHTML = html;
                    document.getElementById('editForm').action =
                        `<?php echo e(url('/admin/membership')); ?>/${id}`;

                    setTimeout(() => {
                        const maxMB = type === 'download' ? 3 : 5;
                        document.querySelectorAll('#editModal input[type="file"]').forEach(
                            inp => {
                                wireFileInput(inp, maxMB, type === 'download' ? 'PDF' :
                                    'image', inp.dataset.preview || null);
                            });
                    }, 80);
                });
            });

            /* ── View Application Modal ─────────────────────────────────────── */
            document.querySelectorAll('.view-app-btn').forEach(btn => {
                btn.addEventListener('click', async () => {
                    const id = btn.dataset.id;
                    const url = btn.dataset.url;

                    document.getElementById('viewAppContent').innerHTML = `
                <div class="text-center py-5">
                    <div class="spinner-border text-success"></div>
                    <p class="mt-3 text-muted">Loading...</p>
                </div>`;

                    new bootstrap.Modal(document.getElementById('viewAppModal')).show();

                    try {
                        const res = await fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        const app = await res.json();
                        document.getElementById('viewAppContent').innerHTML = renderAppLetter(
                            app);
                    } catch {
                        document.getElementById('viewAppContent').innerHTML =
                            `<div class="alert alert-danger m-3">Failed to load application data.</div>`;
                    }
                });
            });

            /* ── Render letter HTML for modal ───────────────────────────────── */
            function renderAppLetter(app) {
                const v = x => x || '—';
                const d = s => {
                    try {
                        return s ? new Date(s).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: '2-digit'
                        }) : '—';
                    } catch {
                        return s || '—';
                    }
                };

                const sec = t => `<div class="lms-sec">${t}</div>`;
                const row = cols => `<div class="lms-row">${cols.map(c =>
            `<div class="lms-f" style="flex:${c.flex||1};min-width:${c.min||'100px'};">
                    <div class="lms-lbl">${c.l}</div>
                    <div class="lms-val">${v(c.v)}</div>
                </div>`).join('')}</div>`;

                // Children table
                const kids = (app.children || []).filter(c => c.name);
                const kidsTable = kids.length ?
                    `
            <table class="lms-table"><thead><tr><th>Name of Children</th><th>Date of Birth</th><th>Sex</th><th>Membership Card</th></tr></thead>
            <tbody>${kids.map((c,i)=>`<tr class="${i%2?'':'lms-odd'}"><td>${v(c.name)}</td><td>${d(c.dob)}</td><td>${v(c.sex)}</td><td>${v(c.membership_card)}</td></tr>`).join('')}</tbody></table>` :
                    '';

                // Golf clubs
                const clubs = (app.other_golf_clubs || []).filter(c => c.club);
                const clubsTable = clubs.length ?
                    `
            <table class="lms-table"><thead><tr><th>Membership in other Golf/Sport Clubs</th><th>Handicap</th></tr></thead>
            <tbody>${clubs.map((c,i)=>`<tr class="${i%2?'':'lms-odd'}"><td>${v(c.club)}</td><td>${v(c.handicap)}</td></tr>`).join('')}</tbody></table>` :
                    '';

                // Membership types — only show checked ones
                const types = Array.isArray(app.membership_type) ? app.membership_type : (app.membership_type ? JSON
                    .parse(app.membership_type) : []);
                const allT = ['Purchase of Share', 'Transfer of Share', 'Assignment of Playing Rights',
                    'Change of Corporate Nominee'
                ];
                const checks = allT.map(t => {
                    if (app.class_of_membership === 'C' && t === 'Assignment of Playing Rights') return '';
                    if (!types.includes(t)) return ''; // Only show checked
                    let html =
                        `<span class="lms-check"><span class="lms-box lms-checked">✓</span>${t}</span>`;
                    // Stock cert beneath Transfer of Share
                    if (t === 'Transfer of Share' && app.transfer_of_share_cert) {
                        html +=
                            `<div style="margin-left:22px;margin-top:2px;margin-bottom:4px;font-size:.82rem;"><strong>Stock Certificate No.:</strong> ${app.transfer_of_share_cert}</div>`;
                    }
                    return html;
                }).join('');

                // Photo
                const photo = app.photo_2x2 ?
                    `<img src="/storage/${app.photo_2x2}" style="width:100%;height:100%;object-fit:cover;">` :
                    '2x2<br>IMAGE';

                // Corporate
                let corp = '';
                if (app.class_of_membership === 'C' && app.corp_company_name) {
                    corp = sec('CORPORATE INFORMATION') +
                        '<p style="font-size:.78rem;color:#6b7280;font-style:italic;margin-bottom:10px;">(For Corporate Share only)</p>' +
                        row([{
                            l: 'Name of Company',
                            v: app.corp_company_name,
                            flex: 1
                        }]) +
                        row([{
                            l: 'Corporate Secretary',
                            v: app.corp_secretary,
                            flex: 1
                        }, {
                            l: '',
                            v: '',
                            flex: 1
                        }]) +
                        row([{
                            l: 'Address',
                            v: app.corp_address,
                            flex: 1
                        }]) +
                        row([{
                            l: 'Tel. No.',
                            v: app.corp_tel_no
                        }, {
                            l: 'Fax No.',
                            v: app.corp_fax_no
                        }, {
                            l: 'Nature of Business',
                            v: app.corp_nature_of_business
                        }]) +
                        row([{
                            l: 'Authorized Signatory',
                            v: app.corp_authorized_signatory
                        }, {
                            l: 'Designation',
                            v: app.corp_designation
                        }]);
                }

                // Endorsement
                let endorse = '';
                if (app.endorser1_name || app.endorser2_name) {
                    endorse = sec('ENDORSEMENT') +
                        '<p style="font-size:.78rem;color:#6b7280;font-style:italic;margin-bottom:10px;">(at least one (1) member in good standing)</p>' +
                        `<div style="display:flex;gap:20px;flex-wrap:wrap;">
                    <div style="flex:1;min-width:200px;">
                        ${row([{l:"Member's Name",v:app.endorser1_name,flex:1}])}
                        ${row([{l:'Membership Club No.',v:app.endorser1_club_no,flex:1}])}
                        ${row([{l:'No. of Years Known',v:app.endorser1_years_known,flex:1}])}
                    </div>
                    <div style="flex:1;min-width:200px;">
                        ${row([{l:"Member's Name",v:app.endorser2_name,flex:1}])}
                        ${row([{l:'Membership Club No.',v:app.endorser2_club_no,flex:1}])}
                        ${row([{l:'No. of Years Known',v:app.endorser2_years_known,flex:1}])}
                    </div>
                </div>`;
                }

                return `
        <style>
            .lms-letter{background:#fff;padding:24px 28px;font-family:'Segoe UI',sans-serif;}
            .lms-hdr{background:linear-gradient(135deg,#1b5e20,#2e7d32);padding:14px 20px;display:flex;align-items:center;gap:14px;margin-bottom:18px;}
            .lms-hdr img{height:42px;}
            .lms-hdr-txt{color:#fff;}
            .lms-hdr-txt h3{font-family:Georgia,serif;font-size:1.2rem;font-weight:700;letter-spacing:2px;margin:0;}
            .lms-hdr-txt p{font-size:.75rem;margin:2px 0 0;opacity:.85;letter-spacing:1px;}
            .lms-accent{height:3px;background:linear-gradient(to right,#4caf50,#81c784);margin-bottom:16px;}
            .lms-intro{display:flex;justify-content:space-between;gap:16px;margin-bottom:16px;flex-wrap:wrap;}
            .lms-intro-txt{font-size:.85rem;line-height:1.6;color:#333;max-width:280px;}
            .lms-meta-wrap{display:flex;gap:14px;align-items:flex-start;}
            .lms-log-fields{display:flex;flex-direction:column;gap:8px;min-width:150px;}
            .lms-log{border-bottom:1px solid #9ca3af;padding-bottom:2px;}
            .lms-log-lbl{font-size:.62rem;color:#6b7280;font-weight:700;letter-spacing:.5px;text-transform:uppercase;}
            .lms-log-val{min-height:16px;}
            .lms-photo{width:80px;height:100px;border:1.5px solid #9ca3af;display:flex;align-items:center;justify-content:center;font-size:.65rem;color:#9ca3af;text-align:center;overflow:hidden;background:#f9fafb;border-radius:2px;flex-shrink:0;}
            .lms-sec{background:linear-gradient(to right,#1b5e20,#2e7d32);color:#fff;padding:6px 14px;font-size:.7rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;margin-bottom:12px;margin-top:18px;position:relative;}
            .lms-sec::after{content:'';position:absolute;right:0;top:0;height:100%;width:7px;background:#81c784;}
            .lms-row{display:flex;gap:16px;margin-bottom:11px;flex-wrap:wrap;}
            .lms-f{flex:1;min-width:100px;}
            .lms-lbl{font-size:.67rem;font-weight:700;color:#374151;letter-spacing:.3px;text-transform:uppercase;margin-bottom:2px;}
            .lms-val{font-size:.85rem;color:#111;border-bottom:1px solid #d1d5db;min-height:20px;padding-bottom:2px;}
            .lms-table{width:100%;border-collapse:collapse;margin-bottom:12px;font-size:.82rem;}
            .lms-table thead tr{background:linear-gradient(to right,#1b5e20,#2e7d32);color:#fff;}
            .lms-table thead th{padding:7px 10px;text-align:center;font-weight:700;}
            .lms-table tbody td{padding:6px 10px;text-align:center;border-bottom:1px solid #e5e7eb;}
            .lms-odd{background:#e8f5e9;}
            .lms-checks{display:flex;flex-wrap:wrap;gap:8px 24px;margin-bottom:10px;}
            .lms-check{display:flex;align-items:center;gap:6px;font-size:.83rem;color:#374151;}
            .lms-box{width:13px;height:13px;border:1.5px solid #6b7280;border-radius:2px;display:inline-flex;align-items:center;justify-content:center;font-size:9px;flex-shrink:0;}
            .lms-checked{background:#1b5e20;border-color:#1b5e20;color:#fff;}
            .lms-decl{font-size:.78rem;line-height:1.7;color:#444;text-align:justify;margin-top:14px;border-top:1px solid #e5e7eb;padding-top:12px;}
            .lms-sig{text-align:right;margin-top:28px;}
            .lms-sig-line{display:inline-block;border-top:1.5px solid #374151;width:190px;margin-bottom:4px;}
            .lms-sig-name{font-size:.82rem;font-weight:700;margin:0;color:#111;}
            .lms-sig-sub{font-size:.72rem;color:#6b7280;}
        </style>
        <div class="lms-letter">
            <div class="lms-hdr">
                <img src="<?php echo e(asset('images/RivieraFooterLogo.png')); ?>" alt="Logo">
                <div class="lms-hdr-txt">
                    <h3>RIVIERA GOLF CLUB</h3>
                    <p>SILANG CAVITE, PHILIPPINES</p>
                </div>
            </div>
            <div class="lms-accent"></div>

            <div class="lms-intro">
                <div class="lms-intro-txt"><strong>Gentlemen:</strong><br>Pursuant to my membership application, I am pleased to give you the following information:</div>
                <div class="lms-meta-wrap">
                    <div class="lms-log-fields">
                        ${['Alpha Log Number','Chrono Log Number','Date Screened'].map(l=>`<div class="lms-log"><div class="lms-log-lbl">${l}</div><div class="lms-log-val">&nbsp;</div></div>`).join('')}
                    </div>
                    <div class="lms-photo">${photo}</div>
                </div>
            </div>

            ${sec('PERSONAL INFORMATION')}
            ${row([{l:'Full Name (Family)',v:app.family_name},{l:'Given Name',v:app.given_name},{l:'Middle Name',v:app.middle_name}])}
            ${row([{l:'Address',v:app.address,flex:3}])}
            ${row([{l:'Billing (Local Address)',v:app.billing_address,flex:3}])}
            ${row([{l:'Cell No.',v:app.cell_no},{l:'Email',v:app.email,flex:1.5},{l:'Tel No.',v:app.tel_no}])}
            ${row([{l:'Date of Birth',v:d(app.date_of_birth)},{l:'Place of Birth',v:app.place_of_birth}])}
            ${row([{l:'Nationality',v:app.nationality},{l:'Sex',v:app.sex},{l:'Civil Status',v:app.civil_status}])}
            ${row([{l:'Passport / Identity Card No.',v:app.passport_id_no},{l:'TIN',v:app.tin}])}
            ${row([{l:'College / Universities Attended',v:app.college_university,flex:3}])}
            ${row([{l:'Degree Obtained',v:app.degree_obtained,flex:3}])}

            ${sec('EMPLOYMENT / BUSINESS INFORMATION')}
            ${row([{l:'Company Name',v:app.company_name,flex:2},{l:'Job Title',v:app.job_title}])}
            ${row([{l:'Company Address',v:app.company_address,flex:3}])}
            ${row([{l:'Type of Business',v:app.type_of_business,flex:3}])}
            ${row([{l:'Business Tel. No.',v:app.business_tel_no},{l:'Business Fax No.',v:app.business_fax_no}])}

            ${sec('FAMILY INFORMATION')}
            ${row([{l:'Spouse Name',v:app.spouse_name,flex:3}])}
            ${row([{l:'Date of Birth',v:d(app.spouse_dob)},{l:'Place of Birth',v:app.spouse_place_of_birth},{l:'Nationality',v:app.spouse_nationality}])}
            ${row([{l:'Company Name',v:app.spouse_company_name,flex:2},{l:'Job Title',v:app.spouse_job_title}])}
            ${row([{l:'Company Address',v:app.spouse_company_address,flex:3}])}
            ${row([{l:'Type of Business',v:app.spouse_type_of_business,flex:3}])}
            ${row([{l:'Business Tel. No.',v:app.spouse_business_tel_no},{l:'Business Fax No.',v:app.spouse_business_fax_no}])}
            ${row([{l:'Spouse to receive Membership Card',v:app.spouse_membership_card,flex:3}])}
            ${kidsTable}
            ${clubsTable}

            <div class="lms-lbl mt-2">Class of Membership: <strong>${app.class_of_membership?'"'+app.class_of_membership+'" Share':'—'}</strong></div>
            <div class="lms-checks mt-2">${checks}</div>
            ${row([{l:'Preferred Mailing and Billing Address',v:app.preferred_billing_address,flex:3}])}
            <p style="font-size:.76rem;color:#555;border-left:3px solid #81c784;padding-left:8px;margin-top:6px;"><strong>NOTE:</strong> For corporate "C" shares, the billing statements, Club Newsletters, and other social information will be mailed to the corporation's corporate address.</p>

            ${corp}

            <hr style="border:none;border-top:2px solid #e5e7eb;margin:20px 0;">
            <div class="lms-sec">9. DATA PRIVACY STATEMENT</div>
            <div style="font-size:.85rem;line-height:1.85;color:#111;text-align:justify;margin-bottom:16px;">
                <p style="margin-bottom:10px;">Riviera Golf Club, Inc. respects and values your right to privacy. In compliance with the Data Privacy Act of 2012 (RA 10173), the personal information and documents you provide in connection with your membership shall be collected, processed, and stored solely for legitimate purposes of the Club, including membership validation, billing, and compliance with legal and regulatory requirements.</p>
                <p style="margin-bottom:10px;">Your information will be kept confidential and secure, and will only be accessed by authorized Club personnel. It will not be shared with third parties without your consent, unless required by law or the Club's By-Laws.</p>
                <p style="margin-bottom:20px;">By signing this form, you acknowledge that you have read and understood this statement and that you consent to the collection, use, and processing of your personal data in accordance with Club policies and applicable laws.</p>
                <div style="display:flex;gap:40px;align-items:flex-end;margin-top:24px;">
                    <div style="flex:2;"><div class="lms-val" style="min-height:28px;">&nbsp;</div><div class="lms-lbl" style="text-align:center;margin-top:4px;">Member/Applicant's Signature</div></div>
                    <div style="flex:1;"><div class="lms-val" style="min-height:28px;">&nbsp;</div><div class="lms-lbl" style="text-align:center;margin-top:4px;">Date</div></div>
                </div>
            </div>
            <hr style="border:none;border-top:2px solid #e5e7eb;margin:20px 0;">

            ${endorse}

            <p class="lms-decl">I, the undersigned, hereby declare that all the particulars given are true to my knowledge and belief. I agree to subject myself to the policies governing the acceptance of my membership to Riviera Golf Club, Inc. I am fully aware that the approval of my application carries the privileges of an exclusive club with all its appurtenant rules and regulations and Club's By-Laws. This includes the payment of monthly dues and other assessments that the Club may impose from time to time.</p>

            <div class="lms-sig">
                <div class="lms-sig-line"></div>
                <p class="lms-sig-name">Applicant for Membership</p>
                <span class="lms-sig-sub">Signature over Printed Name</span>
            </div>
        </div>`;
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_membership.blade.php ENDPATH**/ ?>
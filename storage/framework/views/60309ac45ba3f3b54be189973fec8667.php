

<?php $__env->startSection('title', 'Manage FAQs'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">FAQ Management</h1>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus me-2"></i> Add New FAQ
            </button>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <strong><?php echo e($faq->question); ?></strong>
                                        <p class="text-muted mb-0 small"><?php echo e(Str::limit($faq->answer, 100)); ?></p>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <?php echo e($faq->category); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo e($faq->is_active ? 'bg-success' : 'bg-secondary'); ?>">
                                            <?php echo e($faq->is_active ? 'Active' : 'Inactive'); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary edit-faq"
                                                data-faq='<?php echo json_encode($faq, 15, 512) ?>'>
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success toggle-status"
                                                data-id="<?php echo e($faq->id); ?>">
                                                <i class="fas <?php echo e($faq->is_active ? 'fa-toggle-on' : 'fa-toggle-off'); ?>"></i>
                                            </button>
                                            <form action="<?php echo e(route('admin.faq.delete', $faq->id)); ?>" method="POST"
                                                class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Delete this FAQ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal - Add icon upload field -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?php echo e(route('admin.faq.create')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New FAQ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category *</label>
                            <input type="text" name="category" class="form-control" required list="categorySuggestions"
                                placeholder="Enter category name">
                            <datalist id="categorySuggestions">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </datalist>
                            <small class="text-muted">Type new category or select from existing</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category Icon</label>
                            <input type="file" name="icon" class="form-control" accept="image/*">
                            <small class="text-muted">Upload PNG, JPG, SVG or GIF icon (max 2MB)</small>
                            <div class="mt-2">
                                <small>Recommended: 64x64px transparent PNG</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Question *</label>
                            <input type="text" name="question" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Answer *</label>
                            <textarea name="answer" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Create FAQ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal - Add icon preview and upload -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit FAQ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category *</label>
                            <input type="text" name="category" class="form-control" required
                                list="categorySuggestionsEdit">
                            <datalist id="categorySuggestionsEdit">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </datalist>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category Icon</label>

                            <!-- Current Icon Preview -->
                            <div id="currentIconPreview" class="mb-2 text-center">
                                <!-- Will be populated by JavaScript -->
                            </div>

                            <input type="file" name="icon" class="form-control" accept="image/*"
                                onchange="previewIcon(this, 'newIconPreview')">

                            <!-- New Icon Preview -->
                            <div id="newIconPreview" class="mt-2 text-center" style="display: none;">
                                <p class="small mb-1">New Icon Preview:</p>
                                <img id="newIconImg" src="#" alt="New Icon Preview"
                                    style="max-width: 64px; max-height: 64px; display: none;">
                            </div>

                            <small class="text-muted">Leave empty to keep current icon</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Question *</label>
                            <input type="text" name="question" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Answer *</label>
                            <textarea name="answer" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input">
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update FAQ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit button click
            document.querySelectorAll('.edit-faq').forEach(button => {
                button.addEventListener('click', function() {
                    const faq = JSON.parse(this.dataset.faq);
                    const form = document.getElementById('editForm');
                    const modal = new bootstrap.Modal(document.getElementById('editModal'));

                    form.action = `/admin/faq/update/${faq.id}`;
                    form.querySelector('[name="category"]').value = faq.category;
                    form.querySelector('[name="question"]').value = faq.question;
                    form.querySelector('[name="answer"]').value = faq.answer;
                    form.querySelector('[name="is_active"]').checked = faq.is_active;

                    // Show current icon if exists
                    const previewDiv = document.getElementById('currentIconPreview');
                    previewDiv.innerHTML = '';

                    if (faq.icon) {
                        previewDiv.innerHTML = `
                    <p class="small mb-1">Current Icon:</p>
                    <img src="/storage/faq-icons/${faq.icon}" alt="Current Icon" 
                         style="max-width: 64px; max-height: 64px;">
                `;
                    } else {
                        previewDiv.innerHTML = '<p class="text-muted small">No icon uploaded</p>';
                    }

                    // Hide new icon preview
                    document.getElementById('newIconPreview').style.display = 'none';
                    document.getElementById('newIconImg').style.display = 'none';

                    modal.show();
                });
            });
        });

        // Preview uploaded icon
        function previewIcon(input, previewId) {
            const previewDiv = document.getElementById(previewId);
            const img = document.getElementById('newIconImg');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                    img.style.display = 'block';
                    previewDiv.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                img.style.display = 'none';
                previewDiv.style.display = 'none';
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_faq.blade.php ENDPATH**/ ?>
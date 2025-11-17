
<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Homepage</h3>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.homepage.update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row gy-4">

                
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 1–3 (Main Banners)</h5>
                            <div class="row g-4">
                                <?php for($i = 1; $i <= 3; $i++): ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Image <?php echo e($i); ?></label>
                                            
                                            <img id="carousel<?php echo e($i); ?>Preview"
                                                src="<?php echo e($homepage->{'carousel' . $i} ? asset('storage/' . $homepage->{'carousel' . $i}) : ''); ?>"
                                                class="img-fluid rounded mb-3 shadow-sm" alt="Carousel <?php echo e($i); ?>"
                                                style="max-height:180px; object-fit:cover; <?php echo e($homepage->{'carousel' . $i} ? '' : 'display:none;'); ?>">
                                            <input type="file" name="carousel<?php echo e($i); ?>"
                                                class="form-control mb-3" data-preview="carousel<?php echo e($i); ?>Preview"
                                                <?php echo e($homepage->{'carousel' . $i} ? '' : 'required'); ?>>
                                            <label class="fw-semibold">Caption <?php echo e($i); ?></label>
                                            <input type="text" name="carousel<?php echo e($i); ?>Caption"
                                                class="form-control" value="<?php echo e($homepage->{'carousel' . $i . 'Caption'}); ?>"
                                                required>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Carousel 4–5 (Course Descriptions)</h5>
                            <div class="row g-4">
                                <?php for($i = 4; $i <= 5; $i++): ?>
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <label class="fw-semibold d-block mb-2">Image <?php echo e($i); ?></label>
                                            <img id="carousel<?php echo e($i); ?>Preview"
                                                src="<?php echo e($homepage->{'carousel' . $i} ? asset('storage/' . $homepage->{'carousel' . $i}) : ''); ?>"
                                                class="img-fluid rounded shadow-sm" alt="Carousel <?php echo e($i); ?>"
                                                style="max-height:180px; object-fit:cover; <?php echo e($homepage->{'carousel' . $i} ? '' : 'display:none;'); ?>">
                                            <input type="file" name="carousel<?php echo e($i); ?>"
                                                class="form-control mb-3" data-preview="carousel<?php echo e($i); ?>Preview"
                                                <?php echo e($homepage->{'carousel' . $i} ? '' : 'required'); ?>>
                                            <label class="fw-semibold">Description (Paragraph <?php echo e($i); ?>)</label>
                                            <textarea name="carousel<?php echo e($i); ?>Caption" class="form-control" rows="4" required
                                                placeholder="Enter description for Carousel <?php echo e($i); ?>"><?php echo e($homepage->{'carousel' . $i . 'Caption'} ?? ''); ?></textarea>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Headline & Subheadline</h5>
                        <label class="fw-semibold">Headline</label>
                        <input type="text" name="headline" class="form-control mb-3" required
                            value="<?php echo e($homepage->headline); ?>">
                        <label class="fw-semibold">Subheadline</label>
                        <textarea name="subheadline" class="form-control" rows="2" required><?php echo e($homepage->subheadline); ?></textarea>
                    </div>
                </div>
            </div>

            
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Homepage Cards</h5>
                        <div class="row g-4">
                            <?php for($i = 1; $i <= 3; $i++): ?>
                                <div class="col-md-4">
                                    <div class="border rounded p-3 h-100">
                                        <label class="fw-semibold d-block mb-2">Card <?php echo e($i); ?></label>
                                        <img id="card<?php echo e($i); ?>Preview"
                                            src="<?php echo e($homepage->{'card' . $i . '_image'} ? asset('storage/' . $homepage->{'card' . $i . '_image'}) : ''); ?>"
                                            class="img-fluid rounded mb-3 shadow-sm" alt="Card <?php echo e($i); ?>"
                                            style="max-height:160px; object-fit:cover; <?php echo e($homepage->{'card' . $i . '_image'} ? '' : 'display:none;'); ?>">
                                        <input type="file" name="card<?php echo e($i); ?>_image"
                                            class="form-control mb-3" data-preview="card<?php echo e($i); ?>Preview"
                                            <?php echo e($homepage->{'card' . $i . '_image'} ? '' : 'required'); ?>>
                                        <label class="fw-semibold">Card <?php echo e($i); ?> Title</label>
                                        <input type="text" name="card<?php echo e($i); ?>_title" class="form-control"
                                            value="<?php echo e($homepage->{'card' . $i . '_title'}); ?>" required>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 text-end mt-3">
                <button type="submit" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-save me-2"></i>Save Changes
                </button>
            </div>
        </form>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[type="file"]').forEach(input => {
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (!file) return;

                    const previewId = e.target.getAttribute('data-preview');
                    if (!previewId) return;

                    const preview = document.getElementById(previewId);
                    if (!preview) return;

                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                    preview.onload = () => URL.revokeObjectURL(preview.src);
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_homepage.blade.php ENDPATH**/ ?>
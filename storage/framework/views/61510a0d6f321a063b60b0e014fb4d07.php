
<?php $__env->startSection('title', 'Courses Page Editor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Courses Page Elements</h5>

                <style>
                    .course-card {
                        background: #fff;
                        border: 1px solid #e9ecef;
                        border-radius: .5rem;
                        overflow: hidden;
                        transition: all .2s ease-in-out;
                    }

                    .course-image img {
                        width: 100%;
                        height: 220px;
                        object-fit: cover;
                        display: block;
                    }

                    .accordion-button:focus {
                        box-shadow: none;
                    }

                    .field-label {
                        font-weight: 600;
                        font-size: .9rem;
                        margin-bottom: .3rem;
                        color: #495057;
                    }
                </style>

                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <div class="course-card mb-3 shadow-sm">
                            <div class="course-image">
                                <img id="preview_langer" loading="lazy"
                                    src="<?php echo e(asset('storage/content_images' . ($contents['courses_card1_image']->value ?? 'images/placeholder.png'))); ?>"
                                    alt="Langer Image">
                            </div>
                            <div class="card-body">
                                <h5 class="text-center fw-bold mb-3">Langer Course</h5>
                                <form method="POST" action="<?php echo e(route('admin.update', 'courses_card1_image')); ?>"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <label class="field-label">Course Image</label>
                                    <input type="file" name="value" class="form-control form-control-sm"
                                        accept="image/*" onchange="previewImage(event,'preview_langer')">
                                    <button class="btn btn-primary btn-sm mt-2">Upload</button>
                                </form>

                                <form method="POST" action="<?php echo e(route('admin.update', 'courses_card1_title')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <label class="field-label">Course Title</label>
                                    <textarea name="value" rows="2" class="form-control"><?php echo e($contents['courses_card1_title']->value ?? ''); ?></textarea>
                                    <button class="btn btn-success btn-sm mt-2">Save</button>
                                </form>

                                <form method="POST" action="<?php echo e(route('admin.update', 'courses_card1_description')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <label class="field-label">Course Description</label>
                                    <textarea name="value" rows="3" class="form-control"><?php echo e($contents['courses_card1_description']->value ?? ''); ?></textarea>
                                    <button class="btn btn-success btn-sm mt-2">Save</button>
                                </form>
                            </div>
                        </div>

                        
                        <div class="accordion" id="langerAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#langerGallery">
                                        Langer Gallery & Meta
                                    </button>
                                </h2>
                                <div id="langerGallery" class="accordion-collapse collapse"
                                    data-bs-parent="#langerAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="<?php echo e(route('admin.langer.update')); ?>"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="row g-3">
                                                <?php for($i = 1; $i <= 6; $i++): ?>
                                                    <?php $col = 'image'.$i; ?>
                                                    <div class="col-6">
                                                        <label class="field-label">Image <?php echo e($i); ?></label>
                                                        <img id="langer_preview_<?php echo e($i); ?>" loading="lazy"
                                                            src="<?php echo e($langer->$col ? asset('storage/contentcontent_images' . $langer->$col) : asset('images/placeholder.png')); ?>"
                                                            class="img-fluid rounded mb-1"
                                                            style="height:100px;object-fit:cover;">
                                                        <input type="file" name="image<?php echo e($i); ?>"
                                                            class="form-control form-control-sm" accept="image/*"
                                                            onchange="previewImage(event,'langer_preview_<?php echo e($i); ?>')">
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="mt-3">
                                                <label class="field-label">Gallery Title</label>
                                                <input type="text" name="title" value="<?php echo e($langer->title ?? ''); ?>"
                                                    class="form-control mb-2">
                                                <label class="field-label">Gallery Description</label>
                                                <textarea name="description" rows="3" class="form-control"><?php echo e($langer->description ?? ''); ?></textarea>
                                            </div>
                                            <div class="mt-3 text-end">
                                                <button class="btn btn-success btn-sm">Save All</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="course-card mb-3 shadow-sm">
                            <div class="course-image">
                                <img id="preview_couples" loading="lazy"
                                    src="<?php echo e(asset('storage/' . ($contents['courses_card2_image']->value ?? 'images/placeholder.png'))); ?>"
                                    alt="Couples Image">
                            </div>
                            <div class="card-body">
                                <h5 class="text-center fw-bold mb-3">Couples Course</h5>
                                <form method="POST" action="<?php echo e(route('admin.update', 'courses_card2_image')); ?>"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <label class="field-label">Course Image</label>
                                    <input type="file" name="value" class="form-control form-control-sm"
                                        accept="image/*" onchange="previewImage(event,'preview_couples')">
                                    <button class="btn btn-primary btn-sm mt-2">Upload</button>
                                </form>

                                <form method="POST" action="<?php echo e(route('admin.update', 'courses_card2_title')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <label class="field-label">Course Title</label>
                                    <textarea name="value" rows="2" class="form-control"><?php echo e($contents['courses_card2_title']->value ?? ''); ?></textarea>
                                    <button class="btn btn-success btn-sm mt-2">Save</button>
                                </form>

                                <form method="POST" action="<?php echo e(route('admin.update', 'courses_card2_description')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <label class="field-label">Course Description</label>
                                    <textarea name="value" rows="3" class="form-control"><?php echo e($contents['courses_card2_description']->value ?? ''); ?></textarea>
                                    <button class="btn btn-success btn-sm mt-2">Save</button>
                                </form>
                            </div>
                        </div>

                        
                        <div class="accordion" id="couplesAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#couplesGallery">
                                        Couples Gallery & Meta
                                    </button>
                                </h2>
                                <div id="couplesGallery" class="accordion-collapse collapse"
                                    data-bs-parent="#couplesAccordion">
                                    <div class="accordion-body">
                                        <form method="POST" action="<?php echo e(route('admin.couples.update')); ?>"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="row g-3">
                                                <?php for($i = 1; $i <= 6; $i++): ?>
                                                    <?php $col = 'image'.$i; ?>
                                                    <div class="col-6">
                                                        <label class="field-label">Image <?php echo e($i); ?></label>
                                                        <img id="couples_preview_<?php echo e($i); ?>" loading="lazy"
                                                            src="<?php echo e($couples->$col ? asset('storage/' . $couples->$col) : asset('images/placeholder.png')); ?>"
                                                            class="img-fluid rounded mb-1"
                                                            style="height:100px;object-fit:cover;">
                                                        <input type="file" name="couples_image<?php echo e($i); ?>"
                                                            class="form-control form-control-sm" accept="image/*"
                                                            onchange="previewImage(event,'couples_preview_<?php echo e($i); ?>')">
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="mt-3">
                                                <label class="field-label">Gallery Title</label>
                                                <input type="text" name="title" value="<?php echo e($couples->title ?? ''); ?>"
                                                    class="form-control mb-2">
                                                <label class="field-label">Gallery Description</label>
                                                <textarea name="description" rows="3" class="form-control"><?php echo e($couples->description ?? ''); ?></textarea>
                                            </div>
                                            <div class="mt-3 text-end">
                                                <button class="btn btn-success btn-sm">Save All</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        function previewImage(event, previewId) {
            const input = event.target;
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(input.files[0]);
            }
        }
        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", function(e) {
                const input = form.querySelector("[name='value']");
                if (input) {
                    if (input.type === "file" && input.files.length === 0) {
                        e.preventDefault();
                        alert("Please select an image before uploading.");
                    } else if (input.tagName === "TEXTAREA" && input.value.trim() === "") {
                        e.preventDefault();
                        alert("Please fill in the text field before saving.");
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views\admin1\admin_courses.blade.php ENDPATH**/ ?>
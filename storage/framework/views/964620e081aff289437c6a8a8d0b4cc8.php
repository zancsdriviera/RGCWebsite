
<?php $__env->startSection('title', 'Courses'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .fixed-image-container {
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            background-color: #f8f9fa;
            margin-bottom: 0.5rem;
        }

        .fixed-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .parent-image-container {
            width: 200px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            background-color: #f8f9fa;
            margin-bottom: 0.5rem;
        }

        .parent-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-size-info {
            font-size: 12px;
            color: #6c757d;
            margin-top: 4px;
        }
    </style>

    <div class="container-fluid px-4 py-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 fw-bold">Courses</h3>
            <?php if($courses->isEmpty()): ?>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add New Course</button>
            <?php endif; ?>
        </div>

        <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-dark text-white d-flex justify-content-end align-items-center">
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#deleteCourseModal<?php echo e($course->id); ?>">
                        <i class="bi bi-trash me-1"></i>Delete Courses
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Langer Column -->
                        <div class="col-md-6 border-end">
                            <h5 class="fw-bold">Langer Course</h5>
                            <form action="<?php echo e(route('admin.courses.update', $course->id)); ?>" method="POST"
                                enctype="multipart/form-data" id="langerUpdateForm<?php echo e($course->id); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <label class="fw-semibold">Parent Title</label>
                                <input type="text" name="langer_Mtitle" class="form-control mb-2"
                                    value="<?php echo e($course->langer_Mtitle); ?>" required>

                                <label>Parent Main Image</label>
                                <?php if($course->langer_Mimage): ?>
                                    <div class="parent-image-container mb-2">
                                        <img src="<?php echo e(asset('storage/' . $course->langer_Mimage)); ?>" alt="Parent image">
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="langer_Mimage" class="form-control mb-3" accept="image/*"
                                    data-max-size="3072" required>
                                <div class="file-size-info">Maximum file size: 3MB</div>

                                <label class="fw-semibold">Child Title</label>
                                <input type="text" name="langer_title" class="form-control mb-2"
                                    value="<?php echo e($course->langer_title); ?>" required>

                                <label>Description</label>
                                <textarea name="langer_description" class="form-control mb-2" rows="3" required><?php echo e($course->langer_description); ?></textarea>
                                <button type="submit" class="btn btn-primary btn-sm mb-3">Update Langer Details</button>
                            </form>

                            <!-- Langer Gallery Images Section -->
                            <div class="mt-4">
                                <label class="fw-bold">Gallery Images</label>
                                <div class="d-flex flex-wrap mb-2">
                                    <?php if($course->langer_images): ?>
                                        <?php $__currentLoopData = $course->langer_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <form
                                                action="<?php echo e(route('admin.courses.update_image', [$course->id, 'langer', $index])); ?>"
                                                method="POST" enctype="multipart/form-data" class="card m-1 p-2"
                                                style="width:170px;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="fixed-image-container">
                                                    <img src="<?php echo e(asset('storage/' . $img['image'])); ?>" alt="Gallery image">
                                                </div>

                                                <!-- Hole # with label on left -->
                                                <div class="d-flex align-items-center mb-1">
                                                    <label class="small text-muted me-2" style="width: 50px;">Hole
                                                        #:</label>
                                                    <input type="number" name="hole" value="<?php echo e($img['hole']); ?>"
                                                        class="form-control form-control-sm" placeholder="#"
                                                        style="width: 100px; text-align:center;" required>
                                                </div>

                                                <!-- Update Image with label on left -->
                                                <div class="mb-1">
                                                    <label class="small text-muted d-block mb-1">Update Image:</label>
                                                    <input type="file" name="image"
                                                        class="form-control form-control-sm" accept="image/*"
                                                        data-max-size="3072" required>
                                                    <div class="file-size-info">Max: 3MB</div>
                                                </div>

                                                <button type="submit" class="btn btn-outline-primary btn-sm mb-1 w-100"><i
                                                        class="bi bi-arrow-repeat me-1"></i>Update</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm w-100"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteImageModal<?php echo e($course->id); ?>_langer_<?php echo e($index); ?>">
                                                    <i class="bi bi-trash me-1"></i>Delete
                                                </button>
                                            </form>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <!-- New images input -->
                                <form action="<?php echo e(route('admin.courses.add_image', [$course->id, 'langer'])); ?>"
                                    method="POST" enctype="multipart/form-data" class="mt-2"
                                    id="langerAddForm<?php echo e($course->id); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <label class="small text-muted me-2" style="width: 120px;">Select
                                                Images:</label>
                                            <input type="file" name="images[]" class="form-control" multiple
                                                accept="image/*" data-max-size="3072" required>
                                        </div>
                                        <div class="file-size-info">Maximum file size per image: 3MB</div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm w-100">Add Images</button>
                                </form>
                            </div>
                        </div>

                        <!-- Couples Column -->
                        <div class="col-md-6 ps-4">
                            <h5 class="fw-bold">Couples Course</h5>
                            <form action="<?php echo e(route('admin.courses.update', $course->id)); ?>" method="POST"
                                enctype="multipart/form-data" id="couplesUpdateForm<?php echo e($course->id); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <label class="fw-semibold">Parent Title</label>
                                <input type="text" name="couples_Mtitle" class="form-control mb-2"
                                    value="<?php echo e($course->couples_Mtitle); ?>" required>

                                <label>Parent Main Image</label>
                                <?php if($course->couples_Mimage): ?>
                                    <div class="parent-image-container mb-2">
                                        <img src="<?php echo e(asset('storage/' . $course->couples_Mimage)); ?>" alt="Parent image">
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="couples_Mimage" class="form-control mb-3" accept="image/*"
                                    data-max-size="3072" required>
                                <div class="file-size-info">Maximum file size: 3MB</div>

                                <label class="fw-semibold">Child Title</label>
                                <input type="text" name="couples_title" class="form-control mb-2"
                                    value="<?php echo e($course->couples_title); ?>" required>

                                <label>Description</label>
                                <textarea name="couples_description" class="form-control mb-2" rows="3" required><?php echo e($course->couples_description); ?></textarea>
                                <button type="submit" class="btn btn-primary btn-sm mb-3">Update Couples Details</button>
                            </form>

                            <!-- Couples Gallery Images Section -->
                            <div class="mt-4">
                                <label class="fw-bold">Gallery Images</label>
                                <div class="d-flex flex-wrap mb-2">
                                    <?php if($course->couples_images): ?>
                                        <?php $__currentLoopData = $course->couples_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <form
                                                action="<?php echo e(route('admin.courses.update_image', [$course->id, 'couples', $index])); ?>"
                                                method="POST" enctype="multipart/form-data" class="card m-1 p-2"
                                                style="width:170px;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="fixed-image-container">
                                                    <img src="<?php echo e(asset('storage/' . $img['image'])); ?>"
                                                        alt="Gallery image">
                                                </div>

                                                <!-- Hole # with label on left -->
                                                <div class="d-flex align-items-center mb-1">
                                                    <label class="small text-muted me-2" style="width: 50px;">Hole
                                                        #:</label>
                                                    <input type="number" name="hole" value="<?php echo e($img['hole']); ?>"
                                                        class="form-control form-control-sm" placeholder="#"
                                                        style="width: 100px; text-align:center;" required>
                                                </div>

                                                <!-- Update Image with label on left -->
                                                <div class="mb-1">
                                                    <label class="small text-muted d-block mb-1">Update Image:</label>
                                                    <input type="file" name="image"
                                                        class="form-control form-control-sm" accept="image/*"
                                                        data-max-size="3072" required>
                                                    <div class="file-size-info">Max: 3MB</div>
                                                </div>

                                                <button type="submit"
                                                    class="btn btn-outline-primary btn-sm mb-1 w-100"><i
                                                        class="bi bi-arrow-repeat me-1"></i>Update</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm w-100"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteImageModal<?php echo e($course->id); ?>_couples_<?php echo e($index); ?>">
                                                    <i class="bi bi-trash me-1"></i>Delete
                                                </button>
                                            </form>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <!-- New images input -->
                                <form action="<?php echo e(route('admin.courses.add_image', [$course->id, 'couples'])); ?>"
                                    method="POST" enctype="multipart/form-data" class="mt-2"
                                    id="couplesAddForm<?php echo e($course->id); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center">
                                            <label class="small text-muted me-2" style="width: 120px;">Select
                                                Images:</label>
                                            <input type="file" name="images[]" class="form-control" multiple
                                                accept="image/*" data-max-size="3072" required>
                                        </div>
                                        <div class="file-size-info">Maximum file size per image: 3MB</div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm w-100">Add Images</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Course Modal for <?php echo e($course->id); ?> -->
            <div class="modal fade" id="deleteCourseModal<?php echo e($course->id); ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Confirm Delete</h5>
                        </div>
                        <div class="modal-body text-black">
                            Are you sure you want to delete this course? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <form action="<?php echo e(route('admin.courses.destroy', $course->id)); ?>" method="POST"
                                class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger"><i
                                        class="bi bi-trash me-1"></i>Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Image Modals for Langer Course -->
            <?php if($course->langer_images): ?>
                <?php $__currentLoopData = $course->langer_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="modal fade" id="deleteImageModal<?php echo e($course->id); ?>_langer_<?php echo e($index); ?>"
                        tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                </div>
                                <div class="modal-body text-black">
                                    Are you sure you want to delete this image? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a href="<?php echo e(route('admin.courses.delete_image', [$course->id, 'langer', $index])); ?>"
                                        class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <!-- Delete Image Modals for Couples Course -->
            <?php if($course->couples_images): ?>
                <?php $__currentLoopData = $course->couples_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="modal fade" id="deleteImageModal<?php echo e($course->id); ?>_couples_<?php echo e($index); ?>"
                        tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                </div>
                                <div class="modal-body text-black">
                                    Are you sure you want to delete this image? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a href="<?php echo e(route('admin.courses.delete_image', [$course->id, 'couples', $index])); ?>"
                                        class="btn btn-danger"><i class="bi bi-trash me-1"></i>Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="alert alert-info">No courses found. Please add a course.</div>
        <?php endif; ?>

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

        <!-- Error Modal for file size validation -->
        <div class="modal fade" id="errorModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>File Too Large
                        </h5>
                    </div>
                    <div class="modal-body text-black" id="errorModalMessage">
                        <!-- Error message will be inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <?php if($courses->isEmpty()): ?>
            <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <form action="<?php echo e(route('admin.courses.store')); ?>" method="POST" enctype="multipart/form-data"
                            id="addCourseForm">
                            <?php echo csrf_field(); ?>
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Course</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Langer Column -->
                                    <div class="col-md-6 border-end">
                                        <h5 class="fw-bold">Langer Course</h5>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="fw-semibold me-3" style="width: 120px;">Parent
                                                    Title:</label>
                                                <input type="text" name="langer_Mtitle" class="form-control"
                                                    placeholder="Parent Title" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="me-3" style="width: 120px;">Parent Main Image:</label>
                                                <input type="file" name="langer_Mimage" class="form-control"
                                                    accept="image/*" data-max-size="3072" required>
                                            </div>
                                            <div class="file-size-info">Maximum file size: 3MB</div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="fw-semibold me-3" style="width: 120px;">Child Title:</label>
                                                <input type="text" name="langer_title" class="form-control"
                                                    placeholder="Child Title" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="me-3 d-block mb-2" style="width: 120px;">Description:</label>
                                            <textarea name="langer_description" class="form-control" rows="3" placeholder="Description" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="me-3" style="width: 120px;">Gallery Images:</label>
                                                <input type="file" name="langer_images[]" class="form-control"
                                                    multiple accept="image/*" data-max-size="3072">
                                            </div>
                                            <div class="file-size-info">Maximum file size per image: 3MB</div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <label class="small text-muted me-3" style="width: 120px;">Hole #:</label>
                                                <input type="number" name="new_langer_holes[]" class="form-control"
                                                    placeholder="Enter hole number">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Couples Column -->
                                    <div class="col-md-6 ps-4">
                                        <h5 class="fw-bold">Couples Course</h5>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="fw-semibold me-3" style="width: 120px;">Parent
                                                    Title:</label>
                                                <input type="text" name="couples_Mtitle" class="form-control"
                                                    placeholder="Parent Title" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="me-3" style="width: 120px;">Parent Main Image:</label>
                                                <input type="file" name="couples_Mimage" class="form-control"
                                                    accept="image/*" data-max-size="3072" required>
                                            </div>
                                            <div class="file-size-info">Maximum file size: 3MB</div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="fw-semibold me-3" style="width: 120px;">Child Title:</label>
                                                <input type="text" name="couples_title" class="form-control"
                                                    placeholder="Child Title" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="me-3 d-block mb-2" style="width: 120px;">Description:</label>
                                            <textarea name="couples_description" class="form-control" rows="3" placeholder="Description" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <label class="me-3" style="width: 120px;">Gallery Images:</label>
                                                <input type="file" name="couples_images[]" class="form-control"
                                                    multiple accept="image/*" data-max-size="3072">
                                            </div>
                                            <div class="file-size-info">Maximum file size per image: 3MB</div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <label class="small text-muted me-3" style="width: 120px;">Hole #:</label>
                                                <input type="number" name="new_couples_holes[]" class="form-control"
                                                    placeholder="Enter hole number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add Course</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if(session('modal_message')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });
        </script>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                var errorMessage = '';

                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    errorMessage += '<?php echo e($error); ?><br>';
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                document.getElementById('errorModalMessage').innerHTML = errorMessage;
                errorModal.show();
            });
        </script>
    <?php endif; ?>

    <script>
        // File size validation before form submission
        document.addEventListener('DOMContentLoaded', function() {
            // Function to show error modal
            function showErrorModal(message) {
                document.getElementById('errorModalMessage').innerHTML = message;
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
                return false;
            }

            // Function to check file size
            function checkFileSize(fileInput, maxSizeKB) {
                if (fileInput.files) {
                    for (let i = 0; i < fileInput.files.length; i++) {
                        const file = fileInput.files[i];
                        const fileSizeKB = file.size / 1024;

                        if (fileSizeKB > maxSizeKB) {
                            const fileSizeMB = (fileSizeKB / 1024).toFixed(2);
                            const maxSizeMB = (maxSizeKB / 1024).toFixed(2);
                            return `"${file.name}" is ${fileSizeMB}MB. Maximum allowed size is ${maxSizeMB}MB.`;
                        }
                    }
                }
                return null;
            }

            // Validate all forms with file inputs
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const fileInputs = this.querySelectorAll('input[type="file"][data-max-size]');
                    let errorMessage = null;

                    fileInputs.forEach(input => {
                        const maxSizeKB = parseInt(input.getAttribute('data-max-size'));
                        const error = checkFileSize(input, maxSizeKB);
                        if (error) {
                            errorMessage = error;
                        }
                    });

                    if (errorMessage) {
                        e.preventDefault();
                        showErrorModal(errorMessage);
                    }
                });
            });

            // Also validate on file input change for immediate feedback
            const fileInputs = document.querySelectorAll('input[type="file"][data-max-size]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const maxSizeKB = parseInt(this.getAttribute('data-max-size'));
                    const error = checkFileSize(this, maxSizeKB);

                    if (error) {
                        showErrorModal(error);
                        this.value = ''; // Clear the invalid file
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_courses.blade.php ENDPATH**/ ?>
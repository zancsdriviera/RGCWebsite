

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0">Footer Settings</h1>
                <p class="text-muted mt-1">Manage your footer content and social media links</p>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-gear-fill me-2"></i>Footer Configuration
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.footer-settings.update')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row">
                                <!-- Logo Section -->
                                <div class="col-12">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-image-fill me-2"></i>Logo Settings
                                    </h6>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Footer Logo</label>
                                    <?php if($footerSetting && $footerSetting->logo_path): ?>
                                        <div class="mb-3 p-3 bg-light rounded text-center">
                                            <img src="<?php echo e(asset('storage/' . $footerSetting->logo_path)); ?>"
                                                alt="Current Logo" style="height: 80px; object-fit: contain;">
                                            <p class="text-muted small mt-2 mb-0">Current Logo</p>
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" name="logo" class="form-control"
                                        accept="image/jpeg,image/png,image/jpg,image/svg">
                                    <div class="form-text">Recommended size: 200x100px. Max 2MB. Supported: JPG, PNG, SVG
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Club Name</label>
                                    <input type="text" name="club_name" class="form-control"
                                        value="<?php echo e(old('club_name', $footerSetting->club_name ?? 'Riviera Golf Club')); ?>">
                                    <div class="form-text">The main heading displayed in the footer</div>
                                </div>

                                <!-- Contact Section -->
                                <div class="col-12 mt-2">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-telephone-fill me-2"></i>Contact Information
                                    </h6>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="<?php echo e(old('phone_number', $footerSetting->phone_number ?? '')); ?>">
                                    <div class="form-text">Example: (046) 409-1077</div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Location URL (Google Maps)</label>
                                    <input type="url" name="location_url" class="form-control"
                                        value="<?php echo e(old('location_url', $footerSetting->location_url ?? '')); ?>">
                                    <div class="form-text">Full Google Maps embed URL or share link</div>
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label fw-semibold">Address</label>
                                    <textarea name="address" class="form-control" rows="2"><?php echo e(old('address', $footerSetting->address ?? '')); ?></textarea>
                                    <div class="form-text">Physical address displayed next to the location icon</div>
                                </div>

                                <!-- Social Media Section -->
                                <div class="col-12 mt-2">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-share-fill me-2"></i>Social Media Links
                                    </h6>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-facebook text-primary me-1"></i>Facebook URL
                                    </label>
                                    <input type="url" name="facebook_url" class="form-control"
                                        value="<?php echo e(old('facebook_url', $footerSetting->facebook_url ?? '')); ?>">
                                    <div class="form-text">Example: https://facebook.com/yourpage</div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-instagram text-danger me-1"></i>Instagram URL
                                    </label>
                                    <input type="url" name="instagram_url" class="form-control"
                                        value="<?php echo e(old('instagram_url', $footerSetting->instagram_url ?? '')); ?>">
                                    <div class="form-text">Example: https://instagram.com/yourprofile</div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-youtube text-danger me-1"></i>YouTube URL
                                    </label>
                                    <input type="url" name="youtube_url" class="form-control"
                                        value="<?php echo e(old('youtube_url', $footerSetting->youtube_url ?? '')); ?>">
                                    <div class="form-text">Example: https://youtube.com/@yourchannel</div>
                                </div>

                                <!-- Copyright Section -->
                                <div class="col-12 mt-2">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-c-circle me-2"></i>Copyright Information
                                    </h6>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Copyright Text</label>
                                    <input type="text" name="copyright_text" class="form-control"
                                        value="<?php echo e(old('copyright_text', $footerSetting->copyright_text ?? 'Riviera Golf Club')); ?>">
                                    <div class="form-text">The text that appears after the © symbol</div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="border-top pt-4 mt-2">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary shadow-lg position-fixed"
                                        style="bottom: 30px; right: 30px; z-index: 1050; border-radius: 50px; padding: 12px 24px; font-weight: 600;">
                                        <i class="bi bi-check-square me-2"></i>Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/footer-settings.blade.php ENDPATH**/ ?>
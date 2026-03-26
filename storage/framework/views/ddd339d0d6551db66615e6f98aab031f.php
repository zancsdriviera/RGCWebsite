

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0">Header Settings</h1>
                <p class="text-muted mt-1">Manage your header logo, contact info, and menu visibility</p>
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
                            <i class="bi bi-gear-fill me-2"></i>Header Configuration
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.header-settings.update')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row">
                                <!-- Logo Section -->
                                <div class="col-12">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-image-fill me-2"></i>Logo & Branding
                                    </h6>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Header Logo</label>
                                    <?php if($headerSetting && $headerSetting->logo_path): ?>
                                        <div class="mb-3 p-3 bg-light rounded text-center">
                                            <img src="<?php echo e(asset('storage/' . $headerSetting->logo_path)); ?>"
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
                                        value="<?php echo e(old('club_name', $headerSetting->club_name ?? 'RIVIERA GOLF CLUB')); ?>">
                                    <div class="form-text">The brand text displayed next to the logo</div>
                                </div>

                                <!-- Contact Section -->
                                <div class="col-12 mt-2">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-telephone-fill me-2"></i>Contact Information
                                    </h6>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Phone Number (Top Bar)</label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="<?php echo e(old('phone_number', $headerSetting->phone_number ?? '')); ?>">
                                    <div class="form-text">Example: (046) 409-1077</div>
                                </div>

                                <!-- Social Media Section -->
                                <div class="col-12 mt-2">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-share-fill me-2"></i>Social Media Links (Top Bar)
                                    </h6>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-facebook text-primary me-1"></i>Facebook URL
                                    </label>
                                    <input type="url" name="facebook_url" class="form-control"
                                        value="<?php echo e(old('facebook_url', $headerSetting->facebook_url ?? '')); ?>">
                                    <div class="form-text">Example: https://facebook.com/yourpage</div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-instagram text-danger me-1"></i>Instagram URL
                                    </label>
                                    <input type="url" name="instagram_url" class="form-control"
                                        value="<?php echo e(old('instagram_url', $headerSetting->instagram_url ?? '')); ?>">
                                    <div class="form-text">Example: https://instagram.com/yourprofile</div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-youtube text-danger me-1"></i>YouTube URL
                                    </label>
                                    <input type="url" name="youtube_url" class="form-control"
                                        value="<?php echo e(old('youtube_url', $headerSetting->youtube_url ?? '')); ?>">
                                    <div class="form-text">Example: https://youtube.com/@yourchannel</div>
                                </div>

                                <!-- Menu Visibility Section -->
                                <div class="col-12 mt-2">
                                    <h6 class="border-bottom pb-2 mb-3">
                                        <i class="bi bi-list-ul me-2"></i>Menu Items Visibility
                                    </h6>
                                    <p class="text-muted small mb-3">Check/uncheck menu items to show/hide them from the
                                        navigation bar</p>
                                </div>

                                <?php
                                    $menuItems = $headerSetting->menu_items ?? [
                                        'home' => true,
                                        'about_us' => true,
                                        'courses' => true,
                                        'membership' => true,
                                        'facilities' => true,
                                        'tournaments_events' => true,
                                        'rates' => true,
                                        'contact_us' => true,
                                        'live_scoring' => true,
                                    ];
                                ?>

                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="menu_items[home]" class="form-check-input"
                                                id="menu_home" value="1"
                                                <?php echo e($menuItems['home'] ?? true ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="menu_home">
                                                <i class="bi bi-house-door me-1"></i>Home
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="menu_items[about_us]" class="form-check-input"
                                                id="menu_about" value="1"
                                                <?php echo e($menuItems['about_us'] ?? true ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="menu_about">
                                                <i class="bi bi-info-circle me-1"></i>About Us
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="menu_items[courses]" class="form-check-input"
                                                id="menu_courses" value="1"
                                                <?php echo e($menuItems['courses'] ?? true ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="menu_courses">
                                                <i class="bi bi-flag me-1"></i>Courses
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="menu_items[membership]" class="form-check-input"
                                                id="menu_membership" value="1"
                                                <?php echo e($menuItems['membership'] ?? true ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="menu_membership">
                                                <i class="bi bi-person-plus me-1"></i>Membership
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="menu_items[facilities]" class="form-check-input"
                                                id="menu_facilities" value="1"
                                                <?php echo e($menuItems['facilities'] ?? true ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="menu_facilities">
                                                <i class="bi bi-building me-1"></i>Facilities
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="menu_items[tournaments_events]"
                                                class="form-check-input" id="menu_tournaments" value="1"
                                                <?php echo e($menuItems['tournaments_events'] ?? true ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="menu_tournaments">
                                                <i class="bi bi-trophy me-1"></i>Tournaments & Events
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="menu_items[rates]" class="form-check-input"
                                                id="menu_rates" value="1"
                                                <?php echo e($menuItems['rates'] ?? true ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="menu_rates">
                                                <i class="bi bi-cash-stack me-1"></i>Rates
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="menu_items[contact_us]" class="form-check-input"
                                                id="menu_contact" value="1"
                                                <?php echo e($menuItems['contact_us'] ?? true ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="menu_contact">
                                                <i class="bi bi-envelope me-1"></i>Contact Us
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="menu_items[live_scoring]"
                                                class="form-check-input" id="menu_live" value="1"
                                                <?php echo e($menuItems['live_scoring'] ?? true ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="menu_live">
                                                <i class="bi bi-tv me-1"></i>Live Scoring
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="border-top pt-4 mt-2">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary px-4">
                                        <i class="bi bi-x-circle me-1"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bi bi-save me-1"></i>Update Header
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

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/header-settings.blade.php ENDPATH**/ ?>
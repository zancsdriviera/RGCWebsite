<?php
    // Fetch only main menus (excluding 'config' type)
    $mainMenus = \App\Models\MenuSetting::where('menu_type', 'main')->where('is_active', true)->orderBy('order')->get();

    $dropdownParents = \App\Models\MenuSetting::where('menu_type', 'dropdown_parent')
        ->where('is_active', true)
        ->orderBy('order')
        ->get();

    $headerSettings = \App\Models\MenuSetting::getHeaderSettings();
?>

<div class="M1_navbar">
    <!-- Top contact bar -->
    <div class="top-contact-bar d-flex justify-content-end align-items-center py-1 px-3">
        <div>
            <?php if($headerSettings && $headerSettings->phone_number): ?>
                <i class="bi bi-telephone-fill"></i>
                <a href="tel:<?php echo e(preg_replace('/[^0-9]/', '', $headerSettings->phone_number)); ?>" class="ms-1 phone-link">
                    <?php echo e($headerSettings->phone_number); ?>

                </a>
            <?php endif; ?>

            <?php if($headerSettings && $headerSettings->facebook_url): ?>
                <a href="<?php echo e($headerSettings->facebook_url); ?>" target="blank" class="text-white social-icon">
                    <i class="bi bi-facebook"></i>
                </a>
            <?php endif; ?>

            <?php if($headerSettings && $headerSettings->instagram_url): ?>
                <a href="<?php echo e($headerSettings->instagram_url); ?>" target="blank" class="text-white social-icon">
                    <i class="bi bi-instagram"></i>
                </a>
            <?php endif; ?>

            <?php if($headerSettings && $headerSettings->youtube_url): ?>
                <a href="<?php echo e($headerSettings->youtube_url); ?>" target="_blank" class="text-white social-icon">
                    <i class="bi bi-youtube"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main navbar -->
    <nav class="navbar navbar-expand-lg navbar-light main-navbar px-3">
        <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('home.frontend')); ?>">
            <?php if($headerSettings && $headerSettings->header_logo_path): ?>
                <img src="<?php echo e(asset('storage/' . $headerSettings->header_logo_path)); ?>" alt="Riviera Golf Club"
                    height="80">
            <?php else: ?>
                <img src="<?php echo e(asset('images/RivieraHeaderLogo.png')); ?>" alt="Riviera Golf Club" height="80">
            <?php endif; ?>
            <span class="brand-text ms-2"><?php echo e($headerSettings->brand_text ?? 'RIVIERA GOLF CLUB'); ?></span>
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu links with proper spacing -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto">
                <?php $__currentLoopData = $mainMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $url = $menu->route_name ? route($menu->route_name) : $menu->url ?? '#';
                        $isActive =
                            request()->is(trim(parse_url($url, PHP_URL_PATH), '/')) ||
                            ($menu->route_name && request()->routeIs($menu->route_name));
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($isActive ? 'active' : ''); ?>" href="<?php echo e($url); ?>">
                            <?php echo e($menu->menu_label); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $dropdownParents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $childrenByCategory = \App\Models\MenuSetting::where('parent_key', $parent->menu_key)
                            ->where('is_active', true)
                            ->orderBy('order')
                            ->get()
                            ->groupBy('category');

                        // Check if any child is active
                        $isParentActive = false;
                        foreach ($childrenByCategory as $category => $categoryChildren) {
                            foreach ($categoryChildren as $child) {
                                $childUrl = $child->route_name ? route($child->route_name) : $child->url ?? '#';
                                if (
                                    request()->is(trim(parse_url($childUrl, PHP_URL_PATH), '/')) ||
                                    ($child->route_name && request()->routeIs($child->route_name))
                                ) {
                                    $isParentActive = true;
                                    break 2;
                                }
                            }
                        }
                    ?>

                    <?php if($childrenByCategory->count() > 0): ?>
                        <li class="nav-item dropdown position-relative">
                            <a class="nav-link <?php echo e($isParentActive ? 'active' : ''); ?>" href="#"
                                id="<?php echo e($parent->menu_key); ?>Dropdown">
                                <?php echo e($parent->menu_label); ?>

                            </a>

                            <div class="dropdown-menu p-3 custom-dropdown"
                                aria-labelledby="<?php echo e($parent->menu_key); ?>Dropdown">
                                <div class="d-flex">
                                    <?php $__currentLoopData = $childrenByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $categoryChildren): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($category): ?>
                                            <!-- Categories with headers -->
                                            <div class="me-4">
                                                <h6 class="dropdown-header facilities_header"><?php echo e($category); ?></h6>
                                                <?php $__currentLoopData = $categoryChildren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $childUrl = $child->route_name
                                                            ? route($child->route_name)
                                                            : $child->url ?? '#';
                                                        $isChildActive =
                                                            request()->is(
                                                                trim(parse_url($childUrl, PHP_URL_PATH), '/'),
                                                            ) ||
                                                            ($child->route_name &&
                                                                request()->routeIs($child->route_name));
                                                    ?>
                                                    <a class="dropdown-item <?php echo e($isChildActive ? 'active' : ''); ?>"
                                                        href="<?php echo e($childUrl); ?>">
                                                        <?php echo e($child->menu_label); ?>

                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $childrenByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $categoryChildren): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!$category): ?>
                                            <!-- Uncategorized items - stack vertically -->
                                            <div class="me-4">
                                                <?php $__currentLoopData = $categoryChildren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $childUrl = $child->route_name
                                                            ? route($child->route_name)
                                                            : $child->url ?? '#';
                                                        $isChildActive =
                                                            request()->is(
                                                                trim(parse_url($childUrl, PHP_URL_PATH), '/'),
                                                            ) ||
                                                            ($child->route_name &&
                                                                request()->routeIs($child->route_name));
                                                    ?>
                                                    <a class="dropdown-item <?php echo e($isChildActive ? 'active' : ''); ?>"
                                                        href="<?php echo e($childUrl); ?>">
                                                        <?php echo e($child->menu_label); ?>

                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php
                    $liveHeader = \App\Models\LiveScoreHeader::where('status', 1)->first();
                ?>

                <?php if($liveHeader): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('live-scores') ? 'active' : ''); ?>"
                            href="<?php echo e(route('live-scores')); ?>">
                            LIVE SCORING
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</div>
<?php /**PATH C:\xampp\htdocs\app\resources\views/partials/header.blade.php ENDPATH**/ ?>
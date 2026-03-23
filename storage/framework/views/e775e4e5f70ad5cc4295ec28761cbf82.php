<?php
    $footer = App\Models\FooterSetting::getActive();
?>

<footer class="rgc-footer">
    <div class="rgc-wrap">
        <h1 class="rgc-title"><?php echo e($footer->club_name ?? 'Riviera Golf Club'); ?></h1>

        <div class="rgc-grid">
            <!-- Logo -->
            <div class="rgc-col logo-col" role="img" aria-label="Riviera logo">
                <?php if($footer && $footer->logo_path): ?>
                    <img src="<?php echo e(asset('storage/' . $footer->logo_path)); ?>" alt="<?php echo e($footer->club_name); ?> logo"
                        class="rgc-logo">
                <?php else: ?>
                    <img src="<?php echo e(asset('images/RivieraFooterLogo.png')); ?>" alt="Riviera logo" class="rgc-logo">
                <?php endif; ?>
            </div>

            <!-- Contact -->
            <div class="rgc-col contact-col">
                <?php if($footer && $footer->phone_number): ?>
                    <a href="tel:<?php echo e(preg_replace('/[^0-9]/', '', $footer->phone_number)); ?>" class="phone-link"
                        aria-label="Call <?php echo e($footer->phone_number); ?>">
                        <i class="bi bi-telephone"></i>
                        <span class="link-text"><?php echo e($footer->phone_number); ?></span>
                    </a>
                <?php endif; ?>

                <?php if($footer && $footer->location_url): ?>
                    <a href="<?php echo e($footer->location_url); ?>" target="_blank" class="location-link"
                        aria-label="Riviera Golf Club location">
                        <i class="bi bi-geo-alt"></i>
                        <span
                            class="addr-text"><?php echo e($footer->address ?? 'By pass Road, Aguinaldo Highway, Silang, Cavite 4118'); ?></span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Social -->
            <div class="rgc-col social-col">
                <?php if($footer && $footer->facebook_url): ?>
                    <a href="<?php echo e($footer->facebook_url); ?>" target="_blank" class="social-link" aria-label="Facebook">
                        <i class="bi bi-facebook"></i><span
                            class="link-text"><?php echo e(str_replace('https://', '', $footer->facebook_url)); ?></span>
                    </a>
                <?php endif; ?>

                <?php if($footer && $footer->instagram_url): ?>
                    <a href="<?php echo e($footer->instagram_url); ?>" target="_blank" class="social-link" aria-label="Instagram">
                        <i class="bi bi-instagram"></i><span
                            class="link-text"><?php echo e(str_replace('https://', '', $footer->instagram_url)); ?></span>
                    </a>
                <?php endif; ?>

                <?php if($footer && $footer->youtube_url): ?>
                    <a href="<?php echo e($footer->youtube_url); ?>" target="_blank" class="social-link" aria-label="YouTube">
                        <i class="bi bi-youtube"></i><span
                            class="link-text"><?php echo e(str_replace('https://', '', $footer->youtube_url)); ?></span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Corporate Governance -->
            <div class="rgc-col gov-col d-flex justify-content-center">
                <a href="<?php echo e(url('/corpgovernance')); ?>"
                    class="gov-link nowrap <?php echo e(request()->is('corpgovernance') || request()->is('definitive') || request()->is('asm_minutes') || request()->is('ACGR') || request()->is('cbce') || request()->is('boardCharter') || request()->is('corpGovManual') ? 'active' : ''); ?>">
                    <i class="bi bi-bank"></i><span class="link-text">Corporate Governance</span>
                </a>
            </div>
        </div>

        <hr class="rgc-divider">
        <div class="rgc-copy">
            <span class="copy-badge">©</span>
            <span class="copy-text"><?php echo e($footer->copyright_text ?? 'Riviera Golf Club'); ?></span>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\app\resources\views/partials/footer.blade.php ENDPATH**/ ?>
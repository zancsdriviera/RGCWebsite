
<?php $__env->startSection('title', 'Tournament Rates Editor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-3">
        <h3 class="fw-bold mb-4">Tournament Rates</h3>
        <style>
            .form-label {
                font-weight: 600;
                font-size: 1.2rem;
            }
        </style>

        <div class="row g-4">
            <?php $__currentLoopData = $tournamentRates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6">
                    <form action="<?php echo e(route('admin.tournament_rates.update', $rate->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        
                        <input type="hidden" name="season" value="<?php echo e($rate->season); ?>">

                        <div class="card shadow-sm p-4">
                            <h4 style="font-weight: bolder;"><?php echo e(strtoupper($rate->season)); ?> SEASON</h4>

                            
                            <div class="mb-3">
                                <label class="form-label">GREEN FEE (multiple line entry)</label>
                                <textarea name="green_fee" class="form-control" rows="4"
                                    placeholder="e.g. PHP 3,500.00 – 20 pax&#10;PHP 3,350.00 – 40 pax"><?php echo e(old('green_fee', $rate->green_fee)); ?></textarea>
                                <small class="text-muted">Use format: <code>PHP 3,500.00 20 pax</code> (do not forget the
                                    SPACE
                                    ).</small>
                            </div>

                            
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">SCORING FEE</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="scoring_fee" step="0.01" class="form-control"
                                            value="<?php echo e(old('scoring_fee', $rate->scoring_fee)); ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">CADDIE FEE / MARKERS FEE</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="caddie_fee" step="0.01" class="form-control"
                                            value="<?php echo e(old('caddie_fee', $rate->caddie_fee)); ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">GOLF CART RENTAL (18-HOLES)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="golf_cart_fee" step="0.01" class="form-control"
                                            value="<?php echo e(old('golf_cart_fee', $rate->golf_cart_fee)); ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">HOLE-IN-ONE FUND</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="hole_in_one_fund" step="0.01" class="form-control"
                                            value="<?php echo e(old('hole_in_one_fund', $rate->hole_in_one_fund)); ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">SPORTS DEVELOPMENT FUND</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="sports_dev_fund" step="0.01" class="form-control"
                                            value="<?php echo e(old('sports_dev_fund', $rate->sports_dev_fund)); ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">ENVIRONMENTAL FUND</label>
                                    <div class="input-group">
                                        <span class="input-group-text">PHP</span>
                                        <input type="number" name="environmental_fund" step="0.01" class="form-control"
                                            value="<?php echo e(old('environmental_fund', $rate->environmental_fund)); ?>">
                                    </div>
                                </div>
                            </div>

                            
                            <div class="mt-3">
                                <label class="form-label">FOOD & BEVERAGE (can be blank)</label>
                                <textarea name="food_beverage" class="form-control" rows="3"
                                    placeholder="e.g. PHP 400.00 – 550.00&#10;PHP 700.00 – 1,000.00"><?php echo e(old('food_beverage', $rate->food_beverage)); ?></textarea>
                                <small class="text-muted">Use format: <code>PHP 400.00 –
                                        550.00</code> or leave a note or N/A.</small>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-3"><i
                                        class="bi bi-check-square me-2"></i>Save Changes</button>
                            </div>

                        </div>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            <?php if(session('success')): ?>
                const modalEl = document.getElementById('successModal');
                const modalBody = modalEl.querySelector('.modal-body');
                modalBody.textContent = "<?php echo e(session('success')); ?>";
                modalBody.style.color = 'green'; // optional: color

                const modal = new bootstrap.Modal(modalEl);
                modal.show();

                // Auto-close after 1.5s
                setTimeout(() => modal.hide(), 3000);
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_tournament_rates.blade.php ENDPATH**/ ?>
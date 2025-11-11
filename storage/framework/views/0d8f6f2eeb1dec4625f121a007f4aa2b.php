

<?php $__env->startSection('title', 'Tournament Rates'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/tournament_rates.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">RATES</h1>
    </div>

    <div class="top_caption text-center my-0">
        <h2 class="top-title">TOURNAMENT RATES</h2>
    </div>

    <div class="pricing-container">
        <?php $__currentLoopData = $tournamentRates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="pricing-box">
                <div class="pricing-header">
                    <?php $season = strtolower(trim($rate->season)); ?>
                    <?php if($season === 'peak'): ?>
                        <h2>PEAK SEASON</h2>
                        <p>(NOV–MAR)</p>
                    <?php elseif($season === 'non-peak'): ?>
                        <h2>NON-PEAK SEASON</h2>
                        <p>(APR–OCT)</p>
                    <?php endif; ?>
                </div>

                <ul class="pricing-list">
                    
                    <li>
                        <span class="label">GREEN FEE <span class="desc">(min. gtd guest)</span></span>
                        <span class="price">
                            <?php echo nl2br(preg_replace('/(PHP\s*[\d,]+\.\d+)/', '$1 –', str_replace('\\n', "\n", $rate->green_fee ?? ''))); ?>

                        </span>
                    </li>

                    
                    <li>
                        <span class="label">SCORING FEE <span class="desc">(Optional)</span></span>
                        <span class="price">
                            <?php echo e(is_numeric(trim($rate->scoring_fee))
                                ? 'PHP ' . number_format($rate->scoring_fee, 2)
                                : $rate->scoring_fee ?? '—'); ?>

                        </span>
                    </li>

                    
                    <li>
                        <span class="label">CADDIE FEE / MARKERS FEE
                            <span class="desc">(Must be paid in CASH on functional day)</span>
                        </span>
                        <span class="price">
                            <?php echo e(is_numeric(trim($rate->caddie_fee))
                                ? 'PHP ' . number_format($rate->caddie_fee, 2)
                                : $rate->caddie_fee ?? '—'); ?>

                        </span>
                    </li>

                    
                    <li>
                        <span class="label">GOLF CART RENTAL<br>(18-HOLES)
                            <span class="desc">
                                Note: 2 carts per flight for shotgun<br>
                                tournament charged to organizer
                            </span>
                        </span>
                        <span class="price">
                            <?php echo e(is_numeric(trim($rate->golf_cart_fee))
                                ? 'PHP ' . number_format($rate->golf_cart_fee, 2)
                                : $rate->golf_cart_fee ?? '—'); ?>

                        </span>
                    </li>

                    
                    <li>
                        <span class="label">HOLE-IN-ONE FUND</span>
                        <span class="price">
                            <?php echo e(is_numeric(trim($rate->hole_in_one_fund))
                                ? 'PHP ' . number_format($rate->hole_in_one_fund, 2)
                                : $rate->hole_in_one_fund ?? '—'); ?>

                        </span>
                    </li>

                    
                    <li>
                        <span class="label">SPORTS DEVELOPMENT FUND</span>
                        <span class="price">
                            <?php echo e(is_numeric(trim($rate->sports_dev_fund))
                                ? 'PHP ' . number_format($rate->sports_dev_fund, 2)
                                : $rate->sports_dev_fund ?? '—'); ?>

                        </span>
                    </li>

                    
                    <li>
                        <span class="label">ENVIRONMENTAL FUND</span>
                        <span class="price">
                            <?php echo e(is_numeric(trim($rate->environmental_fund))
                                ? 'PHP ' . number_format($rate->environmental_fund, 2)
                                : $rate->environmental_fund ?? '—'); ?>

                        </span>
                    </li>


                    
                    <li>
                        <span class="label">FOOD & BEVERAGE
                            <span class="desc">
                                Set Lunch<br>
                                Buffet Menu (min. 50 pax)<br>
                                F&B Consumables per player if<br>
                                NO F&B Arrangement
                            </span>
                        </span>
                        <span class="price">
                            <?php echo nl2br(preg_replace('/(PHP\s*[\d,]+\.\d+)/', '$1 –', str_replace('\\n', "\n", $rate->food_beverage ?? ''))); ?>

                        </span>
                    </li>
                </ul>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/tournament_rates.blade.php ENDPATH**/ ?>
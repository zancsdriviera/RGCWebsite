

<?php $__env->startSection('title', 'Tournament Rates'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/tournament_rates.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">RATES</h1>
    </div>

    <div class="top_caption my-0 text-center">
        <h2 class="top-title">TOURNAMENT RATES</h2>
    </div>

    <div class="pricing-container">
        <!-- Peak Season -->
        <div class="pricing-box">
            <div class="pricing-header">
                <h2>PEAK SEASON</h2>
                <p>(NOV–MAR)</p>
            </div>
            <ul class="pricing-list">
                <li>
                    <span class="label">GREEN FEE
                        <span class="desc">
                            (min. gtd guest)
                        </span>
                    </span>
                    <span class="price">
                        PHP 3,500.00 – 20 pax<br>
                        PHP 3,350.00 – 40 pax<br>
                        PHP 3,200.00 – 60 pax<br>
                        PHP 3,050.00 – 80 pax<br>
                        PHP 2,900.00 – 100 pax
                    </span>
                </li>
                <li>
                    <span class="label">SCORING FEE
                        <span class="desc">
                            (Optional)
                        </span>
                    </span>
                    <span class="price">PHP 3,000.00</span>
                </li>
                <li>
                    <span class="label">CADDIE FEE / MARKERS FEE
                        <span class="desc">
                            (Must be paid in CASH on functional day)
                        </span>
                    </span>
                    <span class="price">PHP 600.00</span>
                </li>
                <li>
                    <span class="label">GOLF CART RENTAL<br>(18-HOLES)
                        <span class="desc">
                            Note: 2 carts per flight for shotgun<br>
                            tournament charged to organizer
                        </span></span>
                    <span class="price">PHP 1,000.00</span>
                </li>
                <li>
                    <span class="label">HOLE-IN-ONE FUND</span>
                    <span class="price">PHP 100.00</span>
                </li>
                <li>
                    <span class="label">SPORTS DEVELOPMENT FUND</span>
                    <span class="price">PHP 100.00</span>
                </li>
                <li>
                    <span class="label">ENVIRONMENTAL FUND</span>
                    <span class="price">PHP 20.00</span>
                </li>
                <li>
                    <span class="label">
                        FOOD & BEVERAGE
                        <span class="desc">
                            Set Lunch<br>
                            Buffet Menu (min. 50 pax)<br>
                            F&B Consumables per player if<br>
                            NO F&B Arrangement
                        </span>
                    </span>

                    <span class="price">
                        
                    </span>
                </li>
            </ul>
        </div>
        <!-- Non-Peak Season -->
        <div class="pricing-box">
            <div class="pricing-header">
                <h2>NON-PEAK SEASON</h2>
                <p>(APR–OCT)</p>
            </div>
            <ul class="pricing-list">
                <li>
                    <span class="label">GREEN FEE
                        <span class="desc">
                            (min. gtd guest)
                        </span>
                    </span>
                    <span class="price">
                        PHP 2,500.00 – 20 pax<br>
                        PHP 2,400.00 – 40 pax<br>
                        PHP 2,300.00 – 60 pax<br>
                        PHP 2,200.00 – 80 pax<br>
                        PHP 2,100.00 – 100 pax
                    </span>
                </li>
                <li>
                    <span class="label">SCORING FEE
                        <span class="desc">
                            (Optional)
                        </span>
                    </span>
                    <span class="price">PHP 3,000.00</span>
                </li>
                <li>
                    <span class="label">CADDIE FEE / MARKERS FEE
                        <span class="desc">
                            (Must be paid in CASH on functional day)
                        </span>
                    </span>
                    <span class="price">PHP 600.00</span>
                </li>
                <li>
                    <span class="label">GOLF CART RENTAL<br>(18-HOLES)
                        <span class="desc">
                            Note: 2 carts per flight for shotgun<br>
                            tournament charged to organizer
                        </span></span>
                    <span class="price">PHP 1,000.00</span>
                </li>
                <li>
                    <span class="label">HOLE-IN-ONE FUND</span>
                    <span class="price">PHP 100.00</span>
                </li>
                <li>
                    <span class="label">SPORTS DEVELOPMENT FUND</span>
                    <span class="price">PHP 100.00</span>
                </li>
                <li>
                    <span class="label">ENVIRONMENTAL FUND</span>
                    <span class="price">PHP 20.00</span>
                </li>
                <li>
                    <span class="label">
                        FOOD & BEVERAGE
                        <span class="desc">
                            Set Lunch<br>
                            Buffet Menu (min. 50 pax)<br>
                            F&B Consumables per player if<br>
                            NO F&B Arrangement
                        </span>
                    </span>

                    <span class="price">
                        
                    </span>
                </li>
            </ul>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/tournament_rates.blade.php ENDPATH**/ ?>
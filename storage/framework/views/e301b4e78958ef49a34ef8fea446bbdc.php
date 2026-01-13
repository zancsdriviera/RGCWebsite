

<?php $__env->startSection('title', 'Tournament Rates'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/tournament_rates.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    <?php
        // Get contact info from first rate (since all should have same contact)
        $contact = $tournamentRates->first();
    ?>

    <?php if($contact && ($contact->contact_phone || $contact->contact_email)): ?>
        <div class="contact-container p-5 rounded-4 shadow-sm border">
            <div class="contact-header text-center mb-4">
                <h2 class="contact-title" style="color: #107039;">CONTACT US</h2>
                <p class="contact-subtitle">For tournament inquiries and bookings</p>
            </div>

            <div class="contact-details text-center">
                <?php if($contact->contact_phone): ?>
                    <div class="contact-item mb-3">
                        <i class="fas fa-phone contact-icon"></i>
                        <br>
                        <h5 class="mb-1 mt-2">Phone:</h5>
                        <a href="tel:<?php echo e($contact->contact_phone); ?>" class="contact-value">
                            <?php echo e($contact->contact_phone); ?>

                        </a>
                    </div>
                <?php endif; ?>

                <?php if($contact->contact_email): ?>
                    <div class="contact-item">
                        <i class="fas fa-envelope contact-icon"></i>
                        <br>
                        <h5 class="mb-1 mt-2">Email:</h5>
                        <a href="mailto:<?php echo e($contact->contact_email); ?>" class="contact-value">
                            <?php echo e($contact->contact_email); ?>

                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <br>
    <?php endif; ?>

    
    <?php $__env->startPush('styles'); ?>
        <style>
            .contact-container {
                background: #f8f9fa;
                border-top: 2px solid #ddd;
                padding-top: 2rem;
            }

            .contact-title {
                font-size: 2.4rem;
                font-weight: bold;
                color: #2c3e50;
            }

            .contact-subtitle {
                color: #7f8c8d;
                font-size: 1.1rem;
            }

            .contact-item {
                display: inline-block;
                margin: 0 2rem;
            }

            .contact-icon {
                color: #107039;
                font-size: 1.8rem;
                margin: 10px 0.5rem 0 0;

            }

            .contact-label {
                font-weight: 600;
                margin-right: 0.5rem;
                color: #34495e;
            }

            .contact-value {
                color: #2980b9;
                text-decoration: none;
                transition: color 0.3s;
                color: #2c3e50;
            }

            .contact-value:hover {
                color: #1a5276;
                text-decoration: underline;

            }

            @media (max-width: 768px) {
                .contact-item {
                    display: block;
                    margin: 1rem 0;
                }
            }
        </style>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views\tournament_rates.blade.php ENDPATH**/ ?>
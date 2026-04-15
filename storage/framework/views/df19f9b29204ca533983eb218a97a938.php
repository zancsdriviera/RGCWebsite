

<?php $__env->startSection('title', 'Rates - Peak Season'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('css/rates.css')); ?>" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <style>
        /* ── Section heading ── */
        .rgc-section-heading {
            text-align: center;
            margin-bottom: 40px;
        }

        .rgc-section-heading h2 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 44px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            line-height: 1.2;
        }

        .rgc-section-heading .rgc-sub {
            font-family: 'Lato', sans-serif;
            font-size: 18px;
            font-weight: 400;
            color: #666;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 8px;
        }

        .rgc-section-heading .rgc-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 14px auto 0;
            max-width: 320px;
        }

        .rgc-section-heading .rgc-divider::before,
        .rgc-section-heading .rgc-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #a8956a);
        }

        .rgc-section-heading .rgc-divider::after {
            background: linear-gradient(to left, transparent, #a8956a);
        }

        .rgc-section-heading .rgc-divider span {
            width: 7px;
            height: 7px;
            background: #a8956a;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ── Rate Card ── */
        .rgc-card {
            background: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 24px rgba(0, 0, 0, 0.07), 0 1px 4px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.07);
            transition: box-shadow 0.25s ease, transform 0.25s ease;
        }

        .rgc-card:hover {
            box-shadow: 0 8px 40px rgba(16, 112, 57, 0.13), 0 2px 8px rgba(0, 0, 0, 0.07);
            transform: translateY(-3px);
        }

        /* Top accent bar */
        .rgc-card-accent {
            height: 4px;
            background: linear-gradient(to right, #a8956a, #c8b27a, #a8956a);
        }

        /* Green header */
        .rgc-card-header {
            background: linear-gradient(160deg, #0f5c2e 0%, #107039 50%, #1a8a47 100%);
            color: #fff;
            text-align: center;
            padding: 22px 24px 20px;
            position: relative;
        }

        .rgc-card-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 16px solid transparent;
            border-right: 16px solid transparent;
            border-top: 10px solid #1a8a47;
        }

        .rgc-card-header .rgc-title {
            font-family: 'Lato', sans-serif;
            font-weight: 700;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 2px;
            line-height: 1.4;
        }

        .rgc-card-header .rgc-subtitle {
            font-family: 'Lato', sans-serif;
            font-weight: 300;
            font-size: 15px;
            letter-spacing: 1px;
            opacity: 0.88;
            margin-top: 6px;
            line-height: 1.4;
        }

        /* Total block */
        .rgc-card-total {
            background: #f9f9f7;
            border-bottom: 1px solid #efefeb;
            text-align: center;
            padding: 22px 16px 18px;
        }

        .rgc-card-total .rgc-total-label {
            font-family: 'Lato', sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #a8956a;
            margin-bottom: 5px;
        }

        .rgc-card-total .rgc-total-amount {
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            font-weight: 700;
            color: #107039;
            line-height: 1;
            letter-spacing: -0.5px;
        }

        /* Body */
        .rgc-card-body {
            padding: 22px 26px 26px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        /* Fee list */
        .rgc-fee-list {
            list-style: none;
            padding: 0;
            margin: 0 0 20px;
            flex: 1;
        }

        .rgc-fee-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f2f2ee;
            font-family: 'Lato', sans-serif;
            font-size: 16px;
            color: #444;
        }

        .rgc-fee-list li:first-child {
            border-top: 1px solid #f2f2ee;
        }

        .rgc-fee-list li .rgc-fee-label {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .rgc-fee-list li .rgc-fee-label::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #a8956a;
            flex-shrink: 0;
        }

        .rgc-fee-list li .rgc-fee-amount {
            font-weight: 600;
            color: #107039;
            white-space: nowrap;
            padding-left: 12px;
            font-size: 15px;
        }

        /* Schedule button */
        .rgc-schedule {
            display: flex;
            justify-content: center;
            margin-top: auto;
            padding-top: 4px;
        }

        .rgc-schedule-btn {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #555;
            background: transparent;
            border: 1.5px solid #ccc;
            border-radius: 30px;
            padding: 12px 32px;
            cursor: default;
            transition: border-color 0.2s, color 0.2s;
        }

        .rgc-card:hover .rgc-schedule-btn {
            border-color: #a8956a;
            color: #a8956a;
        }

        /* Description */
        .rgc-card-desc {
            font-family: 'Lato', sans-serif;
            font-size: 13px;
            color: #888;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 14px;
            line-height: 1.6;
        }

        /* Section wrapper */
        .rgc-section-block {
            margin-bottom: 60px;
        }

        @media (max-width: 767px) {
            .rgc-card-header .rgc-title {
                font-size: 15px;
            }

            .rgc-card-header .rgc-subtitle {
                font-size: 13px;
            }

            .rgc-card-total .rgc-total-amount {
                font-size: 32px;
            }

            .rgc-fee-list li {
                font-size: 14px;
            }

            .rgc-section-heading h2 {
                font-size: 32px;
            }

            .rgc-section-heading .rgc-sub {
                font-size: 15px;
            }
        }

        @media (max-width: 575px) {
            .rgc-card-total .rgc-total-amount {
                font-size: 28px;
            }

            .rgc-section-heading h2 {
                font-size: 26px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">RATES</h1>
    </div>

    <section class="rates-section my-5">
        <div class="container">

            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="rgc-section-block">

                    <?php
                        $titles = $section->gpeaks->where('type', 'title');
                        $golfRates = $section->gpeaks->where('type', 'golf_rate');
                    ?>

                    
                    <?php $__currentLoopData = $titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="rgc-section-heading">
                            <?php
                                $titleLines = array_filter(
                                    preg_split('/\r\n|\r|\n/', $item->title ?? ''),
                                    fn($l) => trim($l) !== '',
                                );
                            ?>
                            <?php $__currentLoopData = $titleLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <h2><?php echo e(trim($line)); ?></h2>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item->description): ?>
                                <p class="rgc-sub"><?php echo e($item->description); ?></p>
                            <?php endif; ?>
                            <div class="rgc-divider"><span></span></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if($golfRates->count()): ?>
                        <div class="row gx-4 justify-content-center align-items-stretch">
                            <?php $__currentLoopData = $golfRates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gpeak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12 col-md-6 col-lg-5 mb-4 d-flex">
                                    <article class="rgc-card w-100">

                                        <div class="rgc-card-accent"></div>

                                        <div class="rgc-card-header">
                                            <?php
                                                $titleLines = array_filter(
                                                    preg_split('/\r\n|\r|\n/', $gpeak->gr_title ?? ''),
                                                    fn($l) => trim($l) !== '',
                                                );
                                            ?>
                                            <div class="rgc-title">
                                                <?php $__currentLoopData = $titleLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span style="display:block;"><?php echo e(trim($line)); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php if($gpeak->gr_title_description): ?>
                                                <div class="rgc-subtitle"><?php echo e($gpeak->gr_title_description); ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if($gpeak->gr_total): ?>
                                            <div class="rgc-card-total">
                                                <div class="rgc-total-label">Total</div>
                                                <div class="rgc-total-amount">₱<?php echo e(number_format($gpeak->gr_total, 2)); ?>

                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="rgc-card-body">

                                            <?php if($gpeak->gr_content): ?>
                                                <?php
                                                    $bodies = preg_split('/\r\n|\r|\n/', $gpeak->gr_content ?? '');
                                                    $prices = preg_split(
                                                        '/\r\n|\r|\n/',
                                                        $gpeak->gr_content_price ?? '',
                                                    );
                                                ?>
                                                <ul class="rgc-fee-list">
                                                    <?php $__currentLoopData = $bodies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $body): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(trim($body) !== ''): ?>
                                                            <li>
                                                                <span class="rgc-fee-label"><?php echo e(trim($body)); ?></span>
                                                                <?php if(isset($prices[$index]) && trim($prices[$index]) !== ''): ?>
                                                                    <span
                                                                        class="rgc-fee-amount">₱<?php echo e(number_format((float) trim($prices[$index]), 2)); ?></span>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            <?php endif; ?>

                                            <?php if($gpeak->gr_schedule): ?>
                                                <div class="rgc-schedule">
                                                    <button class="rgc-schedule-btn"><?php echo e($gpeak->gr_schedule); ?></button>
                                                </div>
                                            <?php endif; ?>

                                            <?php if($gpeak->gr_description): ?>
                                                <p class="rgc-card-desc"><?php echo e($gpeak->gr_description); ?></p>
                                            <?php endif; ?>

                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/rates2.blade.php ENDPATH**/ ?>
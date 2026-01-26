

<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('css/home.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($homepage): ?>
        <div class="main-carousel-wrapper">
            <div id="mainCarousel" class="carousel slide" data-bs-ride="false">
                <div class="carousel-inner">
                    
                    <?php for($i = 1; $i <= 3; $i++): ?>
                        <?php
                            $img = $homepage->{'carousel' . $i};
                            $caption = $homepage->{'carousel' . $i . 'Caption'};
                        ?>

                        <div class="carousel-item <?php echo e($i == 1 ? 'active' : ''); ?>">
                            <?php if($i == 1): ?>
                                <!-- Clouds moving left -->
                                <div class="cloud-layer cloud-left layer-1">
                                    <img src="<?php echo e(asset('images/HOME/Carousel/Clouds.png')); ?>" alt="cloud">
                                </div>
                                <div class="cloud-layer cloud-left layer-2">
                                    <img src="<?php echo e(asset('images/HOME/Carousel/Clouds.png')); ?>" alt="cloud">
                                </div>

                                <!-- Clouds moving right -->
                                <div class="cloud-layer cloud-right layer-3">
                                    <img src="<?php echo e(asset('images/HOME/Carousel/Clouds.png')); ?>" alt="cloud">
                                </div>
                                <div class="cloud-layer cloud-right layer-4">
                                    <img src="<?php echo e(asset('images/HOME/Carousel/Clouds.png')); ?>" alt="cloud">
                                </div>
                            <?php endif; ?>

                            <img src="<?php echo e($img ? asset('storage/' . $img) : asset('images/HOME/Carousel/Home_Image_' . $i . '.jpg')); ?>"
                                class="d-block w-100 carousel-img" alt="Carousel <?php echo e($i); ?>">

                            <?php if($caption): ?>
                                <div class="carousel-caption">
                                    <h3><?php echo e($caption); ?></h3>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>

                    <?php
                        // dynamic_carousels is already an array due to model cast
                        $dynamicCarousels = is_array($homepage->dynamic_carousels) ? $homepage->dynamic_carousels : [];
                    ?>

                    <?php $__currentLoopData = $dynamicCarousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item">
                            <img src="<?php echo e(asset('storage/' . $carousel['image'])); ?>" class="d-block w-100"
                                alt="<?php echo e($carousel['caption']); ?>">
                            <?php if(!empty($carousel['caption'])): ?>
                                <div class="carousel-caption">
                                    <h3><?php echo e($carousel['caption']); ?></h3>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    
                    <?php for($i = 4; $i <= 5; $i++): ?>
                        <?php
                            $img = $homepage->{'carousel' . $i};
                            $caption = $homepage->{'carousel' . $i . 'Caption'};
                        ?>

                        <div class="carousel-item">
                            <div class="carousel-img-wrapper">
                                <img src="<?php echo e($img ? asset('storage/' . $img) : asset('images/HOME/Carousel/Home_Image_' . $i . '.jpg')); ?>"
                                    class="carousel-img" alt="<?php echo e($i == 4 ? 'Langer' : 'Couples'); ?>">
                            </div>
                            <div class="carousel-left-caption-wrapper">
                                <h3 class="caption-style text-white">
                                    <?php echo e($i == 4 ? 'Langer Course' : 'Couples Course'); ?>

                                </h3>
                                <div class="carousel-left-caption">
                                    <p class="caption_description text-white">
                                        <?php echo e($caption ??
                                            ($i == 4
                                                ? 'Known for being one of the toughest courses in the Philippines, this 7,057 yard Par 71 Bernhard Langer signature course will put all the golf skills to test. Built on the hills of Silang Cavite, this course\'s excellent drainage makes it one of the best all-weather courses in the country.'
                                                : 'Designed by everybody\'s favorite golfer Freddie Couples, The Riviera Couples Course is a challenging yet enjoyable layout. This 7,102 yard par 72 course is situated amongst small valleys and ravines making this Silang Cavite course pleasing to the eye, yet dangerous if you lose focus on your game.')); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        
        <div class="container my-5 text-center">
            <?php if($homepage->headline): ?>
                <h2 class="fw-bold text-success"><?php echo e($homepage->headline); ?></h2>
            <?php endif; ?>
            <?php if($homepage->subheadline): ?>
                <p class="text-muted mb-5"><?php echo e($homepage->subheadline); ?></p>
            <?php endif; ?>

            <div class="row g-4 justify-content-center">
                <?php
                    $cardIcons = ['bi-flag', 'bi-building', 'bi-calendar-event'];
                    $cardLinks = ['/courses', '/about_us', '/tournament_gallery'];
                ?>

                <?php for($i = 1; $i <= 3; $i++): ?>
                    <?php
                        $cardImg = $homepage->{'card' . $i . '_image'} ?? "images/HOME/CardImages/Card-image_{$i}.jpg";
                        $cardTitle =
                            $homepage->{'card' . $i . '_title'} ?? ['OUR COURSES', 'CLUB HISTORY', 'EVENTS'][$i - 1];
                        $cardIcon = $cardIcons[$i - 1];
                        $cardLink = $cardLinks[$i - 1];
                    ?>

                    <div class="col-md-4">
                        <a href="<?php echo e(url($cardLink)); ?>" class="text-decoration-none">
                            <div class="card shadow h-100">
                                <img src="<?php echo e(asset('storage/' . $cardImg)); ?>" class="card-img-top"
                                    alt="<?php echo e($cardTitle); ?>">
                                <div class="card-body text-center">
                                    <i class="bi <?php echo e($cardIcon); ?> fs-1 text-success"></i>
                                    <h5 class="mt-3 fw-bold text-dark"><?php echo e($cardTitle); ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="container-fluid solid-bg text-center py-4">
            <i class="bi bi-telephone-outbound-fill" style="font-size:17px;"></i>
            <span class="ms-1 d-inline-block">
                For more information, please contact us at (046) 409-1077
            </span>
        </div>

        <!-- Full-width Google Map -->
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3867.3227935694363!2d120.95206706259182!3d14.234382647037595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sRiviera%20Golf%20Club!5e0!3m2!1sen!2sph!4v1756190894108!5m2!1sen!2sph"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        
        
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/home.blade.php ENDPATH**/ ?>
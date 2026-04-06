

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
                    
                    <?php
                        $animMap = [1 => 'zoom', 2 => 'float-up', 3 => 'wipe'];
                    ?>

                    <?php for($i = 1; $i <= 3; $i++): ?>
                        <?php
                            $img = $homepage->{'carousel' . $i};
                            $caption = $homepage->{'carousel' . $i . 'Caption'};
                        ?>

                        <div class="carousel-item <?php echo e($i == 1 ? 'active' : ''); ?>" data-caption-anim="<?php echo e($animMap[$i]); ?>">
                            <?php if($i == 1): ?>
                                <div class="cloud-layer cloud-left layer-1">
                                    <img src="<?php echo e(asset('images/HOME/Carousel/Clouds.png')); ?>" alt="cloud">
                                </div>
                                <div class="cloud-layer cloud-left layer-2">
                                    <img src="<?php echo e(asset('images/HOME/Carousel/Clouds.png')); ?>" alt="cloud">
                                </div>
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
                        $dynamicCarousels = is_array($homepage->dynamic_carousels) ? $homepage->dynamic_carousels : [];
                    ?>

                    <?php $__currentLoopData = $dynamicCarousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $ext = strtolower(pathinfo($carousel['image'] ?? '', PATHINFO_EXTENSION));
                            $isVideo = in_array($ext, ['mp4', 'mov', 'avi', 'webm']);
                            $mime = $ext === 'mov' ? 'video/quicktime' : 'video/' . $ext;
                        ?>
                        <div class="carousel-item dynamic-carousel-slide <?php echo e($isVideo ? 'has-video' : ''); ?>"
                            data-caption-anim="float-up">

                            <?php if($isVideo): ?>
                                
                                <video class="d-block w-100 inline-carousel-video" style="height:100vh; object-fit:cover;"
                                    muted playsinline data-src="<?php echo e(asset('storage/' . $carousel['image'])); ?>"
                                    data-mime="<?php echo e($mime); ?>">
                                </video>

                                
                                <div
                                    style="position:absolute; bottom:80px; right:20px; z-index:10; display:flex; flex-direction:column; gap:8px;">
                                    
                                    <button class="btn btn-dark btn-sm inline-sound-btn"
                                        style="opacity:0.75; border-radius:50%; width:42px; height:42px; padding:0;"
                                        title="Toggle sound">
                                        <i class="bi bi-volume-mute-fill"></i>
                                    </button>
                                    
                                    <button class="btn btn-dark btn-sm video-zoom-btn"
                                        style="opacity:0.75; border-radius:50%; width:42px; height:42px; padding:0;"
                                        data-src="<?php echo e(asset('storage/' . $carousel['image'])); ?>"
                                        data-mime="<?php echo e($mime); ?>" title="Zoom video">
                                        <i class="bi bi-fullscreen"></i>
                                    </button>
                                </div>
                            <?php else: ?>
                                <img src="<?php echo e(asset('storage/' . $carousel['image'])); ?>" class="d-block w-100"
                                    alt="<?php echo e($carousel['caption'] ?? ''); ?>">
                            <?php endif; ?>

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

                        <div class="carousel-item" data-caption-anim="fade">
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

        
        <div id="videoZoomModal"
            style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.95); flex-direction:column; align-items:center; justify-content:center;">

            
            <button id="videoZoomClose"
                style="position:absolute; top:16px; right:20px; background:rgba(255,255,255,0.12); border:none; color:#fff; border-radius:50%; width:38px; height:38px; font-size:18px; cursor:pointer; display:flex; align-items:center; justify-content:center; z-index:10;">
                <i class="bi bi-x-lg"></i>
            </button>

            
            <video id="zoomModalVideo"
                style="max-width:960px; width:95vw; max-height:78vh; background:#000; display:block;" playsinline>
            </video>

            
            <div id="zoomControlsBar"
                style="width:95vw; max-width:960px; background:rgba(0,0,0,0.75); padding:8px 14px 10px; margin-top:0; border-radius:0 0 6px 6px;">

                
                <div style="margin-bottom:6px;">
                    <input type="range" id="zoomSeekBar" value="0" min="0" step="0.01"
                        style="width:100%; height:4px; accent-color:#fff; cursor:pointer; border-radius:2px;">
                </div>

                
                <div style="display:flex; align-items:center; justify-content:space-between;">

                    
                    <div style="display:flex; align-items:center; gap:10px;">

                        
                        <button id="zoomPlayPause"
                            style="background:none; border:none; color:#fff; font-size:22px; cursor:pointer; padding:0; line-height:1; display:flex; align-items:center;">
                            <i class="bi bi-play-fill"></i>
                        </button>

                        
                        <button id="zoomBackward"
                            style="background:none; border:none; color:#fff; font-size:18px; cursor:pointer; padding:0; line-height:1; display:flex; align-items:center;"
                            title="-10 seconds">
                            <i class="bi bi-skip-start-fill"></i>
                        </button>

                        
                        <span id="zoomTimeDisplay"
                            style="color:#fff; font-size:13px; font-family:monospace; white-space:nowrap;">
                            0:00 / 0:00
                        </span>
                    </div>

                    
                    <div style="display:flex; align-items:center; gap:12px;">

                        
                        <button id="zoomMuteToggle"
                            style="background:none; border:none; color:#fff; font-size:20px; cursor:pointer; padding:0; line-height:1; display:flex; align-items:center;"
                            title="Toggle sound">
                            <i class="bi bi-volume-mute-fill"></i>
                        </button>

                        
                        <button id="videoZoomOut"
                            style="background:none; border:none; color:#fff; font-size:20px; cursor:pointer; padding:0; line-height:1; display:flex; align-items:center;"
                            title="Exit fullscreen">
                            <i class="bi bi-fullscreen-exit"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <script>
        (function() {
            const carousel = document.getElementById('mainCarousel');
            if (!carousel) return;

            const animClassMap = {
                'zoom': 'caption-anim-zoom',
                'float-up': 'caption-anim-float-up',
                'wipe': 'caption-anim-wipe',
                'fade': 'caption-anim-fade',
            };

            const allAnimClasses = Object.values(animClassMap);

            function applyAnim(slideEl) {
                if (!slideEl) return;
                const animKey = slideEl.dataset.captionAnim;
                const animClass = animClassMap[animKey] || 'caption-anim-float-up';
                slideEl.classList.remove(...allAnimClasses);
                void slideEl.offsetWidth;
                slideEl.classList.add(animClass);
            }

            const firstActive = carousel.querySelector('.carousel-item.active');
            applyAnim(firstActive);

            carousel.addEventListener('slide.bs.carousel', function(e) {
                applyAnim(e.relatedTarget);
            });
        })();
    </script>

    
    <script>
        (function() {
            const mainCarousel = document.getElementById('mainCarousel');
            if (!mainCarousel) return;

            // ── Lazy-load video src only when needed ─────────────────────────────────
            function loadVideoSrc(video) {
                if (!video.querySelector('source') && video.dataset.src) {
                    const source = document.createElement('source');
                    source.src = video.dataset.src;
                    source.type = video.dataset.mime || 'video/mp4';
                    video.appendChild(source);
                    video.load();
                }
            }

            // ── Play inline video on the active slide ────────────────────────────────
            function playActiveSlideVideo(slideEl) {
                if (!slideEl) return;
                const video = slideEl.querySelector('.inline-carousel-video');
                if (!video) return;
                loadVideoSrc(video);
                video.currentTime = 0;
                video.muted = true;
                video.play().catch(() => {});
            }

            // ── Pause + mute ALL inline videos when leaving slide ────────────────────
            function pauseAllInlineVideos() {
                document.querySelectorAll('.inline-carousel-video').forEach(v => {
                    v.pause();
                    v.muted = true;
                });
                document.querySelectorAll('.inline-sound-btn').forEach(btn => {
                    btn.innerHTML = '<i class="bi bi-volume-mute-fill"></i>';
                });
            }

            // Play on first active slide on page load
            playActiveSlideVideo(mainCarousel.querySelector('.carousel-item.active'));

            // On slide change: pause outgoing, play incoming
            mainCarousel.addEventListener('slide.bs.carousel', function(e) {
                pauseAllInlineVideos();
                playActiveSlideVideo(e.relatedTarget);
            });

            // ── Zoom Modal elements ───────────────────────────────────────────────────
            const modal = document.getElementById('videoZoomModal');
            const modalVideo = document.getElementById('zoomModalVideo');
            const seekBar = document.getElementById('zoomSeekBar');
            const playPauseBtn = document.getElementById('zoomPlayPause');
            const backwardBtn = document.getElementById('zoomBackward');
            const muteToggle = document.getElementById('zoomMuteToggle');
            const timeDisplay = document.getElementById('zoomTimeDisplay');
            const closeBtn = document.getElementById('videoZoomClose');
            const zoomOutBtn = document.getElementById('videoZoomOut');

            function formatTime(s) {
                if (isNaN(s)) return '0:00';
                const m = Math.floor(s / 60);
                const sec = Math.floor(s % 60);
                return m + ':' + (sec < 10 ? '0' : '') + sec;
            }

            function updatePlayPauseBtn() {
                playPauseBtn.innerHTML = modalVideo.paused ?
                    '<i class="bi bi-play-fill"></i>' :
                    '<i class="bi bi-pause-fill"></i>';
            }

            function updateMuteBtn() {
                muteToggle.innerHTML = modalVideo.muted ?
                    '<i class="bi bi-volume-mute-fill"></i>' :
                    '<i class="bi bi-volume-up-fill"></i>';
            }

            function openZoomModal(src, mime) {
                pauseAllInlineVideos();

                const bsCarousel = bootstrap.Carousel.getInstance(mainCarousel);
                if (bsCarousel) bsCarousel.pause();

                // Always start muted in modal
                modalVideo.muted = true;
                modalVideo.innerHTML = '';
                const source = document.createElement('source');
                source.src = src;
                source.type = mime || 'video/mp4';
                modalVideo.appendChild(source);
                modalVideo.load();
                modalVideo.play().catch(() => {});

                seekBar.value = 0;
                timeDisplay.textContent = '0:00 / 0:00';

                modal.style.display = 'flex';
                updatePlayPauseBtn();
                updateMuteBtn();
            }

            function closeZoomModal() {
                modalVideo.pause();
                modalVideo.muted = true;
                modalVideo.innerHTML = '';
                modal.style.display = 'none';

                playActiveSlideVideo(mainCarousel.querySelector('.carousel-item.active'));
            }

            // Open via zoom button only
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.video-zoom-btn');
                if (!btn) return;
                e.stopPropagation();
                openZoomModal(btn.dataset.src, btn.dataset.mime);
            });

            // Close buttons
            closeBtn.addEventListener('click', closeZoomModal);
            zoomOutBtn.addEventListener('click', closeZoomModal);

            // Close on backdrop click
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeZoomModal();
            });

            // Close on Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'flex') closeZoomModal();
            });

            // Play / Pause toggle
            playPauseBtn.addEventListener('click', function() {
                modalVideo.paused ? modalVideo.play().catch(() => {}) : modalVideo.pause();
                updatePlayPauseBtn();
            });

            // -10s
            backwardBtn.addEventListener('click', function() {
                modalVideo.currentTime = Math.max(0, modalVideo.currentTime - 10);
            });

            // Mute toggle
            muteToggle.addEventListener('click', function() {
                modalVideo.muted = !modalVideo.muted;
                updateMuteBtn();
            });

            // ── Inline sound toggle ───────────────────────────────────────────────────
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.inline-sound-btn');
                if (!btn) return;
                e.stopPropagation();
                const slide = btn.closest('.dynamic-carousel-slide');
                const video = slide ? slide.querySelector('.inline-carousel-video') : null;
                if (!video) return;
                video.muted = !video.muted;
                btn.innerHTML = video.muted ?
                    '<i class="bi bi-volume-mute-fill"></i>' :
                    '<i class="bi bi-volume-up-fill"></i>';
            });

            // ── Mute ALL inline videos and reset their sound icons ────────────────────
            function muteAllInlineVideos() {
                document.querySelectorAll('.inline-carousel-video').forEach(v => {
                    v.muted = true;
                });
                document.querySelectorAll('.inline-sound-btn').forEach(btn => {
                    btn.innerHTML = '<i class="bi bi-volume-mute-fill"></i>';
                });
            }

            // ── Seek bar — completely rewritten, no pause on mousedown ────────────────
            let isScrubbing = false;

            // Track pointer down on seekbar
            seekBar.addEventListener('pointerdown', function() {
                isScrubbing = true;
                seekBar.setPointerCapture(event.pointerId);
            });

            // While dragging — seek live
            seekBar.addEventListener('pointermove', function() {
                if (!isScrubbing) return;
                const val = parseFloat(seekBar.value);
                modalVideo.currentTime = val;
                timeDisplay.textContent = formatTime(val) + ' / ' + formatTime(modalVideo.duration || 0);
            });

            // Release
            seekBar.addEventListener('pointerup', function() {
                if (!isScrubbing) return;
                isScrubbing = false;
                modalVideo.currentTime = parseFloat(seekBar.value);
            });

            // Sync bar while video plays
            modalVideo.addEventListener('timeupdate', function() {
                if (isScrubbing) return;
                if (!isNaN(modalVideo.duration) && modalVideo.duration > 0) {
                    seekBar.max = modalVideo.duration;
                    seekBar.value = modalVideo.currentTime;
                    timeDisplay.textContent = formatTime(modalVideo.currentTime) + ' / ' + formatTime(modalVideo
                        .duration);
                }
                updatePlayPauseBtn();
            });

            // Video ended
            modalVideo.addEventListener('ended', updatePlayPauseBtn);

            // Metadata loaded
            modalVideo.addEventListener('loadedmetadata', function() {
                seekBar.max = modalVideo.duration;
                timeDisplay.textContent = '0:00 / ' + formatTime(modalVideo.duration);
            });
        })();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/home.blade.php ENDPATH**/ ?>
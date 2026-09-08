

<?php $__env->startSection('title', isset($announcement) ? $announcement->title : 'Announcements'); ?>
<style>
    .top-title {
        font-family: "Anton", Arial, sans-serif;
        font-size: 38px;
        color: #107039;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        letter-spacing: 3px;
    }

    .top-title::before,
    .top-title::after {
        content: "";
        width: 200px;
        border-bottom: 2px solid #b5ccbf;
        margin: 0 50px;
    }

    .top-title::after {
        content: "";
    }
</style>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <?php if(isset($announcement)): ?>
            <!-- Detail View -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('announcement.index')); ?>">Announcements</a></li>
                            <li class="breadcrumb-item active"><?php echo e($announcement->title); ?></li>
                        </ol>
                    </nav>

                    <h1 class="mb-3"><?php echo e($announcement->title); ?></h1>

                    <?php if($announcement->published_date): ?>
                        <p class="text-muted mb-4">
                            <i class="bi bi-calendar"></i>
                            <?php echo e($announcement->published_date->format('F d, Y')); ?>

                        </p>
                    <?php endif; ?>

                    <?php if($announcement->featured_image): ?>
                        <img src="<?php echo e(asset('storage/' . $announcement->featured_image)); ?>" class="img-fluid rounded mb-4"
                            alt="<?php echo e($announcement->title); ?>">
                    <?php endif; ?>

                    <div class="content">
                        <?php echo nl2br(e($announcement->content)); ?>

                    </div>

                    <div class="mt-4">
                        <a href="<?php echo e(route('announcement.index')); ?>" class="btn btn-secondary">
                            ← Back to Announcements
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Listing View -->
            <h1 class="top-title">ANNOUNCEMENT</h1>

            <?php if($announcements->count() > 0): ?>
                <div class="row">
                    <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <?php if($item->featured_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->featured_image)); ?>" class="card-img-top"
                                        alt="<?php echo e($item->title); ?>" style="height: 200px; object-fit: cover;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($item->title); ?></h5>
                                    <?php if($item->published_date): ?>
                                        <p class="text-muted small">
                                            <i class="bi bi-calendar"></i>
                                            <?php echo e($item->published_date->format('F d, Y')); ?>

                                        </p>
                                    <?php endif; ?>
                                    <p class="card-text"><?php echo e(Str::limit($item->content, 150)); ?></p>
                                    <a href="<?php echo e(route('announcement.show', $item->slug)); ?>" class="btn btn-primary">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    No announcements available at this time. Please check back later.
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/announcement.blade.php ENDPATH**/ ?>
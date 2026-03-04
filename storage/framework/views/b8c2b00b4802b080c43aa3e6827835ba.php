
 

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Live Scoring</h1>

        
        <form method="GET" action="<?php echo e(route('livescoring.index')); ?>" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by Team Number or Name"
                        value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
                    <select name="class" class="form-control">
                        <option value="">All Classes</option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class); ?>" <?php echo e(request('class') == $class ? 'selected' : ''); ?>>
                                <?php echo e($class); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary">Filter</button>
                    <a href="<?php echo e(route('livescoring.index')); ?>" class="btn btn-light">Reset</a>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <?php
                        $sort = request('sort', 'id');
                        $direction = request('direction', 'asc');
                    ?>
                    <th><a
                            href="<?php echo e(route('livescoring.index', array_merge(request()->except('sort', 'direction'), ['sort' => 'team_number', 'direction' => $sort == 'team_number' && $direction == 'asc' ? 'desc' : 'asc']))); ?>">Team
                            #</a></th>
                    <th><a
                            href="<?php echo e(route('livescoring.index', array_merge(request()->except('sort', 'direction'), ['sort' => 'team_name', 'direction' => $sort == 'team_name' && $direction == 'asc' ? 'desc' : 'asc']))); ?>">Team
                            Name</a></th>
                    <th><a
                            href="<?php echo e(route('livescoring.index', array_merge(request()->except('sort', 'direction'), ['sort' => 'couples_grs', 'direction' => $sort == 'couples_grs' && $direction == 'asc' ? 'desc' : 'asc']))); ?>">Couples
                            GRS</a></th>
                    <th><a
                            href="<?php echo e(route('livescoring.index', array_merge(request()->except('sort', 'direction'), ['sort' => 'couples_net', 'direction' => $sort == 'couples_net' && $direction == 'asc' ? 'desc' : 'asc']))); ?>">Couples
                            NET</a></th>
                    <th><a
                            href="<?php echo e(route('livescoring.index', array_merge(request()->except('sort', 'direction'), ['sort' => 'langer_grs', 'direction' => $sort == 'langer_grs' && $direction == 'asc' ? 'desc' : 'asc']))); ?>">Langer
                            GRS</a></th>
                    <th><a
                            href="<?php echo e(route('livescoring.index', array_merge(request()->except('sort', 'direction'), ['sort' => 'langer_net', 'direction' => $sort == 'langer_net' && $direction == 'asc' ? 'desc' : 'asc']))); ?>">Langer
                            NET</a></th>
                    <th><a
                            href="<?php echo e(route('livescoring.index', array_merge(request()->except('sort', 'direction'), ['sort' => 'total_grs', 'direction' => $sort == 'total_grs' && $direction == 'asc' ? 'desc' : 'asc']))); ?>">Total
                            GRS</a></th>
                    <th><a
                            href="<?php echo e(route('livescoring.index', array_merge(request()->except('sort', 'direction'), ['sort' => 'total_net', 'direction' => $sort == 'total_net' && $direction == 'asc' ? 'desc' : 'asc']))); ?>">Total
                            NET</a></th>
                    <th><a
                            href="<?php echo e(route('livescoring.index', array_merge(request()->except('sort', 'direction'), ['sort' => 'class', 'direction' => $sort == 'class' && $direction == 'asc' ? 'desc' : 'asc']))); ?>">Class</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($entry->team_number); ?></td>
                        <td><?php echo e($entry->team_name); ?></td>
                        <td><?php echo e($entry->couples_grs); ?></td>
                        <td><?php echo e($entry->couples_net); ?></td>
                        <td><?php echo e($entry->langer_grs); ?></td>
                        <td><?php echo e($entry->langer_net); ?></td>
                        <td><?php echo e($entry->total_grs); ?></td>
                        <td><?php echo e($entry->total_net); ?></td>
                        <td><?php echo e($entry->class); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center">No entries found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php echo e($entries->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/livescoring.blade.php ENDPATH**/ ?>
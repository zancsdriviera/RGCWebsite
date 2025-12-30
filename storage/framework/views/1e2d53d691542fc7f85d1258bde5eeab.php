

<?php $__env->startSection('title', 'Courses Schedule'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/coursesched.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('images/RivieraHeaderLogo3.png')); ?>" rel="icon">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid custom-bg d-flex align-items-center p-0">
        <h1 class="text-white custom-title m-0">COURSE SCHEDULE</h1>
    </div>

    <div class="container mt-4">

        <?php
            $monthName = \Carbon\Carbon::createFromDate($year, $month, 1)->format('F');
            $prevMonth = $month - 1;
            $nextMonth = $month + 1;
            $prevYear = $year;
            $nextYear = $year;

            if ($prevMonth < 1) {
                $prevMonth = 12;
                $prevYear--;
            }
            if ($nextMonth > 12) {
                $nextMonth = 1;
                $nextYear++;
            }

            $totalDays = $startOfMonth->daysInMonth;
            $startDayOfWeek = $startOfMonth->dayOfWeek;
            $weeks = ceil(($totalDays + $startDayOfWeek) / 7);
        ?>

        <h1 class="text-center mb-3 fw-bold text-uppercase" style="color:#107039;"><?php echo e($monthName); ?> <?php echo e($year); ?>

        </h1>

        <table class="calendar-table bg-white">
            <thead>
                <tr>
                    <?php $__currentLoopData = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dayName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($dayName); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>

            <tbody>
                <?php $day = 1; ?>
                <?php for($w = 0; $w < $weeks; $w++): ?>
                    <tr>
                        <?php for($d = 0; $d < 7; $d++): ?>
                            <?php if($w == 0 && $d < $startDayOfWeek): ?>
                                <td class="empty"></td>
                            <?php elseif($day <= $totalDays): ?>
                                <?php
                                    $date = \Carbon\Carbon::createFromDate($year, $month, $day)->toDateString();
                                    $langer = $events[$date]['Langer'] ?? 'TBA';
                                    $couples = $events[$date]['Couples'] ?? 'TBA';
                                    $isToday = $date === date('Y-m-d');
                                ?>

                                <td class="<?php echo e($isToday ? 'today' : ''); ?>"
                                    onclick="openEventModal('<?php echo e($date); ?>', '<?php echo e(addslashes($langer)); ?>', '<?php echo e(addslashes($couples)); ?>')">

                                    <div class="day-number"><?php echo e($day); ?></div>
                                    <div><strong>Couples:</strong> <?php echo e($couples); ?></div>
                                    <div><strong>Langer:</strong> <?php echo e($langer); ?></div>
                                </td>

                                <?php $day++; ?>
                            <?php else: ?>
                                <td class="empty"></td>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <div class="calendar-mobile">
            <?php for($d = 1; $d <= $totalDays; $d++): ?>
                <?php
                    $date = \Carbon\Carbon::createFromDate($year, $month, $d)->toDateString();
                    $langer = $events[$date]['Langer'] ?? 'TBA';
                    $couples = $events[$date]['Couples'] ?? 'TBA';
                    $isToday = $date === date('Y-m-d');
                ?>

                <div class="mobile-day <?php echo e($isToday ? 'today' : ''); ?>"
                    onclick="openEventModal('<?php echo e($date); ?>', '<?php echo e(addslashes($langer)); ?>', '<?php echo e(addslashes($couples)); ?>')">
                    <div class="day-number"><?php echo e($d); ?></div>
                    <div><strong>Couples:</strong> <?php echo e($couples); ?></div>
                    <div><strong>Langer:</strong> <?php echo e($langer); ?></div>
                </div>
            <?php endfor; ?>
        </div>

        <div class="nav-btn-wrapper">
            <a href="<?php echo e(route('coursesched', ['month' => $prevMonth, 'year' => $prevYear])); ?>">
                <button class="nav-btn">&lt;</button>
            </a>

            <a href="<?php echo e(route('coursesched', ['month' => date('m'), 'year' => date('Y')])); ?>">
                <button class="today-btn">Today</button>
            </a>

            <a href="<?php echo e(route('coursesched', ['month' => $nextMonth, 'year' => $nextYear])); ?>">
                <button class="nav-btn">&gt;</button>
            </a>
        </div>
        <br>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <h4 class="modal-title fw-bold" id="modalTitle"></h4>
                    <br>
                    <p><strong>Couples:</strong> <span id="modalCouples"></span></p>
                    <p><strong>Langer:</strong> <span id="modalLanger"></span></p>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">CLOSE</button>
                </div>

            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            function openEventModal(date, langer, couples) {
                const dt = new Date(date + 'T00:00:00');
                const formatted = dt.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                document.getElementById('modalTitle').innerText = 'Event On ' + formatted;
                document.getElementById('modalCouples').innerText = couples;
                document.getElementById('modalLanger').innerText = langer;

                new bootstrap.Modal(document.getElementById('eventModal')).show();
            }
        </script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/coursesched.blade.php ENDPATH**/ ?>
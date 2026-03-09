

<?php $__env->startSection('title', 'Live Scores'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div id="liveScoresContainer">
            <!-- Content will be loaded via AJAX -->
        </div>
    </div>

    <!-- Required CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

    <!-- Required Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <style>
        .rank-badge {
            font-size: 1rem;
            font-weight: bold;
            min-width: 40px;
            text-align: center;
        }

        .rank-1 {
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            color: #856404;
            font-weight: bold;
        }

        .rank-2 {
            background: linear-gradient(135deg, #c0c0c0, #e8e8e8);
            color: #4a5568;
            font-weight: bold;
        }

        .rank-3 {
            background: linear-gradient(135deg, #cd7f32, #e9b171);
            color: #744210;
            font-weight: bold;
        }

        .rank-4-plus {
            background: #f8f9fa;
            color: #000000;
            font-weight: bold;
            border: 1px solid #dee2e6;
        }

        .class-badge {
            font-size: 0.9rem;
            padding: 0.35rem 0.65rem;
        }

        .filter-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
        }

        /* Center title */
        .live-title {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .live-title h2 {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 0.5rem 2rem;
            border-radius: 50px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Make team names uppercase */
        .team-name {
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Store the current filter value
            var currentClassFilter = '';

            loadLiveScores();

            // Auto-refresh every 5 seconds (kept for live updates)
            setInterval(function() {
                // Only reload if there's an active header
                if ($('#liveScoresContainer').find('.live-title').length > 0) {
                    loadLiveScores();
                }
            }, 5000);

            function loadLiveScores() {
                $.ajax({
                    url: '<?php echo e(route('live-scores.data')); ?>',
                    method: 'GET',
                    success: function(response) {
                        if (response.header) {
                            displayLiveScores(response);
                        } else {
                            $('#liveScoresContainer').html(
                                '<div class="alert alert-info text-center py-5"><i class="bi bi-info-circle-fill fs-1"></i><h3 class="mt-3">Live Scores not activated yet</h3><p class="text-muted">Please check back later.</p></div>'
                            );
                        }
                    },
                    error: function() {
                        $('#liveScoresContainer').html(
                            '<div class="alert alert-danger text-center py-5"><i class="bi bi-exclamation-triangle-fill fs-1"></i><h3 class="mt-3">Error loading live scores</h3><p class="text-muted">Please try again later.</p></div>'
                        );
                    }
                });
            }

            function displayLiveScores(data) {
                // Centered title with uppercase - NO TIMESTAMP
                var html = '<div class="live-title">';
                html += '<h2 class="fw-bold"><i class="bi bi-trophy-fill"></i> LIVE SCORES - ' + data.header.year
                    .toUpperCase() + '</h2>';
                html += '</div>';

                if (data.scores && data.scores.length > 0) {
                    // Calculate statistics
                    var totalTeams = data.scores.length;
                    var classes = {};
                    data.scores.forEach(function(score) {
                        classes[score.class] = (classes[score.class] || 0) + 1;
                    });

                    // Statistics cards
                    html += '<div class="row mb-4">';
                    html += '<div class="col-md-3 col-6 mb-3">';
                    html += '<div class="stat-card">';
                    html += '<div class="stat-value">' + totalTeams + '</div>';
                    html += '<div class="stat-label">Total Teams</div>';
                    html += '</div></div>';

                    // Class distribution
                    for (var className in classes) {
                        html += '<div class="col-md-3 col-6 mb-3">';
                        html += '<div class="stat-card">';
                        html += '<div class="stat-value">' + classes[className] + '</div>';
                        html += '<div class="stat-label">Class ' + className + '</div>';
                        html += '</div></div>';
                    }
                    html += '</div>';

                    // Filter section - with persistent filter value
                    html += '<div class="filter-card">';
                    html += '<div class="row align-items-center">';
                    html += '<div class="col-md-6">';
                    html += '<div class="d-flex align-items-center">';
                    html += '<i class="bi bi-funnel-fill me-2 text-success"></i>';
                    html += '<h5 class="mb-0">Filter by Class</h5>';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="col-md-6">';
                    html += '<select id="clientClassFilter" class="form-select">';
                    html += '<option value="">All Classes</option>';

                    var uniqueClasses = [...new Set(data.scores.map(score => score.class))].sort();
                    uniqueClasses.forEach(function(className) {
                        var selected = (currentClassFilter === className) ? 'selected' : '';
                        html += '<option value="' + className + '" ' + selected + '>Class ' + className +
                            '</option>';
                    });

                    html += '</select>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    // Table
                    html += '<div class="table-responsive">';
                    html +=
                        '<table class="table table-bordered table-hover" id="clientScoresTable" style="width:100%">';
                    html += '<thead class="table-light">';
                    html += '<tr>';
                    html += '<th>Rank</th>';
                    html += '<th>Team</th>';
                    html += '<th>Couples GRS</th>';
                    html += '<th>Langer GRS</th>';
                    html += '<th>Couples NET</th>';
                    html += '<th>Langer NET</th>';
                    html += '<th>Total GRS</th>';
                    html += '<th>Total NET</th>';
                    html += '<th>Class</th>';
                    html += '</tr>';
                    html += '</thead>';
                    html += '<tbody>';

                    // Sort scores for ranking
                    data.scores.sort(function(a, b) {
                        if (a.total_net === b.total_net) {
                            return b.total_grs - a.total_grs;
                        }
                        return b.total_net - a.total_net;
                    });

                    // Compute dense ranks (no skipping)
                    var denseRank = 0;
                    var prevNet = null;
                    var prevGrs = null;

                    data.scores.forEach(function(score) {
                        if (prevNet !== null && prevNet === score.total_net && prevGrs === score
                            .total_grs) {
                            // same rank
                        } else {
                            denseRank++;
                        }
                        prevNet = score.total_net;
                        prevGrs = score.total_grs;

                        var rankClass = '';
                        if (denseRank <= 3) {
                            if (denseRank === 1) rankClass = 'rank-1';
                            else if (denseRank === 2) rankClass = 'rank-2';
                            else if (denseRank === 3) rankClass = 'rank-3';
                        } else {
                            rankClass = 'rank-4-plus';
                        }

                        var classColor = 'bg-secondary';
                        if (score.class === 'A') classColor = 'bg-danger';
                        else if (score.class === 'B') classColor = 'bg-primary';
                        else if (score.class === 'C') classColor = 'bg-success';
                        else if (score.class === 'LADIES') classColor = 'bg-warning text-dark';
                        else if (score.class === 'SPECIAL') classColor = 'bg-info text-dark';
                        else if (score.class === 'SPONSOR') classColor = 'bg-dark';

                        html += '<tr data-class="' + score.class + '">';
                        html += '<td class="text-center"><span class="badge rank-badge ' + rankClass +
                            ' rounded-pill">#' + denseRank + '</span></td>';
                        html += '<td class="team-name">' + (score.team || '').toUpperCase() + '</td>';
                        html += '<td>' + (score.couples_grs || 0) + '</td>';
                        html += '<td>' + (score.langer_grs || 0) + '</td>';
                        html += '<td>' + (score.couples_net || 0) + '</td>';
                        html += '<td>' + (score.langer_net || 0) + '</td>';
                        html += '<td><strong>' + (score.total_grs || 0) + '</strong></td>';
                        html += '<td><strong class="text-success">' + (score.total_net || 0) +
                            '</strong></td>';
                        html += '<td><span class="badge class-badge ' + classColor + '">' + score.class +
                            '</span></td>';
                        html += '</tr>';
                    });

                    html += '</tbody>';
                    html += '</table>';
                    html += '</div>';
                } else {
                    html += '<div class="alert alert-warning text-center py-5">';
                    html += '<i class="bi bi-emoji-frown fs-1"></i>';
                    html += '<h3 class="mt-3">No scores available</h3>';
                    html += '<p class="text-muted">Check back later for updates.</p>';
                    html += '</div>';
                }

                $('#liveScoresContainer').html(html);

                // Initialize DataTable with all columns sortable
                if ($('#clientScoresTable').length > 0) {
                    var clientTable = $('#clientScoresTable').DataTable({
                        pageLength: 10,
                        lengthMenu: [
                            [10, 30, 50, 100, 300],
                            [10, 30, 50, 100, 300]
                        ],
                        order: [
                            [0, 'asc']
                        ], // Default sort by rank
                        responsive: true,
                        language: {
                            search: "Search teams:",
                            lengthMenu: "Show _MENU_ entries",
                            info: "Showing _START_ to _END_ of _TOTAL_ teams",
                            infoEmpty: "Showing 0 to 0 of 0 teams",
                            infoFiltered: "(filtered from _MAX_ total teams)",
                            paginate: {
                                first: "First",
                                last: "Last",
                                next: "Next",
                                previous: "Previous"
                            }
                        },
                        stateSave: true,
                        stateDuration: 0
                    });

                    // Apply the current filter if set
                    if (currentClassFilter) {
                        clientTable.column(8).search('^' + currentClassFilter + '$', true, false).draw();
                    }

                    // Class filter functionality - update the stored value when changed
                    $('#clientClassFilter').on('change', function() {
                        currentClassFilter = $(this).val();
                        var classValue = currentClassFilter;
                        if (classValue === '') {
                            clientTable.column(8).search('').draw();
                        } else {
                            clientTable.column(8).search('^' + classValue + '$', true, false).draw();
                        }
                    });
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/live_scores.blade.php ENDPATH**/ ?>
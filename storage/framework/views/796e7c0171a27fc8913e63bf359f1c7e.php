

<?php $__env->startSection('title', 'Live Scores Admin'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .team-name {
            text-transform: uppercase;
            font-weight: bold;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-success:disabled {
            background-color: #6c757d;
            border-color: #6c757d;
            cursor: not-allowed;
        }

        .modal-header.btn-success {
            background-color: #28a745 !important;
        }

        .table-dark {
            background-color: #343a40;
            color: #fff;
        }

        .badge.bg-success {
            background-color: #28a745 !important;
        }

        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal {
            z-index: 1050 !important;
        }

        /* Responsive action buttons — icon only on small screens */
        @media (max-width: 575.98px) {
            .btn-action .btn-label {
                display: none;
            }

            .btn-action {
                padding: 0.25rem 0.5rem;
            }
        }

        /* Save confirmation flash */
        .btn-saved {
            background-color: #155724 !important;
            border-color: #155724 !important;
        }

        /* Add Score modal — dark overlay style */
        #addScoreModal .modal-content {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }


        #addScoreModal .modal-body {
            background: #f8f9fa;
            padding: 1.5rem;
        }

        #addScoreModal .modal-footer {
            background: #f0f0f0;
            border-top: 1px solid #dee2e6;
        }

        #addScoreModal .form-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #555;
            margin-bottom: 4px;
        }

        #addScoreModal .form-control,
        #addScoreModal .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            font-size: 0.95rem;
        }

        #addScoreModal .form-control[readonly] {
            background-color: #e9ecef;
            color: #6c757d;
            font-style: italic;
        }

        /* Dark backdrop for add score modal specifically */
        #addScoreModal.modal {
            background: rgba(0, 0, 0, 0.6) !important;
        }
    </style>

    <div class="container-fluid py-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Live Scores Management</h2>
        </div>

        <!-- Success/Error Messages -->
        <div id="alertMessage" style="display: none;"></div>

        <!-- Live Scoring Headers Section -->
        <div class="card mb-4">
            <div class="card-header bg-light text-black d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Live Scoring Headers</h5>
                <?php
                    $hasHeaders = $headers->count() > 0;
                ?>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addHeaderModal"
                    id="addHeaderBtn" <?php echo e($hasHeaders ? 'disabled' : ''); ?>>
                    <i class="bi bi-plus-circle"></i> Add New Header
                </button>
            </div>
            <div class="card-body">
                <form id="bulkDeleteHeadersForm">
                    <?php echo csrf_field(); ?>
                    <div class="mb-2">
                        <button type="button" class="btn btn-danger btn-sm" id="deleteSelectedHeadersBtn"
                            style="display: none;">
                            <i class="bi bi-trash"></i> Delete Selected
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="headersTable">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50"><input type="checkbox" id="selectAllHeaders"></th>
                                    <th>Year / Title</th>
                                    <th>Status</th>
                                    <th width="200">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="headersTableBody">
                                <?php $__empty_1 = true; $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr id="header-row-<?php echo e($header->id); ?>">
                                        <td><input type="checkbox" name="header_ids[]" value="<?php echo e($header->id); ?>"
                                                class="header-checkbox"></td>
                                        <td><?php echo e($header->year); ?></td>
                                        <td>
                                            <span class="badge <?php echo e($header->status ? 'bg-success' : 'bg-secondary'); ?>">
                                                <?php echo e($header->status ? 'Active' : 'Inactive'); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit-header-btn btn-action"
                                                data-id="<?php echo e($header->id); ?>" data-year="<?php echo e($header->year); ?>"
                                                data-status="<?php echo e($header->status); ?>" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                                <span class="btn-label"> Edit</span>
                                            </button>
                                            <button class="btn btn-sm btn-danger delete-header-btn btn-action"
                                                data-id="<?php echo e($header->id); ?>" title="Delete">
                                                <i class="bi bi-trash"></i>
                                                <span class="btn-label"> Delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No headers found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

        <!-- Live Scores Section -->
        <div class="card">
            <div class="card-header bg-light text-black d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Live Scores</h5>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#addScoreModal">
                    <i class="bi bi-plus-circle"></i> Add New Score
                </button>
            </div>
            <div class="card-body">
                <form id="bulkDeleteScoresForm">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger btn-sm" id="deleteSelectedScoresBtn"
                                style="display: none;">
                                <i class="bi bi-trash"></i> Delete Selected
                            </button>
                        </div>
                        <div class="col-md-6">
                            <select id="classFilter" class="form-select form-select-sm w-auto float-end">
                                <option value="">All Classes</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="LADIES">LADIES</option>
                                <option value="SPECIAL">SPECIAL</option>
                                <option value="SPONSOR">SPONSOR</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="scoresTable" style="width:100%">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50"><input type="checkbox" id="selectAllScores"></th>
                                    <th>Rank</th>
                                    <th>Team</th>
                                    <th>Couples GRS</th>
                                    <th>Langer GRS</th>
                                    <th>Couples NET</th>
                                    <th>Langer NET</th>
                                    <th>Total GRS</th>
                                    <th>Total NET</th>
                                    <th>Class</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="scoresTableBody">
                                <?php
                                    $sortedScores = $scores
                                        ->sort(function ($a, $b) {
                                            if ($a->total_net == $b->total_net) {
                                                return $b->total_grs <=> $a->total_grs;
                                            }
                                            return $b->total_net <=> $a->total_net;
                                        })
                                        ->values();

                                    $denseRank = 0;
                                    $prevNet = null;
                                    $prevGrs = null;
                                ?>
                                <?php $__currentLoopData = $sortedScores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if (
                                            $prevNet !== null &&
                                            $prevNet == $score->total_net &&
                                            $prevGrs == $score->total_grs
                                        ) {
                                            // same rank – do nothing
                                        } else {
                                            $denseRank++;
                                        }
                                        $prevNet = $score->total_net;
                                        $prevGrs = $score->total_grs;
                                    ?>
                                    <tr id="score-row-<?php echo e($score->id); ?>">
                                        <td><input type="checkbox" name="score_ids[]" value="<?php echo e($score->id); ?>"
                                                class="score-checkbox"></td>
                                        <td><span class="badge bg-dark rounded-pill"><?php echo e($denseRank); ?></span></td>
                                        <td class="team-name"><?php echo e(strtoupper($score->team)); ?></td>
                                        <td><?php echo e($score->couples_grs); ?></td>
                                        <td><?php echo e($score->langer_grs); ?></td>
                                        <td><?php echo e($score->couples_net); ?></td>
                                        <td><?php echo e($score->langer_net); ?></td>
                                        <td><?php echo e($score->total_grs); ?></td>
                                        <td><?php echo e($score->total_net); ?></td>
                                        <td><span class="badge bg-success"><?php echo e($score->class); ?></span></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit-score-btn"
                                                data-id="<?php echo e($score->id); ?>">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger delete-score-btn"
                                                data-id="<?php echo e($score->id); ?>">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Header Modal -->
    <div class="modal fade" id="addHeaderModal" tabindex="-1" aria-labelledby="addHeaderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addHeaderModalLabel">Add Live Scoring Header</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addHeaderForm">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title</label>
                            <input type="text" name="year" class="form-control" required placeholder="e.g., 2026"
                                value="<?php echo e(date('Y')); ?>">
                            <div class="error-message" id="headerYearError"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <div class="error-message" id="headerStatusError"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="saveHeaderBtn">Save Header</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Header Modal -->
    <div class="modal fade" id="editHeaderModal" tabindex="-1" aria-labelledby="editHeaderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editHeaderModalLabel">Edit Live Scoring Header</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editHeaderForm">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" id="edit_header_id">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Year / Title</label>
                            <input type="text" name="year" id="edit_header_year" class="form-control" required>
                            <div class="error-message" id="editHeaderYearError"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" id="edit_header_status" class="form-select" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <div class="error-message" id="editHeaderStatusError"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="updateHeaderBtn">Update Header</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Score Modal -->
    <!-- Add Score Modal -->
    <div class="modal fade" id="addScoreModal" tabindex="-1" aria-labelledby="addScoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header btn-success text-white">
                    <div>
                        <h5 class="modal-title mb-0" id="addScoreModalLabel">
                            Add Live Score
                        </h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white ms-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addScoreForm">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Team</label>
                                <input type="text" name="team" class="form-control" required
                                    placeholder="Enter team name">
                                <div class="error-message" id="teamError"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Class</label>
                                <select name="class" class="form-select" required>
                                    <option value="">Select Class</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="LADIES">LADIES</option>
                                    <option value="SPECIAL">SPECIAL</option>
                                    <option value="SPONSOR">SPONSOR</option>
                                </select>
                                <div class="error-message" id="classError"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Couples GRS</label>
                                <input type="number" step="0.01" name="couples_grs" class="form-control score-input"
                                    required placeholder="0.00">
                                <div class="error-message" id="couplesGrsError"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Langer GRS</label>
                                <input type="number" step="0.01" name="langer_grs" class="form-control score-input"
                                    required placeholder="0.00">
                                <div class="error-message" id="langerGrsError"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Couples NET</label>
                                <input type="number" step="0.01" name="couples_net" class="form-control score-input"
                                    required placeholder="0.00">
                                <div class="error-message" id="couplesNetError"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Langer NET</label>
                                <input type="number" step="0.01" name="langer_net" class="form-control score-input"
                                    required placeholder="0.00">
                                <div class="error-message" id="langerNetError"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Total GRS <span
                                        class="text-muted fw-normal">(Auto-calculated)</span></label>
                                <input type="number" step="0.01" name="total_grs" class="form-control"
                                    id="add_total_grs" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Total NET <span
                                        class="text-muted fw-normal">(Auto-calculated)</span></label>
                                <input type="number" step="0.01" name="total_net" class="form-control"
                                    id="add_total_net" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="saveScoreBtn">
                        <i class="bi bi-check-circle me-1"></i>Save Score
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Score Modal -->
    <div class="modal fade" id="editScoreModal" tabindex="-1" aria-labelledby="editScoreModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editScoreModalLabel">Edit Live Score</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editScoreForm">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" id="edit_score_id">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Team</label>
                                <input type="text" name="team" id="edit_team" class="form-control" required>
                                <div class="error-message" id="editTeamError"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Class</label>
                                <select name="class" id="edit_class" class="form-select" required>
                                    <option value="">Select Class</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="LADIES">LADIES</option>
                                    <option value="SPECIAL">SPECIAL</option>
                                    <option value="SPONSOR">SPONSOR</option>
                                </select>
                                <div class="error-message" id="editClassError"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Couples GRS</label>
                                <input type="number" step="0.01" name="couples_grs" id="edit_couples_grs"
                                    class="form-control edit-score-input" required>
                                <div class="error-message" id="editCouplesGrsError"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Langer GRS</label>
                                <input type="number" step="0.01" name="langer_grs" id="edit_langer_grs"
                                    class="form-control edit-score-input" required>
                                <div class="error-message" id="editLangerGrsError"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Couples NET</label>
                                <input type="number" step="0.01" name="couples_net" id="edit_couples_net"
                                    class="form-control edit-score-input" required>
                                <div class="error-message" id="editCouplesNetError"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Langer NET</label>
                                <input type="number" step="0.01" name="langer_net" id="edit_langer_net"
                                    class="form-control edit-score-input" required>
                                <div class="error-message" id="editLangerNetError"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Total GRS</label>
                                <input type="number" step="0.01" name="total_grs" id="edit_total_grs"
                                    class="form-control" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Total NET</label>
                                <input type="number" step="0.01" name="total_net" id="edit_total_net"
                                    class="form-control" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="updateScoreBtn">Update Score</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this row?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    

    <script>
        $(document).ready(function() {

            // Initialize DataTables
            var scoresTable = $('#scoresTable').DataTable({
                pageLength: 10,
                lengthMenu: [
                    [10, 30, 50, 100, 300],
                    [10, 30, 50, 100, 300]
                ],
                order: [
                    [8, 'desc'],
                    [7, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [0, 1, 10]
                }],
                language: {
                    emptyTable: "No scores available"
                }
            });

            // Auto-calculate totals for add form
            $('.score-input').on('input', function() {
                var couples_grs = parseFloat($('input[name="couples_grs"]').val()) || 0;
                var langer_grs = parseFloat($('input[name="langer_grs"]').val()) || 0;
                var couples_net = parseFloat($('input[name="couples_net"]').val()) || 0;
                var langer_net = parseFloat($('input[name="langer_net"]').val()) || 0;
                $('#add_total_grs').val(couples_grs + langer_grs);
                $('#add_total_net').val(couples_net + langer_net);
            });

            // Auto-calculate totals for edit form
            $('.edit-score-input').on('input', function() {
                var couples_grs = parseFloat($('#edit_couples_grs').val()) || 0;
                var langer_grs = parseFloat($('#edit_langer_grs').val()) || 0;
                var couples_net = parseFloat($('#edit_couples_net').val()) || 0;
                var langer_net = parseFloat($('#edit_langer_net').val()) || 0;
                $('#edit_total_grs').val(couples_grs + langer_grs);
                $('#edit_total_net').val(couples_net + langer_net);
            });

            // Class filter
            $('#classFilter').on('change', function() {
                var classValue = $(this).val();
                if (classValue === '') {
                    scoresTable.column(9).search('').draw();
                } else {
                    scoresTable.column(9).search('^' + classValue + '$', true, false).draw();
                }
            });

            function clearValidationErrors() {
                $('.is-invalid').removeClass('is-invalid');
                $('.error-message').hide().empty();
            }

            function resetModal(modalId, formId) {
                $(formId)[0].reset();
                clearValidationErrors();
                if (modalId === '#addScoreModal') {
                    $('#add_total_grs').val('');
                    $('#add_total_net').val('');
                }
            }

            function removeModalBackdrop() {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('padding-right', '');
                $('body').css('overflow', '');
            }

            $('[data-bs-toggle="modal"]').on('click', function() {
                removeModalBackdrop();
            });

            $('.modal').on('hidden.bs.modal', function() {
                removeModalBackdrop();
            });

            $('.modal').on('show.bs.modal', function() {
                removeModalBackdrop();
            });

            $('#addScoreModal').on('hidden.bs.modal', function() {
                // Full reset so reopening immediately works without errors
                resetModal('#addScoreModal', '#addScoreForm');
                isSubmitting = false;
                $('#saveScoreBtn').prop('disabled', false).html(
                    '<i class="bi bi-check-circle me-1"></i>Save Score');
                removeModalBackdrop();
                $('[data-bs-target="#addScoreModal"]').removeClass('disabled').prop('disabled', false);
            });

            $('#editScoreModal').on('hidden.bs.modal', function() {
                resetModal('#editScoreModal', '#editScoreForm');
                removeModalBackdrop();
            });

            $('#addHeaderModal').on('hidden.bs.modal', function() {
                resetModal('#addHeaderModal', '#addHeaderForm');
                removeModalBackdrop();
            });

            $('#editHeaderModal').on('hidden.bs.modal', function() {
                resetModal('#editHeaderModal', '#editHeaderForm');
                removeModalBackdrop();
            });

            $('#deleteConfirmModal').on('hidden.bs.modal', function() {
                $(this).find('.modal-body p').text('Are you sure you want to delete this row?');
                deleteType = null;
                deleteId = null;
                deleteIds = null;
                removeModalBackdrop();
            });

            function updateHeaderButtonState() {
                $.ajax({
                    url: '<?php echo e(route('admin.live_scores.headers.list')); ?>',
                    method: 'GET',
                    success: function(headers) {
                        $('#addHeaderBtn').prop('disabled', headers && headers.length > 0);
                    }
                });
            }

            // Select All Headers
            $('#selectAllHeaders').on('change', function() {
                $('.header-checkbox').prop('checked', $(this).prop('checked'));
                toggleDeleteHeadersButton();
            });

            $(document).on('change', '.header-checkbox', function() {
                toggleDeleteHeadersButton();
            });

            function toggleDeleteHeadersButton() {
                if ($('.header-checkbox:checked').length > 0) {
                    $('#deleteSelectedHeadersBtn').show();
                } else {
                    $('#deleteSelectedHeadersBtn').hide();
                    $('#selectAllHeaders').prop('checked', false);
                }
            }

            // Select All Scores
            $('#selectAllScores').on('change', function() {
                $('.score-checkbox').prop('checked', $(this).prop('checked'));
                toggleDeleteScoresButton();
            });

            $(document).on('change', '.score-checkbox', function() {
                toggleDeleteScoresButton();
            });

            function toggleDeleteScoresButton() {
                if ($('.score-checkbox:checked').length > 0) {
                    $('#deleteSelectedScoresBtn').show();
                } else {
                    $('#deleteSelectedScoresBtn').hide();
                    $('#selectAllScores').prop('checked', false);
                }
            }

            var isSubmitting = false;

            // Add Header
            $('#saveHeaderBtn').on('click', function(e) {
                e.preventDefault();
                if (isSubmitting) return;
                clearValidationErrors();

                var formData = $('#addHeaderForm').serialize();
                var $btn = $(this);
                isSubmitting = true;
                $btn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm"></span> Saving...');

                $.ajax({
                    url: '<?php echo e(route('admin.live_scores.activate')); ?>',
                    method: 'POST',
                    data: formData,
                    success: function() {
                        $('#addHeaderModal').modal('hide');
                        removeModalBackdrop();
                        showAlert('Header added successfully', 'success');
                        $('#addHeaderBtn').prop('disabled', true);
                        isSubmitting = false;
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    },
                    error: function(xhr) {
                        isSubmitting = false;
                        $btn.prop('disabled', false).html('Save Header');
                        showAlert('Error adding header: ' + (xhr.responseJSON?.message ||
                            'Unknown error'), 'danger');
                    }
                });
            });

            // Edit Header — open modal
            $(document).on('click', '.edit-header-btn', function(e) {
                e.preventDefault();
                $('#edit_header_id').val($(this).data('id'));
                $('#edit_header_year').val($(this).data('year'));
                $('#edit_header_status').val($(this).data('status'));
                new bootstrap.Modal(document.getElementById('editHeaderModal')).show();
            });

            // Update Header
            $('#updateHeaderBtn').on('click', function(e) {
                e.preventDefault();
                if (isSubmitting) return;
                clearValidationErrors();

                var id = $('#edit_header_id').val();
                var $btn = $(this);
                isSubmitting = true;
                $btn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm"></span> Updating...');

                $.ajax({
                    url: '/admin/live-scores/header/' + id + '/edit',
                    method: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        year: $('#edit_header_year').val(),
                        status: $('#edit_header_status').val()
                    },
                    success: function() {
                        $('#editHeaderModal').modal('hide');
                        removeModalBackdrop();
                        showAlert('Header updated successfully', 'success');
                        isSubmitting = false;
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    },
                    error: function(xhr) {
                        isSubmitting = false;
                        $btn.prop('disabled', false).html('Update Header');
                        showAlert('Error updating header: ' + (xhr.responseJSON?.message ||
                            'Unknown error'), 'danger');
                    }
                });
            });

            var deleteId = null;
            var deleteType = null;
            var deleteIds = null;

            $(document).on('click', '.delete-header-btn', function(e) {
                e.preventDefault();
                deleteId = $(this).data('id');
                deleteType = 'header';
                new bootstrap.Modal(document.getElementById('deleteConfirmModal')).show();
            });

            $(document).on('click', '.delete-score-btn', function(e) {
                e.preventDefault();
                deleteId = $(this).data('id');
                deleteType = 'score';
                new bootstrap.Modal(document.getElementById('deleteConfirmModal')).show();
            });

            $('#deleteSelectedHeadersBtn').on('click', function(e) {
                e.preventDefault();
                var selectedIds = $('.header-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();
                if (selectedIds.length > 0) {
                    $('#deleteConfirmModal .modal-body p').text('Are you sure you want to delete ' +
                        selectedIds.length + ' selected headers?');
                    deleteType = 'bulk-headers';
                    deleteIds = selectedIds;
                    new bootstrap.Modal(document.getElementById('deleteConfirmModal')).show();
                }
            });

            $('#deleteSelectedScoresBtn').on('click', function(e) {
                e.preventDefault();
                var selectedIds = $('.score-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();
                if (selectedIds.length > 0) {
                    $('#deleteConfirmModal .modal-body p').text('Are you sure you want to delete ' +
                        selectedIds.length + ' selected scores?');
                    deleteType = 'bulk-scores';
                    deleteIds = selectedIds;
                    new bootstrap.Modal(document.getElementById('deleteConfirmModal')).show();
                }
            });

            // Add Score — closes after save, reopens cleanly immediately
            $('#saveScoreBtn').on('click', function(e) {
                e.preventDefault();
                if (isSubmitting) return;
                clearValidationErrors();

                var formData = $('#addScoreForm').serialize();
                var $btn = $(this);
                isSubmitting = true;
                $btn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm"></span> Saving...');

                $.ajax({
                    url: '<?php echo e(route('admin.live-scores.store')); ?>',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.scores) updateScoresTable(response.scores);

                        // Reset button first
                        isSubmitting = false;
                        $btn.prop('disabled', false).html(
                            '<i class="bi bi-check-circle me-1"></i>Save Score');

                        // Hide modal, then fully clean up so reopening works immediately
                        $('#addScoreModal').modal('hide');

                        showAlert('Score added successfully!', 'success');
                    },
                    error: function(xhr) {
                        isSubmitting = false;
                        $btn.prop('disabled', false).html(
                            '<i class="bi bi-check-circle me-1"></i>Save Score');
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            showValidationErrors(xhr.responseJSON.errors);
                        } else {
                            showAlert('Error adding score: ' + (xhr.responseJSON?.message ||
                                'Unknown error'), 'danger');
                        }
                    }
                });
            });

            // Edit Score — open modal
            $(document).on('click', '.edit-score-btn', function(e) {
                e.preventDefault();
                clearValidationErrors();
                var id = $(this).data('id');

                $.ajax({
                    url: '/admin/live-scores/' + id,
                    method: 'GET',
                    success: function(score) {
                        $('#edit_score_id').val(score.id);
                        $('#edit_team').val(score.team);
                        $('#edit_class').val(score.class);
                        $('#edit_couples_grs').val(score.couples_grs);
                        $('#edit_langer_grs').val(score.langer_grs);
                        $('#edit_couples_net').val(score.couples_net);
                        $('#edit_langer_net').val(score.langer_net);
                        $('#edit_total_grs').val(score.total_grs);
                        $('#edit_total_net').val(score.total_net);
                        new bootstrap.Modal(document.getElementById('editScoreModal')).show();
                    },
                    error: function() {
                        showAlert('Error loading score data', 'danger');
                    }
                });
            });

            // Update Score
            $('#updateScoreBtn').on('click', function(e) {
                e.preventDefault();
                if (isSubmitting) return;
                clearValidationErrors();

                var id = $('#edit_score_id').val();
                var $btn = $(this);
                isSubmitting = true;
                $btn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm"></span> Updating...');

                $.ajax({
                    url: '/admin/live-scores/update/' + id,
                    method: 'POST',
                    data: $('#editScoreForm').serialize(),
                    success: function(response) {
                        $('#editScoreModal').modal('hide');
                        removeModalBackdrop();
                        if (response.scores) updateScoresTable(response.scores);
                        isSubmitting = false;
                        $btn.prop('disabled', false).html('Update Score');
                        showAlert('Score updated successfully', 'success');
                    },
                    error: function(xhr) {
                        isSubmitting = false;
                        $btn.prop('disabled', false).html('Update Score');
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            showEditValidationErrors(xhr.responseJSON.errors);
                        } else {
                            showAlert('Error updating score: ' + (xhr.responseJSON?.message ||
                                'Unknown error'), 'danger');
                        }
                    }
                });
            });

            function showValidationErrors(errors) {
                clearValidationErrors();
                var map = {
                    team: ['#teamError', 'input[name="team"]'],
                    'class': ['#classError', 'select[name="class"]'],
                    couples_grs: ['#couplesGrsError', 'input[name="couples_grs"]'],
                    langer_grs: ['#langerGrsError', 'input[name="langer_grs"]'],
                    couples_net: ['#couplesNetError', 'input[name="couples_net"]'],
                    langer_net: ['#langerNetError', 'input[name="langer_net"]'],
                    year: ['#headerYearError', 'input[name="year"]']
                };
                for (var field in errors) {
                    if (map[field]) {
                        $(map[field][0]).html(errors[field][0]).show();
                        $(map[field][1]).addClass('is-invalid');
                    }
                }
            }

            function showEditValidationErrors(errors) {
                clearValidationErrors();
                var map = {
                    team: ['#editTeamError', '#edit_team'],
                    'class': ['#editClassError', '#edit_class'],
                    couples_grs: ['#editCouplesGrsError', '#edit_couples_grs'],
                    langer_grs: ['#editLangerGrsError', '#edit_langer_grs'],
                    couples_net: ['#editCouplesNetError', '#edit_couples_net'],
                    langer_net: ['#editLangerNetError', '#edit_langer_net']
                };
                for (var field in errors) {
                    if (map[field]) {
                        $(map[field][0]).html(errors[field][0]).show();
                        $(map[field][1]).addClass('is-invalid');
                    }
                }
            }

            // Confirm Delete
            $('#confirmDeleteBtn').on('click', function(e) {
                e.preventDefault();
                if (isSubmitting) return;

                var $btn = $(this);
                isSubmitting = true;
                $btn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm"></span> Deleting...');

                var token = '<?php echo e(csrf_token()); ?>';

                if (deleteType === 'header') {
                    $.ajax({
                        url: '/admin/live-scores/header/' + deleteId,
                        method: 'DELETE',
                        data: {
                            _token: token
                        },
                        success: function() {
                            $('#deleteConfirmModal').modal('hide');
                            removeModalBackdrop();
                            showAlert('Header deleted successfully', 'success');
                            $('#addHeaderBtn').prop('disabled', false);
                            isSubmitting = false;
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        },
                        error: function() {
                            isSubmitting = false;
                            $btn.prop('disabled', false).html('Delete');
                            showAlert('Error deleting header', 'danger');
                        }
                    });

                } else if (deleteType === 'bulk-headers') {
                    $.ajax({
                        url: '<?php echo e(route('admin.live_scores.headers.delete-selected')); ?>',
                        method: 'POST',
                        data: {
                            _token: token,
                            ids: deleteIds
                        },
                        success: function() {
                            $('#deleteConfirmModal').modal('hide');
                            removeModalBackdrop();
                            showAlert('Selected headers deleted successfully', 'success');
                            $('#addHeaderBtn').prop('disabled', false);
                            isSubmitting = false;
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        },
                        error: function() {
                            isSubmitting = false;
                            $btn.prop('disabled', false).html('Delete');
                            showAlert('Error deleting headers', 'danger');
                        }
                    });

                } else if (deleteType === 'score') {
                    $.ajax({
                        url: '/admin/live-scores/delete/' + deleteId,
                        method: 'DELETE',
                        data: {
                            _token: token
                        },
                        success: function(response) {
                            $('#deleteConfirmModal').modal('hide');
                            removeModalBackdrop();
                            if (response.scores) updateScoresTable(response.scores);
                            showAlert('Score deleted successfully', 'success');
                            isSubmitting = false;
                            $btn.prop('disabled', false).html('Delete');
                        },
                        error: function() {
                            isSubmitting = false;
                            $btn.prop('disabled', false).html('Delete');
                            showAlert('Error deleting score', 'danger');
                        }
                    });

                } else if (deleteType === 'bulk-scores') {
                    $.ajax({
                        url: '<?php echo e(route('admin.live_scores.delete_selected')); ?>',
                        method: 'DELETE',
                        data: {
                            _token: token,
                            ids: deleteIds
                        },
                        success: function(response) {
                            $('#deleteConfirmModal').modal('hide');
                            removeModalBackdrop();
                            if (response.scores) updateScoresTable(response.scores);
                            showAlert('Selected scores deleted successfully', 'success');
                            isSubmitting = false;
                            $btn.prop('disabled', false).html('Delete');
                        },
                        error: function() {
                            isSubmitting = false;
                            $btn.prop('disabled', false).html('Delete');
                            showAlert('Error deleting scores', 'danger');
                        }
                    });
                }
            });

            function updateScoresTable(scores) {
                scoresTable.clear();

                if (scores && scores.length > 0) {
                    scores.sort(function(a, b) {
                        if (a.total_net === b.total_net) return b.total_grs - a.total_grs;
                        return b.total_net - a.total_net;
                    });

                    var denseRank = 0,
                        prevNet = null,
                        prevGrs = null,
                        rows = [];

                    scores.forEach(function(score) {
                        if (prevNet !== null && prevNet === score.total_net && prevGrs === score
                            .total_grs) {
                            // same rank
                        } else {
                            denseRank++;
                        }
                        prevNet = score.total_net;
                        prevGrs = score.total_grs;

                        rows.push([
                            '<input type="checkbox" name="score_ids[]" value="' + score.id +
                            '" class="score-checkbox">',
                            '<span class="badge bg-dark rounded-pill">' + denseRank + '</span>',
                            (score.team || '').toUpperCase(),
                            score.couples_grs || 0,
                            score.langer_grs || 0,
                            score.couples_net || 0,
                            score.langer_net || 0,
                            score.total_grs || 0,
                            score.total_net || 0,
                            '<span class="badge bg-success">' + (score.class || '') + '</span>',
                            '<button class="btn btn-sm btn-primary edit-score-btn" data-id="' +
                            score.id + '"><i class="bi bi-pencil-square"></i> Edit</button> ' +
                            '<button class="btn btn-sm btn-danger delete-score-btn" data-id="' +
                            score.id + '"><i class="bi bi-trash"></i> Delete</button>'
                        ]);
                    });

                    scoresTable.rows.add(rows);
                }

                scoresTable.draw();

                $('#selectAllScores').off('change').on('change', function() {
                    $('.score-checkbox').prop('checked', $(this).prop('checked'));
                    toggleDeleteScoresButton();
                });

                $(document).off('change', '.score-checkbox').on('change', '.score-checkbox', function() {
                    toggleDeleteScoresButton();
                });

                var currentFilter = $('#classFilter').val();
                if (currentFilter) {
                    scoresTable.column(9).search('^' + currentFilter + '$', true, false).draw();
                }
            }

            function showAlert(message, type) {
                var alertDiv = $('#alertMessage');
                alertDiv.html(
                    '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                    '</div>'
                ).show();
                setTimeout(function() {
                    alertDiv.fadeOut();
                }, 3000);
            }

            $(document).on('click', '[data-bs-target="#addScoreModal"]', function() {
                removeModalBackdrop();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/admin/admin_live_scores.blade.php ENDPATH**/ ?>
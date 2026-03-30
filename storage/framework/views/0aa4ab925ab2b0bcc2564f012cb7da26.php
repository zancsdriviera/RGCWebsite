

<?php $__env->startSection('title', 'Live Scores'); ?>

<?php $__env->startSection('content'); ?>
    <div class="ls-page">
        <div class="ls-bg-texture"></div>
        <div class="container-fluid py-4 px-3 px-md-4 position-relative" style="z-index:1">
            <div id="liveScoresContainer"></div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Nunito:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════════════
       BRAND PALETTE
    ═══════════════════════════════════════════════ */
        :root {
            --dk-green: #107039;
            --lt-green: #599D2C;
            --blue: #00AEEF;
            --black: #202123;
            --page-bg: #FFFFFF;
            --card-bg: #FFFFFF;
            --card-alt: #F4F9F5;
            --input-bg: #F4F9F5;
            --green-glow: rgba(16, 112, 57, .2);
            --text-main: #202123;
            --text-body: #3A4A40;
            --muted: #7A8F82;
            --border: rgba(16, 112, 57, .18);
            --border-blue: rgba(0, 174, 239, .25);
            --gold: #C9971C;
            --gold-lt: #E8C04A;
            --silver: #8A9BA8;
            --silver-lt: #BDD0D9;
            --bronze: #A0693A;
            --bronze-lt: #D49060;
        }

        /* ═══════════════════════════════════════════════
       PAGE
    ═══════════════════════════════════════════════ */
        .ls-page {
            min-height: 100vh;
            background: var(--page-bg);
            position: relative;
            overflow-x: hidden;
        }

        .ls-bg-texture {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background:
                repeating-linear-gradient(130deg, transparent, transparent 34px, rgba(16, 112, 57, .025) 34px, rgba(16, 112, 57, .025) 68px),
                radial-gradient(ellipse 55% 50% at 0% 0%, rgba(16, 112, 57, .08) 0%, transparent 70%),
                radial-gradient(ellipse 45% 40% at 100% 100%, rgba(0, 174, 239, .06) 0%, transparent 65%);
        }

        /* ═══════════════════════════════════════════════
       TYPOGRAPHY
    ═══════════════════════════════════════════════ */
        body {
            font-family: 'Nunito', sans-serif;
        }

        /* ═══════════════════════════════════════════════
       TITLE
    ═══════════════════════════════════════════════ */
        .ls-title {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: .9rem;
            flex-wrap: wrap;
        }

        .flag-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--dk-green), var(--lt-green));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 0 20px var(--green-glow);
            flex-shrink: 0;
        }

        .ls-title h2 {
            font-family: 'Oswald', sans-serif;
            font-size: clamp(1.1rem, 4vw, 2rem);
            font-weight: 700;
            color: var(--black);
            margin: 0;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .ls-title h2 em {
            font-style: normal;
            color: var(--dk-green);
        }

        .badge-live {
            background: #D94F3D;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .14em;
            padding: 3px 10px;
            border-radius: 3px;
            animation: blink 1.5s ease-in-out infinite;
            white-space: nowrap;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .35
            }
        }

        .ls-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--dk-green) 20%, var(--lt-green) 50%, var(--blue) 80%, transparent 100%);
            margin-bottom: 1.5rem;
            border-radius: 2px;
        }

        /* ═══════════════════════════════════════════════
       STAT CARDS
    ═══════════════════════════════════════════════ */
        .stat-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 1.4rem;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px 20px;
            min-width: 110px;
            flex: 1 1 110px;
            transition: border-color .25s, transform .2s, box-shadow .25s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(16, 112, 57, .07);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--dk-green), var(--lt-green));
            border-radius: 10px 10px 0 0;
        }

        .stat-card:hover {
            border-color: rgba(89, 157, 44, .45);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(16, 112, 57, .14);
        }

        .stat-value {
            font-family: 'Oswald', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dk-green);
            line-height: 1;
        }

        .stat-label {
            font-size: .8rem;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--black);
            margin-top: 5px;
        }

        /* ═══════════════════════════════════════════════
       FILTER BAR
    ═══════════════════════════════════════════════ */
        .filter-bar {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-left: 3px solid var(--blue);
            border-radius: 10px;
            padding: 12px 18px;
            margin-bottom: 1.4rem;
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            box-shadow: 0 2px 8px rgba(0, 174, 239, .07);
        }

        .filter-bar label {
            font-family: 'Nunito', sans-serif;
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--blue);
            white-space: nowrap;
            font-weight: 700;
        }

        .filter-bar select {
            background: var(--input-bg);
            border: 1px solid var(--border-blue);
            color: var(--text-main);
            border-radius: 7px;
            padding: 6px 14px;
            font-family: 'Nunito', sans-serif;
            font-size: .84rem;
            min-width: 160px;
            transition: border-color .2s, box-shadow .2s;
        }

        .filter-bar select:focus {
            border-color: var(--blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 174, 239, .15);
        }

        .filter-bar select option {
            background: #fff;
            color: var(--text-main);
        }

        @media (max-width: 480px) {
            .filter-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-bar select {
                min-width: 100%;
            }
        }

        /* ═══════════════════════════════════════════════
       TABLE WRAP
    ═══════════════════════════════════════════════ */
        .table-wrap {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(16, 112, 57, .08);
        }

        /* ── DataTables controls ── */
        .dataTables_wrapper {
            padding: 16px 20px;
        }

        /* Top row: length + filter side by side, wrap on small screens */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            color: var(--muted);
            font-size: .8rem;
            font-family: 'Nunito', sans-serif;
        }

        .dataTables_wrapper .dataTables_length select {
            background: var(--input-bg);
            border: 1px solid var(--border);
            color: var(--text-main);
            border-radius: 7px;
            padding: 6px 10px;
            font-family: 'Nunito', sans-serif;
            font-size: .84rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            background: var(--input-bg);
            border: 1px solid var(--border);
            color: var(--text-main);
            border-radius: 7px;
            padding: 6px 10px;
            font-family: 'Nunito', sans-serif;
            font-size: .84rem;
            /* stretch to fill available space */
            width: 200px;
            transition: width .25s, border-color .2s, box-shadow .2s;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 174, 239, .12);
            width: 260px;
        }

        .dataTables_wrapper .dataTables_filter input::placeholder {
            color: var(--muted);
        }

        /* ── PAGINATION BUTTONS — original style ── */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: var(--muted) !important;
            border-radius: 6px !important;
            border: none !important;
            font-family: 'Nunito', sans-serif;
            padding: 4px 10px !important;
            transition: background .15s !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(135deg, var(--dk-green), var(--lt-green)) !important;
            color: #fff !important;
            font-weight: 700;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
            background: var(--card-alt) !important;
            color: var(--text-main) !important;
        }


        /* ── RESPONSIVE: stack everything on small screens ── */
        @media (max-width: 600px) {
            .dataTables_wrapper {
                padding: 12px 14px;
            }

            /* Stack length and filter vertically */
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none !important;
                text-align: left !important;
                display: block;
                width: 100% !important;
                margin-bottom: 8px;
            }

            /* Search label + input fill full width */
            .dataTables_wrapper .dataTables_filter label {
                display: flex;
                align-items: center;
                gap: 8px;
                width: 100%;
            }

            .dataTables_wrapper .dataTables_filter input,
            .dataTables_wrapper .dataTables_filter input:focus {
                width: 100% !important;
                flex: 1;
                min-width: 0;
            }

            /* Length dropdown row fills width */
            .dataTables_wrapper .dataTables_length label {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .dataTables_wrapper .dataTables_length select {
                flex: 1;
            }

            /* Info + pagination center-aligned */
            .dataTables_wrapper .dataTables_info {
                float: none !important;
                text-align: center !important;
                padding-top: 6px !important;
                width: 100% !important;
            }

            .dataTables_wrapper .dataTables_paginate {
                float: none !important;
                text-align: center !important;
                padding-top: 6px !important;
                width: 100% !important;
            }
        }

        /* ═══════════════════════════════════════════════
       TABLE — horizontal scroll on mobile
    ═══════════════════════════════════════════════ */
        .table-scroll {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-scroll::-webkit-scrollbar {
            height: 5px;
        }

        .table-scroll::-webkit-scrollbar-track {
            background: var(--card-alt);
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: var(--dk-green);
            border-radius: 3px;
        }

        #clientScoresTable {
            border-collapse: collapse;
            width: 100%;
            min-width: 660px;
        }

        #clientScoresTable thead th {
            background: var(--dk-green);
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: 13px 14px;
            border-bottom: 2px solid var(--lt-green);
            border-top: none;
            white-space: nowrap;
        }

        #clientScoresTable thead th.sorting_asc,
        #clientScoresTable thead th.sorting_desc {
            color: var(--gold-lt);
        }

        #clientScoresTable tbody tr {
            border-bottom: 1px solid rgba(16, 112, 57, .1);
            transition: background .18s;
        }

        #clientScoresTable tbody tr:hover {
            background: rgba(89, 157, 44, .07);
        }

        #clientScoresTable tbody tr:nth-child(even) {
            background: var(--card-alt);
        }

        #clientScoresTable tbody tr:nth-child(even):hover {
            background: rgba(89, 157, 44, .07);
        }

        #clientScoresTable tbody tr.row-rank-1 {
            background: rgba(201, 151, 28, .08);
        }

        #clientScoresTable tbody tr.row-rank-2 {
            background: rgba(138, 155, 168, .07);
        }

        #clientScoresTable tbody tr.row-rank-3 {
            background: rgba(160, 105, 58, .07);
        }

        #clientScoresTable tbody td {
            padding: 11px 14px;
            vertical-align: middle;
            font-size: .87rem;
            font-family: 'Nunito', sans-serif;
            color: var(--text-body);
            border: none;
            white-space: nowrap;
        }

        /* ═══════════════════════════════════════════════
       RANK BADGES
    ═══════════════════════════════════════════════ */
        .rank-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 28px;
            border-radius: 7px;
            font-size: .82rem;
            font-weight: 700;
            font-family: 'Oswald', sans-serif;
            padding: 0 8px;
            letter-spacing: .04em;
        }

        .rank-1 {
            background: linear-gradient(135deg, var(--gold), var(--gold-lt));
            color: #3A2800;
            box-shadow: 0 2px 12px rgba(201, 151, 28, .45);
        }

        .rank-2 {
            background: linear-gradient(135deg, var(--silver), var(--silver-lt));
            color: #1A2A32;
            box-shadow: 0 2px 8px rgba(138, 155, 168, .35);
        }

        .rank-3 {
            background: linear-gradient(135deg, var(--bronze), var(--bronze-lt));
            color: #2A1000;
            box-shadow: 0 2px 8px rgba(160, 105, 58, .35);
        }

        .rank-other {
            background: #EAEFF2;
            color: #6A7F8A;
            border: 1px solid #D0DAE0;
        }

        /* TEAM */
        .team-name {
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: var(--black);
        }

        /* SCORES */
        .score-total-grs {
            font-weight: 600;
            color: var(--text-body);
        }

        .score-total-net {
            font-weight: 700;
            color: var(--blue);
        }

        /* ═══════════════════════════════════════════════
       CLASS BADGES
    ═══════════════════════════════════════════════ */
        .class-badge {
            font-size: .68rem;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            letter-spacing: .07em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .cls-A {
            background: rgba(217, 79, 61, .12);
            color: #C0392B;
            border: 1px solid rgba(217, 79, 61, .3);
        }

        .cls-B {
            background: rgba(0, 174, 239, .12);
            color: #0086C9;
            border: 1px solid rgba(0, 174, 239, .3);
        }

        .cls-C {
            background: rgba(89, 157, 44, .12);
            color: #3E7A10;
            border: 1px solid rgba(89, 157, 44, .35);
        }

        .cls-LADIES {
            background: rgba(201, 151, 28, .12);
            color: #8B6A00;
            border: 1px solid rgba(201, 151, 28, .3);
        }

        .cls-SPECIAL {
            background: rgba(16, 112, 57, .12);
            color: #107039;
            border: 1px solid rgba(16, 112, 57, .35);
        }

        .cls-SPONSOR {
            background: rgba(126, 58, 191, .12);
            color: #6B21A8;
            border: 1px solid rgba(126, 58, 191, .3);
        }

        .cls-other {
            background: rgba(0, 0, 0, .06);
            color: var(--muted);
            border: 1px solid rgba(0, 0, 0, .1);
        }

        /* ═══════════════════════════════════════════════
       STATES
    ═══════════════════════════════════════════════ */
        .state-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 60px 24px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(16, 112, 57, .07);
        }

        .state-card .icon {
            font-size: 2.5rem;
            margin-bottom: 14px;
        }

        .state-card h3 {
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--black);
            font-size: 1.4rem;
            margin-bottom: 8px;
        }

        .state-card p {
            color: var(--muted);
            font-size: .88rem;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            var currentClassFilter = '';

            loadLiveScores();
            setInterval(function() {
                if ($('#liveScoresContainer').find('.ls-title').length > 0) loadLiveScores();
            }, 5000);

            function loadLiveScores() {
                $.ajax({
                    url: '<?php echo e(route('live-scores.data')); ?>',
                    method: 'GET',
                    success: function(r) {
                        if (r.header) displayLiveScores(r);
                        else $('#liveScoresContainer').html(
                            '<div class="state-card"><div class="icon">⛳</div><h3>Live Scores Not Activated Yet</h3><p>Please check back when the round begins.</p></div>'
                            );
                    },
                    error: function() {
                        $('#liveScoresContainer').html(
                            '<div class="state-card"><div class="icon">⚠️</div><h3>Error Loading Scores</h3><p>Please try again later.</p></div>'
                            );
                    }
                });
            }

            function displayLiveScores(data) {
                var html = '<div class="ls-title">';
                html += '<div class="flag-icon">⛳</div>';
                html += '<h2>Live Scores &mdash; <em>' + data.header.year.toUpperCase() + '</em></h2>';
                html += '<span class="badge-live">● LIVE</span>';
                html += '</div>';
                html += '<div class="ls-divider"></div>';

                if (data.scores && data.scores.length > 0) {
                    var classes = {};
                    data.scores.forEach(function(s) {
                        classes[s.class] = (classes[s.class] || 0) + 1;
                    });

                    html += '<div class="stat-grid">';
                    html += '<div class="stat-card"><div class="stat-value">' + data.scores.length +
                        '</div><div class="stat-label">Total Teams</div></div>';
                    for (var cn in classes) {
                        html += '<div class="stat-card"><div class="stat-value">' + classes[cn] +
                            '</div><div class="stat-label">Class ' + cn + '</div></div>';
                    }
                    html += '</div>';

                    html += '<div class="filter-bar">';
                    html += '<label>⛳ Filter by Class</label>';
                    html += '<select id="clientClassFilter"><option value="">All Classes</option>';
                    [...new Set(data.scores.map(s => s.class))].sort().forEach(function(cn) {
                        html += '<option value="' + cn + '"' + (currentClassFilter === cn ? ' selected' :
                            '') + '>Class ' + cn + '</option>';
                    });
                    html += '</select></div>';

                    data.scores.sort(function(a, b) {
                        return b.total_net !== a.total_net ? b.total_net - a.total_net : b.total_grs - a
                            .total_grs;
                    });
                    var denseRank = 0,
                        prevNet = null,
                        prevGrs = null;

                    html += '<div class="table-wrap"><table id="clientScoresTable" style="width:100%">';
                    html +=
                        '<thead><tr><th>Rank</th><th>Team</th><th>Couples GRS</th><th>Langer GRS</th><th>Couples NET</th><th>Langer NET</th><th>Total GRS</th><th>Total NET</th><th>Class</th></tr></thead><tbody>';

                    data.scores.forEach(function(score) {
                        if (prevNet === null || score.total_net !== prevNet || score.total_grs !== prevGrs)
                            denseRank++;
                        prevNet = score.total_net;
                        prevGrs = score.total_grs;

                        var rankCls = denseRank === 1 ? 'rank-1' : denseRank === 2 ? 'rank-2' :
                            denseRank === 3 ? 'rank-3' : 'rank-other';
                        var rowCls = denseRank <= 3 ? ' class="row-rank-' + denseRank + '"' : '';
                        var clsKey = ['A', 'B', 'C', 'LADIES', 'SPECIAL', 'SPONSOR'].includes(score.class) ?
                            score.class : 'other';

                        html += '<tr' + rowCls + ' data-class="' + score.class + '">';
                        html += '<td class="text-center" data-order="' + denseRank +
                            '"><span class="rank-badge ' + rankCls + '">#' + denseRank + '</span></td>';
                        html += '<td class="team-name">' + (score.team || '').toUpperCase() + '</td>';
                        html += '<td>' + (score.couples_grs || 0) + '</td>';
                        html += '<td>' + (score.langer_grs || 0) + '</td>';
                        html += '<td>' + (score.couples_net || 0) + '</td>';
                        html += '<td>' + (score.langer_net || 0) + '</td>';
                        html += '<td class="score-total-grs">' + (score.total_grs || 0) + '</td>';
                        html += '<td class="score-total-net">' + (score.total_net || 0) + '</td>';
                        html += '<td><span class="class-badge cls-' + clsKey + '">' + score.class +
                            '</span></td>';
                        html += '</tr>';
                    });

                    html += '</tbody></table></div>';
                } else {
                    html +=
                        '<div class="state-card"><div class="icon">😔</div><h3>No Scores Available Yet</h3><p>Check back later for updates.</p></div>';
                }

                $('#liveScoresContainer').html(html);

                if ($('#clientScoresTable').length > 0) {
                    var tbl = $('#clientScoresTable').DataTable({
                        pageLength: 10,
                        lengthMenu: [
                            [10, 30, 50, 100, 300],
                            [10, 30, 50, 100, 300]
                        ],
                        order: [
                            [0, 'asc']
                        ],
                        responsive: true,
                        columnDefs: [{
                            targets: 0,
                            type: 'num',
                            orderDataType: 'dom-data'
                        }],
                        language: {
                            search: "Search teams:",
                            lengthMenu: "Show _MENU_ entries",
                            info: "Showing _START_ to _END_ of _TOTAL_ teams",
                            infoEmpty: "No teams found",
                            infoFiltered: "(filtered from _MAX_ total)",
                            paginate: {
                                first: "«",
                                last: "»",
                                next: "›",
                                previous: "‹"
                            }
                        },
                        stateSave: true,
                        stateDuration: 0
                    });

                    // Move the table into a scroll wrapper so the scrollbar
                    // sits ABOVE pagination (not below the whole card)
                    var $table = $('#clientScoresTable');
                    if (!$table.parent().hasClass('table-scroll')) {
                        $table.wrap('<div class="table-scroll"></div>');
                    }

                    $.fn.dataTable.ext.order['dom-data'] = function(settings, col) {
                        return this.api().column(col, {
                            order: 'index'
                        }).nodes().map(function(td) {
                            return $('td', $(td).closest('tr')).eq(col).data('order') || 0;
                        });
                    };

                    if (currentClassFilter) tbl.column(8).search('^' + currentClassFilter + '$', true, false)
                .draw();

                    $('#clientClassFilter').on('change', function() {
                        currentClassFilter = $(this).val();
                        tbl.column(8).search(currentClassFilter ? '^' + currentClassFilter + '$' : '', !!
                            currentClassFilter, false).draw();
                    });
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\app\resources\views/live_scores.blade.php ENDPATH**/ ?>
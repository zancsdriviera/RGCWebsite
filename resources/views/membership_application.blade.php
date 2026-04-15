@extends('layouts.app')
@section('title', 'Membership Application — Riviera Golf Club')

@push('styles')
    <link href="{{ asset('css/membership.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/RivieraHeaderLogo3.png') }}">
    <style>
        /* ═══════════════════════════════════════════════════════
           BASE LETTER STYLES
        ═══════════════════════════════════════════════════════ */
        .letter-outer-wrap {
            background: #e8ebe8;
            padding: 0 0 40px;
        }

        /* Each page is a separate card */
        .lp-page {
            max-width: 860px;
            margin: 0 auto 24px;
            background: #fff;
            box-shadow: 0 4px 32px rgba(0, 0, 0, .13);
            font-family: 'Lato', Arial, sans-serif;
            font-size: 13.5px;
            color: #111;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .lp-header {
            background: linear-gradient(to right, #1b5e20, #2e7d32);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 14px;
            flex-shrink: 0;
        }

        .lp-header img {
            height: 54px;
        }

        .lp-header-txt {
            color: #fff;
        }

        .lp-header-txt h2 {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 3px;
        }

        .lp-header-txt p {
            margin: 2px 0 0;
            font-size: .82rem;
            letter-spacing: 1.5px;
            opacity: .9;
        }

        .lp-accent {
            height: 5px;
            background: linear-gradient(to right, #4caf50, #81c784, #4caf50);
            flex-shrink: 0;
        }

        /* Body */
        .lp-body {
            padding: 22px 28px 24px;
            flex: 1;
        }

        /* Footer bar — always at bottom */
        .lp-footer-bar {
            height: 12px;
            background: #1b5e20;
            margin-top: auto;
            flex-shrink: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Pages 2 & 3 top bars — green bar + accent, no logo */
        .lp-top-bars {
            background: #1b5e20;
            height: 5px;
            flex-shrink: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .lp-top-bars::after {
            content: '';
            display: block;
            height: 3px;
            background: linear-gradient(to right, #4caf50, #81c784, #4caf50);
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Intro row */
        .lp-intro-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .lp-intro-txt {
            font-size: .9rem;
            line-height: 1.75;
            max-width: 300px;
        }

        .lp-intro-txt strong {
            display: block;
            font-size: 1rem;
            margin-bottom: 4px;
            font-weight: 700;
        }

        .lp-meta-right {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .lp-log-stack {
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-width: 160px;
        }

        .lp-log-lbl {
            font-size: .78rem;
            color: #333;
            font-weight: 700;
            display: block;
            margin-bottom: 3px;
        }

        .lp-log-line {
            border-bottom: 1.5px solid #333;
            min-height: 18px;
        }

        .lp-photo-box {
            width: 90px;
            height: 110px;
            border: 1.5px solid #333;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .78rem;
            color: #888;
            text-align: center;
            overflow: hidden;
            flex-shrink: 0;
            font-weight: 600;
        }

        .lp-photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Section header */
        .lp-sec {
            background: linear-gradient(to right, #1b5e20, #2e7d32);
            color: #fff;
            font-weight: 700;
            font-size: .82rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 7px 0 7px 14px;
            margin-bottom: 14px;
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .lp-sec-accent {
            display: block;
            width: 12px;
            background: #81c784;
            flex-shrink: 0;
        }

        /* Field rows — Label: [value underline] */
        .lp-row {
            display: flex;
            align-items: flex-end;
            gap: 10px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .lp-lbl {
            font-weight: 700;
            font-size: .86rem;
            white-space: nowrap;
            flex-shrink: 0;
            padding-bottom: 2px;
        }

        .lp-val {
            flex: 1;
            border-bottom: 1.5px solid #333;
            min-height: 21px;
            font-size: .9rem;
            padding-bottom: 2px;
            min-width: 50px;
        }

        .lp-val.sm {
            flex: none;
            width: 110px;
        }

        .lp-val.md {
            flex: none;
            width: 185px;
        }

        .lp-val.lg {
            flex: none;
            width: 260px;
        }

        /* Name group with sub-labels */
        .lp-name-group {
            display: flex;
            gap: 10px;
            flex: 1;
        }

        .lp-name-col {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .lp-name-col .lp-val {
            min-height: 22px;
        }

        .lp-name-col .lp-sub {
            font-size: .78rem;
            font-weight: bold;
            color: #111;
            font-style: italic;
            margin-top: 3px;
            text-align: center;
        }

        /* Tables */
        .lp-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            font-size: .88rem;
        }

        .lp-table thead tr {
            background: #1b5e20;
            color: #fff;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .lp-table thead th {
            padding: 8px 12px;
            text-align: center;
            font-weight: 700;
            letter-spacing: .3px;
        }

        .lp-table tbody tr:nth-child(odd) {
            background: #d4e9d4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .lp-table tbody tr:nth-child(even) {
            background: #fff;
        }

        .lp-table tbody td {
            padding: 7px 12px;
            text-align: center;
        }

        /* Bullets */
        .lp-class-lbl {
            font-weight: 700;
            font-size: .95rem;
            margin-bottom: 8px;
        }

        .lp-bullets {
            display: flex;
            gap: 0 48px;
            flex-wrap: wrap;
            margin-bottom: 10px;
            padding-left: 10px;
        }

        .lp-bullet-col {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .lp-bullet-item {
            font-size: .9rem;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .lp-bullet-item::before {
            content: '•';
            font-size: 1rem;
        }

        .lp-pref {
            font-size: .9rem;
            margin: 6px 0 8px;
        }

        .lp-pref strong {
            font-weight: 700;
        }

        .lp-note {
            font-size: .85rem;
            line-height: 1.65;
            color: #333;
            margin-bottom: 10px;
        }

        .lp-decl {
            font-size: .85rem;
            line-height: 1.8;
            color: #333;
            text-align: justify;
            margin: 12px 0;
        }

        /* Horizontal divider */
        .lp-hr {
            border: none;
            border-top: 2px solid #555;
            margin: 18px 0;
        }

        /* Signature */
        .lp-sig-right {
            display: flex;
            justify-content: flex-end;
            margin-top: 28px;
        }

        .lp-sig-block {
            text-align: center;
        }

        .lp-sig-line {
            border-top: 1.5px solid #333;
            width: 210px;
            margin-bottom: 5px;
        }

        .lp-sig-name {
            font-weight: 700;
            font-size: .88rem;
            margin: 0;
        }

        .lp-sig-sub {
            font-size: .78rem;
            color: #555;
        }

        /* Corporate note — READABLE */
        .lp-corp-note {
            font-size: .88rem;
            color: #111;
            font-weight: bold;
            font-style: italic;
            text-align: center;
            margin-bottom: 16px;
        }

        /* Endorsement */
        .lp-endorse-hdr {
            font-weight: 700;
            font-size: .95rem;
            margin-bottom: 4px;
        }

        .lp-endorse-sub {
            font-size: .88rem;
            font-weight: bold;
            color: #111;
            font-style: italic;
            margin-bottom: 16px;
        }

        .lp-endorse-grid {
            display: flex;
            gap: 32px;
        }

        .lp-endorse-col {
            flex: 1;
        }

        .lp-endorse-sig {
            margin-top: 28px;
            border-top: 1.5px solid #333;
            padding-top: 5px;
            font-weight: 700;
            font-size: .84rem;
        }

        /* Committee */
        .lp-comm-title {
            font-weight: 700;
            font-size: 1.05rem;
            margin: 8px 0 6px;
        }

        .lp-approve {
            display: flex;
            gap: 20px;
            margin-bottom: 26px;
            font-size: .92rem;
        }

        .lp-approve-item {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .lp-approve-box {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 1.5px solid #333;
            flex-shrink: 0;
        }

        .lp-comm-sigs {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 24px;
        }

        .lp-chairman {
            text-align: center;
        }

        .lp-chairman-line {
            border-top: 1.5px solid #333;
            width: 220px;
            margin-bottom: 5px;
        }

        .lp-chairman-name {
            font-weight: 700;
            font-size: .88rem;
        }

        .lp-chairman-role {
            font-size: .82rem;
            color: #444;
        }

        .lp-members-row {
            display: flex;
            gap: 32px;
        }

        .lp-member {
            text-align: center;
        }

        .lp-member-line {
            border-top: 1.5px solid #333;
            width: 160px;
            margin-bottom: 5px;
        }

        .lp-member-name {
            font-weight: 700;
            font-size: .84rem;
        }

        .lp-member-role {
            font-size: .8rem;
            color: #444;
        }

        /* Action buttons */
        .app-actions-bar {
            display: flex;
            justify-content: center;
            gap: 12px;
            padding: 24px 20px 16px;
            background: #eef0ee;
        }

        .btn-app-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 26px;
            border-radius: 4px;
            font-family: 'Lato', sans-serif;
            font-weight: 700;
            font-size: .9rem;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: filter .2s, transform .15s;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .12);
        }

        .btn-app-action:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }

        .btn-print {
            background: #1b5e20;
            color: #fff;
        }

        .btn-download {
            background: #1565c0;
            color: #fff;
        }

        .btn-cancel {
            background: #616161;
            color: #fff;
        }

        /* ═══════════════════════════════════════════════════════
           PRINT STYLES
        ═══════════════════════════════════════════════════════ */
        @media print {
            body * {
                visibility: hidden;
            }

            #rgcLetterWrap,
            #rgcLetterWrap * {
                visibility: visible;
            }

            .app-actions-bar,
            nav,
            header,
            footer,
            .navbar,
            .topbar,
            .sidebar,
            .no-print {
                display: none !important;
            }

            body {
                background: #fff !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .letter-outer-wrap {
                background: #fff !important;
                padding: 0 !important;
            }

            #rgcLetterWrap {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }

            .lp-page {
                max-width: 100% !important;
                box-shadow: none !important;
                margin: 0 !important;
                page-break-after: always;
                break-after: page;
            }

            .lp-page:last-child {
                page-break-after: auto;
                break-after: auto;
            }

            /* Footer — fixed to bottom of each printed page */
            .lp-footer-bar {
                position: fixed !important;
                bottom: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 12px !important;
                background: #1b5e20 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .lp-header,
            .lp-accent,
            .lp-sec,
            .lp-table thead tr {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .lp-table tbody tr:nth-child(odd) {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .lp-row {
                flex-wrap: wrap !important;
            }

            .lp-val {
                word-break: break-all !important;
            }

            .lp-row,
            table {
                page-break-inside: avoid;
            }

            .lp-sec {
                page-break-after: avoid;
            }

            @page {
                size: Letter;
                margin: 8mm 12mm 20px;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ── Action Buttons ──────────────────────────────────────────────────── --}}
    <div class="app-actions-bar no-print">
        <button class="btn-app-action btn-download" onclick="savePDF()">
            <i class="bi bi-file-earmark-pdf-fill"></i> Print / Save as PDF
        </button>
        <a href="{{ route('membership.frontend') }}" class="btn-app-action btn-cancel">
            <i class="bi bi-x-circle"></i> Cancel
        </a>
    </div>

    {{-- Toast instruction --}}
    <div id="pdfToast" class="no-print"
        style="display:none; position:fixed; top:20px; left:50%; transform:translateX(-50%);
     background:#1b5e20; color:#fff; padding:14px 28px; border-radius:8px; font-size:1rem;
     font-weight:600; z-index:9999; box-shadow:0 4px 20px rgba(0,0,0,.3); text-align:center;">
        📄 To save as PDF: set <u>Destination</u> to <strong>"Save as PDF"</strong> then click Save
    </div>

    <script>
        function savePDF() {
            const orig = document.title;
            document.title =
                'membership-{{ preg_replace('/[^A-Za-z0-9]/', '-', $application->family_name) }}-{{ preg_replace('/[^A-Za-z0-9]/', '-', $application->given_name) }}';
            // Show toast instruction
            const toast = document.getElementById('pdfToast');
            if (toast) {
                toast.style.display = 'block';
                setTimeout(() => toast.style.display = 'none', 6000);
            }
            setTimeout(() => {
                window.print();
                document.title = orig;
            }, 300);
        }
    </script>

    @php
        $children = $application->children;
        if (is_string($children)) {
            $children = json_decode($children, true) ?? [];
        }
        $children = array_filter($children ?? [], fn($c) => !empty($c['name']));

        $clubs = $application->other_golf_clubs;
        if (is_string($clubs)) {
            $clubs = json_decode($clubs, true) ?? [];
        }
        $clubs = array_filter($clubs ?? [], fn($c) => !empty($c['club']));

        $typesRaw = $application->membership_type;
        if (is_string($typesRaw)) {
            $typesRaw = json_decode($typesRaw, true) ?? [];
        }
        $types = $typesRaw ?? [];

        $class = $application->class_of_membership;
        $v = fn($val) => $val ?: '';
    @endphp

    <div class="letter-outer-wrap">
        <div id="rgcLetterWrap">

            {{-- ══════════════════════════════════════════════════════════
     PAGE 1 — Personal Information + Employment Information
══════════════════════════════════════════════════════════ --}}
            <div class="lp-page">

                <div class="lp-header">
                    <img src="{{ asset('images/RivieraFooterLogo.png') }}" alt="RGC">
                    <div class="lp-header-txt">
                        <h2>RIVIERA GOLF CLUB</h2>
                        <p>SILANG CAVITE, PHILIPPINES</p>
                    </div>
                </div>
                <div class="lp-accent"></div>

                <div class="lp-body">

                    {{-- Intro + Log + Photo --}}
                    <div class="lp-intro-row">
                        <div class="lp-intro-txt">
                            <strong>Gentlemen:</strong>
                            Pursuant to my membership application,
                            I am pleased to give you the following information:
                        </div>
                        <div class="lp-meta-right">
                            <div class="lp-log-stack">
                                <div><span class="lp-log-lbl">Alpha Log Number</span>
                                    <div class="lp-log-line"></div>
                                </div>
                                <div><span class="lp-log-lbl">Chrono Log Number</span>
                                    <div class="lp-log-line"></div>
                                </div>
                                <div><span class="lp-log-lbl">Date Screened</span>
                                    <div class="lp-log-line"></div>
                                </div>
                            </div>
                            <div class="lp-photo-box">
                                @if ($application->photo_2x2)
                                    <img src="{{ asset('storage/' . $application->photo_2x2) }}" alt="2x2">
                                @else
                                    2x2 IMAGE
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- PERSONAL INFORMATION --}}
                    <div class="lp-sec">PERSONAL INFORMATION <span class="lp-sec-accent"></span></div>

                    <div class="lp-row">
                        <span class="lp-lbl">Full Name:</span>
                        <div class="lp-name-group">
                            <div class="lp-name-col">
                                <div class="lp-val">{{ $v($application->family_name) }}</div>
                                <div class="lp-sub">(Family Name)</div>
                            </div>
                            <div class="lp-name-col">
                                <div class="lp-val">{{ $v($application->given_name) }}</div>
                                <div class="lp-sub">(Given Name)</div>
                            </div>
                            <div class="lp-name-col">
                                <div class="lp-val">{{ $v($application->middle_name) }}</div>
                                <div class="lp-sub">(Middle Name)</div>
                            </div>
                        </div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Address:</span>
                        <div class="lp-val">{{ $v($application->address) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Billing (Local Address):</span>
                        <div class="lp-val">{{ $v($application->billing_address) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Cell No.:</span>
                        <div class="lp-val md">{{ $v($application->cell_no) }}</div>
                        <span class="lp-lbl">Email:</span>
                        <div class="lp-val">{{ $v($application->email) }}</div>
                        <span class="lp-lbl">Tel No.:</span>
                        <div class="lp-val md">{{ $v($application->tel_no) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Date of Birth:</span>
                        <div class="lp-val md">{{ $application->date_of_birth?->format('M d, Y') }}</div>
                        <span class="lp-lbl">Place of Birth:</span>
                        <div class="lp-val">{{ $v($application->place_of_birth) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Nationality:</span>
                        <div class="lp-val">{{ $v($application->nationality) }}</div>
                        <span class="lp-lbl">Sex:</span>
                        <div class="lp-val">{{ $v($application->sex) }}</div>
                        <span class="lp-lbl">Civil Status:</span>
                        <div class="lp-val">{{ $v($application->civil_status) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Passport / Identity Card No.:</span>
                        <div class="lp-val">{{ $v($application->passport_id_no) }}</div>
                        <span class="lp-lbl">TIN:</span>
                        <div class="lp-val sm">{{ $v($application->tin) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">College / Universities Attended:</span>
                        <div class="lp-val">{{ $v($application->college_university) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Degree Obtained :</span>
                        <div class="lp-val">{{ $v($application->degree_obtained) }}</div>
                    </div>

                    {{-- EMPLOYMENT / BUSINESS INFORMATION --}}
                    <div class="lp-sec">EMPLOYMENT / BUSINESS INFORMATION <span class="lp-sec-accent"></span></div>

                    <div class="lp-row">
                        <span class="lp-lbl">Company Name :</span>
                        <div class="lp-val">{{ $v($application->company_name) }}</div>
                        <span class="lp-lbl">Job Title:</span>
                        <div class="lp-val md">{{ $v($application->job_title) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Company Address:</span>
                        <div class="lp-val">{{ $v($application->company_address) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Type of Business:</span>
                        <div class="lp-val">{{ $v($application->type_of_business) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Business Tel. No. :</span>
                        <div class="lp-val">{{ $v($application->business_tel_no) }}</div>
                        <span class="lp-lbl">Business Fax No.:</span>
                        <div class="lp-val">{{ $v($application->business_fax_no) }}</div>
                    </div>

                </div>{{-- /lp-body --}}
                <div class="lp-footer-bar"></div>
            </div>{{-- /PAGE 1 --}}

            {{-- ══════════════════════════════════════════════════════════
     PAGE 2 — Family Information + Golf + Class + Declaration
══════════════════════════════════════════════════════════ --}}
            <div class="lp-page">
                {{-- Top green bars only --}}
                <div class="lp-top-bars"></div>

                <div class="lp-body">

                    {{-- FAMILY INFORMATION --}}
                    <div class="lp-sec" style="margin-top:0;">FAMILY INFORMATION <span class="lp-sec-accent"></span>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Spouse Name:</span>
                        <div class="lp-val">{{ $v($application->spouse_name) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Date of Birth:</span>
                        <div class="lp-val sm">{{ $application->spouse_dob?->format('M d, Y') }}</div>
                        <span class="lp-lbl">Place of Birth:</span>
                        <div class="lp-val">{{ $v($application->spouse_place_of_birth) }}</div>
                        <span class="lp-lbl">Nationality:</span>
                        <div class="lp-val">{{ $v($application->spouse_nationality) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Company Name:</span>
                        <div class="lp-val">{{ $v($application->spouse_company_name) }}</div>
                        <span class="lp-lbl">Job Title:</span>
                        <div class="lp-val md">{{ $v($application->spouse_job_title) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Company Address:</span>
                        <div class="lp-val">{{ $v($application->spouse_company_address) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Type Of Business:</span>
                        <div class="lp-val">{{ $v($application->spouse_type_of_business) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Business Tel. No. :</span>
                        <div class="lp-val">{{ $v($application->spouse_business_tel_no) }}</div>
                        <span class="lp-lbl">Business Fax No.:</span>
                        <div class="lp-val">{{ $v($application->spouse_business_fax_no) }}</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Spouse to receive a Membership Card:</span>
                        <div class="lp-val sm">{{ $v($application->spouse_membership_card) }}</div>
                    </div>

                    {{-- Children table — chunk into groups of 8 per page --}}
                    @php $childChunks = array_chunk(array_values($children ?: [['name'=>'','dob'=>'','sex'=>'','membership_card'=>''],['name'=>'','dob'=>'','sex'=>'','membership_card'=>''],['name'=>'','dob'=>'','sex'=>'','membership_card'=>'']]), 8); @endphp
                    @if (empty($childChunks))
                        @php $childChunks = [[['name'=>'','dob'=>'','sex'=>'','membership_card'=>''],['name'=>'','dob'=>'','sex'=>'','membership_card'=>''],['name'=>'','dob'=>'','sex'=>'','membership_card'=>'']]]; @endphp
                    @endif

                    @foreach ($childChunks as $chunkIdx => $chunk)
                        @if ($chunkIdx > 0)
                            {{-- overflow onto new page with same bar style --}}
                </div>{{-- close lp-body --}}
                <div class="lp-footer-bar"></div>
            </div>{{-- close lp-page --}}
            <div class="lp-page">
                <div class="lp-top-bars"></div>
                <div class="lp-body" style="padding-top:14px;">
                    @endif
                    <table class="lp-table">
                        <thead>
                            <tr>
                                <th>Name of Children</th>
                                <th>Date of Birth</th>
                                <th>Sex</th>
                                <th>Membership Card</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chunk as $child)
                                <tr>
                                    <td>{{ $child['name'] ?? '' }}</td>
                                    <td>{{ isset($child['dob']) && $child['dob'] ? \Carbon\Carbon::parse($child['dob'])->format('M d, Y') : '' }}
                                    </td>
                                    <td>{{ $child['sex'] ?? '' }}</td>
                                    <td>{{ $child['membership_card'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endforeach

                    {{-- Golf clubs table — chunk into groups of 8 --}}
                    @php $clubChunks = array_chunk(array_values($clubs ?: [['club'=>'','handicap'=>''],['club'=>'','handicap'=>''],['club'=>'','handicap'=>'']]), 8); @endphp
                    @if (empty($clubChunks))
                        @php $clubChunks = [[['club'=>'','handicap'=>''],['club'=>'','handicap'=>''],['club'=>'','handicap'=>'']]]; @endphp
                    @endif

                    @foreach ($clubChunks as $chunkIdx => $chunk)
                        @if ($chunkIdx > 0)
                </div>{{-- close lp-body --}}
                <div class="lp-footer-bar"></div>
            </div>{{-- close lp-page --}}
            <div class="lp-page">
                <div class="lp-top-bars"></div>
                <div class="lp-body" style="padding-top:14px;">
                    @endif
                    <table class="lp-table">
                        <thead>
                            <tr>
                                <th>Membership in other Golf/Sport Clubs</th>
                                <th>Handicap</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chunk as $club)
                                <tr>
                                    <td>{{ $club['club'] ?? '' }}</td>
                                    <td>{{ $club['handicap'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endforeach

                    {{-- Class of Membership — show only what was selected --}}
                    <div class="lp-class-lbl">
                        Class of Membership:&nbsp;&nbsp;{{ $class ? '"' . $class . '" Share' : '' }}
                    </div>

                    @if (!empty($types))
                        <div class="lp-bullets">
                            <div class="lp-bullet-col">
                                @if (in_array('Purchase of Share', $types))
                                    <div class="lp-bullet-item">Purchase of Share</div>
                                @endif
                                @if (in_array('Transfer of Share', $types))
                                    <div class="lp-bullet-item">Transfer of Share</div>
                                    @if ($application->transfer_of_share_cert)
                                        <div style="margin-left:18px; margin-top:2px; font-size:.86rem;">
                                            <span style="font-weight:700;">Stock Certificate No.:</span>
                                            {{ $application->transfer_of_share_cert }}
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="lp-bullet-col">
                                @if (in_array('Assignment of Playing Rights', $types) && $class !== 'C')
                                    <div class="lp-bullet-item">Assignment of Playing Rights</div>
                                @endif
                                @if (in_array('Change of Corporate Nominee', $types))
                                    <div class="lp-bullet-item">Change of Corporate Nominee</div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <p class="lp-pref">
                        <strong>Preferred mailing and billing address:</strong>
                        {{ $v($application->preferred_billing_address) }}
                    </p>

                    <p class="lp-note">
                        <strong>NOTE:</strong> For corporate "C" shares, the billing statements, Club Newsletters, and other
                        social information will be mailed to the corporation's corporate address.
                    </p>

                    <p class="lp-decl">
                        I, the undersigned, hereby declare that all the particulars given are true to my knowledge and
                        belief.
                        I agree to subject myself to the policies governing the acceptance of my membership to Riviera Golf
                        Club, Inc.
                        I am fully aware that the approval of my application carries the privileges of an exclusive club
                        with all its
                        appurtenant rules and regulations and Club's By-Laws. This includes the payment of monthly dues and
                        other
                        assessments that the Club may impose from time to time
                    </p>

                    <div class="lp-sig-right">
                        <div class="lp-sig-block">
                            <div class="lp-sig-line"></div>
                            <p class="lp-sig-name">Applicant for Membership</p>
                            <span class="lp-sig-sub">Signature</span>
                        </div>
                    </div>

                </div>{{-- /lp-body --}}
                <div class="lp-footer-bar"></div>
            </div>{{-- /PAGE 2 --}}

            {{-- ══════════════════════════════════════════════════════════
     PAGE 3 — Corporate Information + Endorsement + Committee
══════════════════════════════════════════════════════════ --}}
            <div class="lp-page">
                {{-- Top green bars only --}}
                <div class="lp-top-bars"></div>

                <div class="lp-body">

                    {{-- CORPORATE INFORMATION — always blank (not in DB) --}}
                    <div class="lp-sec" style="margin-top:0;">CORPORATE INFORMATION <span class="lp-sec-accent"></span>
                    </div>

                    <p class="lp-corp-note">
                        (For Corporate Share only – to be signed by the Chairman or President of the company)
                    </p>

                    <div class="lp-row">
                        <span class="lp-lbl">Name of Company:</span>
                        <div class="lp-val">&nbsp;</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Corporate Secretary:</span>
                        <div class="lp-val lg">&nbsp;</div>
                    </div>

                    <div style="height:14px;"></div>

                    <div class="lp-row">
                        <span class="lp-lbl">Address:</span>
                        <div class="lp-val">&nbsp;</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Tel. No.:</span>
                        <div class="lp-val sm">&nbsp;</div>
                        <span class="lp-lbl">Fax No.:</span>
                        <div class="lp-val sm">&nbsp;</div>
                        <span class="lp-lbl">Nature of Business:</span>
                        <div class="lp-val">&nbsp;</div>
                    </div>

                    <div class="lp-row">
                        <span class="lp-lbl">Authorized Signatory:</span>
                        <div class="lp-val">&nbsp;</div>
                        <span class="lp-lbl">Designation:</span>
                        <div class="lp-val">&nbsp;</div>
                    </div>

                    <hr class="lp-hr">

                    {{-- ENDORSEMENT — always blank --}}
                    <div class="lp-endorse-hdr">Endorsement:</div>
                    <div class="lp-endorse-sub">(at least one (1) member in good standing)</div>

                    <div class="lp-endorse-grid">
                        @for ($e = 1; $e <= 2; $e++)
                            <div class="lp-endorse-col">
                                <div class="lp-row" style="margin-bottom:10px;">
                                    <span class="lp-lbl">Member's Name:</span>
                                    <div class="lp-val">&nbsp;</div>
                                </div>
                                <div class="lp-row" style="margin-bottom:10px;">
                                    <span class="lp-lbl">Membership Club No.:</span>
                                    <div class="lp-val sm">&nbsp;</div>
                                </div>
                                <div class="lp-row" style="margin-bottom:10px;">
                                    <span class="lp-lbl">No. of years known:</span>
                                    <div class="lp-val sm">&nbsp;</div>
                                </div>
                                <div class="lp-endorse-sig">Signature over printed name</div>
                            </div>
                        @endfor
                    </div>

                    {{-- MEMBERSHIP COMMITTEE — always blank --}}
                    <div class="lp-comm-title">Membership Committee</div>

                    <div class="lp-approve">
                        <div class="lp-approve-item"><span class="lp-approve-box"></span>&nbsp;Approved</div>
                        <div class="lp-approve-item"><span class="lp-approve-box"></span>&nbsp;Disapproved</div>
                    </div>

                    <div class="lp-comm-sigs">
                        {{-- Chairman --}}
                        <div class="lp-chairman">
                            <div class="lp-chairman-line"></div>
                            <div class="lp-chairman-name">RAFAEL C. VALENCIA</div>
                            <div class="lp-chairman-role">Chairman, Membership Committee</div>
                        </div>

                        {{-- Members row 1 --}}
                        <div class="lp-members-row">
                            <div class="lp-member">
                                <div class="lp-member-line"></div>
                                <div class="lp-member-name">EDWARD E. CARRANZA</div>
                                <div class="lp-member-role">Member</div>
                            </div>
                            <div class="lp-member">
                                <div class="lp-member-line"></div>
                                <div class="lp-member-name">JEONG SOON HWANG</div>
                                <div class="lp-member-role">Member</div>
                            </div>
                        </div>

                        {{-- Members row 2 --}}
                        <div class="lp-members-row">
                            <div class="lp-member">
                                <div class="lp-member-line"></div>
                                <div class="lp-member-name">EDWARD E. CARRANZA</div>
                                <div class="lp-member-role">Member</div>
                            </div>
                            <div class="lp-member">
                                <div class="lp-member-line"></div>
                                <div class="lp-member-name">JEONG SOON HWANG</div>
                                <div class="lp-member-role">Member</div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /lp-body --}}
                <div class="lp-footer-bar"></div>
            </div>{{-- /PAGE 3 --}}

            {{-- ═══════════════════════════════════════════════════════
     PAGE 4 — DATA PRIVACY STATEMENT
════════════════════════════════════════════════════════ --}}
            <div class="lp-page" id="lp-page-4">
                <div class="lp-top-bars"></div>
                <div class="lp-accent-bar"></div>

                <div class="lp-body">

                    <div class="lp-sec" style="margin-top:0;">9. DATA PRIVACY STATEMENT <span
                            class="lp-sec-accent"></span></div>

                    <div style="font-size:0.9rem; line-height:1.85; color:#111; text-align:justify; margin-bottom:24px;">
                        <p style="margin-bottom:14px;">
                            Riviera Golf Club, Inc. respects and values your right to privacy. In compliance with the Data
                            Privacy Act of 2012 (RA 10173), the personal information and documents you provide in connection
                            with your membership shall be collected, processed, and stored solely for legitimate purposes of
                            the Club, including membership validation, billing, and compliance with legal and regulatory
                            requirements.
                        </p>
                        <p style="margin-bottom:14px;">
                            Your information will be kept confidential and secure, and will only be accessed by authorized
                            Club personnel. It will not be shared with third parties without your consent, unless required
                            by law or the Club's By-Laws.
                        </p>
                        <p style="margin-bottom:14px;">
                            By signing this form, you acknowledge that you have read and understood this statement and that
                            you consent to the collection, use, and processing of your personal data in accordance with Club
                            policies and applicable laws.
                        </p>
                    </div>

                    {{-- Signature row --}}
                    <div style="display:flex; gap:40px; align-items:flex-end; margin-top:40px;">
                        <div style="flex:2;">
                            <div class="lp-val" style="min-height:32px;">&nbsp;</div>
                            <div style="font-size:0.78rem; color:#555; text-align:center; margin-top:4px;">
                                Member/Applicant's Signature</div>
                        </div>
                        <div style="flex:1;">
                            <div class="lp-val" style="min-height:32px;">&nbsp;</div>
                            <div style="font-size:0.78rem; color:#555; text-align:center; margin-top:4px;">Date</div>
                        </div>
                    </div>

                </div>{{-- /lp-body --}}
                <div class="lp-footer-bar"></div>
            </div>{{-- /PAGE 4 --}}

        </div>{{-- /rgcLetterWrap --}}
    </div>{{-- /letter-outer-wrap --}}

@endsection

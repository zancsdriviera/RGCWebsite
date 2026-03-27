<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipContent;
use App\Models\MembershipApplication;
use Illuminate\Support\Facades\Storage;

class MembershipController extends Controller
{
    public function index()
    {
        $downloads    = MembershipContent::where('type', 'download')->get();
        $members_data = MembershipContent::where('type', 'members_data')->get();
        $banks        = MembershipContent::where('type', 'bank')->get();
        return view('membership', compact('downloads', 'members_data', 'banks'));
    }

    public function storeApplication(Request $request)
    {
        $request->validate([
            'family_name'               => 'required|string|max:255',
            'given_name'                => 'required|string|max:255',
            'middle_name'               => 'nullable|string|max:255',
            'address'                   => 'required|string|max:500',
            'billing_address'           => 'nullable|string|max:500',
            'cell_no'                   => 'required|string|max:50',
            'email'                     => 'required|email|max:255',
            'tel_no'                    => 'nullable|string|max:50',
            'date_of_birth'             => 'required|date',
            'place_of_birth'            => 'required|string|max:255',
            'nationality'               => 'required|string|max:100',
            'civil_status'              => 'required|string|max:50',
            'sex'                       => 'required|in:Male,Female',
            'passport_id_no'            => 'nullable|string|max:100',
            'tin'                       => 'nullable|string|max:50',
            'college_university'        => 'nullable|string|max:255',
            'degree_obtained'           => 'nullable|string|max:255',
            'photo_2x2'                 => 'nullable',
            'company_name'              => 'required|string|max:255',
            'job_title'                 => 'required|string|max:255',
            'company_address'           => 'required|string|max:500',
            'type_of_business'          => 'required|string|max:255',
            'business_tel_no'           => 'required|string|max:50',
            'business_fax_no'           => 'nullable|string|max:50',
            'class_of_membership'       => 'required|in:A,B,C',
            'preferred_billing_address' => 'required|string|max:100',
        ]);

        $data = $request->only([
            'family_name','given_name','middle_name',
            'address','billing_address',
            'cell_no','email','tel_no',
            'date_of_birth','place_of_birth',
            'nationality','civil_status','sex',
            'passport_id_no','tin',
            'college_university','degree_obtained',
            'company_name','job_title','company_address',
            'type_of_business','business_tel_no','business_fax_no',
            'spouse_name','spouse_dob','spouse_place_of_birth',
            'spouse_nationality','spouse_company_name','spouse_job_title',
            'spouse_company_address','spouse_type_of_business',
            'spouse_business_tel_no','spouse_business_fax_no',
            'spouse_membership_card',
            'class_of_membership','transfer_of_share_cert','preferred_billing_address',
        ]);

        // Photo — canvas base64 or file upload
        if ($request->filled('photo_2x2_b64')) {
            $imgData = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $request->input('photo_2x2_b64')));
            if ($imgData !== false) {
                $dir = storage_path('app/public/membership/photos');
                if (!file_exists($dir)) mkdir($dir, 0755, true);
                $fname = uniqid('photo_') . '.jpg';
                file_put_contents($dir . DIRECTORY_SEPARATOR . $fname, $imgData);
                $data['photo_2x2'] = 'membership/photos/' . $fname;
            }
        } elseif ($request->hasFile('photo_2x2')) {
            $data['photo_2x2'] = $request->file('photo_2x2')->store('membership/photos', 'public');
        }

        $data['children']         = $request->input('children')         ?: null;
        $data['other_golf_clubs'] = $request->input('other_golf_clubs') ?: null;
        // membership_type is now a single radio value — wrap in array for model cast
        $mt = $request->input('membership_type');
        $data['membership_type'] = $mt ? [$mt] : null;

        $application = MembershipApplication::create($data);
        return redirect()->route('membership.application.show', $application->id);
    }

    public function showApplication($id)
    {
        $application = MembershipApplication::findOrFail($id);
        return view('membership_application', compact('application'));
    }

    public function downloadApplication($id)
    {
        $app = MembershipApplication::findOrFail($id);
        return $this->buildPdf($app);
    }

    // =========================================================
    // PDF HELPERS
    // =========================================================

    private const ML = 15;   // left/right margin
    private const CW = 186;  // content width: 216 - 15 - 15
    private const FY = 267;  // footer Y (Letter = 279mm, footer 12mm tall)

    /** Write logo + header bar */
    private function pdfHeader(\TCPDF $pdf): void
    {
        // Dark green bar
        $pdf->SetFillColor(27, 94, 32);
        $pdf->Rect(0, 0, 216, 26, 'F');

        // Logo — embedded base64, no file needed, no GD/Imagick
        $logoB64 = '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';
        try {
            $tmp = tempnam(sys_get_temp_dir(), 'rgclogo_') . '.jpg';
            file_put_contents($tmp, base64_decode($logoB64));
            $pdf->Image($tmp, 1, 2, 24, 22, 'JPG');
            @unlink($tmp);
        } catch (\Throwable $e) {}

        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('helvetica', 'B', 17);
        $pdf->SetXY(27, 4);
        $pdf->Cell(163, 9, 'RIVIERA GOLF CLUB', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 8.5);
        $pdf->SetXY(27, 14);
        $pdf->Cell(163, 5, 'SILANG CAVITE, PHILIPPINES', 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);

        // Accent strip
        $pdf->SetFillColor(76, 175, 80);
        $pdf->Rect(0, 26, 216, 2, 'F');
    }

    /** Simple top bars for pages 2+ */
    private function pdfHeaderSimple(\TCPDF $pdf): void
    {
        $pdf->SetFillColor(27, 94, 32);
        $pdf->Rect(0, 0, 216, 5, 'F');
        $pdf->SetFillColor(76, 175, 80);
        $pdf->Rect(0, 5, 216, 2, 'F');
    }

    /** Footer green bar */
    private function pdfFooter(\TCPDF $pdf): void
    {
        $pdf->SetFillColor(27, 94, 32);
        $pdf->Rect(0, self::FY, 216, 12, 'F');
    }

    /** Auto page break check */
    private function pb(\TCPDF $pdf, float $need): void
    {
        if ($pdf->GetY() > (self::FY - $need)) {
            $pdf->AddPage();
            $this->pdfHeaderSimple($pdf);
            $this->pdfFooter($pdf);
            $pdf->SetY(12);
        }
    }
    /** Green section header */
    private function sec(\TCPDF $pdf, string $title): void
    {
        $this->pb($pdf, 20);
        $pdf->SetFillColor(27, 94, 32);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetX(self::ML);
        $pdf->Cell(self::CW - 10, 7, '  ' . strtoupper($title), 0, 0, 'L', true);
        $pdf->SetFillColor(76, 175, 80);
        $pdf->Cell(10, 7, '', 0, 1, 'L', true);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(2);
    }

    /**
     * Field row — Bold Label: underlined value — same line
     * cols = [['lbl'=>'...','val'=>'...','w'=>mm], ...]
     */
    private function row(\TCPDF $pdf, array $cols): void
    {
        $this->pb($pdf, 10);
        $total = array_sum(array_column($cols, 'w'));
        if ($total > self::CW) {
            $s = self::CW / $total;
            foreach ($cols as &$c) $c['w'] = (int)($c['w'] * $s);
            unset($c);
        }
        $y = $pdf->GetY();
        $x = self::ML;
        foreach ($cols as $c) {
            $lbl  = $c['lbl'] . ':';
            $colW = (float)$c['w'];
            // Bold label
            $pdf->SetFont('helvetica', 'B', 8.5);
            $lw = $pdf->GetStringWidth($lbl) + 1.5;
            $pdf->SetXY($x, $y);
            $pdf->Cell($lw, 6, $lbl, 0, 0, 'L');
            // Value
            $pdf->SetFont('helvetica', '', 8.5);
            $valX = $x + $lw;
            $valW = $colW - $lw;
            $val  = (isset($c['val']) && $c['val'] !== '') ? ' ' . $c['val'] : '';
            $pdf->SetXY($valX, $y);
            $pdf->Cell($valW, 6, $val, 0, 0, 'L');
            // Draw underline manually — always visible
            $lineY = $y + 6;
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Line($valX, $lineY, $valX + $valW, $lineY);
            $x += $colW;
        }
        $pdf->SetY($y + 10);
    }

    /** Green striped table */
    private function tbl(\TCPDF $pdf, array $headers, array $widths, array $rows): void
    {
        $this->pb($pdf, 20);
        $total = array_sum($widths);
        if ($total > self::CW) {
            $s = self::CW / $total;
            $widths = array_map(fn($w) => (int)($w * $s), $widths);
        }
        $pdf->SetFillColor(27, 94, 32);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetX(self::ML);
        foreach ($headers as $i => $h) $pdf->Cell($widths[$i], 7, $h, 0, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('helvetica', '', 8.5);
        foreach ($rows as $ri => $r) {
            $this->pb($pdf, 7);
            $odd = $ri % 2 === 0;
            $pdf->SetFillColor($odd ? 212 : 255, $odd ? 233 : 255, $odd ? 212 : 255);
            $pdf->SetX(self::ML);
            foreach ($r as $i => $cell) $pdf->Cell($widths[$i], 6, $cell, 0, 0, 'C', $odd);
            $pdf->Ln();
        }
        $pdf->Ln(3);
    }

    /** Load user photo — JPG only, no GD needed */
    private function loadPhoto(\TCPDF $pdf, ?string $path, float $x, float $y, float $w, float $h): void
    {
        $loaded = false;
        if ($path && Storage::disk('public')->exists($path)) {
            $pp  = storage_path('app/public/' . str_replace('/', DIRECTORY_SEPARATOR, $path));
            $ext = strtoupper(pathinfo($pp, PATHINFO_EXTENSION));
            if (in_array($ext, ['JPG','JPEG'])) {
                try { $pdf->Image($pp, $x, $y, $w, $h, 'JPG'); $loaded = true; }
                catch (\Throwable $e) {}
            }
            // PNG — try GD
            if (!$loaded && $ext === 'PNG' && function_exists('imagecreatefrompng')) {
                try {
                    $src = @imagecreatefrompng($pp);
                    if ($src) {
                        $bw = imagesx($src); $bh = imagesy($src);
                        $bg = imagecreatetruecolor($bw, $bh);
                        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                        imagecopy($bg, $src, 0, 0, 0, 0, $bw, $bh);
                        imagedestroy($src);
                        $tmp = tempnam(sys_get_temp_dir(), 'rgc_') . '.jpg';
                        imagejpeg($bg, $tmp, 95);
                        imagedestroy($bg);
                        $pdf->Image($tmp, $x, $y, $w, $h, 'JPG');
                        @unlink($tmp);
                        $loaded = true;
                    }
                } catch (\Throwable $e) {}
            }
        }
        if (!$loaded) {
            $pdf->SetFillColor(230, 230, 230);
            $pdf->Rect($x, $y, $w, $h, 'DF');
            $pdf->SetTextColor(120, 120, 120);
            $pdf->SetFont('helvetica', '', 6);
            $pdf->SetXY($x, $y + $h / 2 - 2);
            $pdf->Cell($w, 4, '2x2 IMAGE', 0, 0, 'C');
            $pdf->SetTextColor(0, 0, 0);
        }
    }

    // =========================================================
    // =========================================================
    // BUILD PDF
    // =========================================================
    public function buildPdf(MembershipApplication $app)
    {
        $v = fn($val) => $val ?: '';
        $d = fn($dt)  => $dt  ? date('M d, Y', strtotime($dt)) : '';

        // Decode JSON safely
        $ch = $app->children;
        if (is_string($ch)) $ch = json_decode($ch, true) ?? [];
        $children = array_filter((array)$ch, fn($c) => !empty($c['name']));

        $cl = $app->other_golf_clubs;
        if (is_string($cl)) $cl = json_decode($cl, true) ?? [];
        $clubs = array_filter((array)$cl, fn($c) => !empty($c['club']));

        // DeepSeek's exact decode
        $types = [];
        $typesRaw = $app->membership_type;
        if (is_string($typesRaw)) {
            $decoded = json_decode($typesRaw, true);
            if (is_array($decoded)) {
                $types = $decoded;
            } else {
                $types = explode(',', $typesRaw);
            }
        } elseif (is_array($typesRaw)) {
            $types = $typesRaw;
        }
        $types = array_filter(array_map('trim', $types));
        $types = array_values(array_unique($types));
        if (!in_array('Transfer of Share', $types) && $app->transfer_of_share_cert) {
            $types[] = 'Transfer of Share';
        }

        $class = (string)($app->class_of_membership ?? '');

        // ─── PDF setup ───────────────────────────────────────────────────
        $pdf = new \TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);
        $pdf->SetCreator('Riviera Golf Club');
        $pdf->SetAuthor('Riviera Golf Club');
        $pdf->SetTitle('Membership Application - ' . $app->family_name . ', ' . $app->given_name);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(self::ML, 30, self::ML);
        $pdf->SetAutoPageBreak(false);

        // ═══════════════════════════════════════════════════════
        // PAGE 1 — Personal + Employment
        // ═══════════════════════════════════════════════════════
        $pdf->AddPage();
        $this->pdfHeader($pdf);
        $this->pdfFooter($pdf);
        $pdf->SetY(30);

        // Gentlemen intro — left ~100mm
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetX(self::ML);
        $pdf->Cell(0, 5, 'Gentlemen:', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 8.5);
        $pdf->SetX(self::ML);
        $pdf->MultiCell(100, 4.5, "Pursuant to my membership application, I am pleased\nto give you the following information:", 0, 'L');

        // Log fields — right side, absolute positioned
        $mX = 120; $mY = 30;
        foreach (['Alpha Log Number', 'Chrono Log Number', 'Date Screened'] as $lbl) {
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->SetXY($mX, $mY);
            $pdf->Cell(50, 4.5, $lbl, 0, 0, 'L');
            $pdf->SetXY($mX, $mY + 5);
            $pdf->Cell(50, 0.3, '', 'B', 0, 'L');
            $mY += 11;
        }

        // 2x2 photo — far right, does NOT overlap section header
        // Photo — right side, ends at Y=56, section starts at Y=60. No overlap.
        $phX = 172; $phY = 30; $phW = 24; $phH = 26;
        $this->loadPhoto($pdf, $app->photo_2x2, $phX, $phY, $phW, $phH);

        // Start section safely below photo
        $pdf->SetY(60);

        // PERSONAL INFORMATION
        $this->sec($pdf, 'PERSONAL INFORMATION');

        // Full Name — 3 boxes with sub-labels
        $y = $pdf->GetY();
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetXY(self::ML, $y);
        $pdf->Cell(22, 6, 'Full Name:', 0, 0, 'L');
        $nw = (self::CW - 22) / 3;
        foreach (['Family Name','Given Name','Middle Name'] as $i => $sub) {
            $vals = [$v($app->family_name), $v($app->given_name), $v($app->middle_name)];
            $nx   = self::ML + 22 + ($i * $nw);
            $pdf->SetFont('helvetica', '', 8.5);
            $pdf->SetXY($nx, $y);
            $pdf->Cell($nw, 6, $vals[$i], 'B', 0, 'L');
            $pdf->SetFont('helvetica', 'I', 6.5);
            $pdf->SetXY($nx, $y + 6.5);
            $pdf->Cell($nw, 3, '(' . $sub . ')', 0, 0, 'C');
        }
        $pdf->SetY($y + 12);

        $this->row($pdf, [['lbl'=>'Address',                 'val'=>$v($app->address),           'w'=>self::CW]]);
        $this->row($pdf, [['lbl'=>'Billing (Local Address)', 'val'=>$v($app->billing_address),   'w'=>self::CW]]);
        $this->row($pdf, [
            ['lbl'=>'Cell No.',  'val'=>$v($app->cell_no),  'w'=>62],
            ['lbl'=>'Email',     'val'=>$v($app->email),    'w'=>78],
            ['lbl'=>'Tel No.',   'val'=>$v($app->tel_no),   'w'=>46],
        ]);
        $this->row($pdf, [
            ['lbl'=>'Date of Birth',  'val'=>$d($app->date_of_birth), 'w'=>93],
            ['lbl'=>'Place of Birth', 'val'=>$v($app->place_of_birth),'w'=>93],
        ]);
        $this->row($pdf, [
            ['lbl'=>'Nationality',  'val'=>$v($app->nationality),  'w'=>62],
            ['lbl'=>'Sex',          'val'=>$v($app->sex),          'w'=>62],
            ['lbl'=>'Civil Status', 'val'=>$v($app->civil_status), 'w'=>62],
        ]);
        $this->row($pdf, [
            ['lbl'=>'Passport / Identity Card No.', 'val'=>$v($app->passport_id_no), 'w'=>100],
            ['lbl'=>'TIN',                           'val'=>$v($app->tin),            'w'=>86],
        ]);
        $this->row($pdf, [['lbl'=>'College / Universities Attended', 'val'=>$v($app->college_university), 'w'=>self::CW]]);
        $this->row($pdf, [['lbl'=>'Degree Obtained',                  'val'=>$v($app->degree_obtained),    'w'=>self::CW]]);

        // EMPLOYMENT
        $this->sec($pdf, 'EMPLOYMENT / BUSINESS INFORMATION');
        $this->row($pdf, [
            ['lbl'=>'Company Name', 'val'=>$v($app->company_name), 'w'=>120],
            ['lbl'=>'Job Title',    'val'=>$v($app->job_title),    'w'=>66],
        ]);
        $this->row($pdf, [['lbl'=>'Company Address',  'val'=>$v($app->company_address),  'w'=>self::CW]]);
        $this->row($pdf, [['lbl'=>'Type of Business', 'val'=>$v($app->type_of_business), 'w'=>self::CW]]);
        $this->row($pdf, [
            ['lbl'=>'Business Tel. No.', 'val'=>$v($app->business_tel_no), 'w'=>93],
            ['lbl'=>'Business Fax No.',  'val'=>$v($app->business_fax_no), 'w'=>93],
        ]);

        // ═══════════════════════════════════════════════════════
        // PAGE 2 — Family + Golf + Class + Declaration
        // ═══════════════════════════════════════════════════════
        $pdf->AddPage();
        $this->pdfHeaderSimple($pdf);
        $this->pdfFooter($pdf);
        $pdf->SetY(12);

        $this->sec($pdf, 'FAMILY INFORMATION');
        $this->row($pdf, [['lbl'=>'Spouse Name', 'val'=>$v($app->spouse_name), 'w'=>self::CW]]);
        $this->row($pdf, [
            ['lbl'=>'Date of Birth',  'val'=>$d($app->spouse_dob),            'w'=>62],
            ['lbl'=>'Place of Birth', 'val'=>$v($app->spouse_place_of_birth), 'w'=>62],
            ['lbl'=>'Nationality',    'val'=>$v($app->spouse_nationality),     'w'=>62],
        ]);
        $this->row($pdf, [
            ['lbl'=>'Company Name', 'val'=>$v($app->spouse_company_name), 'w'=>120],
            ['lbl'=>'Job Title',    'val'=>$v($app->spouse_job_title),    'w'=>66],
        ]);
        $this->row($pdf, [['lbl'=>'Company Address',  'val'=>$v($app->spouse_company_address),  'w'=>self::CW]]);
        $this->row($pdf, [['lbl'=>'Type Of Business', 'val'=>$v($app->spouse_type_of_business), 'w'=>self::CW]]);
        $this->row($pdf, [
            ['lbl'=>'Business Tel. No.', 'val'=>$v($app->spouse_business_tel_no), 'w'=>93],
            ['lbl'=>'Business Fax No.',  'val'=>$v($app->spouse_business_fax_no), 'w'=>93],
        ]);

        $this->pb($pdf, 8);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetX(self::ML);
        $pdf->Write(6, 'Spouse to receive a Membership Card:  ');
        $pdf->SetFont('helvetica', '', 8.5);
        $pdf->Write(6, $v($app->spouse_membership_card));
        $pdf->Ln(9);

        // Children table
        $chRows = !empty($children)
            ? array_map(fn($c) => [
                $c['name'] ?? '',
                !empty($c['dob']) ? date('M d, Y', strtotime($c['dob'])) : '',
                $c['sex'] ?? '',
                $c['membership_card'] ?? '',
              ], $children)
            : [['','','',''],['','','',''],['','','','']];
        $this->tbl($pdf, ['Name of Children','Date of Birth','Sex','Membership Card'], [74,42,35,35], $chRows);

        // Golf clubs table
        $clRows = !empty($clubs)
            ? array_map(fn($c) => [$c['club'] ?? '', $c['handicap'] ?? ''], $clubs)
            : [['',''],['',''],['','']];
        $this->tbl($pdf, ['Membership in other Golf/Sport Clubs','Handicap'], [128,58], $clRows);

        // Class of Membership
        $this->pb($pdf, 35);
        $pdf->SetFont('helvetica', 'B', 9.5);
        $pdf->SetX(self::ML);
        $pdf->Cell(self::CW, 7, 'Class of Membership:   ' . ($class ? '"' . $class . '" Share' : ''), 0, 1, 'L');
        $pdf->Ln(2);

        // Membership types — DeepSeek's working rendering
        $this->pb($pdf, 10);
        if (!empty($types)) {
            foreach ($types as $t) {
                $t = trim((string)$t);
                if ($t === '') continue;
                if ($class === 'C' && $t === 'Assignment of Playing Rights') continue;
                $this->pb($pdf, 10);
                if ($t === 'Transfer of Share') {
                    $pdf->SetFont('helvetica', '', 9);
                    $pdf->SetX(self::ML + 5);
                    $pdf->Write(7, chr(149) . '  ' . $t);
                    $pdf->Ln(6);
                    if (!empty($app->transfer_of_share_cert)) {
                        $pdf->SetFont('helvetica', 'B', 9);
                        $pdf->SetX(self::ML + 15);
                        $pdf->Write(6, 'Stock Certificate No.: ');
                        $pdf->SetFont('helvetica', '', 9);
                        $pdf->Write(6, $app->transfer_of_share_cert);
                        $pdf->Ln(8);
                    }
                } else {
                    $pdf->SetFont('helvetica', '', 9);
                    $pdf->SetX(self::ML + 5);
                    $pdf->Write(7, chr(149) . '  ' . $t);
                    $pdf->Ln(8);
                }
            }
            $pdf->Ln(2);
        }

        // Preferred billing
        $this->pb($pdf, 10);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetX(self::ML);
        $pdf->Write(6, 'Preferred mailing and billing address:  ');
        $pdf->SetFont('helvetica', '', 8.5);
        $pdf->Write(6, $v($app->preferred_billing_address));
        $pdf->Ln(8);

        // NOTE
        $this->pb($pdf, 12);
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetX(self::ML);
        $pdf->Write(5, 'NOTE: ');
        $pdf->SetFont('helvetica', '', 8);
        $pdf->Write(5, 'For corporate "C" shares, the billing statements, Club Newsletters, and other social information will be mailed to the corporation\'s corporate address.');
        $pdf->Ln(7);

        // Declaration — constrained to CW, no overflow
        $this->pb($pdf, 30);
        $pdf->SetFont('helvetica', '', 8.5);
        $pdf->SetX(self::ML);
        $pdf->MultiCell(self::CW, 5,
            'I, the undersigned, hereby declare that all the particulars given are true to my knowledge and belief. '
            . 'I agree to subject myself to the policies governing the acceptance of my membership to Riviera Golf Club, Inc. '
            . 'I am fully aware that the approval of my application carries the privileges of an exclusive club with all its '
            . 'appurtenant rules and regulations and Club\'s By-Laws. This includes the payment of monthly dues and other '
            . 'assessments that the Club may impose from time to time', 0, 'L');

        // Signature pinned to bottom
        $sX = self::ML + 106; $sW = self::CW - 106;
        $sY = self::FY - 20;
        $pdf->Line($sX, $sY, $sX + $sW, $sY);
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetXY($sX, $sY + 2);
        $pdf->Cell($sW, 5, 'Applicant for Membership', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetX($sX);
        $pdf->Cell($sW, 4, 'Signature', 0, 1, 'C');

        // ═══════════════════════════════════════════════════════
        // PAGE 3 — Corporate + Endorsement + Committee
        // ═══════════════════════════════════════════════════════
        $pdf->AddPage();
        $this->pdfHeaderSimple($pdf);
        $this->pdfFooter($pdf);
        $pdf->SetY(12);

        $this->sec($pdf, 'CORPORATE INFORMATION');
        $pdf->SetFont('helvetica', 'I', 8.5);
        $pdf->SetX(self::ML);
        $pdf->Cell(self::CW, 5, '(For Corporate Share only - to be signed by the Chairman or President of the company)', 0, 1, 'C');
        $pdf->Ln(2);

        $this->row($pdf, [['lbl'=>'Name of Company',     'val'=>'', 'w'=>self::CW]]);
        $this->row($pdf, [['lbl'=>'Corporate Secretary', 'val'=>'', 'w'=>100]]);
        $pdf->Ln(2);
        $this->row($pdf, [['lbl'=>'Address', 'val'=>'', 'w'=>self::CW]]);
        $this->row($pdf, [
            ['lbl'=>'Tel. No.',           'val'=>'', 'w'=>58],
            ['lbl'=>'Fax No.',            'val'=>'', 'w'=>58],
            ['lbl'=>'Nature of Business', 'val'=>'', 'w'=>70],
        ]);
        $this->row($pdf, [
            ['lbl'=>'Authorized Signatory', 'val'=>'', 'w'=>93],
            ['lbl'=>'Designation',           'val'=>'', 'w'=>93],
        ]);

        $pdf->Ln(4);
        $pdf->SetDrawColor(80, 80, 80);
        $pdf->Line(self::ML, $pdf->GetY(), self::ML + self::CW, $pdf->GetY());
        $pdf->Ln(7);

        // Endorsement
        $this->pb($pdf, 65);
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetX(self::ML);
        $pdf->Write(6, 'Endorsement: ');
        $pdf->SetFont('helvetica', 'I', 8.5);
        $pdf->Write(6, '(at least one (1) member in good standing)');
        $pdf->Ln(10);

        $eY = $pdf->GetY();
        $eW = (self::CW - 6) / 2;
        foreach ([self::ML, self::ML + $eW + 6] as $ex) {
            $ey = $eY;
            foreach (["Member's Name:", 'Membership Club No.:', 'No. of years known:'] as $lbl) {
                $pdf->SetFont('helvetica', 'B', 8.5);
                $pdf->SetXY($ex, $ey);
                $pdf->Cell($eW, 5, $lbl, 0, 0, 'L');
                $pdf->SetXY($ex, $ey + 5);
                $pdf->Cell($eW, 0.3, '', 'B', 0, 'L');
                $ey += 12;
            }
            $pdf->Line($ex, $ey + 10, $ex + 58, $ey + 10);
            $pdf->SetFont('helvetica', 'B', 8.5);
            $pdf->SetXY($ex, $ey + 12);
            $pdf->Cell(75, 5, 'Signature over printed name', 0, 0, 'L');
        }
        $pdf->SetY($eY + 58);

        // Committee pinned to bottom
        $commY = self::FY - 95;
        $pdf->SetXY(self::ML, $commY);
        $pdf->SetFont('helvetica', 'B', 10.5);
        $pdf->Cell(self::CW, 7, 'Membership Committee', 0, 1, 'L');

        $bY = $pdf->GetY() + 1;
        $pdf->Rect(self::ML, $bY, 4, 4);
        $pdf->SetFont('helvetica', '', 8.5);
        $pdf->SetXY(self::ML + 6, $bY - 0.5);
        $pdf->Cell(30, 6, 'Approved', 0, 0, 'L');
        $pdf->Rect(self::ML + 42, $bY, 4, 4);
        $pdf->SetXY(self::ML + 48, $bY - 0.5);
        $pdf->Cell(35, 6, 'Disapproved', 0, 1, 'L');
        $pdf->Ln(10);

        $cX = self::ML + 88; $cW = self::CW - 88; $cY = $pdf->GetY();
        $pdf->Line($cX, $cY, $cX + $cW, $cY);
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetXY($cX, $cY + 2);
        $pdf->Cell($cW, 5, 'RAFAEL C. VALENCIA', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetX($cX);
        $pdf->Cell($cW, 4, 'Chairman, Membership Committee', 0, 1, 'C');
        $pdf->Ln(10);

        $mW = ($cW - 4) / 2;
        foreach ([0, 1] as $_) {
            $mY = $pdf->GetY();
            foreach ([[$cX, 'EDWARD E. CARRANZA'], [$cX + $mW + 4, 'JEONG SOON HWANG']] as [$mx, $mn]) {
                $pdf->Line($mx, $mY, $mx + $mW, $mY);
                $pdf->SetFont('helvetica', 'B', 8.5);
                $pdf->SetXY($mx, $mY + 2);
                $pdf->Cell($mW, 5, $mn, 0, 0, 'C');
                $pdf->SetFont('helvetica', '', 8);
                $pdf->SetXY($mx, $mY + 7);
                $pdf->Cell($mW, 4, 'Member', 0, 0, 'C');
            }
            $pdf->SetY($mY + 14);
            $pdf->Ln(4);
        }

        // ═══════════════════════════════════════════════════════
        // PAGE 4 — DATA PRIVACY STATEMENT
        // ═══════════════════════════════════════════════════════
        $pdf->AddPage();
        $this->pdfHeaderSimple($pdf);
        $this->pdfFooter($pdf);
        $pdf->SetY(12);

        // Section header
        $this->sec($pdf, '9. DATA PRIVACY STATEMENT');
        $pdf->Ln(2);

        $privacyText = [
            'Riviera Golf Club, Inc. respects and values your right to privacy. In compliance with the Data Privacy Act of 2012 (RA 10173), the personal information and documents you provide in connection with your membership shall be collected, processed, and stored solely for legitimate purposes of the Club, including membership validation, billing, and compliance with legal and regulatory requirements.',
            'Your information will be kept confidential and secure, and will only be accessed by authorized Club personnel. It will not be shared with third parties without your consent, unless required by law or the Club\'s By-Laws.',
            'By signing this form, you acknowledge that you have read and understood this statement and that you consent to the collection, use, and processing of your personal data in accordance with Club policies and applicable laws.',
        ];

        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetX(self::ML);
        foreach ($privacyText as $para) {
            $pdf->SetX(self::ML);
            $pdf->MultiCell(self::CW, 6, $para, 0, 'J');
            $pdf->Ln(4);
        }

        // Signature line — pinned lower
        $pdf->Ln(20);
        $sigY = $pdf->GetY();
        $sigW = 110;
        $dateW = 60;
        $gap = self::CW - $sigW - $dateW;

        // Signature
        $pdf->Line(self::ML, $sigY, self::ML + $sigW, $sigY);
        $pdf->SetFont('helvetica', '', 8.5);
        $pdf->SetXY(self::ML, $sigY + 2);
        $pdf->Cell($sigW, 5, 'Member/Applicant\'s Signature', 0, 0, 'C');

        // Date
        $dateX = self::ML + $sigW + $gap;
        $pdf->Line($dateX, $sigY, $dateX + $dateW, $sigY);
        $pdf->SetXY($dateX, $sigY + 2);
        $pdf->Cell($dateW, 5, 'Date', 0, 0, 'C');

        $filename = 'membership-' . preg_replace('/[^A-Za-z0-9]/', '-', $app->family_name) . '-' .
                    preg_replace('/[^A-Za-z0-9]/', '-', $app->given_name) . '.pdf';
        return response($pdf->Output($filename, 'S'), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
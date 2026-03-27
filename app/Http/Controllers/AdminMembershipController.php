<?php

namespace App\Http\Controllers;

use App\Models\MembershipContent;
use App\Models\MembershipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use setasign\Fpdi\Tcpdf\Fpdi;

class AdminMembershipController extends Controller
{
    /**
     * Show CMS list & form page
     */
    public function index()
    {
        $contents     = MembershipContent::orderBy('type')->orderByDesc('id')->get();
        $applications = MembershipApplication::orderByDesc('id')->get();
        return view('admin.admin_membership', compact('contents', 'applications'));
    }

    /**
     * Store new content (download, members_data, bank)
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules($request));

        $data = $request->only(['type', 'title']);

        if ($request->hasFile('download_file')) {
            $data['file_path'] = $this->storePdfWithTitle(
                $request->file('download_file'),
                $request->input('title'),
                'membership/files'
            );
        }

        if ($request->hasFile('members_image')) {
            $data['file_path'] = $request->file('members_image')
                ->store('membership/files', 'public');
        }

        if ($request->hasFile('bank_top_image')) {
            $data['top_image'] = $request->file('bank_top_image')
                ->store('membership/banks', 'public');
        }

        if ($request->hasFile('bank_qr_image')) {
            $data['qr_image'] = $request->file('bank_qr_image')
                ->store('membership/banks', 'public');
        }

        MembershipContent::create($data);

        return redirect()->route('admin.membership.index')
            ->with('success', 'Content successfully added.');
    }

    /**
     * Update content
     */
    public function update(Request $request, $id)
    {
        $item = MembershipContent::findOrFail($id);
        $request->validate($this->getValidationRules($request, true));

        $data = $request->only(['type', 'title']);
        $type = $request->input('type');

        if ($type === 'download') {
            if ($request->hasFile('file_path')) {
                $this->deleteFile($item->file_path);
                $data['file_path'] = $this->storePdfWithTitle(
                    $request->file('file_path'),
                    $request->input('title') ?? $item->title,
                    'membership/files'
                );
            } elseif ($request->input('title') && $item->file_path) {
                $newFilePath = $this->rewritePdfTitle($item->file_path, $request->input('title'));
                if ($newFilePath) $data['file_path'] = $newFilePath;
            }
        }

        if ($type === 'members_data' && $request->hasFile('file_path')) {
            $this->deleteFile($item->file_path);
            $data['file_path'] = $request->file('file_path')->store('membership/files', 'public');
        }

        if ($request->hasFile('top_image')) {
            $this->deleteFile($item->top_image);
            $data['top_image'] = $request->file('top_image')->store('membership/banks', 'public');
        }

        if ($request->hasFile('qr_image')) {
            $this->deleteFile($item->qr_image);
            $data['qr_image'] = $request->file('qr_image')->store('membership/banks', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.membership.index')
            ->with('success', 'Content successfully updated.');
    }

    /**
     * Delete content
     */
    public function destroy($id)
    {
        $item = MembershipContent::findOrFail($id);
        foreach (['file_path', 'top_image', 'qr_image'] as $field) {
            $this->deleteFile($item->{$field});
        }
        $item->delete();

        return redirect()->route('admin.membership.index')
            ->with('success', 'Content successfully deleted.');
    }

    // ── Application Management ────────────────────────────────────────────────

    /**
     * View single application (returns JSON for modal)
     */
    public function viewApplication($id)
    {
        $application = MembershipApplication::findOrFail($id);
        return response()->json($application);
    }

    /**
     * Download application as PDF — reuses MembershipController::buildPdf
     */
    public function downloadApplication($id)
    {
        $app = MembershipApplication::findOrFail($id);

        // Reuse the shared PDF builder from MembershipController
        $membershipCtrl = new MembershipController();
        $pdf      = $membershipCtrl->buildPdf($app);
        $filename = 'membership-application-' .
            preg_replace('/[^A-Za-z0-9]/', '-', $app->family_name) . '-' .
            preg_replace('/[^A-Za-z0-9]/', '-', $app->given_name) . '.pdf';

        return response($pdf->Output($filename, 'S'), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Delete single application
     */
    public function destroyApplication($id)
    {
        $app = MembershipApplication::findOrFail($id);
        if ($app->photo_2x2) {
            Storage::disk('public')->delete($app->photo_2x2);
        }
        $app->delete();

        return redirect()->route('admin.membership.index')
            ->with('success', 'Application successfully deleted.');
    }

    /**
     * Bulk delete applications
     */
    public function bulkDestroyApplications(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            $apps = MembershipApplication::whereIn('id', $ids)->get();
            foreach ($apps as $app) {
                if ($app->photo_2x2) {
                    Storage::disk('public')->delete($app->photo_2x2);
                }
                $app->delete();
            }
        }

        return redirect()->route('admin.membership.index')
            ->with('success', 'Selected applications deleted.');
    }

    // ── Private Helpers ───────────────────────────────────────────────────────

    private function storePdfWithTitle($file, string $title, string $storagePath): string
    {
        $fileName    = Str::slug($title) . '.pdf';
        $destination = storage_path(
            'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR .
            str_replace('/', DIRECTORY_SEPARATOR, $storagePath)
        );

        if (!file_exists($destination)) mkdir($destination, 0755, true);

        $fullPath = $destination . DIRECTORY_SEPARATOR . $fileName;
        if (file_exists($fullPath)) unlink($fullPath);

        try {
            $pdf = new Fpdi();
            $pdf->SetTitle($title);
            $pdf->SetAuthor('Riviera Golf Club');
            $pdf->SetCreator('Riviera Golf Club CMS');
            $pdf->SetAutoPageBreak(false);

            $pageCount = $pdf->setSourceFile($file->getPathname());
            for ($i = 1; $i <= $pageCount; $i++) {
                $tplId = $pdf->importPage($i);
                $size  = $pdf->getTemplateSize($tplId);
                $pdf->AddPage($size['orientation'] ?? 'P', [$size['width'], $size['height']]);
                $pdf->useTemplate($tplId, 0, 0, $size['width'], $size['height'], true);
            }
            $pdf->Output($fullPath, 'F');
        } catch (\Exception $e) {
            \Log::warning('FPDI failed: ' . $e->getMessage());
            $file->move($destination, $fileName);
        }

        return str_replace('\\', '/', $storagePath . '/' . $fileName);
    }

    private function rewritePdfTitle(string $existingFilePath, string $newTitle): ?string
    {
        if (!Storage::disk('public')->exists($existingFilePath)) return null;

        $fullExistingPath = storage_path(
            'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR .
            str_replace('/', DIRECTORY_SEPARATOR, $existingFilePath)
        );

        $directory       = dirname($fullExistingPath);
        $newFileName     = Str::slug($newTitle) . '.pdf';
        $newFullPath     = $directory . DIRECTORY_SEPARATOR . $newFileName;
        $newRelativePath = str_replace('\\', '/', dirname($existingFilePath) . '/' . $newFileName);

        if (file_exists($newFullPath) && $newFullPath !== $fullExistingPath) unlink($newFullPath);

        try {
            $pdf = new Fpdi();
            $pdf->SetTitle($newTitle);
            $pdf->SetAuthor('Riviera Golf Club');
            $pdf->SetCreator('Riviera Golf Club CMS');
            $pdf->SetAutoPageBreak(false);

            $pageCount = $pdf->setSourceFile($fullExistingPath);
            for ($i = 1; $i <= $pageCount; $i++) {
                $tplId = $pdf->importPage($i);
                $size  = $pdf->getTemplateSize($tplId);
                $pdf->AddPage($size['orientation'] ?? 'P', [$size['width'], $size['height']]);
                $pdf->useTemplate($tplId, 0, 0, $size['width'], $size['height'], true);
            }
            $pdf->Output($newFullPath, 'F');

            if ($fullExistingPath !== $newFullPath && file_exists($fullExistingPath)) {
                unlink($fullExistingPath);
            }
            return $newRelativePath;
        } catch (\Exception $e) {
            \Log::warning('FPDI rewrite failed: ' . $e->getMessage());
            return null;
        }
    }

    private function getValidationRules(Request $request, bool $isUpdate = false): array
    {
        $type  = $request->input('type');
        $rules = [
            'type'  => 'required|in:download,members_data,bank',
            'title' => $type === 'download' ? 'required|string|max:255' : 'nullable|string|max:255',
        ];

        if (!$isUpdate) {
            if ($type === 'download')      $rules['download_file']  = 'required|mimetypes:application/pdf|max:3072';
            elseif ($type === 'members_data') $rules['members_image'] = 'required|image|mimes:jpg,jpeg,png,webp|max:5120';
            elseif ($type === 'bank') {
                $rules['bank_top_image'] = 'required|image|mimes:jpg,jpeg,png,webp|max:5120';
                $rules['bank_qr_image']  = 'required|image|mimes:jpg,jpeg,png,webp|max:5120';
            }
        } else {
            if ($type === 'download')      $rules['file_path']  = 'nullable|mimetypes:application/pdf|max:3072';
            elseif ($type === 'members_data') $rules['file_path'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120';
            elseif ($type === 'bank') {
                $rules['top_image'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120';
                $rules['qr_image']  = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120';
            }
        }

        return $rules;
    }

    private function deleteFile(?string $filePath): void
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
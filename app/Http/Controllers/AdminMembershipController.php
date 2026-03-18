<?php

namespace App\Http\Controllers;

use App\Models\MembershipContent;
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
        $contents = MembershipContent::orderBy('type')->orderByDesc('id')->get();
        return view('admin.admin_membership', compact('contents'));
    }

    /**
     * Store new content (download, members_data, bank)
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules($request));

        $data = $request->only(['type', 'title']);

        // Handle download — embed title into PDF metadata
        if ($request->hasFile('download_file')) {
            $data['file_path'] = $this->storePdfWithTitle(
                $request->file('download_file'),
                $request->input('title'),
                'membership/files'
            );
        }

        // Handle members_data image
        if ($request->hasFile('members_image')) {
            $data['file_path'] = $request->file('members_image')
                ->store('membership/files', 'public');
        }

        // Handle bank images
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
                $newFilePath = $this->rewritePdfTitle(
                    $item->file_path,
                    $request->input('title')
                );
                if ($newFilePath) {
                    $data['file_path'] = $newFilePath;
                }
            }
        }

        // Replace members_data image
        if ($type === 'members_data' && $request->hasFile('file_path')) {
            $this->deleteFile($item->file_path);
            $data['file_path'] = $request->file('file_path')
                ->store('membership/files', 'public');
        }

        // Replace bank images
        if ($request->hasFile('top_image')) {
            $this->deleteFile($item->top_image);
            $data['top_image'] = $request->file('top_image')
                ->store('membership/banks', 'public');
        }

        if ($request->hasFile('qr_image')) {
            $this->deleteFile($item->qr_image);
            $data['qr_image'] = $request->file('qr_image')
                ->store('membership/banks', 'public');
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

    /**
     * Store a PDF with the title embedded into its metadata.
     * Uses DIRECTORY_SEPARATOR for Windows/XAMPP compatibility.
     */
    private function storePdfWithTitle($file, string $title, string $storagePath): string
    {
        $fileName = Str::slug($title) . '.pdf';

        // Use DIRECTORY_SEPARATOR for Windows compatibility
        $destination = storage_path(
            'app' . DIRECTORY_SEPARATOR .
            'public' . DIRECTORY_SEPARATOR .
            str_replace('/', DIRECTORY_SEPARATOR, $storagePath)
        );

        // Ensure directory exists
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $fullPath = $destination . DIRECTORY_SEPARATOR . $fileName;

        // Delete existing file with same name to avoid move conflict
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }

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

                $pdf->AddPage(
                    $size['orientation'] ?? 'P',
                    [$size['width'], $size['height']]
                );

                $pdf->useTemplate($tplId, 0, 0, $size['width'], $size['height'], true);
            }

            $pdf->Output($fullPath, 'F');

        } catch (\Exception $e) {
            // FPDI failed (e.g. compressed PDF) — fall back to moving original file
            \Log::warning('FPDI failed: ' . $e->getMessage() . ' — storing original file.');
            $file->move($destination, $fileName);
        }

        // Always use forward slashes for DB storage path
        return str_replace('\\', '/', $storagePath . '/' . $fileName);
    }

    /**
     * Re-embed a new title into an already-stored PDF.
     * Called when admin updates title without uploading a new file.
     */
    private function rewritePdfTitle(string $existingFilePath, string $newTitle): ?string
    {
        if (!Storage::disk('public')->exists($existingFilePath)) {
            return null;
        }

        $fullExistingPath = storage_path(
            'app' . DIRECTORY_SEPARATOR .
            'public' . DIRECTORY_SEPARATOR .
            str_replace('/', DIRECTORY_SEPARATOR, $existingFilePath)
        );

        $directory       = dirname($fullExistingPath);
        $newFileName     = Str::slug($newTitle) . '.pdf';
$newFullPath     = $directory . DIRECTORY_SEPARATOR . $newFileName;
        $newRelativePath = str_replace('\\', '/', dirname($existingFilePath) . '/' . $newFileName);

        // Delete existing file with same name to avoid conflict
        if (file_exists($newFullPath) && $newFullPath !== $fullExistingPath) {
            unlink($newFullPath);
        }

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

                $pdf->AddPage(
                    $size['orientation'] ?? 'P',
                    [$size['width'], $size['height']]
                );

                $pdf->useTemplate($tplId, 0, 0, $size['width'], $size['height'], true);
            }

            $pdf->Output($newFullPath, 'F');

            // Delete old file if renamed
            if ($fullExistingPath !== $newFullPath && file_exists($fullExistingPath)) {
                unlink($fullExistingPath);
            }

            return $newRelativePath;

        } catch (\Exception $e) {
            \Log::warning('FPDI rewrite failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get validation rules based on request type.
     */
    private function getValidationRules(Request $request, bool $isUpdate = false): array
    {
        $type = $request->input('type');

        $rules = [
            'type'  => 'required|in:download,members_data,bank',
            'title' => $type === 'download'
                        ? 'required|string|max:255'
                        : 'nullable|string|max:255',
        ];

        // ── CREATE rules ─────────────────────────────────────────────────────
        if (!$isUpdate) {
            if ($type === 'download') {
                $rules['download_file'] = 'required|mimetypes:application/pdf|max:3072'; // 3 MB
            } elseif ($type === 'members_data') {
                $rules['members_image'] = 'required|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5 MB
            } elseif ($type === 'bank') {
                $rules['bank_top_image'] = 'required|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5 MB
                $rules['bank_qr_image']  = 'required|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5 MB
            }
        }

        // ── UPDATE rules ─────────────────────────────────────────────────────
        else {
            if ($type === 'download') {
                $rules['file_path'] = 'nullable|mimetypes:application/pdf|max:3072'; // 3 MB
            } elseif ($type === 'members_data') {
                $rules['file_path'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5 MB
            } elseif ($type === 'bank') {
                $rules['top_image'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5 MB
                $rules['qr_image']  = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5 MB
            }
        }

        return $rules;
    }

    /**
     * Delete file from storage if it exists.
     */
    private function deleteFile(?string $filePath): void
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
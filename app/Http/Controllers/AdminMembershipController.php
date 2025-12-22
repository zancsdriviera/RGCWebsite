<?php

namespace App\Http\Controllers;

use App\Models\MembershipContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // Handle file upload for all types
        if ($request->hasFile('download_file')) {
            $data['file_path'] = $this->storeFile($request->file('download_file'), 'membership/files');
        }

        if ($request->hasFile('members_image')) {
            $data['file_path'] = $this->storeFile($request->file('members_image'), 'membership/files');
        }

        if ($request->hasFile('bank_top_image')) {
            $data['top_image'] = $this->storeFile($request->file('bank_top_image'), 'membership/banks');
        }

        if ($request->hasFile('bank_qr_image')) {
            $data['qr_image'] = $this->storeFile($request->file('bank_qr_image'), 'membership/banks');
        }

        MembershipContent::create($data);

        return redirect()->route('admin.membership.index')->with('success', 'Content successfully added.');
    }

    /**
     * Update content
     */
    public function update(Request $request, $id)
    {
        $item = MembershipContent::findOrFail($id);
        
        $request->validate($this->getValidationRules($request, true));

        $data = $request->only(['type', 'title']);

        // replace uploaded files if present
        if ($request->hasFile('file_path')) {
            $this->deleteFile($item->file_path);
            $data['file_path'] = $this->storeFile($request->file('file_path'), 'membership/files');
        }

        if ($request->hasFile('top_image')) {
            $this->deleteFile($item->top_image);
            $data['top_image'] = $this->storeFile($request->file('top_image'), 'membership/banks');
        }

        if ($request->hasFile('qr_image')) {
            $this->deleteFile($item->qr_image);
            $data['qr_image'] = $this->storeFile($request->file('qr_image'), 'membership/banks');
        }

        $item->update($data);

        return redirect()->route('admin.membership.index')->with('success', 'Content successfully updated.');
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

        return redirect()->route('admin.membership.index')->with('success', 'Content successfully deleted.');
    }

    /**
     * Get validation rules based on request type
     */
    private function getValidationRules(Request $request, bool $isUpdate = false): array
    {
        $rules = [
            'type' => 'required|in:download,members_data,bank',
            'title' => 'nullable|string|max:255',
        ];

        $type = $request->input('type');

        // For create operation
        if (!$isUpdate) {
            if ($type === 'download') {
                $rules['download_file'] = 'required|mimetypes:application/pdf|max:3072'; // 3MB for PDF
            } elseif ($type === 'members_data') {
                $rules['members_image'] = 'required|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5MB for images
            } elseif ($type === 'bank') {
                $rules['bank_top_image'] = 'required|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5MB for images
                $rules['bank_qr_image'] = 'required|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5MB for images
            }
        } 
        // For update operation
        else {
            if ($type === 'download') {
                $rules['file_path'] = 'nullable|mimetypes:application/pdf|max:3072'; // 3MB for PDF
            } elseif ($type === 'members_data') {
                $rules['file_path'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5MB for images
            } elseif ($type === 'bank') {
                $rules['top_image'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5MB for images
                $rules['qr_image'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'; // 5MB for images
            }
        }

        return $rules;
    }

    /**
     * Store file with consistent path
     */
    private function storeFile($file, string $path): string
    {
        return $file->store($path, 'public');
    }

    /**
     * Delete file if exists
     */
    private function deleteFile(?string $filePath): void
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
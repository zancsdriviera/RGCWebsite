<?php

namespace App\Services;

use ImageKit\ImageKit;
use Illuminate\Http\UploadedFile;
use RuntimeException;

class ImageKitService
{
    protected ImageKit $imageKit;

    public function __construct()
    {
        $this->imageKit = new ImageKit(
            config('services.imagekit.public_key'),
            config('services.imagekit.private_key'),
            config('services.imagekit.url_endpoint')
        );
    }

    public function upload(UploadedFile $file, string $folder = 'about_us'): array
    {
        $response = $this->imageKit->uploadFile([
            'file' => file_get_contents($file->getRealPath()),
            'fileName' => $file->hashName(),
            'folder' => '/' . trim($folder, '/'),
            'useUniqueFileName' => true,
        ]);

        $result = $response->result ?? null;

        if (!$result || empty($result->url)) {
            throw new RuntimeException('ImageKit image upload failed.');
        }

        return [
            'url' => $result->url,
            'file_id' => $result->fileId ?? null,
        ];
    }
}
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
        $fileContents = file_get_contents($file->getRealPath());

        if ($fileContents === false) {
            throw new RuntimeException('Unable to read the uploaded image.');
        }

        $content = base64_encode($fileContents);

        $response = $this->imageKit->uploadFile([
            'file' => $content,
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

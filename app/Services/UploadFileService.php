<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UploadFileService
{
    public function uploadFile(UploadedFile $file): string
    {
        try {
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('assets/img/hotel');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);

            return 'hotel/' . $fileName;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteFile(string $fileName): void
    {
        try {
            $filePath = public_path('assets/img/' . $fileName);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        } catch (Exception $e) {
            throw new Exception("Delete file error: " . $e->getMessage());
        }
    }
}

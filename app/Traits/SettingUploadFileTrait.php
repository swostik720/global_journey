<?php

namespace App\Traits;
use Illuminate\Support\Facades\Log;

trait SettingUploadFileTrait
{
    private function uploadFile(string $field, string $folder_name, $file): static
    {
        if (!$file) {
            return $this;
        }

        $filePath = public_path('uploaded-images/' . $folder_name . '/' . $file->hashName());

        if (file_exists($filePath)) {
            $deleted = unlink($filePath);
            if (!$deleted) {
                Log::error("Failed to unlink file: $filePath");
            }
        } else {
            Log::info("File not found: $filePath");
        }

        $filename = $file->hashName();
        $file->move(public_path('uploaded-images/' . $folder_name), $filename);
        $this->update([$field => $filename]);

        return $this;
    }

    public function storeLogo(string $field, string $folder_name, $file): static
    {
        return $this->uploadFile($field, $folder_name, $file);
    }

    public function updateLogo(string $field, string $folder_name, $file): static
    {
        return $this->uploadFile($field, $folder_name, $file);
    }

    public function storeFavicon(string $field, string $folder_name, $file): static
    {
        return $this->uploadFile($field, $folder_name, $file);
    }

    public function updateFavicon(string $field, string $folder_name, $file): static
    {
        return $this->uploadFile($field, $folder_name, $file);
    }
}

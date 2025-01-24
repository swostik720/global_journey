<?php

namespace App\Traits;

trait UploadFileTrait
{
    public function storeImage(string $field, string $folder_name, $file, string $image_name = null): static
    {
        $filename = $image_name ?? $file->hashName();
        $file->move(public_path('uploaded-images/' . $folder_name), $filename);
        $this->update([$field => $filename]);
        return $this;
    }

    public function updateImage(string $field, string $folder_name, $file, string $image_name = null): static
    {
        if (isset($this->{$field})) {
            @unlink('uploaded-images/' . $folder_name . '/' . $this->{$field});
        }

        $filename = $image_name ?? $file->hashName();
        $file->move(public_path('uploaded-images/' . $folder_name), $filename);
        $this->update([$field => $filename]);
        return $this;
    }

    public function deleteImage(string $field, string $folder_name): static
    {
        if (isset($this->{$field})) {
            @unlink('uploaded-images/' . $folder_name . '/' . $this->{$field});
        }

        return $this;
    }

    public function storeMultiImage($file, string $folder_name): static
    {
        $filename = $file->hashName();
        $file->move(public_path('uploaded-images/' . $folder_name), $filename);
        $this->image_name = $filename;

        $this->images()->create([
            'image_name' => $filename,
            'imageable_type' => get_class($this),
            'imageable_id' => $this->id,
        ]);

        return $this;
    }
}

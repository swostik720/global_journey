<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'image_alt' => 'nullable|string|max:255',
            'images' => 'required|array|max:20',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:5120', // max 5 MB per image
        ];
    }

    /**
     * Custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'gallery_category_id' => 'gallery category',
            'images.*' => 'image',
        ];
    }
}

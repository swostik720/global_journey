<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'image' => 'nullable|mimes:png,jpg,jpeg,svg,webp,gifmax:5120',
            'name' => 'required',
            'address' => 'nullable|string',
            'rating' => 'nullable|integer',
            'description' => 'required',
            'status' => 'boolean',
        ];
    }
}

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
            'image' => 'nullable|mimes:png,jpg,jpeg,svg,webp,gif|max:2048',
            'name' => 'required',
            'address' => 'nullable|string',
            'rating' => 'nullable|integer',
            'description' => 'required',
            'status' => 'boolean',
        ];
    }
}

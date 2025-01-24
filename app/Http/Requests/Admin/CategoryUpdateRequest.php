<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => "required|string|unique:categories,name,{$this->category->id},id",
            'status' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Blog category name is required',
        ];
    }
}

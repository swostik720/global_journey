<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:categories,name|max:255',
            'status' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Blog category name is required',
            'name.unique' => 'Blog category already exists. Please choose another name',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StudyAbroadUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'image' => 'nullable|mimes:png,jpg,jpeg,svg,webp,gif|max:5120',
            'title' => 'required',
            'slug' => 'nullable',
            'short_description' => 'nullable',
            'description' => 'required',
            'country_id' => 'required|numeric|exists:countries,id',
            'status' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'country_id.required' => 'Country is required. Please select one',
            'title.required' => 'Please input your title',
            'description.required' => 'Description is necessary in this case',
        ];
    }
}

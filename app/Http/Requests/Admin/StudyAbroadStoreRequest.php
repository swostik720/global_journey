<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StudyAbroadStoreRequest extends FormRequest
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
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'nullable|string',
            'faqs.*.answer' => 'nullable|string',
            'quick_info_items' => 'nullable|array',
            'quick_info_items.*.icon' => 'nullable|string|max:120',
            'quick_info_items.*.title' => 'nullable|string|max:190',
            'quick_info_items.*.value' => 'nullable|string|max:500',
            'key_highlights' => 'nullable|array',
            'key_highlights.*.text' => 'nullable|string|max:500',
            'cta_title' => 'nullable|string|max:190',
            'cta_description' => 'nullable|string',
            'cta_button_text' => 'nullable|string|max:120',
            'cta_button_url' => 'nullable|url|max:255',
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

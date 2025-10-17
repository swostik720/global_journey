<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'image' => 'nullable|mimes:png,jpg,jpeg,svg,webp,gif|max:5120',
            'user_id' => 'nullable',
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required',
            'slug' => 'nullable',
            'blog_date' => 'required',
            'short_description' => 'nullable',
            'description' => 'required',
            'status' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'category_id.required' => 'Blog category is required. Please select one',
            'title.required' => 'Please input your blog title',
            'blog_date.required' => 'Please fill out the date for the blog, when it was published',
            'description.required' => 'Description is necessary in this case',
        ];
    }
}

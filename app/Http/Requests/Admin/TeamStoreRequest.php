<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TeamStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'image' => 'nullable|mimes:png,jpg,jpeg,svg,webp,gif|max:5120',
            'name' => 'required|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'experience' => 'nullable|string',
            'fb_link' => 'nullable',
            'twitter_link' => 'nullable',
            'linkedin_link' => 'nullable',
            'instagram_link' => 'nullable',
            'details' => 'nullable',
            'responsibility' => 'required|string',
            'rank' => 'nullable|integer|unique:teams',
            'status' => 'boolean',
        ];
    }
}

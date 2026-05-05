<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BlogAuthorStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'profile_picture' => 'nullable|mimes:png,jpg,jpeg,svg,webp,gif|max:5120',
            'name' => 'required|string|max:190',
            'title' => 'nullable|string|max:190',
            'email' => 'nullable|email|max:190',
            'linkedin_url' => 'nullable|url|max:255',
            'x_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'amazon_url' => 'nullable|url|max:255',
            'website' => 'nullable|url|max:255',
            'education' => 'nullable|string|max:255',
            'expertise' => 'nullable|string|max:255',
            'favourite_tool' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'about_author' => 'nullable|string',
            'status' => 'boolean',
        ];
    }
}

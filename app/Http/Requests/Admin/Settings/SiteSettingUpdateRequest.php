<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'email' => 'nullable',
            'phone' => 'nullable',
            'mobile' => 'nullable',
            'contact_address' => 'nullable',
            'working_hours' => 'nullable',
            'copyright_text' => 'nullable',
            'map_url' => 'nullable',
            'fb_link' => 'nullable',
            'twitter_link' => 'nullable',
            'instagram_link' => 'nullable',
            'linkedIn_link' => 'nullable',
            'description' => 'nullable',
            // 'pinterest_link' => 'nullable',
        ];
    }
}

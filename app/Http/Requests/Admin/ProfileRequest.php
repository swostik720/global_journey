<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'current_password' => 'nullable|string|required_with:new_password|min:8',
            'new_password' => 'nullable|string|min:8',
            'confirm_password' => 'nullable|string|required_with:new_password|same:new_password',
        ];
    }
}

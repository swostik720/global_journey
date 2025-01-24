<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => "required|string|email|unique:users,email,{$this->user->id},id",
            'current_password' => 'nullable|string|required_with:new_password|min:8',
            'new_password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'numeric|exists:permissions,id',
            'confirm_password' => 'nullable|string|required_with:new_password|same:new_password',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'user_status' => 'required',
        ];
    }
}

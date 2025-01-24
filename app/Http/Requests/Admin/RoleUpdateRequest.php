<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
            'slug' => "required|string|unique:roles,slug,{$this->role->id},id|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
            'permissions' => 'required|array',
            'permissions.*' => 'integer',
        ];
    }
}

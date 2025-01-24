<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BranchStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'nullable',
            'contact_address' => 'nullable',
            'working_hours' => 'nullable',
            'status' => 'boolean',
        ];
    }
}

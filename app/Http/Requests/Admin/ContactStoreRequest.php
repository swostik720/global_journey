<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     return auth()->check();
    // }
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'nullable',
            'company_name' => 'nullable',
            'contact_message' => 'required',
            'status' => 'boolean',
        ];
    }
}

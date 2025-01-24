<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'email'=>'required|string',
            'phone'=>'nullable|string',
            'company_name'=>'nullable|string',
            'contact_message'=>'required|string',
            'status'=>'boolean',
            ];
    }
}

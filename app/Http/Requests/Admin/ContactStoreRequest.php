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
            'address' => 'nullable|string',
            'interested_country' => 'nullable|in:United State,Canada,UK,Australia,Newzerland',
            'last_qualification' => 'nullable|string',
            'test_preparation' => 'nullable|in:IELTS,PTE',
            'branch_id' => 'nullable',
        ];
    }
}

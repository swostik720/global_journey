<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'studyabroad_id' => 'nullable|numeric|exists:study_abroads,id',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'nullable',
            'address' => 'required',
            'enquiry_message' => 'required',
            'status' => 'nullable',
        ];
    }
}

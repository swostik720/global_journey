<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'studyabroad_id'=>'required|integer',
            'name'=>'required|string',
            'email'=>'required|string',
            'address'=>'required|string',
            'phone'=>'required|string',
            'enquiry_message'=>'required|string|min:10',
            'status'=>'required|string',
            ];
    }
}

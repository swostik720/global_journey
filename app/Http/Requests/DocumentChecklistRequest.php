<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class DocumentChecklistRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country_id' => ['required', 'exists:countries,id'],
            'documents' => ['required', 'array', 'min:1'],
            'documents.*.name' => ['required', 'string', 'max:255'],
            'documents.*.description' => ['nullable', 'string'],
            'pdf_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ];
    }
}

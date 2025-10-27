<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\DocumentChecklistType;

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
            // 'documents' => ['required', 'string'],
            'documents' => ['required', 'json'], // ✅ VALID JSON
        ];
    }
}

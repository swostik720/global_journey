<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class LegalPageUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'terms_title' => 'required|string|max:255',
            'terms_description' => 'required|string',
            'terms_last_updated' => 'nullable|string|max:255',
            'privacy_title' => 'required|string|max:255',
            'privacy_description' => 'required|string',
            'privacy_last_updated' => 'nullable|string|max:255',
        ];
    }
}

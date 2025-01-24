<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CountryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => "required|string|unique:countries,name,{$this->country->id},id",
            'status' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Country name is required',
            'name.unique' => 'Country already exists. Please choose another name',
        ];
    }
}

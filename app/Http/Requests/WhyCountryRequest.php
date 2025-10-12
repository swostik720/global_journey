<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WhyCountryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to true to allow requests
    }

    public function rules()
    {
        return [
            'country_id' => 'required|exists:countries,id',
            'description' => 'required|string', // will be processed as JSON in controller
        ];
    }

    public function messages()
    {
        return [
            'country_id.required' => 'Please select a country.',
            'country_id.exists' => 'Selected country is invalid.',
            'description.required' => 'Please enter at least one reason.',
        ];
    }
}

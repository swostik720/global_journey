<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryGuideRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country_id' => 'required|exists:countries,id',
            'guides' => 'required|array|min:1',
            'guides.*' => 'required|string',
        ];
    }
}

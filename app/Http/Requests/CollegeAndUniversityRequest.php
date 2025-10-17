<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollegeAndUniversityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country_id' => 'required|exists:countries,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
        ];
    }
}

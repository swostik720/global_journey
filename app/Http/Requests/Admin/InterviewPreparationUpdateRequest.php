<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InterviewPreparationUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
            'status' => 'boolean',
            'visa_conditions' => 'nullable|array',
            'visa_conditions.*' => 'nullable|string|max:255',
            'interview_questions' => 'nullable|array',
            'interview_questions.*' => 'nullable|string|max:255',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'nullable|string|max:255',
            'faqs.*.answer' => 'nullable|string',
        ];
    }
}

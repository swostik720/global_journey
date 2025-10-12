<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewPreparationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'boolean',
            'visa_conditions' => 'nullable|array',
            'visa_conditions.*' => 'nullable|string|max:255',
            'interview_questions' => 'nullable|array',
            'interview_questions.*.question' => 'required|string|max:255',
            'interview_questions.*.answer' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required|string|max:255',
            'faqs.*.answer' => 'nullable|string',
        ];
    }
}

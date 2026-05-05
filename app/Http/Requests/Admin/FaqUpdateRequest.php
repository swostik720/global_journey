<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $faqId = $this->route('faq')?->id;

        return [
            'question' => "required|string|max:255|unique:faqs,question,{$faqId},id",
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'question.required' => 'Question is required.',
            'answer.required' => 'Answer is required.',
        ];
    }
}

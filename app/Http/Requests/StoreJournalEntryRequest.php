<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJournalEntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'entry_date' => 'required|date',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Journal entry title is required.',
            'title.max' => 'Journal entry title cannot exceed 255 characters.',
            'content.required' => 'Journal entry content is required.',
            'content.min' => 'Journal entry content must be at least 10 characters long.',
            'entry_date.required' => 'Entry date is required.',
            'entry_date.date' => 'Please provide a valid entry date.',
        ];
    }
}
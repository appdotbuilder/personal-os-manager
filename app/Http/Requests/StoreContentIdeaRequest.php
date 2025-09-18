<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentIdeaRequest extends FormRequest
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
            'description' => 'nullable|string',
            'status' => 'required|in:idea,draft,scheduled,completed',
            'content_type' => 'required|in:article,video,live_stream,social_post,other',
            'scheduled_at' => 'nullable|date|after:now',
            'keywords' => 'nullable|array',
            'keywords.*' => 'string|max:100',
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
            'title.required' => 'Content title is required.',
            'title.max' => 'Content title cannot exceed 255 characters.',
            'status.required' => 'Content status is required.',
            'status.in' => 'Invalid content status selected.',
            'content_type.required' => 'Content type is required.',
            'content_type.in' => 'Invalid content type selected.',
            'scheduled_at.date' => 'Please provide a valid scheduled date.',
            'scheduled_at.after' => 'Scheduled date must be in the future.',
        ];
    }
}
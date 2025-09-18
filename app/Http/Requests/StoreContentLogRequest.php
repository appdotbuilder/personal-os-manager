<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentLogRequest extends FormRequest
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
            'content_type' => 'required|in:article,video,live_stream',
            'url' => 'nullable|url',
            'keywords' => 'nullable|array',
            'keywords.*' => 'string|max:100',
            'categories' => 'nullable|array',
            'categories.*' => 'string|max:50',
            'views' => 'nullable|integer|min:0',
            'engagement' => 'nullable|integer|min:0',
            'published_at' => 'required|date',
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
            'content_type.required' => 'Content type is required.',
            'content_type.in' => 'Invalid content type selected.',
            'url.url' => 'Please provide a valid URL.',
            'views.integer' => 'Views must be a number.',
            'views.min' => 'Views cannot be negative.',
            'engagement.integer' => 'Engagement must be a number.',
            'engagement.min' => 'Engagement cannot be negative.',
            'published_at.required' => 'Published date is required.',
            'published_at.date' => 'Please provide a valid published date.',
        ];
    }
}
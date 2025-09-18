<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'status' => 'required|in:todo,backlog,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
            'scheduled_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
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
            'title.required' => 'Task title is required.',
            'title.max' => 'Task title cannot exceed 255 characters.',
            'status.required' => 'Task status is required.',
            'status.in' => 'Invalid task status selected.',
            'priority.required' => 'Task priority is required.',
            'priority.in' => 'Invalid task priority selected.',
            'scheduled_at.date' => 'Please provide a valid scheduled date.',
            'completed_at.date' => 'Please provide a valid completion date.',
        ];
    }
}
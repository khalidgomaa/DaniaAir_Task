<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChecklistRequest extends FormRequest
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
    public function rules()
    {
        return [
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.response' => 'required|in:yes,no',
            'answers.*.comments' => 'nullable|string',
            'inspector' => 'required|exists:users,id',
            'inspection_date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ];
    }

    public function messages()
    {
        return [
            'answers.*.question_id.required' => 'The question ID is required.',
            'answers.*.response.required' => 'The response is required.',
            'inspector.required' => 'The inspector is required.',
            'inspection_date.required' => 'The inspection date is required.',
            'time.required' => 'The time is required.',
        ];
    }
}

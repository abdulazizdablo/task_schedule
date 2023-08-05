<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:30',
            'priority' => 'required|digits_between:1,6|min:0|unique:tasks,priority|max:30',
            'project' => 'required|max:30'
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Task name is required',
            'priority.required' => 'Task priority is required',
        ];
    }
}

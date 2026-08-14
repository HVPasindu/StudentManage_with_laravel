<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_number')
                    ->ignore($this->student->id),
            ],

            'first_name' => 'required|string|max:255',

            'last_name' => 'required|string|max:255',
            //this enne route valin search karala ma ena id eken.
            'email' => [
                'nullable',
                'email',
                Rule::unique('students', 'email')
                    ->ignore($this->student->id),
            ],

            'date_of_birth' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'student_number.required' => 'Student number is required.',
            'student_number.unique' => 'This student number is already used.',

            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',

            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already used.',

            'date_of_birth.date' => 'Please enter a valid date of birth.',
        ];
    }
}

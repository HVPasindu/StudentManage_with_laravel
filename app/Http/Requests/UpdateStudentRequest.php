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
}

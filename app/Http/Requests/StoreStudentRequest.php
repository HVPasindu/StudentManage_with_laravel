<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //validated ekata enne array ekak request eke n validate method eka use karala api eka check karano hari giyoth eka return karano array ekak vidiyata and eka deno validated ekata.....
        return [
            'student_number' => 'required|string|max:50|unique:students,student_number',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email',
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

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)

    //validated ekata enne array ekak request eke n validate method eka use karala api eka check karano hari giyoth eka save kara gannava.
    {
        $validated = $request->validate([
            'student_number' => 'required|string|max:50|unique:students,student_number',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:students,email',
            'date_of_birth' => 'nullable|date',
        ]);

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully.');
    }


    public function show(Student $student)
    {
        return view('students.show', compact('student'));

    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_number')->ignore($student->id),
            ],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'email',
                Rule::unique('students', 'email')->ignore($student->id),
            ],
            'date_of_birth' => 'nullable|date',
        ]);

        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Validation\Rule;
class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::query()
            ->when($search, function ($query, $search) {
                $query->where('student_number', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(3)
            ->withQueryString();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        $validated = $request->validated();

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully.');
    }


    public function show(Student $student)
    {
        $student->load('profile', 'subjects');

        $subjects = Subject::orderBy('name')->get();

        return view('students.show', compact('student', 'subjects'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validated = $request->validated();

        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }

    public function enrollSubject(Request $request, Student $student)
    {
        $validated = $request->validate([
            'subject_id' => [
                'required',
                'exists:subjects,id',
                Rule::unique('student_subject', 'subject_id')
                    ->where(fn($query) => $query->where('student_id', $student->id)),
            ],
            'enrolled_at' => 'nullable|date',
        ]);

        $student->subjects()->attach($validated['subject_id'], [
            'enrolled_at' => $validated['enrolled_at'] ?? now()->toDateString(),
            'status' => 'active',
        ]);

        return redirect()
            ->route('students.show', $student)
            ->with('success', 'Student enrolled successfully.');
    }
}

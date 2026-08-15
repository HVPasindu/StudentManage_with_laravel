@extends('layouts.app')

@section('title', 'Student Details')

@section('content')

    <h1>Student Details</h1>

    <p>
        <strong>Student Number:</strong>
        {{ $student->student_number }}
    </p>

    <p>
        <strong>First Name:</strong>
        {{ $student->first_name }}
    </p>

    <p>
        <strong>Last Name:</strong>
        {{ $student->last_name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $student->email }}
    </p>

    <p>
        <strong>Date of Birth:</strong>
        {{ $student->date_of_birth }}
    </p>

    <h2>Student Profile</h2>

    @if ($student->profile)
        <p>
            <strong>Address:</strong>
            {{ $student->profile->address }}
        </p>

        <p>
            <strong>Phone:</strong>
            {{ $student->profile->phone }}
        </p>

        <p>
            <strong>Guardian Name:</strong>
            {{ $student->profile->guardian_name }}
        </p>

        <p>
            <strong>Guardian Phone:</strong>
            {{ $student->profile->guardian_phone }}
        </p>
    @else
        <p>No profile found for this student.</p>
    @endif

    <h2>Subjects</h2>

    @if ($student->subjects->isNotEmpty())

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Enrolled Date</th>
                    <th>Status</th>
                    <th>Final Mark</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($student->subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>

                        <td>
                            {{ $subject->pivot->enrolled_at ?? '-' }}
                        </td>

                        <td>
                            {{ $subject->pivot->status ?? '-' }}
                        </td>

                        <td>
                            {{ $subject->pivot->final_mark ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No subjects enrolled.</p>

    @endif

    <h2>Enroll New Subject</h2>

    <select name="subject_id">
        <option value="">Select Subject</option>

        @foreach ($subjects as $subject)
            <option value="{{ $subject->id }}">
                {{ $subject->name }}
            </option>
        @endforeach
    </select>
    <a href="{{ route('students.edit', $student) }}">
        Edit Student
    </a>

    <br><br>

    <a href="{{ route('students.index') }}">
        Back to Students
    </a>

@endsection

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

    <a href="{{ route('students.edit', $student) }}">
        Edit Student
    </a>

    <br><br>

    <a href="{{ route('students.index') }}">
        Back to Students
    </a>

@endsection

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

    @if (session('success'))
        <div id="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if ($student->subjects->isNotEmpty())

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Enrolled Date</th>
                    <th>Status</th>
                    <th>Final Mark</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($student->subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>

                        <td>
                            <input type="date" name="enrolled_at" value="{{ $subject->pivot->enrolled_at }}"
                                form="update-subject-{{ $subject->id }}">
                        </td>

                        <td>
                            <select name="status" form="update-subject-{{ $subject->id }}">
                                <option value="active" {{ $subject->pivot->status === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="completed" {{ $subject->pivot->status === 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                                <option value="dropped" {{ $subject->pivot->status === 'dropped' ? 'selected' : '' }}>
                                    Dropped
                                </option>
                            </select>
                        </td>

                        <td>
                            <input type="number" name="final_mark" min="0" max="100" step="0.01"
                                value="{{ $subject->pivot->final_mark }}" form="update-subject-{{ $subject->id }}">
                        </td>

                        <td>
                            <form id="update-subject-{{ $subject->id }}" method="POST"
                                action="{{ route('students.subjects.update', [$student, $subject]) }}"
                                style="display:inline;">
                                @csrf
                                @method('PUT')

                                <button type="submit">Update</button>
                            </form>

                            <form method="POST" action="{{ route('students.subjects.remove', [$student, $subject]) }}"
                                style="display:inline;" onsubmit="return confirm('Remove this subject from the student?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No subjects enrolled.</p>

    @endif

    <h2>Enroll New Subject</h2>

    <form method="POST" action="{{ route('students.subjects.enroll', $student) }}">
        @csrf

        <div>
            <label>Subject</label>

            <select name="subject_id">
                <option value="">Select Subject</option>

                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>

            @error('subject_id')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Enrolled Date</label>

            <input type="date" name="enrolled_at" value="{{ old('enrolled_at') }}">

            @error('enrolled_at')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Enroll Subject</button>
    </form>
    <a href="{{ route('students.edit', $student) }}">
        Edit Student
    </a>

    <br><br>

    <a href="{{ route('students.index') }}">
        Back to Students
    </a>

    <script>
        setTimeout(function() {
            const message = document.getElementById('success-message');

            if (message) {
                message.style.display = 'none';
            }
        }, 3000);
    </script>

@endsection

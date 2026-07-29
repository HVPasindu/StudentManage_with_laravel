<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>

    <h1>Edit Student</h1>

    @if ($errors->any())
        <div>
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('students.update', $student) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Student Number</label>
            <input
                type="text"
                name="student_number"
                value="{{ old('student_number', $student->student_number) }}"
            >

            @error('student_number')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>First Name</label>
            <input
                type="text"
                name="first_name"
                value="{{ old('first_name', $student->first_name) }}"
            >

            @error('first_name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Last Name</label>
            <input
                type="text"
                name="last_name"
                value="{{ old('last_name', $student->last_name) }}"
            >

            @error('last_name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email', $student->email) }}"
            >

            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Date of Birth</label>
            <input
                type="date"
                name="date_of_birth"
                value="{{ old('date_of_birth', optional($student->date_of_birth)->format('Y-m-d')) }}"
            >

            @error('date_of_birth')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Update Student</button>
    </form>

    <a href="{{ route('students.index') }}">Back to Students</a>

</body>
</html>

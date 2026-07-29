<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
</head>

<body>

    <h1>Create Student</h1>

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

    <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <div>
            <label>Student Number</label>
            <input type="text" name="student_number" value="{{ old('student_number') }}">
        </div>

        <div>
            <label>First Name</label>
            <input type="text" name="first_name"  value="{{ old('first_name') }}">
        </div>

        <div>
            <label>Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}">
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth"  value="{{ old('date_of_birth') }}">
        </div>

        <button type="submit">Save Student</button>
    </form>

    <a href="{{ route('students.index') }}">Back to Students</a>

</body>

</html>

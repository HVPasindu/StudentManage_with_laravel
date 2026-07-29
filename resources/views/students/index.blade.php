<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
</head>

<body>

    <h1>Students</h1>

    @if (session('success'))
        <div id="success-message">
            {{ session('success') }}
        </div>
    @endif

    <script>
        setTimeout(function() {
            const message = document.getElementById('success-message');

            if (message) {
                message.style.display = 'none';
            }
        }, 3000);
    </script>
    <a href="{{ route('students.create') }}">Create Student</a>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->student_number }}</td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->date_of_birth }}</td>
                    <td>
                        <a href="{{ route('students.show', $student) }}">View</a>
                        <a href="{{ route('students.edit', $student) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

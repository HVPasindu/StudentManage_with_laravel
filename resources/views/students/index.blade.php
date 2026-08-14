@extends('layouts.app')

@section('title', 'Students')

@section('content')

    <h1>Students</h1>

    @if (session('success'))
        <div id="success-message">
            {{ session('success') }}
        </div>
    @endif

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

                        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('Are you sure you want to delete this student?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $students->links() }}
    <script>
        setTimeout(function() {
            const message = document.getElementById('success-message');

            if (message) {
                message.style.display = 'none';
            }
        }, 3000);
    </script>

@endsection

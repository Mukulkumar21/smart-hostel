<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Login</title>
</head>
<body>
    <h2>Welcome to Smart Hostel</h2>

    <p>Hello {{ $student->name }},</p>

    <p>Your student account has been created.</p>

    <p><strong>Login Details:</strong></p>
    <ul>
        <li>Email: {{ $student->email }}</li>
        <li>Password: {{ $password }}</li>
    </ul>

    <p>
        Login here:
        <a href="{{ url('/student/login') }}">
            {{ url('/student/login') }}
        </a>
    </p>

    <p>Please change your password after login.</p>

    <br>
    <p>– Smart Hostel Team</p>
</body>
</html>
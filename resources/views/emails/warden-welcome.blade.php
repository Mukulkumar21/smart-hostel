<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Warden Login</title>
</head>
<body>
    <h2>Welcome to Smart Hostel</h2>

    <p>Hello {{ $warden->name }},</p>

    <p>Your warden account has been created.</p>

    <p><strong>Login Details:</strong></p>
    <ul>
        <li>Email: {{ $warden->email }}</li>
        <li>Password: {{ $password }}</li>
    </ul>

    <p>
        Login here:
        <a href="{{ url('/warden/login') }}">
            {{ url('/warden/login') }}
        </a>
    </p>

    <p>Please change your password after login.</p>

    <br>
    <p>– Smart Hostel Team</p>
</body>
</html>
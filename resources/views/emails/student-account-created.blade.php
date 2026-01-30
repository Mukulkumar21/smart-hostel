<h2>Hello {{ $student->name }}</h2>

<p>Your Smart Hostel account has been created.</p>

<p><strong>Login Details:</strong></p>

<p>
Email: {{ $student->email }} <br>
Password: {{ $password }}
</p>

<p>
Login URL: <br>
<a href="{{ url('/student/login') }}">
{{ url('/student/login') }}
</a>
</p>

<p>
⚠️ Please change your password after first login.
</p>

<p>– Smart Hostel Team</p>
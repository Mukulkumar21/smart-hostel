<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Warden Login | Smart Hostel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-100 to-blue-100">

<div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-purple-700">Warden Login</h2>
        <p class="text-sm text-gray-500">Smart Hostel Management</p>
    </div>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('warden.login.submit') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="w-full px-4 py-2 border rounded-lg"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password"
                   name="password"
                   class="w-full px-4 py-2 border rounded-lg"
                   required>
        </div>

        <button type="submit"
                class="w-full bg-purple-600 text-white py-2 rounded-lg">
            Login
        </button>
    </form>

</div>

</body>
</html>

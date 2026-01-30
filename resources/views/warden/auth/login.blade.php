<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Warden Login | Smart Hostel</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-100 to-blue-100">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

        {{-- LOGO / TITLE --}}
        <div class="text-center mb-6">
            <div class="text-4xl mb-2">🧑‍✈️</div>
            <h2 class="text-2xl font-bold text-purple-700">
                Warden Login
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Smart Hostel Management
            </p>
        </div>

        {{-- ERROR MESSAGE --}}
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- LOGIN FORM --}}
        <form method="POST" action="{{ route('warden.login.submit') }}" class="space-y-5">
            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       placeholder="warden@example.com"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input type="password"
                       name="password"
                       required
                       placeholder="••••••••"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                    class="w-full bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
                Login
            </button>
        </form>

        {{-- FOOTER LINKS --}}
        <div class="text-center mt-6 text-sm">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                Login as Admin
            </a>
        </div>

    </div>

</body>
</html>
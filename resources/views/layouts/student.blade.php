<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Panel | Smart Hostel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white">
        <div class="p-4 text-xl font-bold border-b border-blue-500">
            Smart Hostel
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('student.dashboard') }}"
               class="block px-3 py-2 rounded hover:bg-blue-600">
                Dashboard
            </a>

            <a href="{{ route('student.profile') }}"
               class="block px-3 py-2 rounded hover:bg-blue-600">
                My Profile
            </a>
<a href="{{ route('student.movements') }}"
   class="block px-3 py-2 rounded hover:bg-blue-600">
   Movement History
</a>
<li class="mb-2">
    <a href="{{ route('student.gatepass.form') }}"
       class="block px-4 py-2 rounded hover:bg-blue-700">
        Gate Pass
    </a>
</li>
            <form method="POST" action="{{ route('student.logout') }}">
                @csrf
                <button class="w-full text-left px-3 py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</div>

</body>
</html>
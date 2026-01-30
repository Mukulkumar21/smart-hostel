<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Hostel</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        html.dark body { background:#0f172a; color:#f8fafc; }
        html.dark header { background:#1e293b !important; }
        html.dark aside { background:#020617 !important; }
        html.dark .bg-white {
            background:#1e293b !important;
            color:#f8fafc !important;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- RIGHT SIDE --}}
    <div class="flex-1 flex flex-col">

        {{-- HEADER --}}
        <header class="h-16 bg-white shadow flex items-center justify-between px-6">

            {{-- TITLE --}}
            <h1 class="text-xl font-semibold">
                @auth('warden')
                    Warden Panel
                @elseauth
                    Admin Panel
                @endauth
            </h1>

            {{-- ACTION BUTTONS --}}
            <div class="flex items-center gap-3">

                {{-- ADMIN SWITCH --}}
                @auth('warden')
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm">
                        Go to Admin
                    </a>
                @endauth

                {{-- WARDEN SWITCH --}}
            @auth('web')
@if(auth('web')->check() && !auth('warden')->check())
    <a href="{{ route('warden.login') }}"
       class="px-3 py-1 rounded bg-purple-600 text-white hover:bg-purple-700 text-sm">
        Go to Warden
    </a>
@endif
@endauth
                {{-- DARK MODE --}}
                <button id="theme-toggle" class="text-xl">🌙</button>
            </div>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>

    </div>
</div>

<script>
document.getElementById('theme-toggle').onclick = () => {
    document.documentElement.classList.toggle('dark');
};
</script>

</body>
</html>
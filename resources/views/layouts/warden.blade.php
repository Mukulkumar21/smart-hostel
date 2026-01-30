<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Warden | Smart Hostel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ✅ STABLE LIGHT / DARK CSS -->
    <style>
        /* ===== LIGHT MODE ===== */
        html[data-theme="light"] body {
            background: #f3f4f6;
            color: #111827;
        }
        html[data-theme="light"] .card {
            background: #ffffff;
            color: #111827;
        }

        /* ===== DARK MODE ===== */
        html[data-theme="dark"] body {
            background: #020617;
            color: #e5e7eb;
        }
        html[data-theme="dark"] .card {
            background: #0f172a;
            color: #e5e7eb;
        }
    </style>
</head>

<body>

<div class="flex min-h-screen">

    <!-- SIDEBAR (Always Dark) -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col">
        <div class="p-4 text-xl font-bold border-b border-slate-700">
            Smart Hostel
            <div class="text-sm text-slate-400">(Warden Panel)</div>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('warden.dashboard') }}" class="block px-3 py-2 rounded bg-blue-600">
                Dashboard
            </a>
            <a href="{{ route('warden.students.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
                Students
            </a>
            <a href="{{ route('warden.gatepasses.index') }}" class="block px-3 py-2 rounded hover:bg-slate-700">
                Gate Pass Requests
            </a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- TOP BAR -->
        <header class="flex justify-end p-4 border-b bg-white">
            <button
                onclick="toggleTheme()"
                class="px-4 py-2 rounded bg-gray-300 text-black font-semibold"
            >
                🌗 Day / Dark
            </button>
        </header>

        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>
</div>

<script>
    function toggleTheme() {
        const html = document.documentElement;
        const next = html.dataset.theme === 'dark' ? 'light' : 'dark';
        html.dataset.theme = next;
        localStorage.setItem('theme', next);
    }

    // Restore on reload
    const saved = localStorage.getItem('theme');
    if (saved) {
        document.documentElement.dataset.theme = saved;
    }
</script>

</body>
</html>

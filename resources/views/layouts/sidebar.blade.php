<aside class="w-64 bg-blue-900 text-white min-h-screen">

    <div class="px-6 py-6 text-2xl font-bold border-b border-blue-700">
        Smart Hostel
    </div>

    <nav class="mt-6 space-y-1">

        {{-- WARDEN --}}
        @if(auth()->guard('warden')->check())

            <a href="{{ route('warden.dashboard') }}" class="block px-6 py-3 hover:bg-blue-700">
                Warden Dashboard
            </a>

            <a href="{{ route('warden.students.index') }}" class="block px-6 py-3 hover:bg-blue-700">
                Students
            </a>

        {{-- ADMIN --}}
        @elseif(auth()->guard('web')->check())

            <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-blue-700">
                Admin Dashboard
            </a>

            <a href="{{ route('students.index') }}" class="block px-6 py-3 hover:bg-blue-700">
                Students
            </a>

            <a href="{{ route('rooms.index') }}" class="block px-6 py-3 hover:bg-blue-700">
                Rooms
            </a>

            <a href="{{ route('fees.index') }}" class="block px-6 py-3 hover:bg-blue-700">
                Fees
            </a>

            <a href="{{ route('admin.wardens.create') }}" class="block px-6 py-3 hover:bg-blue-700">
                Create Warden
            </a>

        @endif

    </nav>
</aside>
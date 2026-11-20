<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin WorkshopTix')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col">

            <div class="p-6 border-b border-slate-700">
                <h1 class="text-2xl font-bold">
                    WORKSHOP<span class="text-yellow-400">TIX</span>
                </h1>
                <p class="text-xs text-slate-400 mt-1">
                    ADMIN PANEL
                </p>
            </div>

            <nav class="flex-1 p-4 space-y-2">

                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg hover:bg-slate-700">
                    Dashboard
                </a>

                <a href="{{ route('admin.workshops.index') }}" class="block px-4 py-3 rounded-lg hover:bg-slate-700">
                    Kelola Workshop
                </a>
                <a href="{{ route('admin.registrations.index') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-700">
                    Manajemen Pendaftaran
                </a>

            </nav>

            <div class="p-4 border-t border-slate-700">
                <p class="text-sm text-slate-300">
                    {{ auth()->user()->name }}
                </p>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="mt-3 w-full bg-red-500 hover:bg-red-600 py-2 rounded-lg">
                        Logout
                    </button>
                </form>
            </div>

        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <header class="bg-white shadow-sm px-8 py-5">
                <h2 class="text-xl font-semibold text-gray-800">
                    @yield('page-title', 'Dashboard')
                </h2>
            </header>

            <main class="p-8">

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-5">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', $title ?? 'WorkshopTIX')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 min-h-screen">

    <nav class="bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('peserta.dashboard') }}" class="text-xl font-bold">
                WorkshopTIX
            </a>

            <div class="flex items-center gap-5">
                <a href="{{ route('peserta.dashboard') }}" class="hover:text-blue-300">
                    Dashboard
                </a>
                            <a href="{{ route('peserta.workshops.index') }}">
                Lihat Workshop
            </a>



                <span class="text-slate-300">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-600 px-4 py-2 rounded-lg hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @isset($header)
            <div class="mb-6">
                {{ $header }}
            </div>
        @endisset

        @hasSection('content')
            @yield('content')
        @else
            {{ $slot ?? '' }}
        @endif

    </main>

</body>

</html>

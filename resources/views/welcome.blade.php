<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f172a">
    <title>{{ config('app.name', 'WorkshopTIX') }} — Belajar lewat workshop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased">
    <header class="border-b border-slate-800 bg-slate-900 text-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-8" aria-label="Navigasi utama">
            <a href="{{ url('/') }}" class="flex items-center gap-3" aria-label="WorkshopTIX beranda">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-600 text-lg font-black text-white">W</span>
                <span class="text-lg font-extrabold tracking-tight text-white">Workshop<span class="text-orange-300">TIX</span></span>
            </a>

            <div class="flex items-center gap-3 sm:gap-6">
                <a href="#tentang" class="hidden text-sm font-semibold text-slate-300 transition hover:text-white sm:inline">Tentang</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-xl bg-orange-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-orange-700">Dashboard</a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 transition hover:text-white">Masuk</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-xl bg-orange-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-orange-700">Daftar</a>
                    @endif
                @endauth
            </div>
        </nav>
    </header>

    <main>
        <section class="relative overflow-hidden bg-orange-50">

            <div class="mx-auto grid max-w-7xl items-center gap-14 px-5 py-20 sm:px-8 sm:py-28 lg:grid-cols-2 lg:py-32">
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full border border-orange-200 bg-white px-4 py-2 text-xs font-bold uppercase tracking-[0.18em] text-orange-800">
                        <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                        Ruang belajar dan berkembang
                    </span>
                    <h1 class="mt-7 max-w-2xl text-4xl font-black leading-tight tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                        Skill baru dimulai dari <span class="text-orange-700">satu workshop.</span>
                    </h1>
                    <p class="mt-6 max-w-xl text-base leading-8 text-slate-600 sm:text-lg">
                        Temukan workshop yang sesuai minatmu, daftar dengan mudah, dan siapkan diri untuk pengalaman belajar yang lebih praktis.
                    </p>

                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                        @auth
                                <a href="{{ route('peserta.workshops.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-600 px-6 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-orange-700">
                                Jelajahi Workshop
                                <span aria-hidden="true">→</span>
                            </a>
                            <a href="{{ route('peserta.dashboard') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-6 py-3.5 text-sm font-bold text-slate-700 transition hover:bg-white">Lihat Dashboard</a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-600 px-6 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-orange-700">
                                    Mulai Sekarang
                                    <span aria-hidden="true">→</span>
                                </a>
                            @endif
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-6 py-3.5 text-sm font-bold text-slate-700 transition hover:bg-white">Saya Sudah Punya Akun</a>
                            @endif
                        @endauth
                    </div>

                    <div class="mt-10 flex flex-wrap items-center gap-x-7 gap-y-3 text-sm text-slate-600">
                        <span class="inline-flex items-center gap-2"><span class="text-emerald-400">✓</span> Pendaftaran online</span>
                        <span class="inline-flex items-center gap-2"><span class="text-emerald-400">✓</span> Informasi workshop jelas</span>
                        <span class="inline-flex items-center gap-2"><span class="text-emerald-400">✓</span> Tiket digital</span>
                    </div>
                </div>

                <div class="relative mx-auto w-full max-w-lg">
                    <div class="absolute -inset-5 rounded-[2rem] bg-orange-200/70 blur-2xl"></div>
                    <div class="relative overflow-hidden rounded-[1.75rem] border border-white/10 bg-white p-6 shadow-2xl shadow-black/30 sm:p-8">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-700">WorkshopTIX</p>
                                <h2 class="mt-2 text-2xl font-black tracking-tight text-slate-900">Belajar lebih terarah</h2>
                            </div>
                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-orange-100 text-orange-700">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                    <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z" stroke-width="1.8" stroke-linejoin="round"/>
                                    <path d="M4 17a2.5 2.5 0 0 1 2.5-2.5H20M8 7h8M8 10h5" stroke-width="1.8" stroke-linecap="round"/>
                                </svg>
                            </span>
                        </div>

                        <div class="mt-8 space-y-4">
                            <div class="flex items-center gap-4 rounded-2xl bg-slate-50 p-4">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-sm font-black text-orange-800">01</span>
                                <div>
                                    <p class="font-bold text-slate-900">Pilih workshop</p>
                                    <p class="mt-1 text-sm text-slate-500">Cari topik yang ingin kamu pelajari.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 rounded-2xl bg-slate-50 p-4">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-sm font-black text-amber-800">02</span>
                                <div>
                                    <p class="font-bold text-slate-900">Daftar dan siapkan pembayaran</p>
                                    <p class="mt-1 text-sm text-slate-500">Pantau status pendaftaran dari dashboard.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 rounded-2xl bg-slate-50 p-4">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-sm font-black text-emerald-700">03</span>
                                <div>
                                    <p class="font-bold text-slate-900">Ikuti pengalaman belajarnya</p>
                                    <p class="mt-1 text-sm text-slate-500">Akses tiket digital setelah pendaftaran dikonfirmasi.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-between rounded-2xl bg-slate-900 px-5 py-4 text-white">
                            <div>
                                <p class="text-xs font-semibold text-slate-400">LANGKAH PERTAMA</p>
                                <p class="mt-1 font-bold">Temukan workshop pilihanmu</p>
                            </div>
                            <span class="text-2xl text-orange-400" aria-hidden="true">✦</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="tentang" class="mx-auto max-w-7xl px-5 py-20 sm:px-8 sm:py-24">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-bold uppercase tracking-[0.18em] text-orange-700">Dibuat untuk pengalaman yang mudah</p>
                <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">Semua kebutuhan workshop dalam satu tempat</h2>
                <p class="mt-4 leading-7 text-slate-600">Dari menemukan kegiatan sampai memeriksa status pendaftaran, semuanya bisa dilakukan melalui WorkshopTIX.</p>
            </div>

            <div class="mt-12 grid gap-5 md:grid-cols-3">
                <article class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-700">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z" stroke-width="1.8" stroke-linejoin="round"/><path d="M8 7h8M8 10h5" stroke-width="1.8" stroke-linecap="round"/></svg>
                    </span>
                    <h3 class="mt-5 text-lg font-extrabold text-slate-900">Jelajahi dengan mudah</h3>
                    <p class="mt-2 leading-7 text-slate-600">Lihat informasi workshop dan pilih kegiatan yang cocok dengan minatmu.</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-800">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path d="M8 12.5 10.5 15 16 9.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <h3 class="mt-5 text-lg font-extrabold text-slate-900">Pantau pendaftaran</h3>
                    <p class="mt-2 leading-7 text-slate-600">Periksa status pendaftaran dan pembayaran lewat dashboard peserta.</p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path d="M7 3h7l5 5v13H5V3h2Zm7 0v5h5M8 13h8m-8 4h5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <h3 class="mt-5 text-lg font-extrabold text-slate-900">Simpan tiket digital</h3>
                    <p class="mt-2 leading-7 text-slate-600">Tiket tersedia di akunmu setelah pendaftaran dikonfirmasi.</p>
                </article>
            </div>
        </section>

        <section class="px-5 pb-20 sm:px-8 sm:pb-24">
            <div class="mx-auto flex max-w-7xl flex-col items-start justify-between gap-8 rounded-[2rem] bg-orange-700 px-7 py-10 text-white sm:px-12 sm:py-14 lg:flex-row lg:items-center">
                <div class="max-w-2xl">
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-orange-100">Siap untuk mulai?</p>
                    <h2 class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">Pilih workshop pertamamu hari ini.</h2>
                    <p class="mt-3 leading-7 text-orange-100">Buat akun dan temukan pengalaman belajar yang sesuai untukmu.</p>
                </div>
                @auth
                    <a href="{{ route('peserta.workshops.index') }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-extrabold text-orange-800 transition hover:bg-orange-50">Jelajahi Workshop <span aria-hidden="true">→</span></a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-extrabold text-orange-800 transition hover:bg-orange-50">Daftar Sekarang <span aria-hidden="true">→</span></a>
                    @endif
                @endauth
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-5 py-7 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <p>© {{ date('Y') }} WorkshopTIX. Semua hak dilindungi.</p>
            <p>Belajar hari ini, berkembang setiap hari.</p>
        </div>
    </footer>
</body>
</html>

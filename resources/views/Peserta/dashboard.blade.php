
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-sm text-slate-500">Workspace Peserta</p>
                <h2 class="text-2xl font-bold text-slate-900">
                    Dashboard
                </h2>
            </div>

            <a href="{{ route('peserta.workshops.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-700">
                <span>+</span>
                Jelajahi Workshop
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Welcome Banner --}}
            <div class="relative overflow-hidden rounded-3xl bg-orange-50 p-8 shadow-sm sm:p-10">

                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center rounded-full border border-orange-200 bg-white px-3 py-1 text-xs font-semibold tracking-wide text-orange-800">
                        WORKSHOPTIX MEMBER
                    </span>

                    <h1 class="mt-5 text-3xl font-bold text-slate-900 sm:text-4xl">
                        Halo, {{ auth()->user()->name }}!
                    </h1>

                    <p class="mt-3 text-sm leading-relaxed text-slate-600 sm:text-base">
                        Selamat datang di WorkshopTIX. Temukan berbagai
                        workshop menarik, tingkatkan kemampuanmu, dan
                        dapatkan pengalaman baru bersama komunitas IT.
                    </p>

                    <a href="{{ route('peserta.workshops.index') }}"
                        class="mt-7 inline-flex items-center gap-2 rounded-xl bg-orange-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-700">
                        Temukan Workshop
                        <span>→</span>
                    </a>
                </div>
            </div>

            {{-- Section Heading --}}
            <div class="mt-10 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">
                        Ringkasan Akun
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Informasi singkat mengenai aktivitas akunmu.
                    </p>
                </div>
            </div>

            {{-- Statistic Cards --}}
            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="rounded-xl bg-orange-100 p-3 text-orange-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 6v6l4 2m5-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-slate-400">
                            WORKSHOP
                        </span>
                    </div>

                    <p class="mt-5 text-sm text-slate-500">
                        Total Pendaftaran
                    </p>
                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        {{ $totalRegistrations }}
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="rounded-xl bg-emerald-50 p-3 text-emerald-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-slate-400">
                            PAYMENT
                        </span>
                    </div>

                    <p class="mt-5 text-sm text-slate-500">
                        Pembayaran Berhasil
                    </p>
                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        {{ $successfulPayments }}
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="rounded-xl bg-amber-50 p-3 text-amber-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 8v4m0 4h.01M10.3 3.8L1.8 18.5a1.5 1.5 0 001.3 2.2h17.8a1.5 1.5 0 001.3-2.2L13.3 3.8a1.5 1.5 0 00-3 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-slate-400">
                            PENDING
                        </span>
                    </div>

                    <p class="mt-5 text-sm text-slate-500">
                        Menunggu Pembayaran
                    </p>
                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        {{ $pendingPayments }}
                    </p>
                </div>

            </div>

            {{-- Quick Access --}}
            <div class="mt-10">
                <h3 class="text-xl font-bold text-slate-900">
                    Akses Cepat
                </h3>

                <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <a href="{{ route('peserta.workshops.index') }}"
                        class="group flex items-center gap-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-orange-300 hover:shadow-md">

                        <div class="rounded-2xl bg-orange-100 p-4 text-orange-700 transition group-hover:bg-orange-200">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 6v12m6-6H6"/>
                            </svg>
                        </div>

                        <div class="flex-1">
                            <h4 class="font-bold text-slate-900">
                                Cari Workshop
                            </h4>
                            <p class="mt-1 text-sm text-slate-500">
                                Temukan workshop yang sesuai dengan minatmu.
                            </p>
                        </div>

                        <span class="text-slate-400 transition group-hover:text-orange-700">
                            →
                        </span>
                    </a>

                    <div class="flex items-center gap-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="rounded-2xl bg-amber-100 p-4 text-amber-800">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M7 3h7l5 5v13H5V3h2zm7 0v5h5M8 13h8m-8 4h8"/>
                            </svg>
                        </div>

                        <div class="flex-1">
                            <h4 class="font-bold text-slate-900">
                                Tiket Digital
                            </h4>
                            <p class="mt-1 text-sm text-slate-500">
                                Tiket tersedia setelah pendaftaran dikonfirmasi.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <div class="mt-12 border-t border-slate-200 pt-6 text-center">
                <p class="text-sm text-slate-400">
                    © {{ date('Y') }} WorkshopTIX. All rights reserved.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>

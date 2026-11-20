@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

@section('title', 'Daftar Workshop')

@section('content')

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">
            Temukan Workshop
        </h1>

        <p class="text-slate-500 mt-2">
            Pilih workshop yang ingin kamu ikuti.
        </p>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse ($workshops as $workshop)

            @php $mine = $workshop->registrations->first(); @endphp

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

                <div class="p-6">

                    <span class="text-xs font-semibold bg-orange-100 text-orange-800 px-3 py-1 rounded-full">
                        Published
                    </span>

                    <h2 class="text-xl font-bold text-slate-900 mt-4">
                        {{ $workshop->name }}
                    </h2>

                    <p class="text-slate-500 text-sm mt-2">
                        {{ Str::limit($workshop->description, 120) }}
                    </p>

                    <div class="mt-5 space-y-2 text-sm text-slate-600">
                        <p>
                            <strong>Pembicara:</strong>
                            {{ $workshop->speaker }}
                        </p>

                        <p>
                            <strong>Lokasi:</strong>
                            {{ $workshop->location ?? 'Belum ditentukan' }}
                        </p>

                        <p>
                            <strong>Tanggal:</strong>
                            {{ $workshop->start_date->format('d M Y H:i') }}
                        </p>

                        <p>
                            <strong>Kuota:</strong>
                            {{ $workshop->quota }} peserta
                        </p>
                    </div>

                    <div class="border-t mt-5 pt-5">

                        <p class="text-sm text-slate-500">
                            Harga Workshop
                        </p>

                        <p class="text-2xl font-bold text-orange-700">
                            Rp {{ number_format($workshop->price, 0, ',', '.') }}
                        </p>

                        @if ($mine && $mine->status === 'confirmed')

                            <button disabled class="w-full mt-4 bg-slate-300 text-slate-600 py-3 rounded-lg cursor-not-allowed">
                                Sudah Terdaftar
                            </button>

                        @elseif ($mine && $mine->status === 'pending')

                            <a href="{{ route('peserta.payments.checkout', $mine) }}"
                               class="block text-center w-full mt-4 bg-amber-500 text-white py-3 rounded-lg hover:bg-amber-600">
                                Lanjutkan Pembayaran
                            </a>

                            <a href="{{ route('peserta.payments.check', $mine) }}"
                               class="block text-center w-full mt-2 border border-slate-300 text-slate-700 py-2 rounded-lg hover:bg-slate-50">
                                Cek Status Pembayaran
                            </a>

                        @elseif ($mine && $mine->status === 'cancelled')

                            <button disabled class="w-full mt-4 bg-red-100 text-red-600 py-3 rounded-lg cursor-not-allowed">
                                Pendaftaran Dibatalkan
                            </button>

                        @else

                            <form method="POST" action="{{ route('peserta.registrations.store', $workshop) }}">
                                @csrf

                                <button type="submit" class="w-full mt-4 rounded-lg bg-orange-600 py-3 text-white transition hover:bg-orange-700">
                                    Daftar & Bayar Sekarang
                                </button>
                            </form>

                        @endif

                    </div>
                </div>
            </div>

        @empty

            <div class="col-span-full bg-white rounded-xl p-10 text-center">
                <h2 class="text-xl font-semibold text-slate-700">
                    Belum Ada Workshop
                </h2>

                <p class="text-slate-500 mt-2">
                    Saat ini belum tersedia workshop yang dipublikasikan.
                </p>
            </div>

        @endforelse

    </div>

    <div class="mt-8">
        {{ $workshops->links() }}
    </div>

@endsection

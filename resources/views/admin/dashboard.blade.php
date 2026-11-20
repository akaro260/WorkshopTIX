@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

<div class="space-y-6">

    <!-- Statistics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="rounded-xl border border-orange-100 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Total Workshop</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalWorkshops }}
            </h3>
            <p class="text-xs text-orange-700 mt-2">
                Seluruh workshop
            </p>
        </div>

        <div class="rounded-xl border border-orange-100 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Workshop Published</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                {{ $publishedWorkshops }}
            </h3>
            <p class="text-xs text-green-600 mt-2">
                Workshop tersedia
            </p>
        </div>

        <div class="rounded-xl border border-orange-100 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Total Pendaftaran</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalRegistrations }}
            </h3>
            <p class="text-xs text-orange-700 mt-2">
                Seluruh pendaftaran
            </p>
        </div>

        <div class="rounded-xl border border-orange-100 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Total Transaksi</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-2">
                {{ $totalPayments }}
            </h3>
            <p class="text-xs text-yellow-600 mt-2">
                Transaksi tercatat
            </p>
        </div>

    </div>

    <!-- Latest Workshops -->
    <div class="rounded-xl border border-orange-100 bg-white p-6 shadow-sm">

        <div class="flex justify-between items-center mb-6">

            <div>
                <h3 class="text-lg font-bold text-gray-800">
                    Workshop Terbaru
                </h3>

                <p class="text-sm text-gray-500">
                    Lima workshop terakhir yang dibuat.
                </p>
            </div>

            <a href="{{ route('admin.workshops.index') }}"
                class="text-orange-700 hover:underline text-sm">
                Lihat Semua
            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-orange-50 text-gray-600 text-sm">
                    <tr>
                        <th class="p-3">Nama Workshop</th>
                        <th class="p-3">Pembicara</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($latestWorkshops as $workshop)

                        <tr class="text-sm">

                            <td class="p-3 font-medium">
                                {{ $workshop->name }}
                            </td>

                            <td class="p-3">
                                {{ $workshop->speaker }}
                            </td>

                            <td class="p-3">
                                Rp{{ number_format($workshop->price, 0, ',', '.') }}
                            </td>

                            <td class="p-3">
                                {{ ucfirst($workshop->status) }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4"
                                class="p-6 text-center text-gray-500">
                                Belum ada workshop.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection


@extends('layouts.admin')

@section('title', 'Manajemen Pendaftaran')

@section('page-title', 'Manajemen Pendaftaran')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">

    <form method="GET"
        action="{{ route('admin.registrations.index') }}"
        class="flex flex-wrap gap-3 mb-6">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari peserta, email, workshop, tiket..."
            class="border rounded-lg px-4 py-2 flex-1 min-w-60"
        >

        <select name="status" class="border rounded-lg px-4 py-2">
            <option value="">Semua Status</option>
            <option value="pending" @selected(request('status') === 'pending')>
                Pending
            </option>
            <option value="confirmed" @selected(request('status') === 'confirmed')>
                Confirmed
            </option>
            <option value="cancelled" @selected(request('status') === 'cancelled')>
                Cancelled
            </option>
        </select>

        <button class="bg-blue-600 text-white px-5 py-2 rounded-lg">
            Cari
        </button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="p-3">Peserta</th>
                    <th class="p-3">Workshop</th>
                    <th class="p-3">Kode Tiket</th>
                    <th class="p-3">Pendaftaran</th>
                    <th class="p-3">Pembayaran</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($registrations as $registration)
                    @php
                        $payment = $registration->payments
                            ->sortByDesc('created_at')
                            ->first();
                    @endphp

                    <tr class="border-b">
                        <td class="p-3">
                            <div class="font-semibold">
                                {{ $registration->user->name }}
                            </div>
                            <div class="text-gray-500">
                                {{ $registration->user->email }}
                            </div>
                        </td>

                        <td class="p-3">
                            {{ $registration->workshop->name }}
                        </td>

                        <td class="p-3">
                            {{ $registration->ticket_code ?? '-' }}
                        </td>

                        <td class="p-3">
                            {{ ucfirst($registration->status) }}
                        </td>

                        <td class="p-3">
                            {{ $payment
                                ? ucfirst($payment->payment_status)
                                : 'Belum ada pembayaran' }}
                        </td>

                        <td class="p-3">
                            <a
                                href="{{ route('admin.registrations.show', $registration) }}"
                                class="text-blue-600 hover:underline"
                            >
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500">
                            Belum ada pendaftaran.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $registrations->links() }}
    </div>
</div>
@endsection

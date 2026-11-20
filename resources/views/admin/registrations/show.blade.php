
@extends('layouts.admin')

@section('title', 'Detail Pendaftaran')

@section('page-title', 'Detail Pendaftaran')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">

    <h2 class="text-lg font-bold mb-5">
        Informasi Peserta
    </h2>

    <p>Nama: {{ $registration->user->name }}</p>
    <p>Email: {{ $registration->user->email }}</p>

    <hr class="my-5">

    <h2 class="text-lg font-bold mb-5">
        Informasi Workshop
    </h2>

    <p>Workshop: {{ $registration->workshop->name }}</p>
    <p>Harga: Rp {{ number_format($registration->workshop->price, 0, ',', '.') }}</p>
    <p>Kode Tiket: {{ $registration->ticket_code ?? 'Belum diterbitkan' }}</p>
    <p>Status Pendaftaran: {{ ucfirst($registration->status) }}</p>

    <hr class="my-5">

    <h2 class="text-lg font-bold mb-5">
        Riwayat Pembayaran
    </h2>

    @forelse ($registration->payments as $payment)
        <div class="border rounded-lg p-4 mb-3">
            <p>Order ID: {{ $payment->order_id }}</p>
            <p>Jumlah: Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
            <p>Status: {{ ucfirst($payment->payment_status) }}</p>
            <p>Metode: {{ $payment->payment_type ?? '-' }}</p>
            <p>Waktu pembayaran: {{ $payment->paid_at ?? '-' }}</p>
        </div>
    @empty
        <p class="text-gray-500">Belum ada pembayaran.</p>
    @endforelse

    <a
        href="{{ route('admin.registrations.index') }}"
        class="inline-block mt-5 text-blue-600 hover:underline"
    >
        Kembali
    </a>
</div>
@endsection

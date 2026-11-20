@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Tiket Digital Anda</h1>

    @if(isset($registration) && $registration->status === 'paid')
        <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">LUNAS & TERVERIFIKASI</span>
            <h2 class="text-xl font-bold text-gray-700 mt-4">{{ $registration->workshop->title }}</h2>
            <p class="text-gray-500 text-sm mt-1">Jadwal: {{ $registration->workshop->schedule }}</p>
            
            <div class="my-6 p-4 bg-gray-100 rounded border border-dashed border-gray-400">
                <p class="text-xs text-gray-500 uppercase tracking-wide">Kode Tiket Unik</p>
                <p class="text-2xl font-mono font-bold text-blue-600 mt-1">{{ $registration->ticket_code }}</p>
            </div>

            <p class="text-sm text-gray-600">Atas Nama: <strong>{{ auth()->user()->name }}</strong></p>
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
            <p class="text-yellow-700 font-medium">Belum ada tiket lunas yang ditemukan atau status masih pending.</p>
            <a href="{{ route('demo-payment.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">Kembali ke Daftar Workshop</a>
        </div>
    @endif
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Detail Workshop')
@section('page-title', 'Detail Workshop')

@section('content')

<div class="max-w-4xl rounded-2xl border border-orange-100 bg-white p-6 shadow-sm">

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold">Informasi Workshop</h3>

        <a href="{{ route('admin.workshops.edit', $workshop) }}"
            class="rounded-lg bg-orange-600 px-4 py-2 text-white transition hover:bg-orange-700">
            Edit Workshop
        </a>
    </div>

    <div class="space-y-5">

        <div>
            <p class="text-sm text-gray-500">Nama Workshop</p>
            <p class="font-semibold">{{ $workshop->name }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Slug</p>
            <p>{{ $workshop->slug }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Pembicara</p>
            <p>{{ $workshop->speaker }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Harga</p>
            <p>Rp{{ number_format($workshop->price, 0, ',', '.') }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Kuota</p>
            <p>{{ $workshop->quota }} peserta</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Lokasi</p>
            <p>{{ $workshop->location ?? '-' }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Tanggal Mulai</p>
            <p>{{ $workshop->start_date->format('d M Y H:i') }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Tanggal Selesai</p>
            <p>{{ $workshop->end_date->format('d M Y H:i') }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Deskripsi</p>
            <p class="whitespace-pre-line">{{ $workshop->description }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Status</p>
            <span class="inline-block rounded-full bg-orange-100 px-3 py-1 text-sm text-orange-800">
                {{ ucfirst($workshop->status) }}
            </span>
        </div>

    </div>

    <div class="mt-8">
        <a href="{{ route('admin.workshops.index') }}"
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-50">
            Kembali
        </a>
    </div>

</div>

@endsection

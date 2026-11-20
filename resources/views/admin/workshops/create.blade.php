
@extends('layouts.admin')

@section('title', 'Tambah Workshop')
@section('page-title', 'Tambah Workshop')

@section('content')

<div class="max-w-4xl rounded-2xl border border-orange-100 bg-white p-6 shadow-sm">

    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-800">
            Form Tambah Workshop
        </h3>
        <p class="text-sm text-gray-500">
            Masukkan informasi workshop yang ingin dibuat.
        </p>
    </div>

    <form action="{{ route('admin.workshops.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <!-- Nama Workshop -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-2">
                    Nama Workshop
                </label>
                <input type="text" name="name"
                    value="{{ old('name') }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500"
                    placeholder="Contoh: Laravel Web Development">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pembicara -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Pembicara
                </label>
                <input type="text" name="speaker"
                    value="{{ old('speaker') }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500"
                    placeholder="Nama pembicara">

                @error('speaker')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Harga (Rupiah)
                </label>
                <input type="number" name="price"
                    value="{{ old('price', 0) }}"
                    min="0"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500"
                    placeholder="100000">

                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kuota -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Kuota Peserta
                </label>
                <input type="number" name="quota"
                    value="{{ old('quota') }}"
                    min="1"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500"
                    placeholder="50">

                @error('quota')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Lokasi
                </label>
                <input type="text" name="location"
                    value="{{ old('location') }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500"
                    placeholder="Lokasi workshop">

                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Mulai -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Tanggal Mulai
                </label>
                <input type="datetime-local" name="start_date"
                    value="{{ old('start_date') }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500">

                @error('start_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Selesai -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Tanggal Selesai
                </label>
                <input type="datetime-local" name="end_date"
                    value="{{ old('end_date') }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500">

                @error('end_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium mb-2">
                    Status Workshop
                </label>

                <select name="status"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500">

                    <option value="draft" @selected(old('status', 'draft') === 'draft')>
                        Draft
                    </option>

                    <option value="published" @selected(old('status') === 'published')>
                        Published
                    </option>

                    <option value="closed" @selected(old('status') === 'closed')>
                        Closed
                    </option>

                </select>

                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-2">
                    Deskripsi Workshop
                </label>

                <textarea name="description" rows="5"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500"
                    placeholder="Jelaskan informasi workshop...">{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-8">

            <a href="{{ route('admin.workshops.index') }}"
                class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-50">
                Batal
            </a>

            <button type="submit"
                class="rounded-lg bg-orange-600 px-5 py-2 text-white transition hover:bg-orange-700">
                Simpan Workshop
            </button>

        </div>

    </form>

</div>

@endsection

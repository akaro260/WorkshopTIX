
@extends('layouts.admin')

@section('title', 'Kelola Workshop')
@section('page-title', 'Kelola Workshop')

@section('content')

<div class="rounded-xl border border-orange-100 bg-white p-6 shadow-sm">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h3 class="text-lg font-bold text-gray-800">
                Daftar Workshop
            </h3>

            <p class="text-sm text-gray-500">
                Kelola seluruh workshop yang tersedia.
            </p>
        </div>

        <a href="{{ route('admin.workshops.create') }}"
           class="rounded-lg bg-orange-600 px-4 py-2 text-white transition hover:bg-orange-700">
            + Tambah Workshop
        </a>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead class="bg-orange-50 text-gray-600 text-sm">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Nama Workshop</th>
                    <th class="p-3">Pembicara</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Kuota</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($workshops as $workshop)

                    <tr class="text-sm">

                        <td class="p-3">
                            {{ $loop->iteration + $workshops->firstItem() - 1 }}
                        </td>

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
                            {{ $workshop->quota }}
                        </td>

                        <td class="p-3">
                            <span class="px-3 py-1 rounded-full text-xs
                                {{ $workshop->status === 'published'
                                    ? 'bg-green-100 text-green-700'
                                    : ($workshop->status === 'closed'
                                        ? 'bg-red-100 text-red-700'
                                        : 'bg-yellow-100 text-yellow-700') }}">
                                {{ ucfirst($workshop->status) }}
                            </span>
                        </td>

                        <td class="p-3">

                            <div class="flex gap-2">

                                <a href="{{ route('admin.workshops.show', $workshop) }}"
                                   class="text-orange-700 hover:underline">
                                    Detail
                                </a>

                                <a href="{{ route('admin.workshops.edit', $workshop) }}"
                                   class="text-yellow-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('admin.workshops.destroy', $workshop) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus workshop ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="text-red-600 hover:underline">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-500">
                            Belum ada workshop.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">
        {{ $workshops->links() }}
    </div>

</div>

@endsection

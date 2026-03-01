@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold text-gray-800">Daftar Kategori</h2>
        <a href="{{ route('admin.categories.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm">
            + Tambah Kategori
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b bg-gray-50">
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Slug</th>
                    <th class="px-6 py-3">Parent</th>
                    <th class="px-6 py-3">Dibuat</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categories as $category)
                    <tr>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $category->parent ? $category->parent->name : '-' }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $category->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 flex items-center gap-3">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="text-indigo-600 hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                            Belum ada kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t">
            {{ $categories->links() }}
        </div>
    </div>

@endsection
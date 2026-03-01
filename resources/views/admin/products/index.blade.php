@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold text-gray-800">Daftar Produk</h2>
        <a href="{{ route('admin.products.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm">
            + Tambah Produk
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b bg-gray-50">
                    <th class="px-6 py-3">Foto</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Harga</th>
                    <th class="px-6 py-3">Stok</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr>
                        <td class="px-6 py-4">
                            @if($product->image)
                                <img src="{{ $product->image }}"
                                     alt="{{ $product->name }}"
                                     class="w-12 h-12 object-cover rounded-lg">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                    No Img
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $product->category->name }}</td>
                        <td class="px-6 py-4 text-indigo-600 font-semibold">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }} font-semibold">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex items-center gap-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="text-indigo-600 hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
                        <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                            Belum ada produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t">
            {{ $products->links() }}
        </div>
    </div>

@endsection
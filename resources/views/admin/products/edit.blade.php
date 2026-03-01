@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')

    <div class="max-w-2xl">
        <a href="{{ route('admin.products.index') }}" class="text-indigo-600 hover:underline text-sm mb-6 block">
            ← Kembali
        </a>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-bold text-gray-800 mb-6">Edit Produk</h2>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama Produk --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                    <select name="category_id" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="4"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- Harga & Stok --}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                </div>

                {{-- Foto Utama --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Utama</label>
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-24 h-24 object-cover rounded-lg mb-2">
                        <p class="text-xs text-gray-400 mb-2">Upload foto baru untuk mengganti foto lama</p>
                    @endif
                    <input type="file" name="image" accept="image/*"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                {{-- Foto Tambahan --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Tambahan</label>
                    @if($product->images->count())
                        <div class="flex gap-2 flex-wrap mb-2">
                            @foreach($product->images as $image)
                                <img src="{{ Storage::url($image->image) }}"
                                     alt="foto tambahan"
                                     class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Upload foto baru untuk menambah foto</p>
                    @endif
                    <input type="file" name="images[]" accept="image/*" multiple
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                {{-- Status Aktif --}}
                <div class="mb-6 flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-indigo-600">
                    <label for="is_active" class="text-sm font-semibold text-gray-700">
                        Produk Aktif (tampil di toko)
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Update Produk
                </button>
            </form>
        </div>
    </div>

@endsection
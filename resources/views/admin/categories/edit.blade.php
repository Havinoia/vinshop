@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')

    <div class="max-w-lg">
        <a href="{{ route('admin.categories.index') }}" class="text-indigo-600 hover:underline text-sm mb-6 block">
            ← Kembali
        </a>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-bold text-gray-800 mb-6">Edit Kategori</h2>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Kategori --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Parent Kategori --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Parent Kategori <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <select name="parent_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="">-- Tidak Ada --</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}"
                                {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Update Kategori
                </button>
            </form>
        </div>
    </div>

@endsection
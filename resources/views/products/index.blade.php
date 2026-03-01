@extends('layouts.app')

@section('title', 'Semua Produk')

@section('content')

<div class="flex flex-col md:flex-row gap-6">

    {{-- Sidebar Kategori --}}
    <div class="w-full md:w-1/4">
        <div class="bg-white rounded-xl shadow p-4">
            <h3 class="font-bold text-gray-800 mb-3">Kategori</h3>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('products.index') }}"
                        class="block px-3 py-2 rounded-lg text-sm {{ !request('category') ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                        Semua Produk
                    </a>
                </li>
                @foreach($categories as $category)
                <li>
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                        class="block px-3 py-2 rounded-lg text-sm {{ request('category') === $category->slug ? 'bg-indigo-50 text-indigo-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                        {{ $category->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Konten Produk --}}
    <div class="w-full md:w-3/4">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">
                {{ request('search') ? 'Hasil pencarian: "' . request('search') . '"' : 'Semua Produk' }}
            </h2>
            <p class="text-gray-500 text-sm">{{ $products->total() }} produk ditemukan</p>
        </div>

        {{-- Grid Produk --}}
        @if($products->count())
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($products as $product)
            <a href="{{ route('products.show', $product->slug) }}"
                class="bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden">
                @if($product->image)
                <img src="{{ Storage::url($product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                    No Image
                </div>
                @endif
                <div class="p-4">
                    <h3 class="text-gray-800 font-semibold text-sm mb-1 line-clamp-2">{{ $product->name }}</h3>
                    <p class="text-indigo-600 font-bold">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    <p class="text-gray-400 text-xs mt-1">Stok: {{ $product->stock }}</p>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $products->withQueryString()->links() }}
        </div>
        @else
        <div class="bg-white rounded-xl shadow p-10 text-center text-gray-500">
            Produk tidak ditemukan.
        </div>
        @endif

    </div>
</div>

@endsection
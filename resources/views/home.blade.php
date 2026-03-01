@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<div class="bg-indigo-600 rounded-2xl text-white px-8 py-16 mb-10 text-center">
    <h1 class="text-4xl font-bold mb-4">Selamat Datang di VinShop! 🛍️</h1>
    <p class="text-lg mb-6">Temukan produk terbaik dengan harga terjangkau</p>
    <a href="{{ route('products.index') }}"
        class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100">
        Belanja Sekarang
    </a>
</div>

{{-- Kategori --}}
@if($categories->count())
<div class="mb-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Kategori</h2>
    <div class="flex flex-wrap gap-3">
        @foreach($categories as $category)
        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
            class="bg-white border border-gray-200 px-4 py-2 rounded-full text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-300 transition">
            {{ $category->name }}
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- Produk Terbaru --}}
<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Produk Terbaru</h2>
        <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">Lihat Semua →</a>
    </div>

    @if($products->count())
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
        <a href="{{ route('products.show', $product->slug) }}"
            class="bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden">
            {{-- Foto Produk --}}
            @if($product->image)
             <img src="{{ $product->image }}"
                alt="{{ $product->name }}"
                class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                No Image
            </div>
            @endif

            {{-- Info Produk --}}
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
    @else
    <p class="text-gray-500 text-center py-10">Belum ada produk tersedia.</p>
    @endif
</div>

@endsection
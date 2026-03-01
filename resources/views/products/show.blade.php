@extends('layouts.app')

@section('title', $product->name)

@section('content')

<div class="bg-white rounded-xl shadow p-6 mb-8">
    <div class="flex flex-col md:flex-row gap-8">

        {{-- Foto Produk --}}
        <div class="w-full md:w-1/2">
            @if($product->image)
            <img src="{{ $product->image }}"
                alt="{{ $product->name }}"
                class="w-full h-96 object-cover rounded-xl mb-3">
            @else
            <div class="w-full h-96 bg-gray-200 rounded-xl flex items-center justify-center text-gray-400 mb-3">
                No Image
            </div>
            @endif

            {{-- Foto Tambahan --}}
            @if($product->images->count())
            <div class="flex gap-2 flex-wrap">
                @foreach($product->images as $image)
                <img src="{{ $product->image }}"
                    alt="{{ $product->name }}"
                    class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                @endforeach
            </div>
            @endif
        </div>

        {{-- Info Produk --}}
        <div class="w-full md:w-1/2">
            <p class="text-sm text-indigo-600 mb-1">{{ $product->category->name }}</p>
            <h1 class="text-2xl font-bold text-gray-800 mb-3">{{ $product->name }}</h1>
            <p class="text-3xl font-bold text-indigo-600 mb-4">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>

            <p class="text-gray-500 text-sm mb-6">{{ $product->description }}</p>

            <p class="text-sm text-gray-500 mb-6">
                Stok:
                <span class="{{ $product->stock > 0 ? 'text-green-600 font-semibold' : 'text-red-500 font-semibold' }}">
                    {{ $product->stock > 0 ? $product->stock . ' tersedia' : 'Habis' }}
                </span>
            </p>

            {{-- Form Tambah ke Keranjang --}}
            @auth
            @if($product->stock > 0)
            <form action="{{ route('cart.add') }}" method="POST" class="flex items-center gap-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                    class="w-20 border border-gray-300 rounded-lg px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                    🛒 Tambah ke Keranjang
                </button>
            </form>
            @else
            <button disabled class="bg-gray-300 text-gray-500 px-6 py-2 rounded-lg cursor-not-allowed">
                Stok Habis
            </button>
            @endif
            @else
            <a href="{{ route('login') }}"
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Login untuk Membeli
            </a>
            @endauth
        </div>
    </div>
</div>

{{-- Produk Terkait --}}
@if($related->count())
<div>
    <h2 class="text-xl font-bold text-gray-800 mb-4">Produk Terkait</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($related as $item)
        <a href="{{ route('products.show', $item->slug) }}"
            class="bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden">
            @if($item->image)
            <img src="{{ $product->image }}"
                alt="{{ $item->name }}"
                class="w-full h-40 object-cover">
            @else
            <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-400">
                No Image
            </div>
            @endif
            <div class="p-3">
                <h3 class="text-gray-800 font-semibold text-sm line-clamp-2 mb-1">{{ $item->name }}</h3>
                <p class="text-indigo-600 font-bold text-sm">
                    Rp {{ number_format($item->price, 0, ',', '.') }}
                </p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

@endsection
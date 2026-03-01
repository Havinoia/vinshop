@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Keranjang Belanja 🛒</h1>

    @if($carts->count())
        <div class="flex flex-col lg:flex-row gap-6">

            {{-- List Item Keranjang --}}
            <div class="w-full lg:w-2/3 space-y-4">
                @foreach($carts as $cart)
                    <div class="bg-white rounded-xl shadow p-4 flex items-center gap-4">

                        {{-- Foto Produk --}}
                        @if($cart->product->image)
                            <img src="{{ Storage::url($cart->product->image) }}"
                                 alt="{{ $cart->product->name }}"
                                 class="w-24 h-24 object-cover rounded-lg">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                No Image
                            </div>
                        @endif

                        {{-- Info Produk --}}
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $cart->product->name }}</h3>
                            <p class="text-indigo-600 font-bold mt-1">
                                Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Update Quantity --}}
                        <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $cart->quantity }}"
                                   min="1" max="{{ $cart->product->stock }}"
                                   class="w-16 border border-gray-300 rounded-lg px-2 py-1 text-center focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <button type="submit" class="text-sm bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-lg">
                                Update
                            </button>
                        </form>

                        {{-- Hapus Item --}}
                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                Hapus
                            </button>
                        </form>

                    </div>
                @endforeach
            </div>

            {{-- Summary --}}
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-xl shadow p-6 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Belanja</h3>

                    <div class="space-y-2 mb-4">
                        @foreach($carts as $cart)
                            <div class="flex justify-between text-sm text-gray-600">
                                <span class="line-clamp-1 w-2/3">{{ $cart->product->name }}</span>
                                <span>Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <hr class="my-4">

                    <div class="flex justify-between font-bold text-gray-800 mb-6">
                        <span>Total</span>
                        <span class="text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    {{-- Form Checkout --}}
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Pengiriman</label>
                            <textarea name="shipping_address" rows="3" required
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                      placeholder="Masukkan alamat lengkap...">{{ old('shipping_address') }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Metode Pembayaran</label>
                            <select name="payment_method" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="transfer">Transfer Bank</option>
                                <option value="cod">COD (Bayar di Tempat)</option>
                                <option value="ewallet">E-Wallet</option>
                            </select>
                        </div>

                        <button type="submit"
                                class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                            Checkout Sekarang
                        </button>
                    </form>
                </div>
            </div>

        </div>
    @else
        <div class="bg-white rounded-xl shadow p-16 text-center">
            <p class="text-gray-400 text-lg mb-4">Keranjang belanja kamu masih kosong 😢</p>
            <a href="{{ route('products.index') }}"
               class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                Mulai Belanja
            </a>
        </div>
    @endif

@endsection
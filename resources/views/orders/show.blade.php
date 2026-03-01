@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')

<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
    <a href="{{ route('orders.index') }}" class="text-indigo-600 hover:underline text-sm">← Kembali</a>
</div>

<div class="flex flex-col lg:flex-row gap-6">

    {{-- Item Pesanan --}}
    <div class="w-full lg:w-2/3 space-y-4">
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-bold text-gray-800 mb-4">Item Pesanan</h3>
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                <div class="flex items-center gap-4">
                    @if($item->product->image)
                    <img src="{{ $product->image }}"
                        alt="{{ $item->product->name }}"
                        class="w-16 h-16 object-cover rounded-lg">
                    @else
                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                        No Image
                    </div>
                    @endif
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                        <p class="text-sm text-gray-500">
                            {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                        </p>
                    </div>
                    <p class="font-bold text-indigo-600">
                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </p>
                </div>
                @if(!$loop->last)
                <hr>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- Info Pesanan --}}
    <div class="w-full lg:w-1/3 space-y-4">

        {{-- Status --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-bold text-gray-800 mb-4">Status Pesanan</h3>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Status</span>
                    <span class="font-semibold
                            @switch($order->status)
                                @case('pending') text-yellow-600 @break
                                @case('processing') text-blue-600 @break
                                @case('shipped') text-purple-600 @break
                                @case('delivered') text-green-600 @break
                                @case('cancelled') text-red-600 @break
                            @endswitch">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Pembayaran</span>
                    <span class="font-semibold
                            @switch($order->payment_status)
                                @case('unpaid') text-red-600 @break
                                @case('paid') text-green-600 @break
                                @case('refunded') text-gray-600 @break
                            @endswitch">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Metode Bayar</span>
                    <span class="font-semibold text-gray-800">{{ ucfirst($order->payment->method) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Tanggal Order</span>
                    <span class="font-semibold text-gray-800">{{ $order->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Alamat Pengiriman --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-bold text-gray-800 mb-3">Alamat Pengiriman</h3>
            <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
        </div>

        {{-- Total --}}
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex justify-between font-bold text-gray-800 mb-4">
                <span>Total Pembayaran</span>
                <span class="text-indigo-600 text-lg">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>
            </div>

            {{-- Tombol Bayar --}}
            @if($order->payment_status === 'unpaid')
            <a href="{{ route('payment.create', $order->id) }}"
                class="block w-full text-center bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                Bayar Sekarang 💳
            </a>
            @elseif($order->payment_status === 'paid')
            <div class="w-full text-center bg-green-100 text-green-700 py-3 rounded-lg font-semibold">
                ✅ Sudah Dibayar
            </div>
            @endif
        </div>

    </div>
</div>

@endsection
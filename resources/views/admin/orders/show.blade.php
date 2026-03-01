@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')

    <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:underline text-sm mb-6 block">
        ← Kembali
    </a>

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
                <hr class="my-4">
                <div class="flex justify-between font-bold text-gray-800">
                    <span>Total</span>
                    <span class="text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Info & Update Status --}}
        <div class="w-full lg:w-1/3 space-y-4">

            {{-- Info Customer --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-3">Info Customer</h3>
                <p class="text-sm text-gray-800 font-semibold">{{ $order->user->name }}</p>
                <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $order->user->phone ?? '-' }}</p>
            </div>

            {{-- Alamat Pengiriman --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-3">Alamat Pengiriman</h3>
                <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
            </div>

            {{-- Update Status Order --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="font-bold text-gray-800 mb-4">Update Status</h3>

                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="mb-4">
                    @csrf
                    @method('PATCH')
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Status Pengiriman</label>
                    <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 mb-3">
                        @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
                        Update Status
                    </button>
                </form>

                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Status Pembayaran</label>
                    <select name="payment_status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 mb-3">
                        @foreach(['unpaid', 'paid', 'refunded'] as $status)
                            <option value="{{ $status }}" {{ $order->payment_status === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                            class="w-full bg-green-600 text-white py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                        Update Pembayaran
                    </button>
                </form>
            </div>

        </div>
    </div>

@endsection
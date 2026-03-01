@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Pesanan Saya 📦</h1>

    @if($orders->count())
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                        {{-- Info Order --}}
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Order #{{ $order->id }}</p>
                            <p class="text-sm text-gray-500 mb-2">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            <p class="font-bold text-indigo-600 text-lg">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Status --}}
                        <div class="flex flex-col items-start md:items-end gap-2">
                            {{-- Status Order --}}
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @switch($order->status)
                                    @case('pending') bg-yellow-100 text-yellow-700 @break
                                    @case('processing') bg-blue-100 text-blue-700 @break
                                    @case('shipped') bg-purple-100 text-purple-700 @break
                                    @case('delivered') bg-green-100 text-green-700 @break
                                    @case('cancelled') bg-red-100 text-red-700 @break
                                @endswitch">
                                {{ ucfirst($order->status) }}
                            </span>

                            {{-- Status Pembayaran --}}
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @switch($order->payment_status)
                                    @case('unpaid') bg-red-100 text-red-700 @break
                                    @case('paid') bg-green-100 text-green-700 @break
                                    @case('refunded') bg-gray-100 text-gray-700 @break
                                @endswitch">
                                {{ ucfirst($order->payment_status) }}
                            </span>

                            <a href="{{ route('orders.show', $order->id) }}"
                               class="text-sm text-indigo-600 hover:underline mt-1">
                                Lihat Detail →
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $orders->links() }}
        </div>

    @else
        <div class="bg-white rounded-xl shadow p-16 text-center">
            <p class="text-gray-400 text-lg mb-4">Kamu belum punya pesanan 😢</p>
            <a href="{{ route('products.index') }}"
               class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                Mulai Belanja
            </a>
        </div>
    @endif

@endsection
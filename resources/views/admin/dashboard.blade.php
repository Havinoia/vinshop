@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500 mb-1">Total Customer</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500 mb-1">Total Produk</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalProducts }}</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500 mb-1">Total Pesanan</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalOrders }}</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500 mb-1">Total Revenue</p>
            <p class="text-3xl font-bold text-indigo-600">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </p>
        </div>

    </div>

    {{-- Pesanan Terbaru --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-bold text-gray-800 mb-4">Pesanan Terbaru</h3>

        @if($latestOrders->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Order ID</th>
                            <th class="pb-3">Customer</th>
                            <th class="pb-3">Total</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3">Pembayaran</th>
                            <th class="pb-3">Tanggal</th>
                            <th class="pb-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($latestOrders as $order)
                            <tr>
                                <td class="py-3">#{{ $order->id }}</td>
                                <td class="py-3">{{ $order->user->name }}</td>
                                <td class="py-3 font-semibold">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @switch($order->status)
                                            @case('pending') bg-yellow-100 text-yellow-700 @break
                                            @case('processing') bg-blue-100 text-blue-700 @break
                                            @case('shipped') bg-purple-100 text-purple-700 @break
                                            @case('delivered') bg-green-100 text-green-700 @break
                                            @case('cancelled') bg-red-100 text-red-700 @break
                                        @endswitch">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @switch($order->payment_status)
                                            @case('unpaid') bg-red-100 text-red-700 @break
                                            @case('paid') bg-green-100 text-green-700 @break
                                            @case('refunded') bg-gray-100 text-gray-700 @break
                                        @endswitch">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td class="py-3 text-gray-500">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>
                                <td class="py-3">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="text-indigo-600 hover:underline">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-6">Belum ada pesanan.</p>
        @endif
    </div>

@endsection
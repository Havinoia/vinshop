@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold text-gray-800">Daftar Pesanan</h2>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b bg-gray-50">
                    <th class="px-6 py-3">Order ID</th>
                    <th class="px-6 py-3">Customer</th>
                    <th class="px-6 py-3">Total</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Pembayaran</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                    <tr>
                        <td class="px-6 py-4 font-semibold">#{{ $order->id }}</td>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 text-indigo-600 font-semibold">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
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
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @switch($order->payment_status)
                                    @case('unpaid') bg-red-100 text-red-700 @break
                                    @case('paid') bg-green-100 text-green-700 @break
                                    @case('refunded') bg-gray-100 text-gray-700 @break
                                @endswitch">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $order->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="text-indigo-600 hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                            Belum ada pesanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t">
            {{ $orders->links() }}
        </div>
    </div>

@endsection
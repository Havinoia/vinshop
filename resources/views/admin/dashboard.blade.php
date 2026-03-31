@extends('layouts.admin')

@section('title', 'System Overview')

@section('content')

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-16">

        <div class="glass-card rounded-[3rem] p-10 relative overflow-hidden group hover:border-indigo-100 transition-all">
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] mb-4">Total Customers</p>
            <div class="flex items-end justify-between">
                <p class="text-5xl font-black text-slate-800 tracking-tighter">{{ $totalUsers }}</p>
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-slate-50 rounded-full blur-[40px]"></div>
        </div>

        <div class="glass-card rounded-[3rem] p-10 relative overflow-hidden group hover:border-indigo-100 transition-all">
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] mb-4">Registry Items</p>
            <div class="flex items-end justify-between">
                <p class="text-5xl font-black text-slate-800 tracking-tighter">{{ $totalProducts }}</p>
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
            <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-slate-50 rounded-full blur-[40px]"></div>
        </div>

        <div class="glass-card rounded-[3rem] p-10 relative overflow-hidden group hover:border-indigo-100 transition-all">
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] mb-4">Total Orders</p>
            <div class="flex items-end justify-between">
                <p class="text-5xl font-black text-slate-800 tracking-tighter">{{ $totalOrders }}</p>
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-slate-50 rounded-full blur-[40px]"></div>
        </div>

        <div class="glass-card rounded-[3rem] p-10 relative overflow-hidden group hover:border-indigo-100 transition-all">
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] mb-4">Gross Revenue</p>
            <div class="flex items-end justify-between">
                <p class="text-2xl font-black text-slate-800 tracking-tighter">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </p>
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-emerald-50 rounded-full blur-[40px]"></div>
        </div>

    </div>

    {{-- Pesanan Terbaru --}}
    <div class="glass-card rounded-[3rem] p-12 relative overflow-hidden">
        <div class="flex items-center justify-between mb-12">
            <div class="space-y-2">
                <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em]">Live Transaction Feed</p>
                <h3 class="text-3xl font-black text-slate-800 tracking-tight">Recent Dispatches</h3>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-black text-slate-400 capitalize tracking-widest hover:text-indigo-600 transition-colors">
                View All Activity →
            </a>
        </div>

        @if($latestOrders->count())
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] border-b border-slate-50">
                            <th class="pb-6 px-4">Node ID</th>
                            <th class="pb-6 px-4">Origin Node</th>
                            <th class="pb-6 px-4 text-right">Valuation</th>
                            <th class="pb-6 px-4 text-center">Status</th>
                            <th class="pb-6 px-4 text-center">Payment</th>
                            <th class="pb-6 px-4">Timestamp</th>
                            <th class="pb-6 px-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($latestOrders as $order)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="py-6 px-4 font-black text-slate-400">#{{ $order->id }}</td>
                                <td class="py-6 px-4">
                                    <p class="font-black text-slate-800">{{ $order->user->name }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $order->user->email }}</p>
                                </td>
                                <td class="py-6 px-4 text-right">
                                    <span class="font-black text-slate-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                </td>
                                <td class="py-6 px-4 text-center">
                                    @php
                                        $statusClass = match($order->status) {
                                            'pending' => 'bg-amber-50 text-amber-600',
                                            'processing' => 'bg-indigo-50 text-indigo-600',
                                            'shipped' => 'bg-purple-50 text-purple-600',
                                            'delivered' => 'bg-emerald-50 text-emerald-600',
                                            'cancelled' => 'bg-rose-50 text-rose-600',
                                            default => 'bg-slate-50 text-slate-600'
                                        };
                                    @endphp
                                    <span class="px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest {{ $statusClass }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="py-6 px-4 text-center">
                                    @php
                                        $paymentClass = match($order->payment_status) {
                                            'unpaid' => 'bg-rose-50 text-rose-600',
                                            'paid' => 'bg-emerald-50 text-emerald-600',
                                            'refunded' => 'bg-slate-50 text-slate-600',
                                            default => 'bg-slate-50 text-slate-600'
                                        };
                                    @endphp
                                    <span class="px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest {{ $paymentClass }}">
                                        {{ $order->payment_status }}
                                    </span>
                                </td>
                                <td class="py-6 px-4 text-[10px] font-black text-slate-300 uppercase tracking-widest">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>
                                <td class="py-6 px-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-24 text-center">
                <p class="text-3xl font-black text-slate-200 tracking-tighter italic">No Transaction Protocols Found</p>
            </div>
        @endif
    </div>

@endsection
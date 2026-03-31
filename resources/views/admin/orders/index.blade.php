@extends('layouts.admin')

@section('title', 'Transaction Terminal')

@section('content')

    <div class="flex flex-col mb-12 px-4 shadow-sm">
        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em] mb-4">Operations Control</p>
        <h2 class="text-4xl font-black text-slate-800 tracking-tight">Orders Registry</h2>
    </div>

    <div class="glass-card rounded-[3rem] overflow-hidden border border-slate-100 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em] border-b border-slate-50">
                        <th class="py-8 px-8">Node Identifier</th>
                        <th class="py-8 px-8">Identity Node</th>
                        <th class="py-8 px-8 text-right">Valuation</th>
                        <th class="py-8 px-8 text-center">Status Protocol</th>
                        <th class="py-8 px-8 text-center">Payment Status</th>
                        <th class="py-8 px-8">Timestamp</th>
                        <th class="py-8 px-8"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($orders as $order)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="py-6 px-8 font-black text-slate-400">#{{ $order->id }}</td>
                            <td class="py-6 px-8">
                                <p class="font-black text-slate-800">{{ $order->user->name }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $order->user->email }}</p>
                            </td>
                            <td class="py-6 px-8 text-right font-black text-slate-800">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="py-6 px-8 text-center">
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
                                <span class="px-5 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm {{ $statusClass }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-6 px-8 text-center">
                                @php
                                    $paymentClass = match($order->payment_status) {
                                        'unpaid' => 'bg-rose-50 text-rose-600',
                                        'paid' => 'bg-emerald-50 text-emerald-600',
                                        'refunded' => 'bg-slate-50 text-slate-600',
                                        default => 'bg-slate-50 text-slate-600'
                                    };
                                @endphp
                                <span class="px-5 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm {{ $paymentClass }}">
                                    {{ $order->payment_status }}
                                </span>
                            </td>
                            <td class="py-6 px-8 text-[10px] font-black text-slate-300 uppercase tracking-widest">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td class="py-6 px-8 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="w-10 h-10 bg-white border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:border-indigo-100 transition-all shadow-sm group-hover:scale-105 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-24 text-center">
                                <p class="text-3xl font-black text-slate-200 tracking-tighter italic">No Transaction Protocols Found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($orders->hasPages())
        <div class="px-8 py-8 border-t border-slate-50 bg-slate-50/20">
            {{ $orders->links() }}
        </div>
        @endif
    </div>

@endsection
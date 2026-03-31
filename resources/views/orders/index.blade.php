@extends('layouts.app')

@section('title', 'My Orders - VinShop')

@section('content')

<div class="mb-24">
    <div class="flex flex-col mb-12 px-2">
        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em] mb-4">Transaction History</p>
        <h1 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight flex items-center gap-6">
            My Orders
            <span class="flex-1 h-[2px] bg-slate-100 rounded-full"></span>
        </h1>
    </div>

    @if($orders->count())
        <div class="space-y-8">
            @foreach($orders as $order)
                <div class="glass-card rounded-[3rem] p-10 group relative overflow-hidden transition-all hover:border-indigo-200 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5">
                    {{-- Decorative Background --}}
                    <div class="absolute -right-16 -top-16 w-48 h-48 bg-indigo-50/30 rounded-full blur-[100px] pointer-events-none group-hover:scale-150 transition-transform duration-1000"></div>

                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-10 relative z-10">

                        {{-- Info Order --}}
                        <div class="flex flex-col gap-2">
                            <div class="flex flex-wrap items-center gap-4 mb-4">
                                <span class="bg-indigo-600 text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-lg shadow-indigo-600/20">Ref #ORD-{{ $order->id }}</span>
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-200"></span>
                                    <span class="text-[10px] text-slate-400 font-extrabold uppercase tracking-widest">{{ $order->created_at->format('M d, Y • H:i') }}</span>
                                </div>
                            </div>
                            <div class="flex items-baseline gap-4">
                                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Total Transaction</span>
                                <span class="text-3xl font-black text-slate-800 tracking-tighter">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        {{-- Status & Actions --}}
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-6 lg:text-right">
                            <div class="flex flex-wrap gap-4">
                                {{-- Status Order --}}
                                <div class="px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] border shadow-sm backdrop-blur-md
                                    @switch($order->status)
                                        @case('pending') bg-amber-50 text-amber-600 border-amber-100 @break
                                        @case('processing') bg-indigo-50 text-indigo-600 border-indigo-100 @break
                                        @case('shipped') bg-cyan-50 text-cyan-600 border-cyan-100 @break
                                        @case('delivered') bg-emerald-50 text-emerald-600 border-emerald-100 @break
                                        @case('cancelled') bg-rose-50 text-rose-600 border-rose-100 @break
                                    @endswitch">
                                    Order: {{ ucfirst($order->status) }}
                                </div>

                                {{-- Status Pembayaran --}}
                                <div class="px-6 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] border shadow-sm backdrop-blur-md
                                    @switch($order->payment_status)
                                        @case('unpaid') bg-rose-50 text-rose-600 border-rose-100 @break
                                        @case('paid') bg-emerald-50 text-emerald-600 border-emerald-100 @break
                                        @case('refunded') bg-slate-50 text-slate-500 border-slate-100 @break
                                    @endswitch">
                                    Finance: {{ ucfirst($order->payment_status) }}
                                </div>
                            </div>

                            <a href="{{ route('orders.show', $order->id) }}"
                               class="inline-flex items-center justify-center gap-3 bg-slate-900 hover:bg-indigo-600 text-white font-black py-4 px-8 rounded-2xl transition-all group/btn shadow-xl shadow-slate-900/10 hover:shadow-indigo-600/20 active:scale-95">
                                Insights
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover/btn:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-20 flex justify-center">
            <div class="bg-white px-8 py-4 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-2">
                {{ $orders->links() }}
            </div>
        </div>

    @else
        <div class="glass-card rounded-[5rem] p-32 text-center relative overflow-hidden">
            <div class="relative z-10">
                <div class="w-40 h-40 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-12 relative group/empty">
                    <div class="absolute inset-0 bg-indigo-50 rounded-full scale-0 group-hover/empty:scale-[1.5] transition-transform duration-1000"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-slate-200 relative z-10 transition-colors group-hover/empty:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 class="text-4xl md:text-5xl font-black text-slate-800 mb-6 tracking-tight">No Transactions Found</h3>
                <p class="text-slate-400 mb-16 text-xl max-w-md mx-auto font-medium leading-relaxed">Your procurement history is currently empty. Ready to initiate your first acquisition?</p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-6 bg-indigo-600 hover:bg-slate-900 text-white font-black px-16 py-7 rounded-[2.5rem] transition-all shadow-2xl shadow-indigo-200 active:scale-95 group/explore">
                    Browse Collection
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover/explore:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="absolute -left-40 -bottom-40 w-[30rem] h-[30rem] bg-indigo-50/50 rounded-full blur-[150px]"></div>
        </div>
    @endif

</div>

@endsection
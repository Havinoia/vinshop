@extends('layouts.app')

@section('title', 'Order Details #' . $order->id . ' - VinShop')

@section('content')

<div class="mb-16">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div class="space-y-4">
            <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em]">Transaction Insight</p>
            <h1 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tighter flex items-center gap-6">
                Ref #ORD-{{ $order->id }}
                <span class="hidden md:block w-32 h-[2px] bg-slate-100 rounded-full"></span>
            </h1>
        </div>
        <a href="{{ route('orders.index') }}" class="group flex items-center gap-3 bg-white border border-slate-100 px-6 py-3 rounded-2xl text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-indigo-600 hover:border-indigo-200 transition-all shadow-sm active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Registry
        </a>
    </div>

    <div class="flex flex-col lg:flex-row gap-12">

        {{-- Item Pesanan --}}
        <div class="w-full lg:w-2/3 space-y-8">
            <div class="glass-card rounded-[3rem] p-10 relative overflow-hidden border border-slate-100">
                <div class="relative z-10">
                    <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.3em] mb-10">Procured Assets</h3>
                    <div class="space-y-8">
                        @foreach($order->orderItems as $item)
                        <div class="flex items-center gap-8 group">
                            <div class="w-24 h-24 bg-slate-50 rounded-[2rem] overflow-hidden border border-slate-100 group-hover:scale-105 transition-transform duration-500">
                                @if($item->product->image)
                                <img src="{{ $item->product->image }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="flex-1 space-y-1">
                                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">{{ $item->product->category->name }}</p>
                                <p class="font-extrabold text-xl text-slate-800 leading-tight group-hover:text-indigo-600 transition-colors">{{ $item->product->name }}</p>
                                <p class="text-xs font-bold text-slate-400">
                                    {{ $item->quantity }} units × Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black text-slate-300 uppercase tracking-widest mb-1">Subtotal</p>
                                <p class="text-xl font-black text-slate-800">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        @if(!$loop->last)
                        <div class="h-[1px] w-full bg-slate-50"></div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-indigo-50/30 rounded-full blur-[80px]"></div>
            </div>
        </div>

        {{-- Info Pesanan --}}
        <div class="w-full lg:w-1/3 space-y-8">

            {{-- Summary & Status --}}
            <div class="glass-card rounded-[3rem] p-10 border border-slate-100 flex flex-col gap-8">
                <div class="space-y-4">
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Settlement Total</p>
                    <p class="text-4xl font-black text-slate-800 tracking-tighter">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>

                <div class="h-[2px] bg-slate-50 rounded-full"></div>

                <div class="space-y-6 text-sm">
                    <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest">
                        <span class="text-slate-400">Logistics Phase</span>
                        <span class="px-3 py-1.5 rounded-lg border
                                @switch($order->status)
                                    @case('pending') bg-amber-50 text-amber-600 border-amber-100 @break
                                    @case('processing') bg-indigo-50 text-indigo-600 border-indigo-100 @break
                                    @case('shipped') bg-cyan-50 text-cyan-600 border-cyan-100 @break
                                    @case('delivered') bg-emerald-50 text-emerald-600 border-emerald-100 @break
                                    @case('cancelled') bg-rose-50 text-rose-600 border-rose-100 @break
                                @endswitch">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest">
                        <span class="text-slate-400">Financial Clearance</span>
                        <span class="px-3 py-1.5 rounded-lg border
                                @switch($order->payment_status)
                                    @case('unpaid') bg-rose-50 text-rose-600 border-rose-100 @break
                                    @case('paid') bg-emerald-50 text-emerald-600 border-emerald-100 @break
                                    @case('refunded') bg-slate-50 text-slate-500 border-slate-100 @break
                                @endswitch">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Method</span>
                        <span class="font-extrabold text-slate-700">{{ ucfirst($order->payment->method) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Timeline</span>
                        <span class="font-extrabold text-slate-700">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                {{-- Action Area --}}
                <div class="mt-4">
                    @if($order->payment_status === 'unpaid')
                    <a href="{{ route('payment.create', $order->id) }}"
                        class="w-full bg-indigo-600 hover:bg-slate-900 text-white font-black py-6 rounded-3xl flex items-center justify-center gap-4 shadow-2xl transition-all active:scale-95 group/pay text-xs uppercase tracking-widest">
                        Execute Settlement
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover/pay:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    @elseif($order->payment_status === 'paid')
                    <div class="w-full bg-emerald-50 text-emerald-600 border border-emerald-100 font-extrabold py-5 rounded-3xl flex items-center justify-center gap-3 text-xs uppercase tracking-widest">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                        Financial Verified
                    </div>
                    @endif
                </div>
            </div>

            {{-- Alamat Pengiriman --}}
            <div class="glass-card rounded-[3rem] p-10 border border-slate-100">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-6">Delivery Coordinates</h3>
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <p class="text-sm text-slate-600 leading-relaxed font-medium">
                        {{ $order->shipping_address }}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
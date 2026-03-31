@extends('layouts.admin')

@section('title', 'Transaction Protocol #' . $order->id)

@section('content')

<div class="max-w-6xl mb-24 px-4">
    <a href="{{ route('admin.orders.index') }}" class="group inline-flex items-center gap-3 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-indigo-600 transition-colors mb-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Return to Dispatcher
    </a>

    <div class="flex flex-col lg:flex-row gap-12">

        {{-- Item Pesanan --}}
        <div class="w-full lg:w-2/3 space-y-10">
            <div class="glass-card rounded-[3rem] p-10 lg:p-12 relative overflow-hidden border border-slate-100 shadow-sm">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-2 h-6 bg-indigo-600 rounded-full"></div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight">Acquisition Payload</h3>
                </div>

                <div class="space-y-8">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-center gap-6 group">
                            <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-2xl overflow-hidden group-hover:scale-105 transition-transform duration-500">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="text-base font-black text-slate-800 tracking-tight hover:text-indigo-600 transition-colors">{{ $item->product->name }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1">
                                    Unit Velocity: {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-black text-slate-800 tracking-tighter">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 pt-10 border-t border-slate-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">Total Aggregate Valuation</p>
                            <p class="text-3xl font-black text-slate-800 tracking-tighter">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div class="w-16 h-16 bg-emerald-50 rounded-3xl flex items-center justify-center text-emerald-500 border border-emerald-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8l-4 4m0 0l4 4m-4-4h18" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info & Update Status --}}
        <div class="w-full lg:w-1/3 space-y-10">

            {{-- Info Customer --}}
            <div class="glass-card rounded-[3rem] p-10 border border-slate-100 shadow-sm relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-2 h-4 bg-indigo-600 rounded-full"></div>
                        <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Origin Node Identity</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white font-black text-lg">
                                {{ substr($order->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-base font-black text-slate-800 tracking-tight">{{ $order->user->name }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $order->user->email }}</p>
                            </div>
                        </div>
                        <p class="text-[10px] font-bold text-slate-400 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100 inline-block uppercase tracking-widest">Contact: {{ $order->user->phone ?? 'NULL' }}</p>
                    </div>
                </div>
            </div>

            {{-- Alamat Pengiriman --}}
            <div class="glass-card rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-2 h-4 bg-indigo-600 rounded-full"></div>
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Destination Coordinates</h3>
                </div>
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100">
                    <p class="text-xs font-bold text-slate-600 uppercase leading-relaxed tracking-wide italic">"{{ $order->shipping_address }}"</p>
                </div>
            </div>

            {{-- Update Status Order --}}
            <div class="glass-card rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-2 h-4 bg-indigo-600 rounded-full"></div>
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Protocol Sync</h3>
                </div>

                <div class="space-y-10">
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-2">Dispatch Status</label>
                        <select name="status"
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-600 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all mb-6 appearance-none">
                            @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit"
                                class="w-full bg-slate-900 text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl hover:bg-indigo-600 active:scale-95 transition-all">
                            Sync Status
                        </button>
                    </form>

                    <div class="h-[1px] bg-slate-100 w-full"></div>

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 ml-2">Payment Verification</label>
                        <select name="payment_status"
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-600 focus:outline-none focus:ring-4 focus:ring-indigo-100 focus:bg-white transition-all mb-6 appearance-none">
                            @foreach(['unpaid', 'paid', 'refunded'] as $status)
                                <option value="{{ $status }}" {{ $order->payment_status === $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit"
                                class="w-full bg-emerald-600 text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl hover:bg-emerald-500 active:scale-95 transition-all">
                            Verify Funds
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@endsection
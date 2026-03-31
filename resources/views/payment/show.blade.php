@extends('layouts.app')

@section('title', 'Authorization Node - Order #' . $order->id)

@section('content')

<div class="max-w-2xl mx-auto mb-24 px-4">
    <div class="text-center mb-16">
        <div class="w-20 h-20 bg-indigo-50 rounded-[2.5rem] flex items-center justify-center mx-auto mb-8 shadow-xl shadow-indigo-500/5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04M12 3V2m0 18v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.5em] mb-4">Transaction Authorization</p>
        <h1 class="text-4xl font-black text-slate-800 tracking-tight">Order Recognition #{{ $order->id }}</h1>
    </div>

    <div class="glass-card rounded-[4rem] p-12 lg:p-16 relative overflow-hidden mb-12 shadow-2xl shadow-indigo-500/5 border border-slate-100/50">
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-12">
                <h3 class="text-xl font-black text-slate-800 tracking-tight">Acquisition Summary</h3>
                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Registry Feed</span>
            </div>

            <div class="space-y-6 mb-12">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center justify-between p-4 bg-slate-50/50 rounded-2xl border border-slate-100/50 group hover:border-indigo-100 transition-all">
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-slate-700 tracking-tight">{{ $item->product->name }}</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Quantity: {{ $item->quantity }}</span>
                        </div>
                        <span class="font-black text-slate-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <div class="h-[1px] bg-slate-100 w-full mb-10"></div>

            <div class="flex items-center justify-between mb-12">
                <div class="flex flex-col">
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">Total Valuation</p>
                    <p class="text-4xl font-black text-slate-800 tracking-tighter">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-16 h-16 bg-emerald-50 rounded-3xl flex items-center justify-center text-emerald-500 shadow-sm border border-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            {{-- Tombol Bayar --}}
            <button id="pay-button"
                    class="w-full bg-slate-900 group shadow-2xl shadow-slate-900/10 hover:bg-indigo-600 text-white font-black px-12 py-6 rounded-[2.5rem] transition-all active:scale-95 flex items-center justify-center gap-4 text-xs uppercase tracking-[0.2em]">
                Execute Secure Payment
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </button>
            <p class="text-[10px] text-center text-slate-300 font-black uppercase tracking-widest mt-8">Encrypted via Midtrans Nexus Protocol</p>
        </div>
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-slate-50/50 rounded-full blur-[80px]"></div>
    </div>
</div>

{{-- Midtrans Snap JS --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
    var orderUrl = "{{ route('orders.show', $order->id) }}";

    document.getElementById('pay-button').onclick = function() {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = orderUrl;
            },
            onPending: function(result) {
                window.location.href = orderUrl;
            },
            onError: function(result) {
                alert('Pembayaran gagal! Silakan coba lagi.');
            },
            onClose: function() {
                alert('Kamu menutup popup pembayaran sebelum menyelesaikan transaksi.');
            }
        });
    };
</script>

@endsection
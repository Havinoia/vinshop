@extends('layouts.app')

@section('title', 'Pembayaran Order #' . $order->id)

@section('content')

    <div class="max-w-lg mx-auto">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pembayaran Order #{{ $order->id }}</h1>

        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h3 class="font-bold text-gray-800 mb-4">Ringkasan Pesanan</h3>

            <div class="space-y-2 mb-4">
                @foreach($order->orderItems as $item)
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                        <span>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <hr class="my-3">

            <div class="flex justify-between font-bold text-gray-800">
                <span>Total</span>
                <span class="text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Tombol Bayar --}}
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <p class="text-gray-500 text-sm mb-4">Klik tombol di bawah untuk melanjutkan pembayaran</p>
            <button id="pay-button"
                    class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition w-full">
                Bayar Sekarang 💳
            </button>
        </div>

    </div>

    {{-- Midtrans Snap JS --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>

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
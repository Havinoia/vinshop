<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    // Membuat transaksi Midtrans dan mengembalikan snap token
    public function createTransaction(Request $request, Order $order)
    {
        // Pastikan order milik user yang sedang login
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }

        // Pastikan order belum dibayar
        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.show', $order)->with('error', 'Order ini sudah dibayar!');
        }
        

        $params = [
            'transaction_details' => [
                'order_id'     => 'VINSHOP-' . $order->id . '-' . time(),
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $request->user()->name,
                'email'      => $request->user()->email,
                'phone'      => $request->user()->phone ?? '-',
            ],
            'item_details' => $order->orderItems->map(function ($item) {
                return [
                    'id'       => $item->product_id,
                    'price'    => (int) $item->price,
                    'quantity' => $item->quantity,
                    'name'     => substr($item->product->name, 0, 50),
                ];
            })->toArray(),
        ];

        $snapToken = Snap::getSnapToken($params);

        // Simpan snap token ke payment
        $order->payment->update(['snap_token' => $snapToken]);

        return view('payment.show', compact('order', 'snapToken'));
    }

    // Handle notifikasi dari Midtrans (webhook)
    public function notification()
    {
        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $orderId           = explode('-', $notification->order_id)[1];
        $order             = Order::findOrFail($orderId);

        if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
            $order->update(['payment_status' => 'paid', 'status' => 'processing']);
            $order->payment->update(['status' => 'success', 'paid_at' => now()]);
        } elseif ($transactionStatus === 'cancel' || $transactionStatus === 'expire') {
            $order->update(['payment_status' => 'unpaid']);
            $order->payment->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'OK']);
    }
}
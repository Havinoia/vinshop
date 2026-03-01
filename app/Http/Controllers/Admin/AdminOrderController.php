<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
                       ->latest()
                       ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product', 'payment');

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status'         => 'nullable|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'nullable|in:unpaid,paid,refunded',
        ]);

        // Update status order kalau ada
        if ($request->has('status')) {
            $order->update(['status' => $request->status]);
        }

        // Update status pembayaran kalau ada
        if ($request->has('payment_status')) {
            $order->update(['payment_status' => $request->payment_status]);

            // Kalau pembayaran berhasil, catat waktu pembayaran
            if ($request->payment_status === 'paid') {
                $order->payment->update(['status' => 'success', 'paid_at' => now()]);
            }

            // Kalau pembayaran direfund
            if ($request->payment_status === 'refunded') {
                $order->payment->update(['status' => 'failed']);
            }
        }

        return redirect()->back()->with('success', 'Order berhasil diperbarui!');
    }
}
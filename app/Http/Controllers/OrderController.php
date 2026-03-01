<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua order milik user yang sedang login
        $orders = Order::where('user_id', $request->user()->id)
                       ->latest()
                       ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'shipping_address' => 'required|string',
            'payment_method'   => 'required|in:transfer,cod,ewallet',
        ]);

        // Ambil semua item keranjang user
        $carts = Cart::where('user_id', $request->user()->id)
                     ->with('product')
                     ->get();

        // Kalau keranjang kosong, tolak
        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja kamu kosong!');
        }

        // Hitung total harga
        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        // Buat order baru
        $order = Order::create([
            'user_id'          => $request->user()->id,
            'total_price'      => $total,
            'status'           => 'pending',
            'shipping_address' => $request->shipping_address,
            'payment_status'   => 'unpaid',
        ]);

        // Buat order items dari keranjang
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $cart->product_id,
                'quantity'   => $cart->quantity,
                'price'      => $cart->product->price,
            ]);

            // Kurangi stok produk
            $cart->product->decrement('stock', $cart->quantity);
        }

        // Buat payment
        Payment::create([
            'order_id' => $order->id,
            'method'   => $request->payment_method,
            'amount'   => $total,
            'status'   => 'pending',
        ]);

        // Kosongkan keranjang setelah order dibuat
        Cart::where('user_id', $request->user()->id)->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Order berhasil dibuat!');
    }

    public function show(Request $request, Order $order)
    {
        // Pastikan order milik user yang sedang login
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }

        $order->load('orderItems.product', 'payment');

        return view('orders.show', compact('order'));
    }
}
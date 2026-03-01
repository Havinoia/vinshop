<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua item keranjang milik user yang sedang login
        $carts = Cart::where('user_id', $request->user()->id)
                     ->with('product')
                     ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('cart.index', compact('carts', 'total'));
    }

    public function add(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek apakah produk sudah ada di keranjang
        $cart = Cart::where('user_id', $request->user()->id)
                    ->where('product_id', $request->product_id)
                    ->first();

        if ($cart) {
            // Kalau sudah ada, tambahkan quantity saja
            $cart->increment('quantity', $request->quantity);
        } else {
            // Kalau belum ada, buat baru
            Cart::create([
                'user_id'    => $request->user()->id,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, Cart $cart)
    {
        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Pastikan cart milik user yang sedang login
        if ($cart->user_id !== $request->user()->id) {
            abort(403);
        }

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function destroy(Request $request, Cart $cart)
    {
        // Pastikan cart milik user yang sedang login
        if ($cart->user_id !== $request->user()->id) {
            abort(403);
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil produk yang aktif, bisa filter berdasarkan kategori dan pencarian
        $products = Product::where('is_active', true)
                           ->when(request('category'), function ($query) {
                               $query->whereHas('category', function ($q) {
                                   $q->where('slug', request('category'));
                               });
                           })
                           ->when(request('search'), function ($query) {
                               $query->where('name', 'like', '%' . request('search') . '%');
                           })
                           ->latest()
                           ->paginate(12);

        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        // Cari produk berdasarkan slug, kalau tidak ada tampilkan 404
        $product = Product::where('slug', $slug)
                          ->where('is_active', true)
                          ->with('images', 'category')
                          ->firstOrFail();

        // Produk terkait dari kategori yang sama
        $related = Product::where('category_id', $product->category_id)
                          ->where('id', '!=', $product->id)
                          ->where('is_active', true)
                          ->take(4)
                          ->get();

        return view('products.show', compact('product', 'related'));
    }
}
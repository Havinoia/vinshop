<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 8 produk terbaru yang aktif
        $products = Product::where('is_active', true)
                           ->latest()
                           ->take(8)
                           ->get();

        // Ambil semua kategori
        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }
}
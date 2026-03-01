<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk ditampilkan di dashboard
        $totalUsers    = User::where('role', 'customer')->count();
        $totalProducts = Product::count();
        $totalOrders   = Order::count();
        $totalRevenue  = Order::where('payment_status', 'paid')->sum('total_price');

        // 5 order terbaru
        $latestOrders = Order::with('user')
                             ->latest()
                             ->take(5)
                             ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'latestOrders'
        ));
    }
}
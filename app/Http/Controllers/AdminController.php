<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class AdminController extends Controller
{
    // Method for admin dashboard
    public function index()
    {
        // Count non-admin users
        $nonAdminUserCount = User::where('is_admin', 0)->count();

        $orderCount = Order::count();
        $earnings = Order::sum('total_amount');
        $totalSales = OrderItem::sum('quantity');

        // Fetch recent orders with product and order data
        $recentOrders = OrderItem::with(['order', 'product'])
            ->latest()
            ->take(8)
            ->get();

        // Fetch recent customers (excluding admins)
        $recentCustomers = User::where('is_admin', 0)
            ->latest()
            ->take(8)
            ->get();

        // Pass all variables to the view
        return view('AdminDashboard', compact(
            'nonAdminUserCount',
            'orderCount',
            'earnings',
            'totalSales',
            'recentOrders',
            'recentCustomers'
        ));
    }

    public function products()
    {
        $products = Product::all(); // You may apply pagination or filters if needed
        return view('AdminProducts', compact('products'));
    }
}

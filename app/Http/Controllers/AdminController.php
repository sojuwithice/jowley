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
            ->take(😎
            ->get();

        // Fetch recent customers (excluding admins)
        $recentCustomers = User::where('is_admin', 0)
            ->latest()
            ->take(😎
            ->get();

        // Get monthly sales data (top 10 selling products this month)
        $monthlySales = Product::select('products.*')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->selectRaw('products.*, SUM(order_items.quantity) as total_quantity')
            ->groupBy('products.id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        // Pass all variables to the view
        return view('AdminDashboard', compact(
            'nonAdminUserCount',
            'orderCount',
            'earnings',
            'totalSales',
            'recentOrders',
            'recentCustomers',
            'monthlySales'  // Add this new variable
        ));
    }

    public function products()
    {
        $products = Product::all();
        return view('AdminProducts', compact('products'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User; // Make sure to include the User model
use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    // Method for admin dashboard
    public function index()
    {
        // Count non-admin users
        $nonAdminUserCount = User::where('is_admin', 0)->count();

        // Pass the count to the view
        return view('AdminDashboard', compact('nonAdminUserCount'));
    }
    public function products()
    {
        $products = Product::all(); // You may apply pagination or filters if needed
        return view('AdminProducts', compact('products'));
    }
}


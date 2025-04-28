<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class PurchaseController extends Controller
{
    public function showPurchases()
    {
        $orders = Auth::user()->orders()->get();
        // Fetch orders with order items and product details
        return view('purchasepage', compact('orders'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $selectedItems = json_decode($request->input('selected_items'), true);
    
        if (empty($selectedItems)) {
            return redirect()->back()->with('error', 'No items selected for checkout.');
        }
    
        $cartItems = [];
        $totalPrice = 0;
        $subtotal = 0; // Initialize subtotal

        foreach ($selectedItems as $item) {
            $cartItem = Cart::with('product')->where('product_id', $item['product_id'])
                ->where('user_id', Auth::id())
                ->first();
    
            if ($cartItem) {
                // Set selected quantity and color
                $cartItem->selected_quantity = $item['quantity'];
                $cartItem->selected_color = $item['color'] ?? null;
                
                // Add cart item to the list
                $cartItems[] = $cartItem;

                // Calculate total price (price * quantity)
                $totalPrice += $cartItem->product->price * $item['quantity'];

                // Calculate subtotal (sum of product prices)
                $subtotal += $cartItem->product->price * $item['quantity'];
            }
        }
    
        return view('checkout', compact('cartItems', 'totalPrice', 'subtotal'));
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Method to add a product to the cart
    public function addToCart(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to add items to the cart.');
        }

        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Get the product details to get the price
        $product = Product::find($request->product_id);

        // Check if the product exists
        if (!$product) {
            return redirect()->route('cart')->with('error', 'Product not found.');
        }

        // Check if the product is already in the cart
        $existing = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            // If the product exists in the cart, just update the quantity
            $existing->quantity += $request->quantity;
            $existing->save();
        } else {
            // If it's a new product, create a new cart item
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->price, // Fetch price from product
            ]);
        }

        return redirect()->route('cart')->with('success', 'Added to cart!');
    }

    // Method to view the cart
    public function viewCart()
    {
        // Get cart items for the logged-in user with product details
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        // Calculate the total price of the items in the cart
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;  // Calculate total based on the stored price and quantity
        });

        // Return the cart view with cart items and total
        return view('cart', compact('cartItems', 'cartTotal'));
    }

    // Method to update the quantity of an item in the cart
    public function updateCart(Request $request, $productId)
    {
        // Validate the quantity input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the cart item
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();

        if ($cartItem) {
            // Update the quantity of the cart item
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return response()->json(['success' => true]);
    }

    // Method to remove an item from the cart
 
public function destroy($productId)
{
    $cartItem = Cart::where('product_id', $productId)->where('user_id', auth::id())->first();

    if ($cartItem) {
        $cartItem->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}
    
}

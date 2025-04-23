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
    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'You need to be logged in to add items to the cart.'
        ], 401);
    }

    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'color' => 'required|string'
    ]);

    $product = Product::find($request->product_id);
    if (!$product) {
        return response()->json([
            'success' => false,
            'message' => 'Product not found.'
        ], 404);
    }

    $existingCartItem = Cart::where('user_id', Auth::id())
                          ->where('product_id', $request->product_id)
                          ->first();

    $requestedQuantity = $request->quantity;
    $totalQuantity = $existingCartItem ? ($existingCartItem->quantity + $requestedQuantity) : $requestedQuantity;

    // Check stock availability
    if ($totalQuantity > $product->stock) {
        $available = $product->stock - ($existingCartItem ? $existingCartItem->quantity : 0);
        $available = max($available, 0);
        
        return response()->json([
            'success' => false,
            'message' => 'Only ' . $available . ' more items available in stock. You cannot add ' . $requestedQuantity . ' items.'
        ], 422);
    }

    if ($existingCartItem) {
        $existingCartItem->quantity = $totalQuantity;
        $existingCartItem->save();
    } else {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $requestedQuantity,
            'price' => $product->price,
            'product_name' => $request->product_name,
            'image' => $request->image,
            'color' => $request->color,
        ]);
    }

    return response()->json([
        'success' => true,
        'message' => 'Product added to cart successfully!'
    ]);
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
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cartItem = Cart::where('user_id', Auth::id())
                    ->where('product_id', $productId)
                    ->first();

    if ($cartItem) {
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Cart item not found.']);
}



    // Method to remove an item from the cart
 
    public function destroy($productId)
    {
        $cartItem = Cart::where('product_id', $productId)
                        ->where('user_id', Auth::id())
                        ->first();
    
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Item not found'], 404);
    }
    
   public function checkout(Request $request)
{
    $selectedItems = json_decode($request->input('selected_items'), true);

    if (empty($selectedItems)) {
        return redirect()->back()->with('error', 'No items selected for checkout.');
    }

    $cartItems = [];
    foreach ($selectedItems as $item) {
        $cartItem = Cart::with('product')->where('product_id', $item['product_id'])
            ->where('user_id', Auth::id())
            ->first();

        if ($cartItem) {
            $cartItem->selected_quantity = $item['quantity'];
            $cartItem->selected_color = $item['color'] ?? null;
            $cartItems[] = $cartItem;
        }
    }

    return view('checkout', compact('cartItems'));
}

    
}
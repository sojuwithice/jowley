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
        'color' => 'nullable|string' // Changed to nullable
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
                          ->when($request->color, function($query) use ($request) {
                              return $query->where('color', $request->color);
                          })
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
            'color' => $request->color ?? null,
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
    $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
    $cartTotal = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    // Get the selected item ID from session if it exists
    $selectedItemId = session('selected_item');

    return view('cart', compact('cartItems', 'cartTotal', 'selectedItemId'));
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
public function directCheckout(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('LoginSignUp')->with('error', 'Please login to proceed with checkout.');
    }

    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'color' => 'nullable|string'
    ]);

    $product = Product::findOrFail($request->product_id);

    // Check stock
    if ($request->quantity > $product->stock) {
        return back()->with('error', 'Not enough stock available.');
    }

    // Add item to cart (or update if exists)
    $cartItem = Cart::updateOrCreate(
        [
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'color' => $request->color
        ],
        [
            'quantity' => $request->quantity,
            'price' => $product->price,
            'product_name' => $product->name,
            'image' => $product->images ? json_decode($product->images)[0] : null
        ]
    );

    // Redirect to cart with the item pre-selected
    return redirect()->route('cart')->with('selected_item', $cartItem->id);
}
    
}
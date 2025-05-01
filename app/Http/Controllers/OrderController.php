<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Address;
use App\Models\User; // make sure this import is present as well

use Illuminate\Support\Facades\Auth;



class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $selectedItemIds = $request->input('selected_items', []);
    $cartItems = Cart::with('product')
        ->where('user_id', $user->id)
        ->whereIn('id', $selectedItemIds)
        ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'No items selected for checkout.');
        }


        // Find default address
        $address = $user->addresses()->where('is_default', 1)->first();
        if (!$address) {
            return redirect()->back()->with('error', 'No delivery address found.');
        }

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'full_name' => $address->full_name,
            'phone_number' => $address->phone_number,
            'address' => $address->street . ', ' . $address->barangay . ', ' . $address->city . ', ' . $address->province,
            'payment_method' => $request->payment_method,
            'total_amount' => $cartItems->sum(function($item) {
                return $item->quantity * $item->product->price;
            }),
            'status' => 'to pay', // (Fixed to match your available statuses)
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'variation' => $item->variation,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'image' => $item->product->image, // ➔ Added this line
            ]);
        }

        // Clear user's cart
        Cart::whereIn('id', $selectedItemIds)->delete();

        return redirect()->route('purchasepage')->with('success', 'Order placed successfully!');
    }
    public function updateStatus(Request $request, $orderId)
{
    $order = Order::findOrFail($orderId);
    $order->status = $request->status;
    $order->save();

    return response()->json(['success' => true]);
}
}

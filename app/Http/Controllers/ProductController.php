<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
    
        // Decode JSON fields if needed
        if (is_string($product->images)) {
            $product->images = json_decode($product->images, true);
        }
    
        if (is_string($product->available_colors)) {
            $product->available_colors = json_decode($product->available_colors, true);
        }

        // Initialize notification variables
        $notifications = [];
        $unreadCount = 0;
        
        // Only get notifications if user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $notifications = $user->notifications()
                ->latest()
                ->take(5)
                ->get();
            $unreadCount = $user->unreadNotifications()->count();
        }
    
        return view('product', [
            'product' => $product,
            'notifications' => $notifications,  // Correct variable name
            'unreadCount' => $unreadCount      // Properly initialized
        ]);
    }
}
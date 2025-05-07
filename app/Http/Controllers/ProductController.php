<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
    
        // Only decode if it's a string (JSON)
        if (is_string($product->images)) {
            $product->images = json_decode($product->images, true);
        }

        if (is_string($product->available_colors)) {
            $product->available_colors = json_decode($product->available_colors, true);
        }
    
        return view('product', compact('product'));
    }

   
    public function reviews(Product $product)
{
    $ratings = $product->ratings()
        ->with('user') // <-- this loads the user relationship
        ->latest()
        ->paginate(10);

    return view('products.reviews', compact('product', 'ratings'));
}

public function featuredProducts()
{
    // Get top 4 products
    $topProducts = Product::orderByDesc('monthly_sales')
                          ->take(4)
                          ->get();

    return view('homepage', compact('topProducts')); // or 'homepage' if that's your Blade filename
}



}

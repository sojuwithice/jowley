<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;


class ProductController extends Controller
{public function show($slug)
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

    

}

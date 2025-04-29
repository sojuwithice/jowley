<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    // Show the form to add a new product
    public function create()
    {
        return view('add_product');
    }

    // Store the new product in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'rating' => 'required|numeric|min:0|max:5',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        // Create the new product
        Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'rating' => $request->rating,
            'stock' => $request->stock,
            'images' => $imagePath, // Store the image path
        ]);

        return redirect()->route('products.addProduct')->with('success', 'Product added successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Show all products (admin)
    public function showAdminProducts()
    {
        $products = Product::all()->map(function($product) {
            // Decode JSON fields if they are strings
            if (is_string($product->available_colors)) {
                $product->available_colors = json_decode($product->available_colors, true);
            }

            if (is_string($product->images)) {
                $product->images = json_decode($product->images, true);
            }

            return $product;
        });

        return view('AdminProducts', compact('products'));
    }

    // Show form to edit a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        // Decode JSON fields before passing to the view
        if (is_string($product->available_colors)) {
            $product->available_colors = json_decode($product->available_colors, true);
        }

        if (is_string($product->images)) {
            $product->images = json_decode($product->images, true);
        }

        return view('editProduct', compact('product'));
    }

    // Handle update
    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'rating' => 'nullable|numeric',
        'sold' => 'nullable|integer',
        'available_colors' => 'nullable|array',

    ]);

    $product->name = $validated['name'];
    $product->slug = Str::slug($validated['name']);
    $product->description = $validated['description'];
    $product->price = $validated['price'];
    $product->stock = $validated['stock'];
    $product->rating = $validated['rating'] ?? 0;
    $product->sold = $validated['sold'] ?? 0;
    $product->available_colors = json_encode($validated['available_colors']);


    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}

    // Handle delete
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    // Your existing show() method
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        // Decode JSON fields only if they are strings
        if (is_string($product->images)) {
            $product->images = json_decode($product->images, true);
        }

        if (is_string($product->available_colors)) {
            $product->available_colors = json_decode($product->available_colors, true);
        }

        return view('product', compact('product'));
    }
}



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        $searchTerm = $request->input('q');
        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // --- Sorting Section ---

        // First, for "relevance" sorting (if searching)
        if ($request->input('sort') === 'relevance' && $searchTerm) {
            $query->orderByRaw("
                CASE 
                    WHEN name LIKE ? THEN 1 
                    WHEN name LIKE ? THEN 2 
                    ELSE 3 
                END
            ", ["$searchTerm%", "%$searchTerm%"]);
        }

        // Then "top" sorting (sold + rating)
        if ($request->input('sort') === 'top') {
            $query->orderBy('sold', 'desc')
                  ->orderBy('rating', 'desc');
        }

        // Then "latest" sorting
        if ($request->input('sort') === 'latest') {
            $query->orderBy('created_at', 'desc');
        }

        // Then price sorting (low-to-high or high-to-low)
        if ($request->filled('price_sort')) {
            $direction = $request->input('price_sort') === 'low-to-high' ? 'asc' : 'desc';
            $query->orderBy('price', $direction);
        }

        // Default fallback: if no specific sort applied, sort by newest
        if (!$request->filled('sort') && !$request->filled('price_sort')) {
            $query->orderBy('created_at', 'desc');
        }

        // --- End Sorting Section ---

        // Get products paginated
        $products = $query->paginate(12)
            ->appends($request->except('page'));

        return view('searchpage', [
            'products' => $products,
            'searchTerm' => $searchTerm
        ]);
    }
}

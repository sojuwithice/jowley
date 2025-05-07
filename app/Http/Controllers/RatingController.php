<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_item_id' => 'required|exists:order_items,id',
            'rating' => 'required|integer|between:1,5',
            'seller_rating' => 'required|integer|between:1,5',
            'delivery_rating' => 'required|integer|between:1,5',
            'appearance_review' => 'nullable|string|max:1000',
            'material_review' => 'nullable|string|max:1000',
            'show_username' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/quicktime|max:5120',
        ]);

        try {
            // Check for existing rating
            $existingRating = Rating::where('order_item_id', $validated['order_item_id'])
                                ->where('user_id', Auth::id())
                                ->first();

            if ($existingRating) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already rated this product'
                ], 422);
            }

            // Handle file uploads
            $imagePath = null;
            $videoPath = null;
            
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('ratings/images', 'public');
            }
            
            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('ratings/videos', 'public');
            }

            // Create the rating
            $rating = Rating::create([
                'user_id' => Auth::id(),
                'product_id' => $validated['product_id'],
                'order_item_id' => $validated['order_item_id'],
                'appearance_review' => $validated['appearance_review'],
                'material_quality_review' => $validated['material_review'],
                'show_username' => $validated['show_username'],
                'has_photo' => !is_null($imagePath),
                'has_video' => !is_null($videoPath),
                'services' => [
                    'overall_rating' => $validated['rating'],
                    'seller_rating' => $validated['seller_rating'],
                    'delivery_rating' => $validated['delivery_rating']
                ],
                'image_path' => $imagePath,
                'video_path' => $videoPath,
            ]);

            // Only update is_rated if column exists
            if (Schema::hasColumn('order_items', 'is_rated')) {
                OrderItem::where('id', $validated['order_item_id'])
                        ->update(['is_rated' => true]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Rating submitted successfully',
                'rating' => $rating,
                'username' => $validated['show_username'] ? Auth::user()->username : null
            ]);

        } catch (\Exception $e) {
            // Clean up uploaded files if an error occurred
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            if (isset($videoPath)) {
                Storage::disk('public')->delete($videoPath);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit rating: ' . $e->getMessage()
            ], 500);
        }
    }
}
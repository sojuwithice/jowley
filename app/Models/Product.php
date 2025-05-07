<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [
        'name', 'description', 'price', 'rating', 'sold',
        'available_colors', 'stock', 'images','slug'
    ];

    protected $casts = [
        'available_colors' => 'array',
        'images' => 'array',
    ];

    
public function carts()
{
    return $this->hasMany(Cart::class);
}

// Add to your Product model
public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function updateAverageRating()
{
    $this->average_rating = $this->ratings()->avg(
        \DB::raw("JSON_EXTRACT(services, '$.overall_rating')")
    );
    $this->save();
}
}

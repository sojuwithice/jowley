<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [
        'name', 'description', 'price', 'rating', 'sold',
        'available_colors', 'stock', 'images'
    ];

    protected $casts = [
        'available_colors' => 'array',
        'images' => 'array',
    ];

    
public function carts()
{
    return $this->hasMany(Cart::class);
}
public function orders()
{
    return $this->hasMany(Order::class);
}

}

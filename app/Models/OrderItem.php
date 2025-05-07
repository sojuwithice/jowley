<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_id', 'product_id', 'variation', 'quantity', 'price', 'image'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Add this new relationship
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    // Helper method to check if item can be rated
    public function canBeRated()
    {
        return !$this->rating && optional($this->order)->status === 'completed';
    }
}
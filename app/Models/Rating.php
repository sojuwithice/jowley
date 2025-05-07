<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'order_item_id',
        'appearance_review',
        'material_quality_review',
        'show_username',
        'has_photo',
        'has_video',
        'services'
    ];

    protected $casts = [
        'services' => 'array',
        'show_username' => 'boolean',
        'has_photo' => 'boolean',
        'has_video' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    // Accessor for overall rating
    public function getOverallRatingAttribute()
    {
        return $this->services['overall_rating'] ?? null;
    }

    // Accessor for seller rating
    public function getSellerRatingAttribute()
    {
        return $this->services['seller_rating'] ?? null;
    }

    // Accessor for delivery rating
    public function getDeliveryRatingAttribute()
    {
        return $this->services['delivery_rating'] ?? null;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Ensure this is included

class Address extends Model
{
    protected $fillable = [
        'user_id', 'full_name', 'phone_number', 'street',
        'city', 'barangay', 'label', 'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // This assumes your User model is in App\Models\User
    }
}

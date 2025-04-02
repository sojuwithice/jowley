<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Add the $fillable property to specify which fields can be mass-assigned
    protected $fillable = [
        'username', 'email', 'phone', 'password',
    ];

    // You can also use $guarded if you prefer, but $fillable is easier to use
    // protected $guarded = ['id']; // Example of using guarded if you prefer
}

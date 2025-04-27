<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Add the $fillable property to specify which fields can be mass-assigned
    protected $fillable = [
        'username', 'email', 'phone', 'password', 'is_admin',  // Include is_admin in fillable
    ];

    // You can also use $guarded if you prefer, but $fillable is easier to use
    // protected $guarded = ['id']; // Example of using guarded if you prefer

    // Add a method to check if the user is an admin
    public function isAdmin()
    {
        return $this->is_admin == 1;
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function orders()
{
    return $this->hasMany(Order::class);
}

}

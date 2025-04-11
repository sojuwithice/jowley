<?php

// app/Http/Controllers/Auth/LoginController.php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the login inputs
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Use the login value to find the user by username, email, or phone
        $user = User::where('username', $request->login)
                    ->orWhere('email', $request->login)
                    ->orWhere('phone', $request->login)
                    ->first();
                    $key = 'login-attempts:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors([
                'login' => 'Too many login attempts. Please try again in ' . RateLimiter::availableIn($key) . ' seconds.',
    ]);
}

        RateLimiter::hit($key, 60); // 60 seconds cooldown after 5 attempts


        // If user does not exist, return an error
        if (!$user) {
            return back()->withErrors(['login' => 'The account does not exist.']);
        }

        // If password is incorrect, return an error
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }

        // Log the user in
        Auth::login($user);

        // If the user is an admin, redirect to the admin dashboard
        if ($user->is_admin) {
            return redirect()->route('SellerDash')->with('message', 'Welcome back, Admin!');
        }

        // Redirect to homepage for regular users
        return redirect()->route('homepage')->with('message', 'Welcome back!');

        
    }
}

<?php

// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
{
    // Validate input with confirm password check
    $validator = Validator::make($request->all(), [
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
        'phone' => 'required|numeric|unique:users,phone|regex:/^\d+$/', // Only numbers allowed
        'password' => 'required|string|min:8|confirmed', // The 'confirmed' rule checks if password and password_confirmation match
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Create the user
    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    // Redirect to the homepage after successful registration
    return redirect()->route('homepage');
}

}

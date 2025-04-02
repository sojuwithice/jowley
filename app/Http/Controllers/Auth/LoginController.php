<?php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);


        $user = User::where('username', $request->login)
                    ->orWhere('email', $request->login)
                    ->orWhere('phone', $request->login)
                    ->first();

        if (!$user) {
            return back()->withErrors(['login' => 'The account does not exist.']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }

        // Log the user in
        Auth::login($user);

        // Redirect to homepage after successful login
        return redirect()->route('homepage');
    }
}

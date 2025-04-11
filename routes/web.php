<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Product;


Route::get('/startingpage', function () {
    return view('startingpage');
})->name('startingpage');

Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');

// Redirect logic
Route::get('/', function () {
    return auth()->check() ? redirect()->route('homepage') : redirect()->route('startingpage');
});


Route::get('/LoginSignUp', function () {
    return view('LoginSignUp'); 
})->name('LoginSignUp');

Route::get('LoginSignupPhoneNo', function () {
    return view('LoginSignupPhoneNo'); 
});

Route::get('AccountVerification', function () {
    return view('AccountVerification'); 
});

Route::get('Register', function () {
    return view('Register'); 
});

Route::get('AccountRecovery', function () {
    return view('AccountRecovery'); 
});

Route::get('AboutPage', function () {
    return view('AboutPage'); 
});


Route::get('/butterfly-bouquet', function () {
    return view('butterflybouquet');
})->name('butterflybouquet');
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');


Route::post('/register', [RegisterController::class, 'register']);

Route::get('/home', [HomeController::class, 'index'])->name('homepage');
 
Route::post('/LoginSignUp', [LoginController::class, 'login'])->name('LoginSignUp');


Route::get('/logout', function () {
    Auth::logout(); // Logs out the user
    session()->invalidate(); // Invalidates the session
    session()->regenerateToken(); // Regenerates the CSRF token

    return redirect('/home'); // Redirect to the homepage
})->name('logout');
// Checkout Route
Route::get('/checkout', function() {
    if (!Auth::check()) {
        return redirect()->route('LoginSignUp')->with('message', 'Please log in to proceed to checkout.');
    }
    return view('checkout');
})->name('checkout');


Route::get('/SellerDash', [AdminController::class, 'index'])->name('SellerDash');

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');



Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{productId}', [CartController::class, 'updateCart'])->name('cart.update');  // For updating quantity
    Route::delete('/cart/delete/{productId}', [CartController::class, 'destroy'])->name('cart.delete');
    


});
